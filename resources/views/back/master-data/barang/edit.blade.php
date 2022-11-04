{{-- <form id="form-validation" class="row" action="{{ route('back.master-data.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="nama">Nama Barang</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="{{ $barang->nama }}" required>
                            <div class="input-group-append">
                                <a href="#!" class="btn btn-success btn-sm" target="_blank">Data Barang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="kode">Kode Barang</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm w-25" name="kode" id="kode" value="{{ $barang->kode }}" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="stok">Stok</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control form-control-sm w-25" name="stok" id="stok" value="{{ $barang->barangStok->stok }}" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="satuan_1">Satuan</label>
                    <div class="col">
                        <select class="form-control form-control-sm" name="satuan_1" id="satuan_1">
                            <option value="pcs">pcs</option>
                            <option value="lusin">lusin</option>
                            <option value="kodi">kodi</option>
                            <option value="pak">pak</option>
                            <option value="dus">dus</option>
                            <option value="box">box</option>
                        </select>
                    </div>
                    <label class="text-right col" for="satuan_2">Satuan 2</label>
                    <div class="col">
                        <select class="form-control form-control-sm" name="satuan_2" id="satuan_2">
                            <option value=""></option>
                            <option value="pcs">pcs</option>
                            <option value="lusin">lusin</option>
                            <option value="kodi">kodi</option>
                            <option value="pak">pak</option>
                            <option value="dus">dus</option>
                            <option value="box">box</option>
                        </select>
                    </div>
                    <label class="text-right col" for="isi_satuan_2">Isi</label>
                    <div class="col">
                        <input type="number" class="form-control form-control-sm" name="isi_satuan_2" id="isi_satuan_2" value="{{ $barang->barangStok->isi_satuan_2 }}">
                    </div>
                    <label class="text-right col" for="satuan_3">Satuan 3</label>
                    <div class="col">
                        <select class="form-control form-control-sm" name="satuan_3" id="satuan_3">
                            <option value=""></option>
                            <option value="pcs">pcs</option>
                            <option value="lusin">lusin</option>
                            <option value="kodi">kodi</option>
                            <option value="pak">pak</option>
                            <option value="dus">dus</option>
                            <option value="box">box</option>
                        </select>
                    </div>
                    <label class="text-right col" for="isi_satuan_3">Isi</label>
                    <div class="col">
                        <input type="number" class="form-control form-control-sm" name="isi_satuan_3" id="isi_satuan_3" value="{{ $barang->barangStok->isi_satuan_3 }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="size">Ukuran / Size</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm w-50" name="size" id="size" value="{{ $barang->size }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="berat">Berat (gram)</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm w-25" name="berat" id="berat" value="{{ $barang->berat }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="omset">Omset / bln</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control form-control-sm w-25" name="omset" id="omset" value="{{ $barang->omset }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="deskripsi">Deskripsi Barang</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="deskripsi" id="deskripsi" value="{{ $barang->deskripsi }}">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="harga_beli">Harga Beli (Rp)</label>
                    <div class="col-md-10">
                        <input type="number" class="form-control form-control-sm w-50" name="harga_beli" id="harga_beli" value="{{ $barang->harga_beli }}" required>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="diskon_beli">Diskon Beli</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <input type="number" class="form-control form-control-sm w-25" name="diskon_beli" id="diskon_beli" value="{{ $barang->diskon_beli }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="text-right col-md-2" for="supplier">Supplier</label>
                    <div class="col-md-10">
                        <select class="form-control form-control-sm" name="supplier" id="supplier">
                            @if ($barang->supplier_id !== null)
                                <option value="{{ $barang->supplier_id }}">{{ $barang->supplier->nama }}</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <input type="file" class="form-control form-control-file" name="gambar">
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group row col-md-3">
                <label class="text-right col" for="harga_jual">Harga Jual (Rp)</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="harga_jual" id="harga_jual" value="{{ $barang->barangHarga->harga_jual }}" required>
                </div>
            </div>
            <div class="form-group row col-md-3">
                <label class="text-right col" for="harga_jual_1">Harga Grosir 1</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="harga_jual_1" id="harga_jual_1" value="{{ $barang->barangHarga->harga_jual_1 }}">
                </div>
            </div>
            <div class="form-group row col-md-3">
                <label class="text-right col" for="harga_jual_2">Harga Grosir 2</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="harga_jual_2" id="harga_jual_2" value="{{ $barang->barangHarga->harga_jual_2 }}">
                </div>
            </div>
            <div class="form-group row col-md-3">
                <label class="text-right col" for="harga_jual_3">Harga Grosir 3</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="harga_jual_3" id="harga_jual_3" value="{{ $barang->barangHarga->harga_jual_3 }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="form-group row col-md-2">
                <label class="text-right col ml-0 pl-0" for="diskon_jual">Diskon Jual</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_jual" id="diskon_jual" value="{{ $barang->barangDiskon->diskon_jual }}">
                </div>
            </div>
            <div class="form-group row col">
                <label class="text-right col mr-0 pr-0" for="diskon_qty_1">Qty 1</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_qty_1" id="diskon_qty_1" value="{{ $barang->barangDiskon->diskon_qty_1 }}">
                </div>
                <label class="text-right col mr-0 pr-0" for="diskon_amount_1">Diskon</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_amount_1" id="diskon_amount_1" value="{{ $barang->barangDiskon->diskon_amount_1 }}">
                </div>
            </div>
            <div class="form-group row col">
                <label class="text-right col mr-0 pr-0" for="diskon_qty_2">Qty 2</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_qty_2" id="diskon_qty_2" value="{{ $barang->barangDiskon->diskon_qty_2 }}">
                </div>
                <label class="text-right col mr-0 pr-0" for="diskon_amount_2">Diskon</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_amount_2" id="diskon_amount_2" value="{{ $barang->barangDiskon->diskon_amount_2 }}">
                </div>
            </div>
            <div class="form-group row col">
                <label class="text-right col mr-0 pr-0" for="diskon_qty_3">Qty 3</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_qty_3" id="diskon_qty_3" value="{{ $barang->barangDiskon->diskon_qty_3 }}">
                </div>
                <label class="text-right col mr-0 pr-0" for="diskon_amount_3">Diskon</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_amount_3" id="diskon_amount_3" value="{{ $barang->barangDiskon->diskon_amount_3 }}">
                </div>
            </div>
            <div class="form-group row col">
                <label class="text-right col mr-0 pr-0" for="diskon_qty_4">Qty 4</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_qty_4" id="diskon_qty_4" value="{{ $barang->barangDiskon->diskon_qty_4 }}">
                </div>
                <label class="text-right col mr-0 pr-0" for="diskon_amount_4">Diskon</label>
                <div class="col">
                    <input type="number" class="form-control form-control-sm" name="diskon_amount_4" id="diskon_amount_4" value="{{ $barang->barangDiskon->diskon_amount_4 }}">
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $('#form-validation').validate({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            element.closest('.col-md-10').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
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

    $('#satuan_1').val("{{ $barang->barangStok->satuan_1 }}")
    $('#satuan_2').val("{{ $barang->barangStok->satuan_2 }}")
    $('#satuan_3').val("{{ $barang->barangStok->satuan_3 }}")
</script> --}}

{{-- @extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Edit Barang</h1>
</header>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="table-container mb-12">
                <table class="table table-striped my-0" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Satuan 2</th>
                            <th>Isi Satuan 2</th>
                            <th>Satuan 3</th>
                            <th>Isi Satuan 3</th>
                            <th>Supplier</th>
                            <th>Harga Beli</th>
                            <th>Diskon Beli</th>
                            <th>Harga Jual</th>
                            <th>Harga Jual 1</th>
                            <th>Harga Jual 2</th>
                            <th>Harga Jual 3</th>
                            <th>Diskon Jual</th>
                            <th>Diskon Qty1</th>
                            <th>Diskon Amount1</th>
                            <th>Diskon Qty2</th>
                            <th>Diskon Amount2</th>
                            <th>Diskon Qty3</th>
                            <th>Diskon Amount3</th>
                            <th>Diskon Qty4</th>
                            <th>Diskon Amount4</th>
                            <th>Berat</th>
                            <th>Omset</th>
                            <th>Size</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>No.</td>
                        <td>Kode</td>
                        <td>Nama</td>
                        <td>Stok</td>
                        <td>Satuan</td>
                        <td>Satuan 2</td>
                        <td>Isi Satuan 2</td>
                        <td>Satuan 3</td>
                        <td>Isi Satuan 3</td>
                        <td>Supplier</td>
                        <td>Harga Beli</td>
                        <td>Diskon Beli</td>
                        <td>Harga Jual</td>
                        <td>Harga Jual 1</td>
                        <td>Harga Jual 2</td>
                        <td>Harga Jual 3</td>
                        <td>Diskon Jual</td>
                        <td>Diskon Qty1</td>
                        <td>Diskon Amount1</td>
                        <td>Diskon Qty2</td>
                        <td>Diskon Amount2</td>
                        <td>Diskon Qty3</td>
                        <td>Diskon Amount3</td>
                        <td>Diskon Qty4</td>
                        <td>Diskon Amount4</td>
                        <td>Berat</td>
                        <td>Omset</td>
                        <td>Size</td>
                        <td>Deskripsi</td>
                        <td>Aksi</td>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="row mb-12">
                <div class="col-lg-8">
                    <button class="btn btn-custom accent btn-block">
                        <i class="fas fa-file-image mr-2"></i>Upload Gambar
                    </button>
                </div>

                <div class="col-lg-4">
                    <button class="btn btn-custom accent btn-block">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
            </div>
            <img class="footer-image-preview mb-12" src="{{ asset('back_assets/img/public/item-placeholder.jpg') }}" alt="" height="200" width="342">

            <button class="btn btn-custom accent btn-block mb-12">
                <i class="fas fa-times mr-2"></i>Hapus Gambar
            </button>

            <button class="btn btn-custom accent btn-block mb-12">
                <i class="fas fa-times mr-2"></i>Print Label Rak
            </button>

            <button class="btn btn-custom accent btn-block mb-12">
                <i class="fas fa-barcode mr-2"></i>Print Barcode
            </button>

            <div class="row mb-12">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Skip</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-group">
                        <label for="">Rangkap</label>
                        <input type="text" class="form-control form-control-sm">
                    </div>
                </div>
            </div>

            <div class="form-group mb-12">
                <label for="">Item</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group mb-12">
                <label for="">Stok</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group mb-12">
                <label for="">Modal Rp.</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group mb-12">
                <label for="">Aset Rp.</label>
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <hr class="divider">
            <div class="d-flex justify-content-between">
                <div class="footer-barang-search-container">
                    <div class="form-group footer-barang-input">
                        <input type="text" class="form-control form-control-sm" placeholder="Barang">
                    </div>
                    <div class="form-group mx-3">
                        <input type="text" class="form-control form-control-sm" placeholder="Kode">
                    </div>
                    <button class="btn btn-custom blue px-3 d-block"><i class="fas fa-search mr-2"></i> Barang</button>
                </div>
                <div>
                    <button class="btn btn-custom red px-3 ml-3">
                        <i class="fas fa-times-circle mr-2"></i>
                        Keluar
                    </button>
                    <button class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-file-excel mr-2"></i>
                        File Excel
                    </button>
                    <button class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-print mr-2"></i>
                        Print
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/master-data/barang/edit.css') }}">
@endpush

@push('js')
<script>
    var table;
    table = $('#table').DataTable({
        "responsive": false,
        "pagingType": "simple_numbers",
        "paging": false,
        "autoWidth": false,
        "scrollY": "645px",
        "scrollX": true,
        'pageLength': 10,
        "lengthMenu": [10, 25, 50, 100],
        "order": [['4', 'desc']],
        "processing": true,
        "bInfo" : false,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        // "serverSide": true,
        "searching": false,
    });
</script>
@endpush --}}

@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Edit Barang</h1>
</header>

<section class="container-fluid">
    <form id="form-validation" action="{{ route('back.master-data.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="header3 color-black mb-20 font-weight-700">Informasi Barang</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-12">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <label for="nama">Nama Barang</label>
                                    <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="{{ $barang->nama }}" required>
                                </div>

                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-custom accent btn-block">
                                        <i class="fas fa-box mr-2"></i>Data Barang
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-12">
                            <label for="kode">Kode Barang</label>
                            <input type="text" class="form-control form-control-sm" name="kode" id="kode" value="{{ $barang->kode }}" required>
                        </div>

                        <div class="form-group mb-12">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control form-control-sm" name="stok" id="stok" value="{{ $barang->barangStok->stok }}" required>
                        </div>

                        <div class="form-group mb-12">
                            <label for="size">Ukuran / Size</label>
                            <input type="text" class="form-control form-control-sm" name="size" id="size" value="{{ $barang->size }}">
                        </div>

                        <div class="form-group mb-12">
                            <label for="berat">Berat (gram)</label>
                            <input type="text" class="form-control form-control-sm" name="berat" id="berat" value="{{ $barang->berat }}">
                        </div>

                        <div class="form-group mb-12">
                            <label for="supplier">Supplier</label>
                            <select class="form-control form-control-sm" name="supplier" id="supplier">
                                @if ($barang->supplier_id !== null)
                                    <option value="{{ $barang->supplier_id }}">{{ $barang->supplier->nama }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group mb09">
                            <label for="deskripsi">Deskripsi Barang</label>
                            <input type="text" class="form-control form-control-sm" name="deskripsi" id="deskripsi" value="{{ $barang->deskrpsi }}">
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
                            src="{{ $barang->gambar() }}"
                            alt="Image"
                            id="output-image">

                        <div class="row mb-12">
                            <div class="col-lg-4">
                                <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-times mr-2"></i>Hapus Gambar
                                </button>
                            </div>
                            {{-- <div class="col-lg-4">
                                <button type="button" class="btn btn-custom accent btn-block">
                                    <i class="fas fa-print mr-2"></i>Print Label Rak
                                </button>
                            </div> --}}
                            {{-- <div class="col-lg-4">
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
                            <input type="number" class="form-control form-control-sm" name="omset" id="omset" value="{{ $barang->omset }}">
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
                            <option value="pcs" {{ $barang->barangStok->satuan_1 == "pcs" ? 'selected' : '' }}>pcs</option>
                            <option value="lusin" {{ $barang->barangStok->satuan_1 == "lusin" ? 'selected' : '' }}>lusin</option>
                            <option value="kodi" {{ $barang->barangStok->satuan_1 == "kodi" ? 'selected' : '' }}>kodi</option>
                            <option value="pak" {{ $barang->barangStok->satuan_1 == "pak" ? 'selected' : '' }}>pak</option>
                            <option value="dus" {{ $barang->barangStok->satuan_1 == "dus" ? 'selected' : '' }}>dus</option>
                            <option value="box" {{ $barang->barangStok->satuan_1 == "box" ? 'selected' : '' }}>box</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="satuan_2">Satuan 2</label>
                        <select class="form-control form-control-sm" name="satuan_2" id="satuan_2">
                            <option value="pcs" {{ $barang->barangStok->satuan_2 == "pcs" ? 'selected' : '' }}>pcs</option>
                            <option value="lusin" {{ $barang->barangStok->satuan_2 == "lusin" ? 'selected' : '' }}>lusin</option>
                            <option value="kodi" {{ $barang->barangStok->satuan_2 == "kodi" ? 'selected' : '' }}>kodi</option>
                            <option value="pak" {{ $barang->barangStok->satuan_2 == "pak" ? 'selected' : '' }}>pak</option>
                            <option value="dus" {{ $barang->barangStok->satuan_2 == "dus" ? 'selected' : '' }}>dus</option>
                            <option value="box" {{ $barang->barangStok->satuan_2 == "box" ? 'selected' : '' }}>box</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-1">
                        <label for="isi_satuan_2">Isi</label>
                        <input type="number" class="form-control form-control-sm" name="isi_satuan_2" id="isi_satuan_2" value="{{ $barang->barangStok->isi_satuan_2 }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="satuan_3">Satuan 3</label>
                        <select class="form-control form-control-sm" name="satuan_3" id="satuan_3">
                            <option value="pcs" {{ $barang->barangStok->satuan_3 == "pcs" ? 'selected' : '' }}>pcs</option>
                            <option value="lusin" {{ $barang->barangStok->satuan_3 == "lusin" ? 'selected' : '' }}>lusin</option>
                            <option value="kodi" {{ $barang->barangStok->satuan_3 == "kodi" ? 'selected' : '' }}>kodi</option>
                            <option value="pak" {{ $barang->barangStok->satuan_3 == "pak" ? 'selected' : '' }}>pak</option>
                            <option value="dus" {{ $barang->barangStok->satuan_3 == "dus" ? 'selected' : '' }}>dus</option>
                            <option value="box" {{ $barang->barangStok->satuan_3 == "box" ? 'selected' : '' }}>box</option>
                        </select>
                    </div>

                    <div class="form-group col-lg-1">
                        <label for="isi_satuan_3">Isi</label>
                        <input type="number" class="form-control form-control-sm" name="isi_satuan_3" id="isi_satuan_3" value="{{ $barang->barangStok->isi_satuan_3 }}">
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
                        <input type="number" class="form-control form-control-sm" name="harga_beli" id="harga_beli" value="{{ $barang->harga_beli }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6">
                        <label for="harga_jual">Harga Jual (Rp)</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual" id="harga_jual" value="{{ $barang->barangHarga->harga_jual }}" required>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="harga_jual_1">Harga Grosir 1</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual_1" id="harga_jual_1" value="{{ $barang->barangHarga->harga_jual_1 }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="harga_jual_2">Harga Grosir 2</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual_2" id="harga_jual_2" value="{{ $barang->barangHarga->harga_jual_2 }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="harga_jual_3">Harga Grosir 3</label>
                        <input type="number" class="form-control form-control-sm harga-jual-input" name="harga_jual_3" id="harga_jual_3" value="{{ $barang->barangHarga->harga_jual_3 }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="header3 color-black mb-20 font-weight-700">Diskon Barang</h2>
                {{-- <div class="row mb-12">
                    <div class="form-group col-lg-3">
                        <label for="diskon_beli">Diskon Beli</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_beli" id="diskon_beli" value="{{ $barang->diskon_beli }}" max="100">
                    </div>
                </div> --}}

                <div class="row mb-12">
                    <div class="form-group col-lg-3">
                        <label for="diskon_jual">Diskon Jual</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_jual" id="diskon_jual" value="{{ $barang->barangDiskon->diskon_jual }}" max="100">
                    </div>
                </div>

                <div class="row mb-12">
                    <div class="form-group col-lg-6">
                        <label for="diskon_amount_1">Diskon Amount (Rp)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_1" id="diskon_amount_1" value="{{ $barang->barangDiskon->diskon_amount_1 }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="diskon_amount_2">Diskon Amount 1</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_2" id="diskon_amount_2" value="{{ $barang->barangDiskon->diskon_amount_2 }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="diskon_amount_3">Diskon Amount 2</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_3" id="diskon_amount_3" value="{{ $barang->barangDiskon->diskon_amount_3 }}">
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="diskon_amount_4">Diskon Amount 3</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_amount_4" id="diskon_amount_4" value="{{ $barang->barangDiskon->diskon_amount_4 }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mb-20 mt-4">
                        <h2 class="header3 color-black font-weight-700 mb-0">Diskon Pembelian Dalam Jumlah Tertentu</h2>
                    </div>
                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_1">Diskon Pembelian (1)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_1" id="diskon_qty_1" value="{{ $barang->barangDiskon->diskon_qty_1 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_1">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_1" id="diskon_qty_persen_1" value="{{ $barang->barangDiskon->diskon_qty_persen_1 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_2">Diskon Pembelian (2)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_2" id="diskon_qty_2" value="{{ $barang->barangDiskon->diskon_qty_2 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_2">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_2" id="diskon_qty_persen_2" value="{{ $barang->barangDiskon->diskon_qty_persen_2 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_3">Diskon Pembelian (3)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_3" id="diskon_qty_3" value="{{ $barang->barangDiskon->diskon_qty_3 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_3">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_3" id="diskon_qty_persen_3" value="{{ $barang->barangDiskon->diskon_qty_persen_3 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_4">Diskon Pembelian (4)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_4" id="diskon_qty_4" value="{{ $barang->barangDiskon->diskon_qty_4 }}">
                    </div>

                    <div class="form-group col-lg-6 mb-12">
                        <label for="diskon_qty_persen_4">Jumlah Diskon (%)</label>
                        <input type="number" class="form-control form-control-sm" name="diskon_qty_persen_4" id="diskon_qty_persen_4" value="{{ $barang->barangDiskon->diskon_qty_persen_4 }}">
                    </div>
                </div>
            </div>
        </div>

        <section class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-custom red px-3 ml-3">
                <i class="fas fa-times-circle mr-2"></i>
                Keluar
            </button>
            <button type="button" class="btn btn-custom blue px-3 ml-3">
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
