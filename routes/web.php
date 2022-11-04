<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('homepage');
});

Route::get('homepage', 'Front\HomeController@index')->name('homepage');

Route::prefix('admin')->group(function() {
    Route::namespace('Auth\Admin')->group(function() {
        Route::get('login', 'LoginController@index')->name('admin.login.index');
        Route::post('login', 'LoginController@authenticate')->name('admin.login');
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
    });

    Route::namespace('Back')->middleware(['auth:web'])->group(function () {
        Route::get('/', 'HomeController@index')->name('back.home.index');

        Route::namespace('MasterData')->prefix('master-data')->group(function () {
            Route::resource('barang', 'BarangController', ['as' => 'back.master-data'])->except(['show']);
            Route::post('barang/supplier', 'BarangController@getSupplier')->name('back.master-data.barang.supplier');
            route::get('barang/export', 'BarangController@exportExcel')->name('back.master-data.barang.export');
            route::get('barang/print-barcode', 'BarangController@printBarcode')->name('back.master-data.barang.print-barcode');

            Route::resource('satuan-barang', 'SatuanBarangController', ['as' => 'back.master-data']);

            Route::resource('supplier', 'SupplierController', ['as' => 'back.master-data'])->except(['show']);
            Route::get('supplier/print', 'SupplierController@pdf')->name('back.master-data.supplier.pdf');
            route::get('supplier/export', 'SupplierController@exportExcel')->name('back.master-data.supplier.export');

            Route::resource('pelanggan', 'PelangganController', ['as' => 'back.master-data'])->except(['show']);
            route::get('pelanggan/print', 'PelangganController@pdf')->name('back.master-data.pelanggan.pdf');
            route::get('pelanggan/export', 'PelangganController@exportExcel')->name('back.master-data.pelanggan.export');
        });

        Route::namespace('System')->prefix('system')->group(function () {
            Route::resource('users', 'UserController', ['as' => 'back.system'])->except(['show']);
            route::get('users/print', 'UserController@pdf')->name('back.system.users.pdf');
            route::get('users/export', 'UserController@exportExcel')->name('back.system.users.export');

            Route::resource('grup', 'GrupController', ['as' => 'back.system']);
            Route::resource('page-setup', 'PageSetupController', ['as' => 'back.system']);
            Route::resource('ganti-password', 'GantiPasswordController', ['as' => 'back.system']);
            Route::post('ganti-password/check', 'GantiPasswordController@checkPassword')->name('api.password.check');
            Route::resource('modul', 'ModulController', ['as' => 'back.system']);
            Route::resource('hak-akses-modul', 'HakAksesModulController', ['as' => 'back.system']);
            Route::resource('point', 'PointController', ['as' => 'back.system'])->only(['create', 'store']);
            Route::resource('limit-transaksi', 'LimitTransaksiController', ['as' => 'back.system'])->only(['create', 'store']);
            Route::resource('voucher', 'VoucherController', ['as' => 'back.system']);
            Route::resource('hapus-data-penjualan', 'HapusDataPenjualanController', ['as' => 'back.system']);
            Route::resource('hapus-data-pembeli', 'HapusDataPembeliController', ['as' => 'back.system']);
        });

        Route::namespace('Transaksi')->prefix('transaksi')->group(function () {
            Route::resource('penjualan', 'PenjualanController', ['as' => 'back.transaksi']);
            Route::get('penjualan/{id}/print', 'PenjualanController@print')->name('back.transaksi.penjualan.print');
            Route::get('penjualan/{id}/export', 'PenjualanController@exportExcel')->name('back.transaksi.penjualan.export');
            
            Route::resource('penukaran-point', 'PenukaranPointController', ['as' => 'back.transaksi'])->except(['show']);
            Route::get('penukaran-point/print', 'PenukaranPointController@pdf')->name('back.transaksi.penukaran-point.pdf');
            Route::get('penukaran-point/export', 'PenukaranPointController@exportExcel')->name('back.transaksi.penukaran-point.export');

            Route::resource('retur-penjualan', 'ReturPenjualanController', ['as' => 'back.transaksi']);
            Route::resource('pembelian', 'PembelianController', ['as' => 'back.transaksi']);
            Route::get('pembelian/{id}/print', 'PembelianController@print')->name('back.transaksi.pembelian.print');
            Route::get('pembelian/{id}/export', 'PembelianController@exportExcel')->name('back.transaksi.pembelian.export');

            Route::resource('bayar-piutang', 'BayarPiutangController', ['as' => 'back.transaksi'])->except(['show']);
            Route::get('bayar-piutang/print', 'BayarPiutangController@pdf')->name('back.transaksi.bayar-piutang.print');
            Route::get('bayar-piutang/export', 'BayarPiutangController@exportExcel')->name('back.transaksi.bayar-piutang.export');

            Route::resource('bayar-hutang', 'BayarHutangController', ['as' => 'back.transaksi'])->except(['show']);
            Route::get('bayar-hutang/print', 'BayarHutangController@pdf')->name('back.transaksi.bayar-hutang.print');
            Route::get('bayar-hutang/export', 'BayarHutangController@exportExcel')->name('back.transaksi.bayar-hutang.export');

            Route::resource('kas-tunai', 'KasTunaiController', ['as' => 'back.transaksi'])->except(['show']);
            Route::get('kas-tunai/print', 'KasTunaiController@pdf')->name('back.transaksi.kas-tunai.pdf');
            Route::get('kas-tunai/export', 'KasTunaiController@exportExcel')->name('back.transaksi.kas-tunai.export');

            Route::resource('bank-transfer', 'BankTransferController', ['as' => 'back.transaksi'])->except(['show']);
            Route::get('bank-transfer/print', 'BankTransferController@pdf')->name('back.transaksi.bank-transfer.pdf');
            Route::get('bank-transfer/export', 'BankTransferController@exportExcel')->name('back.transaksi.bank-transfer.export');
        });

        Route::namespace('Laporan')->prefix('laporan')->group(function () {
            route::resource('penjualan', 'LaporanPenjualanController', ['as' => 'back.laporan'])->only(['index']);
            Route::get('penjualan/print', 'LaporanPenjualanController@pdf')->name('back.laporan.penjualan.pdf');
            Route::get('penjualan/export', 'LaporanPenjualanController@exportExcel')->name('back.laporan.penjualan.export');
            
            route::resource('pembelian', 'LaporanPembelianController', ['as' => 'back.laporan'])->only(['index']);
            Route::get('pembelian/print', 'LaporanPembelianController@pdf')->name('back.laporan.pembelian.pdf');
            Route::get('pembelian/export', 'LaporanPembelianController@exportExcel')->name('back.laporan.pembelian.export');

            route::resource('laporan-laba-rugi', 'LaporanLabaRugiController', ['as' => 'back.laporan'])->except(['show']);
            route::get('laporan-laba-rugi/print', 'LaporanLabaRugiController@pdf')->name('back.laporan.laporan-laba-rugi.pdf');
            route::get('laporan-laba-rugi/export', 'LaporanLabaRugiController@exportExcel')->name('back.laporan.laporan-laba-rugi.export');

            route::resource('laporan-barang-terlaku', 'LaporanBarangTerlakuController', ['as' => 'back.laporan'])->except(['show']);
            route::get('laporan-barang-terlaku/print', 'LaporanBarangTerlakuController@pdf')->name('back.laporan.laporan-barang-terlaku.pdf');
            route::get('laporan-barang-terlaku/export', 'LaporanBarangTerlakuController@exportExcel')->name('back.laporan.laporan-barang-terlaku.export');

            route::resource('laporan-saldo-tunai', 'LaporanSaldoTunaiController', ['as' => 'back.laporan'])->except(['show']);
            Route::get('laporan-saldo-tunai/print', 'LaporanSaldoTunaiController@pdf')->name('back.laporan.laporan-saldo-tunai.pdf');
            route::get('laporan-saldo-tunai/export', 'LaporanSaldoTunaiController@exportExcel')->name('back.laporan.laporan-saldo-tunai.export');

            route::resource('laporan-saldo-bank', 'LaporanSaldoBankController', ['as' => 'back.laporan'])->except(['show']);
            Route::get('laporan-saldo-bank/print', 'LaporanSaldoBankController@pdf')->name('back.laporan.laporan-saldo-bank.pdf');
            Route::get('laporan-saldo-bank/export', 'LaporanSaldoBankController@exportExcel')->name('back.laporan.laporan-saldo-bank.export');
            
            route::resource('kartu-stok', 'KartuStokController', ['as' => 'back.laporan'])->except(['show']);
            Route::get('kartu-stok/print', 'KartuStokController@pdf')->name('back.laporan.kartu-stok.pdf');
            Route::get('kartu-stok/export', 'KartuStokController@exportExcel')->name('back.laporan.kartu-stok.export');
        });

        Route::namespace('Menu')->prefix('menu')->group(function() {
            Route::get('petunjuk', 'PetunjukController@index')->name('back.menu.petunjuk');
            Route::get('dibuat-oleh', 'DibuatOlehController@index')->name('back.menu.dibuat-oleh');
            Route::get('credit', 'CreditController@index')->name('back.menu.credit');
            Route::get('client', 'ClientController@index')->name('back.menu.client');
            Route::get('version-history', 'VersionHistoryController@index')->name('back.menu.version-history');
        });

        Route::namespace('CMS')->prefix('cms')->group(function () {
            Route::resource('header', 'HeaderController', ['as' => 'back.cms'])->only(['index', 'store']);
            Route::resource('keunggulan', 'KeunggulanController', ['as' => 'back.cms'])->only(['index', 'store']);
            Route::resource('keunggulan-produk', 'KeunggulanProdukController', ['as' => 'back.cms'])->only(['index', 'store']);
            Route::resource('galeri', 'GaleriController', ['as' => 'back.cms'])->except(['show']);
            Route::post('galeri/judul', 'GaleriController@storeJudulGaleri')->name('back.cms.galeri.judul.store');
            Route::resource('tentang-kami', 'TentangKamiController', ['as' => 'back.cms'])->only(['index', 'store']);
            Route::resource('alasan-membeli', 'AlasanMembeliController', ['as' => 'back.cms'])->only(['index', 'store']);
            Route::resource('testimoni', 'TestimoniController', ['as' => 'back.cms'])->except(['show']);
            Route::post('testimoni/judul', 'TestimoniController@storeJudulTestimoni')->name('back.cms.testimoni.judul.store');
            Route::resource('produk', 'ProdukController', ['as' => 'back.cms'])->except(['show']);
            Route::post('produk/judul', 'ProdukController@storeJudulProduk')->name('back.cms.produk.judul.store');
            Route::resource('footer', 'FooterController', ['as' => 'back.cms'])->only(['index', 'store']);
        });
    });
});

