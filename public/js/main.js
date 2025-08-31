/* jQuery(document).ready(function() {
  "use strict";
    $('.gallery-slider').slick({
        slidesToShow: 5,
        slidesToScroll: 3,
        autoplay: false,
        dots: true,
        autoplaySpeed: 2000,
        arrows: false,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 4,
              slidesToScroll: 4,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3
            }
          },
          {
            breakpoint: 575,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
    });
}); */

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