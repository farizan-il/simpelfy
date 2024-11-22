<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Gondowangi</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('style-backend/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style-backend/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('style-backend/modules/bootstrap-social/bootstrap-social.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('style-backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style-backend/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>

    <style>
        .fade-out {
            opacity: 0;
            transition: opacity 0.5s ease-out;
        }
    </style>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="card card-primary shadow">
                            <div class="card-header">
                                <h4>Login Gondowangi</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="/masuk" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                            tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class='bx bx-hide' id="togglePassword" style="cursor: pointer;"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>                                    

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Gondowangi 2024
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mengambil semua elemen alert
            var alertList = document.querySelectorAll('.alert');
            alertList.forEach(function(alert) {
                setTimeout(function() {
                    alert.classList.add('fade-out'); 
                    setTimeout(function() {
                        var alertInstance = new bootstrap.Alert(alert);
                        alertInstance.close(); 
                    }, 500); 
                }, 4000);
            });
        });

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle the icon
            this.classList.toggle('bx-hide');
            this.classList.toggle('bx-show');
        });

    </script>

    <!-- General JS Scripts -->
    <script src="{{ asset('style-backend/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('style-backend/modules/popper.js') }}"></script>
    <script src="{{ asset('style-backend/modules/tooltip.js') }}"></script>
    <script src="{{ asset('style-backend/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('style-backend/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('style-backend/modules/moment.min.js') }}"></script>
    <script src="{{ asset('style-backend/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('style-backend/js/scripts.js') }}"></script>
    <script src="{{ asset('style-backend/js/custom.js') }}"></script>
</body>

</html>
