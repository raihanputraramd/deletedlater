<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No Faktur</th>
            <th>Pelanggan</th>
            <th>Lunas</th>
            <th>Jumlah Piutang</th>
            <th>Tanggal Lunas</th>
            <th>Jatuh Tempo</th>
            <th>Item</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($piutang as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->no_faktur }}</td>
                <td>{{ $item->pelanggan }}</td>
                <td>{{ $item->status_lunas }}</td>
                <td>{{ $item->nominal }}</td>
                <td>{{ Carbon\Carbon::parse($item->tanggal_lunas)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($item->jatuh_tempo)->format('d/m/Y') }}</td>
                <td>
                    <ul>
                        @foreach ($item->piutangBarang as $piutangBarang)
                        <li>{{ $piutangBarang->barang != null ? $piutangBarang->barang->nama : '' }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
