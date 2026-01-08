
import { fireAnalytics } from './analytics';

/**
 * @file Manages the quote modal, including its triggers, state, and analytics.
 */

/**
 * @typedef {Object} ModalState
 * @property {number} [lastShown]
 * @property {number} [lastClosed]
 * @property {string} [lastPath]
 */

const STATE_KEY = 'seova_quote_modal_state';
const COOLDOWN_MS = 10 * 60 * 1000; // 10 minutes
const AUTO_DELAY_MS = 20000;
const SCROLL_THRESHOLD = 0.55;
const MIN_TIME_BEFORE_NON_EXIT = 6000; // 6s
const FOCUSABLE = 'a[href], area[href], input:not([disabled]):not([type=hidden]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable=true]';

let isInitialized = false;

/**
 * Initializes the quote modal controller.
 * @param {HTMLElement} modal - The modal wrapper element.
 */
function initQuoteModal(modal) {
  if (isInitialized || !modal) return;
  isInitialized = true;

  const dialog = modal.querySelector('[data-modal-dialog]');
  const closeBtn = modal.querySelector('[data-modal-close]');
  const backdrop = modal.querySelector('[data-modal-backdrop]');
  const modalForm = dialog?.querySelector('form');

  let isOpen = false;
  let lastFocusedOutside = null;

  /**
   * Reads the modal state from local storage.
   * @returns {ModalState|null}
   */
  function readState() {
    try {
      const raw = localStorage.getItem(STATE_KEY);
      return raw ? JSON.parse(raw) : null;
    } catch (_) {
      return null;
    }
  }

  /**
   * Writes a patch to the modal state in local storage.
   * @param {Partial<ModalState>} patch - The state to write.
   */
  function writeState(patch) {
    try {
      const existing = readState() || {};
      const next = { ...existing, ...patch };
      localStorage.setItem(STATE_KEY, JSON.stringify(next));
    } catch (_) {
      // State writing failure should not break user experience
    }
  }

  /**
   * Checks if the modal is currently suppressed by cooldown.
   * @returns {boolean}
   */
  function isSuppressed() {
    const state = readState();
    if (!state || typeof state.lastClosed !== 'number') return false;
    return (Date.now() - state.lastClosed) < COOLDOWN_MS;
  }

  /**
   * Opens the modal.
   * @param {string} source - The source that triggered the modal opening.
   */
  function openModal(source) {
    if (isOpen || isSuppressed()) return;
    if (performance.now() < MIN_TIME_BEFORE_NON_EXIT && source !== 'exit') return;

    isOpen = true;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    writeState({ lastShown: Date.now(), lastPath: location.pathname });

    queueMicrotask(() => {
      const firstFocusable = dialog.querySelector(FOCUSABLE);
      if (firstFocusable) firstFocusable.focus();
      trapFocus();
    });

    fireAnalytics('quote_modal_open', null, { source });
  }

  /**
   * Closes the modal.
   */
  function closeModal() {
    if (!isOpen) return;

    isOpen = false;
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
    writeState({ lastClosed: Date.now(), lastPath: location.pathname });
    releaseFocusTrap();
    fireAnalytics('quote_modal_close', null);
  }

  /**
   * Traps focus within the modal.
   */
  function trapFocus() {
    lastFocusedOutside = document.activeElement;
    document.addEventListener('keydown', handleTab, true);
  }

  /**
   * Releases the focus trap.
   */
  function releaseFocusTrap() {
    document.removeEventListener('keydown', handleTab, true);
    if (lastFocusedOutside && lastFocusedOutside.focus) {
      queueMicrotask(() => lastFocusedOutside.focus());
    }
  }

  /**
   * Handles the Tab key press to trap focus.
   * @param {KeyboardEvent} e - The keyboard event.
   */
  function handleTab(e) {
    if (!isOpen || e.key !== 'Tab') return;

    const nodes = Array.from(dialog.querySelectorAll(FOCUSABLE)).filter(el => el.offsetParent !== null);
    if (nodes.length === 0) return;

    const first = nodes[0];
    const last = nodes[nodes.length - 1];

    if (e.shiftKey) {
      if (document.activeElement === first) {
        e.preventDefault();
        last.focus();
      }
    } else {
      if (document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }
  }

  /**
   * Sets up event listeners for the modal triggers.
   */
  function setupTriggers() {
    if (isSuppressed()) return;

    // Removed timer trigger - modal now only shows based on scroll position or exit-intent
    // setTimeout(() => openModal('timer'), AUTO_DELAY_MS);

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



  // Event Wiring
  backdrop?.addEventListener('click', closeModal);
  closeBtn?.addEventListener('click', closeModal);
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });
  modalForm?.addEventListener('submit', (e) => fireAnalytics('quote_form_submit', e));

  /*modal.addEventListener('click', (e) => {
    fireAnalytics('quote_button_click', e);
  });*/

  

  setupTriggers();

  // Public API
  window.SeovaQuoteModal = { open: () => openModal('manual'), close: closeModal };
}

document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('quoteModalWrapper');
  initQuoteModal(modal);
});

export { initQuoteModal };
