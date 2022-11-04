<section class="p-3">
    <form id="form-validation" action="{{ route('back.transaksi.bank-transfer.update', $bankTransfer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="transaksi">Transaksi</label>
            <select class="form-control form-control-sm" name="transaksi" id="transaksi">
                <option value="Keluar" {{ ($bankTransfer->transaksi) == "Keluar" ? "selected" : ""  }}>Keluar</option>
                <option value="Masuk" {{ ($bankTransfer->transaksi) == "Masuk" ? "selected" : "" }}>Masuk</option>
            </select>
        </div>
        <div class="form-group mb-12">
            <label for="jumlah">Jumlah (Rp)</label>
            <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah" value="{{ $bankTransfer->amount() }}">
        </div>
        <div class="form-group">
            <label for="keterangan" class="mb-1">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $bankTransfer->keterangan }}</textarea>
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
