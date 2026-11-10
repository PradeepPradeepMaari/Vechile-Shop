@extends('layouts.admin')

@section('page', 'dashboard')
@section('title', 'Dashboard')

@section('content')
      <div class="page-head">
        <div>
          <h1 class="page-title">Dashboard</h1>
          <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active" aria-current="page">Dashboard</li></ol></nav>
        </div>
        <div></div>
      </div>

      <section class="welcome-banner" aria-label="Welcome">
        <div>
          <h2>Welcome back, {{ Auth::user()->name ?? 'Admin' }}</h2>
          <p>Manage the vehicles shown on your public Model Showroom, keep prices current and control what customers see.</p>
        </div>
        <a href="{{ route('admin.models.create') }}" class="btn btn-accent"><i class="bi bi-plus-lg me-1"></i>Add New Model</a>
      </section>

      <div class="row g-3 g-xl-4 mb-4">
        <div class="col-12 col-sm-6 col-xl-3"><div class="card stat-card"><div class="d-flex justify-content-between align-items-start">
          <div><div class="stat-label">Total Models</div><div class="stat-value" data-stat="total">{{ $totalModels }}</div><div class="stat-note text-success mt-1"><i class="bi bi-arrow-up-short"></i>+{{ $recentModels }} this month</div></div>
          <span class="stat-icon navy"><i class="bi bi-car-front-fill"></i></span></div></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="card stat-card"><div class="d-flex justify-content-between align-items-start">
          <div><div class="stat-label">Active Models</div><div class="stat-value" data-stat="active">{{ $activeModels }}</div><div class="stat-note text-success mt-1">Visible on website</div></div>
          <span class="stat-icon green"><i class="bi bi-check-circle-fill"></i></span></div></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="card stat-card"><div class="d-flex justify-content-between align-items-start">
          <div><div class="stat-label">Inactive Models</div><div class="stat-value" data-stat="inactive">{{ $inactiveModels }}</div><div class="stat-note text-danger mt-1">Hidden from website</div></div>
          <span class="stat-icon red"><i class="bi bi-slash-circle-fill"></i></span></div></div></div>
        <div class="col-12 col-sm-6 col-xl-3"><div class="card stat-card"><div class="d-flex justify-content-between align-items-start">
          <div><div class="stat-label">Recently Added</div><div class="stat-value" data-stat="recent">{{ $recentModels }}</div><div class="stat-note text-muted mt-1">Last 30 days</div></div>
          <span class="stat-icon orange"><i class="bi bi-stars"></i></span></div></div></div>
      </div>

      <div class="row g-3 g-xl-4 mb-4">
        <div class="col-12 col-xl-8">
          <div class="card h-100">
            <div class="card-header"><h2>Recently Added Vehicles</h2><a href="{{ route('admin.models.index') }}" class="btn btn-light-soft btn-sm">View all</a></div>
            <div id="recentVehicles">
              @forelse($recentVehicles as $vehicle)
              <div class="vehicle-row">
                <span class="thumb"><img src="{{ $vehicle->image ? asset('storage/vehicles/' . $vehicle->image) : asset('assets/admin/images/vehicles/q50.png') }}" alt="{{ $vehicle->year }} {{ $vehicle->model_name }}"></span>
                <div class="meta"><div class="name text-truncate">{{ $vehicle->year }} {{ $vehicle->model_name }}</div><small class="text-muted">{{ $vehicle->created_at->diffForHumans() }}</small></div>
                <div class="text-end"><div class="fw-semibold">${{ number_format($vehicle->price, 0) }}</div><span class="status-badge is-{{ $vehicle->status ? 'active' : 'inactive' }}">{{ $vehicle->status ? 'Active' : 'Inactive' }}</span></div>
              </div>
              @empty
              <div class="p-4 text-center text-muted">No vehicles added yet.</div>
              @endforelse
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header"><h2>Vehicle Categories</h2></div>
            <div class="card-body donut-wrap">
              <div class="donut" id="categoryDonut" role="img" aria-label="Vehicle category overview chart"><div class="donut-center"><strong id="donutTotal">{{ $totalModels }}</strong><span>Total models</span></div></div>
              <ul class="legend" id="categoryLegend"></ul>
            </div>
          </div>
        </div>
      </div>

     
@endsection

@section('scripts')
<script>
$(function(){
  // Category donut chart
  var categoryData = @json($categoryData);
  var CATEGORY_COLORS = { Sedan: "#0B1F3A", SUV: "#F97316", Crossover: "#38bdf8", Coupe: "#22c55e", Convertible: "#8b5cf6", Other: "#94a3b8" };
  var total = {{ $totalModels }};
  if (total > 0) {
    var acc = 0, stops = [], legend = [];
    $.each(categoryData, function(cat, count) {
      var pct = count / total * 100, color = CATEGORY_COLORS[cat] || "#94a3b8";
      stops.push(color + " " + acc.toFixed(2) + "% " + (acc + pct).toFixed(2) + "%");
      acc += pct;
      legend.push('<li><span class="swatch" style="background:' + color + '"></span>' + cat + '<span class="count">' + count + '</span></li>');
    });
    $("#categoryDonut").css("background", "conic-gradient(" + stops.join(",") + ")");
    $("#categoryLegend").html(legend.join(""));
  }
});
</script>
@endsection

