<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta

    />

    <title>
      {{ @$title != '' ? "$title |" : '' }}
      {{ settings()->get('app_name', 'My APP') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat') }}/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat') }}/assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}">
    <style>
      .layout-navbar .navbar-dropdown .dropdown-menu {
        min-width: 22rem;
      }

      .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255,255,255,0.7);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .spinner-border {
        width: 3rem;
        height: 3rem;
      }
    </style>
     <script>
      popupCenter = ({url, title, w, h}) => {
      // Fixes dual-screen position                             Most browsers      Firefox
      const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
      const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;

      const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
      const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

      const systemZoom = width / window.screen.availWidth;
      const left = (width - w) / 2 / systemZoom + dualScreenLeft
      const top = (height - h) / 2 / systemZoom + dualScreenTop
      const newWindow = window.open(url, title, 
        `
        scrollbars=yes,
        width=${w / systemZoom}, 
        height=${h / systemZoom}, 
        top=${top}, 
        left=${left}
        `
      )

      if (window.focus) newWindow.focus();
      }
  </script>
  </head>
  <div class="loading-overlay d-none" id="loading-overlay">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="" width="70" height="25">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">My Catatan</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ \Route::is('operator.beranda') ? 'active' : '' }}">
              <a href="{{ route('operator.beranda') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
              </a>
            </li>
            <li class="menu-header">
              <div style="color: rgba(0, 0, 0, 0.185); font-weight: bold;">DATA MASTER</div>
            </li>
            <li class="menu-item {{ \Route::is('user.*') ? 'active' : '' }}">
              <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-users"></i>
                <div data-i18n="Basic">Data User</div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('setting.*') ? 'active' : '' }}">
              <a href="{{ route('setting.create') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-wand-magic-sparkles"></i>
                <div data-i18n="Basic">Penganturan Aplikasi</div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('bankperusahaan.*') ? 'active' : '' }}">
              <a href="{{ route('bankperusahaan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-landmark"></i>
                <div data-i18n="Basic">Rekening Perusahaan</div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('pengawas.*') ? 'active' : '' }}">
              <a href="{{ route('pengawas.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-user-tie"></i>
                <div data-i18n="Basic">Data Pengawas</div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('hutang.*') ? 'active' : '' }}">
              <a href="{{ route('hutang.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-sharp-duotone fa-solid fa-money-bill"></i>
                <div data-i18n="Basic">Data Hutang</div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('mandor.*') ? 'active' : '' }}">
              <a href="{{ route('mandor.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-users"></i>
                <div data-i18n="Basic">Data Mandor</div>
              </a>
            </li>
            <li class="menu-header">
              <div style="color: rgba(0, 0, 0, 0.185); font-weight: bold;">DATA TRANSAKSI</div>
            </li>
            <li class="menu-item {{ \Route::is('tagihan.*') ? 'active' : '' }}">
              <a href="{{ route('tagihan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-file-invoice"></i>
                <div data-i18n="Basic">Data Tagihan</div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('pembayaran.*') ? 'active' : '' }}">
              <a href="{{ route('pembayaran.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-file-invoice"></i>
                <div data-i18n="Basic">
                  Data Pembayaran
                  <span  class="badge badge-center rounded-pill bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                  </span>
                </div>
              </a>
            </li>
            <li class="menu-item {{ \Route::is('laporan.*') ? 'active' : '' }}">
              <a href="{{ route('laporanform.create') }}" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-file-invoice"></i>
                <div data-i18n="Basic">
                  Data Laporan
                </div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{ route('logout') }}" class="menu-link">
                <i class="bx bx-power-off me-2"></i>
                <div data-i18n="Basic">Logout</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                {!! Form::open(['route' => 'tagihan.index', 'method' => 'GET']) !!}
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Pencarian Data Tagihan ..."
                    aria-label="Search..."
                    name="q"
                    value="{{ request('q') }}"
                  />
                </div>
                {!! Form::close() !!}
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
               
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                      <i class="bx bx-bell bx-sm"></i>
                      <span class="badge rounded-pill bg-danger badge-notifications">
                        {{ auth()->user()->unreadNotifications->count() }}
                      </span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end p-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Notification</h6>
                        <div class="d-flex align-items-center h6 mb-0">
                          <span class="badge bg-label-primary me-2"></span>
                          <a href="javascript:void(0)" class="dropdown-notifications-all p-2" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read" data-bs-original-title="Mark all as read"><i class="bx bx-envelope-open text-heading"></i></a>
                        </div>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container ps">
                      <ul class="list-group list-group-flush">
                        @foreach (auth()->user()->unreadNotifications as $notification )
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <a href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}">
                          <div class="d-flex">
                            <div class="flex-grow-1">
                              <h6 class="small mb-0">{{ $notification->data['title'] }} 🎉</h6>
                              <small class="mb-1 d-block text-body">{{ ucwords($notification->data['messages']) }}</small>
                              <small class="text-muted">
                                {{ $notification->created_at->diffForHumans() }}
                              </small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                            </div>
                          </div>
                          </a>
                        </li>
                        @endforeach
                      </ul>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></li>
                    <li class="border-top">
                      <div class="d-grid p-4">
                        <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                          <small class="align-middle">View all notifications</small>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>

                <!-- User --> 
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('sneat') }}/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('sneat') }}/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->id) }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
              </div>
              @endif
              
            @yield('content')
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
             
              </div>
            </footer>
            <!-- / Footer -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('sneat') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('sneat') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('sneat') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('sneat') }}/assets/js/dashboards-analytics.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.0.0/apexcharts.min.js" integrity="sha512-f82EGNY/Wwa6E9g6tKFHoyiaytlgfd0g5gfaOJjSIF6k5T7vqmWrP83iXZdUZoc0DvO3kR4jRpmAZUBt5MhBbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.0.0/apexcharts.min.css" integrity="sha512-e3RSvqXJCnockRd9S0Qe7D2g3Gld0+6Sks/tpU2SGsJrvVHyfTopEf01UHhpGMaoTWqcepzRBKhFqAWJcD8guA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
          $('.rupiah').mask("#.##0", {reverse: true});
        $('.select2').select2();
        });
  </script>
  @yield('js')
  </body>
</html>
