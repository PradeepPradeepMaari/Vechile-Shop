<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Showroom Admin</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @yield('styles')
</head>
<body data-page="@yield('page')">

  @include('partials.admin.sidebar')

  <div class="admin-main">
    @include('partials.admin.topbar')

    <main class="page" id="main">
      {{-- Flash Messages --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @yield('content')
    </main>

    @include('partials.admin.footer')
  </div>

  <div class="toast-container position-fixed top-0 end-0 p-3" id="toastArea"></div>

  @yield('modals')

  <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/admin.js') }}"></script>
  @yield('scripts')
</body>
</html>

