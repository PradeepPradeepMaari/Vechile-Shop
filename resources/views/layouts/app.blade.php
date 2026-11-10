<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Markham Infiniti')</title>
  <meta name="description" content="Markham Infiniti is a family owned dealership serving the GTA. Shop new and used vehicles, service, parts and specials.">

  <!-- Vendor CSS (local, works offline) -->
  <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
  @yield('styles')
</head>
<body id="top">

  <a class="visually-hidden-focusable skip-link" href="#main">Skip to main content</a>

  @include('partials.header')

  @yield('content')

  @include('partials.footer')

  <!-- Vendor JS (local) -->
  <script src="{{ asset('assets/frontend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <!-- Custom JS -->
  <script src="{{ asset('assets/frontend/js/script.js') }}"></script>
  @yield('scripts')
</body>
</html>

