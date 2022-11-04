@extends('layouts.pos.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container w-50">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="text-center font-weight-bold">Ahlinyaweb.com</h2>
                            <h5 class="text-left font-weight-800">Jl. Manggis Raya No.36, Cimekar, Kec. Cileunyi, Kabupaten Bandung</h5>
                            <div class="mt-2">
                                <h5 class="text-left font-weight-800">{{ Carbon\Carbon::now()->translatedFormat("l, d m Y - H:i") }}</h5>
                                <h5 class="text-left font-weight-800">No. Pembelian : {{ $penjualan->nomor_faktur }}</h5>
                                <h5 class="text-left font-weight-800">Kasir : {{ auth()->user()->nama }}</h5>
                                <h5 class="text-left font-weight-800">Kepada Yth : {{ $penjualan->pelanggan->nama }}</h5>
                            </div>
                            <p class="mt-2 font-weight-bold">
                                <hr class="border-black">
                            </p>
                                @foreach ($penjualan->penjualanBarang as $penjualanBarang)
                                    <div class="row mb-5">
                                        <div class="col-lg-5">
                                            <p class="font-weight-800 text-black mb-1">{{ $penjualanBarang->barang->nama }}</p>
                                        </div>
                                        <div class="col-lg-3">
                                            <p class="text-right font-weight-800 text-black mb-1">{{ $penjualanBarang->banyak }}</p>
                                        </div>

                                        <div class="col-lg-4">
                                            <p class="text-right font-weight-800 text-black mb-1">
                                                Rp {{number_format( $penjualanBarang->harga,0,',','.') }}
                                            </p>
                                        </div>

                                        <div class="col-lg-12 d-flex justify-content-between">
                                            @if ($penjualanBarang->diskon > 1)
                                                <p class="text-black font-weight-800 mb-0">Diskon {{ number_format($penjualanBarang->persen(),0) }}%</p>
                                                <p class="text-black font-weight-800 mb-0"> {{"Rp." . number_format($penjualanBarang->diskon,0,',','.')}}-</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <p class="mb-2 font-weight-bold">
                                    <hr class="border-black">
                                </p>
                                <h5 class="text-right font-weight-800">Sub Total : Rp.{{ number_format($penjualan->penjualanBarang->sum('total'),0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Potongan : Rp.{{ number_format($penjualan->potongan,0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Total : Rp.{{ number_format($penjualan->total,0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Dibayar : Rp.{{ number_format($penjualan->bayar,0,',','.') }}</h5>
                                <h5 class="mt-1 text-right font-weight-800">Jumlah Item : {{ $penjualan->penjualanBarang->sum('banyak') }}</h5>
                            <h5 class="mt-3 mb-2 text-center font-weight-800">Terima Kasih atas Kunjungan Anda</h5>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <a class="text-decoration-none text-white" href="{{ route('back.home.index') }}">
                                    <button type="button" class="btn btn-custom red px-3 ml-3"><i class="fas fa-times-circle mr-2"></i>Keluar</button>
                                </a>
                                <form action="{{ route('back.transaksi.penjualan.export', $penjualan->id) }}" method="GET" target="_blank">
                                    <button type="submit" class="btn btn-custom green px-3 ml-3">
                                        <i class="fas fa-file-excel mr-2"></i> File Excel
                                    </button>
                                </form>
                                <button type="submit" class="btn btn-custom green px-3 ml-3" onclick="print();">
                                    <i class="fas fa-print mr-2"></i>
                                    Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="hide">
    <div id="struk">
        <p class="centered title" style="font-weight: bold;">Ahlinyaweb.com</p>
        <p class="lefted sub-title" style="font-weight: 700;">Jl. Manggis Raya No.36, Cimekar, Kec. Cileunyi, Kabupaten Bandung</p>
        <div class="lefted" style="margin-top: 20px;">
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">{{ Carbon\Carbon::now()->translatedFormat("l, d m Y - H:i") }}</p>
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">No. Pembelian : {{ $penjualan->nomor_faktur }}</p>
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">Kasir : {{ auth()->user()->name }}</p>
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">Kepada Yth : {{ $penjualan->pelanggan->nama }}</p>
        </div>
        <p class="centered sub-title" style="font-weight: bold;"> <hr> </p>
        @foreach ($penjualan->penjualanBarang as $penjualanBarang)
            <p class="lefted sub-title" style="font-weight: 700; margin-bottom: 4px !important;">{{ $penjualanBarang->barang->nama . " @" . $penjualanBarang->banyak . " X " . "Rp." . number_format($penjualanBarang->harga,0,',','.')}}</p>
            @if ($penjualanBarang->diskon > 1)
                <p class="sub-title" style="font-size: 8px !important; margin-bottom: 24px">
                    Diskon {{ number_format($penjualanBarang->persen(),0) }}% {{"Rp." . number_format($penjualanBarang->diskon,0,',','.')}}-
                </p>
                {{-- <tr>
                    <td colsplan="2`"> --}}
                    {{-- </td>
                </tr> --}}
            @endif
        @endforeach
        {{-- <table style="width: 100%;" border="0" cellspacing="2" cellpadding="2">
        <tr>
            <th style="text-align: left">Nama Barang</th>
            <th style="text-align: left">Kuantitas</th>
            <th style="text-align: left; width: 40%">Harga</th>
        </tr>
        @foreach ($penjualan->penjualanBarang as $penjualanBarang)
            <tr style="margin-bottom: 16px; padding-bottom: 16px">
                <td>
                    <span style="font-size: 12px">
                        {{ $penjualanBarang->barang->nama }} X
                        {{ $penjualanBarang->banyak }}
                    </span>
                </td>
                <td style="width: 40%; display:block">
                    <span style="font-size: 12px">
                        Rp {{number_format( $penjualanBarang->harga,0,',','.') }}
                    </span>
                </td>
                    
            </tr>
            @if ($penjualanBarang->diskon > 1)
                <tr>
                    <td colsplan="2`">
                        <span style="font-size: 12px">
                            Diskon {{ number_format($penjualanBarang->persen(),0) }}% {{"Rp." . number_format($penjualanBarang->diskon,0,',','.')}}-
                        </span>
                    </td>
                </tr>
            @endif
            @endforeach
        </table> --}}
        <p class="centered sub-title" style="font-weight: bold; margin-bottom: 20px;"><hr></p>
        <div class="righted">
            <p class="sub-title" style="font-weight: 700;">Sub Total : Rp.{{ number_format($penjualan->penjualanBarang->sum('total'),0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Potongan : Rp.{{ number_format($penjualan->potongan,0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Total : Rp.{{ number_format($penjualan->total,0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Dibayar : Rp.{{ number_format($penjualan->bayar,0,',','.') }}</p>
            <p class="sub-title" style="margin-top: 20px; font-weight: 700;">Jumlah Item : {{ $penjualan->penjualanBarang->sum('banyak') }}</p>
        </div>
        <p class="centered sub-title end" style="margin-top: 30px; margin-bottom: 50px; font-weight: 700;">
            Terima Kasih atas Kunjungan Anda
        </p>
    </div>
</div>
@endsection

@push('js')
    <script>
        function print() {
            let divToPrint=document.getElementById("struk");
            newWin= window.open("");
            newWin.document.write('<html><head><title></title>');
            newWin.document.write(
                '<style type="text/css">'
                +   '@media print { @page { margin: 0cm !important; margin-bottom: 20px; } body { margin: 16px; height: 100%; } } .centered { text-align: center; }'
                +   '.lefted { text-align: left; } .righted { text-align: right; } .title { font-size: 18px; } .sub-title { font-size: 10px; }'
                +'</style>'
                );
            newWin.document.write('</head><body>');
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.write('</body></html>');
            newWin.print();
            newWin.close();
        }

        $('#hide').hide();
    </script>
@endpush
