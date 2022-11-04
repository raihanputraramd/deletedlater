<section class="p-3">
    <form id="form-validation" action="{{ route('back.system.hak-akses-modul.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-12">
            <label for="grup">Grup</label>
            <select name="grup" id="grup" class="form-control form-control-sm select2">
                @forelse ($grup as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @empty
                    <option selected>Belum ada grup yang ditambahkan</option>
                @endforelse
            </select>
        </div>
        <div class="form-group mb-12">
            <label for="modul">Modul</label>
            <select name="modul[]" id="modul" class="form-control form-control-sm select2-multiple" multiple>
                @foreach ($modul as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <span class="body2 color-black mt-2 d-block">Pilih modul yang diinginkan</span>
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

    $('#modul').select2();
</script>
