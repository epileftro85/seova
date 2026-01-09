/**
 * Cookie Consent Management
 * Handles displaying the banner and storing user preferences.
 */

document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('cookie-banner');
    const acceptBtn = document.getElementById('cookie-accept');
    const declineBtn = document.getElementById('cookie-decline');
    
    // Check if user has already made a choice
    const consent = localStorage.getItem('cookie_consent');

    // If no choice yet, show banner
    if (consent === null) {
        if (banner) {
            banner.style.display = 'block';
            // Small delay to allow transition if we add one later, or just remove class
            requestAnimationFrame(() => {
                banner.classList.remove('translate-y-full');
            });
        }
    } else {
        // If consent previously granted, ensure we fire the event for scripts that load late
        if (consent === 'granted') {
            window.dispatchEvent(new CustomEvent('cookie-consent-granted'));
        }
    }

    if (acceptBtn) {
        acceptBtn.addEventListener('click', () => {
            setConsent('granted');
            hideBanner();
        });
    }

    if (declineBtn) {
        declineBtn.addEventListener('click', () => {
            setConsent('denied');
            hideBanner();
        });
    }

    function setConsent(status) {
        localStorage.setItem('cookie_consent', status);
        
        // Push to dataLayer for GTM/GA if needed
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'cookie_consent_update',
            'consent_status': status
        });

        if (status === 'granted') {
            window.dispatchEvent(new CustomEvent('cookie-consent-granted'));
            // If we have direct fbq/gtag calls that need to fire immediately:
            if (window.fbq) window.fbq('consent', 'grant');
            if (window.gtag) window.gtag('consent', 'update', {
                'ad_storage': 'granted',
                'analytics_storage': 'granted'
            });
        } else {
             if (window.fbq) window.fbq('consent', 'revoke');
             if (window.gtag) window.gtag('consent', 'update', {
                'ad_storage': 'denied',
                'analytics_storage': 'denied'
            });
        }
    }

    function hideBanner() {
        if (banner) {
            banner.classList.add('translate-y-full');
            setTimeout(() => {
                banner.style.display = 'none';
            }, 300);
        }
    }
});

// Helper to check consent in other scripts
export function hasConsent() {
    return localStorage.getItem('cookie_consent') === 'granted';
}
