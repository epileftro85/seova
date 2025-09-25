# AI Agent SEO & Accessibility Code Audit Checklist

This checklist provides a step-by-step guide for an AI agent to audit a website's code for SEO and accessibility best practices, specifically within a code editor environment.

---

### 1. **URL Structure**
[ ] Ensure URLs are clean and descriptive.
    - [ ] The code should use URLs that are readable and include relevant keywords.
    - [ ] URLs should avoid using long strings of numbers or irrelevant characters.
    - [ ] Verify that hyphens (-) are used to separate words, not underscores (_).

---

### 2. **Meta Tags**
[ ] Verify the presence and quality of meta tags on each page.
    - [ ] **Title Tag:** Check for a unique, concise, and keyword-rich `<title>` tag on every page.
        - [ ] The title should be between 50-60 characters.
        - [ ] **Accessibility:** The title tag is descriptive and unique to help users with screen readers understand the page's purpose.
    - [ ] **Meta Description:** Audit the `<meta name="description">` for each page.
        - [ ] The description should be compelling and summarize the page's content.
        - [ ] It should be between 150-160 characters.

---

### 3. **Header Tags (H1, H2, etc.)**
[ ] Check the structure and use of heading tags.
    - [ ] **H1 Tag:** Confirm each page has a single `<h1>` tag.
        - [ ] The `<h1>` should be the most important heading and contain the main keyword.
    - [ ] **H2, H3, H4, etc.:** Ensure heading tags are used in a logical, hierarchical order to structure content.
        - [ ] They should break up content and use relevant keywords and phrases.
    - [ ] **Accessibility:** Heading tags must be used to create a clear content hierarchy, allowing users with screen readers to navigate the page easily.
        - [ ] Avoid skipping heading levels (e.g., going from H1 to H3).
        - [ ] Headings should be used for section titles, not just for styling.

---

### 4. **Image Optimization & Accessibility**
[ ] Review image elements for proper optimization and accessibility.
    - [ ] **Alt Attributes:** Check that all `<img>` tags have a descriptive `alt` attribute.
        - [ ] The `alt` text should accurately describe the image's content and function.
        - [ ] For decorative images, the `alt` attribute should be empty (`alt=""`).
    - [ ] **File Names:** Ensure image file names are descriptive and use hyphens.
    - [ ] **Responsiveness:** Confirm images are responsive and display well on all devices, often using the `<picture>` element or `srcset` attribute.

---

### 5. **Internal and External Links**
[ ] Audit the linking structure.
    - [ ] **Internal Links:** Check for logical internal linking between pages using relevant anchor text.
        - [ ] Anchor text should be descriptive and not generic (e.g., avoid "click here").
    - [ ] **External Links:** Verify that any external links have the `rel="noopener noreferrer"` attribute and open in a new tab (`target="_blank"`).
    - [ ] **Accessibility:** Links must have clear and descriptive anchor text that makes sense out of context.

---

### 6. **Performance & Code Quality**
[ ] Evaluate factors affecting page load speed directly in the code.
    - [ ] **Code Minification:** Check if HTML, CSS, and JavaScript files appear to be minified to remove unnecessary characters and whitespace.
    - [ ] **Script Loading:** Look for the use of `async` or `defer` attributes on `<script>` tags to prevent render-blocking resources.
    - [ ] **CSS in the Head:** Identify and flag any non-critical CSS that is loaded in the `<head>` section, as it can be render-blocking.

---

### 7. **Mobile-Friendliness & Responsive Design**
[ ] Ensure the website is fully responsive.
    - [ ] **Viewport Meta Tag:** Confirm the presence of the `<meta name="viewport">` tag in the `<head>` section to ensure proper scaling on mobile devices.
    - [ ] **CSS Media Queries:** Check for the use of CSS media queries to adapt the layout to different screen sizes.

---

### 8. **Semantic HTML & ARIA Attributes**
[ ] Check if the code uses proper semantic tags and ARIA attributes for enhanced accessibility.
    - [ ] **HTML5 Tags:** Look for the use of modern HTML5 tags like `<header>`, `<nav>`, `<main>`, `<article>`, `<section>`, and `<footer>` to improve code structure and accessibility.
    - [ ] **Form Elements:** Ensure all form inputs have a corresponding `<label>` tag with a matching `for` attribute.
    - [ ] **ARIA Roles and States:** Check for the correct use of ARIA attributes (`aria-label`, `aria-describedby`, `role`, etc.) on interactive elements that are not natively accessible (e.g., custom buttons, tabs).
    - [ ] **Keyboard Accessibility:** Ensure all interactive elements are operable using only a keyboard by checking for logical tab order.

---

### 9. **Structured Data**
[ ] Look for structured data on key pages.
    - [ ] **JSON-LD Syntax:** Verify that structured data (e.g., JSON-LD) is present and the syntax is valid JSON.

---

### 10. **Color Contrast & Accessibility**
[ ] Audit for sufficient color contrast and accessibility best practices.
    - [ ] **CSS Properties:** Check the CSS for any hard-coded color values. Recommend using CSS variables or a consistent design system for easier management of contrast ratios.
    - [ ] **Accessibility:** Identify areas where color is the only means of conveying information (e.g., using only red text for errors), and flag if there is no alternative indicator.

---

### 11. **Multimedia Accessibility**
[ ] Check for accessibility of any audio or video content.
    - [ ] **Captions/Subtitles:** Verify that `<video>` elements have a `<track>` element for captions or subtitles.
    - [ ] **Transcripts:** For audio-only content, recommend providing a transcript.
    - [ ] **Audio Descriptions:** For videos with important visual information, recommend an audio description track.
