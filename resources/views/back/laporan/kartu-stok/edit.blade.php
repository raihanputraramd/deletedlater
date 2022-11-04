<section class="p-3">
    <form id="form-validation" action="{{ route('back.laporan.kartu-stok.update', $kartuStok->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control form-control-sm" name="tanggal" id="tanggal" value="{{ $kartuStok->tanggal }}" required>
        </div>
        <div class="form-group mb-12">
            <label for="masuk">Masuk</label>
            <input type="number" class="form-control form-control-sm" name="masuk" id="masuk" value={{ $kartuStok->masuk }} required>
        </div>
        <div class="form-group mb-12">
            <label for="keluar">Keluar</label>
            <input type="number" class="form-control form-control-sm" name="keluar" id="keluar" value={{ $kartuStok->keluar }} required>
        </div>
        <div class="form-group mb-12">
            <label for="sisa">Sisa</label>
            <input type="number" class="form-control form-control-sm" name="sisa" id="sisa" value={{ $kartuStok->sisa }} required>
        </div>
        <div class="form-group mb-12">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" rows="3" class="form-control form-control-sm">{{ $kartuStok->keterangan }}</textarea>
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
    <button class="btn btn-custom green px-3 ml-3" id="btn-save">
        <i class="fas fa-save mr-2"></i>
        Simpan
    </button>
</section>
