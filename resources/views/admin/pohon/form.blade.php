@extends('template.backend')

@section('title', $title)

@section('header', $header)

@section('style')
    <style>
        #map {
            width: 100%;
            height: 300px;
        }
    </style>
@endsection

@section('konten')
    <div class="br-pagebody">
        <div class="br-section-wrapper p-4">
            <form action="#" onsubmit="event.preventDefault();doSubmit(this);">
                <div class="form-group">
                    <label>Nama Indonesia <small class="text-danger">*</small></label>
                    <input type="text" value="" name="nama_indo" class="form-control" placeholder="masukkan isian" required>
                </div>

                <div class="form-group">
                    <label>Nama Latin <small class="text-danger">*</small></label>
                    <input type="text" value="" name="nama_latin" class="form-control" placeholder="masukkan isian" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kecamatan <small class="text-danger">*</small></label>
                            <select id="select_kec" onchange="pilih_kel(this);" name="kode_kec" class="form-control form_select" data-placeholder="pilih kecamatan" required>
                                <option value=""></option>
                                @foreach ($kecamatan as $item)
                                    <option value="{{ $item->kode_wilayah }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Desa/Kelurahan <small class="text-danger">*</small></label>
                            <select id="select_kel" name="kode_kel" class="form-control form_select" data-placeholder="pilih kelurahan" required>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <div>Koordinat Pohon <small class="text-danger">*</small></div>
                        <button type="button" onclick="showPosition();" class="btn btn-sm btn-link">Ambil Lokasi GPS ?</button>
                    </div>
                    <div id="map" class="rounded border border-secondary"></div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Latitude <small class="text-danger">*</small></label>
                            <input type="text" id="lat" readonly value="" name="latitude" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Longitude <small class="text-danger">*</small></label>
                            <input type="text" id="long" readonly value="" name="longitude" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kode Pohon <small class="text-danger">*</small></label>
                            <input type="text" value="" name="kode" class="form-control" placeholder="masukkan isian" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Pohon <small class="text-danger">*</small></label>
                            <select name="jenis_id" class="form-control form_select" data-placeholder="pilih jenis" required>
                                <option value=""></option>
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lokasi <small class="text-danger">(opsional)</small></label>
                            <input type="text" value="" name="lokasi" class="form-control" placeholder="ex: jl. merdeka 45">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tinggi Pohon (cm) <small class="text-danger">*</small></label>
                            <input type="text" value="" name="tinggi" class="form-control rupiah" placeholder="masukkan isian" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Diameter Pohon (cm) <small class="text-danger">*</small></label>
                            <input type="text" value="" name="diameter" class="form-control rupiah" placeholder="masukkan isian" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Akar Pohon <small class="text-danger">*</small></label>
                            <select name="akar_id" class="form-control form_select" data-placeholder="pilih akar" required>
                                <option value=""></option>
                                @foreach ($akar as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kondisi Pohon <small class="text-danger">*</small></label>
                            <select name="kondisi_id" class="form-control form_select" data-placeholder="pilih kondisi" required>
                                <option value=""></option>
                                @foreach ($kondisi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tajuk <small class="text-danger">*</small></label>
                            <select name="tajuk_id" class="form-control form_select" data-placeholder="pilih tajuk" required>
                                <option value=""></option>
                                @foreach ($tajuk as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-layout form-layout-7">
                            <div class="row no-gutters">
                                <div class="col-5 col-sm-4">
                                    Tajuk Utara (m)
                                </div>
                                <div class="col-7 col-sm-8">
                                    <input class="form-control rupiah" type="text" name="utara" placeholder="Tajuk utara" required>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-5 col-sm-4">
                                    Tajuk Selatan (m)
                                </div>
                                <div class="col-7 col-sm-8">
                                    <input class="form-control rupiah" type="text" name="selatan" placeholder="Tajuk selatan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-layout form-layout-7">
                            <div class="row no-gutters">
                                <div class="col-5 col-sm-4">
                                    Tajuk Timur (m)
                                </div>
                                <div class="col-7 col-sm-8">
                                    <input class="form-control rupiah" type="text" name="timur" placeholder="Tajuk timur" required>
                                </div>
                            </div>
                            <div class="row no-gutters">
                                <div class="col-5 col-sm-4">
                                    Tajuk Barat (m)
                                </div>
                                <div class="col-7 col-sm-8">
                                    <input class="form-control rupiah" type="text" name="barat" placeholder="Tajuk barat" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Detail <small class="text-danger">(opsional)</small></label>
                    <textarea name="detail" rows="3" class="form-control" placeholder="detail pohon"></textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    <button type="button" onclick="history.go(-1);" class="btn btn-secondary">BATAL</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.css" integrity="sha512-OyIJmh4XggYsUxdlYua68RMPbPo/5b63LHzoLETEVwubMGcJp9IrbmxxydRZw41FiOKAK0M60eOiqkRq59OwpA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.min.js" integrity="sha512-10PRJppn1d6/3lrfc+7e4S+0mfdNFLlv3QmDpwISpVsrPdkSccy/T22neLEWc5cmL6biDscH3WwrhHam9vMOIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('.form_select').select2({
                width: '100%',
            })
        });

        function doSubmit(dt) {

            Swal.fire({
                title: 'Simpan Data Pohon ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.pohon.store') }}",
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
                                    title: 'Data berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    location.href = "{{ route('admin.pohon') }}"
                                })
                        }
                    });
                }
            })
        }

        function pilih_kel(dt) {
            $.ajax({
                type: "POST",
                url: "{{ route('profil.get_kel') }}",
                data: {
                    kode_wilayah: $(dt).val(),
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
                    var html = '<option value=""></option>';
                    $.map(res.data, function(e, i) {
                        html += `
                            <option value="${e.kode_wilayah}">${e.nama}</option>
                       `;
                    });
                    $('#select_kel').html(html);
                }
            });
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

        L.Control.Scale.include({
            _originalUpdateScale: L.Control.Scale.prototype._updateScale,
            _updateScale: function(scale, text, ratio) {
                this._originalUpdateScale.call(this, scale, text, ratio);
                this._map.fire('scaleupdate', {
                    pixels: scale.style.width,
                    distance: text
                });
            }
        });

        var scale = L.control.scale({
            position: 'bottomright',
            imperial: false,
        });

        scale.addTo(map);

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
