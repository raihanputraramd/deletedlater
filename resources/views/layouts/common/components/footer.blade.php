<footer class="footer">
    @if ($footer !== null)
        <div class="container px-3 px-md-5">
            <div class="row align-items-end mb-32">
                <div class="col-lg-9">
                    <h2 class="header-1 font-weight-400 color-white mb-3">Kontak Kami</h2>
                    <p class="body-1 font-weight-400 color-white mb-0">
                        {{ $footer->jam_buka }}
                    </p>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-3 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{  $footer->iconAlamat() }}"
                    alt="icon alamat">

                    <h3 class="header-2 color-white font-weight-700 mb-3">{{ $footer->judul_alamat }}</h3>
                    <address class="body-1 color-white font-weight-400 mb-0">
                        {{ $footer->alamat }}
                    </address>
                </div>

                <div class="col-md-3 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{ $footer->iconTelepon() }}"
                    alt="icon whatsapp">

                    <h3 class="header-2 color-white font-weight-700 mb-3">{{ $footer->judul_telepon }}</h3>
                    <address class="body-1 color-white font-weight-400 mb-0">
                        {{ $footer->telepon_1 }}
                        <br>
                        {{ $footer->telepon_2 }}
                    </address>
                </div>

                <div class="col-md-3 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{ $footer->iconEmail() }}"
                    alt="icon whatsapp">

                    <h3 class="header-2 color-white font-weight-700 mb-3">{{ $footer->judul_email }}</h3>
                    <address class="body-1 color-white font-weight-400 mb-0">
                        {{ $footer->email_1 }}<br>
                        {{ $footer->email_2 }}
                    </address>
                </div>

                <div class="col-md-3 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{ $footer->iconMarketplace() }}"
                    alt="icon whatsapp">

                    <h3 class="header-2 color-white font-weight-700 mb-3">{{ $footer->judul_marketplace }}</h3>
                    <a target="_blank" class="text-decoration-none body-1 font-weight-400 mb-0 d-block" style="width: fit-content; color: white !important" href="{{ $footer->marketplace_1_link }}">{{ $footer->marketplace_1_nama }}</a>
                    <a target="_blank" class="text-decoration-none body-1 font-weight-400 mb-0 d-block" style="width: fit-content; color: white !important" href="{{ $footer->marketplace_2_link }}">{{ $footer->marketplace_2_nama }}</a>
                    <a target="_blank" class="text-decoration-none body-1 font-weight-400 mb-0 d-block" style="width: fit-content; color: white !important" href="{{ $footer->marketplace_3_link }}">{{ $footer->marketplace_3_nama }}</a>
                </div>
            </div>

            <hr class="footer-divider">

            <div class="d-flex py-3 w-100 justify-content-between">
                <small class="body-2 color-white">© 2022 Ahlinyaweb. All rights reserved.</small>

                <div class="d-flex">
                    <a target="_blank" class="footer-social" href="{{ $footer->sosial_1_link }}" aria-label="sosmed link">
                        @if ($footer->sosial_1_gambar !== "footer-facebook.svg")
                            <img style="width: 16px; height: 16px; object-fit: contain;" src="{{ $footer->gambar($footer->sosial_1_gambar) }} " alt="...">
                        @else
                            <i class="fab fa-facebook-f color-white"></i>
                        @endif
                    </a>
                    <a target="_blank" class="footer-social" href="{{ $footer->sosial_2_link }}" aria-label="sosmed link">
                        @if ($footer->sosial_2_gambar !== "footer-youtube.svg")
                            <img style="width: 16px; height: 16px; object-fit: contain;" src="{{ $footer->gambar($footer->sosial_2_gambar) }} " alt="...">
                        @else
                            <i class="fab fa-youtube color-white"></i>
                        @endif
                    </a>
                    <a target="_blank" class="footer-social" href="{{ $footer->sosial_3_link }}" aria-label="sosmed link">
                        @if ($footer->sosial_3_gambar !== "footer-instagram.svg")
                            <img style="width: 16px; height: 16px; object-fit: contain;" src="{{ $footer->gambar($footer->sosial_3_gambar) }} " alt="...">
                        @else
                            <i class="fab fa-instagram color-white"></i>
                        @endif
                    </a>
                    <a target="_blank" class="footer-social" href="{{ $footer->sosial_4_link }}" aria-label="sosmed link">
                        @if ($footer->sosial_4_gambar !== "footer-tiktok.svg")
                            <img style="width: 16px; height: 16px; object-fit: contain;" src="{{ $footer->gambar($footer->sosial_4_gambar) }} " alt="...">
                        @else
                            <i class="fab fa-tiktok color-white"></i>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="container px-3 px-md-5">
            <div class="row align-items-end mb-32">
                <div class="col-lg-9">
                    <h2 class="header-1 font-weight-400 color-white mb-3">Kontak Kami</h2>
                    <p class="body-1 font-weight-400 color-white mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et velit interdum.
                    </p>
                </div>

                <div class="col-lg-3 mt-3 mt-lg-0">
                    <button class="btn btn-layout footer-btn">Hubungi Kami</button>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-4 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{ asset('front_assets/images/home/footer-ic-1.png') }}"
                    alt="icon alamat">

                    <h3 class="header-2 color-white font-weight-700 mb-3">Alamat</h3>
                    <address class="body-1 color-white font-weight-400 mb-0">
                        Jl. Traktor No.123, Cisaranten Kulon, Kec. Arcamanik, Kota Bandung, 42094
                    </address>
                </div>

                <div class="col-md-4 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{ asset('front_assets/images/home/footer-ic-2.png') }}"
                    alt="icon whatsapp">

                    <h3 class="header-2 color-white font-weight-700 mb-3">Ponsel</h3>
                    <address class="body-1 color-white font-weight-400 mb-0">
                        Kami Buka Setiap hari, jam 08:00 - 17:00<br>
                        0815-6210-381
                    </address>
                </div>

                <div class="col-md-4 mb-4 mb-lg-0">
                    <img
                    width="64"
                    height="64"
                    class="img-fluid footer-img mb-3"
                    src="{{ asset('front_assets/images/home/footer-ic-3.png') }}"
                    alt="icon whatsapp">

                    <h3 class="header-2 color-white font-weight-700 mb-3">Email</h3>
                    <address class="body-1 color-white font-weight-400 mb-0">
                        email1@gmail.com<br>
                        email2@gmail.com
                    </address>
                </div>
            </div>

            <hr class="footer-divider">

            <div class="d-flex py-3 w-100 justify-content-between">
                <small class="body-2 color-white">© 2022 Ahlinyaweb. All rights reserved.</small>

                <div class="d-flex">
                    <a class="footer-social" href="#" aria-label="facebook link">
                        <i class="fab fa-facebook-f color-white"></i>
                    </a>
                    <a class="footer-social" href="#" aria-label="twitter link">
                        <i class="fab fa-twitter color-white"></i>
                    </a>
                    <a class="footer-social" href="#" aria-label="instagram link">
                        <i class="fab fa-instagram color-white"></i>
                    </a>
                </div>
            </div>
        </div>
    @endif
</footer>
