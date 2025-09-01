document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.navbar-button').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      document.querySelectorAll('.header').forEach(function (header) {
        header.classList.toggle('open');
      });
      document.querySelectorAll('.navbar-button').forEach(function (nb) {
        nb.classList.toggle('collapsed');
      });
    });
  });

  function closeMenu() {
    document.querySelectorAll('.header').forEach(function (header) {
      header.classList.remove('open');
    });
    document.querySelectorAll('.navbar-button').forEach(function (nb) {
      nb.classList.add('collapsed');
    });
  }

  document.querySelectorAll('.navbar .navbar-nav > .nav-item > a.nav-link').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.stopPropagation();
      closeMenu();
    });
  });

  document.documentElement.addEventListener('click', function (e) {
    closeMenu();
  });

  const nav = document.querySelector('.navbar');
  if (nav) {
    new SinglePageNav(nav, {
      offset: 100,
      threshold: 120,
      speed: 400,
      currentClass: 'current',
      updateHash: true,
      filter: ':not(.external)'
    });
  }
});

/*! Bootstrap 5 Accordion Only - Minimal for FAQ toggle */
// This is a minimal implementation for Bootstrap 5 accordion toggle behavior.
// For full features, use the official Bootstrap JS.
(function(){
  document.addEventListener('DOMContentLoaded', function() {
    var accordions = document.querySelectorAll('.accordion');
    accordions.forEach(function(accordion) {
      accordion.addEventListener('click', function(e) {
        if (e.target.classList.contains('accordion-button')) {
          var button = e.target;
          var collapse = document.querySelector(button.getAttribute('data-bs-target'));
          var isOpen = collapse.classList.contains('show');
          // Close all
          accordion.querySelectorAll('.accordion-collapse').forEach(function(c) {
            c.classList.remove('show');
            c.previousElementSibling.querySelector('.accordion-button').classList.add('collapsed');
            c.previousElementSibling.querySelector('.accordion-button').setAttribute('aria-expanded', 'false');
          });
          // Open clicked
          if (!isOpen) {
            collapse.classList.add('show');
            button.classList.remove('collapsed');
            button.setAttribute('aria-expanded', 'true');
          }
        }
      });
    });
  });
})();
