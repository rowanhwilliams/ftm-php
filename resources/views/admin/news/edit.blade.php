@extends('admin')

@section('content')
    {!! Form::model($news, ['method' => 'PATCH', 'route' => ['admin.news.update', $news->id_News], 'class'=>'','files' => true]) !!}
        @include('admin.news.partials.item', ['submit_text' => 'Save',
                 "BlockHeader" => '<h2>Edit <span class="text-info">'.$news->Story_Headline.'</span> News</h2>'])
    {!! Form::close() !!}
@stop