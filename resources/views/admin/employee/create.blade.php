@extends('admin')

@section('content')
    <h2>New employee</h2>

    {!! Form::model(new App\Models\Employee, ['route' => ['admin.employee.create'], 'class'=>'','files' => true]) !!}
    @include('admin/employee/partials/item', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@stop