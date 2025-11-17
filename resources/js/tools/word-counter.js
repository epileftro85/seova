document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const content = document.getElementById('content');
    const wordCount = document.getElementById('wordCount');
    const charCount = document.getElementById('charCount');
    const charNoSpaces = document.getElementById('charNoSpaces');
    const sentenceCount = document.getElementById('sentenceCount');
    const paragraphCount = document.getElementById('paragraphCount');
    const readingTime = document.getElementById('readingTime');
    const clearBtn = document.getElementById('clearText');
    const copyBtn = document.getElementById('copyText');

    // Update stats in real-time as user types/pastes
    content.addEventListener('input', updateStats);

    // Clear button
    clearBtn.addEventListener('click', () => {
        content.value = '';
        updateStats();
    });

    // Copy button
    copyBtn.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(content.value);
            copyBtn.textContent = 'Copied!';
            setTimeout(() => copyBtn.textContent = 'Copy', 2000);
        } catch (err) {
            // Silently fail if clipboard access is denied
        }
    });

    function updateStats() {
        const text = content.value;
        
        // Word count (split by whitespace and filter empty strings)
        const words = text.trim().split(/\s+/).filter(word => word.length > 0).length;
        wordCount.textContent = words.toLocaleString();
        
        // Character counts
        const chars = text.length;
        const charsNoSpace = text.replace(/\s+/g, '').length;
        charCount.textContent = chars.toLocaleString();
        charNoSpaces.textContent = `${charsNoSpace.toLocaleString()} excluding spaces`;
        
        // Sentence count (split by .!? followed by space)
        const sentences = text.trim().split(/[.!?]+\s+/).filter(sentence => sentence.length > 0).length;
        sentenceCount.textContent = sentences.toLocaleString();
        
        // Paragraph count (split by double newline)
        const paragraphs = text.trim().split(/\n\s*\n/).filter(para => para.length > 0).length;
        paragraphCount.textContent = paragraphs.toLocaleString();
        
        // Reading time (based on 200 words per minute)
        const minutes = Math.ceil(words / 200);
        readingTime.textContent = `${minutes} min${minutes !== 1 ? 's' : ''}`;
    }
});