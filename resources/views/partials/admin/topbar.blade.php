    <!-- Top navigation -->
    <header class="topbar">
      <button type="button" class="icon-btn" id="sidebarToggle" aria-label="Toggle sidebar" aria-controls="sidebar"><i class="bi bi-list"></i></button>
      <form class="topbar-search" id="globalSearch" role="search" action="{{ route('admin.models.index') }}" method="GET">
        <i class="bi bi-search" aria-hidden="true"></i>
        <label for="topSearch" class="visually-hidden">Search models</label>
        <input id="topSearch" name="search" type="search" class="form-control" placeholder="Search models..." value="{{ request('search') }}">
      </form>
      <div class="topbar-actions">
        <div class="dropdown">
          <button class="icon-btn" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false" aria-label="Notifications"><i class="bi bi-bell"></i><span class="dot"></span></button>
          <div class="dropdown-menu dropdown-menu-end notif-menu">
            <div class="d-flex justify-content-between align-items-center px-3 py-3 border-bottom"><strong class="text-navy">Notifications</strong><span class="status-badge is-active">3 new</span></div>
            <a class="notif-item text-decoration-none text-body" href="{{ route('admin.models.index') }}"><span class="avatar" style="width:36px;height:36px"><i class="bi bi-car-front"></i></span><div><div class="fw-semibold">New model added</div><small class="text-muted">2015 Q60 Coupe was added &middot; 2h ago</small></div></a>
            <a class="notif-item text-decoration-none text-body" href="{{ route('admin.models.index') }}"><span class="avatar" style="width:36px;height:36px;background:#0B1F3A"><i class="bi bi-pencil"></i></span><div><div class="fw-semibold">Price updated</div><small class="text-muted">QX70 price changed &middot; Yesterday</small></div></a>
            <a class="notif-item text-decoration-none text-body" href="{{ route('admin.models.index') }}"><span class="avatar" style="width:36px;height:36px;background:#16a34a"><i class="bi bi-check2"></i></span><div><div class="fw-semibold">Model activated</div><small class="text-muted">QX60 is now live &middot; 2 days ago</small></div></a>
          </div>
        </div>
        <div class="dropdown">
          <button class="profile-btn dropdown-toggle-no-caret" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile menu">
            <span class="avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}{{ strtoupper(substr(Auth::user()->name ?? 'D', 1, 1)) }}</span>
            <span class="d-none d-md-block"><span class="profile-name">{{ Auth::user()->name ?? 'Admin User' }}</span><span class="profile-role">Administrator</span></span>
            <i class="bi bi-chevron-down d-none d-md-inline text-muted small"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li class="px-3 py-2"><div class="fw-semibold">{{ Auth::user()->name ?? 'Admin User' }}</div><small class="text-muted">{{ Auth::user()->email ?? '' }}</small></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" data-demo="Profile page is not part of this release."><i class="bi bi-person me-2"></i>My Profile</a></li>
            <li><a class="dropdown-item" href="#" data-demo="Settings is not part of this release."><i class="bi bi-gear me-2"></i>Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"
                 onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </header>

