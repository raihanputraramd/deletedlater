@extends('layouts.admin.app')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Alasan Membeli</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Alasan Membeli</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <form id="form-validation" action="{{ route('back.cms.alasan-membeli.store') }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->judul : '' }}" class="form-control" name="judul" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->deskripsi : '' }}" class="form-control" name="deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_1_judul">Judul Alasan 1</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_1_judul : '' }}" class="form-control" name="alasan_1_judul" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_1_deskripsi">Deskripsi Alasan 1</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_1_deskripsi : '' }}" class="form-control" name="alasan_1_deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_2_judul">Judul Alasan 2</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_2_judul : '' }}" class="form-control" name="alasan_2_judul" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_2_deskripsi">Deskripsi Alasan 2</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_2_deskripsi : '' }}" class="form-control" name="alasan_2_deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_3_judul">Judul Alasan 3</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_3_judul : '' }}" class="form-control" name="alasan_3_judul" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_3_deskripsi">Deskripsi Alasan 3</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_3_deskripsi : '' }}" class="form-control" name="alasan_3_deskripsi" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_4_judul">Judul Alasan 4</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_4_judul : '' }}" class="form-control" name="alasan_4_judul" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alasan_4_deskripsi">Deskripsi Alasan 4</label>
                        <input type="text" value="{{ $alasanMembeli !== null ? $alasanMembeli->alasan_4_deskripsi : '' }}" class="form-control" name="alasan_4_deskripsi" required>
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
    $('#form-validation').validate({
        rules: {
            judul: {
                required: true,
            },
            alasan_1_deskripsi: {
                required: true,
                maxlength: 121
            },
            alasan_2_deskripsi: {
                required: true,
                maxlength: 121
            },
            alasan_3_deskripsi: {
                required: true,
                maxlength: 121
            },
        },
        messages: {
            judul: {
                required: "Field wajib diisi!",
            },
            alasan_1_deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 121 karakter.",
            },
            alasan_2_deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 121 karakter.",
            },
            alasan_3_deskripsi: {
                required: "Field wajib diisi!",
                maxlength: "Harap masukkan tidak lebih dari 121 karakter.",
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
