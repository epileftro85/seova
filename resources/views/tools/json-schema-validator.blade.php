@extends('layouts.app')

@section('title', 'JSON Schema Validator')
@section('description', 'Validate your JSON-LD schemas with our free online tool. Ensure your structured data is correct and error-free for better SEO.')

@section('og_title', 'JSON Schema Validator | Seova Free SEO Tool')
@section('og_description', 'Validate your JSON-LD schemas with our free online tool. Ensure your structured data is correct and error-free for better SEO.')
@section('twitter_title', 'JSON Schema Validator | Seova Free SEO Tool')
@section('twitter_description', 'Validate your JSON-LD schemas with our free online tool. Ensure your structured data is correct and error-free for better SEO.')

@inject('structuredData', 'App\Services\StructuredDataService')
@section('json-ld')
<script type="application/ld+json">
{!! json_encode($structuredData->jsonSchemaValidatorStructuredData(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

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
<section class="max-w-6xl mx-auto px-6 py-12" aria-labelledby="json-schema-validator-heading">
    <header class="mb-8">
        <h1 id="json-schema-validator-heading" class="text-3xl font-bold tracking-tight">JSON Schema Validator</h1>
        <p class="mt-2 text-gray-600">Validate your JSON data against schemas to ensure data integrity and structure compliance. Test your JSON-LD, API responses, and structured data.</p>
    </header>

    <div class="grid gap-10 md:grid-cols-2 items-start">
        <!-- Left: Form Input -->
        <div class="space-y-6">
            <form id="json-schema-validator-form" action="{{ route('tools.json-schema-validator.store') }}" method="POST" aria-labelledby="json-form-heading">
                <h2 id="json-form-heading" class="sr-only">JSON Schema Validation Form</h2>
                @csrf
                <div class="mb-4">
                    <label for="schema" class="block mb-1 font-medium">JSON Schema:</label>
                    <div @class(['relative'])>
                        <div id="editor" class="relative">
                            <div id="highlighter" class="absolute inset-0 font-mono text-transparent pointer-events-none overflow-hidden" aria-hidden="true"></div>
                            <textarea 
                                id="schema" 
                                name="schema" 
                                rows="10" 
                                class="relative z-10 w-full h-64 p-3 font-mono text-gray-700 bg-transparent border rounded-md focus:ring-seova-orange focus:border-seova-orange focus:outline-none resize-y"
                                style="caret-color: #1a202c;"
                                spellcheck="false"
                                placeholder='{"$schema": "http://json-schema.org/draft-07/schema#", "type": "object"}'
                            ></textarea>
                        </div>
                        <div id="error-tooltip" class="hidden absolute z-20 p-2 -mt-2 text-sm text-white bg-red-500 rounded shadow-lg"></div>
                    </div>
                </div>

                <div class="flex flex-wrap items-end gap-4 mb-4">
                    <button type="button" id="format-json" class="bg-seova-orange text-white px-5 py-2 rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2">
                        Format JSON
                    </button>

                    <div class="flex-1 min-w-[200px]">
                        <label for="schema-examples" class="block mb-1 text-sm font-medium">Load Example</label>
                        <div class="relative">
                            <select id="schema-examples" class="appearance-none border rounded-md py-2 pl-3 pr-10 focus:ring-seova-orange focus:border-seova-orange w-full bg-white">
                                <option value="">Select a schema example</option>
                                <option value="product">Product Schema</option>
                                <option value="person">Person Schema</option>
                                <option value="event">Event Schema</option>
                            </select>
                            <svg class="pointer-events-none w-4 h-4 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    <button type="submit" class="ml-auto bg-seova-green text-white px-5 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-seova-green focus:ring-offset-2">
                        Validate Schema
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Results Panel -->
        <div class="space-y-6 md:sticky md:top-24" aria-live="polite">
            <div>
                <h2 class="text-xl font-semibold mb-4">Validation Results</h2>
                <div id="results" class="bg-white border rounded-lg p-4">
                    <div class="text-sm text-gray-500">Your validation results will appear here.</div>
                </div>
            </div>

            <div class="bg-white border rounded-lg p-4 text-xs text-gray-600">
                <p><strong>Tips:</strong></p>
                <ul class="list-disc ml-5 space-y-1">
                    <li>Always include the $schema property to specify the JSON Schema version</li>
                    <li>Use descriptive titles and descriptions for better documentation</li>
                    <li>Define required fields explicitly to catch missing data early</li>
                    <li>Test with both valid and invalid data to ensure robust validation</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-16 prose prose-seova max-w-none">
        <h2 id="why-json-schema" class="text-2xl font-bold mb-6">Why JSON Schema Validation Is Critical for Data Integrity</h2>
        <p class="text-gray-600 mb-8"><strong>JSON Schema validation</strong> is the cornerstone of reliable data handling in modern web applications. By defining and enforcing data structure rules, <strong>schema validation</strong> prevents costly errors, improves <strong>API reliability</strong>, and ensures <strong>data consistency</strong> across your entire application ecosystem. Organizations using proper schema validation report up to 80% fewer data-related bugs in production.</p>

        <h3 class="text-xl font-semibold mb-4">Core Benefits of JSON Schema Validation</h3>
        <div class="space-y-6">
            <div>
                <h4 class="font-medium mb-2">🔍 Automated Data Validation</h4>
                <p class="text-gray-600">Catch <strong>data structure errors</strong> before they reach your application logic. <strong>JSON Schema</strong> validates data types, required fields, format constraints, and value ranges automatically, preventing malformed data from causing runtime errors or security vulnerabilities.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">📝 Self-Documenting API Contracts</h4>
                <p class="text-gray-600">Your <strong>JSON Schema</strong> serves as living <strong>API documentation</strong> that's always in sync with your code. Teams can understand data requirements instantly, reducing onboarding time and integration errors when working with <strong>RESTful APIs</strong> or <strong>GraphQL endpoints</strong>.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🤝 Enhanced Developer Productivity</h4>
                <p class="text-gray-600">Enable <strong>IDE auto-completion</strong>, real-time validation, and type checking with JSON Schema. Developers receive immediate feedback about data structure issues, dramatically reducing <strong>debugging time</strong> and accelerating the development cycle.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🚀 Improved Application Performance</h4>
                <p class="text-gray-600">Implement <strong>fail-fast validation</strong> to reject invalid data at the entry point, preventing unnecessary processing, database operations, and error handling overhead. This approach improves both <strong>response times</strong> and <strong>system scalability</strong>.</p>
            </div>

            <div>
                <h4 class="font-medium mb-2">🔒 Enhanced Security & Compliance</h4>
                <p class="text-gray-600">Validate input data structure to prevent <strong>injection attacks</strong> and ensure <strong>data compliance</strong> with regulations like GDPR. Schema validation acts as a security layer by enforcing strict data formats and rejecting unexpected properties.</p>
            </div>
        </div>

        <h3 class="text-xl font-semibold mt-12 mb-4">JSON Schema Best Practices for Production</h3>
        <div class="space-y-4 text-gray-600">
            <p>Follow these industry-standard practices to create robust, maintainable JSON schemas:</p>

            <ol class="list-decimal pl-6 space-y-3">
                <li><strong>Always declare the $schema property</strong> - Specify your JSON Schema version (e.g., <code>"$schema": "http://json-schema.org/draft-07/schema#"</code>) for consistent validation behavior across tools and libraries.</li>
                <li><strong>Use descriptive metadata</strong> - Include <code>title</code> and <code>description</code> properties to document the purpose of each schema and field, making your API self-documenting.</li>
                <li><strong>Leverage format validators</strong> - Use built-in formats like <code>email</code>, <code>uri</code>, <code>date-time</code>, and <code>ipv4</code> instead of custom regex patterns when possible.</li>
                <li><strong>Explicitly define required fields</strong> - List all mandatory properties in the <code>required</code> array to prevent incomplete data submissions.</li>
                <li><strong>Set appropriate constraints</strong> - Use <code>minLength</code>, <code>maxLength</code>, <code>minimum</code>, <code>maximum</code>, and <code>pattern</code> to enforce business rules at the validation layer.</li>
                <li><strong>Validate nested structures</strong> - Define schemas for complex nested objects and arrays to ensure complete data integrity throughout your JSON hierarchy.</li>
            </ol>
        </div>

        <h3 class="text-xl font-semibold mt-12 mb-4">Common JSON Schema Patterns & Examples</h3>
        <div class="space-y-6">
            <div>
                <h4 class="font-medium mb-2">User Profile Validation</h4>
                <pre class="bg-gray-50 border rounded-lg p-4 text-sm overflow-x-auto font-mono">{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "title": "User Profile",
  "type": "object",
  "required": ["name", "email"],
  "properties": {
    "name": {
      "type": "string",
      "minLength": 1,
      "maxLength": 100
    },
    "email": {
      "type": "string",
      "format": "email"
    },
    "age": {
      "type": "integer",
      "minimum": 0,
      "maximum": 150
    },
    "website": {
      "type": "string",
      "format": "uri"
    }
  },
  "additionalProperties": false
}</pre>
            </div>

            <div>
                <h4 class="font-medium mb-2">Product List Validation</h4>
                <pre class="bg-gray-50 border rounded-lg p-4 text-sm overflow-x-auto font-mono">{
  "$schema": "http://json-schema.org/draft-07/schema#",
  "title": "Product List",
  "type": "array",
  "items": {
    "type": "object",
    "required": ["id", "name", "price"],
    "properties": {
      "id": {
        "type": "string",
        "pattern": "^[A-Z]{3}-[0-9]{4}$"
      },
      "name": {
        "type": "string",
        "minLength": 3
      },
      "price": {
        "type": "number",
        "minimum": 0,
        "exclusiveMinimum": true
      },
      "inStock": {
        "type": "boolean"
      }
    }
  },
  "minItems": 1,
  "uniqueItems": true
}</pre>
            </div>
        </div>

        <div class="bg-gray-50 border rounded-lg p-6 mt-8">
            <h4 class="font-medium mb-3">💡 Pro Tips for Schema Design</h4>
            <ul class="list-disc pl-6 space-y-2 text-gray-600">
                <li>Use <code>additionalProperties: false</code> to prevent unexpected fields in production APIs</li>
                <li>Version your schemas and maintain backward compatibility for smooth API evolution</li>
                <li>Test schemas with both valid and invalid data to ensure comprehensive coverage</li>
                <li>Consider using JSON Schema generators for complex objects to reduce manual errors</li>
                <li>Integrate schema validation into your CI/CD pipeline for automated testing</li>
                <li>Use schema composition with <code>$ref</code>, <code>allOf</code>, <code>oneOf</code> to avoid duplication</li>
            </ul>
        </div>

        <p class="mt-8">Ready to validate your JSON? Use our free JSON Schema Validator tool above to test your schemas instantly and ensure your data meets all required specifications.</p>
    </div>
</section>
@endsection

@push('scripts')
    @vite('resources/js/tools/json-schema-validator.js')
@endpush
