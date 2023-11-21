<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" href="{{ asset('img/icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon.png') }}">
    <meta name="robots" content="noindex" />

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ env('WEB_NAMA') }}">
    <meta name="twitter:description" content="{{ env('WEB_DESKRIPSI') }}">
    <meta name="twitter:image" content="{{ asset('img/save-pohon.jpg') }}">

    <!-- Facebook -->
    <meta property="og:url" content="{{ asset('img/save-pohon.jpg') }}">
    <meta property="og:title" content="{{ env('WEB_NAMA') }}">
    <meta property="og:description" content="{{ env('WEB_DESKRIPSI') }}">

    <meta property="og:image" content="{{ asset('img/save-pohon.jpg') }}">
    <meta property="og:image:secure_url" content="{{ asset('img/save-pohon.jpg') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="{{ env('WEB_DESKRIPSI') }}">
    <meta name="keywords" content="{{ env('WEB_KEYWORDS') }}">
    <meta name="author" content="{{ env('WEB_AUTHOR') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') | {{ env('WEB_NAMA') }}</title>

    <!-- vendor css -->
    <link href="{{ asset('template-new') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset('template-new') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="{{ asset('template-new') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="{{ asset('template-new') }}/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">

    <link href="{{ asset('template-new') }}/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="{{ asset('template-new') }}/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('template-new') }}/css/bracket.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/my_custom.css?time=') . time() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/my_style.css?time=') . time() }}">
    @yield('style')
</head>

<body>

    <div class="br-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/siip.png') }}" alt="logo" style="width: 200px;">
        </a>
    </div>
    @if (Auth::user()->role_id == 1)
        @include('template.sidebarAdmin')
    @elseif (Auth::user()->role_id == 2)
        @include('template.sidebarOperator')
    @endif
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
        <div class="br-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        </div><!-- br-header-left -->
        <div class="br-header-right">
            <nav class="nav">
                <div class="dropdown">
                    <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                        <span class="logged-name hidden-md-down">{{ Auth::user()->name }}</span>
                        <img src="{{ asset(Auth::user()->foto) }}" onerror="this.src='{{ asset('img/default.png') }}'" class="wd-32 rounded-circle" alt="foto profil">
                        <span class="square-10 bg-success"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-header wd-200">
                        <ul class="list-unstyled user-profile-nav">
                            <li><a href="{{ route('profil') }}"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                            <li><a onclick="event.preventDefault();logout(this);" href="{{ route('login.logout') }}"><i class="icon ion-power"></i> Sign Out</a></li>
                        </ul>
                    </div><!-- dropdown-menu -->
                </div><!-- dropdown -->
            </nav>
        </div><!-- br-header-right -->
    </div><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        @if (@$breadcrumb)
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    @foreach ($breadcrumb as $item)
                        <span class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">{{ $item }}</span>
                    @endforeach
                </nav>
            </div>
        @endif
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <div class="col-12 d-block d-md-flex justify-content-between">
                <h4 class="tx-gray-800 mg-b-5">@yield('header')</h4>
                <div>@yield('tombol')</div>
            </div>
        </div><!-- d-flex -->
        @yield('konten')

    </div><!-- br-mainpanel -->

    <div id="modal_custom" class="modal fade" style="backdrop-filter: blur(5px);">
        <div id="modal_custom_size" class="modal-dialog modal-xl" role="document">
            <div style="border: 0;" class="modal-content shadow1">
                <div class="modal-header bg-primary">
                    <h3 class="modal-title mt-0 text-white fw-600">JUDUL</h3>
                    <button type="button" class="close" onclick="$('#modal_custom').modal('hide');">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, saepe esse sit nihil aperiam quae porro eveniet in recusandae consequatur reiciendis voluptatibus blanditiis magni! Aliquid ex minima distinctio at quod.
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="modal_custom_2" class="modal fade" role="dialog" style="background-color: rgba(0, 0, 0, .5);">
        <div id="modal_custom_size_2" class="modal-dialog modal-xl">
            <div style="border: 0;" class="modal-content shadow1">
                <div class="modal-header bg-info">
                    <h3 class="modal-title mt-0 text-white fw-600">JUDUL</h3>
                    <button type="button" class="close" onclick="$('#modal_custom_2').modal('hide');">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, saepe esse sit nihil aperiam quae porro eveniet in recusandae consequatur reiciendis voluptatibus blanditiis magni! Aliquid ex minima distinctio at quod.
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <script>
        const APP_URL = "{{ env('APP_URL') }}/";
    </script>

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="{{ asset('template-new') }}/lib/jquery/jquery.js"></script>
    <script src="{{ asset('template-new') }}/lib/popper.js/popper.js"></script>
    <script src="{{ asset('template-new') }}/lib/bootstrap/bootstrap.js"></script>
    <script src="{{ asset('template-new') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="{{ asset('template-new') }}/lib/moment/moment.js"></script>
    <script src="{{ asset('template-new') }}/lib/jquery-ui/jquery-ui.js"></script>
    <script src="{{ asset('template-new') }}/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="{{ asset('template-new') }}/lib/peity/jquery.peity.js"></script>

    <script src="{{ asset('template-new') }}/js/bracket.js"></script>

    <!-- datatable -->
    <script src="{{ asset('template-new') }}/lib/datatables/jquery.dataTables.js"></script>
    <script src="{{ asset('template-new') }}/lib/datatables-responsive/dataTables.responsive.js"></script>

    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- select2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/app-assets/vendors/css/forms/select/select2.min.css">
    <script src="{{ asset('template-new') }}/lib/select2/js/select2.min.js"></script>
    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets/my_app.js?time=') . time() }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    </script>
    @yield('script')

</body>

</html>
