@extends('layouts.pos.app')

@section('content')
<div class="container-fluid pt-3">
    <div class="row">
        <div class="col-lg-12">
            @if (
                App\Helpers\User::checkPermission('Tambah Barang') ||
                App\Helpers\User::checkPermission('Edit Barang') ||
                App\Helpers\User::checkPermission('Tambah Pelanggan') ||
                App\Helpers\User::checkPermission('Edit Pelanggan') ||
                App\Helpers\User::checkPermission('Tambah Supplier') ||
                App\Helpers\User::checkPermission('Edit Supplier')
            )
                <h1 class="color-primary header1 font-weight-700 mb-1">Data Master</h1>
                <section class="section-container mb-5">
            @endif
                @if (App\Helpers\User::checkPermission('Tambah Barang') || App\Helpers\User::checkPermission('Edit Barang'))
                    <div class="data-master-card">
                        <h2 class="header3 font-weight-700 color-black mb-2">Barang</h2>

                        <div class="d-flex">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Barang'))
                        <a href="{{ route('back.master-data.barang.create') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/tambah-barang.png') }}"
                                    alt="Tambah barang icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Tambah<br>Barang</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Barang'))
                        <a href="{{ route('back.master-data.barang.index') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon ml-2"
                                    src="{{ asset('back_assets/img/public/edit-barang.png') }}"
                                    alt="Edit barang icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Edit<br>Barang</span>
                            </div>
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Barang') || App\Helpers\User::checkPermission('Edit Barang'))
                        </div>
                    </div>
                @endif

                @if (App\Helpers\User::checkPermission('Tambah Pelanggan') || App\Helpers\User::checkPermission('Edit Pelanggan'))
                    <div class="data-master-card">
                        <h2 class="header3 font-weight-700 color-black mb-2">Pelanggan</h2>

                        <div class="d-flex">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Pelanggan'))
                        <a class="item-link btn-page" href="{{ route('back.master-data.pelanggan.create') }}" data-title="Tambah Pelanggan">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/tambah-pelanggan.png') }}"
                                    alt="Tambah pelanggan icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Tambah<br>Pelanggan</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Pelanggan'))
                        <a href="{{ route('back.master-data.pelanggan.index') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/edit-pelanggan.png') }}"
                                    alt="Edit pelanggan icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Edit<br>Pelanggan</span>
                            </div>
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Pelanggan') || App\Helpers\User::checkPermission('Edit Pelanggan'))
                        </div>
                    </div>
                @endif

                @if (App\Helpers\User::checkPermission('Tambah Supplier') || App\Helpers\User::checkPermission('Edit Supplier'))
                    <div class="data-master-card">
                        <h2 class="header3 font-weight-700 color-black mb-2">Supplier</h2>

                        <div class="d-flex">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Supplier'))
                        <a href="{{ route('back.master-data.supplier.create') }}" class="item-link btn-page" data-title="Tambah Supplier">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/tambah-supplier.png') }}"
                                    alt="Tambah supplier icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Tambah<br>Supplier</span>
                            </div>
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Supplier'))
                        <a href="{{ route('back.master-data.supplier.index') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/edit-supplier.png') }}"
                                    alt="Edit supplier icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Edit<br>Supplier</span>
                            </div>
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Supplier') || App\Helpers\User::checkPermission('Edit Supplier'))
                        </div>
                    </div>
                @endif
            @if (
                App\Helpers\User::checkPermission('Tambah Barang') ||
                App\Helpers\User::checkPermission('Edit Barang') ||
                App\Helpers\User::checkPermission('Tambah Pelanggan') ||
                App\Helpers\User::checkPermission('Edit Pelanggan') ||
                App\Helpers\User::checkPermission('Tambah Supplier') ||
                App\Helpers\User::checkPermission('Edit Supplier')
            )
                </section>
            @endif

            @if (
                App\Helpers\User::checkPermission('Transaksi Penjualan') ||
                App\Helpers\User::checkPermission('Transaksi Pembelian') ||
                App\Helpers\User::checkPermission('Transaksi Retur Penjualan') ||
                App\Helpers\User::checkPermission('Tambah Kas Tunai') ||
                App\Helpers\User::checkPermission('Edit Piutang') ||
                App\Helpers\User::checkPermission('Edit Hutang') ||
                App\Helpers\User::checkPermission('Tambah Bank Transfer') ||
                App\Helpers\User::checkPermission('Tambah Penukaran Point') ||
                App\Helpers\User::checkPermission('Edit Penukaran Point')
            )
                <h1 class="color-primary header1 font-weight-700 mb-1">Transaksi</h1>
                <section class="section-container mb-5">
            @endif
                @if (App\Helpers\User::checkPermission('Transaksi Penjualan'))
                    <a href="{{ route('back.transaksi.penjualan.create') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/penjualan.png') }}"
                                alt="Penjualan icon"
                                width="60"
                                height="60">
                            <span class="item-label">Penjualan</span>
                        </div>
                    </a>
                @endif

                    @if (App\Helpers\User::checkPermission('Transaksi Pembelian'))
                        <a href="{{ route('back.transaksi.pembelian.create') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/pembelian.png') }}"
                                    alt="Pembelian icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Pembelian</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Transaksi Retur Penjualan'))
                        <a href="{{ route('back.transaksi.retur-penjualan.create') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/retur-penjualan.png') }}"
                                    alt="Retur Penjualan icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Retur<br>Penjualan</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Piutang'))
                        <a href="{{ route('back.transaksi.bayar-piutang.index') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/bayar-piutang.png') }}"
                                    alt="Bayar Piutang icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Bayar<br>Piutang</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Hutang'))
                        <a href="{{ route('back.transaksi.bayar-hutang.index') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/bayar-hutang.png') }}"
                                    alt="Bayar Hutang icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Bayar<br>Hutang</span>
                            </div>
                        </a>
                    @endif


                    @if (App\Helpers\User::checkPermission('Tambah Kas Tunai'))
                        <a href="{{ route('back.transaksi.kas-tunai.create') }}" data-title="Kas Tunai Masuk / Keluar" class="item-link btn-page">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/input-kas-tunai.png') }}"
                                    alt="Input Kas Tunai icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Input<br>Kas Tunai</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Tambah Bank Transfer'))
                        <a href="{{ route('back.transaksi.bank-transfer.create') }}" data-title="Bank Transfer" class="item-link btn-page">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/input-bank-transfer.png') }}"
                                    alt="Input Bank Transfer icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Input<br>Bank Transfer</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Tambah Penukaran Point'))
                        <a href="{{ route('back.transaksi.penukaran-point.create') }}" class="item-link btn-page" data-title="Penukaran Poin">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/penukaran-point.png') }}"
                                    alt="Penukaran Point icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Penukaran<br>Poin</span>
                            </div>
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Penukaran Point'))
                        <a href="{{ route('back.transaksi.penukaran-point.index') }}" class="item-link">
                            <div class="item-container">
                                <img
                                    class="item-icon"
                                    src="{{ asset('back_assets/img/public/edit-penukaran-point.png') }}"
                                    alt="EditPenukaran Point icon"
                                    width="60"
                                    height="60">
                                <span class="item-label">Edit<br>Penukaran Poin</span>
                            </div>
                        </a>
                    @endif
            @if (
                App\Helpers\User::checkPermission('Transaksi Penjualan') ||
                App\Helpers\User::checkPermission('Transaksi Pembelian') ||
                App\Helpers\User::checkPermission('Transaksi Retur Penjualan') ||
                App\Helpers\User::checkPermission('Tambah Kas Tunai') ||
                App\Helpers\User::checkPermission('Edit Piutang') ||
                App\Helpers\User::checkPermission('Edit Hutang') ||
                App\Helpers\User::checkPermission('Tambah Bank Transfer') ||
                App\Helpers\User::checkPermission('Tambah Penukaran Point') ||
                App\Helpers\User::checkPermission('Edit Penukaran Point')
            )
                </section>
            @endif

            @if (
                App\Helpers\User::checkPermission('Laporan Saldo Tunai') ||
                App\Helpers\User::checkPermission('Laporan Saldo Bank') ||
                App\Helpers\User::checkPermission('Laporan Penjualan') ||
                App\Helpers\User::checkPermission('Laporan Pembelian') ||
                App\Helpers\User::checkPermission('Laporan Laba Rugi') ||
                App\Helpers\User::checkPermission('Laporan Barang Terlaku') ||
                App\Helpers\User::checkPermission('Laporan Kartu Stok')
            )
                <h1 class="color-primary header1 font-weight-700 mb-1">Laporan</h1>
                <section class="section-container mb-3">
            @endif
                @if (App\Helpers\User::checkPermission('Laporan Penjualan'))
                    <a href="{{ route('back.laporan.penjualan.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/laporan-penjualan.png') }}"
                                alt="Laporan Penjualan icon"
                                width="60"
                                height="60">
                            <span class="item-label">Laporan<br>Penjualan</span>
                        </div>
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Laporan Pembelian'))
                    <a href="{{ route('back.laporan.pembelian.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/laporan-pembelian.png') }}"
                                alt="Laporan Pembelian icon"
                                width="60"
                                height="60">
                            <span class="item-label">Laporan<br>Pembelian</span>
                        </div>
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Laporan Laba Rugi'))
                    <a href="{{ route('back.laporan.laporan-laba-rugi.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/laporan-laba-rugi.png') }}"
                                alt="Laporan Laba Rugi icon"
                                width="60"
                                height="60">
                            <span class="item-label">Laporan<br>Laba Rugi</span>
                        </div>
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Laporan Barang Terlaku'))
                    <a href="{{ route('back.laporan.laporan-barang-terlaku.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/laporan-barang-terlaku.png') }}"
                                alt="Laporan Barang Terlaku icon"
                                width="60"
                                height="60">
                            <span class="item-label">Laporan<br>Barang Terlaku</span>
                        </div>
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Laporan Saldo Tunai'))
                    <a href="{{ route('back.laporan.laporan-saldo-tunai.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/saldo-tunai.png') }}"
                                alt="Laporan Barang Terlaku icon"
                                width="60"
                                height="60">
                            <span class="item-label">Saldo<br>Tunai</span>
                        </div>
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Laporan Saldo Bank'))
                    <a href="{{ route('back.laporan.laporan-saldo-bank.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/saldo-bank.png') }}"
                                alt="Saldo Bank icon"
                                width="60"
                                height="60">
                            <span class="item-label">Saldo<br>Bank</span>
                        </div>
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Laporan Kartu Stok'))
                    <a href="{{ route('back.laporan.kartu-stok.index') }}" class="item-link">
                        <div class="item-container">
                            <img
                                class="item-icon"
                                src="{{ asset('back_assets/img/public/kartu-stok.png') }}"
                                alt="Kartu Stok icon"
                                width="60"
                                height="60">
                            <span class="item-label">Kartu<br>Stok</span>
                        </div>
                    </a>
                @endif
            @if (
                App\Helpers\User::checkPermission('Laporan Saldo Tunai') ||
                App\Helpers\User::checkPermission('Laporan Saldo Bank') ||
                App\Helpers\User::checkPermission('Laporan Penjualan') ||
                App\Helpers\User::checkPermission('Laporan Pembelian') ||
                App\Helpers\User::checkPermission('Laporan Laba Rugi') ||
                App\Helpers\User::checkPermission('Laporan Barang Terlaku') ||
                App\Helpers\User::checkPermission('Laporan Kartu Stok')
            )
                </section>
            @endif
        </div>
    </div>
