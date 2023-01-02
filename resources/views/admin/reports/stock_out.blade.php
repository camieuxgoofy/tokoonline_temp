@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Stock Out Report</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash')
                    @include('admin.reports.filter')
                    <br>
                    <p>Period: {{ $startDate. ' - '. $endDate}}</p>
                    <br>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection