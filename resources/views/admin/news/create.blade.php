@extends('admin')

@section('content')
    {!! Form::model($news, ['route' => ['admin.news.store'], 'class'=>'','files' => true]) !!}
    @include('admin.news.partials.item', ['submit_text' => 'Create', "BlockHeader" => "Add News"])
    {!! Form::close() !!}
@stop