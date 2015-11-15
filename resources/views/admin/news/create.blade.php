@extends('admin')

@section('content')
    @include('errors.list')
    <h2>Add News</h2>

   {!! Form::model($news, ['route' => ['admin.news.store'], 'class'=>'','files' => true]) !!}

    @include('admin.news.partials.item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop