@extends('layouts.admin.app')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Keunggulan Produk</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Keunggulan Produk</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <form id="form-validation" action="{{ route('back.cms.keunggulan-produk.store') }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul">Judul Section</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->judul : '' }}" class="form-control" name="judul" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keunggulan_1_judul">Judul Keunggulan 1</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->keunggulan_1_judul : '' }}" class="form-control" name="keunggulan_1_judul" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keunggulan_1_deskripsi">Deskripsi Keunggulan 1</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->keunggulan_1_deskripsi : '' }}" class="form-control" name="keunggulan_1_deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keunggulan_2_judul">Judul Keunggulan 2</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->keunggulan_2_judul : '' }}" class="form-control" name="keunggulan_2_judul" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keunggulan_2_deskripsi">Deskripsi Keunggulan 2</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->keunggulan_2_deskripsi : '' }}" class="form-control" name="keunggulan_2_deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keunggulan_3_judul">Judul Keunggulan 3</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->keunggulan_3_judul : '' }}" class="form-control" name="keunggulan_3_judul" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="keunggulan_3_deskripsi">Deskripsi Keunggulan 3</label>
                        <input type="text" value="{{ $keunggulan !== null ? $keunggulan->keunggulan_3_deskripsi : '' }}" class="form-control" name="keunggulan_3_deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gambar">Gambar Keunggulan Produk</label>
                        <input type="file" class="form-control p-1" name="gambar">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $keunggulan !== null ? $keunggulan->gambar($keunggulan->gambar) : asset('back_assets/dist/img/cms/keunggulan-produk/keunggulan-produk.jpg') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success float-right">Simpan</button>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'Ukuran maksimal 2 MB')

    $('#form-validation').validate({
        rules: {
            judul: {
                required: true,
            },
            keunggulan_1_deskripsi: {
                required: true,
                maxlength: 213
            },
            keunggulan_2_deskripsi: {
                required: true,
                maxlength: 213
            },
            keunggulan_3_deskripsi: {
                required: true,
                maxlength: 213
            },
            gambar: {
                filesize: 2000000,
            },
        },
        messages: {
            judul: {
                required: "Field wajib diisi!",
            },
            keunggulan_1_deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 213 karakter.",
            },
            keunggulan_2_deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 213 karakter.",
            },
            keunggulan_3_deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 213 karakter.",
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
</script>
@endpush
