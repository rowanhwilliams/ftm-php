@extends('admin')

@section('content')
    <h2>New Company</h2>

   {!! Form::model($company, ['route' => ['admin.companies.store'], 'class'=>'','files' => true]) !!}

    @include('admin/companies/partials/item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop