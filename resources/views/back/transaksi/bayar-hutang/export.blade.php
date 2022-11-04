<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Faktur</th>
            <th>Supplier</th>
            <th>Lunas</th>
            <th>Jumlah Hutang</th>
            <th>Tanggal Lunas</th>
            <th>Jatuh Tempo</th>
            <th>Item</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($hutang as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->no_faktur }}</td>
                <td>{{ $item->supplier }}</td>
                <td>{{ $item->status_lunas }}</td>
                <td>{{ $item->nominal }}</td>
                <td>{{ Carbon\Carbon::parse($item->tanggal_lunas)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($item->jatuh_tempo)->format('d/m/Y') }}</td>
                <td>
                    <ul>
                        @foreach ($item->hutangBarang as $hutangBarang)
                            <li>{{ $hutangBarang->barang != null ? $hutangBarang->barang->nama : '' }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
