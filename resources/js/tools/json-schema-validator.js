
document.addEventListener('DOMContentLoaded', () => {
    const schemaTextarea = document.getElementById('schema');
    const schemaExamplesDropdown = document.getElementById('schema-examples');
    const formatJsonButton = document.getElementById('format-json');
    const resultsDiv = document.getElementById('results');
    const form = document.getElementById('json-schema-validator-form');
    const highlighter = document.getElementById('highlighter');
    const errorTooltip = document.getElementById('error-tooltip');
    
    // Track error positions
    let currentErrors = [];
    
    // Update highlighter content to match textarea
    function updateHighlighter() {
        const text = schemaTextarea.value || '';
        const lines = text.split('\n');
        
        // Clear previous highlights
        highlighter.innerHTML = '';
        
        // Create line elements
        lines.forEach((line, index) => {
            const lineNumber = index + 1;
            const lineDiv = document.createElement('div');
            lineDiv.className = 'relative';
            
            // Add error class if this line has an error
            const lineError = currentErrors.find(err => err.line === lineNumber);
            if (lineError) {
                lineDiv.classList.add('error-line');
                lineDiv.setAttribute('data-error', lineError.message);
                
                const marker = document.createElement('span');
                marker.className = 'error-marker';
                marker.textContent = '!';
                marker.title = lineError.message;
                lineDiv.appendChild(marker);
            }
            
            // Add the line content
            const content = document.createElement('span');
            content.textContent = line || ' '; // Ensure empty lines take up space
            lineDiv.appendChild(content);
            
            highlighter.appendChild(lineDiv);
        });
    }
    
    // Show error tooltip
    function showErrorTooltip(element, message) {
        if (!element || !message) return;
        
        const rect = element.getBoundingClientRect();
        errorTooltip.textContent = message;
        errorTooltip.style.top = `${rect.top + window.scrollY - 30}px`;
        errorTooltip.style.left = `${rect.left + window.scrollX}px`;
        errorTooltip.classList.remove('hidden');
    }
    
    // Hide error tooltip
    function hideErrorTooltip() {
        errorTooltip.classList.add('hidden');
    }
    
    // Initialize highlighter
    schemaTextarea.addEventListener('input', updateHighlighter);
    schemaTextarea.addEventListener('scroll', () => {
        highlighter.scrollTop = schemaTextarea.scrollTop;
        highlighter.scrollLeft = schemaTextarea.scrollLeft;
    });
    
    // Handle hover on error lines
    highlighter.addEventListener('mousemove', (e) => {
        const target = e.target.closest('.error-line');
        if (target) {
            const errorMessage = target.getAttribute('data-error');
            showErrorTooltip(target, errorMessage);
        } else {
            hideErrorTooltip();
        }
    });
    
    highlighter.addEventListener('mouseleave', hideErrorTooltip);

    const jsonExamples = {
        product: `{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "title": "Product",
  "description": "A product from Acme's catalog",
  "type": "object",
  "properties": {
    "productId": {
      "description": "The unique identifier for a product",
      "type": "integer"
    },
    "productName": {
      "description": "Name of the product",
      "type": "string"
    },
    "price": {
      "type": "number",
      "exclusiveMinimum": 0
    },
    "tags": {
      "type": "array",
      "items": {
        "type": "string"
      }
    }
  },
  "required": ["productId", "productName", "price"]
}`,
        person: `{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "title": "Person",
  "description": "A person's profile",
  "type": "object",
  "properties": {
    "firstName": {
      "type": "string",
      "description": "The person's first name."
    },
    "lastName": {
      "type": "string",
      "description": "The person's last name."
    },
    "age": {
      "description": "Age in years",
      "type": "integer",
      "minimum": 0
    }
  },
  "required": ["firstName", "lastName"]
}`,
        event: `{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "title": "Event",
  "description": "An event happening at a specific time and place",
  "type": "object",
  "properties": {
    "eventName": {
      "type": "string",
      "description": "The name of the event."
    },
    "eventDate": {
      "type": "string",
      "format": "date",
      "description": "The date of the event (YYYY-MM-DD)."
    },
    "location": {
      "type": "string",
      "description": "The location where the event will take place."
    }
  },
  "required": ["eventName", "eventDate", "location"]
}`
    };

    // Handle schema examples dropdown
    schemaExamplesDropdown.addEventListener('change', (event) => {
        const selectedExample = event.target.value;
        if (selectedExample && jsonExamples[selectedExample]) {
            schemaTextarea.value = jsonExamples[selectedExample];
        } else {
            schemaTextarea.value = ''; // Clear if "Select a schema example" is chosen
        }
    });

    // Handle format JSON button
    formatJsonButton.addEventListener('click', () => {
        try {
            const currentJson = schemaTextarea.value;
            const parsedJson = JSON.parse(currentJson);
            schemaTextarea.value = JSON.stringify(parsedJson, null, 2);
            resultsDiv.innerHTML = ''; // Clear previous errors
        } catch (error) {
            resultsDiv.innerHTML = `<div class="text-red-500 text-sm mt-2">Invalid JSON: ${error.message}</div>`;
        }
    });

    // Parse error message to extract line and column numbers
    function parseErrorPosition(errorMessage) {
        // Try to match patterns like "at line X, column Y" or "on line X"
        const lineMatch = errorMessage.match(/line (\d+)/i);
        const columnMatch = errorMessage.match(/column (\d+)/i);
        
        const line = lineMatch ? parseInt(lineMatch[1], 10) : null;
        const column = columnMatch ? parseInt(columnMatch[1], 10) : null;
        
        return { line, column };
    }
    
    // Handle form submission (client-side validation and AJAX)
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        
        // Clear previous errors and results
        currentErrors = [];
        resultsDiv.innerHTML = '';
        updateHighlighter();
        
        const schema = schemaTextarea.value.trim();

        // Client-side JSON syntax validation
        try {
            JSON.parse(schema);
        } catch (error) {
            // Parse the error message to get line and column
            const { line } = parseErrorPosition(error.message);
            
            if (line) {
                // Adjust line number (error is usually reported on the line after the actual issue)
                const adjustedLine = Math.max(1, line - 1);
                
                currentErrors.push({
                    line: adjustedLine,
                    message: error.message
                });
                updateHighlighter();
                
                // Scroll to the error line
                scrollToLine(adjustedLine);
            }
            
            showError('Invalid JSON', [
                { message: error.message }
            ]);
            return;
        }

        // Show loading state
        resultsDiv.innerHTML = '<div class="text-blue-500 text-sm mt-2">Validating schema...</div>';

        // Send to server for schema validation
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ schema })
            });

            const data = await response.json();

            if (response.ok) {
                if (data.valid) {
                    showSuccess(data.message || 'Schema is valid!');
                } else {
                    // Process server-side validation errors
                    const errors = Array.isArray(data.errors) ? data.errors : [];
                    currentErrors = errors.map(error => {
                        const { line } = parseErrorPosition(error.message || '');
                        return {
                            line,
                            message: error.message || 'Validation error'
                        };
                    });
                    
                    updateHighlighter();
                    
                    // Scroll to the first error if available
                    if (currentErrors.length > 0 && currentErrors[0].line) {
                        scrollToLine(currentErrors[0].line);
                    }
                    
                    showError('Schema is invalid', errors);
                }
            } else {
                const errorMsg = data.message || 'An error occurred while validating the schema';
                showError(errorMsg, data.errors || []);
            }
        } catch (error) {
            showError(`An unexpected error occurred: ${error.message}`);
        }
    });
    
    // Scroll to a specific line in the textarea
    function scrollToLine(lineNumber) {
        const lines = schemaTextarea.value.split('\n');
        if (lineNumber < 1 || lineNumber > lines.length) return;
        
        // Calculate the position to scroll to
        const lineHeight = 24; // Should match your line height in pixels
        const scrollPosition = (lineNumber - 1) * lineHeight;
        
        // Smooth scroll to the position
        schemaTextarea.scrollTo({
            top: scrollPosition - 100, // Offset a bit above the line
            behavior: 'smooth'
        });
    }

    // Helper function to show success message
    function showSuccess(message) {
        resultsDiv.innerHTML = `
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">${message}</span>
            </div>`;
    }

    // Helper function to show error message
    function showError(message, errors = []) {
        let errorHtml = `
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">${message}</span>`;
        
        if (errors && errors.length > 0) {
            errorHtml += '<ul class="mt-2 list-disc list-inside">';
            errors.forEach(error => {
                errorHtml += `<li>${error.message || error}</li>`;
            });
            errorHtml += '</ul>';
        }
        
        errorHtml += '</div>';
        resultsDiv.innerHTML = errorHtml;
    }
});
