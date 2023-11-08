@extends('template.front')
@section('title', $title)

@section('style2', 'style2')

@section('style')
    <style>
        .img_cover {
            width: 100%;
            height: 260px !important;
            object-fit: cover !important;
        }

        .min_350 {
            min-height: 350px !important;
        }

        .blog-header {
            background-image: url("{{ asset('img/front-bg3.jpeg') }}");
        }

        .pagination {
            justify-content: center !important;
        }

        #map {
            width: 100%;
            height: 300px;
        }
    </style>
@endsection

@section('header')
    <section id="main-banner-page" class="position-relative page-header blog-header parallax section-nav-smooth">
        <div class="overlay overlay-dark opacity-6 z-index-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="page-titles whitecolor text-center padding_top padding_bottom">
                        <h2 class="font-bold">Aduan Masyarakat</h2>
                        <h4 class="font-light pt-2">Sampaikan Kritik & Saran untuk membangun lingkungan menjadi lebih baik</h4>
                    </div>
                </div>
            </div>
            <div class="bg-blue title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-left">Aduan</h3>
                        <ul class="breadcrumb top10 bottom10 float-right">
                            <li class="breadcrumb-item hover-light"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item hover-light">Aduan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('konten')
    <section id="stayconnect1" class="bglight position-relative padding_top padding_bottom_half noshadow">
        <div class="container whitebox">
            <div class="widget py-5">
                <div class="row">
                    <div class="col-md-12 text-center wow fadeIn mt-n3" data-wow-delay="300ms">
                        <h2 class="heading bottom30 darkcolor font-light2 pt-1"><span class="font-weight-bold">Laporan</span> Masyarakat
                            <span class="divider-center"></span>
                        </h2>
                        <div class="col-md-8 offset-md-2 bottom35">
                            <p>Aplikasi ini adalah platform yang kami persembahkan kepada Anda, masyarakat penuh semangat dan peduli, untuk bersama-sama berperan aktif dalam menjaga kelestarian lingkungan. Kami memahami bahwa mata Anda adalah mata terbaik yang dapat mengamati dan melaporkan perubahan di sekitar kita. Oleh karena itu, kami ingin meminta Anda untuk menggunakan aplikasi ini sebagai alat untuk berbagi pengetahuan Anda, kepedulian, dan pengamatan tentang lingkungan hidup.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 order-sm-2">
                        <div class="contact-meta px-2 text-center text-md-left">
                            <div class="heading-title heading_small">
                                <span class="defaultcolor mb-3">Dinas Lingkungan Hidup</span>
                                <h3 class="darkcolor font-normal mb-4">Pemerintah Kabupaten Boyolali</h3>
                            </div>
                            <p class="bottom10">Jl. Kebo Kenongo, Faks (0276) 321013, </p>
                            <p class="bottom10">Telp (0276) 321013</p>
                            <p class="bottom10"><a href="mailto:dlh@boyolali.go.id">dlh@boyolali.go.id</a></p>
                            <p class="bottom10">Senin-Jumat: 08:00-16:00</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="heading-title  wow fadeInUp" data-wow-delay="300ms">
                            <form class="getin_form wow fadeInUp" method="POST" data-wow-delay="400ms" id="contact-form-data" onsubmit="event.preventDefault();do_submit(this);">
                                <div class="row px-2">
                                    <div class="col-md-12 col-sm-12" id="result"></div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="name1" class="d-none"></label>
                                            <input autocomplete="off" required class="form-control" id="name1" type="text" placeholder="Nama:" required name="nama">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email1" class="d-none"></label>
                                                    <input autocomplete="off" required class="form-control" type="email" id="email1" placeholder="Email:" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_hp" class="d-none"></label>
                                                    <input autocomplete="off" required class="form-control" type="number" id="no_hp" placeholder="Nomer HP:" name="no_hp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="message1" class="d-none"></label>
                                            <textarea required class="form-control" id="message1" placeholder="Aduan:" required name="deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <canvas style="width: 200px;height: 60px;" id="canvas"></canvas>
                                            <input autocomplete="off" class="form-control" type="text" id="captcha" placeholder="Captcha:" name="code">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" id="submit_btn1" class="btn button btn-blue w-100 contact_btn">Kirim Laporan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="widget text-center top60 w-100 p-0">
                        <div class="contact-box">
                            <span class="icon-contact bluecolor"><i class="fas fa-mobile-alt"></i></span>
                            <p class="bottom0"><a href="tel:0276321013">Telp (0276) 321013</a></p>
                            <p><a href="tel:0276321013">Faks (0276) 321013</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="widget text-center top60 w-100 p-0">
                        <div class="contact-box">
                            <span class="icon-contact bluecolor"><i class="fas fa-map-marker-alt"></i></span>
                            <p class="bottom0">​Kemiri, Boyolali 57321, Provinsi Jawa Tengah</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="widget text-center top60 w-100 p-0">
                        <div class="contact-box">
                            <span class="icon-contact bluecolor"><i class="far fa-envelope"></i></span>
                            <p class="bottom0"><a href="mailto:dlh@boyolali.go.id">dlh@boyolali.go.id</a></p>
                            <p class="d-block"><a href="mailto:dlhboyolali@gmail.com">dlhboyolali@gmail.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="widget text-center top60 w-100 p-0">
                        <div class="contact-box">
                            <span class="icon-contact bluecolor"><i class="far fa-clock"></i></span>
                            <p class="bottom15">WIB 08:00 <span class="d-block">WIB 16:00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="our-blog" class="bglight padding_bottom_half">
        <div class="container">
            <h3 class="darkcolor bottom20">Laporan Terbaru</h3>
            <div class="row">
                @foreach ($laporan as $item)
                    <div class="col-md-4">
                        <div class="item mt-3">
                            <div class="team-box wow fadeInUp" data-wow-delay="150ms">
                                <div class="team-content text-left" style="height: auto !important;">
                                    <h4 class="darkcolor">{{ substr_replace(substr_replace($item->nama, '....', -4), '....', 0, 4) }}</h4>
                                    <p>
                                        {{ $item->deskripsi }}
                                    </p>
                                    <hr>
                                    <div style="font-size: 10px;">
                                        <i class="fa fa-calendar-alt"></i> {{ date('d F Y', strtotime($item->created_at)) }}
                                        <i class="fa fa-check"></i> {{ $item->status->nama }}
                                        <br>
                                        <i class="fa fa-envelope"></i> {{ substr_replace($item->email, '....', 0, 4) }}
                                        <i class="fa fa-mobile-alt"></i> {{ substr_replace($item->no_hp, '....', -4) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row mt-4">
                <div class="col-sm-12 text-center">
                    {{ $laporan->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <!-- sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/jquerycaptha.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        const captcha = new Captcha($('#canvas'), {
            length: 5,
            caseSensitive: true,
            clickRefresh: true,
            font: 'bold 23px Arial',
            resourceType: 'aA0',
        });

        function do_submit(dt) {

            Swal.fire({
                title: 'Laporkan Aduan ?',
                text: 'gunakan kalimat/bahasa yang sopan dan santun',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    var is_valid_captha = captcha.valid($('input[name="code"]').val());
                    if (!is_valid_captha) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Captha tidak sesuai',
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        $('input[name="code"]').val('')
                        captcha.refresh();
                        throw false;
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('front.aduan.store') }}",
                        data: new FormData(dt),
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Laporan Berhasil Dikirim',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    location.reload();
                                })
                        }
                    });
                }
            })
        }

        function beforeLoading(res) {
            Swal.fire({
                title: 'Loading ...',
                html: '<i style="font-size:50px;" class="fa fa-spinner fa-spin"></i>',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
        }

        function errorLoading(res) {
            if (res.responseJSON.msg) {
                var text = res.responseJSON.msg;
            } else {
                var text = res.responseJSON.message;
            }
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: text,
                showConfirmButton: true,
            })
        }
    </script>
@endsection
