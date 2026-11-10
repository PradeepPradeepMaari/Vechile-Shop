<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login | Showroom Admin</title>
  <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap-icons/bootstrap-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
</head>
<body class="login-body" data-page="login">
  <main class="login-card">
    <div class="login-brand">
      <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Markham Infiniti logo">
      <h1>Vehicle Showroom</h1>
      <span>Admin Panel</span>
    </div>

    @if($errors->any())
    <div class="alert alert-danger py-2 mb-3" role="alert">
      <i class="bi bi-exclamation-triangle me-1"></i>{{ $errors->first() }}
    </div>
    @endif

    <form id="loginForm" method="POST" action="{{ route('admin.login') }}" novalidate>
      @csrf
      <div class="mb-3">
        <label for="loginEmail" class="form-label">Email or Username</label>
        <div class="input-group has-validation">
          <span class="input-group-text"><i class="bi bi-envelope"></i></span>
          <input type="text" class="form-control @error('login') is-invalid @enderror" id="loginEmail" name="login" placeholder="admin@gmail.com" required autocomplete="username" value="{{ old('login') }}">
          <div class="invalid-feedback">Enter a valid email address or username.</div>
        </div>
      </div>
      <div class="mb-3">
        <label for="loginPassword" class="form-label">Password</label>
        <div class="input-group has-validation">
          <span class="input-group-text"><i class="bi bi-lock"></i></span>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" name="password" placeholder="Enter your password" required minlength="6" autocomplete="current-password">
          <button class="btn password-toggle" type="button" id="togglePassword" aria-label="Show password"><i class="bi bi-eye"></i></button>
          <div class="invalid-feedback">Password must be at least 6 characters.</div>
        </div>
      </div>
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
        <div class="form-check mb-0">
          <input class="form-check-input" type="checkbox" id="rememberMe" name="remember" value="1">
          <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <a href="#" class="small fw-semibold" data-demo="Password reset is not part of this release.">Forgot password?</a>
      </div>
      <button type="submit" class="btn btn-accent w-100 py-2" id="loginBtn">Login</button>
    </form>
  </main>
  <div class="toast-container position-fixed top-0 end-0 p-3" id="toastArea"></div>
  <script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>
  <script>
  $(function(){
    "use strict";
    // Password toggle
    $("#togglePassword").on("click", function(){
      var $pw = $("#loginPassword"), show = $pw.attr("type") === "password";
      $pw.attr("type", show ? "text" : "password");
      $(this).attr("aria-label", show ? "Hide password" : "Show password").find("i").toggleClass("bi-eye bi-eye-slash");
    });
    // Demo links
    $("[data-demo]").on("click", function(e){
      e.preventDefault();
      alert($(this).data("demo"));
    });
  });
  </script>
</body>
</html>

