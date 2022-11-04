@extends('layouts.pos.app')

@section('content')
<form id="form-validation" action="{{ route('back.transaksi.retur-penjualan.store') }}" method="POST">
    @csrf
    <header class="container-fluid pt-3">
        <h1 class="color-primary header1 mb-3 font-weight-700">Retur Penjualan</h1>

        <div class="row custom-gutter">
            <div class="col-md-8">
                <div class="custom-form-group">
                    <label class="body2 font-weight-700 color-black mb-1" for="">Total Retur</label>
                    <input type="text" class="total-form-control form-control" value="0" id="total" readonly>
                </div>
            </div>

            <div class="col-md-4">
                <h2 class="body2 font-weight-700 color-black mb-1">Pelanggan</h2>
                <div class="customer-container">
                    <div class="row custom-gutter">
                        <div class="col-lg-12">
                            <div class="form-group mb-2">
                                <label for="" class="body2 color-black mb-1">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="pelanggan-nama" readonly>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-group">
                                <label for="" class="body2 color-black mb-1">Kode</label>
                                <input type="text" class="form-control form-control-sm" id="pelanggan-kode" readonly>
                            </div>
                        </div>

                        <div class="col-lg-7">
                            <div class="form-group">
                                <label for="" class="body2 color-black mb-1">Email</label>
                                <input type="text" class="form-control form-control-sm" id="pelanggan-email" readonly>
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
                    <table class="table table-striped my-0" id="table">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Item</th>
                                <th>Harga</th>
                                <th>Banyak</th>
                                <th>Banyak Retur</th>
                                {{-- <th>Diskon</th> --}}
                                <th>Total Retur</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <div class="row footer-gutter">
                    <div class="col-lg-5">
                        <div class="d-flex align-items-center mb-4">
                            <label class="body2 color-black footer-faktur-label mb-0">No. Faktur Jual</label>
                            <input type="text" name="faktur" class="form-control form-control-sm mx-3" id="kode-faktur">
                            <button type="button" class="btn btn-custom accent btn-block" id="btn-find-faktur"><i class="fas fa-eye mr-2"></i>Lihat</button>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <label class="body2 color-black footer-faktur-label mb-0">Tgl. Faktur Jual</label>
                            <input type="date" class="form-control form-control-sm ml-3" id="tgl-faktur" readonly>
                        </div>

                        <div class="d-flex align-items-center mb-0">
                            <label class="body2 color-black footer-faktur-label mb-0">Total Faktur</label>
                            <input type="number" class="form-control form-control-sm ml-3" id="total-faktur" value="0" readonly>
                            <input type="hidden" id="total-faktur-hide" value="0">
                            <input type="hidden" id="ppn-faktur" value="0">
                            <input type="hidden" id="potongan-faktur" value="0">
                        </div>
                    </div>

                    <div class="col-lg-5 col-xl-4 offset-lg-2 offset-xl-3">
                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <label class="footer-total-label">Sub Total Retur</label>
                            <input type="number" class="form-control form-control-sm footer-total-input" id="sub-total" value="0" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <div class="d-flex align-items-center">
                                <label class="footer-total-label mr-1">Potongan</label>
                                <input class="form-control form-control-sm footer-discount-input mr-1" id="potongan" value="0" type="number" readonly>
                                <label class="footer-total-label">%</label>
                            </div>
                            <input type="number" class="form-control form-control-sm footer-total-input" id="potongan-input" value="0" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center mb-3 justify-content-between">
                            <div>
                                <input type="checkbox" id="ppn" disabled>
                                <label class="footer-total-label ml-1">PPN</label>
                            </div>
                            <input type="number" class="form-control form-control-sm footer-total-input" id="ppn-input" value="0" readonly>
                        </div>

                        <div class="form-group d-flex align-items-center justify-content-between">
                            <label class="footer-total-label">Total Retur</label>
                            <input type="number" class="form-control form-control-sm footer-total-input" id="total-retur" value="0" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 d-flex flex-column justify-content-between">
                <div>
                    <img height="200" width="342" class="footer-image-preview mb-4" src="{{ asset('back_assets/img/public/item-placeholder.jpg') }}" alt="">

                    <button type="button" class="btn btn-custom red btn-block mt-0 mb-12"><i class="fas fa-trash-alt mr-2"></i>Hapus faktur</button>
                    {{-- <button type="button" class="btn btn-custom green btn-block mt-0 mb-12"><i class="fas fa-file-excel mr-2"></i>File Excel</button> --}}
                    <button type="submit" class="btn btn-custom green btn-block mt-0 mb-12"><i class="fas fa-save mr-2"></i>Simpan</button>
                    {{-- <button type="button" class="btn btn-custom green btn-block mt-0 mb-0"><i class="fas fa-print mr-2"></i>Print</button> --}}
                </div>

                <a class="text-decoration-none" href="{{ route('back.home.index') }}">
                    <button type="button" class="btn btn-custom red btn-block"><i class="fas fa-times-circle mr-2"></i>Keluar</button>
                </a>
            </div>
        </div>
    </section>
</form>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/transaksi/retur-penjualan/create.css') }}">
@endpush

