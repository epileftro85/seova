<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PostWriteService
{
    /**
     * Create a new post
     */
    public function createPost(array $data): Post
    {
        $this->validatePostData($data);

        // Generate slug from title if not provided
        if (empty($data['slug'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title']);
        }

        // Publish if flag is set
        if ($data['published'] ?? false) {
            $data['published_at'] = now();
        }

        return Post::create($data);
    }

    /**
     * Update an existing post
     */
    public function updatePost(Post $post, array $data): Post
    {
        $this->validatePostData($data, $post->id);

        // Generate new slug if title changed
        if (isset($data['title']) && $data['title'] !== $post->title) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $post->id);
        }

        // Handle publishing
        if ($data['published'] ?? false) {
            if (!$post->published_at) {
                $data['published_at'] = now();
            }
        } else {
            $data['published_at'] = null;
        }

        $post->update($data);
        return $post->fresh();
    }

    /**
     * Publish a post
     */
    public function publishPost(Post $post): Post
    {
        $post->update([
            'published' => true,
            'published_at' => now(),
        ]);

        return $post->fresh();
    }

    /**
     * Unpublish a post
     */
    public function unpublishPost(Post $post): Post
    {
        $post->update([
            'published' => false,
            'published_at' => null,
        ]);

        return $post->fresh();
    }

    /**
     * Generate a unique slug from title
     */
    public function generateUniqueSlug(string $title, ?int $excludePostId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = Post::where('slug', $slug);
        if ($excludePostId) {
            $query->where('id', '!=', $excludePostId);
        }

        while ($query->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $query = Post::where('slug', $slug);
            if ($excludePostId) {
                $query->where('id', '!=', $excludePostId);
            }
            $counter++;
        }

        return $slug;
    }

    /**
     * Validate post data
     */
    private function validatePostData(array $data, ?int $excludePostId = null): void
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug' . ($excludePostId ? ",$excludePostId" : ''),
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string',
            'faqs' => 'nullable|json',
            'published' => 'nullable|boolean',
        ];

        $validator = validator($data, $rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->messages());
        }
    }
}
