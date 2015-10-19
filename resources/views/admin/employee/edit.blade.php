@extends('admin')

@section('content')
    @include('errors.list')
    <h2>Edit <span class="text-danger">{!! $people->First_Name." ".$people->Surname !!}</span> Employee</h2>

    {!! Form::model($people, ['method' => 'PATCH', 'route' => ['admin.employee.update', $people->id_People], 'class'=>'','files' => true]) !!}
        @include('admin.employee.partials.item', ['submit_text' => 'Save'])
    {!! Form::close() !!}
@stop