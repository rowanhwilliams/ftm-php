@extends('admin')

@section('content')
    <h2>New Product</h2>

    {!! Form::model($products, ['route' => ['admin.products.store'], 'class'=>'','files' => true]) !!}
    @include('admin.products.partials.item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop