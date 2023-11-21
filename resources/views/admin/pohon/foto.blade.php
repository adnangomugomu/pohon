<div class="card" style="background-color: #0c82e836;">
    <div class="card-body">
        <form action="#" id="form_pohon" onsubmit="event.preventDefault();doSubmitFoto(this);">
            <div class="form-group">
                <label>Upload Foto Pohon <small class="text-danger">*</small></label>
                <input type="file" accept="image/*" class="form-control" name="foto" required>
            </div>
            <button class="btn btn-success w-100"><i class="fa fa-send"></i> Simpan</button>
        </form>
    </div>
</div>

<div class="mt-3">List Foto <strong class="text-primary">{{ $row->nama_indo }} / {{ $row->nama_latin }}</strong></div>
<table class="table table-bordered table-custom" style="width: 100%" id="table-data-foto">
    <thead class="thead-colored thead-primary">
        <tr>
            <th class="text-white" style="width: 30px;">NO</th>
            <th class="text-white">FOTO</th>
            <th class="text-white">CAPTION</th>
            <th class="text-white" style="width: 50px;">AKSI</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    $(document).ready(function() {
        load_table_foto();
    });

    function load_table_foto() {
        $('#table-data-foto').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ordering: false,
            autoWidth: false,
            searching: false,
            bLengthChange: false,
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
                url: '{{ route(session('type_role') . '.pohon.foto.getTable', $row->id) }}',
                type: 'GET',
                dataType: 'JSON',
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                },
                {
                    data: 'foto',
                    name: 'foto'
                },
                {
                    data: 'caption',
                    name: 'caption'
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

    function doSubmitFoto(dt) {

        Swal.fire({
            title: 'Simpan Foto ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: "{{ route(session('type_role') . '.pohon.foto.store', $row->id) }}",
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
                                $('#form_pohon').trigger('reset');
                                $('#table-data-foto').DataTable().ajax.reload();
                            })
                    }
                });
            }
        })
    }

    function updateCaption(dt, id) {
        $.ajax({
            type: "POST",
            headers: {
                'X-HTTP-Method-Override': 'PUT'
            },
            url: "{{ route(session('type_role') . '.pohon.foto.update', '') }}/" + id,
            data: {
                caption: $(dt).val(),
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
                toastr.success('berhasil diperbarui');
            }
        });
    }

    function hapusFoto(id) {
        Swal.fire({
            title: 'Hapus Foto ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route(session('type_role') . '.pohon.foto.delete', '') }}/" + id,
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
                                $('#table-data-foto').DataTable().ajax.reload();
                            });
                    }
                });
            }
        })
    }
</script>
