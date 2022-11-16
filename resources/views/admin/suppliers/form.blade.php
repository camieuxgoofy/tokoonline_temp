@extends('admin.layout')

@section('content')
    
@php
    $formTitle = !empty($supplier) ? 'Update' : 'New'    
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                        <h2>{{ $formTitle }} Supplier</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($supplier))
                        {!! Form::model($supplier, ['url' => ['admin/suppliers', $supplier->id], 'method' => 'PUT']) !!}
                        {!! Form::hidden('id') !!}
                    @else
                        {!! Form::open(['url' => 'admin/suppliers']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('name', 'Name *') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Supplier name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('wa_number', 'Whatsapp Number *') !!}
                            {!! Form::number('wa_number', null, ['class' => 'form-control', 'placeholder' => 'Whatsapp Number']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address') !!}
                            {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'Address']) !!}
                        </div>
                        <div class="form-footer pt-5 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                            <a href="{{ url('admin/suppliers') }}" class="btn btn-secondary btn-default">Back</a>
                        </div>
                    {!! Form::close() !!}
                </div>            </div>  
        </div>
    </div>
</div>
@endsection