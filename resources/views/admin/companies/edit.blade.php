@extends('app')

@section('content')
    <h2>New employee</h2>

    {!! Form::model(new App\Models\Employee, ['route' => ['admin.employee.create', $project->slug], 'class'=>'']) !!}
        @include('employee/partials/item', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@stop