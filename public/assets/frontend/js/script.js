/* Markham Infiniti - Homepage UI interactions (frontend only) */
$(function () {
  "use strict";

  var $nav = $("#mainNav");

  /* Hero carousel: pause autoplay on hover/focus, keyboard friendly */
  var heroEl = document.getElementById("heroCarousel");
  if (heroEl) {
    new bootstrap.Carousel(heroEl, { interval: 6000, ride: "carousel", pause: "hover", touch: true });
  }

  $("[data-showroom-carousel]").each(function () {
    var $carousel = $(this), track = $carousel.find("[data-showroom-track]")[0], $slides = $carousel.find(".vehicle-slide");
    var $dots = $carousel.find("[data-showroom-dots]"), page = 0;
    function visible() { return window.innerWidth < 576 ? 1 : (window.innerWidth < 992 ? 2 : 4); }
    function pages() { return Math.max(1, Math.ceil($slides.length / visible())); }
    function renderDots() {
      $dots.empty();
      for (var i = 0; i < pages(); i++) $dots.append('<button type="button" class="showroom-dot' + (i === page ? ' is-active' : '') + '" aria-label="Show vehicle page ' + (i + 1) + '"></button>');
      $dots.find("button").on("click", function () { go($(this).index()); });
    }
    function go(nextPage) {
      page = Math.max(0, Math.min(nextPage, pages() - 1));
      track.scrollTo({ left: page * track.clientWidth, behavior: "smooth" });
      $carousel.find(".showroom-dot").removeClass("is-active").eq(page).addClass("is-active");
    }
    $carousel.find("[data-showroom-prev]").on("click", function () { go(page - 1); });
    $carousel.find("[data-showroom-next]").on("click", function () { go(page + 1); });
    $(track).on("scroll", function () { page = Math.round(track.scrollLeft / track.clientWidth); $carousel.find(".showroom-dot").removeClass("is-active").eq(page).addClass("is-active"); });
    $(window).on("resize", function () { page = Math.min(page, pages() - 1); renderDots(); go(page); });
    renderDots();
  });

  /* Placeholder links ("#") should not jump to the top.
     Real in-page anchors (#top, #model-showroom) scroll smoothly via CSS. */
  $('a[href="#"]').on("click", function (e) { e.preventDefault(); });

  /* Close the mobile menu after choosing a link */
  $nav.find(".nav-link").on("click", function () {
    if ($nav.hasClass("show")) {
      bootstrap.Collapse.getOrCreateInstance($nav[0]).hide();
    }
  });

  /* Close the mobile menu when tapping outside or pressing Escape */
  $(document).on("click", function (e) {
    if ($nav.hasClass("show") && !$(e.target).closest(".main-nav").length) {
      bootstrap.Collapse.getOrCreateInstance($nav[0]).hide();
    }
  }).on("keydown", function (e) {
    if (e.key === "Escape" && $nav.hasClass("show")) {
      bootstrap.Collapse.getOrCreateInstance($nav[0]).hide();
    }
  });
});
