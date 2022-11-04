@extends('layouts.pos.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="container w-50">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="text-center font-weight-bold">Berkahbambu.com</h2>
                            <h5 class="text-left font-weight-800">Jl. Manggis Raya No.36, Cimekar, Kec. Cileunyi, Kabupaten Bandung</h5>
                            <div class="mt-2">
                                <h5 class="text-left font-weight-800">{{ Carbon\Carbon::now()->translatedFormat("l, d m Y - H:i") }}</h5>
                                <h5 class="text-left font-weight-800">No. Pembelian : {{ $pembelian->nomor_faktur }}</h5>
                                <h5 class="text-left font-weight-800">Kasir : {{ auth()->user()->nama }}</h5>
                                <h5 class="text-left font-weight-800">Kepada Yth : {{ $pembelian->supplier->nama }}</h5>
                            </div>
                            <p class="mt-2 font-weight-bold">__________________________________________________________________________</p>
                                @foreach ($pembelian->pembelianBarang as $pembelianBarang)
                                    <h5 class="text-left font-weight-800">{{ $pembelianBarang->barang->nama . " @" . "Rp." . number_format($pembelianBarang->harga,0,',','.') . " X " . $pembelianBarang->banyak}}</h5>
                                @endforeach
                                <p class="mb-2 font-weight-bold">__________________________________________________________________________</p>
                                <h5 class="text-right font-weight-800">Sub Total : Rp.{{ number_format($pembelian->pembelianBarang->sum('total'),0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Potongan : Rp.{{ number_format($pembelian->potongan,0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Ppn : Rp.{{ number_format($pembelian->ppn,0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Total : Rp.{{ number_format($pembelian->total,0,',','.') }}</h5>
                                <h5 class="text-right font-weight-800">Dibayar : Rp.{{ number_format($pembelian->bayar,0,',','.') }}</h5>
                                <h5 class="mt-1 text-right font-weight-800">Jumlah Item : {{ $pembelian->pembelianBarang->sum('banyak') }}</h5>
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
                                <form action="{{ route('back.transaksi.pembelian.export', $pembelian->id) }}" method="GET" target="_blank">
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
        <p class="centered title" style="font-weight: bold;">Berkahbambu.com</p>
        <p class="lefted sub-title" style="font-weight: 700;">Jl. Manggis Raya No.36, Cimekar, Kec. Cileunyi, Kabupaten Bandung</p>
        <div class="lefted" style="margin-top: 20px;">
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">{{ Carbon\Carbon::now()->translatedFormat("l, d m Y - H:i") }}</p>
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">No. Pembelian : {{ $pembelian->nomor_faktur }}</p>
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">Kasir : {{ auth()->user()->name }}</p>
            <p class="sub-title" style="margin-top: -5px; font-weight: 700;">Kepada Yth : {{ $pembelian->supplier->nama }}</p>
        </div>
        <p class="centered sub-title" style="font-weight: bold;">___________________________________________________</p>
        @foreach ($pembelian->pembelianBarang as $pembelianBarang)
            <p class="lefted sub-title" style="font-weight: 700;">{{ $pembelianBarang->barang->nama . " @" . "Rp." . number_format($pembelianBarang->harga,0,',','.') . " X " . $pembelianBarang->banyak}}</p>
        @endforeach
        <p class="centered sub-title" style="font-weight: bold; margin-bottom: 20px;">___________________________________________________</p>
        <div class="righted">
            <p class="sub-title" style="font-weight: 700;">Sub Total : Rp.{{ number_format($pembelian->pembelianBarang->sum('total'),0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Potongan : Rp.{{ number_format($pembelian->potongan,0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Ppn : Rp.{{ number_format($pembelian->ppn,0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Total : Rp.{{ number_format($pembelian->total,0,',','.') }}</p>
            <p class="sub-title" style="font-weight: 700;">Dibayar : Rp.{{ number_format($pembelian->bayar,0,',','.') }}</p>
            <p class="sub-title" style="margin-top: 20px; font-weight: 700;">Jumlah Item : {{ $pembelian->pembelianBarang->sum('banyak') }}</p>
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
                +   '@media print { @page { margin: 0cm !important; margin-bottom: 20px; } body { margin: 30px; height: 100%; } } .centered { text-align: center; }'
                +   '.lefted { text-align: left; } .righted { text-align: right; } .title { font-size: 18px; } .sub-title { font-size: 16px; }'
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