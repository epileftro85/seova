<?php

namespace App\Utils;

use App\Utils\EnvUtil;

/**
 * Simple View Renderer - Lightweight template system without external dependencies
 */
class View
{
    private static string $cachePath;
    private static bool $cacheEnabled;
    private static string $viewsPath;
    private static string $layoutPath;
    private array $data = [];
    private string $siteUrl;
    private array $sections = [];


    public function __construct()
    {
        if (!defined('ROOT_PATH')) {
            define('ROOT_PATH', dirname(__DIR__, 2) . '/');
        }

        self::$viewsPath = ROOT_PATH . 'app/Views/';
        self::$layoutPath = self::$viewsPath . 'layout.php';
        self::$cachePath = self::$viewsPath . 'cache/';
        self::$cacheEnabled = EnvUtil::get('VIEW_CACHE_ENABLED', 'false') === 'true';
        $this->siteUrl = EnvUtil::get('APP_URL', 'http://localhost');
    }

    /**
     * Set view data
     */
    public function with(array $data): self
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * Set single data variable
     */
    public function set(string $key, $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * Render a view with optional layout
     */
    public function render(string $view, string $layout = null): string
    {
        $viewFile = self::$viewsPath . $view . '.php';
        if (!file_exists($viewFile)) {
            throw new \RuntimeException("View file not found: {$viewFile}");
        }

        $this->data['siteUrl'] = $this->siteUrl;

        $cacheKey = $this->getCacheKey($view, $layout, $this->data);
        $cacheFile = self::$cachePath . $cacheKey . '.html';

        if (self::$cacheEnabled) {
            if (file_exists($cacheFile)) {
                return file_get_contents($cacheFile);
            }
        }

        // Extract data to make variables available in view
        extract($this->data);

        // Start output buffering
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // If no layout specified, return content directly
        if ($layout === null || $layout === '') {
            if (self::$cacheEnabled) {
                $this->writeCacheFile($cacheFile, $content);
            }
            return $content;
        }

        // Use specified layout or default
        $layoutFile = $layout ? self::$viewsPath . $layout . '.php' : self::$layoutPath;
        if (!file_exists($layoutFile)) {
            if (self::$cacheEnabled) {
                $this->writeCacheFile($cacheFile, $content);
            }
            return $content; // Return content without layout if layout doesn't exist
        }

        // Render layout with content
        ob_start();
        include $layoutFile;
        $finalContent = ob_get_clean();

        if (self::$cacheEnabled) {
            $this->writeCacheFile($cacheFile, $finalContent);
        }
        return $finalContent;
    }

    private function getCacheKey(string $view, ?string $layout, array $data): string
    {
        $dataHash = md5(json_encode($data));
        $layoutPart = $layout ? $layout : 'nolayout';
        return $view . '_' . $layoutPart . '_' . $dataHash;
    }

    private function writeCacheFile(string $cacheFile, string $content): void
    {
        $dir = dirname($cacheFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        // Debug: print when creating cache
        error_log("[ViewCache] Creating cache file: $cacheFile");
        file_put_contents($cacheFile, $content);
        // Debug: print after cache created
        error_log("[ViewCache] Cache file created: $cacheFile");
    }

    /**
     * Render view and output directly
     */
    public function display(string $view, string $layout = null): void
    {
        echo $this->render($view, $layout);
    }

    /**
     * Start a section for layout
     */
    public function startSection(string $name): void
    {
        $this->sections[$name] = '';
        ob_start();
    }

    /**
     * End a section
     */
    public function endSection(string $name): void
    {
        if (isset($this->sections[$name])) {
            $this->sections[$name] = ob_get_clean();
        }
    }

    /**
     * Get section content
     */
    public function section(string $name, string $default = ''): string
    {
        return $this->sections[$name] ?? $default;
    }

    /**
     * Check if section exists
     */
    public function hasSection(string $name): bool
    {
        return isset($this->sections[$name]);
    }

    /**
     * Include a partial view
     */
    public function include(string $partial, array $data = []): void
    {
        $partialFile = self::$viewsPath . 'partials/' . $partial . '.php';
        if (file_exists($partialFile)) {
            extract(array_merge($this->data, $data));
            include $partialFile;
        }
    }

    /**
     * Escape HTML output
     */
    public function escape($value): string
    {
        return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get asset URL
     */
    public function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }

    /**
     * Get current URL
     */
    public function url(string $path = ''): string
    {
        $baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        return $baseUrl . '/' . ltrim($path, '/');
    }

    /**
     * Check if current route matches
     */
    public function isActive(string $path): bool
    {
        $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        return $currentPath === '/' . ltrim($path, '/');
    }

    /**
     * Static helper methods
     */
    public static function make(): self
    {
        return new self();
    }

    public static function renderStatic(string $view, array $data = [], string $layout = null): string
    {
        return self::make()->with($data)->render($view, $layout);
    }

    public static function displayStatic(string $view, array $data = [], string $layout = null): void
    {
        echo self::renderStatic($view, $data, $layout);
    }
}
