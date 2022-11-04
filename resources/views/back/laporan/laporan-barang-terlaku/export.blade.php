<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Item</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Banyak</th>
            <th>Diskon</th>
            <th>Laba Rugi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($barangTerlaku as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->harga_beli }}</td>
                <td>{{ $item->harga_jual }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->totalDiskon }}</td>
                <td>{{ $item->labaRugi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
