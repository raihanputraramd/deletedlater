<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Poin</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>User</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($penukaranPoint as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->pelanggan }}</td>
                <td>{{ $item->point }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{!! Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') !!}</td>
                <td>{{ $item->user }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
