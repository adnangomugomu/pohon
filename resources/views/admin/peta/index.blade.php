<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Website description -->
    <meta name="description" content="Peta persebaran">
    <!-- Author Name -->
    <meta name="author" content="Peta Persebaran">
    <!-- SEO keyword -->
    <meta name="keywords" content="Peta persebaran">
    <!-- Robots Meta Tag -->
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- favicon -->
    <link rel="shortcut icon" href="images/logo-ska.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('peta') }}/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Icons -->
    <link href="{{ asset('peta') }}/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <!-- Slider -->
    <link rel="stylesheet" href="{{ asset('peta') }}/css/tiny-slider.css">
    <!-- Leaflet -->
    <link rel="stylesheet" href="{{ asset('peta') }}/css/leaflet.css" crossorigin="">
    <link rel="stylesheet" href="{{ asset('peta') }}/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Leaflet Fullscreen -->
    <link href="{{ asset('peta') }}/css/leaflet.fullscreen.css" rel="stylesheet">
    <!-- Main Css -->
    <link href="{{ asset('peta') }}/css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt">
    <link href="{{ asset('peta') }}/css/default.css" rel="stylesheet" id="color-opt">
    <link href="{{ asset('peta') }}/css/custom-kab.css" rel="stylesheet" id="custom-css">
    <link href="{{ asset('template-new') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">

    <title>Peta Persebaran</title>

    <style>
        #sidebar_sektoral,
        #sidebar_layer,
        #detail_klik {
            position: absolute;
            right: 20px;
            top: 100px;
            width: 500px;
            max-width: 500px;
            background-color: rgba(196, 47, 28, 0.85);
            z-index: 9999;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            padding-top: 20px;
        }

        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 5px !important;
        }

        .swal2-title {
            font-size: 20px !important;
        }
    </style>
</head>

<body>
    <header id="topnav" class="defaultscroll sticky map-header">
        <div class="container-fluid">
            <!-- Logo container-->
            <a style="position: absolute;" class="logo logo-wrap" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('img/bg-2.png') }}" height="120" class="logo-light-mode" alt="">
            </a>

            <div class="buy-button">
                <div class="list-navigation">
                    <a class="nav-btn" href="{{ route('admin.dashboard') }}" title="Menuju ke Beranda"><i data-feather="home" class="fea-lg"></i></a>
                    <a class="nav-btn" id="layer" href="javascript:void(0);"><i data-feather="layers" class="fea-lg"></i></a>
                    <a class="nav-btn" id="center" href="javascript:void(0);"><i data-feather="map-pin" class="fea-lg"></i></a>
                    <a class="nav-btn" id="zoom-out" href="javascript:void(0);"><i data-feather="zoom-out" class="fea-lg"></i></a>
                    <a class="nav-btn" id="zoom-in" href="javascript:void(0);"><i data-feather="zoom-in" class="fea-lg"></i></a>
                    <div class="form-icon position-relative" hidden="">
                        <input type="text" name="search" id="search" class="form-control ps-5 rounded" placeholder="Cari dengan Kata Kunci : " required="">
                        <button class="btn search-btn" type="submit">
                            <i data-feather="corner-down-right" class="btn-icon fea icon-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Logo container-->
            <div class="menu-extras d-none">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
        </div>
    </header>

    <section class="peta-section p-0">
        <div id="map-id"></div>
        <div class="peta-wrap mb-3 mb-lg-4">

            <div id="sidebar_layer" class="rounded popup_data" style="display:none;padding-top: 5px !important;">
                <h3 class="text-center text-white font-weight-bold">LAYER</h3>
                <button class="btn btn-light btn-sm btn-rounded" onclick="$('#sidebar_layer').slideUp(400);" style="position: absolute; top: 10px;right: 10px;">
                    <i class="fa fa-times"></i> Tutup
                </button>
                <div class="p-3 rounded" id="layer_all" style="background-color: #fff;max-height: 450px;overflow-y: auto;">
                    <button onclick="hitung_jarak();" class="btn btn-link p-0">Tampilkan Jarak Dengan Lokasi Sekarang ?</button>
                    <div id="target_jarak">
                        <table>
                            @foreach ($pohon as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->nama_indo }}</strong> ( <i>{{ $item->nama_latin }}</i> )
                                    </td>
                                    <td>
                                        <button title="lokasi pohon" class="btn btn-primary btn-sm" onclick="detail_layer({{ $item->latitude }},{{ $item->longitude }})">
                                            <i class="fa fa-map"></i>
                                        </button>
                                        <button title="penunjuk arah" class="btn btn-success btn-sm" onclick="window.open('https://www.google.com/maps/dir/?api=1&amp;destination={{ $item->latitude }},{{ $item->longitude }}')">
                                            <i class="fa fa-location"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div id="detail_klik" class="rounded popup_data" style="display:none;">
                <h3 class="text-center text-white font-weight-bold">INFORMASI</h3>
                <button class="btn btn-light btn-sm btn-rounded" onclick="$('#detail_klik').slideUp(400);" style="position: absolute; top: 10px;right: 10px;">
                    <i class="fa fa-times"></i> Tutup
                </button>
                <div class="p-3 rounded" id="detail_html" style="background-color: #fff;height: 300px;overflow-y: auto;">

                </div>
            </div>

            <div class="mobile-nav-wrap">
                <div class="mobile-nav">
                    <a class="nav-btn" href="{{ route('admin.dashboard') }}" title="Menuju ke Beranda"><i data-feather="home" class="fea-lg"></i></a>
                    <a class="nav-btn" id="layer" href="javascript:void(0);"><i data-feather="layers" class="fea-lg"></i></a>
                    <a class="nav-btn" id="center" href="javascript:void(0);"><i data-feather="map-pin" class="fea-lg"></i></a>
                    <a class="nav-btn" id="zoom-out" href="javascript:void(0);"><i data-feather="zoom-out" class="fea-lg"></i></a>
                    <a class="nav-btn" id="zoom-in" href="javascript:void(0);"><i data-feather="zoom-in" class="fea-lg"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- JS Scripts -->
    <script src="{{ asset('peta') }}/js/jquery.js"></script>
    <script src="{{ asset('peta') }}/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('peta') }}/js/jquery.fancybox.js"></script>
    <script src="{{ asset('peta') }}/js/tilt.jquery.min.js"></script>
    <script src="{{ asset('peta') }}/js/jquery.paroller.min.js"></script>
    <script src="{{ asset('peta') }}/js/jquery-ui.js"></script>
    <script src="{{ asset('peta') }}/js/popper.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('peta') }}/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('peta') }}/js/tiny-slider.js"></script>
    <script src="{{ asset('peta') }}/js/feather.min.js"></script>
    <script src="{{ asset('peta') }}/js/switcher.js"></script>
    <script src="{{ asset('peta') }}/js/plugins.init.js"></script>
    <script src="{{ asset('peta') }}/js/app.js"></script>

    <!-- Loading Overlay -->
    <script src="{{ asset('peta') }}/js/loadingoverlay.min.js"></script>

    <!-- Axios -->
    <script src="{{ asset('peta') }}/js/axios.min.js"></script>

    <!-- Leaflet.js -->
    <script src="{{ asset('peta') }}/js/leaflet.js" crossorigin=""></script>

    <!-- Leaflet AJAX -->
    <script src="{{ asset('peta') }}/js/leaflet.ajax.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Leaflet Fullscreen -->
    <script src="{{ asset('peta') }}/js/Leaflet.fullscreen.min.js"></script>

    <!-- Esri Leaflet -->
    <script src="{{ asset('peta') }}/js/esri-leaflet.js" crossorigin=""></script>

    <!-- Esri Leaflet Vector -->
    <script src="{{ asset('peta') }}/js/esri-leaflet-vector.js" crossorigin=""></script>

    <link rel="stylesheet" href="{{ asset('peta') }}/css/toastr.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="{{ asset('peta') }}/js/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('peta') }}/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{ asset('peta') }}/css/MarkerCluster.css">
    <link rel="stylesheet" href="{{ asset('peta') }}/css/MarkerCluster.Default.css">

    <script src="{{ asset('peta') }}/js/leaflet.markercluster.js"></script>

    <script>
        // Init map
        var map;
        const LAYER = {};
        map = L.map(`map-id`, {
            doubleClickZoom: false,
            zoomControl: false,
        }).setView([-7.40306, 110.63983], 11);

        setInterval(function() {
            map.invalidateSize();
        }, 1000);

        // Base map
        let basemap = {
            "osm": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }),
            "Google Roadmap": L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'Map data © <a href="https://google.com/maps/">Google Maps</a>'
            }),
            "Google Satellite": L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'Map data © <a href="https://google.com/maps/">Google Maps</a>'
            }).addTo(map),
            "Google Hybrid": L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'Map data © <a href="https://google.com/maps/">Google Maps</a>'
            }),
            "Google Terrain": L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                attribution: 'Map data © <a href="https://google.com/maps/">Google Maps</a>'
            }),
            "Esri World Imagery": L.esri.tiledMapLayer({
                url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer',
                maxZoom: 17,
            }),
            "Esri World Street Map": L.esri.tiledMapLayer({
                url: 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer',
                maxZoom: 17,
            }),
            "Esri World Topo Map": L.esri.tiledMapLayer({
                url: 'https://services.arcgisonline.com/arcgis/rest/services/World_Topo_Map/MapServer',
                maxZoom: 17,
            }),
            "Peta RBI": L.esri.tiledMapLayer({
                url: 'https://portal.ina-sdi.or.id/arcgis/rest/services/RBI/Basemap/MapServer',
                maxZoom: 19,
            })
        }

        L.control.layers(basemap, null, {
            position: 'bottomleft'
        }).addTo(map);

        L.control.scale({
            position: 'bottomright',
        }).addTo(map);

        // Zoom In & Out Event
        L.DomEvent.on(L.DomUtil.get('zoom-in'), 'click', (event) => map.setZoom(map.getZoom() + 1))
        L.DomEvent.on(L.DomUtil.get('zoom-out'), 'click', (event) => map.setZoom(map.getZoom() - 1));
        L.DomEvent.on(L.DomUtil.get('center'), 'click', (event) => map.setView([-7.40306, 110.63983], 11));
        $('#layer').on('click', function(e) {
            $('#detail').hide();
            if ($('#sidebar_layer').is(':visible')) {
                $('#sidebar_layer').slideUp(400);
            } else {
                $('.popup_data').hide();
                $('#sidebar_layer').slideDown(400);
            }
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $(document).ready(function() {
            load_peta();
            load_batas();
        });

        var geoJson, batasKecamatan;

        function load_peta() {
            if (geoJson) map.removeLayer(geoJson);

            geoJson = new L.GeoJSON.AJAX("{{ route('admin.peta.geojson') }}", {
                onEachFeature: function(feature, layer) {
                    layer.on({
                        'click': function(e) {
                            select_layer(e.target, e);
                        }
                    });
                }
            })

            geoJson.on("data:loading", function() {
                Swal.fire({
                    title: 'Loading',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            });

            geoJson.on("data:loaded", function() {
                // map.fitBounds(geoJson.getBounds());
                geoJson.addTo(map);
                Swal.close();
            });
        }

        function load_batas() {
            if (batasKecamatan) map.removeLayer(batasKecamatan);

            batasKecamatan = new L.GeoJSON.AJAX("{{ asset('peta/batas_kecamatan.geojson') }}", {
                style: (feature) => {
                    let color = '#c51162';

                    return {
                        fillColor: color,
                        fillOpacity: 0,
                        color: color,
                        opacity: 1,
                        weight: 2,
                        dashArray: '4',
                        dahsOffset: 2
                    }
                },
                onEachFeature: function(feature, layer) {
                    layer.on({
                        'click': function(e) {
                            select_layer(e.target, e);
                        }
                    });
                }
            })

            batasKecamatan.on("data:loading", function() {
                Swal.fire({
                    title: 'Loading',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            });

            batasKecamatan.on("data:loaded", function() {
                // map.fitBounds(batasKecamatan.getBounds());
                batasKecamatan.addTo(map);
                Swal.close();
            });
        }

        function select_layer(layer, e) {

            var data = e.target.feature.properties;
            var is_visible_info = $("#detail_klik").is(":visible");
            if (!is_visible_info) $('#detail_klik').fadeIn(500);

            var data_show = '';
            var kondisi = [
                'objectid', 'shape_length', 'stroke', 'shape_area', 'fill', 'fill_opacity', 'stroke_opacity', 'icon_name',
                'orde 1', 'orde 2', 'orde 3', 'orde 4', 'namobj', 'kode_kecamatan', 'id', 'is_verif', 'foto',
            ];

            $.map(data, function(e, i) {
                if (!kondisi.includes(i.toLowerCase())) {
                    data_show += `
                <tr>
                    <td>${i.replaceAll('_',' ')}</td>
                    <td>${e}</td>
                </tr>
                `;
                }
            });

            var foto = '<h4 class="my-2">Foto Pohon</h4> <div class="row">';

            $.map(data.foto, function(elemen, index) {
                foto += `
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body p-0">
                                <img class="" src="{{ asset('') }}${elemen.foto}" style="object-fit: cover;width:100%;height:150px;" />
                            </div>
                            <div class="card-footer p-1 text-center">
                                <small>${elemen.caption}</small>
                            </div>
                        </div>
                    </div>
                `;
            });
            foto += '</div>';

            var html = `
                <table style="width: 100%;" class="table table-hover">
                    <tbody>
                        ${data_show}
                    </tbody>
                </table>
                ${foto}
            `;

            $('#detail_html').html(html);
            $('#sidebar_layer').hide();
        }

        function detail_layer(lat, long) {
            map.flyTo([lat, long], 18);
        }

        function hitung_jarak() {
            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var long = position.coords.longitude;

                    Swal.fire({
                        title: 'Aplikasi akan menghitung jarak pohon dengan lokasi anda sekarang ?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {

                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.peta.jarak') }}",
                                data: {
                                    lat: lat,
                                    long: long,
                                },
                                dataType: "JSON",
                                beforeSend: function(res) {
                                    beforeLoading(res);
                                },
                                error: function(res) {
                                    errorLoading(res);
                                },
                                success: function(res) {
                                    Swal.close();
                                    var html = '';

                                    $.map(res.data, function(e, i) {
                                        html += `
                                            <tr>
                                                <td>
                                                    <strong>${e.nama_indo}</strong> ( <i>${e.nama_latin}</i> )
                                                    <small class="d-block">estimasi jarak ${formatRupiah(parseInt(e.jarak_meter)+'')}m</small>
                                                </td>
                                                <td>
                                                    <button title="lokasi pohon" class="btn btn-primary btn-sm" onclick="detail_layer(${e.latitude},${e.longitude})">
                                                        <i class="fa fa-map"></i>
                                                    </button>
                                                    <button title="penunjuk arah" class="btn btn-success btn-sm" onclick="window.open('https://www.google.com/maps/dir/?api=1&amp;destination=${e.latitude},${e.longitude}')">
                                                        <i class="fa fa-location"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        `;
                                    });

                                    $('#target_jarak').html(`
                                        <table>
                                            ${html}
                                        </table>
                                    `);
                                }
                            });
                        }
                    })

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

    <script>
        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
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

</body>

</html>
