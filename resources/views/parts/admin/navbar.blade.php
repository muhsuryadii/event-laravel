 <!-- Navbar -->
 <nav class="navbar navbar-main navbar-expand-lg border-radius-xl mx-4 px-0 shadow-none" id="navbarBlur"
   data-scroll="false">
   <div class="container-fluid py-1 px-3">
     <nav aria-label="breadcrumb">
       <ol class="breadcrumb me-sm-6 me-5 mb-0 bg-transparent px-0 pb-0 pt-1">
         <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href={{ route('dashboard_admin') }}>Pages</a>
         </li>
         @if (Request::is('dashboard'))
           <li class="breadcrumb-item active text-sm text-white" aria-current="page">
             <a href={{ route('dashboard_admin') }} class='text-white'>
               Dashboard
             </a>
           </li>
         @elseif (Request::is('admin/events*'))
           <li class="breadcrumb-item active text-sm text-white" aria-current="page">
             <a href={{ route('admin_events_index') }} class='text-white'>
               Event
             </a>
           </li>
         @elseif (Request::is('admin/transaksi*'))
           <li class="breadcrumb-item active text-sm text-white" aria-current="page">
             <a href={{ route('admin_transaksi_index') }} class='text-white'>
               Pembayaran
             </a>
           </li>
         @elseif (Request::is('admin/report*'))
           <li class="breadcrumb-item active text-sm text-white" aria-current="page">
             <a href={{ route('admin_report_index') }} class='text-white'>
               Laporan
             </a>
           </li>
         @else
           <li class="breadcrumb-item active text-sm text-white" aria-current="page">
             <a href={{ route('admin_panitia_index') }} class='text-white'>
               Panitia
             </a>
           </li>
         @endif




       </ol>
       <h3 class="font-weight-bolder mb-0 mt-3 text-2xl text-white">
         @if (Request::is('dashboard'))
           Dashboard
         @elseif (Request::is('admin/events*'))
           @if (Request::is('admin/events'))
             Event
           @elseif (Request::is('admin/events/create'))
             Tambah Event
           @elseif (Request::is('admin/events/*/edit'))
             Edit Event
           @endif
         @elseif (Request::is('admin/transaksi*'))
           Pembayaran
         @elseif (Request::is('admin/report*'))
           Laporan
         @else
           Panitia
         @endif
       </h3>
     </nav>

     <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4 mt-2" id="navbar">
       <div class="ms-md-auto pe-md-3 d-flex align-items-center">
         {{-- <div class="input-group">
           <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
           <input type="text" class="form-control" placeholder="Type here...">
         </div> --}}
       </div>
       <ul class="navbar-nav justify-content-end">

         {{-- <li class="nav-item d-flex align-items-center  pe-1">
                     <a href="#" class="nav-link text-white font-weight-bold px-0">
                         <i class="fa fa-user me-sm-1"></i>
                         <span class="d-sm-inline d-none">
                             {{ Auth::user()->nama_user }}
                         </span>
                     </a>
                 </li> --}}

         <li class="nav-item dropdown ps-2 d-flex align-items-center pe-2">
           <a href="javascript:;" class="nav-link p-0 text-white" id="userDropdown" data-bs-toggle="dropdown"
             aria-expanded="false">
             <i class="fa fa-user me-sm-1"></i>
             <span class="d-sm-inline d-none">
               Hi, {{ Auth::user()->nama_user }}
             </span>
           </a>
           <ul class="dropdown-menu dropdown-menu-end me-sm-n4 px-2 py-3" aria-labelledby="userDropdown"
             style="top:0 !important">
             <li class="mb-2">
               <a class="dropdown-item border-radius-md" href="#">
                 <div class="d-flex py-1">
                   <div class="my-auto">
                     <i class="fa fa-user avatar avatar-sm bg-gradient-primary fs-5 me-3 text-white"></i>
                   </div>
                   <div class="d-flex flex-column justify-content-center">
                     <h5 class="font-weight-normal mb-1 text-sm">
                       <span class="font-weight-bold">Profile</span>
                       <p class="text-secondary mb-0 text-xs text-inherit">
                         {{ Auth::user()->nama_user }}
                       </p>
                     </h5>
                   </div>
                 </div>
               </a>
             </li>

             <li class="mb-2">
               <a class="dropdown-item border-radius-md" href="{{ route('home') }}">
                 <div class="d-flex py-1">
                   <div class="my-auto">
                     <i class="fa-solid fa-house avatar avatar-sm bg-gradient-success fs-5 me-3 text-white"></i>
                   </div>
                   <div class="d-flex flex-column justify-content-center">
                     <h5 class="font-weight-normal mb-1 text-sm">
                       <span class="font-weight-bold">Home</span>
                     </h5>
                   </div>
                 </div>
               </a>
             </li>

             <li class="mb-2">
               <form method="POST" action="{{ route('logout') }}">
                 @csrf
                 <a class="dropdown-item border-radius-md" href="{{ route('logout') }}"
                   onclick="event.preventDefault();this.closest('form').submit();">
                   <div class="d-flex py-1">
                     <div class="my-auto">
                       <i class="fas fa-sign-out-alt avatar avatar-sm bg-gradient-danger fs-5 me-3 text-white"></i>
                     </div>
                     <div class="d-flex flex-column justify-content-center">
                       <h5 class="font-weight-normal mb-1 text-sm">
                         <span class="font-weight-bold">Logout</span>
                       </h5>
                     </div>
                   </div>
                 </a>
               </form>
             </li>
           </ul>
         </li>


         {{-- Hamburger Button --}}
         <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
           <a href="javascript:;" class="nav-link p-0 text-white" id="iconNavbarSidenav">
             <div class="sidenav-toggler-inner">
               <i class="sidenav-toggler-line bg-white"></i>
               <i class="sidenav-toggler-line bg-white"></i>
               <i class="sidenav-toggler-line bg-white"></i>
             </div>
           </a>
         </li>

         {{-- Notification Button --}}

         {{-- <li class="nav-item dropdown ps-2 d-flex align-items-center">
                     <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                         data-bs-toggle="dropdown" aria-expanded="false">
                         <i class="fa fa-bell cursor-pointer"></i>
                     </a>
                     <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                         aria-labelledby="dropdownMenuButton">
                         <li class="mb-2">
                             <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                     <div class="my-auto">
                                         <img src={{ asset('argon/img/team-2.jpg') }} class="avatar avatar-sm  me-3 ">
                                     </div>
                                     <div class="d-flex flex-column justify-content-center">
                                         <h6 class="text-sm font-weight-normal mb-1">
                                             <span class="font-weight-bold">New message</span> from Laur
                                         </h6>
                                         <p class="text-xs text-secondary mb-0">
                                             <i class="fa fa-clock me-1"></i>
                                             13 minutes ago
                                         </p>
                                     </div>
                                 </div>
                             </a>
                         </li>
                         <li class="mb-2">
                             <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                     <div class="my-auto">
                                         <img src={{ asset('argon/img/small-logos/logo-spotify.svg') }}
                                             class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                     </div>
                                     <div class="d-flex flex-column justify-content-center">
                                         <h6 class="text-sm font-weight-normal mb-1">
                                             <span class="font-weight-bold">New album</span> by Travis Scott
                                         </h6>
                                         <p class="text-xs text-secondary mb-0">
                                             <i class="fa fa-clock me-1"></i>
                                             1 day
                                         </p>
                                     </div>
                                 </div>
                             </a>
                         </li>
                         <li>
                             <a class="dropdown-item border-radius-md" href="javascript:;">
                                 <div class="d-flex py-1">
                                     <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                         <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                             <title>credit-card</title>
                                             <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                 <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF"
                                                     fill-rule="nonzero">
                                                     <g transform="translate(1716.000000, 291.000000)">
                                                         <g transform="translate(453.000000, 454.000000)">
                                                             <path class="color-background"
                                                                 d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"
                                                                 opacity="0.593633743"></path>
                                                             <path class="color-background"
                                                                 d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z">
                                                             </path>
                                                         </g>
                                                     </g>
                                                 </g>
                                             </g>
                                         </svg>
                                     </div>
                                     <div class="d-flex flex-column justify-content-center">
                                         <h6 class="text-sm font-weight-normal mb-1">
                                             Payment successfully completed
                                         </h6>
                                         <p class="text-xs text-secondary mb-0">
                                             <i class="fa fa-clock me-1"></i>
                                             2 days
                                         </p>
                                     </div>
                                 </div>
                             </a>
                         </li>
                     </ul>
                 </li> --}}
       </ul>
     </div>
   </div>
 </nav>
 <!-- End Navbar -->
