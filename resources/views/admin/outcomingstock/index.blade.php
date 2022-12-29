@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Barang Keluar</h2>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash')
                        <table id="basic-data-table" class="table nowarp table-bordered table-striped " style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>Category</th>
                                <!-- <th>File Name</th> -->
                                <th>Total Product</th>
                                <th>Uploaded By</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($outcomingstocks as $i => $value)
                                    <tr>    
                                        <td>{{ $i+1 }}</td>
                                        <td>{{ date("d-M-Y", strtotime($value->created_at)) }}</td>
                                        <td>{{ $value->category }}</td>
                                        <!-- <td>{{ $value->file_name }}</td> -->
                                        <td>{{ $value->total_row }}</td>
                                        <td>{{ $value->user->first_name . ' ' . $value->user->last_name  }}</td>
                                        <td>
                                            <a href="{{ url('admin/outcomingstocks/'. $value->id ) }}" class="btn btn-primary btn-sm">detail</a>
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
                        {{ $outcomingstocks->links() }}
                    </div>

                    @can('add_outcomingstocks')
                        <div class="card-footer text-right">
                            <a href="{{ url('admin/outcomingstocks/create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection