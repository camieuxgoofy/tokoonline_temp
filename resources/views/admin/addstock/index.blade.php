@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Barang Masuk</h2>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash')
                        <table id="basic-data-table" class="table nowarp table-bordered table-striped " style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($addstocks as $i => $value)
                                    <tr>    
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ date("d-M-Y", strtotime($value->date)) }}</td>
                                        <td>{{ $value->supplier->name }}</td>
                                        <td>{{ $value->user->first_name . ' ' . $value->user->last_name  }}</td>
                                        <td>
                                            <a href="{{ url('admin/addstocks/'. $value->id ) }}" class="btn btn-primary btn-sm">detail</a>
                                            <button class="btn btn-warning btn-sm">edit</button>
                                            <button class="btn btn-danger btn-sm">delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $addstocks->links() }}
                    </div>

                    @can('add_addstocks')
                        <div class="card-footer text-right">
                            <a href="{{ url('admin/addstocks/create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection