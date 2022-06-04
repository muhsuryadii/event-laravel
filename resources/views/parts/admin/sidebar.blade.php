  <aside
      class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
      id="sidenav-main">
      <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
              aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand m-0 d-flex align-items-center"
              href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
              <img src={{ asset('image/logo_usni.png') }} class="navbar-brand-img h-100" alt="main_logo">
              <span class="ms-3 font-weight-bold title-app">{{ config('app.name', 'Laravel') }}</span>
          </a>
      </div>

      <hr class="horizontal dark mt-0">

      {{-- Sidebar Nav item --}}
      <div class="collapse navbar-collapse w-auto h-fit " id="sidenav-collapse-main">
          <ul class="navbar-nav">

              {{-- Dashboard --}}
              <li class="nav-item">
                  <a class="nav-link {{ Request::is('dashboard') ? 'active' : ' ' }} "
                      href={{ route('dashboard_admin') }}>
                      <div
                          class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Dashboard</span>
                  </a>
              </li>

              {{-- Event --}}
              <li class="nav-item">
                  <a class="nav-link  {{ Request::is('admin/events*') ? 'active' : ' ' }}"
                      href={{ route('admin_events') }}>
                      <div
                          class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Event</span>
                  </a>
              </li>
              {{-- Transaksi --}}
              <li class="nav-item">
                  <a class="nav-link " href="../pages/billing.html">
                      <div
                          class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Billing</span>
                  </a>
              </li>
              {{-- Laporan --}}
              <li class="nav-item">
                  <a class="nav-link " href="../pages/virtual-reality.html">
                      <div
                          class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-app text-info text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1">Virtual Reality</span>
                  </a>
              </li>
              <li>
                  <hr class="dropdown-divider">
              </li>
              <li class="nav-item">
                  <a class="nav-link " href="#">
                      <div
                          class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                      </div>
                      <span class="nav-link-text ms-1"> {{ Auth::user()->nama_user }}</span>
                  </a>
              </li>

              <li class="nav-item">
                  <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a class="nav-link " href="{{ route('logout') }}"
                          onclick="event.preventDefault();this.closest('form').submit();">
                          <div
                              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                              <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
                          </div>
                          <span class="nav-link-text ms-1">Logout</span>
                      </a>
                  </form>
              </li>
          </ul>
      </div>
  </aside>
