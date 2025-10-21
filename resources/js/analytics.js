/**
 * @file Provides a stub for analytics events.
 */

/**
 * Initializes the analytics stub.
 */
function initAnalytics() {
  if (!window.SeovaAnalytics) {
    window.SeovaAnalytics = {
      /**
       * Tracks an event.
       * @param {string} eventName - The name of the event.
       * @param {object} [data={}] - Additional data to send with the event.
       */
      track: function (eventName, data) {
        console.log('Analytics event:', eventName, data);
      },
      /**
       * Alias for track.
       * @param {string} name - The name of the event.
       * @param {object} [data={}] - Additional data to send with the event.
       */
      event: function (name, data) { this.track(name, data); }
    };
  }
}

/**
 * Fires an analytics event.
 * @param {string} eventName - The name of the event.
 * @param {Event|null} e - The event object.
 * @param {object} [data={}] - Additional data to send with the event.
 */
function fireAnalytics(eventName, e, data = {}) {
    let eventData = { ...data, path: location.pathname, ts: Date.now() };

    if (e) {
        const target = e.target.closest('[data-analytics-event]');
        if (target) {
            const name = target.getAttribute('data-analytics-event');
            if (name) {
                eventData.name = name;
            }
        }
    }

    try {
        window.SeovaAnalytics.event(eventName, eventData);
    } catch (_) {
        // Analytics failure should not break user experience
    }
}

initAnalytics();

export { fireAnalytics };