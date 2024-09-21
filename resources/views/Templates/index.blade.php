<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        Deteksi Kanker
    </title>



    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="{{ asset('Assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('Assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('Assets/css/material-kit.css?v=3.0.4') }}" rel="stylesheet" />

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="index-page bg-gray-200">


    <!-- Navbar -->
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav
                    class="navbar navbar-expand-lg  blur border-radius-xl top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid px-0">
                        <a class="navbar-brand font-weight-bolder ms-sm-3" href="Javascript:void(0)" rel="tooltip"
                            title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
                            Deteksi Kanker
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
                            <ul class="navbar-nav navbar-nav-hover ms-auto">
                                <li class="nav-item dropdown dropdown-hover mx-2">
                                    <a class="nav-link ps-2 d-flex cursor-pointer align-items-center"
                                        id="dropdownMenuPages" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">dashboard</i>
                                        Pages
                                        <img src="{{ asset('Assets/img/down-arrow-dark.svg') }}" alt="down-arrow"
                                            class="arrow ms-auto ms-md-2">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-xl mt-0 mt-lg-3"
                                        aria-labelledby="dropdownMenuPages">
                                        <div class="d-none d-lg-block">

                                            <a href="{{ route('login') }}" class="dropdown-item border-radius-md">
                                                <span>Login</span>
                                            </a>
                                        </div>

                                    </div>
                                </li>

                                <li class="nav-item ms-lg-auto">
                                    <a href="Javascript:void(0)"
                                        class="nav-link ps-2 d-flex cursor-pointer align-items-center"
                                        id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons opacity-6 me-2 text-md">article</i>
                                        Konsultasi
                                    </a>
                                </li>
                                <li class="nav-item my-auto ms-3 ms-lg-0">

                                    <a href="{{ route('login') }}"
                                        class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0">Login</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>

    <header class="header-2">
        <div class="page-header min-vh-75 relative" style="background-image: url('{{ asset('Assets/img/bg2.jpg') }}')">
            <span class="mask bg-gradient-primary opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-n5">Selamat Datang.</h1>
                        <p class="lead text-white mt-3">Pneumonia Infeksi yang menimbulkan peradangan pada kantung udara
                            di salah
                            satu atau kedua paru-paru. <br />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

        <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 mx-auto py-3">
                        <div class="row">
                            <div class="col-md-6 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"><span id="state1" countTo="450">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Jumlah Yang Terjangkit</h5>
                                    <p class="text-sm font-weight-normal">Angka kejadian pneumonia lebih sering terjadi
                                        di negara berkembang.</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-6 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"> <span id="state2" countTo="15">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Konsultasi</h5>
                                    <p class="text-sm font-weight-normal">Jumlah Konsultasi Menggunakan Applikasi</p>
                                </div>
                                <hr class="vertical dark">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-sm-7" id="download-soft-ui">
            <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
                <img src="./assets/img/shapes/waves-white.svg" alt="pattern-lines"
                    class="position-absolute start-0 top-md-0 w-100 opacity-2">
                <div class="container py-7 postion-relative z-index-2 position-relative">
                    <div class="row">
                        <div class="col-md-7 mx-auto text-center">
                            <h3 class="text-white mb-0">Apakah anda menyukai ini</h3>
                            <h3 class="text-white">Deteksi Pneumonia</h3>
                            <p class="text-white mb-5">Apakah Anda akan melanjutkan berkonsultasi untuk mengetahui anda
                                terjangkit Pneumonia</p>
                            <a href="Javascript:void(0)" class="btn btn-primary btn-lg mb-3 mb-sm-0">Konsultasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 ms-auto">
                        <h4 class="mb-1">Thank you for your support!</h4>
                        <p class="lead mb-0">We deliver the best web products</p>
                    </div>
                    <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
                        <a href="Javascript:void(0)" class="btn btn-twitter mb-0 me-2" target="_blank">
                            <i class="fab fa-twitter me-1"></i> Tweet
                        </a>
                        <a href="Javascript:void(0)" class="btn btn-facebook mb-0 me-2" target="_blank">
                            <i class="fab fa-facebook-square me-1"></i> Share
                        </a>
                        <a href="Javascript:void(0)" class="btn btn-pinterest mb-0 me-2" target="_blank">
                            <i class="fab fa-pinterest me-1"></i> Pin it
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->

    </div>




    <footer class="footer pt-5 mt-5">
        <div class="container">
            <div class=" row">
                <div class="col-md-3 mb-4 ms-auto">
                    <div>
                        {{-- <a href="javascript:void(0)">
                            <img src="{{ asset('Assets/img/logo-ct-dark.png') }}" class="mb-3 footer-logo"
                                alt="main_logo">
                        </a> --}}
                        <h6 class="font-weight-bolder mb-4">Deteksi Pneumonia</h6>
                    </div>
                    <div>
                        <ul class="d-flex flex-row ms-n3 nav">
                            <li class="nav-item">
                                <a class="nav-link pe-1" href="javascript:void(0)" target="_blank">
                                    <i class="fab fa-facebook text-lg opacity-8"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link pe-1" href="javascript:void(0)" target="_blank">
                                    <i class="fab fa-twitter text-lg opacity-8"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link pe-1" href="javascript:void(0)" target="_blank">
                                    <i class="fab fa-youtube text-lg opacity-8"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4">
                    <div>

                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4">
                    <div>

                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4">
                    <div>
                        <h6 class="text-sm">Help & Support</h6>
                        <ul class="flex-column ms-n3 nav">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)" target="_blank">
                                    Contact Us
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)" target="_blank">
                                    Knowledge Center
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
                    <div>
                        <h6 class="text-sm">Legal</h6>
                        <ul class="flex-column ms-n3 nav">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)" target="_blank">
                                    Terms & Conditions
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)" target="_blank">
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-12">
                    <div class="text-center">
                        <p class="text-dark my-4 text-sm font-weight-normal">
                            All rights reserved. Copyright ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!--   Core JS Files   -->
    <script src="{{ asset('Assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('Assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('Assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="{{ asset('Assets/js/plugins/countup.min.js') }}"></script>
    <script src="{{ asset('Assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('Assets/js/plugins/prism.min.js') }}"></script>
    <script src="{{ asset('Assets/js/plugins/highlight.min.js') }}"></script>
    <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
    <script src="{{ asset('Assets/js/plugins/rellax.min.js') }}"></script>
    <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
    <script src="{{ asset('Assets/js/plugins/tilt.min.js') }}"></script>
    <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
    <script src="{{ asset('Assets/js/plugins/choices.min.js') }}"></script>

    <!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
    <script src="{{ asset('Assets/js/material-kit.min.js?v=3.0.4') }}" type="text/javascript"></script>


    <script type="text/javascript">
        if (document.getElementById('state1')) {
            const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
            if (!countUp.error) {
                countUp.start();
            } else {
                console.error(countUp.error);
            }
        }
        if (document.getElementById('state2')) {
            const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
            if (!countUp1.error) {
                countUp1.start();
            } else {
                console.error(countUp1.error);
            }
        }
        if (document.getElementById('state3')) {
            const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
            if (!countUp2.error) {
                countUp2.start();
            } else {
                console.error(countUp2.error);
            };
        }
    </script>

</body>

</html>