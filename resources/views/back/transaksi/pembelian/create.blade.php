@extends('layouts.pos.app')

@section('content')
<form id="form-validation-transaksi" action="{{ route('back.transaksi.pembelian.store') }}" method="POST">
    @csrf
    <header class="container-fluid pt-3">
        <h1 class="color-primary header1 mb-3 font-weight-700">Pembelian</h1>

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
                <h2 class="body2 font-weight-700 color-black mb-1">Supplier</h2>
                <div class="customer-container">
                    <div class="row custom-gutter">
                        <div class="col-lg-9">
                            <div class="form-group mb-2">
                                <label for="" class="body2 color-black mb-1">Nama</label>
                                <select class="form-control form-control-sm select2 select-supplier" name="supplier" id="supplier-nama"></select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <a href="{{ route('back.master-data.supplier.create') }}" class="btn-page text-decoration-none text-white" data-title="Tambah Supplier">
                                <label class="color-white">&nbsp;</label>
                                <button type="button" class="btn customer-add btn-block">Tambah</button>
                            </a>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="" class="body2 color-black mb-1">Kode</label>
                                <select class="form-control form-control-sm select2 select-supplier" id="supplier-kode"></select>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="" class="body2 color-black mb-1">Email</label>
                                <select class="form-control form-control-sm select2 select-supplier" id="supplier-email"></select>
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
                                {{-- <th>Total PPN</th> --}}
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
                            <label class="body2 color-black footer-faktur-label mb-0">No. Faktur Beli</label>
                            <input type="text" class="form-control form-control-sm mx-3" name="faktur" value="{{ $nomorFaktur }}" readonly>
                            {{-- <button type="button" class="btn btn-custom accent btn-block"><i class="fas fa-eye mr-2"></i>Lihat</button> --}}
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <label class="body2 color-black footer-faktur-label mb-0">Tgl. Faktur</label>
                            <input type="date" class="form-control form-control-sm mx-3" name="tanggal" value="{{ Carbon\Carbon::now()->toDateString() }}">
                            {{-- <button type="button" class="btn btn-custom accent btn-block" data-toggle="modal" data-target="#modalPage">Non Tunai</button> --}}
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-12">
                                <div class="form-group">
                                    <label class="body2 color-black mb-0" style="font-size: 14px" for="tipe_pembayaran">Cara Bayar</label>
                                    <select class="form-control form-control-sm" name="tipe_pembayaran" id="tipe_pembayaran">
                                        <option value="Cash">Cash</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Debit Card">Debit Card</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Voucher">Voucher</option>
                                        <option value="Hutang">Hutang</option>
                                    </select>
                                </div>
                            </div>
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
                            <input type="text" class="form-control form-control-sm footer-total-input" value="0" name="sub_total" id="sub-total" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <label class="footer-total-label mr-1">Potongan</label>
                                <input type="number" class="form-control form-control-sm footer-discount-input mr-1" value="0" min="0" max="99" id="potongan">
                                <label class="footer-total-label">%</label>
                            </div>
                            <input type="text" class="form-control form-control-sm footer-total-input" name="potongan" value="0" id="potongan-input">
                        </div>

                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <div>
                                <input type="checkbox" id="ppn">
                                <label class="footer-total-label ml-1">PPN</label>
                            </div>
                            <input type="text" class="form-control form-control-sm footer-total-input" name="ppn" id="ppn-input" value="0" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <label class="footer-total-label">Total</label>
                            <input type="text" class="form-control form-control-sm footer-total-input" name="totalBelanja" value="0" id="total-inpt" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 d-flex flex-column flex-wrap justify-content-between">
                <div>
                    <img class="footer-image-preview mb-12" id="img-item" src="{{ asset('back_assets/img/public/item-placeholder.jpg') }}" alt="" height="200" width="342">

                    {{-- <button type="button" class="btn btn-custom accent btn-block mt-0 mb-12"><i class="fas fa-print mr-2"></i>Label Rak</button> --}}
                    {{-- <button type="button" class="btn btn-custom accent btn-block mt-0 mb-12"><i class="fas fa-barcode mr-2"></i>Barcode</button> --}}
                    {{-- <div class="form-group mb-12 d-flex align-items-center">
                        <label class="body1 mr-3 mb-0">Skip</label>
                        <input type="text" class="form-control form-control-sm">
                    </div> --}}
                    {{-- <button type="button" class="btn btn-custom accent btn-block mt-0 mb-12"><i class="fas fa-paperclip mr-2"></i>Faktur Baru</button>
                    <button type="button" class="btn btn-custom red btn-block mt-0 mb-12"><i class="fas fa-trash-alt mr-2"></i>Hapus Faktur</button> --}}
                    <button type="submit" class="btn btn-custom green btn-block mt-0 mb-12"><i class="fas fa-save mr-2"></i>Simpan</button>
                    {{-- <button type="button" class="btn btn-custom green btn-block mt-0 mb-12"><i class="fas fa-print mr-2"></i>Print</button> --}}
                </div>

                <a class="text-decoration-none text-white" href="{{ route('back.home.index') }}">
                    <button type="button" class="btn btn-custom red btn-block"><i class="fas fa-times-circle mr-2"></i>Keluar</button>
                </a>
            </div>
        </div>
    </section>

        {{-- Modal Default --}}
        {{-- <div class="modal fade" id="modalPage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPageLabel" aria-hidden="true">
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
                                    <option value="Voucher">Voucher</option>
                                    <option value="Hutang">Hutang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label class="body1 color-black font-weight-normal" for="jatuh_tempo">Jatuh Tempo</label>
                                <input type="date" class="form-control form-control-sm" name="jatuh_tempo" value="{{ Carbon\Carbon::now()->addDay(3)->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-12">
                            <div class="form-group">
                                <label class="body1 color-black font-weight-normal" for="nominal">Nominal</label>
                                <input type="number" class="form-control form-control-sm" name="nominal" value="0" id="nominal-hutang">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-custom green px-3 ml-3" data-dismiss="modal">Simpan</button>
                    </div>
                </div>
            </div>
        </div> --}}
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
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/transaksi/pembelian/create.css') }}">
@endpush

@push('js')
<script src="{{ asset('back_assets/dist/js/pages/back/transaksi/pembelian/create.js') }}"></script>
<script src="https://rawgit.com/kabachello/jQuery-Scanner-Detection/master/jquery.scannerdetection.js"></script>
<script>
    $('#supplier-nama').on('change', function () {
        let id = $(this).val()
        $('body').find('#supplier-kode').val(id).trigger('change.select2')
        $('body').find('#supplier-email').val(id).trigger('change.select2')
    })

    $('#supplier-kode').on('change', function () {
        let id = $(this).val()
        $('body').find('#supplier-nama').val(id).trigger('change.select2')
        $('body').find('#supplier-email').val(id).trigger('change.select2')
    })

    $('#supplier-email').on('change', function () {
        let id = $(this).val()
        $('body').find('#supplier-nama').val(id).trigger('change.select2')
        $('body').find('#supplier-kode').val(id).trigger('change.select2')
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

    function getDiskonSupplier() {
        let diskon = $("#supplier-nama option:selected").data('diskon')

        $('#potongan').val(diskon)
    }

    getClient()
    function getClient() {
        $.ajax({
            url: "{{ route('api.master-data.supplier') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    options += '<option value="'+ this.id +'" data-diskon="'+ this.diskon +'">'+ this.nama +'</option>'
                })
                $('body').find('#supplier-nama').html(options)

                getDiskonSupplier()
            }
        })

        $.ajax({
            url: "{{ route('api.master-data.supplier') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    options += '<option value="'+ this.id +'">'+ this.kode +'</option>'
                })
                $('body').find('#supplier-kode').html(options)
            }
        })

        $.ajax({
            url: "{{ route('api.master-data.supplier') }}",
            dataType: 'json',
            method: 'GET',
            success: function (data) {
                let options = ''
                $.each(data, function () {
                    options += '<option value="'+ this.id +'">'+ this.email +'</option>'
                })
                $('body').find('#supplier-email').html(options)
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
