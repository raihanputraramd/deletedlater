<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Masuk Keluar</th>
            <th>Amount</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($kasTunai as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->transaksi }}</td>
                <td>{{ $item->exportAmount() }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{!! Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') !!}</td>
                <td>{{ $item->user }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
