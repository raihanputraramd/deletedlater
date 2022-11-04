<section class="p-3">
    <form id="form-validation" action="{{ route('back.transaksi.kas-tunai.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-12">
            <label for="transaksi">Transaksi</label>
            <select class="form-control" name="transaksi" id="transaksi">
                <option value="Kas Keluar">Kas Keluar</option>
                <option value="Kas Masuk">Kas Masuk</option>
            </select>
        </div>
        <div class="form-group mb-12">
            <label for="jumlah">Jumlah (Rp)</label>
            <input type="number" class="form-control form-control-sm" name="jumlah" required>
        </div>
        <div class="form-group">
            <label for="keterangan" class="mb-1">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
        </div>
    </form>
</section>

<hr class="modal-divider">

<section class="p-2 d-flex justify-content-end">
    <button data-dismiss="modal" class="btn btn-custom red px-3 ml-3">
        <i class="fas fa-times-circle mr-2"></i>
        Keluar
    </button>
    <button id="refresh" class="btn btn-custom blue px-3 ml-3">
        <i class="fas fa-redo mr-2"></i>
        Kosongkan
    </button>
    <button id="btn-save" class="btn btn-custom green px-3 ml-3">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>

<script>
    $('#form-validation').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            element.closest('.col-md-9').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })

    $('#refresh').on('click', function() {
        $('input').val('')
        $('textarea').val('')
    })
</script>
