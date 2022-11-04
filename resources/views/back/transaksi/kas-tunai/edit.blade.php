<section class="p-3">
    <form id="form-validation" action="{{ route('back.transaksi.kas-tunai.update', $kasTunai->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="transaksi">Transaksi</label>
            <select class="form-control form-control-sm" name="transaksi" id="transaksi">
                <option value="Kas Keluar" {{ ($kasTunai->transaksi) == "Kas Keluar" ? 'selected' :"" }}>Kas Keluar</option>
                <option value="Kas Masuk" {{ ($kasTunai->transaksi) == "Kas Masuk" ? 'selected' :"" }}>Kas Masuk</option>
            </select>
        </div>
        <div class="form-group mb-12">
            <label for="jumlah">Jumlah (Rp)</label>
            <input type="number" class="form-control form-control-sm" name="jumlah" value="{{ $kasTunai->amount() }}" required>
        </div>
        <div class="form-group">
            <label for="keterangan" class="mb-1">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="3">{{ $kasTunai->keterangan }}</textarea>
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
