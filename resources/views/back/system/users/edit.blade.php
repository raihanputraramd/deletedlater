<section class="p-3">
    <form id="form-validation" action="{{ route('back.system.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="form-group mb-12">
                <label for="username">Username</label>
                <input type="text" class="form-control form-control-sm" name="username" id="username" value="{{ $user->username }}" required>
            </div>
            <div class="form-group mb-12">
                <label for="password">Password</label>
                <input type="password" class="form-control form-control-sm" name="password" id="password">
            </div>
            <div class="form-group mb-12">
                <label for="konfirmasi_password">Konfirmasi Password</label>
                <input type="password" class="form-control form-control-sm" name="konfirmasi_password" id="konfirmasi_password">
            </div>
            <div class="form-group mb-12">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="{{ $user->nama }}" required>
            </div>
            <div class="form-group mb-12">
                <label for="gender">Gender</label>
                <select class="form-control form-control-sm" name="gender">
                    <option value="Pria" {{ $user->gender == "Pria" ? 'selected' : '' }}>Pria</option>
                    <option value="Wanita" {{ $user->gender == "Wanita" ? 'selected' : '' }}>Wanita</option>
                </select>
            </div>

            <div class="form-group mb-12">
                <label for="status">Status</label>
                <select class="form-control form-control-sm" name="status">
                    <option value="1" {{ $user->status == true ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $user->status == false ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group mb-12">
                <label for="no_hp">No. HP</label>
                <input type="tel" class="form-control form-control-sm" name="no_hp" id="no_hp" value="{{ $user->no_hp }}">
            </div>
            <div class="form-group mb-12">
                <label for="no_telepon">No. Telp</label>
                <input type="tel" class="form-control form-control-sm" name="no_telepon" id="no_telepon" value="{{ $user->no_telepon }}">
            </div>
            <div class="form-group mb-12">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control form-control-sm" name="alamat" id="alamat" value="{{ $user->alamat }}">
            </div>

            <div class="form-group mb-12">
                <label for="no_induk">No. Induk Pegawai</label>
                <input type="tel" class="form-control form-control-sm" name="no_induk" id="no_induk" value="{{ $user->no_induk }}">
            </div>

            <div class="form-group mb-12">
                <label for="jabatan">Jabatan</label>
                <input type="tel" class="form-control form-control-sm" name="jabatan" id="jabatan" value="{{ $user->jabatan }}">
            </div>

            <div class="form-group mb-12">
                <label for="grup">Grup</label>
                <select class="form-control form-control-sm" name="grup">
                    @foreach ($grup as $item)
                        <option value="{{ $item->id }}" {{ $user->grup_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
    </form>
</section>

<hr class="modal-divider">

<section class="p-2 d-flex justify-content-end">
    <button class="btn btn-custom red px-3 ml-3">
        <i class="fas fa-times-circle mr-2"></i>
        Keluar
    </button>
    <button id="btn-save" class="btn btn-custom green px-3 ml-3">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>

<style>
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
                minlength: 6
            },
            konfirmasi_password: {
                minlength : 6,
                equalTo : "#password"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
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
</script>
