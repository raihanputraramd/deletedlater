@extends('layouts.pos.app')

@section('content')
<form id="form-validation-transaksi" action="{{ route('back.transaksi.penjualan.store') }}" method="POST">
    @csrf
    <header class="container-fluid pt-3">
        <h1 class="color-primary header1 mb-3 font-weight-700">Penjualan</h1>

        <div class="row custom-gutter">
            <div class="col-lg-6 col-xl-7">
                <div class="custom-form-group">
                    <label class="body2 font-weight-700 color-black mb-1" for="">Total</label>
                    <input type="text" class="total-form-control form-control" value="0" id="total" readonly>
                </div>
            </div>

            <div class="col-lg-2 col-xl-1">
                <div class="custom-form-group">
                    <label class="body2 font-weight-700 color-black mb-1" for="">Banyak</label>
                    <input type="text" class="quantity-form-control form-control" value="0" id="total-qty" readonly>
                </div>
            </div>

            <div class="col-lg-4">
                <h2 class="body2 font-weight-700 color-black mb-1">Pelanggan</h2>
                <div class="customer-container">
                    <div class="row custom-gutter">
                        <div class="col-lg-9">
                            <div class="form-group mb-2">
                                <label for="" class="body2 color-black mb-1">Nama</label>
                                <select class="form-control form-control-sm select2 select-pelanggan" name="pelanggan" id="pelanggan-nama"></select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label class="color-white">&nbsp;</label>
                            <a href="{{ route('back.master-data.pelanggan.create') }}" class="btn-page text-decoration-none text-white" data-title="Tambah Pelanggan">
                                <button type="button" class="btn customer-add btn-block">Tambah</button>
                            </a>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="" class="body2 color-black mb-1">Kode</label>
                                <select class="form-control form-control-sm select2 select-pelanggan" id="pelanggan-kode"></select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="" class="body2 color-black mb-1">Poin</label>
                                <select class="form-control form-control-sm select2 select-pelanggan" id="pelanggan-point"></select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="" class="body2 text-white mb-1">&nbsp;</label>
                                <input type="text" class="form-control form-control-sm" id="point" readonly>
                                <input type="hidden" name="point" class="form-control form-control-sm" id="pointValue" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <hr class="divider">
    </div>

    <section class="container-fluid mb-3">
            <h2 class="header3 font-weight-700 color-primary mb-1">Faktur</h2>
        <div class="row custom-gutter">
            <div class="col-lg-9">
                <div class="table-container mb-12">
                    <div class="d-flex justify-content-end">
                    </div>
                    <table class="table my-0" id="table">
                        <thead id="table-item">
                            <tr>
                                <th>No</th>
                                <th>Banyak</th>
                                <th>Satuan</th>
                                <th>Kode</th>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="list-item"></tbody>
                    </table>

                    <button id="add-item-faktur" type="button" class="btn customer-add px-2 mt-1 mx-auto d-block">Tambah Item Faktur</button>
                    <input type="hidden" id="code-el">
                </div>

                <div class="row footer-gutter">
                    <div class="col-lg-3">
                        {{-- <button type="button" class="btn btn-custom red btn-block">
                            <i class="fas fa-trash-alt mr-2"></i> Hapus Baris
                        </button> --}}

                        {{-- <button type="button" class="btn btn-custom green btn-block mt-4">
                            <i class="fas fa-file-excel mr-2"></i> File Excel
                        </button> --}}

                        {{-- <button type="button" class="btn btn-custom blue btn-block mt-4">
                            <i class="fas fa-redo mr-2"></i> Refresh Barang
                        </button> --}}
                    </div>

                    <div class="col-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <label class="body2 color-black footer-faktur-label mb-0">No. Faktur Jual</label>
                            <input type="text" class="form-control form-control-sm mx-3" name="faktur" value="{{ $nomorFaktur }}" readonly>
                            {{-- <button type="button" class="btn btn-custom accent btn-block"><i class="fas fa-eye mr-2"></i>Lihat</button> --}}
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <label class="body2 color-black footer-faktur-label mb-0">Tgl. Faktur Jual</label>
                            <input type="date" class="form-control form-control-sm ml-3" name="tanggal" value="{{ Carbon\Carbon::now()->toDateString() }}">
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <a class="w-50 text-decoration-none" href="{{ route('back.master-data.barang.create') }}">
                                <button type="button" class=" btn btn-custom green mr-2 btn-block"><i class="fas fa-plus mr-2"></i>Tambah Barang</button>
                            </a>
                            <a class="w-50 text-decoration-none" href="{{ route('back.master-data.barang.index') }}">
                                <button type="button" class="btn btn-custom accent ml-2 btn-block"><i class="fas fa-pen mr-2"></i>Edit Barang</button>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <label class="footer-total-label">Sub Total</label>
                            <input type="text" class="form-control form-control-sm footer-total-input" name="sub_total" value="0" id="sub-total" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <label class="footer-total-label mr-1">Potongan</label>
                                <input class="form-control form-control-sm footer-discount-input mr-1" value="0" min="0" max="99" type="number" id="potongan">
                                <label class="footer-total-label">%</label>
                            </div>
                            <input type="number" class="form-control form-control-sm footer-total-input" name="potongan" value="0" id="potongan-input">
                        </div>

                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <div>
                                <input type="checkbox" id="ppn">
                                <label class="footer-total-label ml-1">PPN</label>
                            </div>
                            <input type="text" class="form-control form-control-sm footer-total-input" name="ppn" value="0" id="ppn-input" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <label class="footer-total-label">Total</label>
                            <input type="text" class="form-control form-control-sm footer-total-input" name="totalBelanja" value="0" id="total-inpt" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <img class="footer-image-preview mb-4" id="img-item" src="{{ asset('back_assets/img/public/item-placeholder.jpg') }}" alt="" height="200" width="342">

                {{-- <button type="button" class="btn btn-custom accent btn-block mt-0 mb-12"><i class="fas fa-paperclip mr-2"></i>Faktur Baru</button> --}}
                {{-- <button type="button" class="btn btn-custom green btn-block mt-0 mb-4"><i class="fas fa-print mr-2"></i>Print</button> --}}

                <div class="d-flex mb-12">
                    <div class="form-group mb-0 mr-3" id="bayar-form">
                        <label class="body1" id="bayar-title">Dibayar</label>
                        <input type="number" class="form-control form-control-sm dibayar-input" name="bayar" value="0" id="bayar">
                    </div>

                    <div class="form-group mb-0 mr-3 bank-form">
                        <label class="body1" id="bank_fe-title">Bank Transfer</label>
                        <input type="text" class="form-control form-control-sm dibayar-input" id="bank_fe" readonly>
                    </div>

                    <div class="w-100 form-group mb-0">
                        <label class="text-white body1">&nbsp;</label>
                        <button type="button" class="btn btn-custom green btn-block mt-0" data-toggle="modal" data-target="#modalPage"><i class="fas fa-money-bill-alt"></i></button>
                    </div>
                </div>

                <div class="form-group mb-4" id="kembali-form">
                    <label class="body1">Kembali</label>
                    <input type="text" class="form-control form-control-sm" name="kembali" value="0" id="kembali">
                </div>

                <div class="form-group mb-4 jatuh_tempo-form">
                    <label class="body1">Jatuh Tempo</label>
                    <input type="date" class="form-control form-control-sm" name="kembali" id="jatuh_tempo_fe" value="{{ Carbon\Carbon::now()->addDay(3)->format('Y-m-d') }}" readonly>
                </div>

                <button type="submit" class="btn btn-lg btn-success btn-block mt-0 mb-12" 
                    style="background-color: #28A745 !important; border-radius: 12px !important;"
                    >
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>

                <a class="text-decoration-none" href="{{ route('back.home.index') }}">
                    <button type="button" class="btn btn-custom red btn-block"><i class="fas fa-times-circle mr-2"></i>Keluar</button>
                </a>
            </div>
        </div>
    </section>

    {{-- Modal Default --}}
    <div class="modal fade" id="modalPage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPageLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header p-2">
                    <h2 class="header2 color-black font-weight-bold mb-0">Metode Pembayaran</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-12">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="tipe_pembayaran">Cara Bayar</label>
                            <select class="form-control form-control-sm" name="tipe_pembayaran" id="tipe_pembayaran">
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Debit Card">Debit Card</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Piutang">Piutang</option>
                                <option value="Voucher">Voucher</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 mb-12" id="voucher-form">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="voucher">Kode Voucher</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" class="form-control form-control-sm" name="voucher" id="voucher" placeholder="Masukan Kode Voucher">
                                    <input type="hidden" id="potonganVoucher" value="0">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success btn-sm" id="klaimVoucher">Klaim Voucher</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-12 jatuh_tempo-form">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="jatuh_tempo">Jatuh Tempo</label>
                            <input type="date" class="form-control form-control-sm" name="jatuh_tempo" id="jatuh_tempo" value="{{ Carbon\Carbon::now()->addDay(3)->format('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-12 mb-12" id="nik-form">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="nik">No NIK</label>
                            <input type="text" class="form-control form-control-sm" name="nik" id="nik">
                        </div>
                    </div>

                    <div class="col-md-12 mb-12" id="nominal-form">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="nominal">Nominal</label>
                            <input type="number" class="form-control form-control-sm" name="nominal" value="0" id="nominal">
                        </div>
                    </div>

                    <div class="col-md-12 mb-12" id="tanggal_transfer-form">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="tanggal_transfer" id="judul-tanggal">Tanggal Transfer</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_transfer" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>

                    <div class="col-md-12 mb-12 bank-form">
                        <div class="form-group">
                            <label class="body1 color-black font-weight-normal" for="bank">Bank Transfer</label>
                            <input type="text" class="form-control form-control-sm" name="bank" id="bank">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom green px-3 ml-3" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Default --}}
