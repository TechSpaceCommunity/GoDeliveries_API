<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

   <!--main Styles -->
   <link href="{{ asset('css/style.css') }}" rel="stylesheet">

   {{-- vendor bootstrap styles --}}
   <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
   <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
   <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
   <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
   <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">

  <!-- Scripts -->
  <script src="{{ asset('js/.js') }}" ></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body class="page-index">
    {{-- <div id="app"> --}}
       <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center " style="margin-bottom:3%">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/home') }}" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block"> <img src="assets/img/icon.png" alt="" width="60" height="100"></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>{{ Auth::user()->access }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('profileadmin') }}">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            
              <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ url('/home') }}">
          <i class="bi bi-house-fill"></i>
          <span>Home</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">General</li> 

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/profileadmin') }}">
          <i class="ri ri-hand-coin-fill"></i>
          <span>Vendors</span>
        </a>
      </li><!-- End Nav item -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/profileadmin') }}">
          <i class="ri ri-government-line"></i>
          <span>Restaurants</span>
        </a>
      </li><!-- End Nav item -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/profileadmin') }}">
          <i class="bi bi-tools"></i>
          <span>Restaurant Section</span>
        </a>
      </li><!-- End Nav item -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/profileadmin') }}">
          <i class="bi bi-people-fill"></i>
          <span>Users</span>
        </a>
      </li><!-- End Nav item -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/profileadmin') }}">
          <i class="ri ri-motorbike-line"></i>
          <span>Riders</span>
        </a>
      </li><!-- End Nav item -->
      
      <li class="nav-heading">MANAGEMENT</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-gear-fill"></i>
          <span>Configuration</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-credit-card-2-back-fill"></i>
          <span>Coupons</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-credit-card-2-front-fill"></i>
          <span>Cousines</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-cash-coin"></i>
          <span>Tipping</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-upc-scan"></i>
          <span>Zone</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-truck"></i>
          <span>Dispatch</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-bell-fill"></i>
          <span>Notifications</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-bootstrap-reboot"></i>
          <span>Commission Rates</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-slack"></i>
          <span>Withdraw Requests</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('profileadmin') }}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-in-left pl-3 ml-3"></i>
         {{ __('Logout') }}
     </a>
     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
       
    </li>
      <!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

       <div class="" style="padding-top: 0%">
        <main class="py-4">
          @include('inc.messages')
            @yield('content')
        </main>
       </div>
        </div>
      </div>
    </div>
  
    <div class="footer-legal text-center position-relative">
      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>{{ config('app.name', 'Max Tech Agencies') }}</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="#">{{ config('app.name', 'Max Tech Agencies') }}</a>
        </div>
      </div>
    </div>
  
  </footer>
  <!-- End Footer -->
  
  <a href="#" class="scroll-top d-flex align-items-end justify-content-center shadow-lg m-3 "  style="box-shadow: 2px 2px 4px black; float:right"><i class="bi bi-arrow-up-short bg-warning p-1 rounded-pill text-white font-bold" style="font-size: 1.2em"></i></a>
    </div>

    <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main1.js"></script>
 <!-- Scripts -->
 <script src="{{ asset('js/main1.js') }}" ></script>
 <script src="{{ asset('js/main.js') }}" ></script>
 <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
 <script src="{{ asset('vendor/aos/aos.js') }}" ></script>
 <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}" ></script>
 <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}" ></script>
 <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.j') }}" ></script>
 <script src="{{ asset('vendor/php-email-form/validate.js') }}" ></script>
</body>
</html>
