import "./menu"

// Vanilla JS enhancements for the quote form UX
document.addEventListener('DOMContentLoaded', () => {
	const contactSection = document.getElementById('contact');
	const form = contactSection?.querySelector('form');
	const statusEl = contactSection?.querySelector('#quote-status');
	const errorEls = contactSection ? contactSection.querySelectorAll('[role="alert"], .text-red-600') : [];

	// If there is a status or any error under the contact section, bring it into view
	if (contactSection && (statusEl || (errorEls && errorEls.length > 0))) {
		// Smooth scroll to the section
		try {
			contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
		} catch (_) {
			// Fallback if smooth not supported
			contactSection.scrollIntoView(true);
		}

		// Move focus to status for accessibility so it is announced
		const focusTarget = statusEl || contactSection;
		if (focusTarget) {
			const hadTabindex = focusTarget.hasAttribute('tabindex');
			if (!hadTabindex) focusTarget.setAttribute('tabindex', '-1');
			focusTarget.focus({ preventScroll: true });
			// Clean up tabindex if we added it
			if (!hadTabindex) {
				focusTarget.addEventListener('blur', () => focusTarget.removeAttribute('tabindex'), { once: true });
			}
		}
	}

	// Normalize website input by prepending https:// if user omits scheme
	const websiteInput = document.getElementById('website');
	const normalizeUrl = (value) => {
		if (!value || typeof value !== 'string') return value;
		let v = value.trim();
		// If it starts with http: or https: but missing //, insert it
		const schemeNoSlashes = /^(https?):([^/].*)$/i;
		if (schemeNoSlashes.test(v)) {
			return v.replace(schemeNoSlashes, (_, s, rest) => `${s}://${rest}`);
		}
		// If there is no scheme, default to https://
		if (!/^https?:\/\//i.test(v)) {
			v = 'https://' + v;
		}
		return v;
	};

	if (websiteInput) {
		websiteInput.addEventListener('blur', () => {
			const normalized = normalizeUrl(websiteInput.value);
			if (normalized !== websiteInput.value) {
				websiteInput.value = normalized;
			}
		});
	}

	if (form) {
		form.addEventListener('submit', () => {
			if (websiteInput && websiteInput.value) {
				websiteInput.value = normalizeUrl(websiteInput.value);
			}
		});
	}
});
