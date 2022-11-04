<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Diskon</th>
            <th>Level Harga</th>
            <th>Point</th>
            <th>Email</th>
            <th>No. Hp</th>
            <th>No. Telp</th>
            <th>Kota</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($pelanggan as $item)
            <tr>
                <td>{{ $i++ }}</td>
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