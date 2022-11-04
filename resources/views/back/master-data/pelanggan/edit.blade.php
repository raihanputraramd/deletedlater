<section class="p-3">
    <form id="form-validation" action="{{ route('back.master-data.pelanggan.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="nama">Nama Pelanggan</label>
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="{{ $pelanggan->nama }}" required>
            </div>
        </div>

        <div class="form-group mb-12">
            <label for="kode">Kode Pelanggan</label>
            <input type="text" class="form-control form-control-sm" name="kode" id="kode" value="{{ $pelanggan->kode }}">
        </div>

        <div class="form-group mb-12">
            <label for="email">Email</label>
            <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ $pelanggan->email }}">
        </div>

        <div class="form-group mb-12">
            <label for="no_hp">No. HP</label>
            <input type="tel" class="form-control form-control-sm" name="no_hp" id="no_hp" value="{{ $pelanggan->no_hp }}">
        </div>

        <div class="form-group mb-12">
            <label for="no_telepon">No. Telp</label>
            <input type="tel" class="form-control form-control-sm" name="no_telepon" id="no_telepon" value="{{ $pelanggan->no_telepon }}">
        </div>

        <div class="form-group mb-12">
            <label for="kota">Kota</label>
            <input type="text" class="form-control form-control-sm" name="kota" id="kota" value="{{ $pelanggan->kota }}">
        </div>

        <div class="form-group mb-12">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control form-control-sm" name="alamat" id="alamat" value="{{ $pelanggan->alamat }}">
        </div>

        <div class="form-group mb-12">
            <label for="diskon">Diskon</label>
            <input type="number" class="form-control form-control-sm" name="diskon" id="diskon" value="{{ $pelanggan->diskon }}">
        </div>

        <div class="form-group mb-12">
            <label for="point">Point</label>
            <input type="number" class="form-control form-control-sm" name="point" id="point" value="{{ $pelanggan->point }}">
        </div>

        <div class="form-group">
            <label for="diskon_beli">Level Harga</label>
            <select class="form-control form-control-sm" name="level_harga" id="level_harga">
                <option value="Normal">Normal</option>
                <option value="Grosir 1">Grosir 1</option>
                <option value="Grosir 2">Grosir 2</option>
                <option value="Grosir 3">Grosir 3</option>
            </select>
        </div>
    </form>
</section>

<hr class="modal-divider">

<section class="p-2 d-flex justify-content-end">
    <button class="btn btn-custom red px-3 ml-3" data-dismiss="modal">
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

    $('#level_harga').val("{{ $pelanggan->level_harga }}")

    $('#refresh').on('click', function() {
        $('input').val('')
        $('textarea').val('')
    })
</script>
