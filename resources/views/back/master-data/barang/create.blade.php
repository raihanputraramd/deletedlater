@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Tambah Barang</h1>
</header>

<section class="container-fluid">
    <form id="form-validation" action="{{ route('back.master-data.barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="header3 color-black mb-20 font-weight-700">Informasi Barang</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-12">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <label for="nama">Nama Barang</label>
                                    <input type="text" class="form-control form-control-sm" name="nama" id="nama" required>
                                </div>

                                <div class="col-lg-4">
                                    <a class="btn-page" target="_blank" class="text-decoration-none" href="{{ route('back.master-data.barang.index') }}">
                                        <button type="button" class="btn btn-custom accent btn-block">
                                            <i class="fas fa-box mr-2"></i>Data Barang
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-12">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control form-control-sm" name="kode" id="kode" required>
                        </div>

                        <div class="form-group mb-12">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control form-control-sm" name="stok" id="stok" required>
                        </div>

                        <div class="form-group mb-12">
                            <label for="size">Ukuran / Size</label>
                            <input type="text" class="form-control form-control-sm" name="size" id="size">
                        </div>

                        <div class="form-group mb-12">
                            <label for="berat">Berat (gram)</label>
                            <input type="text" class="form-control form-control-sm" name="berat" id="berat">
                        </div>

                        <div class="form-group mb-12">
                            <label for="supplier">Supplier</label>
                            <select class="form-control form-control-sm" name="supplier" id="supplier"></select>
                        </div>

                        <div class="form-group mb09">
                            <label for="deskripsi">Deskripsi Barang</label>
                            <input type="text" class="form-control form-control-sm" name="deskripsi" id="deskripsi">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row mb-12">
                            <div class="col-lg-12">
                                <input name="gambar" id="gambar" type="file" onchange="document.getElementById('output-image').src = window.URL.createObjectURL(this.files[0])">
                                {{-- <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-file-image mr-2"></i>Upload Gambar
                                </button> --}}
                            </div>
                            {{-- <div class="col-lg-6">
                                <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-camera mr-2"></i>Tangkapan Layar
                                </button>
                            </div> --}}
                        </div>

                        <img
                            class="img-fluid preview-image mb-12"
                            width="496"
                            height="260"
                            src="{{ asset('back_assets/img/public/item-placeholder.jpg') }}"
                            alt="Image"
                            id="output-image">

                        <div class="row mb-12">
                            {{-- <div class="col-lg-4">
                                <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-times mr-2"></i>Hapus Gambar
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-print mr-2"></i>Print Label Rak
                                </button>
                            </div>
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-barcode mr-2"></i>Print Barcode
                                </button>
                            </div> --}}
                        </div>

                        {{-- <div class="row mb-12">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="skip">Skip</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="rangkap">Rangkap</label>
                                    <input type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="omset">Omset/bln</label>
                            <input type="number" class="form-control form-control-sm" name="omset" id="omset">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="header3 color-black mb-20 font-weight-700">Satuan</h2>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="satuan_1">Satuan</label>
                        <select class="form-control form-control-sm" name="satuan_1" id="satuan_1">
                            <option value="pcs">pcs</option>
                            <option value="lusin">lusin</option>
                            <option value="kodi">kodi</option>
                            <option value="pak">pak</option>
                            <option value="dus">dus</option>
                            <option value="box">box</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="satuan_2">Satuan 2</label>
                        <select class="form-control form-control-sm" name="satuan_2" id="satuan_2">
                            <option value="pcs">pcs</option>
                            <option value="lusin">lusin</option>
                            <option value="kodi">kodi</option>
                            <option value="pak">pak</option>
                            <option value="dus">dus</option>
                            <option value="box">box</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-1">
                        <label for="isi_satuan_2">Isi</label>
                        <input type="number" class="form-control form-control-sm" name="isi_satuan_2" id="isi_satuan_2">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="satuan_3">Satuan 3</label>
                        <select class="form-control form-control-sm" name="satuan_3" id="satuan_3">
                            <option value="pcs">pcs</option>
                            <option value="lusin">lusin</option>
                            <option value="kodi">kodi</option>
                            <option value="pak">pak</option>
                            <option value="dus">dus</option>
                            <option value="box">box</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-1">
                        <label for="isi_satuan_3">Isi</label>
                        <input type="number" class="form-control form-control-sm" name="isi_satuan_3" id="isi_satuan_3">
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="header3 color-black mb-20 font-weight-700">Harga Barang</h2>

                <div class="row">
                    <div class="form-group col-lg-6 mb-12">
                        <label for="harga_beli">Harga Beli (Rp)</label>
                        <input type="number" class="form-control form-control-sm" name="harga_beli" id="harga_beli" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="harga_jual">Harga Jual (Rp)</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual" id="harga_jual" required>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="harga_jual_1">Harga Grosir 1</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual_1" id="harga_jual_1">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="harga_jual_2">Harga Grosir 2</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual_2" id="harga_jual_2">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="harga_jual_3">Harga Grosir 3</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual_3" id="harga_jual_3">
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="header3 color-black mb-20 font-weight-700">Diskon Barang</h2>
                {{-- <div class="row mb-12">
                    <div class="form-group col-lg-3">
                        <label for="diskon_beli">Diskon Beli (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_beli" id="diskon_beli" max="100">
                    </div>
                </div> --}}

                <div class="row mb-12">
                    <div class="form-group col-lg-3">
                        <label for="diskon_jual">Diskon Jual (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_jual" id="diskon_jual" max="100">
                    </div>
                </div>

                <div class="row mb-12">
                    <div class="form-group col-lg-6">
                        <label for="diskon_amount_1">Diskon Amount (Rp)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_1" id="diskon_amount_1">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="diskon_amount_2">Diskon Amount 1</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_2" id="diskon_amount_2">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="diskon_amount_3">Diskon Amount 2</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_3" id="diskon_amount_3">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="diskon_amount_4">Diskon Amount 3</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_4" id="diskon_amount_4">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mb-20 mt-4">
                        <h2 class="header3 color-black font-weight-700 mb-0">Diskon Pembelian Dalam Jumlah Tertentu</h2>
                    </div>
                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_1">Diskon Pembelian (1)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_1" id="diskon_qty_1">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_1">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_1" id="diskon_qty_persen_1">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_2">Diskon Pembelian (2)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_2" id="diskon_qty_2">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_2">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_2" id="diskon_qty_persen_2">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_3">Diskon Pembelian (3)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_3" id="diskon_qty_3">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_3">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_3" id="diskon_qty_persen_3">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_4">Diskon Pembelian (4)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_4" id="diskon_qty_4">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_4">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_4" id="diskon_qty_persen_4">
                    </div>
                </div>
            </div>
        </div>

        <section class="d-flex justify-content-end mb-3">
            <a href="{{ route('back.home.index') }}">
                <button type="button" class="btn btn-custom red px-3 ml-3">
                    <i class="fas fa-times-circle mr-2"></i>
                    Keluar
                </button>
            </a>
            <button id="refresh" type="button" class="btn btn-custom blue px-3 ml-3">
                <i class="fas fa-redo mr-2"></i>
                Kosongkan
            </button>
            <button type="submit" class="btn btn-custom green px-3 ml-3">
                <i class="fas fa-save mr-2"></i>
                Simpan
            </button>
        </section>

    </form>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/master-data/barang/create.css') }}">
@endpush

@push('js')
<script>
    $('#form-validation').validate({
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

    $('body').on('click', '#refresh', function() {
        $('input').val('');
        $('select').val('');
    })

    $('body').on('keyup mouseup', '#diskon_jual', function () {
        let hargaJual = $('#harga_jual').val() != "" ? $('#harga_jual').val() : 0
        let hargaGrosir1 = $('#harga_jual_1').val() != "" ? $('#harga_jual_1').val() : 0
        let hargaGrosir2 = $('#harga_jual_2').val() != "" ? $('#harga_jual_2').val() : 0
        let hargaGrosir3 = $('#harga_jual_3').val() != "" ? $('#harga_jual_3').val() : 0
        let diskon = $(this).val()

        $('#diskon_amount_1').val(hitungDiskon(parseInt(hargaJual), parseInt(diskon)))
        $('#diskon_amount_2').val(hitungDiskon(parseInt(hargaGrosir1), parseInt(diskon)))
        $('#diskon_amount_3').val(hitungDiskon(parseInt(hargaGrosir2), parseInt(diskon)))
        $('#diskon_amount_4').val(hitungDiskon(parseInt(hargaGrosir3), parseInt(diskon)))
    })

    $('body').on('keyup mouseup', '.harga-jual-input', function () {
        let hargaJual = $('#harga_jual').val() != "" ? $('#harga_jual').val() : 0
        let hargaGrosir1 = $('#harga_jual_1').val() != "" ? $('#harga_jual_1').val() : 0
        let hargaGrosir2 = $('#harga_jual_2').val() != "" ? $('#harga_jual_2').val() : 0
        let hargaGrosir3 = $('#harga_jual_3').val() != "" ? $('#harga_jual_3').val() : 0
        let diskon = $('#diskon_jual').val()

        $('#diskon_amount_1').val(hitungDiskon(parseInt(hargaJual), parseInt(diskon)))
        $('#diskon_amount_2').val(hitungDiskon(parseInt(hargaGrosir1), parseInt(diskon)))
        $('#diskon_amount_3').val(hitungDiskon(parseInt(hargaGrosir2), parseInt(diskon)))
        $('#diskon_amount_4').val(hitungDiskon(parseInt(hargaGrosir3), parseInt(diskon)))
    })

    $(function () {
        $("#supplier").select2({
            ajax: {
                url: "{{ route('back.master-data.barang.supplier') }}",
                type: "post",
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    return {
                        query: params.term,
                        "_token": "{{ csrf_token() }}",
                    }
                },
                processResults: function(response) {
                    return {
                        results: response
                    }
                },
                cache: true
            }
        })
    })

    function hitungDiskon(harga, persen) {
        let result = harga * (persen / 100);

        if(result > 1) {
            return result
        }
    }
</script>
@endpush
