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
        </tbody>
    </table>
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
