  <header class="site-header">
    <div class="container header-inner">

      <a class="brand" href="{{ route('home') }}" aria-label="Markham Infiniti - Home">
        <img src="{{ asset('assets/frontend/images/logo.png') }}" alt="Infiniti - Inspired Performance - Markham Infiniti" width="200" height="190">
      </a>

      <div class="header-main">

        <!-- Top contact bar -->
        <div class="topbar">
          <ul class="topbar-info list-unstyled mb-0">
            <li class="topbar-item d-none d-xl-flex">
              <img src="{{ asset('assets/frontend/images/ui/location.png') }}" alt="" width="13" height="18">
              <span>4340 Hwy 7 E, Markham, ON L3R 1L9</span>
            </li>
            <li class="topbar-item">
              <img src="{{ asset('assets/frontend/images/ui/call.png') }}" alt="" width="13" height="18">
              <a href="tel:+19057520881">(905) 752-0881</a>
            </li>
            <li class="topbar-item">
              <img src="{{ asset('assets/frontend/images/ui/toll-free.png') }}" alt="" width="19" height="20">
              <span>Sales : <a href="tel:+18667981346">(866) 798-1346</a></span>
            </li>
          </ul>

          <div class="topbar-hours d-none d-lg-block">
            <label for="dealershipHours" class="visually-hidden">Dealership hours</label>
            <select id="dealershipHours" class="form-select form-select-sm hours-select">
              <option selected>Dealership Hours</option>
              <option>Mon - Thu: 9:00 AM - 8:00 PM</option>
              <option>Fri: 9:00 AM - 6:00 PM</option>
              <option>Sat: 9:00 AM - 5:00 PM</option>
              <option>Sun: Closed</option>
            </select>
          </div>

          <ul class="social list-unstyled mb-0">
            <li><a href="#" aria-label="Facebook"><img src="{{ asset('assets/frontend/images/ui/fb.png') }}" alt="" width="35" height="51"></a></li>
            <li><a href="#" aria-label="Twitter"><img src="{{ asset('assets/frontend/images/ui/tw.png') }}" alt="" width="35" height="51"></a></li>
            <li><a href="#" aria-label="YouTube"><img src="{{ asset('assets/frontend/images/ui/yt.png') }}" alt="" width="35" height="51"></a></li>
          </ul>
        </div>

        <!-- Main navigation -->
        <nav class="navbar navbar-expand-lg main-nav" aria-label="Main navigation">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                  aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
          </button>
          <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav main-menu">
              <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#">New Vehicles</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Used Vehicles</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Service</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Parts</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Financial Services</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>

