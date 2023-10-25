@extends('template.backend')

@section('title', $title)

@section('header', $header)
@section('tombol')
    <a class="btn btn-success mr-2" target="_blank" href="{{ route('admin.pohon.excel') }}"><i class="fa fa-print"></i> Export</a>
    <a class="btn btn-primary" href="{{ route('admin.pohon.create') }}"><i class="fa fa-plus"></i> Tambah Data</a>
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
                                        <th class="text-white">NAMA POHON</th>
                                        <th class="text-white">LOKASI</th>
                                        <th class="text-white">KODE</th>
                                        <th class="text-white">MAP</th>
                                        <th class="text-white">JENIS</th>
                                        <th class="text-white">DATA</th>
                                        <th class="text-white">FOTO</th>
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
                    url: '{{ route('admin.pohon.getTable') }}',
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
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                    {
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'map',
                        name: 'map'
                    },
                    {
                        data: 'jenis.nama',
                        name: 'jenis'
                    },
                    {
                        data: 'isi_data',
                        name: 'isi_data'
                    },
                    {
                        data: 'tombol_foto',
                        name: 'tombol_foto'
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
                }, ],
            })
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });
        }

        function editData(id) {
            var link = "{{ route('admin.pohon.edit', '') }}/" + id;
            location.href = link;
        }

        function detailData(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.pohon.detail', '') }}/" + id,
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
                        judul: 'Detail Data Pohon',
                        html: res.html,
                        size: 'modal-lg',
                    });
                }
            });
        }

        function lihat_map(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.pohon.peta', '') }}/" + id,
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
                        judul: 'Lokasi Pohon',
                        html: res.html,
                        size: 'modal-lg',
                    });
                }
            });
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Hapus Data Pohon ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.pohon.delete', '') }}/" + id,
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
    </script>
@endsection
