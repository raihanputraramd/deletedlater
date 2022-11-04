<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Sisa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kartuStok as $item)
            <tr>
                <td>{{ Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ $item->masuk }}</td>
                <td>{{ $item->keluar }}</td>
                <td>{{ $item->sisa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>