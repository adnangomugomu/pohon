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
                        <h2 class="font-bold">Detail Pohon</h2>
                        <h4 class="font-light pt-2">Informasi lengkap dari pohon</h4>
                    </div>
                </div>
            </div>
            <div class="bg-blue title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-left">Detail</h3>
                        <ul class="breadcrumb top10 bottom10 float-right">
                            <li class="breadcrumb-item hover-light"><a href="{{ route('front.pohon') }}">Pohon</a></li>
                            <li class="breadcrumb-item hover-light">Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('konten')
    <section id="our-blog" class="bglight padding_top padding_bottom_half">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="news_item shadow-equal">
                        <div class="news_desc text-center text-md-left">
                            <h3 class="text-capitalize font-bold darkcolor"><a href="#" onclick="return false;">{{ $row->nama_indo }} ({{ $row->nama_latin }})</a></h3>
                            <ul class="meta-tags top20 bottom20">
                                <li><a href="#" onclick="return false;"><i class="fas fa-calendar-alt"></i>{{ date('d F Y', strtotime($row->created_at)) }}</a></li>
                            </ul>
                            <h4 class="font-bold">Informasi</h4>
                            <p class="bottom35">{{ $row->detail }}</p>

                            <h4 class="font-bold">Rincian</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="rounded heading_space text-left">
                                        <li>Nama Pohon : {{ $row->nama_indo }}</li>
                                        <li class="mt-0">Bahasa Latin : {{ $row->nama_latin }}</li>
                                        <li class="mt-0">Jenis : {{ $row->jenis->nama }}</li>
                                        <li class="mt-0">Kode Pohon : {{ $row->kode }}</li>
                                        <li class="mt-0">Tinggi (cm) : {{ $row->tinggi }}</li>
                                        <li class="mt-0">Diameter (cm) : {{ $row->diameter }}</li>
                                        <li class="mt-0">Akar : {{ $row->akar }}</li>
                                        <li class="mt-0">Kondisi : {{ $row->kondisi }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="rounded heading_space text-left">
                                        <li>Lokasi : {{ $row->lokasi }}</li>
                                        <li class="mt-0">Kecamatan : {{ $row->kecamatan->nama }}</li>
                                        <li class="mt-0">Kelurahan : {{ $row->kelurahan->nama }}</li>
                                        <li class="mt-0">Latitude : {{ $row->latitude }}</li>
                                        <li class="mt-0">Longitude : {{ $row->longitude }}</li>
                                    </ul>
                                </div>
                            </div>

                            <h4 class="font-bold">Foto Pohon</h4>
                            <div class="row bottom35">
                                @foreach ($row->foto as $item)
                                    <div class="col-md-4">
                                        <img src="{{ asset($item->foto) }}" alt="foto" class="img-fluid img_cover rounded">
                                        <div class="text-center">
                                            <i>{{ $item->caption }}</i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        
                            <div class="d-flex justify-content-between">
                                <h4 class="font-bold">Lokasi Pohon</h4>
                                <button class="btn btn-link" onclick="window.open('https://www.google.com/maps/dir/?api=1&amp;destination={{ $row->latitude }},{{ $row->longitude }}')">Penunjuk Arah</button>
                            </div>
                            <div id="map" class="rounded border border-secondary"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.css" integrity="sha512-OyIJmh4XggYsUxdlYua68RMPbPo/5b63LHzoLETEVwubMGcJp9IrbmxxydRZw41FiOKAK0M60eOiqkRq59OwpA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.min.js" integrity="sha512-10PRJppn1d6/3lrfc+7e4S+0mfdNFLlv3QmDpwISpVsrPdkSccy/T22neLEWc5cmL6biDscH3WwrhHam9vMOIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        map.scrollWheelZoom.disable();

        basemap = {
            osm: L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }),
            google_roadmap: L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            google_satellite: L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map),
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

        setInterval(function() {
            map.invalidateSize();
        }, 100);

        const posisi = {
            lat: {{ $row->latitude }},
            long: {{ $row->longitude }},
        }

        if (circles) map.removeLayer(circles);
        if (marker) map.removeLayer(marker);

        circles = L.circle([posisi.lat, posisi.long], 70);
        circles.addTo(map);
        marker = new L.marker([posisi.lat, posisi.long]).addTo(map);
        map.flyTo([posisi.lat, posisi.long], 18);
    </script>
@endsection