Route::prefix('api/v1')->group(function() {
    Route::namespace('Back')->prefix('admin')->middleware(['auth:web'])->group(function() {
        Route::namespace('CMS')->prefix('cms')->group(function() {
            Route::post('galeri', 'GaleriController@data')->name('api.back.cms.galeri');
            Route::post('testimoni', 'TestimoniController@data')->name('api.back.cms.testimoni');
            Route::post('produk', 'ProdukController@data')->name('api.back.cms.produk');
        });

        Route::namespace('MasterData')->prefix('master-data')->group(function () {
            Route::post('barang', 'BarangController@data')->name('api.back.master-data.barang');
            Route::post('satuan-barang', 'SatuanBarangController@data')->name('api.back.master-data.satuan-barang');
            Route::post('pelanggan', 'PelangganController@data')->name('api.back.master-data.pelanggan');
            Route::post('supplier', 'SupplierController@data')->name('api.back.master-data.supplier');
        });

        Route::namespace('System')->prefix('system')->group(function () {
            Route::post('users', 'UserController@data')->name('api.back.system.users');
            Route::post('grup', 'GrupController@data')->name('api.back.system.grup');
            Route::post('modul', 'ModulController@data')->name('api.back.system.modul');
            Route::post('voucher', 'VoucherController@data')->name('api.back.system.voucher');
            Route::post('hak-akses-modul', 'HakAksesModulController@data')->name('api.back.system.hak-akses-modul');
        });

        Route::namespace('Transaksi')->prefix('transaksi')->group(function () {
            Route::post('penukaran-point', 'PenukaranPointController@data')->name('api.back.transaksi.penukaran-point');
            Route::post('kas-tunai', 'KasTunaiController@data')->name('api.back.transaksi.kas-tunai');
            Route::post('bank-transfer', 'BankTransferController@data')->name('api.back.transaksi.bank-transfer');
            Route::post('bayar-piutang', 'BayarPiutangController@data')->name('api.back.transaksi.bayar-piutang');
            Route::post('bayar-piutang/total', 'BayarPiutangController@dataTotal')->name('api.back.transaksi.bayar-piutang.total');
            Route::post('bayar-hutang', 'BayarHutangController@data')->name('api.back.transaksi.bayar-hutang');
            Route::post('bayar-hutang/total', 'BayarHutangController@dataTotal')->name('api.back.transaksi.bayar-hutang.total');
        });

        Route::namespace('Laporan')->prefix('laporan')->group(function () {
            Route::post('penjualan', 'LaporanPenjualanController@data')->name('api.back.laporan.penjualan');
            Route::post('penjualan/total', 'LaporanPenjualanController@dataTotal')->name('api.back.laporan.penjualan.total');
            Route::post('pembelian', 'LaporanPembelianController@data')->name('api.back.laporan.pembelian');
            Route::post('pembelian/total', 'LaporanPembelianController@dataTotal')->name('api.back.laporan.pembelian.total');
            Route::post('saldo-tunai', 'LaporanSaldoTunaiController@data')->name('api.back.laporan.saldo-tunai');
            Route::post('saldo-tunai/total', 'LaporanSaldoTunaiController@dataTotal')->name('api.back.laporan.saldo-tunai.total');
            Route::post('bank-transfer', 'LaporanSaldoBankController@data')->name('api.back.laporan.bank-transfer');
            Route::post('bank-transfer/total', 'LaporanSaldoBankController@dataTotal')->name('api.back.laporan.bank-transfer.total');
            Route::post('kartu-stok', 'KartuStokController@data')->name('api.back.laporan.kartu-stok');
            Route::post('laporan-barang-terlaku', 'LaporanBarangTerlakuController@data')->name('api.back.laporan.laporan-barang-terlaku');
            Route::post('laporan-laba-rugi', 'LaporanLabaRugiController@data')->name('api.back.laporan.laporan-laba-rugi');
            Route::post('laporan-laba-rugi/total', 'LaporanLabaRugiController@dataTotal')->name('api.back.laporan.laporan-laba-rugi.total');
        });
    });

    Route::namespace('Api')->group(function () {
        Route::namespace('MasterData')->prefix('master-data')->group(function () {
            Route::get('pelanggan', 'PelangganController@getPelanggan')->name('api.master-data.pelanggan');
            Route::get('supplier', 'SupplierController@getSupplier')->name('api.master-data.supplier');
            Route::get('barang', 'BarangController@getBarang')->name('api.master-data.barang');
            Route::get('barang/{barangId}/{pelangganId}/{qty}/{hargaEdit?}', 'BarangController@getBarangPenjualan');
            Route::get('barang/{barangId}', 'BarangController@getBarangPembelian');
        });

        Route::namespace('Transaksi')->prefix('transaksi')->group(function () {
            Route::get('penjualan', 'PenjualanController@getFaktur');
            Route::get('penjualan/{total}/point', 'PenjualanController@calculatePoint');
            Route::get('penjualan/{kode}/voucher', 'PenjualanController@getVoucher');
        });
    });
});
