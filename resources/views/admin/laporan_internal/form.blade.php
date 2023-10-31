<form action="#" onsubmit="event.preventDefault();doSubmit(this);">   
    <div class="form-group">
        <label>Nama Pelapor <small class="text-danger">*</small></label>
        <input type="text" name="nama" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Nomer HP <small class="text-danger">*</small></label>
        <input type="number" name="no_hp" class="form-control" placeholder="Diutamakan whatsapp" required>
    </div>
    <div class="form-group">
        <label>Email <small class="text-danger">*</small></label>
        <input type="email" name="email" class="form-control" placeholder="masukkan isian" required>
    </div>
    <div class="form-group">
        <label>Deskripsi <small class="text-danger">*</small></label>
        <textarea name="deskripsi" rows="3" class="form-control" placeholder="deskripsi ..."></textarea>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">SIMPAN</button>
    </div>
</form>

<script>
    function doSubmit(dt) {

        Swal.fire({
            title: 'Simpan Data ?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.laporan_internal.store') }}",
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
