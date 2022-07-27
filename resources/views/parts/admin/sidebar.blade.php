  <aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-xl fixed-start ms-4 my-3 border-0 bg-white shadow-md lg:shadow-lg"
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times text-secondary position-absolute end-0 d-none d-xl-none top-0 cursor-pointer p-3 opacity-5"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand d-flex align-items-center m-0" href={{ route('dashboard_admin') }} target="_blank">
        <img src={{ asset('image/logo_usni.png') }} class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-3 font-weight-bold title-app">{{ config('app.name', 'Laravel') }}</span>
      </a>
    </div>

    <hr class="horizontal dark mt-0">

    {{-- Sidebar Nav item --}}
    <div class="collapse navbar-collapse h-fit w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : ' ' }}" href={{ route('dashboard_admin') }}>
            <div
              class="icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center text-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        {{-- Event --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/events*') ? 'active' : ' ' }}"
            href={{ route('admin_events_index') }}>
            <div
              class="icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center text-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Event</span>
          </a>
        </li>
        {{-- Transaksi --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/transaksi*') ? 'active' : ' ' }}"
            href={{ route('admin_transaksi_index') }}>
            <div
              class="icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center text-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pembayaran</span>
          </a>
        </li>
        {{-- Laporan --}}
        <li class="nav-item">
          <a class="nav-link {{ Request::is('admin/report*') ? 'active' : ' ' }}"
            href="{{ route('admin_report_index') }}">
            <div
              class="icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center text-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Laporan</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <div
              class="icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center text-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"> {{ Auth::user()->nama_user }}</span>
          </a>
        </li>

        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();this.closest('form').submit();">
              <div
                class="icon icon-shape icon-sm border-radius-md me-2 d-flex align-items-center justify-content-center text-center">
                <i class="fas fa-sign-out-alt text-danger text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Logout</span>
            </a>
          </form>
        </li>
      </ul>
    </div>
  </aside>
