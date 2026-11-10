   <aside class="sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="sidebar" aria-label="Sidebar">
    <div class="sidebar-brand">
      <img src="{{ asset('assets/admin/images/logo.png') }}" alt="Markham Infiniti logo">
      <div class="brand-text"><span class="brand-name">Markham Infiniti</span><span class="brand-sub">Admin Panel</span></div>
      <button type="button" class="btn-close btn-close-white ms-auto d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebar" aria-label="Close menu"></button>
    </div>
    <div class="sidebar-body">
      <p class="nav-heading">Main Menu</p>
      <ul class="sidebar-nav">
          <li><a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" {{ request()->routeIs('admin.dashboard') ? 'aria-current=page' : '' }} href="{{ route('admin.dashboard') }}" title="Dashboard"><i class="bi bi-grid-1x2-fill"></i><span>Dashboard</span></a></li>
          <li><a class="sidebar-link {{ request()->routeIs('admin.models.index') ? 'active' : '' }}" {{ request()->routeIs('admin.models.index') ? 'aria-current=page' : '' }} href="{{ route('admin.models.index') }}" title="Model Showroom"><i class="bi bi-car-front-fill"></i><span>Model Showroom</span></a></li>
          <li><a class="sidebar-link {{ request()->routeIs('admin.models.create') ? 'active' : '' }}" {{ request()->routeIs('admin.models.create') ? 'aria-current=page' : '' }} href="{{ route('admin.models.create') }}" title="Add New Model"><i class="bi bi-plus-circle-fill"></i><span>Add New Model</span></a></li>
          </ul>
      <div class="sidebar-footer">
        <div class="sidebar-promo"><strong>Showroom is live</strong>Your public website shows all active models.</div>
        <ul class="sidebar-nav">
          <li><a class="sidebar-link" href="#" data-demo="Settings is not part of this release." title="Settings"><i class="bi bi-gear-fill"></i><span>Settings</span></a></li>
          <li>
            <a class="sidebar-link logout" href="{{ route('admin.logout') }}" title="Logout"
               onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
              <i class="bi bi-box-arrow-right"></i><span>Logout</span>
            </a>
            <form id="sidebar-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
          </li>
        </ul>
      </div>
    </div>
  </aside>

