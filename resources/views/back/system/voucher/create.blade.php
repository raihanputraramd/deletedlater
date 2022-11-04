<section class="p-3">
    <form id="form-validation" action="{{ route('back.system.voucher.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-12">
            <label for="kode">Kode</label>
            <input type="text" id="kode" name="kode" class="form-control form-control-sm">
        </div>

        <div class="form-group mb-12">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control form-control-sm">
        </div>

        <div class="form-group mb-12">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control form-control-sm">
        </div>

        <div class="form-group mb-12">
            <label for="tanggal_berakhir">Tanggal Berakhir</label>
            <input type="date" id="tanggal_berakhir" name="tanggal_berakhir" class="form-control form-control-sm">
        </div>

        <div class="form-group mb-12">
            <label for="potongan">Potongan</label>
            <input type="number" id="potongan" name="potongan" class="form-control form-control-sm">
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
</script>
