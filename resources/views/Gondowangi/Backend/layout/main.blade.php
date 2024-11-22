<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-dark"
  data-assets-path="{{ asset('backe') }}nd/assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    @yield('head')
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/favicon/favi') }}con.ico" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/costum.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css" class="template-customizer-c') }}ore-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/d') }}emo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scroll') }}bar.css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-cha') }}rts.css" />

    <!-- Helpers -->
    <script src="{{ asset('frontend/assets/vendor/helpers.js') }}"></script>
    <script src="{{ asset('frontend/assets/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="/beranda" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <strong>
                            LMS
                        </strong>
                    </span>
                </a>
            </div>
  
            <div class="menu-inner-shadow"></div>
  
            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard" class="menu-link menu-link">
                        <i class="menu-icon tf-icons bx bx-home-smile"></i>
                        <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
                    </a>
                </li>
  
                <!-- Main Manage -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">UTAMA</span>
                </li>
  
                <!-- Kelas -->
                <li class="menu-item {{ Request::is('kelolakelas*') || Request::is('kategorikelas*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-chalkboard"></i>
                        <div class="text-truncate" data-i18n="Layouts">Kelas</div>
                    </a>
    
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('kelolakelas*') ? 'active' : '' }}">
                            <a href="/kelolakelas" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">Kelola Kelas</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('kategorikelas*') ? 'active' : '' }}">
                            <a href="/kategorikelas" class="menu-link">
                                <div class="text-truncate" data-i18n="Without navbar">Kategori Kelas</div>
                            </a>
                        </li>
                    </ul>
                </li>
    
                <!--Modul dan Test -->
                <li class="menu-item {{ Request::is('kelolamodul*') || Request::is('kelolatest*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-book-content"></i>
                        <div class="text-truncate" data-i18n="Layouts">Modul dan Test</div>
                    </a>
    
                    <!-- Content wrapper -->
                    <ul class="menu-sub">
                      <li class="menu-item {{ Request::is('kelolamodul*') ? 'active' : '' }}">
                          <a href="/kelolamodul" class="menu-link">
                              <div class="text-truncate" data-i18n="Without menu">Kelola Modul</div>
                          </a>
                      </li>
                      <li class="menu-item {{ Request::is('kelolatest*') ? 'active' : '' }}">
                          <a href="/kelolatest" class="menu-link">
                              <div class="text-truncate" data-i18n="Without navbar">Kelola Test</div>
                          </a>
                      </li>
                    </ul>
                </li>
    
                <!-- Webinar dan Artikel -->
                <li class="menu-item {{ Request::is('kelolawebinar*') || Request::is('kelolainformasi*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-news"></i>
                        <div class="text-truncate" data-i18n="Layouts">Wawasan</div>
                    </a>
    
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('kelolawebinar*') ? 'active' : '' }}">
                            <a href="/kelolawebinar" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">Kelola Webinar</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('kelolainformasi*') ? 'active' : '' }}">
                            <a href="/kelolainformasi" class="menu-link">
                                <div class="text-truncate" data-i18n="Without navbar">Kelola Informasi</div>
                            </a>
                        </li>
                    </ul>
                </li>
    
                <!-- Karyawan -->
                <li class="menu-item {{ Request::is('kelolakaryawan*') || Request::is('kelolakoin*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div class="text-truncate" data-i18n="Layouts">Karyawan</div>
                    </a>
    
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('kelolakaryawan*') ? 'active' : '' }}">
                            <a href="/kelolakaryawan" class="menu-link">
                                <div class="/kelolakaryawan" data-i18n="Without menu">Data Karyawan</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('kelolakoin*') ? 'active' : '' }}">
                            <a href="/kelolakoin" class="menu-link">
                                <div class="text-truncate" data-i18n="Without navbar">Atur Koin</div>
                            </a>
                        </li>
                    </ul>
                </li>
    
                {{-- pemantauanTraining --}}
                <li class="menu-item {{ Request::is('pemantauanTraining*') ? 'active' : '' }}">
                    <a
                        href="/pemantauanTraining"
                        class="menu-link">
                        <i class='menu-icon tf-icons bx bx-spreadsheet'></i>
                        <div class="text-truncate" data-i18n="Chat">Pemantauan Training</div>
                    </a>
                </li>
              
                {{-- aktivitaskaryawan --}}
                <li class="menu-item {{ Request::is('aktivitaskaryawan*') ? 'active' : '' }}">
                    <a
                        href="/aktivitaskaryawan"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-sitemap"></i>
                        <div class="text-truncate" data-i18n="Chat">Aktivitas Karyawan</div>
                    </a>
                </li>
              
                <!-- Components -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
                
                {{-- kelolastruktur --}}
                <li class="menu-item {{ Request::is('kelolastruktur*') ? 'active' : '' }}">
                    <a
                        href="/kelolastruktur"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-buildings"></i>
                        <div class="text-truncate" data-i18n="Chat">Kelola Struktur</div>
                    </a>
                </li>
    
                <!-- faq -->
                <li class="menu-item {{ Request::is('kelolafaq*') || Request::is('kategorifaq*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-help-circle"></i>
                        <div class="text-truncate" data-i18n="Layouts">FAQ</div>
                    </a>
    
                    <ul class="menu-sub {{ Request::is('kelolafaq*') ? 'active' : '' }}">
                        <li class="menu-item">
                            <a href="/kelolafaq" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">Kelola FAQ</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('kategorifaq*') ? 'active' : '' }}">
                            <a href="/kategorifaq" class="menu-link">
                                <div class="text-truncate" data-i18n="Without navbar">Kategori Faq</div>
                            </a>
                        </li>
                    </ul>
                </li>
    
                {{-- Komentar --}}
                <li class="menu-item {{ Request::is('komentarkelas*') ? 'active' : '' }}">
                    <a
                        href="/komentarkelas"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-message-dots"></i>
                        <div class="text-truncate" data-i18n="Chat">Kelola Komentar</div>
                        <div class="badge rounded-pill bg-label-danger text-uppercase fs-tiny ms-auto">
                            @if($jumlahDraf > 0)
                                {{ $jumlahDraf }}
                            @endif
                        </div>
                    </a>
                </li>
    
                {{-- pengaduan --}}
                <li class="menu-item {{ Request::is('blog*') || Request::is('pengaduankaryawan*') ? 'active' : '' }}">
                    <a
                        href="/pengaduankaryawan"
                        class="menu-link">
                        <i class="menu-icon tf-icons bx bx-error-circle"></i>
                        <div class="text-truncate" data-i18n="Chat">Pengaduan</div>
                        <div class="badge rounded-pill bg-label-danger text-uppercase fs-tiny ms-auto">{{ $jumlahPengaduanInProgress }}</div>
                    </a>
                </li>
    
                <!-- Website Components -->
                <li class="menu-item {{ Request::is('blog*') || Request::is('banner*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-globe"></i>
                        <div class="text-truncate" data-i18n="Layouts">Komponen Website</div>
                    </a>
    
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="/kelolafaq" class="menu-link">
                                <div class="text-truncate" data-i18n="Without menu">Banner</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- superadmin -->
                <li class="menu-header small text-uppercase"><span class="menu-header-text">Superadmin</span></li>
                {{-- Kelola Admin --}}
                <li class="menu-item">
                  <a
                      href="/kelolaadmin"
                      class="menu-link">
                      <i class="menu-icon tf-icons bx bx-user-circle"></i>
                      <div class="text-truncate" data-i18n="Chat">Kelola Admin</div>
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
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="bx bx-menu bx-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search bx-sm"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none ps-1 ps-sm-2"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item bg-label-primary p-1 rounded lh-1 me-4" style="cursor: pointer;">
                  <a class="nav-link text-primary" data-icon="octicon-star" data-size="large" onclick="logoutConfirm()">
                    <i class='bx bx-log-out me-2'></i> Keluar
                  </a>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('backend/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">

            <!-- Content -->
            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                    <div
                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                        <div class="text-body">
                        ©2024
                        
                        , LMS Gondowangi
                        
                        </div>
                    </div>
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
    <!-- / Layout wrapper -->

    @if (!request()->is('pengaduankaryawan'))
      <div class="buy-now" style="cursor: pointer;">
          <a href="/pengaduankaryawan" class="btn btn-danger btn-buy-now" style="cursor: pointer;">
              <label for="" class="mr-4 me-3">Pengaduan</label>
              <div class="badge rounded bg-label-danger text-uppercase fs-tiny ms-auto" style="margin-left: 8px;">{{ $jumlahPengaduanInProgress }}</div>
          </a>
      </div>
    @endif


    <!-- Core JS -->
    @yield('script')
    <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/popper.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/perfect-scrollbar.js') }}"></script>
  
    <!-- Vendors JS -->
    <script src="{{ asset('frontend/assets/vendor/apexcharts.js') }}"></script>
  
    <!-- Main JS -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('frontend/assets/dashboards-analytics.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function logoutConfirm() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                text: "Anda akan logout dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6777ef',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form logout jika user mengonfirmasi
                    document.getElementById('logout-form').submit();
                }
            });
        }

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 4000,
                showConfirmButton: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                timer: 4000,
                showConfirmButton: true
            });
        @endif
    </script>

    <!-- Form logout tersembunyi -->
    <form id="logout-form" action="/keluar" method="POST" style="display: none;">
        @csrf
    </form> 
  </body>
</html>