@push('js')
<script>
    var table;
    table = $('#table').DataTable({
        "responsive": true,
        "pagingType": "simple_numbers",
        "paging": false,
        "autoWidth": false,
        "scrollY": "310px",
        'pageLength': 10,
        "lengthMenu": [10, 25, 50, 100],
        "order": [['5', 'desc']],
        "processing": true,
        "bInfo" : false,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        // "serverSide": true,
        "searching": false,
    });

    $('body').on('click', '#btn-find-faktur', function () {
        let kode = $('#kode-faktur').val()

        $.ajax({
            url: '/api/v1/transaksi/penjualan/',
            method: 'get',
            dataType: 'json',
            data: {
                'kodeFaktur': kode
            },
            success: function (data) {
                $('#pelanggan-nama').val(data[1].nama)
                $('#pelanggan-kode').val(data[1].kode)
                $('#pelanggan-email').val(data[1].email)

                $('#tgl-faktur').val(data[0].tanggal)
                $('#ppn-faktur').val(data[0].ppn)
                $('#potongan-faktur').val(data[0].potongan)
                $('#total-faktur').val(data[0].total)
                $('#total-faktur-hide').val(data[0].total)

                fetchData(data[2])
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Gagal !",
                    timer: 5000,
                    text: 'Transaksi tidak ditemukan!',
                })
            }
        })
    })

    $('body').on('keyup mouseup', '.qty-item', function () {
        let elid    = $(this).data('item')
        let qty     = $(this).val() != "" ? $(this).val() : 0
        let qtyf    = $('body').find('.qtyf-item-' + elid).val()
        let harga   = $('body').find('.harga-item-' + elid).val()
        let totalR  = parseInt(harga) * parseInt(qty)

        $('body').find('.total-item-' + elid).val(totalR)

        let totalFaktur = $('#total-faktur').val()
        let ppn = $('#ppn-faktur').val()
        let potongan = $('#potongan-faktur').val()

        if (ppn > 1) {
            $('#ppn').attr('checked', true)
            $('#ppn-input').val(ppn)
        }

        if (potongan > 1) {
            $("#potongan").val(hitungPersen(potongan, totalFaktur))
            $("#potongan-input").val(potongan)
        }

        if (qty > qtyf) {
            Swal.fire({
                icon: "error",
                confirmButtonText: "OK",
                text: "Banyak barang yang hendak diretur tidak boleh lebih besar dari jumlah semula!",
            }).then((result) => {
                if (result.value) {
                    totalR = parseInt(harga) * 1
                    $('body').find('.qty-item-' + elid).val(1)
                    $('body').find('.total-item-' + elid).val(totalR)
                    subTotalEl()
                }
            })
        }

        subTotalEl()
        total()
    })

    function fetchData(datas) {
        if(datas) {
            datas.forEach(data => listFaktur(data))
        }
    }

    const listFaktur = (data) => {
        const tr = document.createElement('tr')
        const randid = makeid(4)
        tr.classList.add('mb-4')
        tr.classList.add('item')
        tr.classList.add(`item-${randid}`)
        // tr.setAttribute('data-img', img)

        // let harga         = hargaJual
        // let diskon        = hargaDiskon * qty
        // let totalHarga    = 0
        // if (diskon > 1) {
        //     totalHarga    = harga * qty - diskon
        // } else {
        //     totalHarga    = harga * qty
        // }

        tr.innerHTML =  `
            <td>${data.kode}</td>
            <td>${data.barang}</td>
            <td>${data.harga}</td>
            <td>${data.banyak}</td>
            <td>
                <input type="number" class="form-control qty-item qty-item-${randid}" name="banyak[]" value="0" data-item="${randid}">
                <input type="hidden" class="form-control barang-item barang-item-${randid}" name="barang[]" value="${data.barangId}">
                <input type="hidden" class="form-control harga-item harga-item-${randid}" value="${data.harga}">
                <input type="hidden" class="form-control qtyf-item qtyf-item-${randid}" value="${data.banyak}">
            </td>
            <td><input type="number" class="form-control total-item total-item-${randid}" name="total_retur[]" value="0" readonly></td>
        `
            // <td>${data.diskon}</td>

        table.rows.add($(tr)).draw(false)
    }

    function makeid(length) {
        let result           = '';
        let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let charactersLength = characters.length;
        for ( let i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    function subTotalEl() {
        const subTotal = document.getElementById('sub-total')
        const totalEls = document.querySelectorAll('.total-item')
        const arr = []
        const reducer = (accumulator, currentValue) => accumulator + currentValue;

        totalEls.forEach(totalEl => arr.push(parseInt(totalEl.value)))

        const totalHarga = arr < 1 ? 0 : arr.reduce(reducer)

        subTotal.value = totalHarga
    }

    function total() {
        const totalFakturHd = document.getElementById('total-faktur-hide')
        const totalFaktur   = document.getElementById('total-faktur')
        const totalText     = document.getElementById('total')
        const totalRetur    = document.getElementById('total-retur')
        const potongan      = document.getElementById('potongan-input').value
        const ppn           = document.getElementById('ppn-input').value
        const subTotal      = document.getElementById('sub-total').value

        let total = parseInt(subTotal) - parseInt(potongan) + parseInt(ppn)

        totalText.value = numberFormat(total.toString(), "Rp ")
        totalRetur.value = total
        totalFaktur.value = parseInt(totalFakturHd.value) - parseInt(total)
    }

    function hitungPotongan(harga, persen) {
        let result = harga * (persen / 100);

        return result
    }

    function hitungPersen(value, total) {
        let persen = (100 * value) / total

        return parseInt(persen)
    }

    function numberFormat(number, prefix){
        var number_string = number.replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
        over    = split[0].length % 3,
        rupiah  = split[0].substr(0, over),
        thousand  = split[0].substr(over).match(/\d{3}/gi);

        if(thousand){
            separator = over ? '.' : '';
            rupiah += separator + thousand.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }
</script>
@endpush
