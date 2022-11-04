@extends('layouts.common.app')

@section('content')
<div class="bg-top">
    @include('layouts.common.components.navbar')

    <header class="page-header" id="header">
        <div class="header-container">
            <div class="container px-3 px-md-5">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-6 order-2 order-md-1">
                        <h1 class="header-title">{{ $header !== null ? $header->judul : 'Bermain Tanpa Batas' }}</h1>
                        <p class="body-1 font-weight-400 color-grey mb-32">
                            @if ($header !== null)
                                {{ $header->deskripsi }}
                            @else
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                                vulputate libero et velit interdum, ac aliquet odio mattis. Class
                                aptent taciti sociosqu ad litora torquent per.
                            @endif
                        </p>
                        <button class="btn btn-layout">Hubungi Kami</button>
                    </div>

                    <div class="col-md-6 col-lg-5 offset-lg-1 order-1 order-md-2">
                        @if ($header !== null)
                            <img
                                class="img-fluid header-img"
                                width="404"
                                height="500"
                                src="{{ $header->gambar() }}"
                                alt="Gambar PS">
                        @else
                            <img
                                class="img-fluid header-img"
                                width="404"
                                height="500"
                                src="{{ asset('front_assets/images/home/header-img.png') }}"
                                alt="Gambar PS">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>

<section id="keunggulanProduk">
    <div class="container px-3 px-md-5">
        <div class="kepro-container">
            <div class="row justify-content-center mb-32">
                <div class="col-lg-8">
                    <h2 class="header-1 font-weight-400 color-black mb-3 text-center">{{ $keunggulan !== null ? $keunggulan->judul : 'Keunggulan Ahlinya Toko Playstation' }}</h2>
                    <p class="body-1 font-weight-400 color-grey mb-0 text-center">
                        @if ($keunggulan !== null)
                            {{ $keunggulan->deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et
                            velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad litora torquent.
                        @endif
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="kepro-item-container red">
                        <div class="kepro-item-number">
                            <span class="header-2 font-weight-700">01</span>
                        </div>

                        <h3 class="header-2 font-weight-400 text-center kepro-item-title">{{ $keunggulan !== null ? $keunggulan->keunggulan_1_judul : 'Original' }}</h3>
                        <p class="body-2 font-weight-400 text-center kepro-item-desc">
                            @if ($keunggulan !== null)
                                {{ $keunggulan->keunggulan_1_deskripsi }}
                            @else
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc vulputate libero et velit interdum.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="kepro-item-container blue">
                        <div class="kepro-item-number">
                            <span class="header-2 font-weight-700">02</span>
                        </div>

                        <h3 class="header-2 font-weight-400 text-center kepro-item-title">{{ $keunggulan !== null ? $keunggulan->keunggulan_2_judul : 'Berkualitas' }}</h3>
                        <p class="body-2 font-weight-400 text-center kepro-item-desc">
                            @if ($keunggulan !== null)
                                {{ $keunggulan->keunggulan_2_deskripsi }}
                            @else
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc vulputate libero et velit interdum.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="kepro-item-container green">
                        <div class="kepro-item-number">
                            <span class="header-2 font-weight-700">03</span>
                        </div>

                        <h3 class="header-2 font-weight-400 text-center kepro-item-title">{{ $keunggulan !== null ? $keunggulan->keunggulan_3_judul : 'Garansi' }}</h3>
                        <p class="body-2 font-weight-400 text-center kepro-item-desc">
                            @if ($keunggulan !== null)
                                {{ $keunggulan->keunggulan_3_deskripsi }}
                            @else
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc vulputate libero et velit interdum.
                            @endif
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="kepro-item-container yellow">
                        <div class="kepro-item-number">
                            <span class="header-2 font-weight-700">04</span>
                        </div>

                        <h3 class="header-2 font-weight-400 text-center kepro-item-title">{{ $keunggulan !== null ? $keunggulan->keunggulan_4_judul : 'Aman' }}</h3>
                        <p class="body-2 font-weight-400 text-center kepro-item-desc">
                            @if ($keunggulan !== null)
                                {{ $keunggulan->keunggulan_4_deskripsi }}
                            @else
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc vulputate libero et velit interdum.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="keunggulanPerusahaan">
    <div class="container px-3 px-md-5">
        <div class="keper-container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    @if ($keunggulanProduk !== null)
                        <img
                            class="img-fluid keper-img"
                            src="{{ $keunggulanProduk->gambar() }}"
                            alt="Keunggulan produk image"
                            width="397"
                            height="533">
                    @else
                        <img
                            class="img-fluid keper-img"
                            src="{{ asset('front_assets/images/home/keper-img.png') }}"
                            alt="Keunggulan produk image"
                            width="397"
                            height="533">
                    @endif
                </div>

                <div class="col-lg-7">
                    <h2 class="header-1 font-weight-400 color-black mb-32">{{ $keunggulanProduk !== null ? $keunggulanProduk->judul : 'Keunggulan Produk Di Ahlinya Toko PlayStation' }}</h2>

                    <h3 class="header-2 font-weight-700 color-black mb-2">{{ $keunggulanProduk !== null ? $keunggulanProduk->keunggulan_1_judul : 'Langsung Dari Amerika' }}</h3>
                    <p class="body-1 font-weight-400 color-grey mb-32">
                        @if ($keunggulanProduk !== null)
                            {{ $keunggulanProduk->keunggulan_1_deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et
                            velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad
                            litora torquent per conubia nostra, per inceptos himenaeos.
                        @endif
                    </p>

                    <h3 class="header-2 font-weight-700 color-black mb-2">{{ $keunggulanProduk !== null ? $keunggulanProduk->keunggulan_2_judul : 'Distributor Berlisensi Asli' }}</h3>
                    <p class="body-1 font-weight-400 color-grey mb-32">
                        @if ($keunggulanProduk !== null)
                            {{ $keunggulanProduk->keunggulan_2_deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et
                            velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad
                            litora torquent per conubia nostra, per inceptos himenaeos.
                        @endif
                    </p>

                    <h3 class="header-2 font-weight-700 color-black mb-2">{{ $keunggulanProduk !== null ? $keunggulanProduk->keunggulan_3_judul : 'Garansi Resmi Dari Sony PlayStation' }}</h3>
                    <p class="body-1 font-weight-400 color-grey mb-0">
                        @if ($keunggulanProduk !== null)
                            {{ $keunggulanProduk->keunggulan_3_deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate libero et
                            velit interdum, ac aliquet odio mattis. Class aptent taciti sociosqu ad
                            litora torquent per conubia nostra, per inceptos himenaeos.
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

<section id="gambarProses">
    <div class="container px-3 px-md-5">
        <div class="gapro-container">
            <div class="row justify-content-center mb-32">
                <div class="col-lg-6">
                    <h2 class="header-1 font-weight-400 color-black mb-3 text-center">{{ $galeriJudul !== null ? $galeriJudul->judul : 'Galeri PlayStation Toko Kami' }}</h2>
                    <p class="body-1 font-weight-400 color-grey mb-3 text-center">
                        @if ($galeriJudul !== null)
                            {{ $galeriJudul->deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Nunc vulputate libero et velit interdum, ac aliquet odio.
                        @endif
                    </p>
                    <button class="btn btn-layout mx-auto d-block">Hubungi Kami</button>
                </div>
            </div>

            <div class="position-relative">
                <div class="gapro-button-container">
                    <button class="btn header-carousel-prev">
                        <img
                        class="mr-1"
                        width="26"
                        height="26"
                        src="{{ asset('front_assets/images/home/carousel-prev.png') }}"
                        alt="carousel prev">
                    </button>
                    <button class="btn header-carousel-next">
                        <img
                        class="ml-1"
                        width="26"
                        height="26"
                        src="{{ asset('front_assets/images/home/carousel-next.png') }}"
                        alt="carousel next">
                    </button>
                </div>

                <div class="gapro-carousel">
                    @foreach ($galeri as $item)
                        <div>
                            <img
                            class="gapro-img img-fluid"
                            width="658"
                            height="340"
                            src="{{ $item->gambar() }}"
                            alt="{{ $item->nama }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tentangKami">
    <div class="container px-3 px-lg-5">
        <div class="teka-container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="header-1 font-weight-400 color-white text-center mb-3">{{ $tentangKami !== null ? $tentangKami->judul : 'Tentang Kami, Ahlinya Toko Playstation' }}</h2>
                    <p class="body1 font-weight-400 color-white text-center mb-32">
                        @if ($tentangKami !== null)
                            {{ $tentangKami->deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum
                            est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin
                            lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum
                            <br>
                            <br>
                            velit, sit amet feugiat lectus. Class aptent taciti sociosqu ad litora torquent per
                            conubia nostra, per inceptos himenaeos. Praesent auctor purus luctus enim egestas,
                            ac scelerisque ante pulvinar. Donec ut rhoncus ex. Suspendisse ac rhoncus nisl, eu tempor
                            urna. Curabitur vel bibendum lorem. Morbi convallis convallis diam sit amet lacinia. Aliquam in elementum tellus.
                        @endif
                    </p>

                    <a href="#" class="text-decoration-none btn btn-layout d-block mx-auto">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="kenapaHarusBeliKepadaKami">
    <div class="container px-3 px-md-5">
        <div class="keha-container">
            <h2 class="header-1 color-black font-weight-400 mb-3">{{ $alasanMembeli !== null ? $alasanMembeli->judul : 'Alasan Membeli Kepada Kami' }}</h2>

            <div class="row">
                <div class="col-lg-6">
                    <p class="body-1 color-grey font-weight-400 mb-0">
                        @if ($alasanMembeli !== null)
                            {{ $alasanMembeli->deskripsi }}
                        @else
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Nunc vulputate libero et velit interdum, ac aliquet odio.
                        @endif
                    </p>
                </div>
            </div>

            <div class="row keha-items">
                <div class="col-md-6 mb-5">
                    <div class="position-relative h-100">
                        <div class="keha-icon-container red">
                            <img
                            width="26"
                            height="26"
                            src="{{ asset('front_assets/images/home/keha-ic-1.png') }}"
                            alt="icon red">
                        </div>
                        <div class="keha-card-container">
                            @if ($alasanMembeli !== null)
                                <h3 class="header-2 font-weight-700 color-black mb-2">{{ $alasanMembeli->alasan_1_judul }}</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    {{ $alasanMembeli->alasan_1_deskripsi }}
                                </p>
                            @else
                                <h3 class="header-2 font-weight-700 color-black mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-5">
                    <div class="position-relative h-100">
                        <div class="keha-icon-container blue">
                            <img
                            width="26"
                            height="26"
                            src="{{ asset('front_assets/images/home/keha-ic-2.png') }}"
                            alt="icon blue">
                        </div>
                        <div class="keha-card-container">
                            @if ($alasanMembeli !== null)
                                <h3 class="header-2 font-weight-700 color-black mb-2">{{ $alasanMembeli->alasan_2_judul }}</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    {{ $alasanMembeli->alasan_2_deskripsi }}
                                </p>
                            @else
                                <h3 class="header-2 font-weight-700 color-black mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-5 mb-md-0">
                    <div class="position-relative h-100">
                        <div class="keha-icon-container green">
                            <img
                            width="26"
                            height="26"
                            src="{{ asset('front_assets/images/home/keha-ic-3.png') }}"
                            alt="icon green">
                        </div>
                        <div class="keha-card-container">
                            @if ($alasanMembeli !== null)
                                <h3 class="header-2 font-weight-700 color-black mb-2">{{ $alasanMembeli->alasan_3_judul }}</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    {{ $alasanMembeli->alasan_3_deskripsi }}
                                </p>
                            @else
                                <h3 class="header-2 font-weight-700 color-black mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="position-relative h-100">
                        <div class="keha-icon-container yellow">
                            <img
                            width="26"
                            height="26"
                            src="{{ asset('front_assets/images/home/keha-ic-4.png') }}"
                            alt="icon yellow">
                        </div>
                        <div class="keha-card-container">
                            @if ($alasanMembeli !== null)
                                <h3 class="header-2 font-weight-700 color-black mb-2">{{ $alasanMembeli->alasan_4_judul }}</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    {{ $alasanMembeli->alasan_4_deskripsi }}
                                </p>
                            @else
                                <h3 class="header-2 font-weight-700 color-black mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>
                                <p class="body-1 font-weight-400 color-grey mb-0">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Nunc vulputate libero et velit interdum, ac aliquet odio mattis.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="testimoni">
    <div class="container px-3 px-md-5">
        <div class="testimoni-container">
            <div class="row align-items-center">
                <img
                class="img-fluid testimoni-vector left"
                src="{{ asset('front_assets/images/home/testimoni-vector-left.png') }}"
                alt="testimoni-vector"
                width="231"
                height="82">

                <img
                class="img-fluid testimoni-vector right"
                src="{{ asset('front_assets/images/home/testimoni-vector-right.png') }}"
                alt="testimoni-vector"
                width="231"
                height="82">

                <div class="col-lg-9">
                    <h2 class="header-1 color-black font-weight-400 mb-32">{{ $testimoniJudul !== null ? $testimoniJudul->judul : 'Testimonial Pelanggan Setia Kami' }}</h2>
                    <div class="testimoni-carousel">
                        @foreach ($testimoni as $item)
                            <div>
                                <p class="body-1 color-grey font-weight-400 mb-0">
                                    {{ $item->deskripsi }}
                                </p>

                                <hr class="testimoni-divider">

                                <div class="d-flex align-items-center">
                                    <img
                                    width="48"
                                    height="48"
                                    class="testimoni-profile mr-2"
                                    src="{{ $item->gambar() }}"
                                    alt="profile picture putra">

                                    <div class="d-block">
                                        <h3 class="body-2 color-black font-weight-700 mb-1">{{ $item->nama }}</h3>
                                        <span class="body-2 color-grey font-weight-400 mb-0">{{ $item->pekerja }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-3 mt-4 mt-lg-0">
                    <div class="d-flex justify-content-center align-items-center">
                        <button class="btn testimoni-carousel-prev mr-3">
                            <img
                            class="mr-1"
                            width="26"
                            height="26"
                            src="{{ asset('front_assets/images/home/carousel-prev.png') }}"
                            alt="carousel prev">
                        </button>
                        <button class="btn testimoni-carousel-next ml-3">
                            <img
                            class="ml-1"
                            width="26"
                            height="26"
                            src="{{ asset('front_assets/images/home/carousel-next.png') }}"
                            alt="carousel next">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="daftarProduk">
    <div class="container px-3 px-md-5">
        <div class="dapro-container">
            <h2 class="header-1 font-weight-400 color-black text-center mb-32">{{ $produkJudul !== null ? $produkJudul->judul : 'Daftar Produk Kami'}}</h2>

            <div class="row">
                @foreach ($produk as $item)
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="card h-100 dapro-card">
                            <img
                            class="dapro-img card-img-top"
                            src="{{ $item->gambar() }}"
                            alt="{{ $item->nama }}">
                            <div class="card-body">
                                <h3 class="header-2 font-weight-700 color-black mb-2">{{ $item->nama }}</h3>
                                <span class="header-3 font-weight-600 color-black mb-0">Rp {{ $item->harga() }}</span>
                                <hr class="my-3">
                                <p class="body-1 font-weight-400 color-grey mb-0">{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-layout footer-btn mx-auto d-block mt-4">Hubungi Kami</button>
        </div>
    </div>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('front_assets/css/pages/home/index.css') }}">
@endpush

@push('js')
<script src="{{ asset('front_assets/js/pages/home/index.js') }}"></script>
@endpush
