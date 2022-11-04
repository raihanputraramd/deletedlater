@extends('layouts.admin.app')

@section('header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Footer</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Footer</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card">
    <form id="form-validation" action="{{ route('back.cms.footer.store') }}" method="POST" enctype="multipart/form-data">
        <div class="card-body">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul_alamat">Judul Alamat</label>
                        <input type="text" value="{{ $footer !== null ? $footer->judul_alamat : '' }}" class="form-control" name="judul_alamat" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul_telepon">Judul Telepon</label>
                        <input type="text" value="{{ $footer !== null ? $footer->judul_telepon : '' }}" class="form-control" name="judul_telepon" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul_email">Judul Email</label>
                        <input type="text" value="{{ $footer !== null ? $footer->judul_email : '' }}" class="form-control" name="judul_email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="judul_marketplace">Judul Marketplace</label>
                        <input type="text" value="{{ $footer !== null ? $footer->judul_marketplace : '' }}" class="form-control" name="judul_marketplace" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jam_buka">Jam Buka</label>
                        <input type="text" value="{{ $footer !== null ? $footer->jam_buka : '' }}" class="form-control" name="jam_buka" required>
                    </div>
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telepon_1">Telepon 1</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->telepon_1 : '' }}" class="form-control" name="telepon_1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telepon_2">Telepon 2</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->telepon_2 : '' }}" class="form-control" name="telepon_2" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email_1">Email 1</label>
                        <input type="email" value="{{ $footer !== null ? $footer->email_1 : '' }}" class="form-control" name="email_1" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email_2">Email 2</label>
                        <input type="email" value="{{ $footer !== null ? $footer->email_2 : '' }}" class="form-control" name="email_2" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="4">{{ $footer !== null ? $footer->alamat : '' }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon_alamat">Icon alamat</label>
                        <input type="file" class="form-control p-1" name="icon_alamat">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->icon_alamat) : asset('front_assets/images/home/footer-ic-1.png') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon_telepon">Icon telepon</label>
                        <input type="file" class="form-control p-1" name="icon_telepon">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->icon_telepon) : asset('front_assets/images/home/footer-ic-2.png') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon_email">Icon email</label>
                        <input type="file" class="form-control p-1" name="icon_email">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->icon_email) : asset('front_assets/images/home/footer-ic-3.png') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon_marketplace">Icon marketplace</label>
                        <input type="file" class="form-control p-1" name="icon_marketplace">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->icon_marketplace) : asset('front_assets/images/home/footer-ic-4.png') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marketplace_1_nama">Nama marketplace 1</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->marketplace_1_nama : '' }}" class="form-control" name="marketplace_1_nama" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marketplace_1_link">Link marketplace 1</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->marketplace_1_link : '' }}" class="form-control" name="marketplace_1_link" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marketplace_2_nama">Nama marketplace 2</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->marketplace_2_nama : '' }}" class="form-control" name="marketplace_2_nama" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marketplace_2_link">Link marketplace 2</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->marketplace_2_link : '' }}" class="form-control" name="marketplace_2_link" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marketplace_3_nama">Nama marketplace 3</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->marketplace_3_nama : '' }}" class="form-control" name="marketplace_3_nama" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="marketplace_3_link">Link marketplace 3</label>
                        <input type="tel" value="{{ $footer !== null ? $footer->marketplace_3_link : '' }}" class="form-control" name="marketplace_3_link" required>
                    </div>
                </div>

                <div class="col-md-12">
                    <hr>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_1_link">Link Sosial Media 1</label>
                        <input type="text" value="{{ $footer !== null ? $footer->sosial_1_link : '' }}" class="form-control" name="sosial_1_link" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_1_gambar">Gambar Sosial Media 1</label>
                        <input type="file" class="form-control p-1" name="sosial_1_gambar">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->sosial_1_gambar) : asset('front_assets/images/home/footer-youtube.svg') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_2_link">Link Sosial Media 2</label>
                        <input type="text" value="{{ $footer !== null ? $footer->sosial_2_link : '' }}" class="form-control" name="sosial_2_link" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_2_gambar">Gambar Sosial Media 2</label>
                        <input type="file" class="form-control p-1" name="sosial_2_gambar">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->sosial_2_gambar) : asset('front_assets/images/home/footer-facebook.svg') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_3_link">Link Sosial Media 3</label>
                        <input type="text" value="{{ $footer !== null ? $footer->sosial_3_link : '' }}" class="form-control" name="sosial_3_link" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_3_gambar">Gambar Sosial Media 3</label>
                        <input type="file" class="form-control p-1" name="sosial_3_gambar">
                        <a class="mt-3 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->sosial_3_gambar) : asset('front_assets/images/home/footer-instagram.svg') }}" target="_blank">Preview Gambar</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_4_link">Link Sosial Media 4</label>
                        <input type="text" value="{{ $footer !== null ? $footer->sosial_4_link : '' }}" class="form-control" name="sosial_4_link" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sosial_4_gambar">Gambar Sosial Media 4</label>
                        <input type="file" class="form-control p-1" name="sosial_4_gambar">
                        <a class="mt-4 btn btn-sm btn-primary" href="{{ $footer !== null ? $footer->gambar($footer->sosial_4_gambar) : asset('front_assets/images/home/footer-instagram.svg') }}" target="_blank">Preview Gambar</a>
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
    jQuery.extend(jQuery.validator.messages, {
        required: "Field ini wajib diisi.",
    })

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'Ukuran maksimal 2 MB')

    $('#form-validation').validate({
        rules: {
            telepon: {
                required: true,
                maxlength: 17
            },
            deskripsi: {
                required: true,
                maxlength: 97
            },
            icon_alamat: {
                filesize: 2000000,
            },
            icon_telepon: {
                filesize: 2000000,
            },
            icon_email: {
                filesize: 2000000,
            },
            icon_marketplace: {
                filesize: 2000000,
            },
            sosial_1_gambar: {
                filesize: 2000000,
            },
            sosial_2_gambar: {
                filesize: 2000000,
            },
            sosial_3_gambar: {
                filesize: 2000000,
            },
            sosial_4_gambar: {
                filesize: 2000000,
            },
        },
        messages: {
            telepon: {
                maxlength: "Harap masukkan tidak lebih dari 17 karakter.",
            },
            deskripsi: {
                maxlength: "Harap masukkan tidak lebih dari 97 karakter.",
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
