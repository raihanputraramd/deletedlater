<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pelanggan</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }

        body {
            margin-top: 4.1cm;
            margin-left: 1cm;
            margin-right: 1cm;
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
                <h1 style="text-align: center">Data Pelanggan</h1>
            </div>
            <div>
                <table border="1" cellpadding="5" cellspacing="0" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diskon</th>
                            <th>Level Harga</th>
                            <th>Point</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>No Telp</th>
                            <th>Kota</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $item)
                        <tr>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->diskon }}</td>
                            <td>{{ $item->level_harga }}</td>
                            <td>{{ $item->point }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->no_telepon }}</td>
                            <td>{{ $item->kota }}</td>
                            <td>{{ $item->alamat }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
</body>
</html>
