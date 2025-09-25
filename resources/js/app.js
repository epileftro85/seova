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

// Quote Modal Controller with path + cooldown suppression & analytics stubs
document.addEventListener('DOMContentLoaded', () => {
	const modal = document.getElementById('quoteModalWrapper');
	if (!modal) return;

	const dialog = modal.querySelector('[data-modal-dialog]');
	const closeBtn = modal.querySelector('[data-modal-close]');
	const backdrop = modal.querySelector('[data-modal-backdrop]');
	const modalForm = dialog?.querySelector('form');

	// ---------- Configurable Strategy Values ----------
	const STATE_KEY = 'seova_quote_modal_state'; // JSON blob
	const COOLDOWN_MS = 10 * 60 * 1000; // 10 minutes cooldown after close
	const AUTO_DELAY_MS = 20000; // timer trigger delay
	const SCROLL_THRESHOLD = 0.55; // 55% scroll depth
	const MIN_TIME_BEFORE_NON_EXIT = 6000; // 6s engagement before timer/scroll triggers

	// ---------- Analytics Stub (no external GA logic yet) ----------
	if (!window.SeovaAnalytics) {
		window.SeovaAnalytics = {
			// Placeholder: integrate GA/gtag or other analytics later
			track: function (eventName, data) {
				console.log('Analytics event:', eventName, data);
			},
			// Convenience alias
			event: function (name, data) { this.track(name, data); }
		};
	}

	function fire(eventName, data = {}) {
		try { window.SeovaAnalytics.event(eventName, { path: location.pathname, ts: Date.now(), ...data }); } catch (_) { }
	}

	// ---------- State Helpers ----------
	function readState() {
		try {
			const raw = localStorage.getItem(STATE_KEY);
			if (!raw) return null;
			return JSON.parse(raw);
		} catch (_) { return null; }
	}
	function writeState(patch) {
		try {
			const existing = readState() || {};
			const next = { ...existing, ...patch };
			localStorage.setItem(STATE_KEY, JSON.stringify(next));
		} catch (_) { }
	}

	const state = readState();
	const now = Date.now();
	let suppressed = false;
	if (state && typeof state.lastClosed === 'number') {
		const withinCooldown = (now - state.lastClosed) < COOLDOWN_MS;
		suppressed = withinCooldown; // path check optional; cooldown dominates
	}

	let isOpen = false;
	let lastFocusedOutside = null;
	const FOCUSABLE = 'a[href], area[href], input:not([disabled]):not([type=hidden]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable=true]';

	function openModal(source) {
		if (isOpen || suppressed) return;
		if (performance.now() < MIN_TIME_BEFORE_NON_EXIT && source !== 'exit') return; // basic engagement guard
		isOpen = true;
		modal.classList.remove('hidden');
		modal.classList.add('flex');
		document.body.style.overflow = 'hidden';
		writeState({ lastShown: now, lastPath: location.pathname });
		queueMicrotask(() => {
			const first = dialog.querySelector('input,select,textarea,button');
			if (first) first.focus();
			trapFocus();
		});
		fire('quote_modal_open', { source });
	}

	function closeModal() {
		if (!isOpen) return;
		isOpen = false;
		modal.classList.add('hidden');
		modal.classList.remove('flex');
		document.body.style.overflow = '';
		writeState({ lastClosed: Date.now(), lastPath: location.pathname });
		releaseFocusTrap();
		fire('quote_modal_close');
	}

	// Focus trap
	function trapFocus() {
		lastFocusedOutside = document.activeElement;
		document.addEventListener('keydown', handleTab, true);
	}
	function releaseFocusTrap() {
		document.removeEventListener('keydown', handleTab, true);
		if (lastFocusedOutside && lastFocusedOutside.focus) {
			queueMicrotask(() => lastFocusedOutside.focus());
		}
	}
	function handleTab(e) {
		if (!isOpen || e.key !== 'Tab') return;
		const nodes = Array.from(dialog.querySelectorAll(FOCUSABLE)).filter(el => el.offsetParent !== null);
		if (nodes.length === 0) return;
		const first = nodes[0];
		const last = nodes[nodes.length - 1];
		if (e.shiftKey) {
			if (document.activeElement === first) { e.preventDefault(); last.focus(); }
		} else {
			if (document.activeElement === last) { e.preventDefault(); first.focus(); }
		}
	}

	// Event wiring
	backdrop?.addEventListener('click', closeModal);
	closeBtn?.addEventListener('click', closeModal);
	document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
	modalForm?.addEventListener('submit', () => fire('quote_form_submit'));

	// Delegated button/link click tracking (opt-in via data-analytics-event attribute)
	document.addEventListener('click', (e) => {
		const target = e.target.closest('[data-analytics-event]');
		if (!target) return;
		const name = target.getAttribute('data-analytics-event');
		if (!name) return;
		fire('quote_button_click', { name });
	});

	// Trigger registration if not suppressed
	if (!suppressed) {
		setTimeout(() => openModal('timer'), AUTO_DELAY_MS);
		function onScroll() {
			if (isOpen) return;
			const scrolled = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
			if (scrolled > SCROLL_THRESHOLD) {
				openModal('scroll');
				window.removeEventListener('scroll', onScroll);
			}
		}
		window.addEventListener('scroll', onScroll, { passive: true });
		document.addEventListener('mouseout', (e) => {
			if (isOpen) return;
			if (e.relatedTarget === null && e.clientY <= 0) {
				openModal('exit');
			}
		});
	}

	// Public API
	window.SeovaQuoteModal = { open: () => openModal('manual'), close: closeModal };
});
