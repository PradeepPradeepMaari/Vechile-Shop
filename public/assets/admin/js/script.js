/* Vehicle Showroom Admin - frontend-only interactions with dummy data */
$(function () {
  "use strict";

  /* ------------------------------------------------------------------
     Dummy data (replace with Blade-rendered data later)
     ------------------------------------------------------------------ */
  var IMG = "assets/images/vehicles/";
  var VEHICLES = [
    { id: 1,  name: "Q50",       category: "Sedan",     year: 2014, price: 37500, status: "active",   order: 1,  image: "q50.png",  ago: 1,  recent: true },
    { id: 2,  name: "QX70",      category: "Crossover", year: 2014, price: 53350, status: "active",   order: 2,  image: "qx70.png", ago: 3,  recent: true },
    { id: 3,  name: "QX50",      category: "Crossover", year: 2014, price: 37900, status: "active",   order: 3,  image: "qx50.png", ago: 6,  recent: true },
    { id: 4,  name: "QX60",      category: "SUV",       year: 2014, price: 43000, status: "active",   order: 4,  image: "qx60.png", ago: 9,  recent: true },
    { id: 5,  name: "Q60 Coupe", category: "Coupe",     year: 2015, price: 46800, status: "active",   order: 5,  image: "q50.png",  ago: 12, recent: true },
    { id: 6,  name: "Q70",       category: "Sedan",     year: 2015, price: 52900, status: "inactive", order: 6,  image: "qx70.png", ago: 20, recent: false },
    { id: 7,  name: "QX80",      category: "SUV",       year: 2015, price: 71500, status: "active",   order: 7,  image: "qx60.png", ago: 24, recent: false },
    { id: 8,  name: "Q40",       category: "Sedan",     year: 2015, price: 34200, status: "inactive", order: 8,  image: "q50.png",  ago: 31, recent: false },
    { id: 9,  name: "QX30",      category: "Crossover", year: 2016, price: 36400, status: "active",   order: 9,  image: "qx50.png", ago: 38, recent: false },
    { id: 10, name: "Q50 Hybrid", category: "Sedan",    year: 2016, price: 48900, status: "active",   order: 10, image: "q50.png",  ago: 44, recent: false },
    { id: 11, name: "QX70 Sport", category: "SUV",      year: 2016, price: 58200, status: "inactive", order: 11, image: "qx70.png", ago: 52, recent: false },
    { id: 12, name: "Q60 Convertible", category: "Convertible", year: 2016, price: 61000, status: "active", order: 12, image: "q50.png", ago: 60, recent: false },
    { id: 13, name: "QX60 Hybrid", category: "SUV",     year: 2016, price: 49700, status: "active",   order: 13, image: "qx60.png", ago: 71, recent: false },
    { id: 14, name: "QX50 Premium", category: "Crossover", year: 2016, price: 41300, status: "inactive", order: 14, image: "qx50.png", ago: 85, recent: false }
  ];

  var CATEGORY_COLORS = { Sedan: "#0B1F3A", SUV: "#F97316", Crossover: "#38bdf8", Coupe: "#22c55e", Convertible: "#8b5cf6" };

  /* ------------------------------------------------------------------
     Helpers
     ------------------------------------------------------------------ */
  function money(n) { return "$" + Number(n).toLocaleString("en-US"); }
  function esc(s) { return $("<div>").text(s).html(); }
  function agoText(d) { return d === 0 ? "Today" : d === 1 ? "Yesterday" : d + " days ago"; }
  function getParam(name) { return new URLSearchParams(window.location.search).get(name); }
  function statusBadge(s) {
    return '<span class="status-badge is-' + s + '">' + (s === "active" ? "Active" : "Inactive") + "</span>";
  }

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
     Shell: sidebar toggle, demo links, global search
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

  $("#globalSearch").on("submit", function (e) {
    e.preventDefault();
    var q = $.trim($(this).find("input").val());
    if ($("body").data("page") === "models") {
      $("#searchInput").val(q).trigger("input");
    } else {
      window.location.href = "models.html" + (q ? "?q=" + encodeURIComponent(q) : "");
    }
  });

  /* ------------------------------------------------------------------
     Dashboard
     ------------------------------------------------------------------ */
  function initDashboard() {
    var total = VEHICLES.length;
    var active = VEHICLES.filter(function (v) { return v.status === "active"; }).length;
    var recent = VEHICLES.filter(function (v) { return v.recent; }).length;
    var stats = { total: total, active: active, inactive: total - active, recent: recent };

    $("[data-stat]").each(function () {
      var $el = $(this), end = stats[$el.data("stat")], start = null;
      function step(ts) {
        if (start === null) { start = ts; }
        var p = Math.min((ts - start) / 700, 1);
        $el.text(Math.round(end * p));
        if (p < 1) { requestAnimationFrame(step); }
      }
      requestAnimationFrame(step);
    });

    // Recently added
    var rows = VEHICLES.filter(function (v) { return v.recent; }).slice(0, 5).map(function (v) {
      return '<div class="vehicle-row"><span class="thumb"><img src="' + IMG + v.image + '" alt="' + v.year + " " + esc(v.name) + '"></span>' +
        '<div class="meta"><div class="name text-truncate">' + v.year + " " + esc(v.name) + '</div><small class="text-muted">' + v.category + " &middot; " + agoText(v.ago) + "</small></div>" +
        '<div class="text-end"><div class="fw-semibold">' + money(v.price) + "</div>" + statusBadge(v.status) + "</div></div>";
    });
    $("#recentVehicles").html(rows.join(""));

    // Category overview (CSS conic-gradient donut)
    var counts = {};
    VEHICLES.forEach(function (v) { counts[v.category] = (counts[v.category] || 0) + 1; });
    var acc = 0, stops = [], legend = [];
    Object.keys(counts).forEach(function (cat) {
      var pct = counts[cat] / total * 100, color = CATEGORY_COLORS[cat] || "#94a3b8";
      stops.push(color + " " + acc.toFixed(2) + "% " + (acc + pct).toFixed(2) + "%");
      acc += pct;
      legend.push('<li><span class="swatch" style="background:' + color + '"></span>' + cat + '<span class="count">' + counts[cat] + "</span></li>");
    });
    $("#categoryDonut").css("background", "conic-gradient(" + stops.join(",") + ")");
    $("#donutTotal").text(total);
    $("#categoryLegend").html(legend.join(""));
  }

  /* ------------------------------------------------------------------
     Models listing: search + status filter + pagination + delete/view
     ------------------------------------------------------------------ */
  function initModels() {
    var PAGE_SIZE = 5, page = 1, deleteId = null;
    var $body = $("#modelsBody"), $pager = $("#pagination"), $info = $("#tableInfo"), $empty = $("#emptyState"), $tableWrap = $("#tableWrap");
    var deleteModal = new bootstrap.Modal("#deleteModal");
    var viewModal = new bootstrap.Modal("#viewModal");

    var q = getParam("q");
    if (q) { $("#searchInput").val(q); $("#globalSearch input").val(q); }

    function filtered() {
      var term = $.trim($("#searchInput").val()).toLowerCase();
      var status = $("#statusFilter").val();
      return VEHICLES.filter(function (v) {
        var hay = (v.name + " " + v.category + " " + v.year + " " + v.price).toLowerCase();
        return (!term || hay.indexOf(term) > -1) && (!status || v.status === status);
      });
    }

    function render() {
      var list = filtered(), pages = Math.max(1, Math.ceil(list.length / PAGE_SIZE));
      if (page > pages) { page = pages; }
      var start = (page - 1) * PAGE_SIZE, slice = list.slice(start, start + PAGE_SIZE);

      $empty.toggleClass("d-none", list.length > 0);
      $tableWrap.toggleClass("d-none", list.length === 0);

      $body.html(slice.map(function (v) {
        return "<tr>" +
          '<td class="d-none d-md-table-cell text-muted">#' + v.id + "</td>" +
          '<td><span class="thumb"><img src="' + IMG + v.image + '" alt="' + v.year + " " + esc(v.name) + '"></span></td>' +
          '<td><div class="model-name">' + esc(v.name) + '</div><small class="text-muted">' + v.category + "</small></td>" +
          "<td>" + v.year + "</td>" +
          '<td class="fw-semibold">' + money(v.price) + "</td>" +
          "<td>" + statusBadge(v.status) + "</td>" +
          '<td class="d-none d-md-table-cell">' + v.order + "</td>" +
          '<td class="text-end"><div class="row-actions">' +
            '<button type="button" class="action-btn view" data-action="view" data-id="' + v.id + '" aria-label="View ' + esc(v.name) + '" title="View"><i class="bi bi-eye"></i></button>' +
            '<a class="action-btn edit" href="edit-model.html?id=' + v.id + '" aria-label="Edit ' + esc(v.name) + '" title="Edit"><i class="bi bi-pencil-square"></i></a>' +
            '<button type="button" class="action-btn delete" data-action="delete" data-id="' + v.id + '" aria-label="Delete ' + esc(v.name) + '" title="Delete"><i class="bi bi-trash3"></i></button>' +
          "</div></td></tr>";
      }).join(""));

      $info.text(list.length ? "Showing " + (start + 1) + "-" + (start + slice.length) + " of " + list.length + " models" : "No models");

      var html = '<li class="page-item' + (page === 1 ? " disabled" : "") + '"><a class="page-link" href="#" data-page="' + (page - 1) + '" aria-label="Previous"><i class="bi bi-chevron-left"></i></a></li>';
      for (var i = 1; i <= pages; i++) {
        html += '<li class="page-item' + (i === page ? " active" : "") + '"><a class="page-link" href="#" data-page="' + i + '"' + (i === page ? ' aria-current="page"' : "") + ">" + i + "</a></li>";
      }
      html += '<li class="page-item' + (page === pages ? " disabled" : "") + '"><a class="page-link" href="#" data-page="' + (page + 1) + '" aria-label="Next"><i class="bi bi-chevron-right"></i></a></li>';
      $pager.html(html).parent().toggleClass("d-none", list.length === 0);
    }

    $("#searchInput").on("input", function () { page = 1; render(); });
    $("#statusFilter").on("change", function () { page = 1; render(); });
    $("#resetFilters").on("click", function () { $("#searchInput, #globalSearch input").val(""); $("#statusFilter").val(""); page = 1; render(); });

    $pager.on("click", "a.page-link", function (e) {
      e.preventDefault();
      if ($(this).parent().hasClass("disabled")) { return; }
      page = parseInt($(this).data("page"), 10);
      render();
    });

    function byId(id) { return VEHICLES.filter(function (v) { return v.id === id; })[0]; }

    $body.on("click", "[data-action]", function () {
      var v = byId(parseInt($(this).data("id"), 10));
      if (!v) { return; }
      if ($(this).data("action") === "delete") {
        deleteId = v.id;
        $("#deleteName").text(v.year + " " + v.name);
        deleteModal.show();
      } else {
        $("#viewImg").attr({ src: IMG + v.image, alt: v.year + " " + v.name });
        $("#viewTitle").text(v.year + " " + v.name);
        $("#viewCategory").text(v.category);
        $("#viewPrice").text(money(v.price));
        $("#viewOrder").text(v.order);
        $("#viewStatus").html(statusBadge(v.status));
        $("#viewEdit").attr("href", "edit-model.html?id=" + v.id);
        viewModal.show();
      }
    });

    $("#confirmDelete").on("click", function () {
      VEHICLES = VEHICLES.filter(function (v) { return v.id !== deleteId; });
      deleteModal.hide();
      render();
      showToast("Model deleted (demo only - nothing is saved).", "danger");
    });

    render();
  }

  /* ------------------------------------------------------------------
     Add / Edit form: image preview + validation
     ------------------------------------------------------------------ */
  function initForm() {
    var isEdit = $("body").data("page") === "edit";
    var $form = $("#modelForm"), $file = $("#vehicleImage"), $preview = $("#imagePreview"), $drop = $("#dropzone");
    var originalSrc = null;

    function placeholder() {
      $preview.html('<div class="placeholder"><i class="bi bi-image"></i><small>Image preview will appear here</small></div>');
    }
    function showImg(src, alt) { $preview.html('<img src="' + src + '" alt="' + esc(alt) + '">'); }

    if (isEdit) {
      var id = parseInt(getParam("id"), 10) || 1;
      var v = VEHICLES.filter(function (x) { return x.id === id; })[0] || VEHICLES[0];
      $("#modelId").text("#" + v.id);
      $("#modelName").val(v.name);
      $("#modelYear").val(v.year);
      $("#modelPrice").val(v.price);
      $("#displayOrder").val(v.order);
      $("#statusSwitch").prop("checked", v.status === "active");
      originalSrc = IMG + v.image;
      showImg(originalSrc, v.year + " " + v.name);
    } else {
      placeholder();
    }

    function syncStatus() {
      var on = $("#statusSwitch").is(":checked");
      $("#statusText").html(statusBadge(on ? "active" : "inactive"));
    }
    $("#statusSwitch").on("change", syncStatus);
    syncStatus();

    function setFile(file) {
      var ok = file && /^image\/(png|jpe?g|webp|gif)$/.test(file.type);
      $("#imageError").text("");
      $drop.removeClass("is-invalid");
      if (!file) { return; }
      if (!ok) { $("#imageError").text("Please choose a PNG, JPG, WEBP or GIF image."); $drop.addClass("is-invalid"); $file.val(""); return; }
      if (file.size > 2 * 1024 * 1024) { $("#imageError").text("Image must be 2 MB or smaller."); $drop.addClass("is-invalid"); $file.val(""); return; }
      var reader = new FileReader();
      reader.onload = function (e) { showImg(e.target.result, "New vehicle image preview"); };
      reader.readAsDataURL(file);
      $("#fileName").text(file.name + " (" + Math.round(file.size / 1024) + " KB)");
      $("#removeImage").removeClass("d-none");
    }

    $file.on("change", function () { setFile(this.files[0]); });
    $drop.on("dragover dragenter", function (e) { e.preventDefault(); $drop.addClass("is-over"); })
         .on("dragleave drop", function (e) { e.preventDefault(); $drop.removeClass("is-over"); })
         .on("drop", function (e) {
           var files = e.originalEvent.dataTransfer.files;
           if (files.length) { $file[0].files = files; setFile(files[0]); }
         });

    $("#removeImage").on("click", function () {
      $file.val("");
      $("#fileName").text("");
      $(this).addClass("d-none");
      $("#imageError").text("");
      $drop.removeClass("is-invalid");
      if (isEdit) { showImg(originalSrc, "Current vehicle image"); } else { placeholder(); }
    });

    $form.on("submit", function (e) {
      e.preventDefault();
      var valid = true;
      $form.addClass("was-validated");

      $form.find("input.form-control, select.form-select").each(function () {
        if (!this.checkValidity()) { valid = false; }
      });
      if (!isEdit && !$file[0].files.length) {
        valid = false;
        $("#imageError").text("Please upload a vehicle image.");
        $drop.addClass("is-invalid");
      }
      if (!valid) {
        showToast("Please fix the highlighted fields.", "danger");
        $form.find(":invalid").first().trigger("focus");
        return;
      }
      showToast(isEdit ? "Model updated successfully (demo)." : "Model saved successfully (demo).");
      $form.find("button[type=submit]").prop("disabled", true);
      setTimeout(function () { window.location.href = "models.html"; }, 1200);
    });
  }

  /* ------------------------------------------------------------------
     Login (static UI: validates fields, then opens the dashboard)
     ------------------------------------------------------------------ */
  function initLogin() {
    var $form = $("#loginForm");
    $("#togglePassword").on("click", function () {
      var $pw = $("#loginPassword"), show = $pw.attr("type") === "password";
      $pw.attr("type", show ? "text" : "password");
      $(this).attr("aria-label", show ? "Hide password" : "Show password").find("i").toggleClass("bi-eye bi-eye-slash");
    });
    $form.on("submit", function (e) {
      e.preventDefault();
      $form.addClass("was-validated");
      if (!this.checkValidity()) { $form.find(":invalid").first().trigger("focus"); return; }
      $("#loginBtn").prop("disabled", true).html('<span class="spinner-border spinner-border-sm me-2" aria-hidden="true"></span>Signing in...');
      setTimeout(function () { window.location.href = "dashboard.html"; }, 800);
    });
  }

  /* Route by page */
  switch ($("body").data("page")) {
    case "dashboard": initDashboard(); break;
    case "models": initModels(); break;
    case "add":
    case "edit": initForm(); break;
    case "login": initLogin(); break;
  }
});
