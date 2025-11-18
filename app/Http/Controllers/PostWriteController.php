<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostWriteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PostWriteController extends Controller
{
    public function __construct(private readonly PostWriteService $postWriteService)
    {
    }

    /**
     * Show the form for creating a new post
     */
    public function create(): View
    {
        return view('blog.create', [
            'post' => null,
        ]);
    }

    /**
     * Store a newly created post in storage
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $post = $this->postWriteService->createPost($request->all());

            return redirect()
                ->route('posts.show', $post->slug)
                ->with('success', 'Blog post created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    /**
     * Show the form for editing a post
     */
    public function edit(Post $post): View
    {
        return view('blog.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified post in storage
     */
    public function update(\Illuminate\Http\Request $request, Post $post): RedirectResponse
    {
        try {
            $this->postWriteService->updatePost($post, $request->all());

            return redirect()
                ->route('posts.show', $post->slug)
                ->with('success', 'Blog post updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->errors())
                ->withInput();
        }
    }

    /**
     * Publish a post
     */
    public function publish(Post $post): RedirectResponse
    {
        $this->postWriteService->publishPost($post);

        return redirect()
            ->back()
            ->with('success', 'Blog post published successfully!');
    }

    /**
     * Unpublish a post
     */
    public function unpublish(Post $post): RedirectResponse
    {
        $this->postWriteService->unpublishPost($post);

        return redirect()
            ->back()
            ->with('success', 'Blog post unpublished successfully!');
    }
}
