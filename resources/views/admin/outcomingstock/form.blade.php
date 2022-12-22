@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($outstocks) ? 'Update' : 'New'
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Barang Keluar</h2>
                </div>
                <form action="{{ url('admin/outcomingstocks') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @csrf
                                <label for="date">Kategori Upload</label>
                                <select name="kategori" class="form-control">
                                    <option value="">-- Choose Category --</option>
                                    <option value="shopee">Shopee</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Import Excel</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-default">Upload</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection