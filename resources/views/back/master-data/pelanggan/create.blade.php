<section class="p-3">
    <form id="form-validation" class="row justify-content-center" action="{{ route('back.master-data.pelanggan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="nama">Nama Pelanggan</label>
                <input type="text" class="form-control form-control-sm br12px" name="nama" id="nama" required>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="kode">Kode Pelanggan</label>
                <input type="text" class="form-control form-control-sm br12px" name="kode" id="kode">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control form-control-sm br12px" name="email" id="email">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="no_hp">No. HP</label>
                <input type="tel" class="form-control form-control-sm br12px" name="no_hp" id="no_hp">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="no_telepon">No. Telp</label>
                <input type="tel" class="form-control form-control-sm br12px" name="no_telepon" id="no_telepon">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control form-control-sm br12px" name="kota" id="kota">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control form-control-sm br12px" name="alamat" id="alamat" cols="30" rows="4"></textarea>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label for="diskon">Diskon</label>
                <input type="number" class="form-control form-control-sm br12px" name="diskon" id="diskon">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="diskon_beli">Level Harga</label>
                <select class="form-control form-control-sm br12px" name="level_harga" id="level_harga">
                    <option value="Normal">Normal</option>
                    <option value="Grosir 1">Grosir 1</option>
                    <option value="Grosir 2">Grosir 2</option>
                    <option value="Grosir 3">Grosir 3</option>
                </select>
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
    <button id="btn-save" class="btn btn-custom green px-3 ml-3">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>

<style>
    .br12px {
        border-radius: 12px !important;
    }

    .error {
        font-size: 12px;
        position: relative;
        line-height: 1;
        width: 100%;
        color: #ff0000;
    }
</style>

<script>
    $('#form-validation').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
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
