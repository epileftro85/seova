
/**
 * @file Enhances the quote form user experience with smooth scrolling,
 * accessibility improvements, and input normalization.
 */

let isInitialized = false;

/**
 * Initializes the quote form enhancements.
 * @param {HTMLElement} contactSection - The contact section element.
 */
function initQuoteForm(contactSection) {
  if (isInitialized || !contactSection) return;
  isInitialized = true;

  const form = contactSection.querySelector('form');
  const statusEl = contactSection.querySelector('#quote-status');
  const errorEls = contactSection.querySelectorAll('[role="alert"], .text-red-600');
  const websiteInput = document.getElementById('website');

  /**
   * Scrolls the contact section into view if there are status or error messages.
   */
  function scrollIntoView() {
    if (statusEl || (errorEls && errorEls.length > 0)) {
      try {
        contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      } catch (_) {
        contactSection.scrollIntoView(true);
      }
    }
  }

  /**
   * Sets focus on the status element for accessibility.
   */
  function focusOnStatus() {
    const firstError = errorEls.length > 0 ? errorEls[0] : null;
    if (firstError) {
      const input = firstError.parentElement.querySelector('input, select, textarea');
      if (input) {
        input.focus({ preventScroll: true });
        input.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    } else if (statusEl) {
      const hadTabindex = statusEl.hasAttribute('tabindex');
      if (!hadTabindex) statusEl.setAttribute('tabindex', '-1');
      statusEl.focus({ preventScroll: true });
      if (!hadTabindex) {
        statusEl.addEventListener('blur', () => statusEl.removeAttribute('tabindex'), { once: true });
      }
    }
  }

  /**
   * Normalizes a URL by ensuring it has a scheme.
   * @param {string} value - The URL to normalize.
   * @returns {string} The normalized URL.
   */
  function normalizeUrl(value) {
    if (!value || typeof value !== 'string') return value;
    let v = value.trim();
    const schemeNoSlashes = /^(https?):([^/].*)$/i;
    if (schemeNoSlashes.test(v)) {
      return v.replace(schemeNoSlashes, (_, s, rest) => `${s}://${rest}`);
    }
    if (!/^https?:\/\//i.test(v)) {
      v = 'https://' + v;
    }
    return v;
  }

  /**
   * Handles the blur event on the website input field.
   */
  function handleWebsiteInputBlur() {
    if (websiteInput) {
      const normalized = normalizeUrl(websiteInput.value);
      if (normalized !== websiteInput.value) {
        websiteInput.value = normalized;
      }
    }
  }

  /**
   * Handles the form submission event.
   */
  function handleFormSubmit() {
    if (websiteInput && websiteInput.value) {
      websiteInput.value = normalizeUrl(websiteInput.value);
    }
  }

  scrollIntoView();
  focusOnStatus();

  if (websiteInput) {
    websiteInput.addEventListener('blur', handleWebsiteInputBlur);
  }

  if (form) {
    form.addEventListener('submit', handleFormSubmit);
  }
}

document.addEventListener('DOMContentLoaded', () => {
  const contactSection = document.getElementById('contact');
  initQuoteForm(contactSection);
});

export { initQuoteForm };
