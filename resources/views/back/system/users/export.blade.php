<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Status</th>
            <th>NIP</th>
            <th>Gender</th>
            <th>Jabatan</th>
            <th>Grup</th>
            <th>No. HP</th>
            <th>No. Telepon</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($users as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->status() }}</td>
                <td>{{ $item->no_induk }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->grup }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>{{ $item->no_telepon }}</td>
                <td>{{ $item->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
