@extends('admin')

@section('content')
    <h2>New Product</h2>

    {!! Form::model(new App\Models\Products, ['route' => ['admin.products.create'], 'class'=>'','files' => true]) !!}
    @include('admin/products/partials/item', ['submit_text' => 'Create Product'])
    {!! Form::close() !!}
@stop