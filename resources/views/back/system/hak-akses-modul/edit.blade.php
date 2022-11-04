<section class="p-3">
    <form id="form-validation" action="{{ route('back.system.hak-akses-modul.update', $grup->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group mb-12">
            <label for="grup">Grup</label>
            <input type="text" class="form-control" value="{{ $grup->nama }}" readonly>
        </div>
        <div class="form-group mb-12">
            <label for="">Modul</label>
            <select name="modul[]" id="modul" class="form-control form-control-sm select2" multiple>
                @foreach ($modul as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
    <button class="btn btn-custom blue px-3 ml-3">
        <i class="fas fa-redo mr-2"></i>
        Kosongkan
    </button>
    <button class="btn btn-custom green px-3 ml-3" id="btn-save">
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

    $(function () {
        $('#modul').select2();

        let moduls = {!! $grup->modul !!}
        let modulArr = []
        moduls.forEach(function(modul){
            modulArr.push(modul.id)
        });
        selectKategori(modulArr)
    })

    function selectKategori(kategori) {
        $('#modul').val(kategori).trigger('change');
    }
</script>
