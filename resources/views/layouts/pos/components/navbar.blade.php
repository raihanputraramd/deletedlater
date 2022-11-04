<nav class="navbar">
    <ul class="navbar-container">
        <li class="navbar-item navbar-link dropdown no-caret">
            <a
                class="navbar-link dropdown-toggle"
                href="{{ route('back.home.index') }}">
                Homepage
            </a>
        </li>

        @if (
                App\Helpers\User::checkPermission('Tambah Barang') ||
                App\Helpers\User::checkPermission('Edit Barang') ||
                App\Helpers\User::checkPermission('Tambah Pelanggan') ||
                App\Helpers\User::checkPermission('Edit Pelanggan') ||
                App\Helpers\User::checkPermission('Tambah Supplier') ||
                App\Helpers\User::checkPermission('Edit Supplier') ||
                App\Helpers\User::checkPermission('Tambah Satuan Barang') ||
                App\Helpers\User::checkPermission('Edit Satuan Barang')
            )
            <li class="navbar-item navbar-link dropdown no-caret">
                <a
                    class="navbar-link dropdown-toggle"
                    id="navbarDropdownDocs"
                    href="#!"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    Data Master
                </a>

                <div class="dropdown-menu dropdown-menu-left animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                    <div class="sidedown-container">
        @endif
                @if (App\Helpers\User::checkPermission('Tambah Pelanggan') || App\Helpers\User::checkPermission('Edit Pelanggan'))
                    <a
                        class="navbar-dropdown-link sidedown-button"
                        href="#"
                        >
                            Pelanggan
                    </a>

                    <div class="sidedown-content">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Pelanggan'))
                        <a
                            class="navbar-dropdown-link btn-page"
                            data-title="Tambah Pelanggan"
                            href="{{ route('back.master-data.pelanggan.create') }}"
                            >
                            Tambah Pelanggan Baru
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Pelanggan'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.master-data.pelanggan.index') }}"
                            >
                            Edit Pelanggan
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Pelanggan') || App\Helpers\User::checkPermission('Edit Pelanggan'))
                        </div>
                    </div>
                @endif

                @if (App\Helpers\User::checkPermission('Tambah Supplier') || App\Helpers\User::checkPermission('Edit Supplier'))
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#"
                            >
                                Supplier
                        </a>
                        <div class="sidedown-content">
                @endif
                        @if (App\Helpers\User::checkPermission('Tambah Supplier'))
                            <a
                                data-title="Tambah Supplier"
                                class="navbar-dropdown-link btn-page"
                                href="{{ route('back.master-data.supplier.create') }}"
                                >
                                Tambah Supplier Baru
                            </a>
                        @endif

                        @if (App\Helpers\User::checkPermission('Edit Supplier'))
                            <a
                                class="navbar-dropdown-link"
                                href="{{ route('back.master-data.supplier.index') }}"
                                >
                                Edit Supplier
                            </a>
                        @endif
                @if (App\Helpers\User::checkPermission('Tambah Supplier') || App\Helpers\User::checkPermission('Edit Supplier'))
                        </div>
                    </div>
                @endif

                @if (
                    App\Helpers\User::checkPermission('Tambah Barang') ||
                    App\Helpers\User::checkPermission('Edit Barang') ||
                    App\Helpers\User::checkPermission('Tambah Satuan Barang') ||
                    App\Helpers\User::checkPermission('Edit Satuan Barang')
                )
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#!"
                            >
                                Barang
                        </a>

                        <div class="sidedown-content">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Barang'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.master-data.barang.create') }}"
                            >
                            Tambah Barang Baru
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Barang'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.master-data.barang.index') }}"
                            >
                            Edit Barang
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Tambah Satuan Barang'))
                        <a
                            class="navbar-dropdown-link btn-page"
                            data-title="Tambah Satuan Barang"
                            href="{{ route('back.master-data.satuan-barang.create') }}"
                            >
                            Tambah Satuan Barang
                        </a>
                    @endif

                    @if (App\Helpers\User::checkPermission('Edit Satuan Barang'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.master-data.satuan-barang.index') }}"
                            >
                            Edit Satuan Barang
                        </a>
                    @endif
                @if (
                    App\Helpers\User::checkPermission('Tambah Barang') ||
                    App\Helpers\User::checkPermission('Edit Barang') ||
                    App\Helpers\User::checkPermission('Tambah Satuan Barang') ||
                    App\Helpers\User::checkPermission('Edit Satuan Barang')
                )
                    </div>
                @endif
        @if (
            App\Helpers\User::checkPermission('Tambah Barang') ||
            App\Helpers\User::checkPermission('Edit Barang') ||
            App\Helpers\User::checkPermission('Tambah Pelanggan') ||
            App\Helpers\User::checkPermission('Edit Pelanggan') ||
            App\Helpers\User::checkPermission('Tambah Supplier') ||
            App\Helpers\User::checkPermission('Edit Supplier') ||
            App\Helpers\User::checkPermission('Tambah Satuan Barang') ||
            App\Helpers\User::checkPermission('Edit Satuan Barang')
        )
                    </div>
                </div>
            </li>
        @endif

        @if (
            App\Helpers\User::checkPermission('Transaksi Penjualan') ||
            App\Helpers\User::checkPermission('Transaksi Pembelian') ||
            App\Helpers\User::checkPermission('Transaksi Retur Penjualan') ||
            App\Helpers\User::checkPermission('Tambah Kas Tunai') ||
            App\Helpers\User::checkPermission('Edit Kas Tunai') ||
            App\Helpers\User::checkPermission('Edit Piutang') ||
            App\Helpers\User::checkPermission('Edit Hutang') ||
            App\Helpers\User::checkPermission('Tambah Bank Transfer') ||
            App\Helpers\User::checkPermission('Edit Bank Transfer') ||
            App\Helpers\User::checkPermission('Tambah Penukaran Point') ||
            App\Helpers\User::checkPermission('Edit Penukaran Point')
        )
            <li class="navbar-item navbar-link dropdown no-caret">
                <a
                    class="navbar-link dropdown-toggle"
                    id="navbarDropdownDocs"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    Transaksi
                </a>

                <div class="dropdown-menu dropdown-menu-left animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
        @endif
            @if (App\Helpers\User::checkPermission('Edit Piutang'))
                <a
                    class="navbar-dropdown-link"
                    href="{{ route('back.transaksi.bayar-piutang.index') }}"
                    >
                        Pelunasan Piutang
                </a>
            @endif

            @if (App\Helpers\User::checkPermission('Edit Hutang'))
                <a
                    class="navbar-dropdown-link"
                    href="{{ route('back.transaksi.bayar-hutang.index') }}"
                    >
                        Pelunasan Hutang
                </a>
            @endif

            @if (App\Helpers\User::checkPermission('Tambah Penukaran Point') || App\Helpers\User::checkPermission('Edit Penukaran Point'))
                <div class="sidedown-container">
                    <a
                        class="navbar-dropdown-link sidedown-button"
                        href="#"
                        >
                            Penukaran Poin
                    </a>
                    <div class="sidedown-content">
            @endif
                    @if (App\Helpers\User::checkPermission('Tambah Penukaran Point'))
                        <a
                            data-title="Penukaran Poin"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.transaksi.penukaran-point.create') }}"
                            >
                                Tambah Penukaran Poin
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Penukaran Point'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.transaksi.penukaran-point.index') }}"
                            >
                                Edit Penukaran Poin
                        </a>
                    @endif
            @if (App\Helpers\User::checkPermission('Tambah Penukaran Point') || App\Helpers\User::checkPermission('Edit Penukaran Point'))
                    </div>
                </div>
            @endif

            @if (App\Helpers\User::checkPermission('Tambah Bank Transfer') || App\Helpers\User::checkPermission('Edit Bank Transfer'))
                <div class="sidedown-container">
                    <a
                        class="navbar-dropdown-link sidedown-button"
                        href="#">
                            Bank Transfer
                    </a>

                    <div class="sidedown-content">
            @endif
                    @if (App\Helpers\User::checkPermission('Tambah Bank Transfer'))
                        <a
                            class="navbar-dropdown-link btn-page"
                            data-title="Bank Transfer"
                            href="{{ route('back.transaksi.bank-transfer.create') }}"
                            >
                                Tambah Bank Transfer
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Bank Transfer'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.transaksi.bank-transfer.index') }}"
                            >
                                Edit Bank Transfer
                        </a>
                    @endif
            @if (App\Helpers\User::checkPermission('Tambah Bank Transfer') || App\Helpers\User::checkPermission('Edit Bank Transfer'))
                    </div>
                </div>
            @endif

            @if (App\Helpers\User::checkPermission('Transaksi Retur Penjualan'))
                <a
                    class="navbar-dropdown-link"
                    href="{{ route('back.transaksi.retur-penjualan.create') }}">
                    Retur Penjualan
                </a>
            @endif


            @if (App\Helpers\User::checkPermission('Tambah Kas Tunai') || App\Helpers\User::checkPermission('Edit Kas Tunai'))
                <div class="sidedown-container">
                    <a
                        class="navbar-dropdown-link sidedown-button"
                        href="#">
                            Kas Tunai
                    </a>
                    <div class="sidedown-content">
            @endif
                    @if (App\Helpers\User::checkPermission('Tambah Kas Tunai'))
                        <a
                            class="navbar-dropdown-link btn-page"
                            data-title="Kas Tunai Masuk / Keluar"
                            href="{{ route('back.transaksi.kas-tunai.create') }}">
                                Tambah Kas Tunai
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Kas Tunai'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.transaksi.kas-tunai.index') }}"
                            >
                                Edit Kas Tunai
                        </a>
                    @endif
            @if (App\Helpers\User::checkPermission('Tambah Kas Tunai') || App\Helpers\User::checkPermission('Edit Kas Tunai'))
                    </div>
                </div>
            @endif

            @if (App\Helpers\User::checkPermission('Transaksi Penjualan'))
                <a
                    class="navbar-dropdown-link"
                    href="{{ route('back.transaksi.penjualan.create') }}">
                        Penjualan
                </a>
            @endif

            @if (App\Helpers\User::checkPermission('Transaksi Pembelian'))
                <a
                    class="navbar-dropdown-link"
                    href="{{ route('back.transaksi.pembelian.create') }}">
                        Pembelian
                </a>
            @endif

            @if (App\Helpers\User::checkPermission('Hapus Penjualan') || App\Helpers\User::checkPermission('Hapus Pembelian'))
                <div class="sidedown-container">
                    <a
                        class="navbar-dropdown-link sidedown-button"
                        href="#">
                            Hapus
                    </a>

                    <div class="sidedown-content">
            @endif
                    @if (App\Helpers\User::checkPermission('Hapus Penjualan'))
                        <a
                            data-title="Hapus Data Penjualan"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.hapus-data-penjualan.create') }}"
                            >
                                Hapus Data Penjualan
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Hapus Pembelian'))
                        <a
                            data-title="Hapus Data Pembelian"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.hapus-data-pembeli.create') }}"
                            >
                                Hapus Data Pembelian
                        </a>
                    @endif
            @if (App\Helpers\User::checkPermission('Hapus Penjualan') || App\Helpers\User::checkPermission('Hapus Pembelian'))
                    </div>
                </div>
            @endif
        @if (
            App\Helpers\User::checkPermission('Transaksi Penjualan') ||
            App\Helpers\User::checkPermission('Transaksi Pembelian') ||
            App\Helpers\User::checkPermission('Transaksi Retur Penjualan') ||
            App\Helpers\User::checkPermission('Tambah Kas Tunai') ||
            App\Helpers\User::checkPermission('Edit Kas Tunai') ||
            App\Helpers\User::checkPermission('Edit Piutang') ||
            App\Helpers\User::checkPermission('Edit Hutang') ||
            App\Helpers\User::checkPermission('Tambah Bank Transfer') ||
            App\Helpers\User::checkPermission('Edit Bank Transfer') ||
            App\Helpers\User::checkPermission('Tambah Penukaran Point') ||
            App\Helpers\User::checkPermission('Edit Penukaran Point')
        )
                </div>
            </li>
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
            <li class="navbar-item navbar-link dropdown no-caret">
                <a
                    class="navbar-link dropdown-toggle"
                    id="navbarDropdownDocs"
                    href="#"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false">
                    Laporan
                </a>

                <div class="dropdown-menu dropdown-menu-left animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
        @endif
                @if (App\Helpers\User::checkPermission('Laporan Penjualan'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.penjualan.index') }}"
                        >
                            Laporan Penjualan
                    </a>
                @endif
                @if (App\Helpers\User::checkPermission('Laporan Pembelian'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.pembelian.index') }}"
                        >
                            Laporan Pembelian
                    </a>
                @endif
                @if (App\Helpers\User::checkPermission('Laporan Laba Rugi'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.laporan-laba-rugi.index') }}"
                        >
                            Laporan Laba Rugi
                    </a>
                @endif
                @if (App\Helpers\User::checkPermission('Laporan Barang Terlaku'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.laporan-barang-terlaku.index') }}"
                        >
                            Laporan Barang Terlaku
                    </a>
                @endif
                @if (App\Helpers\User::checkPermission('Laporan Saldo Tunai'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.laporan-saldo-tunai.index') }}"
                        >
                            Saldo Tunai
                    </a>
                @endif
                @if (App\Helpers\User::checkPermission('Laporan Saldo Bank'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.laporan-saldo-bank.index') }}"
                        >
                            Saldo Bank
                    </a>
                @endif
                @if (App\Helpers\User::checkPermission('Laporan Kartu Stok'))
                    <a
                        class="navbar-dropdown-link"
                        href="{{ route('back.laporan.kartu-stok.index') }}"
                        >
                            Kartu Stok
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
                </div>
            </li>
        @endif

        <li class="navbar-item navbar-link dropdown no-caret">
            <a
                class="navbar-link dropdown-toggle"
                id="navbarDropdownDocs"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                Pengaturan
            </a>

            <div class="dropdown-menu dropdown-menu-left animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                @if (App\Helpers\User::checkPermission('Tambah Hak Akses Modul') || App\Helpers\User::checkPermission('Edit Hak Akses Modul'))
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#"
                            >
                            Hak Akses Modul
                        </a>
                        <div class="sidedown-content">
                @endif

                    @if (App\Helpers\User::checkPermission('Tambah Hak Akses Modul'))
                        <a
                            data-title="Tambah Hak Akses Modul"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.hak-akses-modul.create') }}"
                            >
                                Tambah Hak Akses Modul
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Hak Akses Modul'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.system.hak-akses-modul.index') }}"
                            >
                                Edit Hak Akses Modul
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Hak Akses Modul') || App\Helpers\User::checkPermission('Edit Hak Akses Modul'))
                        </div>
                    </div>
                @endif

                <a
                    data-title="Ganti Password"
                    class="navbar-dropdown-link btn-page"
                    href="{{ route('back.system.ganti-password.create') }}">
                        Ganti Password
                </a>

                @if (App\Helpers\User::checkPermission('Transaksi Point'))
                    <a
                        data-title="Setting Transaksi Point"
                        class="navbar-dropdown-link btn-page"
                        href="{{ route('back.system.point.create') }}">
                            Setting Point
                    </a>
                @endif

                @if (auth()->user()->nama == "Superadmin Ahlinyaweb")
                    <a
                        data-title="Setting Transaksi Point"
                        class="navbar-dropdown-link btn-page"
                        href="{{ route('back.system.limit-transaksi.create') }}">
                            Setting Limit Transaksi
                    </a>
                @endif

                @if (App\Helpers\User::checkPermission('Tambah Voucher') || App\Helpers\User::checkPermission('Edit Voucher'))
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#">
                            Voucher
                        </a>
                        <div class="sidedown-content">
                @endif

                    @if (App\Helpers\User::checkPermission('Tambah Voucher'))
                        <a
                            data-title="Tambah Voucher"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.voucher.create') }}">
                                Tambah Voucher
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Voucher'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.system.voucher.index') }}">
                                Edit Voucher
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Voucher') || App\Helpers\User::checkPermission('Edit Voucher'))
                        </div>
                    </div>
                @endif

                {{-- @if (App\Helpers\User::checkPermission('Page Setup'))
                    <a
                        data-title="Pengaturan Kertas"
                        class="navbar-dropdown-link btn-page"
                        href="{{ route('back.system.page-setup.create') }}">
                            Page Setup
                    </a>
                @endif --}}

                @if (App\Helpers\User::checkPermission('Tambah Modul') || App\Helpers\User::checkPermission('Edit Modul'))
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#"
                            >
                            Modul
                        </a>

                        <div class="sidedown-content">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Modul'))
                        <a
                            data-title="Tambah Modul"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.modul.create') }}"
                            >
                                Tambah Modul Baru
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Modul'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.system.modul.index') }}"
                            >
                                Edit Modul
                        </a>
                    @endif
                @if (App\Helpers\User::checkPermission('Tambah Modul') || App\Helpers\User::checkPermission('Edit Modul'))
                        </div>
                    </div>
                @endif

                @if (
                    App\Helpers\User::checkPermission('Tambah Grup') ||
                    App\Helpers\User::checkPermission('Edit Grup')
                )
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#"
                            >
                            Grup
                        </a>

                        <div class="sidedown-content">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah Grup'))
                        <a
                            data-title="Tambah Grup User"
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.grup.create') }}"
                            >
                                Tambah Grup Baru
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Edit Grup'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.system.grup.index') }}"
                            >
                                Edit Grup
                        </a>
                    @endif
                @if (
                    App\Helpers\User::checkPermission('Tambah Grup') ||
                    App\Helpers\User::checkPermission('Edit Grup')
                )
                        </div>
                    </div>
                @endif

                @if (
                    App\Helpers\User::checkPermission('Tambah User') ||
                    App\Helpers\User::checkPermission('Edit User')
                )
                    <div class="sidedown-container">
                        <a
                            class="navbar-dropdown-link sidedown-button"
                            href="#">
                            User
                        </a>

                        <div class="sidedown-content">
                @endif
                    @if (App\Helpers\User::checkPermission('Tambah User'))
                        <a
                            class="navbar-dropdown-link btn-page"
                            href="{{ route('back.system.users.create') }}"

                            data-title="Tambah User">
                                Tambah User Baru
                        </a>
                    @endif
                    @if (App\Helpers\User::checkPermission('Tambah User'))
                        <a
                            class="navbar-dropdown-link"
                            href="{{ route('back.system.users.index') }}"
                            >
                                Edit User
                        </a>
                    @endif
                @if (
                    App\Helpers\User::checkPermission('Tambah User') ||
                    App\Helpers\User::checkPermission('Edit User')
                )
                        </div>
                    </div>
                @endif
            </div>
        </li>
    </ul>

    <ul class="navbar-container">
        <li class="navbar-item navbar-link dropdown no-caret">
            <a
                class="navbar-link dropdown-toggle"
                id="navbarDropdownDocs"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                Menu Utama
            </a>

            <div class="dropdown-menu dropdown-menu-left animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                <a
                    class="navbar-dropdown-link menu-btn-page"
                    href="{{ route('back.menu.petunjuk') }}">
                        Petunjuk
                </a>
                <a
                    class="navbar-dropdown-link menu-btn-page"
                    href="{{ route('back.menu.dibuat-oleh') }}">
                        About
                </a>
                {{-- <a
                    class="navbar-dropdown-link menu-btn-page"
                    href="{{ route('back.menu.credit') }}">
                        Credits
                </a> --}}
                <a
                    class="navbar-dropdown-link menu-btn-page"
                    href="{{ route('back.menu.client') }}">
                        Clients
                </a>
                {{-- <a
                    class="navbar-dropdown-link menu-btn-page"
                    href="{{ route('back.menu.version-history') }}">
                        Version History
                </a> --}}
            </div>
        </li>

        <li class="navbar-item navbar-link dropdown no-caret">
            <a
                class="navbar-link dropdown-toggle"
                id="navbarDropdownDocs"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

@push('js')
<script>
    var toggler = document.getElementsByClassName("caret");
    var i;

    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
    }
</script>
@endpush
