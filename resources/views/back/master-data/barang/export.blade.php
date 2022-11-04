<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Satuan 2</th>
            <th>Isi Satuan 2</th>
            <th>Satuan 3</th>
            <th>Isi Satuan 3</th>
            <th>Supplier</th>
            <th>Harga Beli</th>
            <th>Diskon Beli</th>
            <th>Harga Jual</th>
            <th>Harga Jual 1</th>
            <th>Harga Jual 2</th>
            <th>Harga Jual 3</th>
            <th>Diskon Jual</th>
            <th>Diskon Qty1</th>
            <th>Diskon Amount1</th>
            <th>Diskon Qty2</th>
            <th>Diskon Amount2</th>
            <th>Diskon Qty3</th>
            <th>Diskon Amount3</th>
            <th>Diskon Qty4</th>
            <th>Diskon Amount4</th>
            <th>Berat</th>
            <th>Omset</th>
            <th>Size</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($barang as $item)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->satuan_1 }}</td>
                <td>{{ $item->satuan_2 }}</td>
                <td>{{ $item->isi_satuan_2 }}</td>
                <td>{{ $item->satuan_3 }}</td>
                <td>{{ $item->isi_satuan_3 }}</td>
                <td>{{ $item->supplier }}</td>
                <td>{{ $item->harga_beli }}</td>
                <td>{{ $item->diskon_beli }}</td>
                <td>{{ $item->harga_jual }}</td>
                <td>{{ $item->harga_jual_1 }}</td>
                <td>{{ $item->harga_jual_2 }}</td>
                <td>{{ $item->harga_jual_3 }}</td>
                <td>{{ $item->diskon_jual }}</td>
                <td>{{ $item->diskon_qty_1 }}</td>
                <td>{{ $item->diskon_amount_1 }}</td>
                <td>{{ $item->diskon_qty_2 }}</td>
                <td>{{ $item->diskon_amount_2 }}</td>
                <td>{{ $item->diskon_qty_3 }}</td>
                <td>{{ $item->diskon_amount_3 }}</td>
                <td>{{ $item->diskon_qty_4 }}</td>
                <td>{{ $item->diskon_amount_4 }}</td>
                <td>{{ $item->berat }}</td>
                <td>{{ $item->omset }}</td>
                <td>{{ $item->size }}</td>
                <td>{{ $item->deskripsi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>