@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Detail Stock In</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('admin/addstocks') }}" class="btn btn-secondary btn-sm">Back</a>
                        <br><br>
                        @include('admin.partials.flash')
                        <table id="basic-data-table" class="table nowarp table-bordered table-striped " style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Quantity</th>
                                <th>Purchase Price</th>
                                <th>Product</th>
                            </thead>
                            <tbody>
                                @forelse ($data as $i => $value)
                                    <tr>    
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ $value->qty }}</td>
                                        <td>{{ "Rp " . number_format($value->purchase_price,0,',','.') }}</td>
                                        <td>{{ $value->product->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $data->links() }}
                    </div>

                    <!-- @can('add_addstocks')
                        <div class="card-footer text-right">
                            <a href="{{ url('admin/addstocks/create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    @endcan -->
                </div>
            </div>
        </div>
    </div>
@endsection