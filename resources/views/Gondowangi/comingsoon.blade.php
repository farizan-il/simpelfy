<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
  data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

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
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <div class="container-xxl py-4">
                        <div class="misc-wrapper text-center">
                            <h3 class="mb-2 mx-2">We are launching soon 🚀</h3>
                            <p class="mb-6 mx-2">Kategori Ini Belum ada Modulnya, Nanti Kita Tambahkan Secepatnya....</p>
                            <form onsubmit="return false">
                                <div class="mb-1">
                                    <center>
                                        <div class="mb-3">
                                            <label for="">Masukin emailnya bro, nanti kita kasih notfikasi</label>
                                            <input type="text" class="form-control" placeholder="Masukan Email" autofocus style="width: 400px;">
                                        </div>
                                    </center>
                                    <button type="submit" class="btn btn-primary">
                                        <a href="/explore" class="text-white">
                                            Kembali
                                        </a>
                                    </button>
                                </div>
                            </form>
                            <div class="mt-12">
                                <img src="{{ asset('image/boy-with-rocket-light.png') }}" alt="boy-with-rocket-light" width="450" class="img-fluid" data-app-dark-img="illustrations/boy-with-rocket-dark.png" data-app-light-img="illustrations/boy-with-rocket-light.png">
                            </div>
                        </div>
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('frontend/assets/vendor/popper.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/perfect-scrollbar.js') }}"></script>
  
    <!-- Vendors JS -->
    <script src="{{ asset('frontend/assets/vendor/apexcharts.js') }}"></script>
  
    <!-- Page JS -->
    <script src="{{ asset('frontend/assets/dashboards-analytics.js') }}"></script>
</body>