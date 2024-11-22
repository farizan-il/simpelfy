
<!DOCTYPE html>
<html lang="en" >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" data-bs-theme="dark">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gondowangi </title>
    <!-- plugins:css -->
   
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    
    <style>
        .circle-icon {
          transition: transform 0.3s ease; /* Animasi transisi */
          cursor: pointer; /* Mengubah kursor menjadi pointer */
        }

        .circle-icon:hover {
          transform: scale(1.1); /* Membesar sedikit saat hover */
        }

        .circle-icon.clicked {
          transform: scale(1.2); /* Membesar lebih besar saat di klik */
        }

        .header-calender {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .nav-btn {
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .month-display {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .weekdays, .days {
            display: flex;
            justify-content: space-between;
        }

        .weekdays span, .days div {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        .weekdays span {
            font-weight: bold;
        }

        .days div {
            cursor: pointer;
        }

        .today {
            background-color: #3f51b5;
            color: white;
        }

        .selected {
            background-color: #d5d5d5;
            color: white;
        }
    </style>
  </head>

  <body class="with-welcome-text sidebar-icon-only">
    <div class="container-scroller">
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="index.html">
                GONDOWANGI
            </a>
          </div>
        </div>
        
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold">Farizan</span></h1>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            
            <li class="nav-item d-none d-lg-block">
              <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                <span class="input-group-addon input-group-prepend border-right">
                  <span class="icon-calendar input-group-text calendar-icon"></span>
                </span>
                <input type="text" class="form-control">
              </div>
            </li>
            <li class="nav-item">
              <form class="search-form" action="#">
                <i class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
              </form>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="icon-bell"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3 border-bottom">
                  <p class="mb-0 fw-medium float-start">You have 4 new notifications </p>
                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-alert m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                    <p class="fw-light small-text mb-0"> Just now </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-lock-outline m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                    <p class="fw-light small-text mb-0"> Private message </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item py-3">
                  <div class="preview-thumbnail">
                    <i class="mdi mdi-airballoon m-auto text-primary"></i>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                    <p class="fw-light small-text mb-0"> 2 days ago </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="icon-mail icon-lg"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 fw-medium float-start">You have 7 unread mails </p>
                  <span class="badge badge-pill badge-primary float-end">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Marian Garner </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">David Grey </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis fw-medium text-dark">Travis Jenkins </p>
                    <p class="fw-light small-text mb-0"> The meeting is cancelled </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="assets/images/faces/face8.jpg" alt="Profile image">
                  <p class="mb-1 mt-3 fw-semibold">Allen Moreno</p>
                  <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                </div>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item active">
              <a class="nav-link" href="">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Kelas</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#karyawan" role="tab" aria-controls="karyawan" aria-selected="false">Karyawan</a>
                      </li>
                    </ul>
                    <div>
                      <div class="btn-wrapper">
                        <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                        <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                        <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                      </div>
                    </div>
                  </div>

                  {{-- overview --}}
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="statistics-details d-flex align-items-center justify-content-between">
                            <div>
                              <p class="statistics-title">Total Kelas</p>
                              <div></div>
                              <h3 class="rate-percentage"><i class="mdi mdi-google-classroom text-primary mr-2" style="opacity: 60%;"></i> 323</h3>
                              <p class="text-primary d-flex"><span>Keseluruhan</span></p>
                            </div>
                            <div>
                              <p class="statistics-title">Kelas Baru</p>
                              <h3 class="rate-percentage"><i class="mdi mdi-google-classroom text-success mr-2" style="opacity: 60%;"></i> 82+</h3>
                              <p class="text-success d-flex"><span>Bulan ini</span></p>
                            </div>
                            <div>
                              <p class="statistics-title">Video Pembelajaran</p>
                              <h3 class="rate-percentage"><i class="mdi mdi-folder-play text-danger mr-2" style="opacity: 60%;"></i> 688</h3>
                              <p class="text-danger d-flex"><span>Keseluruhan</span></p>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">Kuis dan Test</p>
                              <h3 class="rate-percentage"><i class="mdi mdi-help-box-multiple text-warning mr-2" style="opacity: 60%;"></i> 63</h3>
                              <p class="text-warning d-flex"><span>Keseluruhan</span></p>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">Total Karyawan</p>
                              <h3 class="rate-percentage"><i class="mdi mdi-account-multiple text-info mr-2" style="opacity: 60%;"></i> 218</h3>
                              <p class="text-info d-flex"><span>Keseluruhan</span></p>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">Sedang Aktif</p>
                              <h3 class="rate-percentage text-success"><i class="mdi mdi-account-multiple"></i> 51</h3>
                              <p class="text-success d-flex"><span>Hari ini</span></p>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                    <div class="d-sm-flex justify-content-between align-items-start">
                                      <div>
                                          <h4 class="card-title card-title-dash">Statistik Waktu Yang Dihabiskan Untuk Belajar</h4>
                                          <div id="performanceLine-legend"></div>
                                      </div>
                                      <div class="d-flex">
                                        <div class="dropdown" style="margin-right: 7px;">
                                          <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="departementDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              HDC <!-- Mengubah teks tombol menjadi 'HDC' -->
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="departementDropdown">
                                              <a class="dropdown-item departement-option" href="#" data-departement="HDC">HDC</a>
                                              <a class="dropdown-item departement-option" href="#" data-departement="Sales">Sales</a>
                                              <a class="dropdown-item departement-option" href="#" data-departement="Marketing">Marketing</a>
                                          </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="bulanDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Bulan Ini
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="bulanDropdown">
                                                <a class="dropdown-item bulan-option" href="#" data-bulan="Januari">Januari</a>
                                                <a class="dropdown-item bulan-option" href="#" data-bulan="Februari">Februari</a>
                                                <!-- Tambahkan bulan lainnya -->
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="chartjs-wrapper mt-4">
                                        <canvas id="performanceLine" width=""></canvas>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 grid-margin stretch-card">
                          <div class="card card-rounded">
                            <div class="card-body">
                              <div class="d-flex align-items-center justify-content-between mb-3">
                                <h4 class="card-title card-title-dash">Aktivitas Terbaru</h4>
                              </div>
                              <ul class="bullet-line-list">
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Budi Santoso</span> telah menyelesaikan kelas</div>
                                    <p>43 detik</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Andi Wijaya</span> memulai kelas baru</div>
                                    <p>1 jam</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Siti Lestari</span> menambahkan komentar baru</div>
                                    <p>2 jam</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Dewi Anggraini</span> mengikuti kuis</div>
                                    <p>3 jam</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Rudi Hartono</span> membeli kelas baru</div>
                                    <p>4 jam</p>
                                  </div>
                                </li>
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green">Dewi Anggraini</span> menyelesaikan modul</div>
                                    <p>5 jam</p>
                                  </div>
                                </li>
                              </ul>
                              <div class="list align-items-center pt-3">
                                <div class="wrapper w-100">
                                  <p class="mb-0">
                                    <a href="#" class="fw-bold text-primary">Lihat Semua <i class="mdi mdi-arrow-right ms-2"></i></a>
                                  </p>
                                </div>
                              </div>
                            </div>                            
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                      <h4 class="card-title card-title-dash">Riwayat Transaksi</h4>
                                      <p class="card-subtitle card-subtitle-dash">Klik button week untuk menampilkan total transaksi tiap bulanya</p>
                                    </div>
                                    <div class="d-flex">
                                      <div class="dropdown" style="margin-right: 4px; display: none;" id="filters">
                                        <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Semua Departemen
                                        </button>
                                        <div id="departmentButtons" class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                          <button class="dropdown-item bulan-option" data-department="0">HCD</button>
                                          <button class="dropdown-item bulan-option" data-department="1">Finance</button>
                                          <button class="dropdown-item bulan-option" data-department="2">IT</button>
                                          <button class="dropdown-item bulan-option" data-department="3">Marketing</button>
                                          <button class="dropdown-item bulan-option" data-department="4">Sales</button>
                                        </div>
                                      </div>
                                     
                                      <div class="dropdown" style="margin-right: 5px;">
                                        <button class="btn btn-light dropdown-toggle toggle-dark btn-lg mb-0 me-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Bulan Ini</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                          <a class="dropdown-item" href="#">Januari</a>
                                          <a class="dropdown-item" href="#">Februari</a>
                                          <a class="dropdown-item" href="#">Maret</a>
                                          <a class="dropdown-item" href="#">April</a>
                                          <a class="dropdown-item" href="#">Mei</a>
                                          <a class="dropdown-item" href="#">Juni</a>
                                          <a class="dropdown-item" href="#">Juli</a>
                                          <a class="dropdown-item" href="#">Agustus</a>
                                          <a class="dropdown-item" href="#">September</a>
                                          <a class="dropdown-item" href="#">Oktober</a>
                                          <a class="dropdown-item" href="#">November</a>
                                          <a class="dropdown-item" href="#">Desember</a>
                                        </div>
                                      </div>
                                      
                                    </div>
                                  </div>
                                  <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                    <div class="me-3">
                                      <div id="marketingOverview-legend"></div>
                                    </div>
                                  </div>
                                  <div class="chartjs-bar-wrapper mt-3" style="cursor: pointer;">
                                    <canvas id="marketingOverview" height="350px"></canvas>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="row flex-grow">
                          <div class="col-9 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Statistik Keaktifan Kayawan</h4>
                                    <p class="card-subtitle card-subtitle-dash">Data ini diambil dari posisi 5 terbaik</p>
                                  </div>
                                  <p class="mb-0">
                                    <a href="#" class="fw-bold text-primary">Lihat Semuanya <i class="mdi mdi-arrow-right ms-2"></i></a>
                                  </p>
                                </div>
                                <div class="table-responsive mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th></th>
                                        <th>Karyawan</th>
                                        <th>Kelas</th>
                                        <th>Video</th>
                                        <th>Kuis dan test</th>
                                        <th>Jam Belajar</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <i class="fa fa-star fs-5" style="color: gold;"></i>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">50 Kelas</div> <strong class="text-dark">Diselesaikan</strong> 
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">150 Video</div> <strong class="text-dark">Sudah ditonton</strong> 
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">98 Kuis dan Test</div> <strong class="text-dark">Sudah dikerjakan</strong> 
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">53 Jam</div> <strong class="text-dark">Total belajar</strong> 
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          <i class="fa fa-star-half-o fs-5" style="color: silver;"></i>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-info"> <span class="text-dark">60 Kelas</span></div>Diselesaikan
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-info"> <span class="text-dark">190 Video</span></div>Sudah ditonton
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-info"> <span class="text-dark">102 Kuis dan Test</span></div>Sudah dikerjakan
                                          {{-- <div class="badge badge-opacity-warning">In progress</span></div> --}}
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-info"> <span class="text-dark">73 Jam</span></div>Total belajar
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          <i class="fa fa-star-o fs-5" style="color: #cd7f32;"></i>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-danger" >50 Kelas</div>Diselesaikan
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-danger">150 Video</div>Sudah ditonton
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-danger">98 Kuis dan Test</div>Sudah dikerjakan
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-danger">53 Jam</div>Total belajar
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">50 Kelas</span></div>Diselesaikan
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">150 Video</span></div>Sudah ditonton
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">98 Kuis dan Test</span></div>Sudah dikerjakan
                                          {{-- <div class="badge badge-opacity-warning">In progress</span></div> --}}
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">53 Jam</span></div>Total belajar
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                      </tr>
                                      
                                      <tr>
                                        <td>
                                          
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">50 Kelas</span></div>Diselesaikan
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">150 Video</span></div>Sudah ditonton
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">98 Kuis dan Test</span></div>Sudah dikerjakan
                                          {{-- <div class="badge badge-opacity-warning">In progress</span></div> --}}
                                        </td>
                                        <td>
                                          <div class="badge badge-light"><span class="text-dark">53 Jam</span></div>Total belajar
                                          {{-- <div class="badge badge-opacity-warning">In progress</div> --}}
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-4 d-flex flex-column">
                            <div class="card-body p-0 m-0">
                              <div class="d-sm-flex justify-content-between align-items-start">
                                <div>
                                  <h4 class="card-title card-title-dash p-4">Kategori Terpopuler</h4>
                                </div>
                              </div>
                              <div>
                                <div class="py-2 d-flex flex-center position-relative card-body">
                                  <div class="position-relative w-100" style="height: 18rem;">
                                    <div class="d3-tooltip"></div>
                                    <svg class="packed-bubble-svg h-100 w-100 py-2" viewBox="0 0 460 400">
                                      <g text-anchor="middle" transform="translate(261.76223573383317, 122.66239483341009)">
                                        <circle r="53.69643095640707" fill="#2A7BE4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Blockchain</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(207.95442740829702, 183.4636055615327)">
                                        <circle r="19.572714632478704" fill="#1956A6" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">NFT</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(184.5263991175093, 53.91903889607278)">
                                        <circle r="40.49978183357956" fill="#195099" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">HTML</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(257.6846679482217, 217.35997529702004)">
                                        <circle r="32.41640241536476" fill="#2A7BE4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Crypto</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(134.3044316093979, 183.9359703523102)">
                                        <circle r="46.0493195356091" fill="#2A7BE4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Photoshop</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(310.1127115649746, 188.9229581487638)">
                                        <circle r="19.572714632478704" fill="#1956A6" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">UX</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(157.91489493614006, 297.53948444320054)">
                                        <circle r="40.49978183357956" fill="#195099" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">AWS</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(107.48309429726575, 57.27810270149587)">
                                        <circle r="24.88273809887447" fill="#9DBFEB" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">3D</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(333.6096705631174, 258.5999318605956)">
                                        <circle r="46.0493195356091" fill="#2A7BE4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Writing</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(74.42978229378812, 266.74887884302603)">
                                        <circle r="40.49978183357956" fill="#195099" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Blender</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(299.2944727604215, 44.651553577706125)">
                                        <circle r="24.88273809887447" fill="#9DBFEB" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">UI/UX</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(251.36220071257117, 315.92911111634317)">
                                        <circle r="46.0493195356091" fill="#2A7BE4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Blockchain</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(180.0438361395747, 125.71016789908212)">
                                        <circle r="19.572714632478704" fill="#1956A6" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">css</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(364.15532100449184, 147.57091301980455)">
                                        <circle r="40.49978183357956" fill="#195099" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Marketing</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(195.00906524685237, 234.283278325752)">
                                        <circle r="24.88273809887447" fill="#9DBFEB" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Meta</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(247.99462416038207, 46.86449349248164)">
                                        <circle r="15.366039281203811" fill="#0F67D9" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">js</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(411.2422770034418, 301.8556541378292)">
                                        <circle r="34.812639913448336" fill="#7FA5D5" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">FOREX</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(56.26609470115565, 195.64983202163782)">
                                        <circle r="24.88273809887447" fill="#8ABBFB" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">UI</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(333.53582918285565, 84.56586716919693)">
                                        <circle r="19.572714632478704" fill="#1956A6" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">sql</text>
                                      </g>
                                      
                                      <g text-anchor="middle" transform="translate(133.09331599700306, 106.93667815378727)">
                                        <circle r="22.99205207562853" fill="#6486B4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">CAD</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(411.6140360806507, 216.0310979138183)">
                                        <circle r="34.812639913448336" fill="#2A7BE4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Python</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(100.09002467962776, 357.41739511142055)">
                                        <circle r="34.812639913448336" fill="#68A0E9" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Adobe</text>
                                      </g>
                                      
                                      <g text-anchor="middle" transform="translate(338.1994003918835, 352.5974311559223)">
                                        <circle r="40.057422168875306" fill="#74A2DE" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Branding</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(64.8459039356456, 123.23251645721551)">
                                        <circle r="38.23559479986038" fill="#4E7AB4" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">Bitcoin</text>
                                      </g>
                                      <g text-anchor="middle" transform="translate(385.8197926548608, 77.08501358199385)">
                                        <circle r="25.243253120137716" fill="#71AFFF" stroke-width="0"></circle><text dy="4" fill="#fff"
                                          text-anchor="middle" font-size="1rem" font-weight="normal" style="pointer-events: none;">AI</text>
                                      </g>
                                    </svg>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- karyawan --}}
                  <div class="tab-content tab-content-basic mt-0">
                    <div class="tab-pane fade show" id="karyawan" role="tabpanel" aria-labelledby="karyawan">
                      <div class="row">

                        {{-- kolom sebelah kiri --}}
                        <div class="row col-lg-8 col-sm-12" style="height: calc(100vh - 100px); overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">

                          {{-- card sudut pandang kelas karyawan --}}
                          <div class="statistics-details d-flex align-items-center justify-content-between">
                            <div>
                              <p class="statistics-title">Total Kelas Dibeli</p>
                              <div></div>
                              <h3 class="rate-percentage"><i class="mdi mdi-google-classroom text-primary mr-2" style="opacity: 60%;"></i> 12</h3>
                              <p class="text-primary d-flex"><span>Keseluruhan</span></p>
                            </div>
                            <div>
                              <p class="statistics-title">Kelas Dalam Proses</p>
                              <h3 class="rate-percentage"><i class="mdi mdi-google-classroom text-warning mr-2" style="opacity: 60%;"></i> 2</h3>
                              <p class="text-warning d-flex"><span>Bulan ini</span></p>
                            </div>
                            <div>
                              <p class="statistics-title">Kelas Sudah Diselesaikan</p>
                              <h3 class="rate-percentage"><i class="mdi mdi-folder-play text-success mr-2" style="opacity: 60%;"></i> 10</h3>
                              <p class="text-success d-flex"><span>Keseluruhan</span></p>
                            </div>
                            <div class="d-none d-md-block">
                              <p class="statistics-title">Koin Aktif</p>
                              <h3 class="rate-percentage"><i class=" mdi mdi-ethereum text-info mr-2" style="opacity: 60%;"></i> IDR 3.600.000</h3>
                              <p class="text-info d-flex"><span>Keseluruhan</span></p>
                            </div>
                          </div>

                          {{-- statistik waktu yang dihabiskan --}}
                          <div class="col-8 grid-margin stretch-card" >
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="card-title card-title-dash">Statistik waktu yang dihabiskan</h4>
                                    </div>
                                    <div style="height: 200px;">
                                      <canvas class="my-auto" id="doughnutChart" ></canvas>
                                    </div>
                                    <div id="doughnutChart-legend" class="mt-5 text-center"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-4 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Statistik Kelas</h4>
                                      </div>
                                    </div>
                                    <div class="mt-3">
                                      <canvas id="leaveReport"></canvas>
                                    </div>
                                    <div id="leaveReport-legend"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          {{-- table riwayat kelas diikutin --}}
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Riwayat kelas yang diikutin karyawan</h4>
                                    <p class="card-subtitle card-subtitle-dash">Data ini diambil dari posisi 5 terbaru</p>
                                  </div>
                                  <p class="mb-0">
                                    <a href="#" class="fw-bold text-primary">Lihat Semuanya <i class="mdi mdi-arrow-right ms-2"></i></a>
                                  </p>
                                </div>
                                <div class="table-responsive mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false" id="check-all"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>Nama Kelas</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Jam Belajar</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-success">50 Kelas</div> <strong class="text-dark">Diselesaikan</strong> 
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">79%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">In progress</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>

                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face2.jpg" alt="">
                                            <div>
                                              <h6>Laura Brooks</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>Sales Training: Practical Sales Techniquesy</h6>
                                          <div class="badge badge-opacity-dark text-white">wajib</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-dark text-white">wajib</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face3.jpg" alt="">
                                            <div>
                                              <h6>Wayne Murphy</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>B2B Sales Masterclass: People-Focused Selling</h6>
                                          <div class="badge badge-opacity-info">umum</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-warning" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">In progress</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face4.jpg" alt="">
                                            <div>
                                              <h6>Matthew Bailey</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>The Complete Sales MBA: 10 Sales Skills Courses in 1y</h6>
                                          <div class="badge badge-opacity-info">umum</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-danger">Pending</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face5.jpg" alt="">
                                            <div>
                                              <h6>Katherine Butler</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>The Complete Sales Skills Master Class - Sales Marketing B2B</h6>
                                          <div class="badge badge-opacity-dark text-white">wajib</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-success">Completed</div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- kolom sebelah kanan --}}
                        <div class="col-lg-4 col-sm-12" style="height: calc(100vh - 100px); overflow-y: scroll; scrollbar-width: none; -ms-overflow-style: none;">

                          {{-- tanggal terbaru --}}
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-lg-12" >
                                      <div class="calendar">
                                        <div class="header-calender">
                                            <button id="prev-week" class="nav-btn">←</button>
                                            <div id="current-month" class="month-display"></div>
                                            <button id="next-week" class="nav-btn">→</button>
                                        </div>
                                        
                                        <div class="weekdays">
                                            <span>S</span>
                                            <span>M</span>
                                            <span>T</span>
                                            <span>W</span>
                                            <span>T</span>
                                            <span>F</span>
                                            <span>S</span>
                                        </div>
                                        <div id="days" class="days"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          {{-- aktivitas karyawan --}}
                          <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                  <h4 class="card-title card-title-dash">Aktivitas Terbaru</h4>
                                </div>
                                <ul class="bullet-line-list">
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Farizan</span> telah menyelesaikan kelas</div>
                                      <p>43 detik</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Farizan</span> memulai kelas baru</div>
                                      <p>1 jam</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Farizan</span> menambahkan komentar baru</div>
                                      <p>2 jam</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Farizan</span> mengikuti kuis</div>
                                      <p>3 jam</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Farizan</span> membeli kelas baru</div>
                                      <p>4 jam</p>
                                    </div>
                                  </li>
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">Farizan</span> menyelesaikan modul</div>
                                      <p>5 jam</p>
                                    </div>
                                  </li>
                                </ul>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Lihat Semua <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>                            
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="row flex-grow">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2023. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    {{-- modal untuk to do list --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan List Baru</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-floating">
              <textarea class="form-control border-0" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary">Simpan</button>
          </div>
        </div>
      </div>
    </div>
    
    <script>
      $(document).ready(function() {
        console.log("Chart.js version: ", Chart); // Memeriksa apakah Chart.js telah dimuat
  
        const hoursSpentCanvas = document.getElementById('hoursSpent');
        if (hoursSpentCanvas) {
          console.log("Canvas ditemukan");
  
          new Chart(hoursSpentCanvas, {
            type: 'bar',
            data: {
              labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
              datasets: [{
                label: 'Last week',
                data: [110, 220, 200, 190, 220, 110, 210, 110, 205, 202, 201, 150],
                backgroundColor: "#52CDFF",
                borderColor: '#52CDFF',
                borderWidth: 0,
                barPercentage: 0.35,
                fill: true,
              }, {
                label: 'This week',
                data: [215, 290, 210, 250, 290, 230, 290, 210, 280, 220, 190, 300],
                backgroundColor: "#1F3BB3",
                borderColor: '#1F3BB3',
                borderWidth: 0,
                barPercentage: 0.35,
                fill: true,
              }]
            },
            options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                y: {
                  grid: {
                    color: "#F0F0F0",
                  },
                  ticks: {
                    color: "#6B778C",
                    font: {
                      size: 10,
                    }
                  }
                },
                x: {
                  grid: {
                    display: false,
                  },
                  ticks: {
                    color: "#6B778C",
                    font: {
                      size: 10,
                    }
                  }
                }
              },
              plugins: {
                legend: {
                  display: false,
                }
              }
            },
            plugins: [{
              afterDatasetUpdate: function (chart) {
                const chartId = chart.canvas.id;
                const legendId = `${chartId}-legend`;
                const ul = document.createElement('ul');
                chart.data.datasets.forEach(function(dataset) {
                  ul.innerHTML += `<li><span style="background-color: ${dataset.borderColor}"></span> ${dataset.label}</li>`;
                });
                document.getElementById(legendId).appendChild(ul);
              }
            }]
          });
        } else {
          console.log("Canvas tidak ditemukan");
        }
      });
    </script>

    <script>
      const daysElement = document.getElementById("days");
      const monthDisplay = document.getElementById("current-month");
      const prevWeekBtn = document.getElementById("prev-week");
      const nextWeekBtn = document.getElementById("next-week");

      let currentDate = new Date();
      let startOfWeek = getStartOfWeek(currentDate);

      function getStartOfWeek(date) {
          const day = date.getDay();
          const diff = date.getDate() - day; // Get the first day of the current week (Sunday)
          return new Date(date.setDate(diff));
      }

      function updateCalendar() {
          const year = startOfWeek.getFullYear();
          const month = startOfWeek.getMonth();

          // Set month display
          const monthNames = [
              "January", "February", "March", "April", "May", "June", 
              "July", "August", "September", "October", "November", "December"
          ];
          monthDisplay.innerText = `${monthNames[month]} ${year}`;

          // Generate 7 days starting from the current week
          daysElement.innerHTML = "";  // Clear previous days

          for (let i = 0; i < 7; i++) {
              const dayDiv = document.createElement("div");
              const date = new Date(startOfWeek);
              date.setDate(startOfWeek.getDate() + i);

              dayDiv.innerText = date.getDate();

              // Highlight today's date
              const today = new Date();
              if (
                  date.getDate() === today.getDate() &&
                  date.getMonth() === today.getMonth() &&
                  date.getFullYear() === today.getFullYear()
              ) {
                  dayDiv.classList.add("today");
              }

              // Select day on click
              dayDiv.addEventListener("click", () => {
                  const selectedDay = document.querySelector(".selected");
                  if (selectedDay) {
                      selectedDay.classList.remove("selected");
                  }
                  dayDiv.classList.add("selected");
              });

              daysElement.appendChild(dayDiv);
          }
      }

      // Navigate to the previous week
      prevWeekBtn.addEventListener("click", () => {
          startOfWeek.setDate(startOfWeek.getDate() - 7);
          updateCalendar();
      });

      // Navigate to the next week
      nextWeekBtn.addEventListener("click", () => {
          startOfWeek.setDate(startOfWeek.getDate() + 7);
          updateCalendar();
      });

      // Initialize calendar
      updateCalendar();

    </script>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/jquery.cookie.js" type="text/javascript') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      // Tambahkan event listener untuk setiap elemen circle dengan class 'circle-icon'
      document.querySelectorAll('.circle-icon').forEach(function(circle) {
        circle.addEventListener('click', function() {
          // Toggle class 'clicked' saat circle di klik
          circle.classList.toggle('clicked');
        });
      });
    </script>
  </body>
</html>

{{-- 

                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false" id="check-all"><i class="input-helper"></i></label>
                                          </div>
                                        </th>
                                        <th>Karyawan</th>
                                        <th>Kelas</th>
                                        <th>Video</th>
                                        <th>Kuis dan test</th>
                                        <th>Jam Belajar</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex ">
                                            <img src="assets/images/faces/face1.jpg" alt="">
                                            <div>
                                              <h6>Farizan zan</h6>
                                              <p>Head Kepala</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-success">50 Kelas</div> <strong class="text-dark">Diselesaikan</strong> 
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                              <p class="text-success">79%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">In progress</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>

                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face2.jpg" alt="">
                                            <div>
                                              <h6>Laura Brooks</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>Sales Training: Practical Sales Techniquesy</h6>
                                          <div class="badge badge-opacity-dark text-white">wajib</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-dark text-white">wajib</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face3.jpg" alt="">
                                            <div>
                                              <h6>Wayne Murphy</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>B2B Sales Masterclass: People-Focused Selling</h6>
                                          <div class="badge badge-opacity-info">umum</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-warning" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-warning">In progress</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face4.jpg" alt="">
                                            <div>
                                              <h6>Matthew Bailey</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>The Complete Sales MBA: 10 Sales Skills Courses in 1y</h6>
                                          <div class="badge badge-opacity-info">umum</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-danger">Pending</div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" aria-checked="false"><i class="input-helper"></i></label>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="d-flex">
                                            <img src="assets/images/faces/face5.jpg" alt="">
                                            <div>
                                              <h6>Katherine Butler</h6>
                                              <p>Head admin</p>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <h6>The Complete Sales Skills Master Class - Sales Marketing B2B</h6>
                                          <div class="badge badge-opacity-dark text-white">wajib</div>
                                        </td>
                                        <td>
                                          <div>
                                            <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                              <p class="text-success">65%</p>
                                              <p>85/162</p>
                                            </div>
                                            <div class="progress progress-md">
                                              <div class="progress-bar bg-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="badge badge-opacity-success">Completed</div>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>

@extends('gondowangi.backend.layout.main')

@section('head')
    <title>Gondowangi | {{ $title }} </title>
@endsection

@section('content')
    <div class="main-content">
        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="https://themewagon.github.io/stisla-1/assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Kelas dibeli</div>
                                    <div class="profile-widget-item-value">187</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Kelas proses</div>
                                    <div class="profile-widget-item-value">6,8K</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Kelas selesai</div>
                                    <div class="profile-widget-item-value">2,1K</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">Ujang Maman <div class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div> Web Developer
                            </div>
                            </div>
                            Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional
                            character but an original hero in my family, a hero for his children and for his wife. So, I use the
                            name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                        </div>
                        <div class="card-footer text-center">
                            <div class="font-weight-bold mb-2">Follow Ujang On</div>
                            <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                            <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                            <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-github mr-1">
                            <i class="fab fa-github"></i>
                            </a>
                            <a href="#" class="btn btn-social-icon btn-instagram">
                            <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <!-- Chart.js container -->
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Tracking Waktu yang Dihabiskan di Kelas</h4>
                            <!-- Dropdown untuk filter berdasarkan bulan -->
                            <select id="monthFilter" class="form-control col-2 float-right" onchange="updateChart()">
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="card-body">
                            <!-- Canvas for chart -->
                            <canvas id="timeSpentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('timeSpentChart').getContext('2d');

        // Membuat gradient warna dari biru muda ke pink
        const gradient = ctx.createLinearGradient(0, 0, ctx.canvas.width, 0);
        gradient.addColorStop(0, 'rgba(27,69,166,1)'); // light blue
        gradient.addColorStop(1, 'rgba(24,95,246,1)'); // pink

        // Data waktu dihabiskan per hari untuk beberapa bulan (data dummy)
        const timeSpentData = {
            1: [1, 2, 1.5, 2.8, 3, 2.5, 1.7, 3.2, 2.6, 1.5, 1.8, 2.9, 3.3, 2.1, 2.7, 1.9, 3, 2.8, 2.2, 1.5], // Januari
            2: [1.2, 1.6, 1.8, 2.9, 2.5, 2.1, 2.3, 2.6, 2, 1.4, 1.7, 2.8, 3, 1.9, 2.1, 2.3, 2.9, 2.6, 2.4, 1.8], // Februari
            3: [1.5, 2.1, 1.7, 3, 2.5, 2.2, 1.9, 2.3, 2.6, 2.9, 1.8, 2.5, 3.1, 2, 2.7, 3.2, 2.1, 2.9, 2.5, 2], // Maret
            4: [1.7, 2.5, 2.3, 2.9, 2, 2.1, 1.6, 2.7, 2.3, 2.5, 1.9, 2.7, 3, 2.1, 2.8, 3.1, 2.5, 2.3, 2.8, 2.4], // April
            5: [1.3, 2.7, 2.1, 2.8, 2.5, 2.2, 2.3, 2.9, 2.6, 2, 1.9, 2.3, 2.7, 2.8, 2.1, 2.3, 2.7, 3, 2.6, 2.1], // Mei
            6: [1.9, 2.5, 2.2, 2.7, 5, 2.8, 2.3, 2.6, 2.4, 2.1, 2.7, 2.5, 2.9, 3.1, 2.3, 2.7, 3, 2.9, 2.6, 2],  // Juni
        };

        // Nama hari dalam seminggu
        const labels = ['Sn', 'Sl', 'b', 'Km', 'Jm', 'Sb', 'Mg'];

        // Inisialisasi data untuk bulan pertama (Januari)
        let selectedMonth = 1;

        const data = {
            labels: Array.from({length: 20}, (_, i) => labels[i % 7]), // Ubah 1 hari, 2 hari, dst ke nama hari
            datasets: [{
                label: 'Waktu dihabiskan (jam)',
                data: timeSpentData[selectedMonth],
                borderColor: gradient, // Menerapkan gradient warna
                backgroundColor: '#fff',
                fill: true,
                tension: 0.4, // Garis rounded
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                scales: {
                    x: {
                        ticks: {
                            // Mengubah warna font Sabtu dan Minggu menjadi merah
                            color: function(context) {
                                const day = context.label;
                                return (day === 'Sabtu' || day === 'Minggu') ? 'danger' : 'black';
                            },
                        },
                        grid: {
                            display: false, // Menghilangkan garis kotak-kotak pada sumbu X
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Waktu dihabiskan (jam)'
                        },
                        grid: {
                            display: false, // Menghilangkan garis kotak-kotak pada sumbu Y
                        }
                    }
                }
            }
        };

        // Render the chart
        const timeSpentChart = new Chart(ctx, config);

        // Function to update chart based on selected month
        function updateChart() {
            selectedMonth = document.getElementById('monthFilter').value;
            timeSpentChart.data.datasets[0].data = timeSpentData[selectedMonth];
            timeSpentChart.update();
        }
    </script>
@endsection --}}