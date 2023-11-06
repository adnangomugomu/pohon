<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex" />
    <meta name="description" content="{{ env('WEB_DESKRIPSI') }}">
    <meta name="keywords" content="{{ env('WEB_KEYWORDS') }}">
    <meta name="author" content="{{ env('WEB_AUTHOR') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Page Title -->
    <title>@yield('title') | {{ env('WEB_NAMA') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon.png') }}">

    <link rel="stylesheet" href="{{ asset('front') }}/vendor/css/bundle.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/vendor/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/vendor/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/vendor/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/vendor/css/tooltipster.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/vendor/css/revolution-settings.min.css">
    <link rel="stylesheet" href="{{ asset('front') }}/construction/css/revolution/navigation.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('front') }}/construction/css/flaticon/flaticon.css">
    <link rel="stylesheet" href="{{ asset('front') }}/construction/css/style.css">
    @yield('style')
</head>

<body>
    <!--PreLoader-->
    <div class="loader">
        <div class="loader-spinner"></div>
    </div>
    <!--PreLoader Ends-->
    @hasSection('style1')
        <header class="site-header header-with-topbar" id="header">
            <div class="top-header-area d-xs-none">
                <div class="container">
                    <div class="row position-relative">
                        <div class="col-lg-9 col-md-8 col-sm-8 d-none d-sm-block position-relative pl-0" aria-hidden="true">
                            <a href="tel:0276321013" class="font-14 whitecolor hover-default" title="Call"><i class="fas fa-mobile-alt mr-2"></i>(0276) 321013</a>
                            <div class="bg-transparent d-inline-block d-xs-none position-relative mr-2 ml-2"></div>
                            <a href="mailto:dlhboyolali@gmail.com" class="font-14 whitecolor hover-default" title="Mail"><i class="far fa-envelope mr-2"></i>dlhboyolali@gmail.com</a>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 text-right position-relative pr-0 d-flex d-sm-block justify-content-around">
                            <a href="{{ route('login') }}" class="font-14 whitecolor hover-default"><i class="fas fa-user mr-2"></i>Login</a>
                            <div class="bg-transparent d-inline-block d-xs-none position-relative mr-2 ml-2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg transparent-bg darkcolor static-nav">
                <div class="container bgdefault nav-cont">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <h3 class="mb-0 logo-default">Pendataan Pohon</h3>
                        <h3 class="mb-0 logo-scrolled">DLH BOYOLALI</h3>
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.pohon') }}">Data Pohon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.aduan') }}">Aduan Masyarakat</a>
                            </li>                         
                        </ul>
                    </div>
                    <!--side menu open button-->
                    <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                        <span></span> <span></span> <span></span>
                    </a>
                </div>

            </nav>
            <!-- side menu -->
            <div class="side-menu opacity-0 bg-yellow">
                <div class="overlay"></div>
                <div class="inner-wrapper">
                    <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
                    <nav class="side-nav w-100">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.pohon') }}">Data Pohon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.aduan') }}">Aduan Masyarakat</a>
                            </li>                        
                        </ul>
                    </nav>
                    <div class="side-footer w-100">
                        <p class="darkcolor">&copy; 2023 DINAS LINGKUNGAN HIDUP BOYOLALI</p>
                    </div>
                </div>
            </div>
            <div id="close_side_menu" class="tooltip"></div>
            <!-- End side menu -->
        </header>
    @else
        <header class="site-header">
            <nav class="navbar navbar-expand-lg static-nav bg-yellow">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <h3 class="mb-0 logo-default">Pendataan Pohon</h3>
                        <h3 class="mb-0 logo-scrolled">DLH BOYOLALI</h3>
                    </a>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.pohon') }}">Data Pohon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.aduan') }}">Aduan Masyarakat</a>
                            </li>                          
                        </ul>
                    </div>
                </div>
                <!--side menu open button-->
                <a href="javascript:void(0)" class="d-inline-block sidemenu_btn" id="sidemenu_toggle">
                    <span class="bg-dark"></span> <span class="bg-dark"></span> <span class="bg-dark"></span>
                </a>
            </nav>
            <!-- side menu -->
            <div class="side-menu opacity-0 ">
                <div class="overlay"></div>
                <div class="inner-wrapper">
                    <span class="btn-close" id="btn_sideNavClose"><i></i><i></i></span>
                    <nav class="side-nav w-100">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.pohon') }}">Data Pohon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('front.aduan') }}">Aduan Masyarakat</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="side-footer w-100">                      
                        <p class="darkcolor">&copy; 2023 DINAS LINGKUNGAN HIDUP BOYOLALI</p>
                    </div>
                </div>
            </div>
            <div id="close_side_menu" class="tooltip"></div>
            <!-- End side menu -->
        </header>
    @endif

    @yield('slider')
    @yield('header')

    @yield('konten')

    <!--Site Footer Here-->
    <footer id="site-footer" class=" bgprimary padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <h3 class="whitecolor bottom25">Kantor</h3>
                        <p class="whitecolor bottom25">Komplek Perkantoran Terpadu Kabupaten Boyolali
                            Jl. Kebo Kenongo, Kemiri, Boyolali 57321, Provinsi Jawa Tengah</p>
                        <div class="d-table w-100 address-item whitecolor bottom25">
                            <span class="d-table-cell align-middle"><i class="fas fa-mobile-alt"></i></span>
                            <p class="d-table-cell align-middle bottom0">
                                (0276) 321013, Faks (0276) <a class="d-block" href="mailto:dlh@boyolali.go.id">dlh@boyolali.go.id</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_panel padding_bottom_half bottom20">
                        <h3 class="whitecolor bottom25">Jam Kerja</h3>
                        <p class="whitecolor bottom25">Kami melayani 5 hari dalam satu pekan</p>
                        <ul class="hours_links whitecolor">
                            <li><span>Senin-Jumat:</span> <span>08.00-16.00</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('front') }}/vendor/js/bundle.min.js"></script>
    <!--to view items on reach-->
    <script src="{{ asset('front') }}/vendor/js/jquery.appear.js"></script>
    <!--Owl Slider-->
    <script src="{{ asset('front') }}/vendor/js/owl.carousel.min.js"></script>
    <!--Parallax Background-->
    <script src="{{ asset('front') }}/vendor/js/parallaxie.min.js"></script>
    <!--Cubefolio Gallery-->
    <script src="{{ asset('front') }}/vendor/js/jquery.cubeportfolio.min.js"></script>
    <!--Fancybox js-->
    <script src="{{ asset('front') }}/vendor/js/jquery.fancybox.min.js"></script>
    <!--wow js-->
    <script src="{{ asset('front') }}/vendor/js/wow.min.js"></script>
    <!--number counters-->
    <script src="{{ asset('front') }}/vendor/js/jquery-countTo.js"></script>
    <!--tooltip js-->
    <script src="{{ asset('front') }}/vendor/js/tooltipster.min.js"></script>
    <!--Revolution SLider-->
    <script src="{{ asset('front') }}/vendor/js/jquery.themepunch.tools.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/jquery.themepunch.revolution.min.js"></script>
    <!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="{{ asset('front') }}/vendor/js/extensions/revolution.extension.video.min.js"></script>
    <!--custom functions and script-->
    <script src="{{ asset('front') }}/construction/js/functions.js"></script>
    @yield('script')
</body>

</html>
