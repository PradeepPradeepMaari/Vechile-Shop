/* Vehicle Showroom Admin - Laravel integrated interactions */
$(function () {
  "use strict";

  /* ------------------------------------------------------------------
     Helpers
     ------------------------------------------------------------------ */
  function esc(s) { return $("<div>").text(s).html(); }

  function showToast(message, type) {
    var $c = $("#toastArea");
    if (!$c.length) { return; }
    var cls = type === "danger" ? "text-bg-danger" : type === "info" ? "text-bg-dark" : "text-bg-success";
    var icon = type === "danger" ? "bi-exclamation-triangle" : type === "info" ? "bi-info-circle" : "bi-check-circle";
    var $t = $('<div class="toast align-items-center ' + cls + '" role="status" aria-live="polite" aria-atomic="true">' +
      '<div class="d-flex"><div class="toast-body"><i class="bi ' + icon + ' me-2"></i>' + esc(message) + "</div>" +
      '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>');
    $c.append($t);
    var toast = new bootstrap.Toast($t[0], { delay: 2800 });
    $t.on("hidden.bs.toast", function () { $t.remove(); });
    toast.show();
  }

  /* ------------------------------------------------------------------
     Shell: sidebar toggle, demo links
     ------------------------------------------------------------------ */
  var sidebarEl = document.getElementById("sidebar");

  $("#sidebarToggle").on("click", function () {
    if (window.matchMedia("(min-width: 992px)").matches) {
      var collapsed = $("body").toggleClass("sidebar-collapsed").hasClass("sidebar-collapsed");
      try { localStorage.setItem("sidebarCollapsed", collapsed ? "1" : "0"); } catch (e) { /* ignore */ }
    } else if (sidebarEl) {
      bootstrap.Offcanvas.getOrCreateInstance(sidebarEl).toggle();
    }
  });
  try {
    if (localStorage.getItem("sidebarCollapsed") === "1" && window.matchMedia("(min-width: 992px)").matches) {
      $("body").addClass("sidebar-collapsed");
    }
  } catch (e) { /* ignore */ }

  $("[data-demo]").on("click", function (e) {
    e.preventDefault();
    showToast($(this).data("demo"), "info");
  });
});

