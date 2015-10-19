@extends('admin')

@section('content')
    @include('errors.list')
    <h2>New employee</h2>

    {!! Form::model($people, ['route' => ['admin.employee.store'], 'class'=>'','files' => true]) !!}
    @include('admin.employee.partials.item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop