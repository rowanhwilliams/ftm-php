@extends('admin')

@section('content')
    @include('errors.list')
    <h2>Edit <span class="text-danger">{!! $jobs->Job_Title !!}</span> Job</h2>

    {!! Form::model($jobs, ['method' => 'PATCH', 'route' => ['admin.jobs.update', $jobs->id_Job], 'class'=>'','files' => true]) !!}

        @include('admin.jobs.partials.item', ['submit_text' => 'Save'])
    {!! Form::close() !!}
@stop