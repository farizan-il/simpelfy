<!doctype html>

<html lang="en" class="layout-menu-fixed layout-compact" dir="ltr" data-bs-theme="dark"
  data-assets-path="../assets/">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  @yield('head')

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/assets/costum.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/theme-default.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('frontend/assets/carousel.css') }}" />
  
  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{ asset('frontend/assets/vendor/helpers.js') }}"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <script src="{{ asset('frontend/assets/config.js') }}"></script>

  <style>
    .menu-item .menu-sub {
      display: none; /* Default, submenu tidak terlihat */
      position: absolute; /* Agar submenu muncul di atas elemen lain */
      top: 50px; /* Posisikan tepat di bawah item menu utama */
      left: auto;
      width: auto;
      background-color: #fff;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      opacity: 0; /* Supaya transparan dulu saat belum muncul */
      transform: translateY(-20px); /* Geser sedikit ke atas */
      transition: opacity 0.3s ease, transform 0.3s ease; /* Transisi halus */
      margin-top: 5px; /* Tambahkan sedikit margin untuk memperlebar area hover */
      z-index: 100; /* Memastikan submenu tetap di atas */
    }

    .menu-item:hover > .menu-sub,
    .menu-item .menu-sub:hover {
      display: block; /* Tampilkan submenu saat di-hover atau saat submenu di-hover */
      opacity: 1; /* Full opacity ketika submenu ditampilkan */
      transform: translateY(0); /* Geser dari atas ke bawah */
    }


    .menu-sub li {
      position: relative;
    }

    .menu-sub .menu-sub {
      left: 0; /* Position nested submenus to the right */
      top: 0;
    }

    .card-hover {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
      transform: scale(1.02);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }


    /* Tambahkan style untuk animasi hide and show aside */
    .hide-aside {
        transform: translateY(-100%); /* Menggeser ke atas */
        transition: transform 0.3s ease; /* Animasi smooth */
    }

    .show-aside {
        transform: translateY(0); /* Mengembalikan posisi ke semula */
        transition: transform 0.3s ease;
    }


    /* style untuk explorasi */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: #696cff; /* Warna primary Bootstrap */
        border-radius: 50%;
        padding: 10px;
        box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 1px, rgba(0, 0, 0, 0.07) 0px 2px 2px, rgba(0, 0, 0, 0.07) 0px 4px 4px, rgba(0, 0, 0, 0.07) 0px 8px 8px, rgba(0, 0, 0, 0.07) 0px 16px 16px;
    }
    .carousel-item {
        transition: transform 0.8s ease-in-out; /* Atur durasi dan easing untuk smooth transition */
    }

    .carousel-item {
        transition: transform 0.6s ease-in-out; /* Atur durasi dan kehalusan transisi */
    }

    .countdown-timer {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-family: 'Arial', sans-serif;
    }

    .countdown-section {
        text-align: center;
    }

    .countdown-time {
        font-size: 36px;
        font-weight: bold;
        color: #333;
    }

    .countdown-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #666;
        margin-top: 5px;
    }

    /* Style for the card, if you want a modern look */
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .countdown-timer {
        display: flex;
        justify-content: center;
        gap: 20px;
        font-family: 'Arial', sans-serif;
    }

    .countdown-section {
        text-align: center;
    }

    .countdown-time {
        font-size: 36px;
        font-weight: bold;
        color: #333;
    }

    .countdown-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #666;
        margin-top: 5px;
    }

    /* Ensure the card content grows to fill available space */
    .card {
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .mt-auto {
        margin-top: auto !important;
    }

    /* Card Shine Effect */
    .card-hover-shine-effect {
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-hover-shine-effect:hover {
        transform: scale(1.01);
    }

    .card-hover-shine-effect::before {
        content: "";
        position: absolute;
        top: -150%;
        left: -150%;
        width: 300%;
        height: 300%;
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(45deg);
        transition: opacity 0.3s;
        opacity: 0;
    }

    .card-hover-shine-effect:hover::before {
        opacity: 1;
        animation: shineEffect 1s ease forwards;
    }

    @keyframes shineEffect {
        0% {
            top: -150%;
            left: -150%;
        }
        100% {
            top: 150%;
            left: 150%;
        }
    }

  </style>
</head>

<body>

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
    <div class="layout-container">
      <!-- Navbar -->
      <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" @yield('hideforoboard') id="layout-navbar">
        <div class="container-xxl">
          <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
            <a href="/explore" class="app-brand-link gap-2">
              <span class="app-brand-text demo menu-text fw-bold text-heading">Simpelfy.Edu</span>
            </a>
            <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
              <i class="bx bx-chevron-left d-flex align-items-center justify-content-center"></i>
            </a>
          </div>
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0  d-xl-none  ">
            <a class="nav-item nav-link px-0 me-xl-6" href="">
              <i class="bx bx-menu"></i>
            </a>
          </div>

          <div class="input-group text-align-center" style="width: 400rem;">
            <input type="text" class="form-control" placeholder="Gass.... belajar sekarang juga!!" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text bg-primary text-white" id="basic-addon2">
              <i class="bx bx-search "></i>
            </span>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              @if (Auth::check())
                <!-- Keranjang -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                  <a class="nav-link dropdown-toggle hide-arrow" href="/keranjang">
                    <span class="bx bx-cart-alt" style="font-size: 22px;"></span>
                    <span class="badge rounded-pill bg-danger text-white badge-notifications">{{ $jumlahKeranjang }}</span>
                  </a>
                </li>
                <!--/ Notification -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                      <i class="bx bx-bell" style="font-size: 22px;"></i>
                      <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end p-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Notification</h6>
                        <div class="d-flex align-items-center h6 mb-0">
                          <span class="badge bg-label-warning me-2">8 New</span>
                          <a href="javascript:void(0)" class="dropdown-notifications-all p-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx bx-envelope-open text-heading"></i></a>
                        </div>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        @foreach ($notifikasi as $item)  
                          <li class="list-group-item list-group-item-action dropdown-notifications-item">
                            <div class="d-flex">
                              <div class="flex-grow-1">
                                <h6 class="small mb-0">{{ $item->kalimat }}</h6>
                                <small class="text-muted">{{ $item->created_at }}</small>
                              </div>
                              <div class="flex-shrink-0 dropdown-notifications-actions">
                                @if ( $item->isRead == 0)
                                  <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a> 
                                  <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                                @endif
                              </div>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                    </li>
                    <li class="border-top">
                      <div class="d-grid p-4">
                        <a class="btn btn-warning btn-sm d-flex" href="javascript:void(0);">
                          <small class="align-middle">View all notifications</small>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="https://static.vecteezy.com/system/resources/previews/012/177/622/original/man-avatar-isolated-png.png" alt class="w-px-40 h-auto rounded-circle">
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="https://static.vecteezy.com/system/resources/previews/012/177/622/original/man-avatar-isolated-png.png" alt class="w-px-40 h-auto rounded-circle">
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0">Farizan</h6>
                            <small class="text-muted">Web Developer</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center">
                        <strong>
                          <i class='bx bxs-wallet me-3 text-warning'></i><span class="text-warning">IDR {{ number_format(Auth::user()->gonpay, 0, ',', '.') }}</span>
                        </strong>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="/dashboarduser">
                        <i class="bx bxs-dashboard  me-3"></i><span>Dashboard</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="/profilesaya">
                        <i class="bx bx-user  me-3"></i><span>Profile Saya</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="/kelassaya">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-book-open  me-3"></i><span
                            class="flex-grow-1 align-middle">Kelas Saya</span>
                          <span class="flex-shrink-0 badge rounded-pill bg-info">{{ $jumlahkelassaya }}</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" href="/pengaduan">
                        <i class="bx bxs-message-rounded-error me-3"></i><span>Pengaduan</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1"></div>
                    </li>
                    <li>
                      <a class="dropdown-item align-items-center" onclick="logoutConfirm()">
                        <i class="bx bx-power-off me-3"></i><span>Logout</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              @else
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                  <div class="d-grid p-4">
                    <a class="btn btn-primary btn-md d-flex" href="/masuk">
                      <small class="align-middle text-white">Login</small>
                    </a>
                  </div>
                </li>
              @endif
            </ul>
          </div>
          <!-- Search Small Screens -->
          <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
            <input type="text" class="form-control search-input  border-0" placeholder="Search..."
              aria-label="Search...">
            <i class="bx bx-x bx-md search-toggler cursor-pointer"></i>
          </div>
        </div>
      </nav>
      <!-- / Navbar -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Menu -->
          @yield('content-belajar')
          <aside id="layout-menu" class=" layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0" @yield('hideforoboard') @yield('hide')>
            <div class="container-xxl d-flex h-100">
              <ul class="menu-inner">
                <!-- Dashboards -->
                <li class="menu-item {{ Request::is('explore') ? 'active' : '' }}">
                  <a href="/explore" class="menu-link ">
                    <div data-i18n="Dashboards">Explorasi</div>
                  </a>
                </li>

                <!-- Kategori -->
                <li class="menu-item {{ Request::is('kelaswajib') || Request::is('kelaswajib/*') || Request::is('artikel') || Request::is('artikel/*') ? 'active' : '' }}">
                  <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <div data-i18n="Layouts">Kategori</div>
                  </a>
                
                  <ul class="menu-sub">
                    <li class="menu-item {{ Request::is('kelaswajib') || Request::is('kelaswajib/*') ? 'active' : '' }}">
                      <a href="/kelaswajib" class="menu-link">
                        <div style="margin-left: 14px;">Kelas Wajib
                          <span class="badge rounded-pill bg-label-danger">sisa {{ $jumlahKelasWajib }}</span>
                        </div>
                      </a>
                    </li>
                
                    <li class="menu-item {{ Request::is('webinar') ? 'active' : '' }}">
                      <a href="/webinar" class="menu-link">
                        <div style="margin-left: 14px;">Webinar</div>
                      </a>
                    </li>
                    
                    <li class="menu-item {{ Request::is('artikel') || Request::is('artikel/*') ? 'active' : '' }}">
                      <a href="/artikel" class="menu-link">
                        <div style="margin-left: 14px;">Artikel</div>
                      </a>
                    </li>
                  </ul>
                </li>

                @foreach ($kategori as $item)
                    <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                            <div data-i18n="Layouts">{{ $item->namaKategori }}</div>
                        </a>
                        <ul class="menu-sub">
                            @foreach ($item->subkategori as $sub)
                                <li class="menu-item">
                                    <a href="/coming" class="menu-link">
                                        <div style="margin-left: 14px;">{{ $sub->namaSubkategori }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
              </ul>
            </div>
          </aside>
          <!-- / Menu -->

          <!-- Content -->
          @yield('content')
          <!--/ Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme" @yield('hideforoboard')>
            <div class="container-xxl">
              <div
                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                <div class="text-body">
                  ©
                  <script>
                    document.write(new Date().getFullYear())
                  </script>made with by Gondowangi</a>
                </div>
              </div>
            </div>
          </footer>
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!--/ Content wrapper -->
      </div>
      <!--/ Layout container -->
    </div>
  </div>
  

  <!-- Overlay -->
  <div class="layout-overlay layout-menu-toggle"></div>
  <div class="drag-target"></div>

  @yield('script')
  <script src="{{ asset('frontend/assets/vendor/popper.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/bootstrap.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/perfect-scrollbar.js') }}"></script>

  <!-- Vendors JS -->
  <script src="{{ asset('frontend/assets/vendor/apexcharts.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('frontend/assets/dashboards-analytics.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      let lastScrollTop = 0;
      const asideMenu = document.getElementById('layout-menu');

      window.addEventListener('scroll', function () {
          let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

          if (scrollTop > lastScrollTop) {
              // Scroll down - sembunyikan aside
              asideMenu.classList.add('hide-aside');
              asideMenu.classList.remove('show-aside');
          } else {
              asideMenu.classList.remove('hide-aside');
              asideMenu.classList.add('show-aside');
          }

          lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
      });

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
  </script>
    <!-- Form logout tersembunyi -->
    <form id="logout-form" action="/keluar" method="POST" style="display: none;">
      @csrf
    </form>

  {{-- baru --}}
  <script>
    const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    
    // Data minggu sebelumnya, sekarang disesuaikan dengan total waktu menonton video + kuis/test
    const totalLastWeek = [3, 6, 4, 6.5, 6, 7, 10]; // Data riwayat total waktu (video + kuis) minggu sebelumnya

    const data = {
      labels: labels,
      datasets: [
        {
          label: 'Waktu Menonton Video',
          data: [7, 4, 6, 9, 2, 10, 7],
          barThickness: 42,  // Data dalam jam untuk menonton video
          backgroundColor: 'rgba(255, 171, 0, 0.8)',  // Warna oranye untuk video
          borderColor: 'rgba(255, 171, 0, 1)',
          borderWidth: 1,
          borderRadius: {
            topLeft: 0, topRight: 0, bottomLeft: 10, bottomRight: 10  // Membuat sudut bawah rounded
          },
          stack: 'combined'  // Menjadikan bar tumpukan
        },
        {
          label: 'Waktu Kuis dan Test',
          data: [5, 2, 4, 1.5, 3, 3, 2],
          barThickness: 42,  // Data dalam jam untuk kuis dan test
          backgroundColor: 'rgba(54, 162, 235, 0.8)',  // Warna biru untuk kuis dan test
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          borderRadius: {
            topLeft: 10, topRight: 10, bottomLeft: 0, bottomRight: 0  // Membuat sudut atas rounded
          },
          stack: 'combined'  // Menjadikan bar tumpukan
        },
        {
          label: 'Riwayat Minggu Sebelumnya',
          type: 'line',
          data: totalLastWeek,  // Data total waktu minggu sebelumnya (video + kuis)
          backgroundColor: 'rgba(0, 0, 0, 0)',  // Tidak ada warna latar belakang untuk garis
          borderColor: 'rgba(75, 192, 192, 1)',  // Warna garis hijau
          borderWidth: 2,
          fill: false,
          tension: 0.3,  // Membuat garis sedikit melengkung
          pointBackgroundColor: 'white',
          pointBorderWidth: 2,
          pointRadius: 5,
          order: 1  // Garis berada di depan bar
        }
      ]
    };

    const config = {
      type: 'bar',
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return value + ' jam';  // Menambahkan label jam di y-axis
              }
            },
            grid: {
              display: true,  // Menampilkan garis horizontal
              drawBorder: false  // Menyembunyikan garis tepi
            }
          },
          x: {
            grid: {
              display: false  // Menyembunyikan garis vertikal
            }
          }
        },
        plugins: {
          legend: {
            display: true,
            position: 'bottom',  // Menempatkan legend di bawah chart
            labels: {
              usePointStyle: true,  // Mengubah ikon legend menjadi lingkaran
              pointStyle: 'circle'
            }
          },
          tooltip: {
            mode: 'nearest',  // Menampilkan hanya data yang paling dekat dengan kursor
            intersect: true,  // Hanya menampilkan tooltip saat benar-benar meng-hover data
            callbacks: {
              label: function(tooltipItem) {
                let label = tooltipItem.dataset.label || '';
                if (label) {
                  label += ': ';
                }
                label += tooltipItem.raw + ' jam';  // Menambahkan satuan 'jam' di tooltip
                return label;
              }
            }
          }
        },
        interaction: {
          mode: 'nearest',  // Mengaktifkan interaksi dengan data terdekat saja
          intersect: true  // Hanya mengaktifkan interaksi saat di atas data
        }
      }
    };

    const ctx = document.getElementById('shipmentDeliveryChart').getContext('2d');
    new Chart(ctx, config);
  </script>

  {{-- script untuk statistik waktu yang dihabiskan --}}
  <script>
    const labels = ['1 Jan', '2 Jan', '3 Jan', '4 Jan', '5 Jan', '6 Jan', '7 Jan', '8 Jan', '9 Jan', '10 Jan'];
    const data = {
      labels: labels,
      datasets: [
        {
          label: 'Shipment',
          type: 'bar',
          data: [30, 45, 35, 40, 30, 50, 45, 40, 30, 35],
          backgroundColor: 'rgba(255, 171, 0, 0.8)',  // warna oranye
          borderColor: 'rgba(255, 171, 0, 1)',
          borderWidth: 1,
          borderRadius: 10,  // Membuat bar menjadi rounded
          order: 2 
        },
        {
          label: 'Delivery',
          type: 'line',
          data: [25, 35, 30, 40, 45, 38, 45, 40, 35, 42],
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          fill: false,
          tension: 0.3, 
          pointBackgroundColor: 'white',
          pointBorderWidth: 2,
          pointRadius: 5,
          order: 1 
        }
      ]
    };

    const config = {
      data: data,
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            max: 50,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            },
            grid: {
              display: true,
              drawBorder: false 
            }
          },
          x: {
            grid: {
              display: false  
            }
          }
        },
        plugins: {
          legend: {
            display: true,
            position: 'bottom', 
            labels: {
              usePointStyle: true,
              pointStyle: 'circle'
            }
          }
        }
      }
    };

    const ctx = document.getElementById('shipmentDeliveryChart').getContext('2d');
    new Chart(ctx, config);
  </script>

</body>
</html>