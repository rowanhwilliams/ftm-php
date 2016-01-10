@extends('admin')

@section('content')
    <h2>Edit <span class="text-danger">{!! $products->Product_Title !!}</span> Product</h2>

    {!! Form::model($products, ['method' => 'PATCH', 'route' => ['admin.products.update', $products->id_Product], 'class'=>'','files' => true]) !!}
        @include('admin.products.partials.item', ['submit_text' => 'Save'])
    {!! Form::close() !!}
@stop