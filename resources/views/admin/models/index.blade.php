@extends('layouts.admin')

@section('page', 'models')
@section('title', 'Model Showroom')

@section('content')
      <div class="page-head">
        <div>
          <h1 class="page-title">Model Showroom</h1>
          <nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li><li class="breadcrumb-item active" aria-current="page">Model Showroom</li></ol></nav>
        </div>
        <div></div>
      </div>

      <div class="card">
        <form action="{{ route('admin.models.index') }}" method="GET" id="filterForm">
        <div class="toolbar">
          <div class="search">
            <i class="bi bi-search" aria-hidden="true"></i>
            <label for="searchInput" class="visually-hidden">Search models</label>
            <input type="search" id="searchInput" name="search" class="form-control" placeholder="Search by name, year..." value="{{ request('search') }}">
          </div>
          <div class="filter">
            <label for="statusFilter" class="visually-hidden">Filter by status</label>
            <select id="statusFilter" name="status" class="form-select" onchange="document.getElementById('filterForm').submit();">
              <option value="">All statuses</option>
              <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
          </div>
          <a href="{{ route('admin.models.create') }}" class="btn btn-accent ms-sm-auto"><i class="bi bi-plus-lg me-1"></i>Add New Model</a>
        </div>
        </form>

        <div class="table-responsive" id="tableWrap">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th class="d-none d-md-table-cell" scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Model Name</th>
                <th scope="col">Year</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th class="d-none d-md-table-cell" scope="col">Display Order</th>
                <th class="text-end" scope="col">Actions</th>
              </tr>
            </thead>
            <tbody id="modelsBody">
              @forelse($models as $model)
              <tr>
                <td class="d-none d-md-table-cell text-muted">#{{ $model->id }}</td>
                <td><span class="thumb"><img src="{{ $model->image ? asset('storage/vehicles/' . $model->image) : asset('assets/admin/images/vehicles/q50.png') }}" alt="{{ $model->year }} {{ $model->model_name }}"></span></td>
                <td><div class="model-name">{{ $model->model_name }}</div></td>
                <td>{{ $model->year }}</td>
                <td class="fw-semibold">${{ number_format($model->price, 0) }}</td>
                <td><span class="status-badge is-{{ $model->status ? 'active' : 'inactive' }}">{{ $model->status ? 'Active' : 'Inactive' }}</span></td>
                <td class="d-none d-md-table-cell">{{ $model->display_order }}</td>
                <td class="text-end"><div class="row-actions">
                  <a class="action-btn edit" href="{{ route('admin.models.edit', $model->id) }}" aria-label="Edit {{ $model->model_name }}" title="Edit"><i class="bi bi-pencil-square"></i></a>
                  <button type="button" class="action-btn delete" data-id="{{ $model->id }}" data-name="{{ $model->year }} {{ $model->model_name }}" aria-label="Delete {{ $model->model_name }}" title="Delete"><i class="bi bi-trash3"></i></button>
                </div></td>
              </tr>
              @empty
              <tr><td colspan="8" class="text-center text-muted py-4">No models found.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <span class="text-muted small" id="tableInfo" aria-live="polite">
            @if($models->total() > 0)
              Showing {{ $models->firstItem() }}-{{ $models->lastItem() }} of {{ $models->total() }} models
            @else
              No models
            @endif
          </span>
          <nav aria-label="Models pagination">{{ $models->withQueryString()->links('vendor.pagination.admin') }}</nav>
        </div>
      </div>
@endsection

@section('modals')
  <!-- Delete confirmation -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm"><div class="modal-content text-center p-3">
      <div class="modal-body">
        <span class="modal-icon mb-3"><i class="bi bi-trash3"></i></span>
        <h2 class="h5" id="deleteTitle">Delete this model?</h2>
        <p class="text-muted mb-0"><strong id="deleteName"></strong> will be removed from the showroom. This cannot be undone.</p>
      </div>
      <div class="d-flex gap-2 justify-content-center pb-2">
        <button type="button" class="btn btn-light-soft" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" action="">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Yes, delete</button>
        </form>
      </div>
    </div></div>
  </div>
@endsection

@section('scripts')
<script>
$(function(){
  // Delete modal
  var deleteModal = new bootstrap.Modal("#deleteModal");
  $(document).on("click", ".action-btn.delete", function(){
    var id = $(this).data("id"), name = $(this).data("name");
    $("#deleteName").text(name);
    $("#deleteForm").attr("action", "{{ url('admin/models') }}/" + id);
    deleteModal.show();
  });

  // Search on enter
  $("#searchInput").on("keypress", function(e){
    if(e.which === 13){ e.preventDefault(); $("#filterForm").submit(); }
  });
});
</script>
@endsection

