<table>
    <thead>
        <tr>
            <th>#</th>
            <th>SKU</th>
            <th>Nama Supplier</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalPurchase = 0;
        @endphp

        @forelse ($data as $i => $value)
        @php
        $totalPurchase += $value->total_purchase;
        @endphp
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $value->product_sku }}</td>
            <td>{{ $value->supplier_name }}</td>
            <td>{{ $value->product_name }}</td>
            <td>{{ $value->total_qty }}</td>
            <td>{{ "Rp " . number_format($value->total_purchase,0,',','.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">No records found</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th colspan="5">Total Biaya</th>
            <th>{{ "Rp " . number_format($totalPurchase,0,',','.') }}</th>
        </tr>
    </tfoot>
</table>