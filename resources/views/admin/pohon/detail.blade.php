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
                        <td>{{ $row->akar->nama }}</td>
                    </tr>
                    <tr>
                        <td>Kondisi</td>
                        <td>{{ $row->kondisi->nama }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>Tajuk</td>
                        <td>{{ $row->tajuk->nama }}</td>
                    </tr>
                    <tr>
                        <td>Utara (m)</td>
                        <td>{{ rupiah($row->utara, true) }}</td>
                    </tr>
                    <tr>
                        <td>Timur (m)</td>
                        <td>{{ rupiah($row->timur, true) }}</td>
                    </tr>
                    <tr>
                        <td>Selatan (m)</td>
                        <td>{{ rupiah($row->selatan, true) }}</td>
                    </tr>
                    <tr>
                        <td>Barat (m)</td>
                        <td>{{ rupiah($row->barat, true) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 text-center">
        <h3>Foto Pohon</h3>
        <hr>
        @foreach ($row->foto as $dt)
            <img src="{{ asset($dt->foto) }}" alt="foto" title="{{ $dt->caption }}" class="img-fluid m-1 rounded" style="width: 200px;height: 150px;object-fit: cover;">
        @endforeach
    </div>
</div>

@if ($row->is_verif == 0)
    @if (session('type_role') == 'admin')
        <div class="row">
            <div class="col-md-12 text-right">
                <button type="button" onclick="hapusData('{{ $row->id }}');" class="btn btn-danger">Hapus Data</button>
            </div>
        </div>
    @endif
@else
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-success">Sudah Diverifikasi</button>
        </div>
    </div>
@endif
