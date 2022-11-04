<section class="p-3">
    <form id="form-validation" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 class="header3 font-weight-700 color-primary mb-12">Kertas</h2>

        <div class="form-group mb-12">
            <label for="">Size</label>
            <input type="text" class="form-control form-control-sm">
        </div>

        <div class="form-group mb-3">
            <label for="">Source</label>
            <input type="text" class="form-control form-control-sm">
        </div>

        <hr class="modal-divider mb-20">

        <h2 class="header3 font-weight-700 color-primary mb-12">Orientasi</h2>
        <h3 class="body1 font-weight-400 color-black">Size</h3>
        <div class="form-check form-check-inline form-group mr-5 mb-3">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label mb-0" for="inlineRadio1">Potrait</label>
        </div>
        <div class="form-check form-check-inline form-group">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label mb-0" for="inlineRadio1">Landscape</label>
        </div>

        <hr class="modal-divider mb-20">

        <h2 class="header3 font-weight-700 color-primary mb-12">Margin (mm)</h2>
        <div class="row">
            <div class="col-lg-6 mb-12">
                <div class="form-group">
                    <label for="">Kiri</label>
                    <input type="number" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-lg-6 mb-12">
                <div class="form-group">
                    <label for="">Kanan</label>
                    <input type="number" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Atas</label>
                    <input type="number" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="">Bawah</label>
                    <input type="number" class="form-control form-control-sm">
                </div>
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
    <button class="btn btn-custom green px-3 ml-3">
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
