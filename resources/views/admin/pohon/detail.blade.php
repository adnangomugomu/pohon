<div class="row">
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>Nama Indonesia</td>
                        <td>{{ $row->nama_indo }}</td>
                    </tr>
                    <tr>
                        <td>Nama Latin</td>
                        <td>{{ $row->nama_latin }}</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>{{ $row->kecamatan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Kelurahan</td>
                        <td>{{ $row->kelurahan->nama }}</td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td>{{ $row->latitude }}</td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td>{{ $row->longitude }}</td>
                    </tr>
                    <tr>
                        <td>Detail Pohon</td>
                        <td>{{ $row->detail }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>Kode Pohon</td>
                        <td>{{ $row->kode }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Pohon</td>
                        <td>{{ $row->jenis->nama }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>{{ $row->lokasi }}</td>
                    </tr>
                    <tr>
                        <td>Tinggi Pohon (cm)</td>
                        <td>{{ rupiah($row->tinggi, true) }}</td>
                    </tr>
                    <tr>
                        <td>Diameter Pohon (cm)</td>
                        <td>{{ rupiah($row->diameter, true) }}</td>
                    </tr>
                    <tr>
                        <td>Akar Pohon</td>
                        <td>{{ $row->akar }}</td>
                    </tr>
                    <tr>
                        <td>Kondisi</td>
                        <td>{{ $row->kondisi }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger">Hapus Data</button>
    </div>
</div>
