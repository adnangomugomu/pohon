@extends('template.backend')

@section('title', $title)

@section('header', $header)
@section('tombol')
    <a class="btn btn-success mr-2" target="_blank" href="{{ route(session('type_role') . '.laporan_masyarakat.excel') }}"><i class="fa fa-print"></i> Cetak Excel</a>
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
                                        <th class="text-white">JENIS ADUAN</th>
                                        <th class="text-white">NAMA</th>
                                        <th class="text-white">NOMER HP</th>
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.css" integrity="sha512-OyIJmh4XggYsUxdlYua68RMPbPo/5b63LHzoLETEVwubMGcJp9IrbmxxydRZw41FiOKAK0M60eOiqkRq59OwpA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/1.2.0/Control.FullScreen.min.js" integrity="sha512-10PRJppn1d6/3lrfc+7e4S+0mfdNFLlv3QmDpwISpVsrPdkSccy/T22neLEWc5cmL6biDscH3WwrhHam9vMOIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
                    url: '{{ route(session('type_role') . '.laporan_masyarakat.getTable') }}',
                    type: 'GET',
                    dataType: 'JSON',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                    },
                    {
                        data: 'aduan.nama',
                        name: 'aduan.nama'
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
                url: "{{ route(session('type_role') . '.laporan_masyarakat.detail', '') }}/" + id,
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
                        url: "{{ route(session('type_role') . '.laporan_masyarakat.delete', '') }}/" + id,
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
                        url: "{{ route(session('type_role') . '.laporan_masyarakat.verif', '') }}/" + id,
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
