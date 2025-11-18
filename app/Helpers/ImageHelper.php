<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Get image URL with specific format
     *
     * @param string $baseImageUrl Base image URL without format/extension
     * @param string $format Image format (webp, jpg, png, etc.)
     * @return string Complete image URL with format
     */
    public static function imageUrl(string $baseImageUrl, string $format = 'jpg'): string
    {
        if (empty($baseImageUrl)) {
            return '';
        }

        // If URL already has an extension, return as-is
        if (self::hasExtension($baseImageUrl)) {
            return $baseImageUrl;
        }

        // Append the format as extension
        return $baseImageUrl . '.' . $format;
    }

    /**
     * Check if URL already has a file extension
     */
    private static function hasExtension(string $url): bool
    {
        $path = parse_url($url, PHP_URL_PATH);
        $filename = basename($path);
        return strpos($filename, '.') !== false;
    }

    /**
     * Get WebP version of image (for picture element source)
     *
     * @param string $baseImageUrl Base image URL without format
     * @return string Image URL with .webp extension
     */
    public static function webpUrl(string $baseImageUrl): string
    {
        return self::imageUrl($baseImageUrl, 'webp');
    }

    /**
     * Get JPEG fallback version of image
     *
     * @param string $baseImageUrl Base image URL without format
     * @return string Image URL with .jpg extension
     */
    public static function jpgUrl(string $baseImageUrl): string
    {
        return self::imageUrl($baseImageUrl, 'jpg');
    }
}
