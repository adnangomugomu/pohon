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
            height: 250px;
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
                    <div class="col-md-4 order-sm-2">
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
                    <div class="col-md-8">
                        <div class="heading-title  wow fadeInUp" data-wow-delay="300ms">
                            <form class="getin_form wow fadeInUp" method="POST" data-wow-delay="400ms" id="contact-form-data" onsubmit="event.preventDefault();do_submit(this);">
                                <div class="row px-2">
                                    <div class="col-md-12 col-sm-12" id="result"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name1" class="d-none"></label>
                                            <input autocomplete="off" required class="form-control" id="name1" type="text" placeholder="Nama:" required name="nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="aduan_id" class="form-control" required>
                                                <option value="">Pilih Jenis Aduan</option>
                                                @foreach ($aduan as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email1" class="d-none"></label>
                                                    <input autocomplete="off" required class="form-control" type="email" id="email1" placeholder="Email:" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="no_hp" class="d-none"></label>
                                                    <input autocomplete="off" required class="form-control" type="number" id="no_hp" placeholder="Nomer HP:" name="no_hp">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="file" accept="image/*" class="form-control mb-0" name="foto" required>
                                                    <small class="text-danger">* bukti pendukung</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between">
                                                <div>Koordinat Lokasi <small class="text-danger">*</small></div>
                                                <button type="button" onclick="showPosition();" class="btn btn-sm btn-link">Ambil Lokasi GPS ?</button>
                                            </div>
                                            <div id="map" class="rounded border border-secondary"></div>
                                        </div>

                                        <div class="row" hidden>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Latitude <small class="text-danger">*</small></label>
                                                    <input type="text" id="lat" readonly value="" name="latitude" class="form-control" placeholder="latitude">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Longitude <small class="text-danger">*</small></label>
                                                    <input type="text" id="long" readonly value="" name="longitude" class="form-control" placeholder="longitude">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="message1" class="d-none"></label>
                                            <textarea style="min-height: 90px;" required class="form-control" rows="3" id="message1" placeholder="Aduan:" required name="deskripsi"></textarea>
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

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.css" integrity="sha512-OyIJmh4XggYsUxdlYua68RMPbPo/5b63LHzoLETEVwubMGcJp9IrbmxxydRZw41FiOKAK0M60eOiqkRq59OwpA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.min.js" integrity="sha512-10PRJppn1d6/3lrfc+7e4S+0mfdNFLlv3QmDpwISpVsrPdkSccy/T22neLEWc5cmL6biDscH3WwrhHam9vMOIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    <script>
        var map, geoJson, marker, circles;
        var polygonsWithCenters = L.layerGroup();

        map = L.map('map', {
                fullscreenControl: {
                    pseudoFullscreen: false
                },
                zoomSnap: 0,
                zoomDelta: 0.25,
            })
            .setView([-7.431999301294816, 110.60228347778322], 11);

        setInterval(function() {
            map.invalidateSize();
        }, 100);

        map.scrollWheelZoom.disable();

        basemap = {
            osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map),
            google_roadmap: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_satellite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_hybrid: L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_terrain: L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            esri_world_imagery: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 17
            }),
            esri_world_street_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}'),
            esri_world_topo_map: L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}'),
            peta_rbi_opensource: L.tileLayer.wms('http://palapa.big.go.id:8080/geoserver/gwc/service/wms', {
                maxZoom: 20,
                layers: "basemap_rbi:basemap",
                format: "image/png",
                attribution: 'Badan Informasi Geospasial'
            })
        }

        L.control.layers(basemap, null, {
            position: 'topleft'
        }).addTo(map);

        map.on('click', function(e) {
            if (marker) marker.remove();
            if (circles) map.removeLayer(circles);
            $('#lat').val(e.latlng.lat);
            $('#long').val(e.latlng.lng);
            circles = L.circle(e.latlng, 70);
            circles.addTo(map);
            marker = new L.marker(e.latlng).addTo(map);
            // map.panTo(new L.LatLng(e.latlng.lat, e.latlng.lng));
            map.flyTo([e.latlng.lat, e.latlng.lng], 18);
        });

        function showPosition() {
            if (navigator.geolocation) {
                if (marker) marker.remove();
                if (circles) map.removeLayer(circles);

                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var long = position.coords.longitude;

                    circles = L.circle([lat, long], 70);
                    circles.addTo(map);
                    map.flyTo([lat, long], 18);
                    marker = new L.marker([lat, long]).addTo(map);

                    $('#lat').val(lat);
                    $('#long').val(long);
                });
            } else {
                Swal.fire({
                    title: 'Maaf',
                    text: "Browser tidak mendukung GeoLocation",
                    icon: 'error',
                    showConfirmButton: false
                })
            }
        }
    </script>
@endsection
