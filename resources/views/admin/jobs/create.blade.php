@extends('admin')

@section('content')
    <h2>New Job</h2>

   {!! Form::model($jobs, ['route' => ['admin.jobs.store'], 'class'=>'','files' => true]) !!}

    @include('admin.jobs.partials.item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop