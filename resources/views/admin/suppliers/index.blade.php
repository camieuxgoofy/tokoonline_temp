@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Suppliers</h2>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash')
                        <table id="basic-data-table" class="table nowarp table-bordered table-striped " style="width:100%">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Whatsapp No</th>
                                <th>Email</th>
                                <th>Address</th>
                            </thead>
                            <tbody>
                                @forelse ($suppliers as $supplier)
                                    <tr>    
                                        <td>{{ $supplier->id }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->wa_number }}</td>
                                        <td>{{ $supplier->email ? $supplier->email : '-' }}</td>
                                        <td>{{ $supplier->address ? $supplier->address : '-' }}</td>
                                        <td>
                                            @can('edit_suppliers')
                                                <a href="{{ url('admin/suppliers/'. $supplier->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                                            @endcan

                                            @can('delete_suppliers')
                                                {!! Form::open(['url' => 'admin/suppliers/'. $supplier->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No records found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $suppliers->links() }}
                    </div>

                    @can('add_suppliers')
                        <div class="card-footer text-right">
                            <a href="{{ url('admin/suppliers/create') }}" class="btn btn-primary">Add New</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection