<section class="p-3">
    <form id="form-validation" action="{{ route('back.transaksi.bayar-piutang.update', $piutang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="transaksi">No Faktur</label>
            <input class="form-control form-control-sm" type="text" value="{{ $piutang->penjualan != null ? $piutang->penjualan->no_faktur : '' }}" readonly>
        </div>
        <div class="form-group mb-12">
            <label for="transaksi">Pelanggan</label>
            <input class="form-control form-control-sm" type="text" value="{{ $piutang->pelanggan != null ? $piutang->pelanggan->nama : '' }}" readonly>
        </div>
        <div class="form-group mb-12">
            <label for="status_lunas">Status Lunas</label>
            <select class="form-control form-control-sm" name="status_lunas" id="status_lunas">
                <option value="Belum Lunas">Belum Lunas</option>
                <option value="Bank">Bank</option>
                <option value="Cash">Cash</option>
            </select>
        </div>
        <div class="form-group mb-12">
            <label for="nominal">Jumlah Piutang</label>
            <input class="form-control form-control-sm" type="number" name="nominal" value="{{ $piutang->nominal }}">
        </div>
        <div class="form-group mb-12">
            <label for="tanggal_lunas">Tanggal Lunas</label>
            <input class="form-control form-control-sm" type="date" name="tanggal_lunas" id="tanggal_lunas">
        </div>
        <div class="form-group mb-12">
            <label for="jatuh_tempo">Jatuh Tempo</label>
            <input class="form-control form-control-sm" type="date" name="jatuh_tempo" value="{{ Carbon\Carbon::parse($piutang->jatuh_tempo)->format('Y-m-d') }}">
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

    $('#status_lunas').val("{{ $piutang->status_lunas }}")

    $('#status_lunas').on('change', function () {
        let val = $(this).val()

        if (val != 'Belum Lunas') {
            $('#tanggal_lunas').val("{{ Carbon\Carbon::now()->format('Y-m-d') }}")
        } else {
            $('#tanggal_lunas').val('')
        }
    })
</script>
