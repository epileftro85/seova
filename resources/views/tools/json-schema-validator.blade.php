@extends('layouts.app')

@section('title', 'JSON Schema Validator')

@push('styles')
<style>
    #editor {
        position: relative;
        min-height: 20rem;
    }

    #highlighter {
        white-space: pre;
        padding: 0.75rem;
        line-height: 1.5;
        overflow: hidden;
        pointer-events: none;
    }

    #schema {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        resize: none;
        white-space: pre;
        overflow: auto;
        tab-size: 2;
    }

    .error-line {
        position: relative;
        background-color: #fef2f2;
        border-left: 3px solid #ef4444;
        margin-left: -3px;
        padding-left: 0.25rem;
    }

    .error-line:hover {
        background-color: #fee2e2;
    }

    .error-marker {
        position: absolute;
        left: -1.5rem;
        color: #ef4444;
        font-weight: bold;
        cursor: help;
    }

    /* Hide the default scrollbar and use a custom one */
    #schema::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    #schema::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    #schema::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 4px;
    }

    #schema::-webkit-scrollbar-thumb:hover {
        background: #a0aec0;
    }
</style>
@endpush

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 style="color: red; font-size: 1.5rem;">Revisar como validar algo mas bonito al igual que hace https://search.google.com/test/rich-results/result?id=JdzLS60HCiONeMcdfmHa5Q</h1>
        <h1 class="text-3xl font-bold mb-4">JSON Schema Validator</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form id="json-schema-validator-form" action="{{ route('tools.json-schema-validator.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="schema" class="block text-gray-700 text-sm font-bold mb-2">JSON Schema:</label>
                    <div class="relative">
                        <div id="editor" class="relative">
                            <div id="highlighter" class="absolute inset-0 font-mono text-transparent pointer-events-none overflow-hidden" aria-hidden="true"></div>
                            <textarea 
                                id="schema" 
                                name="schema" 
                                rows="10" 
                                class="relative z-10 w-full h-64 p-3 font-mono text-gray-700 bg-transparent border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none resize-y"
                                style="caret-color: #1a202c;"
                                spellcheck="false"
                            ></textarea>
                        </div>
                        <div id="error-tooltip" class="hidden absolute z-20 p-2 -mt-2 text-sm text-white bg-red-500 rounded shadow-lg"></div>
                    </div>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <button type="button" id="format-json" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Format JSON
                    </button>

                    <div class="relative">
                        <select id="schema-examples" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Select a schema example</option>
                            <option value="product">Product</option>
                            <option value="person">Person</option>
                            <option value="event">Event</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Validate
                    </button>
                </div>
            </form>

            <div id="results" class="mt-6"></div>
        </div>

        <div class="mt-16 prose prose-seova max-w-none">
    <h2 id="why-json-schema" class="text-2xl font-bold mb-6">Why JSON Schema Validation is Essential</h2>
    <p class="text-gray-600 mb-8">JSON Schema is a powerful tool for <strong>validating the structure of JSON data</strong> and ensuring data integrity across your applications. Proper schema validation can prevent data-related bugs, improve API reliability, and make your data more maintainable and self-documenting.</p>

    <h3 class="text-xl font-semibold mb-4">Key Benefits of JSON Schema</h3>
    <div class="space-y-6">
        <div>
            <h4 class="font-medium mb-2">🔍 Data Validation</h4>
            <p class="text-gray-600">Ensure your JSON data matches the expected structure and format before processing. This catches errors early and makes your applications more robust against malformed data.</p>
        </div>

        <div>
            <h4 class="font-medium mb-2">📝 Self-Documenting Data</h4>
            <p class="text-gray-600">JSON Schema serves as living documentation for your data structures, making it easier for developers to understand the expected format and requirements of your JSON data.</p>
        </div>

        <div>
            <h4 class="font-medium mb-2">🤝 Improved Developer Experience</h4>
            <p class="text-gray-600">With proper schema validation, developers get immediate feedback when their JSON doesn't match the expected format, speeding up development and reducing debugging time.</p>
        </div>

        <div>
            <h4 class="font-medium mb-2">🚀 Performance Optimization</h4>
            <p class="text-gray-600">By validating data structure before processing, you can fail fast and avoid unnecessary processing of invalid data, improving overall application performance.</p>
        </div>
    </div>

    <h3 class="text-xl font-semibold mt-10 mb-4">Best Practices for JSON Schema</h3>
    <div class="space-y-4">
        <div class="flex items-start">
            <div class="flex-shrink-0 h-6 w-6 text-seova-orange">✓</div>
            <div>
                <strong>Always include $schema</strong> - Specify which version of JSON Schema you're using (e.g., draft-07)
            </div>
        </div>
        <div class="flex items-start">
            <div class="flex-shrink-0 h-6 w-6 text-seova-orange">✓</div>
            <div>
                <strong>Use descriptive titles and descriptions</strong> - Help other developers understand the purpose of each field
            </div>
        </div>
        <div class="flex items-start">
            <div class="flex-shrink-0 h-6 w-6 text-seova-orange">✓</div>
            <div>
                <strong>Be specific with types</strong> - Use the most specific type possible (e.g., "email" format for email addresses)
            </div>
        </div>
        <div class="flex items-start">
            <div class="flex-shrink-0 h-6 w-6 text-seova-orange">✓</div>
            <div>
                <strong>Define required fields</strong> - Explicitly list which properties are required
            </div>
        </div>
    </div>

    <h3 class="text-xl font-semibold mt-10 mb-4">Common Validation Patterns</h3>
    <div class="space-y-6">
        <div>
            <h4 class="font-medium mb-2">Basic Object Validation</h4>
            <pre class="bg-gray-100 p-4 rounded text-sm overflow-x-auto">
{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "type": "object",
  "required": ["name", "email"],
  "properties": {
    "name": { "type": "string", "minLength": 1 },
    "email": { "type": "string", "format": "email" },
    "age": { "type": "number", "minimum": 0 }
  }
}</pre>
        </div>

        <div>
            <h4 class="font-medium mb-2">Array Validation</h4>
            <pre class="bg-gray-100 p-4 rounded text-sm overflow-x-auto">
{
  "type": "array",
  "items": {
    "type": "object",
    "required": ["id", "value"],
    "properties": {
      "id": { "type": "number" },
      "value": { "type": "string" }
    }
  },
  "minItems": 1,
  "uniqueItems": true
}</pre>
        </div>
    </div>
</div>
    </div>
@endsection

@push('scripts')
    @vite('resources/js/tools/json-schema-validator.js')
@endpush
