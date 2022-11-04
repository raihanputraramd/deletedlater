<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pembelian</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 4.1cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            margin-top:0.6cm;
            margin-left: 1cm;
            margin-right: 1cm;
        }

        p {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 14px !important;
            font-weight: normal;
            text-align: justify !important;
            text-justify: inter-character !important;
            line-height: 1.6 !important;
            margin: 0 !important;
        }

        span {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        h1{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 18px !important;
        }

        tr>td{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 14px !important;
        }

        tr>th{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 14px !important;
            text-align: inherit;
        }

        .clear-bottom{
            margin-bottom:0px;
            padding-bottom: 0px;
        }

        .clear-top{
            margin-top:0px;
            padding-top: 0px;
        }

        ol>li{
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 14px !important;
            text-align: justify !important;
            text-justify: inter-character !important;
        }

        ul>li {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 14px !important;
            text-align: justify !important;
            text-justify: inter-character !important;
        }
    </style>
</head>
<body>
    <main>

        <section>
            <div>
                <h1 style="text-align: center">Laporan Pembelian</h1>
            </div>
            <div>
                <table border="1" cellpadding="5" cellspacing="0" style="width: 100%">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Item</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Harga</th>
                            <th>Banyak</th>
                            <th>Disc</th>
                            <th>Total</th>
                            <th>Supplier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelianBarang as $item)
                        <tr>
                            <td>{{ $item->no_faktur }}</td>
                            <td>{{ $item->tanggal }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->barang }}</td>
                            <td>{{ number_format($item->harga,0,',','.') }}</td>
                            <td>{{ number_format($item->banyak,0,',','.') }}</td>
                            <td>{{ number_format($item->diskon,0,',','.') }}</td>
                            <td>{{ number_format($item->total,0,',','.') }}</td>
                            <td>{{ $item->supplier }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
</body>
</html>