</div>

{{-- Modal Default --}}
<div class="modal fade" id="modalPage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPageLabel" aria-hidden="true">
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

{{-- Modal Default --}}
<div class="modal fade" id="menuModalPage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="menuModalPageLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body p-5" id="menu-modal-body">
                ...
            </div>
        </div>
    </div>
</div>
{{-- End Modal Default --}}
@endsection

@push('js')
<script>
    $('body').on('click', '.btn-page', function () {
        event.preventDefault()
        let url = $(this).attr('href')
        let title = $(this).data('title')

        $('#modalPage').modal('show')
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

    $('body').on('click', '.menu-btn-page', function () {
        event.preventDefault()
        let url = $(this).attr('href')

        $('#menuModalPage').modal('show')
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success: function (html) {
                $('#menu-modal-body').html(html)
            }
        })
    })

    $('body').on('click', '#btn-save', function () {
        $('#form-validation').submit()
    })

    @if(session('permission'))
        let html = `
            <img class="marginB-4 d-block mx-auto" width="64px" height="64px" src="{{ asset('back_assets/img/public/info.png') }}" alt="Info">
            <h1 class="header1 color-primary font-weight-bold text-center marginB-4">Maaf, anda tidak bisa mengakses halaman ini</h1>
            <p class="body1 color-black font-weight-normal text-center marginB-4">Mohon untuk mengabari pihak admin untuk mendapatkan akses</p>
            <button type="button" class="btn btn-custom accent btn-block" data-dismiss="modal">Kembali</button>
        `

        $('#menuModalPage').modal('show')
        $('#menu-modal-body').html(html)
    @endif

    @if(session('limitTransaksi'))
        let html = `
            <img class="marginB-4 d-block mx-auto" width="64px" height="64px" src="{{ asset('back_assets/img/public/info.png') }}" alt="Info">
            <h1 class="header1 color-primary font-weight-bold text-center marginB-4">Transaksi anda sudah mencapai limit 20.000.000</h1>
            <p class="body1 color-black font-weight-normal text-center marginB-4">Untuk upgrade silahkan hubungi customer service kami</p>
            <button type="button" class="btn btn-custom accent btn-block" data-dismiss="modal">Kembali</button>
        `

        $('#menuModalPage').modal('show')
        $('#menu-modal-body').html(html)
    @endif
</script>
@endpush
