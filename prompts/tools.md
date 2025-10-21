# SEO mini tools

This site is meant to be a SEO agency with 21 mini tools, here are a list of this mini tools. The SERP visualizer tool is already done, this is the example that the client wants.


## Rules

- All views should be into **/resources/views/tools**.
- All Javasccript files should be in **/resources/js/tools**.
- Do not use inline css, if you need an special css create a custom css file in **/resources/css/tools**. and load it only for that tool (**Try to not use extra css**)
- All routes should be in the tools route group.
- The controller should be clean, just the call to the corresponding Service. All controller handlers should be in the same Controller **ToolsController** Do not create controller for each tool.
- Use a service for each tool, example **/app/Http/Controllers/Services/Tools/WordCounterService.php** this should hold all the logid needed for this tool.
- Use SOLID principles alongside Laravel good practices.
- **IMPORTANT** All tool **should be have the majority in javascript**, if backend is needed show to the user the plan before continue.
- All tools should have clean design and excelent SEO content.
- Add the new tool to the navigation into partials/navbar.blade.php and into /tools/index.blade.php
- Create JSON-Schema for the tool into StructuredDataService with valid json schema and FAQ node and loaded to the view.

**IMPORTANT** The Keyword Explorer tool is our of scope for now, there is a view, controller and route but those are deprecated for now.

**IMPORTANT** Every time a tool is created and finished, ask the user if the tool is as the client wants, if so, mark the tool as finished with an X into brackets like: [X]

1. [X] **Word and Character Counter**: Counts the number of words, characters (with and without spaces), and paragraphs in a text. Useful for optimizing content length and keyword density.

2. [X] **SERP Visualizer**: Previews how a page's title and meta description will appear on Google's search results page (SERP). Helps in crafting click-worthy snippets.

3. [ ] **Meta Tag Generator**: Creates the basic structure for meta tags (title, description, robots) based on user-provided information, ensuring proper page indexing.

4. [ ] **SEO-Friendly URL Generator**: Converts a text string (e.g., a page title) into an optimized URL slug, replacing spaces with hyphens and converting to lowercase.

5. [ ] **Link Extractor**: Scans a given URL and lists all internal and external links found on the page, useful for quick link audits.

6. [ ] **Header Structure Checker (H1, H2, etc.)**: Analyzes a web page's content to display the hierarchy of its header tags, ensuring logical content structure for search engines.

7. [ ] **Image Optimizer**: Compresses images and suggests SEO-friendly filenames (e.g., my-cool-product.jpg), improving page load speed.

8. [ ] **Readability Checker**: Analyzes a text and provides a readability score based on metrics like the Flesch-Kincaid index, making content more accessible to users.

9. [ ] **FAQ Schema Generator**: Creates the JSON-LD code for a Frequently Asked Questions schema, enhancing a page's visibility in search results with rich snippets.

10. [ ] **Long-Tail Keyword Suggestor**: Takes a primary keyword and generates related long-tail keyword ideas, helping to target specific search queries.

11. [ ] **Search Intent Analyzer**: Classifies a keyword's search intent (informational, transactional, navigational, commercial) to guide content creation.

12. [ ] **Content Keyword Extractor**: Analyzes a block of text and extracts the most relevant keywords, showing their frequency to assist with content optimization.

13. [ ] **Keyword Grouping Tool**: Allows a user to paste a list of keywords and organizes them into clusters based on semantic similarity.

14. [ ] **Redirect Checker**: Traces the redirection path of a URL to verify that it is correctly configured (e.g., a 301 redirect).

15. [ ] **robots.txt Generator**: Creates a basic or advanced robots.txt file based on user-specified allow/disallow rules, controlling how search bots crawl a site.

16. [ ] **sitemap.xml Generator**: Generates a basic sitemap.xml file from a list of URLs provided by the user, helping search engines discover a site's pages.

17. [ ] **hreflang Tag Checker**: Validates the implementation of hreflang tags on a page, which is essential for proper international SEO.

18. [ ] **Broken Link Checker**: Scans a web page to identify and report any links that lead to a "404 Not Found" error.

19. [ ] **Brand Mention Extractor**: Searches a text for mentions of a specific brand, identifying potential link-building opportunities.

20. [ ] **CPC & Search Volume Calculator**: (Requires API access) Estimates the Cost Per Click and search volume for keywords, useful for paid and organic search strategy.

21. [ ] **SVG Optimizer and Minifier**: Takes an SVG file, URL, or code, and simplifies it by removing superfluous information, minifying the code, and ensuring it remains valid for faster load times.