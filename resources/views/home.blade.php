@extends('layouts.app')

@section('title', 'Markham Infiniti | Home')

@section('content')
  <main id="main">

    <!-- ============ SECTION 2: HERO / BANNER ============ -->
    <section class="hero" aria-label="Featured vehicles">
      <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('assets/frontend/images/banner.jpg') }}" class="hero-img" width="1300" height="668"
                 alt="2015 Infiniti QX70 on display in the showroom, starting at $53,500">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/frontend/images/banner.jpg') }}" class="hero-img" width="1300" height="668" loading="lazy"
                 alt="2015 Infiniti QX70 on display in the showroom, starting at $53,500 (slide 2)">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/frontend/images/banner.jpg') }}" class="hero-img" width="1300" height="668" loading="lazy"
                 alt="2015 Infiniti QX70 on display in the showroom, starting at $53,500 (slide 3)">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/frontend/images/banner.jpg') }}" class="hero-img" width="1300" height="668" loading="lazy"
                 alt="2015 Infiniti QX70 on display in the showroom, starting at $53,500 (slide 4)">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/frontend/images/banner.jpg') }}" class="hero-img" width="1300" height="668" loading="lazy"
                 alt="2015 Infiniti QX70 on display in the showroom, starting at $53,500 (slide 5)">
          </div>
        </div>

        <button class="carousel-control-prev hero-control" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="hero-control-icon"><i class="bi bi-chevron-left" aria-hidden="true"></i></span>
          <span class="visually-hidden">Previous slide</span>
        </button>
        <button class="carousel-control-next hero-control" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="hero-control-icon"><i class="bi bi-chevron-right" aria-hidden="true"></i></span>
          <span class="visually-hidden">Next slide</span>
        </button>
      </div>
    </section>

    <!-- ============ WELCOME ============ -->
    <section class="welcome" aria-labelledby="welcomeTitle">
      <div class="container">
        <h1 class="section-title" id="welcomeTitle">Welcome to Markham Infiniti</h1>
        <p class="welcome-text">
          Markham Infiniti is a family owned business in Toronto that has been servicing the GTA market since Infiniti was introduced.
          Agincourt Infiniti was one of the original fifteen Infiniti dealers appointed in Canada in 1990, and in October 2007 we
          relocated to Unionville, Ontario under our new name "Markham Infiniti".
        </p>
      </div>
    </section>

    <!-- ============ SECTION 3: QUICK LINKS ============ -->
    <section class="quick-links-section" aria-label="Quick links">
      <div class="container">
        <ul class="row g-0 list-unstyled mb-0 quick-links">

          <li class="col-12 col-sm-6 col-lg-3 quick-col">
            <a href="#" class="quick-link" aria-label="Shop New Vehicles">
              <span class="quick-circle">
                <img class="icon-default" src="{{ asset('assets/frontend/images/ui/cta-new.png') }}" alt="" width="72" height="65">
                <img class="icon-hover" src="{{ asset('assets/frontend/images/ui/cta-new-white.png') }}" alt="" width="108" height="95">
                <span class="quick-label">Shop New<br>Vehicles</span>
              </span>
              <span class="quick-shadow" aria-hidden="true"></span>
            </a>
            <img class="connector connector-1 d-none d-lg-block" src="{{ asset('assets/frontend/images/ui/dotted-1.png') }}" alt="" width="201" height="56">
          </li>

          <li class="col-12 col-sm-6 col-lg-3 quick-col">
            <a href="#" class="quick-link" aria-label="Shop Used Vehicles">
              <span class="quick-circle">
                <img class="icon-default" src="{{ asset('assets/frontend/images/ui/cta-used.png') }}" alt="" width="72" height="65">
                <img class="icon-hover" src="{{ asset('assets/frontend/images/ui/cta-used-white.png') }}" alt="" width="115" height="95">
                <span class="quick-label">Shop Used<br>Vehicles</span>
              </span>
              <span class="quick-shadow" aria-hidden="true"></span>
            </a>
            <img class="connector connector-2 d-none d-lg-block" src="{{ asset('assets/frontend/images/ui/dotted-2.png') }}" alt="" width="201" height="56">
          </li>

          <li class="col-12 col-sm-6 col-lg-3 quick-col">
            <a href="#" class="quick-link" aria-label="Service">
              <span class="quick-circle">
                <img class="icon-default" src="{{ asset('assets/frontend/images/ui/cta-service.png') }}" alt="" width="72" height="68">
                <img class="icon-hover" src="{{ asset('assets/frontend/images/ui/cta-service-white.png') }}" alt="" width="99" height="105">
                <span class="quick-label">Service</span>
              </span>
              <span class="quick-shadow" aria-hidden="true"></span>
            </a>
            <img class="connector connector-3 d-none d-lg-block" src="{{ asset('assets/frontend/images/ui/dotted-3.png') }}" alt="" width="195" height="62">
          </li>

          <li class="col-12 col-sm-6 col-lg-3 quick-col">
            <a href="#" class="quick-link" aria-label="Specials">
              <span class="quick-circle">
                <img class="icon-default" src="{{ asset('assets/frontend/images/ui/cta-specials.png') }}" alt="" width="72" height="68">
                <img class="icon-hover" src="{{ asset('assets/frontend/images/ui/cta-specials-white.png') }}" alt="" width="99" height="105">
                <span class="quick-label">Specials</span>
              </span>
              <span class="quick-shadow" aria-hidden="true"></span>
            </a>
          </li>

        </ul>
      </div>
    </section>

    <!-- ============ SECTION 4: MODEL SHOWROOM (DYNAMIC) ============ -->
    <section class="showroom" id="model-showroom" aria-labelledby="showroomTitle">
      <div class="container">
        <h2 class="section-title" id="showroomTitle">Model Showroom</h2>

        @if($models->isNotEmpty())
        <div class="showroom-carousel" data-showroom-carousel>
          <div class="vehicle-grid" data-showroom-track>
          @foreach($models as $model)
          <div class="vehicle-slide">
            <article class="vehicle-card">
              <h3 class="vehicle-name">{{ $model->year }} {{ $model->model_name }}</h3>
              <img class="vehicle-img img-fluid"
                   src="{{ $model->image ? asset('storage/vehicles/' . $model->image) : asset('assets/frontend/images/vehicles/q50.png') }}"
                   width="225" height="110"
                   alt="{{ $model->year }} Infiniti {{ $model->model_name }}">
              <p class="vehicle-price">{{ $model->description ?: '$' . number_format($model->price, 0) }}</p>
              <a href="#" class="btn btn-details" aria-label="View details for {{ $model->year }} {{ $model->model_name }}">View Details</a>
            </article>
          </div>
          @endforeach
          </div>
          @if($models->count() > 1)
          <button class="showroom-control showroom-control-prev" type="button" data-showroom-prev aria-label="Previous vehicle models"><i class="bi bi-chevron-left" aria-hidden="true"></i></button>
          <button class="showroom-control showroom-control-next" type="button" data-showroom-next aria-label="Next vehicle models"><i class="bi bi-chevron-right" aria-hidden="true"></i></button>
          <div class="showroom-dots" data-showroom-dots aria-label="Vehicle model pages"></div>
          @endif
        </div>
        @else
        <div class="showroom-empty text-center py-5"><p class="text-muted mb-0">No models available at this time. Please check back soon.</p></div>
        @endif
      </div>
    </section>

  </main>
@endsection

