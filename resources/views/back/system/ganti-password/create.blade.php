<section class="p-3">
    <form id="form-validation" action="{{ route('back.system.ganti-password.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-12">
            <label for="">Password Lama</label>
            <input type="password" class="form-control form-control-sm" name="password_lama">
        </div>

        <div class="form-group mb-12">
            <label for="">Password Baru</label>
            <input type="password" class="form-control form-control-sm" name="password" id="password">
        </div>

        <div class="form-group">
            <label for="">Konfimasi Password Baru</label>
            <input type="password" class="form-control form-control-sm" name="password_konfirmasi">
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
        rules: {
            password_lama: {
                required: true,
                remote: {
                    url: '{{ route("api.password.check") }}',
                    type: "post",
                    data: {
                        _token: function() {
                            return "{{ csrf_token() }}"
                        }
                    },
                }
            },
            password: {
                required: true,
                minlength: 6
            },
            password_konfirmasi: {
                required: true,
                minlength : 6,
                equalTo : "#password"
            }
        },
        messages: {
            password_lama: {
                remote: "Password lama tidak valid!",
            },
            password: {
                minlength: "Harap masukkan setidaknya 6 karakter",
            },
            password_konfirmasi: {
                minlength: "Harap masukkan setidaknya 6 karakter",
                equalTo: "Harap masukkan nilai yang sama lagi",
            },
        },
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

    $('body').on('click', '#refresh', function() {
        $('input').val('')
    })
</script>
