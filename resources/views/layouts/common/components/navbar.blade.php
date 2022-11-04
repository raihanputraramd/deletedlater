<nav class="navbar navbar-marketing navbar-expand-lg bg-transparent fixed-top">
    <div class="container">
        <a href="#">
            @if ($header !== null)
                <img
                    alt="Logo Efata"
                    class="img-fluid navbar-logo"
                    height="50"
                    src="{{ $header->logo() }}"
                    width="59"
                >
            @else
                <img
                    alt="Logo Efata"
                    class="img-fluid navbar-logo"
                    height="50"
                    src="{{ asset('front_assets/images/home/logo.svg') }}"
                    width="59"
                >
            @endif
        </a>

        <button
            class="navbar-toggler color-black"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto py-0">
                <li class="nav-item">
                    <a class="nav-link" href="#daftarProduk">Daftar Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimoni">Testimoni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#layoutDefault_footer">Hubungi Kami</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
