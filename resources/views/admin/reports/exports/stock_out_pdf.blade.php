<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Stock Out Report</title>
    <style type="text/css">
        table {
            width: 100%;
        }

        table tr td,
        table tr th {
            font-size: 10pt;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table th,
        td {
            border-bottom: 1px solid #ddd;
        }

        table th {
            border-top: 1px solid #ddd;
            height: 40px;
        }

        table td {
            height: 25px;
        }
    </style>
</head>

<body>
    <h2>Stock Out Report</h2>
    <hr>
    <p>Period : {{ \General::datetimeFormat($startDate, 'd M Y') }} - {{ \General::datetimeFormat($endDate, 'd M Y') }}</p>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>SKU</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th style="min-width: 150px;">Total Harga</th>
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
                <th colspan="4">Total Biaya</th>
                <th>{{ "Rp " . number_format($totalPurchase,0,',','.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>