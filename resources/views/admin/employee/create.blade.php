@extends('admin')

@section('content')
    {!! Form::model($people, ['route' => ['admin.employee.store'], 'class'=>'','files' => true]) !!}
    @include('admin.employee.partials.item', ['submit_text' => 'Create', "BlockHeader" => "Add Employee"])
    {!! Form::close() !!}
@stop