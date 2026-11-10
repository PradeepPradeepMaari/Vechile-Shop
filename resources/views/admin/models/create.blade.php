@extends('layouts.admin')

@section('page', 'add')
@section('title', 'Add New Model')

@section('content')
      <div class="page-head">
        <div>
          <h1 class="page-title">Add New Model</h1>
          <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('admin.models.index') }}">Model Showroom</a></li><li class="breadcrumb-item active" aria-current="page">Add New Model</li></ol></nav>
        </div>
        <div><a href="{{ route('admin.models.index') }}" class="btn btn-light-soft"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
      </div>

      <form id="modelForm" method="POST" action="{{ route('admin.models.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row g-3 g-xl-4">
          <div class="col-12 col-xl-7">
            <div class="card h-100">
              <div class="card-header"><h2>Model Details</h2></div>
              <div class="card-body">
                <div class="row g-3">
                  <div class="col-12">
                    <label for="modelName" class="form-label">Model Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('model_name') is-invalid @enderror" id="modelName" name="model_name" placeholder="e.g. Q50" required minlength="2" maxlength="60" value="{{ old('model_name') }}">
                    @error('model_name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @else
                      <div class="invalid-feedback">Enter a model name (2-60 characters).</div>
                    @enderror
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="modelYear" class="form-label">Manufacturing Year <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="modelYear" name="year" placeholder="e.g. 2014" required min="1990" max="2030" step="1" value="{{ old('year') }}">
                    @error('year')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @else
                      <div class="invalid-feedback">Enter a year between 1990 and 2030.</div>
                    @enderror
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="modelPrice" class="form-label">Vehicle Price <span class="text-danger">*</span></label>
                    <div class="input-group has-validation">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control @error('price') is-invalid @enderror" id="modelPrice" name="price" placeholder="e.g. 37500" required min="1" step="1" value="{{ old('price') }}">
                      @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @else
                        <div class="invalid-feedback">Enter a price greater than 0.</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="modelDescription" class="form-label">Short Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="modelDescription" name="description" rows="2" maxlength="255" placeholder="Optional model details">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="displayOrder" class="form-label">Display Order <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('display_order') is-invalid @enderror" id="displayOrder" name="display_order" placeholder="e.g. 1" required min="1" step="1" value="{{ old('display_order') }}">
                    @error('display_order')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @else
                      <div class="invalid-feedback">Enter a display order (1 or higher).</div>
                    @enderror
                    <div class="form-text">Lower numbers appear first on the website.</div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <span class="form-label d-block">Status</span>
                    <div class="status-switch">
                      <span id="statusText"></span>
                      <div class="form-check form-switch mb-0 p-0">
                        <input class="form-check-input" type="checkbox" role="switch" id="statusSwitch" name="status" value="1" aria-label="Active status" {{ old('status', '1') ? 'checked' : '' }}>
                      </div>
                    </div>
                    <div class="form-text">Inactive models are hidden from the public site.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-xl-5">
            <div class="card h-100">
              <div class="card-header"><h2>Vehicle Image</h2></div>
              <div class="card-body">

                <label class="dropzone position-relative" id="dropzone" for="vehicleImage">
                  <i class="bi bi-cloud-arrow-up" aria-hidden="true"></i>
                  <span class="fw-semibold text-navy">Click to upload or drag &amp; drop</span>
                  <small class="text-muted">PNG, JPG, WEBP or GIF &middot; max 2 MB</small>
                  <input type="file" id="vehicleImage" name="image" accept="image/png,image/jpeg,image/webp,image/gif" required>
                </label>
                @error('image')
                  <div class="text-danger small mt-2" role="alert">{{ $message }}</div>
                @else
                  <div class="text-danger small mt-2" id="imageError" role="alert"></div>
                @enderror
                <div class="d-flex align-items-center justify-content-between gap-2 mt-2">
                  <small class="text-muted text-truncate" id="fileName"></small>
                  <button type="button" class="btn btn-sm btn-light-soft d-none" id="removeImage"><i class="bi bi-x-lg me-1"></i>Remove</button>
                </div>
                <div class="preview-box" id="imagePreview" aria-live="polite">
                  <div class="placeholder"><i class="bi bi-image"></i><small>Image preview will appear here</small></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-3 mt-xl-4"><div class="form-actions border-0">
          <a href="{{ route('admin.models.index') }}" class="btn btn-light-soft">Cancel</a>
          <button type="submit" class="btn btn-accent"><i class="bi bi-save me-1"></i>Save Model</button>
        </div></div>
      </form>
@endsection

@section('scripts')
<script>
$(function(){
  "use strict";
  var $form = $("#modelForm"), $file = $("#vehicleImage"), $preview = $("#imagePreview"), $drop = $("#dropzone");

  // Status badge toggle
  function syncStatus(){
    var on = $("#statusSwitch").is(":checked");
    $("#statusText").html('<span class="status-badge is-' + (on ? "active" : "inactive") + '">' + (on ? "Active" : "Inactive") + "</span>");
  }
  $("#statusSwitch").on("change", syncStatus);
  syncStatus();

  // Image preview
  function showImg(src, alt){ $preview.html('<img src="' + src + '" alt="' + alt + '">'); }
  function placeholder(){ $preview.html('<div class="placeholder"><i class="bi bi-image"></i><small>Image preview will appear here</small></div>'); }

  function setFile(file){
    var ok = file && /^image\/(png|jpe?g|webp|gif)$/.test(file.type);
    $("#imageError").text(""); $drop.removeClass("is-invalid");
    if(!file) return;
    if(!ok){ $("#imageError").text("Please choose a PNG, JPG, WEBP or GIF image."); $drop.addClass("is-invalid"); $file.val(""); return; }
    if(file.size > 2*1024*1024){ $("#imageError").text("Image must be 2 MB or smaller."); $drop.addClass("is-invalid"); $file.val(""); return; }
    var reader = new FileReader();
    reader.onload = function(e){ showImg(e.target.result, "New vehicle image preview"); };
    reader.readAsDataURL(file);
    $("#fileName").text(file.name + " (" + Math.round(file.size/1024) + " KB)");
    $("#removeImage").removeClass("d-none");
  }

  $file.on("change", function(){ setFile(this.files[0]); });
  $drop.on("dragover dragenter", function(e){ e.preventDefault(); $drop.addClass("is-over"); })
       .on("dragleave drop", function(e){ e.preventDefault(); $drop.removeClass("is-over"); })
       .on("drop", function(e){ var files = e.originalEvent.dataTransfer.files; if(files.length){ $file[0].files = files; setFile(files[0]); } });

  $("#removeImage").on("click", function(){
    $file.val(""); $("#fileName").text(""); $(this).addClass("d-none"); $("#imageError").text(""); $drop.removeClass("is-invalid"); placeholder();
  });
});
</script>
@endsection

