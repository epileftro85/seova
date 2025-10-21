document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('metaForm');
    const previewContainer = document.getElementById('preview');
    const codeContainer = document.getElementById('codeOutput');
    const copyButton = document.getElementById('copyCode');

    // Function to generate robots meta tag value
    function generateRobotsValue() {
        const parts = [];
        if (document.getElementById('robotsIndex').checked) parts.push('index');
        else parts.push('noindex');
        
        if (document.getElementById('robotsFollow').checked) parts.push('follow');
        else parts.push('nofollow');
        
        if (document.getElementById('robotsSnippet').checked) parts.push('max-snippet');
        if (document.getElementById('robotsImage').checked) parts.push('max-image-preview:large');
        
        return parts.join(',');
    }

    // Function to count characters
    function updateCharCount(element, countElement) {
        const count = element.value.length;
        const countDisplay = document.getElementById(countElement);
        if (countDisplay) countDisplay.textContent = count;
    }

    // Function to generate meta tags
    function generateMetaTags() {
        const title = document.getElementById('pageTitle')?.value || '';
        const description = document.getElementById('metaDesc')?.value || '';
        const robots = generateRobotsValue();
        const canonical = document.getElementById('canonical')?.value || '';
        const ogTitle = document.getElementById('ogTitle')?.value || '';
        const ogDescription = document.getElementById('ogDesc')?.value || '';
        const ogImage = document.getElementById('ogImage')?.value || '';
        const keywords = document.getElementById('keywords')?.value || '';

        let metaTags = [];

        // Title tag (special preview treatment)
        if (title) {
            metaTags.push(`<title>${escapeHtml(title)}</title>`);
            previewContainer.innerHTML = `
                <div class="text-blue-600 text-xl hover:underline cursor-pointer mb-1">${escapeHtml(title)}</div>
                <div class="text-green-700 text-sm">${escapeHtml(canonical || 'example.com')}</div>
                <div class="text-gray-600 text-sm mt-1">${escapeHtml(description)}</div>
            `;
        } else {
            previewContainer.innerHTML = '<div class="text-sm text-gray-500">Fill in the form to see your meta tags preview.</div>';
        }

        // Basic meta tags
        if (description) metaTags.push(`<meta name="description" content="${escapeHtml(description)}">`);
        metaTags.push(`<meta name="robots" content="${escapeHtml(robots)}">`);
        if (canonical) metaTags.push(`<link rel="canonical" href="${escapeHtml(canonical)}">`);
        if (keywords) metaTags.push(`<meta name="keywords" content="${escapeHtml(keywords)}">`);

        // Open Graph meta tags
        if (ogTitle || title) metaTags.push(`<meta property="og:title" content="${escapeHtml(ogTitle || title)}">`);
        if (ogDescription || description) metaTags.push(`<meta property="og:description" content="${escapeHtml(ogDescription || description)}">`);
        if (ogImage) metaTags.push(`<meta property="og:image" content="${escapeHtml(ogImage)}">`);
        if (canonical) metaTags.push(`<meta property="og:url" content="${escapeHtml(canonical)}">`);
        metaTags.push(`<meta property="og:type" content="website">`);

        return metaTags;
    }

    // Function to escape HTML special characters
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // Function to update preview and code
    function updateOutput() {
        const metaTags = generateMetaTags();
        
        // Display formatted version with line breaks
        codeContainer.textContent = metaTags.join('\n');
        
        // Store clean version without line breaks for copying
        codeContainer.dataset.copyContent = metaTags.join('');
    }

    // Copy functionality
    if (copyButton) {
        copyButton.addEventListener('click', function() {
            const textToCopy = codeContainer.dataset.copyContent;
            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalText = copyButton.textContent;
                copyButton.textContent = 'Copied!';
                copyButton.disabled = true;
                setTimeout(() => {
                    copyButton.textContent = originalText;
                    copyButton.disabled = false;
                }, 2000);
            });
        });
    }

    // Character count updates
    const pageTitleInput = document.getElementById('pageTitle');
    if (pageTitleInput) {
        pageTitleInput.addEventListener('input', () => updateCharCount(pageTitleInput, 'titleCount'));
    }

    const metaDescInput = document.getElementById('metaDesc');
    if (metaDescInput) {
        metaDescInput.addEventListener('input', () => updateCharCount(metaDescInput, 'descCount'));
    }

    // Form change listeners
    if (form) {
        form.addEventListener('input', updateOutput);
        form.addEventListener('change', updateOutput);
    }

    // Initial update
    updateCharCount(pageTitleInput, 'titleCount');
    updateCharCount(metaDescInput, 'descCount');
    updateOutput();
});