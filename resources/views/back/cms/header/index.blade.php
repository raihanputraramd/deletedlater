@extends('layouts.admin.app')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Header</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Header</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <form id="form-validation" action="{{ route('back.cms.header.store') }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" value="{{ $header !== null ? $header->judul : '' }}" class="form-control" name="judul" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" cols="30" rows="2" required>{{ $header !== null ? $header->deskripsi : '' }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control p-1" name="logo">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $header !== null ? $header->gambar($header->logo) : asset('back_assets/dist/img/cms/header/logo.jpg') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gambar">Gambar Header</label>
                        <input type="file" class="form-control p-1" name="gambar">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $header !== null ? $header->gambar($header->gambar) : asset('back_assets/dist/img/cms/header/header-img.jpg') }}" target="_blank">Preview Gambar</a>
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
                maxlength: 19
            },
            deskripsi: {
                required: true,
                maxlength: 174
            },
            logo: {
                filesize: 2000000,
            },
            gambar: {
                filesize: 2000000,
            }
        },
        messages: {
            judul: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 19 karakter.",
            },
            deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 174 karakter.",
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
