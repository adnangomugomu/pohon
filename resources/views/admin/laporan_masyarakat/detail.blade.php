<style>
    #map {
        width: 100%;
        height: 200px;
    }
</style>

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td>Nama Pelapor</td>
                <td>{{ $row->nama }}</td>
            </tr>
            <tr>
                <td>Nomer HP</td>
                <td>{{ $row->no_hp }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $row->email }}</td>
            </tr>
            <tr>
                <td>Deskripsi Laporan</td>
                <td>{{ $row->deskripsi }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{ $row->status->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal Laporan</td>
                <td>{{ $row->created_at }}</td>
            </tr>
            <tr>
                <td>Jenis Aduan</td>
                <td>{{ $row->aduan->nama }}</td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-4">
            <h5>Foto Pendukung</h5>
            <img src="{{ asset($row->foto) }}" alt="foto" title="Foto pendukung" class="img-fluid m-1 rounded" style="width: 200px;height: 150px;object-fit: cover;">
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <div>Koordinat <small class="text-danger">*</small></div>
                    <button class="btn btn-link" onclick="window.open('https://www.google.com/maps/dir/?api=1&amp;destination={{ $row->latitude }},{{ $row->longitude }}')">Penunjuk Arah</button>
                </div>
                <div id="map" class="rounded border border-secondary"></div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Latitude <small class="text-danger">*</small></label>
                        <input type="text" id="lat" readonly value="{{ $row->latitude }}" name="latitude" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Longitude <small class="text-danger">*</small></label>
                        <input type="text" id="long" readonly value="{{ $row->longitude }}" name="longitude" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        @if ($row->status_id == 1)
            <button type="button" onclick="verif('proses',{{ $row->id }});" class="btn btn-success"><i class="fa fa-check"></i> Tangani Laporan</button>
        @elseif($row->status_id == 2)
            <button type="button" onclick="verif('selesai',{{ $row->id }});" class="btn btn-success"><i class="fa fa-check"></i> Laporan Sudah Ditangani</button>
        @elseif($row->status_id == 3)
            <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Selesai</button>
        @endif
    </div>
    <div class="col-md-6 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger">Hapus Data</button>
    </div>
</div>

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
