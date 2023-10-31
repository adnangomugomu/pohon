@extends('template.backend')

@section('title', $title)

@section('header', $header)
@section('tombol')
    <a class="btn btn-success mr-2" target="_blank" href="{{ route('admin.laporan_masyarakat.excel') }}"><i class="fa fa-print"></i> Cetak Excel</a>
@endsection
@section('konten')
    <div class="br-pagebody">
        <div class="br-section-wrapper p-0">
            <section class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-custom" style="width: 100%" id="table-data">
                                <thead class="thead-colored thead-primary">
                                    <tr>
                                        <th class="text-white" style="width: 30px;">NO</th>
                                        <th class="text-white">NAMA</th>
                                        <th class="text-white">NOMER HP</th>
                                        <th class="text-white">EMAIL</th>
                                        <th class="text-white">DESKRIPSI LAPORAN</th>
                                        <th class="text-white">STATUS</th>
                                        <th class="text-white">TANGGAL LAPORAN</th>
                                        <th class="text-white" style="width: 50px;">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            load_table();
        });

        function load_table() {
            $('#table-data').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ordering: true,
                autoWidth: false,
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: '{{ route('admin.laporan_masyarakat.getTable') }}',
                    type: 'GET',
                    dataType: 'JSON',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'tgl_laporan',
                        name: 'tgl_laporan'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ],
                order: [],
                columnDefs: [{
                    targets: [0, -1],
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                }],
            })
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });
        }

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.laporan_masyarakat.detail', '') }}/" + id,
                dataType: "JSON",
                data: {},
                beforeSend: function(res) {
                    beforeLoading(res);
                },
                error: function(res) {
                    errorLoading(res);
                },
                success: function(res) {
                    Swal.close();
                    show_modal_custom({
                        judul: 'Detail Laporan',
                        html: res.html,
                        size: 'modal-lg',
                    });
                }
            });
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Hapus Laporan ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.laporan_masyarakat.delete', '') }}/" + id,
                        dataType: "JSON",
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil dihapus',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    $('#modal_custom').modal('hide');
                                    $('#table-data').DataTable().ajax.reload();
                                });
                        }
                    });
                }
            })
        }

        function verif(jenis, id) {
            if (jenis == 'proses') {
                var text = "Proses Laporan ?";
            } else if (jenis == 'selesai') {
                var text = "Laporan Sudah Ditangani ?";
            }

            Swal.fire({
                title: text,
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
                        url: "{{ route('admin.laporan_masyarakat.verif', '') }}/" + id,
                        dataType: "JSON",
                        data: {
                            jenis: jenis,
                        },
                        beforeSend: function(res) {
                            beforeLoading(res);
                        },
                        error: function(res) {
                            errorLoading(res);
                        },
                        success: function(res) {
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil disimpan',
                                    showConfirmButton: true,
                                })
                                .then(() => {
                                    $('#modal_custom').modal('hide');
                                    $('#table-data').DataTable().ajax.reload();
                                });
                        }
                    });
                }
            })
        }
    </script>
@endsection