</form>

{{-- Modal Default --}}
<div class="modal fade" id="modalPageNew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPageLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h2 class="header2 color-black font-weight-bold mb-0" id="modal-title"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="modal-body">
                ...
            </div>
        </div>
    </div>
</div>
{{-- End Modal Default --}}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/transaksi/penjualan/create.css') }}">
@endpush

@push('js')
<script src="{{ asset('back_assets/dist/js/pages/back/transaksi/penjualan/create.js') }}"></script>
<script src="https://rawgit.com/kabachello/jQuery-Scanner-Detection/master/jquery.scannerdetection.js"></script>
<script>
    $('#pelanggan-nama').on('change', function () {
        let id = $(this).val()
        $('body').find('#pelanggan-kode').val(id).trigger('change.select2')
        $('body').find('#pelanggan-point').val(id).trigger('change.select2')
    })

    $('#pelanggan-kode').on('change', function () {
        let id = $(this).val()
        $('body').find('#pelanggan-nama').val(id).trigger('change.select2')
        $('body').find('#pelanggan-point').val(id).trigger('change.select2')
    })

    $('#pelanggan-point').on('change', function () {
        let id = $(this).val()
        $('body').find('#pelanggan-nama').val(id).trigger('change.select2')
        $('body').find('#pelanggan-kode').val(id).trigger('change.select2')
    })

    $('.select-pelanggan').on('change', function () {
        let val = $('#pointValue').val()
        let point = $("#pelanggan-point option:selected").text()
        let result = parseInt(point) + parseInt(val)

        $('#point').val('+ ' + val + ' = ' +  result)
        getDiskonPelanggan()
    })

    // Get Barcode
    $(document).scannerDetection({
        timeBeforeScanTest: 200,
        avgTimeByChar: 100,
        onComplete: function(barcode, qty){
            if($('body').find('#item-codes-'+ barcode ).length >= 1) {
                let itemEl = $('body').find('#item-codes-'+ barcode ).data('item')
                let qty   = parseInt($('body').find('.qty-item-'+ itemEl).val()) + parseInt(1)

                $('body').find('.qty-item-'+ itemEl).val(qty)

                updateQty(itemEl)

                setTimeout(() => {
                    let item  = $('body').find('.code-item-'+ itemEl).val()
                    let qtyItem = $('body').find('.qty-item-'+ itemEl).val()
                    let data  = {
                        "barang": item,
                        "qty": parseInt(qtyItem)
                    };

                    if (localStorage.getItem('item_faktur') == null) {
                        itemFaktur(data)
                        let cart = JSON.parse(localStorage.getItem('item_faktur')).length
                        if(cart == 0) {
                            itemFaktur(data)
                        }
                    } else {
                        fakturUpdate(data, parseInt(qtyItem));
                    }
                }, 500);
            } else {
                createItems()
                let code = $('body').find('#code-el').val()

                setTimeout(() => {
                    $('body').find('.code-item-'+ code).val(getOptId(barcode)).change()
                }, 500);

                setTimeout(() => {
                    let item  = $('body').find('.code-item-'+ code).val()
                    let qtyItem = $('body').find('.qty-item-'+ code).val()
                    let data  = {
                        "barang": item,
                        "qty": parseInt(qtyItem)
                    };

                    if (localStorage.getItem('item_faktur') == null) {
                        itemFaktur(data)
                        let cart = JSON.parse(localStorage.getItem('item_faktur')).length
                        if(cart == 0) {
                            itemFaktur(data)
                        }
                    } else {
                        fakturUpdate(data, parseInt(qtyItem));
                    }
                }, 1000);
            }

            subTotalEl()
            totalQTY()
            total()
        }
    })

    function getOptId(text) {
        let id = '';
        $('.get-item').find('*').filter(function() {
            if ($(this).text() === text) {
                id = $(this).val();
            }
        });
        return id;
    }

    function getDiskonPelanggan() {
        let diskon = $("#pelanggan-nama option:selected").data('diskon')

        $('#potongan').val(diskon)
    }

    getClient()
    function getClient() {
        $.ajax({
            url: "{{ route('api.master-data.pelanggan') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    options += '<option value="'+ this.id +'" data-diskon="'+ this.diskon +'">'+ this.nama +'</option>'
                })
                $('body').find('#pelanggan-nama').html(options)

                getDiskonPelanggan()
                fetchData()
            }
        })

        $.ajax({
            url: "{{ route('api.master-data.pelanggan') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    options += '<option value="'+ this.id +'">'+ this.kode +'</option>'
                })
                $('body').find('#pelanggan-kode').html(options)
            }
        })

        $.ajax({
            url: "{{ route('api.master-data.pelanggan') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    options += '<option value="'+ this.id +'">'+ this.point +'</option>'
                })
                $('body').find('#pelanggan-point').html(options)
            }
        })
    }

    $('body').on('click', '#btn-save', function () {
        $('#form-validation').submit()
    })

    $('body').on('click', '.btn-page', function () {
        event.preventDefault()
        let url = $(this).attr('href')
        let title = $(this).data('title')

        $('#modalPageNew').modal('show')
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success: function (html) {
                $('#modal-title').text(title)
                $('#modal-body').html(html)
            }
        })
    })
</script>
@endpush
