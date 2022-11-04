<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan Transaksi</th>
            <th>Masuk</th>
            <th>Keluar</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($saldoTunai as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{!! Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') !!}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->jumlah_masuk }}</td>
                <td>{{ $item->jumlah_keluar }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
