<section class="p-3">
    <form id="form-validation" action="{{ route('back.system.hapus-data-pembeli.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-12">
            <label for="">Hapus Data Pembelian Sebelum</label>
            <input type="date" class="form-control form-control-sm" name="tanggal" required>
        </div>
    </form>
</section>

<hr class="modal-divider">

<section class="p-2 d-flex justify-content-end">
    <button data-dismiss="modal" class="btn btn-custom red px-3 ml-3">
        <i class="fas fa-times-circle mr-2"></i>
        Keluar
    </button>
    <button class="btn btn-custom green px-3 ml-3" id="btn-save">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>

<script>
    $('#form-validation').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error)
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })
</script>
