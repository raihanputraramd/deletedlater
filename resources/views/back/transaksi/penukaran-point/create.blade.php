<section class="p-3">
    <form id="form-validation" class="row justify-content-center" action="{{ route('back.transaksi.penukaran-point.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12 mb-20">
            <h3 class="header3 color-primary font-weight-bold">Data Pelanggan</h3>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="nama">Nama</label>
                <select class="form-control form-control-sm select2Custom br12px" name="pelanggan" id="pelanggan-nama" required></select>
            </div>
        </div>
        <div class="col-md-4 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal">Poin</label>
                <select class="form-control form-control-sm select2Custom br12px" id="pelanggan-point" required></select>
            </div>
        </div>
        <div class="col-md-8 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal">&nbsp;</label>
                <input type="text" class="form-control form-control-sm br12px" id="point" readonly>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <hr>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal">Kode</label>
                <select class="form-control form-control-sm select2Custom br12px" id="pelanggan-kode" required></select>
            </div>
        </div>
        <div class="col-md-12 mb-12">
            <div class="form-group">
                <label class="body1 color-black font-weight-normal" for="point">Poin Ditukar</label>
                <input type="number" class="form-control form-control-sm br12px" name="point" id="form-point" required>
            </div>
        </div>
        <div class="col-md-12 mb-3">
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
                    options += '<option value="'+ this.id +'">'+ this.nama +'</option>'
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
                    options += '<option value="'+ this.id +'">'+ this.kode +'</option>'
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
                    options += '<option value="'+ this.id +'">'+ this.point +'</option>'
                })
                $('body').find('#pelanggan-point').html(options)
            }
        })
    }

    $('body').on('click', '#refresh', function() {
        $('input').val('')
        $('textarea').val('')
    })
</script>
