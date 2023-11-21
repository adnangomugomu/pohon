<style>
    #map {
        width: 100%;
        height: 300px;
    }
</style>

<form action="#" onsubmit="event.preventDefault();doSubmit(this);">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Nama Pelapor <small class="text-danger">*</small></label>
                <input type="text" value="{{ $row->nama }}" name="nama" class="form-control" placeholder="masukkan isian" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Nomer HP <small class="text-danger">*</small></label>
                <input type="number" value="{{ $row->no_hp }}" name="no_hp" class="form-control" placeholder="Diutamakan whatsapp" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Email <small class="text-danger">*</small></label>
                <input type="email" value="{{ $row->email }}" name="email" class="form-control" placeholder="masukkan isian" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Jenis Aduan <small class="text-danger">*</small></label>
        <select name="aduan_id" class="form-control form_select" data-placeholder="pilih aduan" required>
            <option value=""></option>
            @foreach ($aduan as $item)
                <option {{ $row->aduan_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Deskripsi <small class="text-danger">*</small></label>
        <textarea name="deskripsi" rows="3" class="form-control" placeholder="deskripsi ...">{{ $row->deskripsi }}</textarea>
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
                <input type="text" id="lat" readonly value="{{ $row->latitude }}" name="latitude" class="form-control" placeholder="latitude">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Longitude <small class="text-danger">*</small></label>
                <input type="text" id="long" readonly value="{{ $row->longitude }}" name="longitude" class="form-control" placeholder="longitude">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Upload Foto Pendukung <small class="text-danger">(opsional)</small></label>
        <input type="file" accept="image/*" class="form-control" name="foto">
    </div>

    <div class="form-group">
        <img src="{{ asset($row->foto) }}" alt="foto" title="foto aduan" class="img-fluid m-1 rounded" style="width: 200px;height: 150px;object-fit: cover;">
    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">UPDATE</button>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('.form_select').select2({
            width: '100%',
        })
    });

    function doSubmit(dt) {

        Swal.fire({
            title: 'Update Data ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    url: "{{ route(session('type_role') . '.laporan_internal.update', $row->id) }}",
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
                        $('#modal_custom').modal('hide');
                        Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil disimpan',
                                showConfirmButton: true,
                            })
                            .then(() => {
                                $('#table-data').DataTable().ajax.reload();
                            })
                    }
                });
            }
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

    const posisi = {
        lat: {{ $row->latitude }},
        long: {{ $row->longitude }},
    }

    circles = L.circle([posisi.lat, posisi.long], 70);
    circles.addTo(map);
    marker = new L.marker([posisi.lat, posisi.long]).addTo(map);
    map.flyTo([posisi.lat, posisi.long], 18);

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
