<section class="p-3">
    <form id="form-validation" class="row justify-content-center" action="{{ route('back.system.grup.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="nama">Grup User</label>
                <input type="text" class="form-control form-control-sm br12px" name="nama" id="nama" required>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="keterangan">Keterangan</label>
                <textarea class="form-control form-control-sm br12px" name="keterangan" id="keterangan" cols="30" rows="4"></textarea>
            </div>
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
    <button class="btn btn-custom green px-3 ml-3" id="btn-save">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>

<style>
    .br12px {
        border-radius: 12px !important;
    }
</style>

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

    $('body').on('click', '#refresh', function() {
        $('input').val('');
        $('textarea').val('');
    })
</script>
