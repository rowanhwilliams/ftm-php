@extends('admin')

@section('content')
    @include('errors.list')
    <h2>New Product</h2>

    {!! Form::model($products, ['route' => ['admin.products.store'], 'class'=>'','files' => true]) !!}
    @include('admin.products.partials.item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop