@extends('admin')

@section('content')
    @include('errors.list')

    {{--<h2>Edit <span class="text-danger">{!! $news->Story_Headline !!}</span> News</h2>--}}

    {!! Form::model($news, ['method' => 'PATCH', 'route' => ['admin.news.update', $news->id_News], 'class'=>'','files' => true]) !!}

        @include('admin.news.partials.item', ['submit_text' => 'Save', "BlockHeader" => $news->Story_Headline])
    {!! Form::close() !!}
@stop