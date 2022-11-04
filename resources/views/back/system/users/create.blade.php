<section class="p-3">
    <form id="form-validation" class="row justify-content-center" action="{{ route('back.system.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="username">Username</label>
                <input type="text" class="form-control form-control-sm br12px" name="username" id="username" required>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="password">Password</label>
                <input type="password" class="form-control form-control-sm br12px" name="password" id="password" required>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" class="form-control form-control-sm br12px" name="konfirmasi_password" id="konfirmasi_password" required>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="nama">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm br12px" name="nama" id="nama" required>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="gender">Gender</label>
                <select class="form-control form-control-sm br12px" name="gender">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="no_hp">No. HP</label>
                <input type="tel" class="form-control form-control-sm br12px" name="no_hp" id="no_hp">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="no_telepon">No. Telp</label>
                <input type="tel" class="form-control form-control-sm br12px" name="no_telepon" id="no_telepon">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="alamat">Alamat</label>
                <textarea class="form-control form-control-sm br12px" name="alamat" id="alamat" cols="30" rows="4"></textarea>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="no_induk">No. Induk Pegawai</label>
                <input type="tel" class="form-control form-control-sm br12px" name="no_induk" id="no_induk">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="jabatan">Jabatan</label>
                <input type="tel" class="form-control form-control-sm br12px" name="jabatan" id="jabatan">
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="grup">Grup</label>
                <select class="form-control form-control-sm br12px" name="grup">
                    @foreach ($grup as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
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
    <button class="btn btn-custom green px-3 ml-3" id="btn-save">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>

<style>
    .br12px {
        border-radius: 12px !important;
    }

    .error {
        font-size: 14px !important;
        font-style: normal !important;
        line-height: normal !important;
        color: red !important;
    }
</style>

<script>
    $('#form-validation').validate({
        rules: {
            password: {
                required: true,
                minlength: 6
            },
            konfirmasi_password: {
                required: true,
                minlength : 6,
                equalTo : "#password"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.addClass('body1');
            element.closest('.form-group').append(error);
            element.closest('.col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    })

    $('body').on('click', '#refresh', function() {
        $('input').val('')
        $('textarea').val('')
    })
</script>
