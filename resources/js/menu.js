// menu configuration
// Wait for DOM to be ready
/* document.addEventListener('DOMContentLoaded', () => {
    // Utilities
    const qs = (sel, root = document) => root.querySelector(sel);
    const setExpanded = (el, expanded) => {
        if (el) el.setAttribute('aria-expanded', String(!!expanded));
    };
    const openMenu = (menu, toggle) => {
        if (!menu) return;
        menu.classList.remove('hidden');
        setExpanded(toggle, true);
    };
    const closeMenu = (menu, toggle) => {
        if (!menu) return;
        menu.classList.add('hidden');
        setExpanded(toggle, false);
    };
    const toggleMenu = (menu, toggle) => {
        if (!menu) return;
        const isOpen = !menu.classList.contains('hidden');
        if (isOpen) {
            closeMenu(menu, toggle);
        } else {
            openMenu(menu, toggle);
        }
    };

    // Elements
    const toolsToggle = qs('#toolsToggle');
    const toolsMenu = qs('#toolsMenu');
    const mobileMenuToggle = qs('#mobileMenuToggle');
    const mobileMenu = qs('#mobileMenu');
    const mobileToolsToggle = qs('#mobileToolsToggle');
    const mobileToolsMenu = qs('#mobileToolsMenu');

    // Desktop tools dropdown
    if (toolsToggle && toolsMenu) {
        toolsToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu(toolsMenu, toolsToggle);
            // Focus first item when opening for accessibility
            if (!toolsMenu.classList.contains('hidden')) {
                const firstItem = toolsMenu.querySelector('[role="menuitem"], a, button');
                firstItem && typeof firstItem.focus === 'function' && firstItem.focus();
            }
        });
    }

    // Mobile menu toggle
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu(mobileMenu, mobileMenuToggle);
        });

        // Close mobile menu when clicking on any navigation link
        const mobileNavLinks = mobileMenu.querySelectorAll('a');
        mobileNavLinks.forEach((link) => {
            link.addEventListener('click', () => closeMenu(mobileMenu, mobileMenuToggle));
        });
    }

    // Mobile tools dropdown
    if (mobileToolsToggle && mobileToolsMenu) {
        mobileToolsToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleMenu(mobileToolsMenu, mobileToolsToggle);
        });
    }

    // Global: click outside to close any open menus
    document.addEventListener('click', (e) => {
        const t = e.target;
        // Desktop tools
        if (toolsMenu && !toolsMenu.classList.contains('hidden')) {
            if (!toolsMenu.contains(t) && !toolsToggle?.contains(t)) {
                closeMenu(toolsMenu, toolsToggle);
            }
        }
        // Mobile main menu
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            if (!mobileMenu.contains(t) && !mobileMenuToggle?.contains(t)) {
                closeMenu(mobileMenu, mobileMenuToggle);
            }
        }
        // Mobile tools submenu
        if (mobileToolsMenu && !mobileToolsMenu.classList.contains('hidden')) {
            if (!mobileToolsMenu.contains(t) && !mobileToolsToggle?.contains(t)) {
                closeMenu(mobileToolsMenu, mobileToolsToggle);
            }
        }
    });

    // Global: close menus on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        let closedSomething = false;
        if (toolsMenu && !toolsMenu.classList.contains('hidden')) {
            closeMenu(toolsMenu, toolsToggle);
            closedSomething = true;
        }
        if (mobileToolsMenu && !mobileToolsMenu.classList.contains('hidden')) {
            closeMenu(mobileToolsMenu, mobileToolsToggle);
            closedSomething = true;
        }
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            closeMenu(mobileMenu, mobileMenuToggle);
            closedSomething = true;
        }
        if (closedSomething) {
            // Return focus to a sensible control
            (mobileMenuToggle || mobileToolsToggle || toolsToggle)?.focus?.();
        }
    });
}); */

// Minified version without comments and extra whitespace:
document.addEventListener("DOMContentLoaded",()=>{let e=(e,t=document)=>t.querySelector(e),t=(e,t)=>{e&&e.setAttribute("aria-expanded",String(!!t))},n=(e,n)=>{e&&(e.classList.remove("hidden"),t(n,!0))},s=(e,n)=>{e&&(e.classList.add("hidden"),t(n,!1))},i=(e,t)=>{if(!e)return;let i=!e.classList.contains("hidden");i?s(e,t):n(e,t)},o=e("#toolsToggle"),a=e("#toolsMenu"),c=e("#mobileMenuToggle"),d=e("#mobileMenu"),l=e("#mobileToolsToggle"),r=e("#mobileToolsMenu");if(o&&a&&o.addEventListener("click",e=>{if(e.stopPropagation(),i(a,o),!a.classList.contains("hidden")){let t=a.querySelector('[role="menuitem"], a, button');t&&"function"==typeof t.focus&&t.focus()}}),c&&d){c.addEventListener("click",e=>{e.stopPropagation(),i(d,c)});let L=d.querySelectorAll("a");L.forEach(e=>{e.addEventListener("click",()=>s(d,c))})}l&&r&&l.addEventListener("click",e=>{e.stopPropagation(),i(r,l)}),document.addEventListener("click",e=>{let t=e.target;!a||a.classList.contains("hidden")||a.contains(t)||o?.contains(t)||s(a,o),!d||d.classList.contains("hidden")||d.contains(t)||c?.contains(t)||s(d,c),!r||r.classList.contains("hidden")||r.contains(t)||l?.contains(t)||s(r,l)}),document.addEventListener("keydown",e=>{if("Escape"!==e.key)return;let t=!1;a&&!a.classList.contains("hidden")&&(s(a,o),t=!0),r&&!r.classList.contains("hidden")&&(s(r,l),t=!0),d&&!d.classList.contains("hidden")&&(s(d,c),t=!0),t&&(c||l||o)?.focus?.()})});