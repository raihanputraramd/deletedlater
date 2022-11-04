<section class="p-3">
    <form id="form-validation" action="{{ route('back.transaksi.penukaran-point.update', $penukaranPoint->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="nama">Nama</label>
            <select class="form-control form-control-sm select2Custom " name="pelanggan" id="pelanggan-nama" required></select>
        </div>

        <div class="form-group mb-12">
            <label for="pelanggan-point">Poin</label>
            <select class="form-control form-control-sm select2Custom " id="pelanggan-point" required></select>
        </div>

        <div class="form-group mb-12">
            <label for="point">&nbsp;</label>
            <input type="text" class="form-control form-control-sm " id="point" readonly>
        </div>

        <hr class="mb-12">

        <div class="form-group mb-12">
            <label for="pelanggan-kode">Kode</label>
            <select class="form-control form-control-sm select2Custom " id="pelanggan-kode" required></select>
        </div>

        <div class="form-group mb-12">
            <label for="point">Poin Ditukar</label>
            <input type="number" class="form-control form-control-sm " name="point" id="form-point" value="{{ $penukaranPoint->point }}" required>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control form-control-sm " name="keterangan" id="keterangan" rows="4">{{ $penukaranPoint->keterangan }}</textarea>
        </div>
    </form>
</section>

<hr class="modal-divider">

<section class="p-2 d-flex justify-content-end">
    <button class="btn btn-custom red px-3 ml-3">
        <i class="fas fa-times-circle mr-2"></i>
        Keluar
    </button>
    <button class="btn btn-custom blue px-3 ml-3">
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
</style>

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

    $(function() {
        $('.select2Custom').select2({
            placeholder: $(this).data('placeholder') !== null ? $(this).data('placeholder') : '',
            dropdownParent: $("#modalPage")
        })
    })

    $('#pelanggan-nama').on('change', function () {
        let id = $(this).val()
        $('body').find('#pelanggan-kode').val(id).trigger('change.select2')
        $('body').find('#pelanggan-point').val(id).trigger('change.select2')
    })

    $('#pelanggan-kode').on('change', function () {
        let id = $(this).val()
        $('body').find('#pelanggan-nama').val(id).trigger('change.select2')
        $('body').find('#pelanggan-point').val(id).trigger('change.select2')
    })

    $('#pelanggan-point').on('change', function () {
        let id = $(this).val()
        $('body').find('#pelanggan-nama').val(id).trigger('change.select2')
        $('body').find('#pelanggan-kode').val(id).trigger('change.select2')
    })

    $('#form-point').on('keyup keydown', function () {
        let val = $(this).val()
        let point = $("#pelanggan-point option:selected").text()
        let result = parseInt(point) - parseInt(val)

        $('#point').val('- ' + val + ' = ' +  result)
    })

    getClient()
    function getClient() {
        $.ajax({
            url: "{{ route('api.master-data.pelanggan') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    if(this.id == "{{ $penukaranPoint->pelanggan_id }}") {
                        options += '<option value="'+ this.id +'" selected>'+ this.nama +'</option>'
                    } else {
                        options += '<option value="'+ this.id +'">'+ this.nama +'</option>'
                    }
                })
                $('body').find('#pelanggan-nama').html(options)
            }
        })

        $.ajax({
            url: "{{ route('api.master-data.pelanggan') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    if(this.id == "{{ $penukaranPoint->pelanggan_id }}") {
                        options += '<option value="'+ this.id +'" selected>'+ this.kode +'</option>'
                    } else {
                        options += '<option value="'+ this.id +'">'+ this.kode +'</option>'
                    }
                })
                $('body').find('#pelanggan-kode').html(options)
            }
        })

        $.ajax({
            url: "{{ route('api.master-data.pelanggan') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    if(this.id == "{{ $penukaranPoint->pelanggan_id }}") {
                        options += '<option value="'+ this.id +'" selected>'+ this.point +'</option>'
                    } else {
                        options += '<option value="'+ this.id +'">'+ this.point +'</option>'
                    }
                })
                $('body').find('#pelanggan-point').html(options)
            }
        })
    }
</script>
