@extends('layouts.app')

@section('title', 'Create Blog Post - Seova')
@section('description', 'Create a new blog post with SEO optimization and rich text editor.')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
@endpush

@section('hero')
<!-- Hero Section -->
<section class="bg-white relative" aria-labelledby="create-post-title">
    <div class="max-w-4xl mx-auto px-6 py-16 text-center">
        <a href="{{ route('posts.index') }}" class="inline-block text-seova-orange hover:text-seova-orange/80 mb-4 text-sm font-semibold">
            ← Back to Blog
        </a>

        <h1 id="create-post-title" class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Create Blog Post</h1>
        <p class="text-lg text-gray-600">Write and publish a new blog post with SEO optimization</p>
    </div>

    <!-- Decorative Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none rotate-180" aria-hidden="true">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="w-full h-20">
            <path d="M0,0V46.29c47.59,22,103.77,29.05,158,17.26C255.58,45.6,320,0,400,0s144.42,45.6,242,63.55c54.23,11.79,110.41,4.74,158-17.26V0Z" fill="#f9fafb"></path>
        </svg>
    </div>
</section>
@endsection

@section('content')
<!-- Blog Post Form -->
<section class="bg-gray-50 py-16 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-12">
            <form action="{{ route('posts.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-900 mb-2">Post Title *</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('title') border-red-500 @enderror"
                        placeholder="Enter post title"
                        value="{{ old('title') }}"
                        required
                    >
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-sm font-semibold text-gray-900 mb-2">Slug (URL friendly)</label>
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('slug') border-red-500 @enderror"
                        placeholder="auto-generated-from-title"
                        value="{{ old('slug') }}"
                    >
                    <p class="mt-1 text-sm text-gray-600">Leave empty to auto-generate from title</p>
                    @error('slug')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-semibold text-gray-900 mb-2">Excerpt</label>
                    <textarea
                        name="excerpt"
                        id="excerpt"
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('excerpt') border-red-500 @enderror"
                        placeholder="Brief summary of the post (used in previews)"
                        maxlength="500"
                    >{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-sm text-gray-600">Max 500 characters</p>
                    @error('excerpt')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-900 mb-2">Content *</label>
                    <div id="editor" style="height: 400px; background-color: white;" class="border border-gray-300 rounded-lg overflow-hidden @error('content') border-red-500 @enderror">
                        {!! old('content') !!}
                    </div>
                    <textarea
                        name="content"
                        id="content"
                        class="hidden"
                        required
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div>
                    <label for="featured_image" class="block text-sm font-semibold text-gray-900 mb-2">Featured Image URL</label>
                    <input
                        type="url"
                        name="featured_image"
                        id="featured_image"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('featured_image') border-red-500 @enderror"
                        placeholder="https://example.com/image.jpg"
                        value="{{ old('featured_image') }}"
                    >
                    <p class="mt-2 text-xs text-gray-600">
                        Recommended size: <strong>1200×600px</strong> (landscape). Max file size: 500KB. Format: JPG, PNG, or WebP
                    </p>
                    @error('featured_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- FAQs Section -->
                <div class="border-t pt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Frequently Asked Questions (Optional)</h3>
                    <p class="text-sm text-gray-600 mb-6">Add FAQs to help readers and improve SEO</p>

                    <div id="faqs-container" class="space-y-4">
                        @php
                            $faqs = old('faqs') ? json_decode(old('faqs'), true) : [];
                        @endphp
                        @if(is_array($faqs) && count($faqs) > 0)
                            @foreach($faqs as $index => $faq)
                                <div class="faq-item bg-gray-50 p-4 rounded-lg">
                                    <input type="hidden" class="faq-index" value="{{ $index }}">
                                    <div class="mb-3">
                                        <input
                                            type="text"
                                            class="faq-question w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50"
                                            placeholder="Question"
                                            value="{{ $faq['question'] ?? '' }}"
                                        >
                                    </div>
                                    <div class="mb-3">
                                        <textarea
                                            class="faq-answer w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50"
                                            rows="3"
                                            placeholder="Answer"
                                        >{{ $faq['answer'] ?? '' }}</textarea>
                                    </div>
                                    <button type="button" class="remove-faq text-sm text-red-600 hover:text-red-700 font-semibold">
                                        Remove Question
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <button type="button" id="add-faq" class="mt-4 px-4 py-2 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                        + Add FAQ
                    </button>

                    <textarea
                        name="faqs"
                        id="faqs-json"
                        class="hidden"
                    >{{ old('faqs', '[]') }}</textarea>
                    @error('faqs')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SEO Section -->
                <div class="border-t pt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">SEO Settings</h3>

                    <!-- SEO Title -->
                    <div class="mb-6">
                        <label for="seo_title" class="block text-sm font-semibold text-gray-900 mb-2">SEO Title</label>
                        <input
                            type="text"
                            name="seo_title"
                            id="seo_title"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('seo_title') border-red-500 @enderror"
                            placeholder="SEO optimized title (60 chars max)"
                            maxlength="60"
                            value="{{ old('seo_title') }}"
                        >
                        <p class="mt-1 text-sm text-gray-600">Recommended: 50-60 characters</p>
                        @error('seo_title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Description -->
                    <div class="mb-6">
                        <label for="seo_description" class="block text-sm font-semibold text-gray-900 mb-2">Meta Description</label>
                        <textarea
                            name="seo_description"
                            id="seo_description"
                            rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('seo_description') border-red-500 @enderror"
                            placeholder="Meta description (160 chars max)"
                            maxlength="160"
                        >{{ old('seo_description') }}</textarea>
                        <p class="mt-1 text-sm text-gray-600">Recommended: 150-160 characters</p>
                        @error('seo_description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SEO Keywords -->
                    <div class="mb-6">
                        <label for="seo_keywords" class="block text-sm font-semibold text-gray-900 mb-2">Keywords</label>
                        <input
                            type="text"
                            name="seo_keywords"
                            id="seo_keywords"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50 @error('seo_keywords') border-red-500 @enderror"
                            placeholder="keyword1, keyword2, keyword3"
                            value="{{ old('seo_keywords') }}"
                        >
                        <p class="mt-1 text-sm text-gray-600">Comma-separated list of keywords</p>
                        @error('seo_keywords')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Publishing Section -->
                <div class="border-t pt-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Publishing</h3>

                    <div class="flex items-center gap-4">
                        <input
                            type="checkbox"
                            name="published"
                            id="published"
                            value="1"
                            class="w-4 h-4 text-seova-orange rounded focus:ring-seova-orange/50"
                            @checked(old('published'))
                        >
                        <label for="published" class="text-sm font-semibold text-gray-900">Publish immediately</label>
                    </div>
                    <p class="mt-2 text-sm text-gray-600">If unchecked, the post will be saved as a draft</p>
                </div>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-8 border-t">
                    <button
                        type="submit"
                        class="px-6 py-3 bg-seova-orange text-white rounded-lg hover:bg-seova-orange/90 transition font-semibold"
                    >
                        {{ $post ? 'Update Post' : 'Publish Post' }}
                    </button>
                    <a
                        href="{{ route('posts.index') }}"
                        class="px-6 py-3 bg-gray-200 text-gray-900 rounded-lg hover:bg-gray-300 transition font-semibold"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Quill Editor Script -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.js"></script>

<script>
    // Initialize Quill editor
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write your blog post content here...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'color': [] }, { 'background': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Sync Quill content to hidden textarea on form submission
    const form = document.querySelector('form');
    const contentInput = document.querySelector('#content');

    form.addEventListener('submit', function(e) {
        const content = quill.root.innerHTML;
        if (quill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Please write some content');
            return;
        }
        contentInput.value = content;
        updateFaqsJSON();
    });

    // FAQ Management
    const addFaqBtn = document.querySelector('#add-faq');
    const faqsContainer = document.querySelector('#faqs-container');
    const faqsJsonInput = document.querySelector('#faqs-json');

    function updateFaqsJSON() {
        const faqs = [];
        document.querySelectorAll('.faq-item').forEach(item => {
            const question = item.querySelector('.faq-question').value.trim();
            const answer = item.querySelector('.faq-answer').value.trim();
            if (question && answer) {
                faqs.push({ question, answer });
            }
        });
        faqsJsonInput.value = JSON.stringify(faqs);
    }

    addFaqBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const faqItem = document.createElement('div');
        faqItem.className = 'faq-item bg-gray-50 p-4 rounded-lg';
        faqItem.innerHTML = `
            <div class="mb-3">
                <input
                    type="text"
                    class="faq-question w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50"
                    placeholder="Question"
                >
            </div>
            <div class="mb-3">
                <textarea
                    class="faq-answer w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-seova-orange/50"
                    rows="3"
                    placeholder="Answer"
                ></textarea>
            </div>
            <button type="button" class="remove-faq text-sm text-red-600 hover:text-red-700 font-semibold">
                Remove Question
            </button>
        `;
        faqsContainer.appendChild(faqItem);
        attachRemoveFaqListener(faqItem.querySelector('.remove-faq'));
    });

    function attachRemoveFaqListener(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            btn.closest('.faq-item').remove();
        });
    }

    document.querySelectorAll('.remove-faq').forEach(btn => {
        attachRemoveFaqListener(btn);
    });
</script>
@endsection
