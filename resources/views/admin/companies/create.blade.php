@extends('admin')

@section('content')
    <h2>New Company</h2>

    {!! Form::model(new App\Models\Companies, ['route' => ['admin.companies.create'], 'class'=>'','files' => true]) !!}
    @include('admin/companies/partials/item', ['submit_text' => 'Create Task'])
    {!! Form::close() !!}
@stop