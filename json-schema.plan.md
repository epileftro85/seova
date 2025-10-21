# JSON Schema Validator Tool Implementation Plan

## Context

The goal is to create a new SEO tool that allows users to validate JSON schemas. This tool will be integrated into the existing `seova` Laravel application. The validation will be powered by the `jsonrainbow/json-schema` PHP package.

## Implementation Steps

- [X] **1. Install the Composer Package:**
  - Add the `jsonrainbow/json-schema` package to the `composer.json` file.
  - Run `composer update` to install the new dependency.

- [X] **2. Create the Controller Method:**
  - In `app/Http/Controllers/ToolsController.php`, create a new method `jsonSchemaValidator()` to handle the tool's logic.
  - This method will be responsible for rendering the view and processing the validation request.

- [X] **3. Create the Blade View:**
  - [X] Create a new Blade view file at `resources/views/tools/json-schema-validator.blade.php`.
  - [X] This view will contain the HTML form with a textarea for the user to paste their JSON schema.
  - [X] Add a button to format the JSON text in the textarea.
  - [X] Add a dropdown to select from a list of available schema examples (view element).
  - [X] It will also have a section to display the validation results (success or error messages).

- [X] **4. Create the Route:**
  - In `routes/web.php`, add a new route for the JSON schema validator tool.
  - The route will point to the `jsonSchemaValidator()` method in the `ToolsController`.

- [X] **5. Implement the Validation Logic:**
  - In the `jsonSchemaValidator()` method, add the logic to handle the form submission.
  - Get the JSON schema from the request.
  - Use the `jsonrainbow/json-schema` package to validate the schema.
  - Pass the validation results back to the view.

- [X] **6. Add a Link to the Home Page:**
  - In `resources/views/home.blade.php`, add a new link to the "Free SEO tools for everyone" section for the JSON Schema Validator tool.

- [ ] **7. Create a JavaScript file for the tool:**
  - Create a new JavaScript file at `resources/js/tools/json-schema-validator.js`.
  - Add a function to validate the JSON for syntax errors before sending it to the server.
  - Implement the logic to handle the schema examples dropdown, inserting the selected example into the textarea.
  - This file will handle the form submission asynchronously and display the results without a page reload.

- [ ] **8. Add the new tool to `vite.config.js`:**
  - Add the new JavaScript file to the `input` array in `vite.config.js`.

- [ ] **9. Write Tests:**
  - Create a new test file at `tests/Feature/JsonSchemaValidatorTest.php`.
  - Write tests to ensure the tool is working correctly.
  - Test both valid and invalid JSON schemas.
