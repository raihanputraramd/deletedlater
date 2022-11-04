<table>
    <thead>
        <tr>
            <th>Banyak</th>
            <th>Satuan</th>
            <th>Kode</th>
            <th>Item</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($pembelianBarang as $item)
            <tr>
                <td>{{ $item->banyak }}</td>
                <td>pcs</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->barang }}</td>
                <td>{{ $item->harga }}</td>
                <td>{{ $item->diskon }}</td>
                <td>{{ $item->total }}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Sub Total</td>
            <td>{{ $pembelian->sub_total }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Potongan</td>
            <td>{{ $pembelian->potongan }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>PPN</td>
            <td>{{ $pembelian->ppn }}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total</td>
            <td>{{ $pembelian->total }}</td>
        </tr>
    </tbody>
</table>