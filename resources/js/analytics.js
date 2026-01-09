/**
 * @file Analytics wrapper for GA4 and Meta Pixel (CAPI ready).
 */

/**
 * Generates a unique Event ID for deduplication (CAPI + Pixel).
 * @returns {string} Unique ID
 */
function generateEventID() {
    return 'evt_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
}

/**
 * Maps custom event names to Meta Standard Events.
 * @param {string} eventName 
 * @returns {string|null} Meta Standard Event Name or null
 */
function mapToMetaEvent(eventName) {
    const map = {
        'quote_form_submit': 'Lead',
        'quote_modal_open': 'Contact',
        'hero_cta_quote': 'InitiateCheckout',
        'nav_cta_quote': 'InitiateCheckout',
        'view_blog_post': 'ViewContent'
    };
    return map[eventName] || null;
}

/**
 * Initializes the analytics stub.
 */
function initAnalytics() {
  if (!window.SeovaAnalytics) {
    window.SeovaAnalytics = {
      
      generateEventID: generateEventID,

      /**
       * Tracks an event to all configured providers.
       * @param {string} eventName - The name of the event.
       * @param {object} [data={}] - Additional data to send.
       * @param {object} [options={}] - Meta options (e.g. { eventID: '...' })
       */
      track: function (eventName, data = {}, options = {}) {
        // 1. Google Analytics
        if (window.gtag) {
          window.gtag('event', eventName, data);
        }

        // 2. Meta Pixel
        if (window.fbq) {
            const metaEvent = mapToMetaEvent(eventName);
            if (metaEvent) {
                // If it's a standard event, track as standard
                window.fbq('track', metaEvent, data, options);
            } else {
                // Otherwise track as custom
                window.fbq('trackCustom', eventName, data, options);
            }
        }
      },

      /**
       * Alias for track.
       */
      event: function (name, data, options) { this.track(name, data, options); }
    };
  }
}

/**
 * Fires an analytics event from the DOM.
 * @param {string} eventName - The name of the event.
 * @param {Event|null} e - The event object (optional).
 * @param {object} [data={}] - Additional data.
 * @param {object} [options={}] - Options like eventID.
 */
function fireAnalytics(eventName, e, data = {}, options = {}) {
    let eventData = { ...data, path: location.pathname, ts: Date.now() };

    if (e && e.target) {
        const target = e.target.closest('[data-analytics-event]');
        if (target) {
            const name = target.getAttribute('data-analytics-event');
            if (name) {
                eventData.element_name = name;
            }
        }
    }

    try {
        window.SeovaAnalytics.event(eventName, eventData, options);
    } catch (_) {
        // Analytics failure should not break user experience
        console.warn('Analytics Error:', _);
    }
}

// Expose globally for Blade templates
window.fireAnalytics = fireAnalytics;

initAnalytics();

export { fireAnalytics };