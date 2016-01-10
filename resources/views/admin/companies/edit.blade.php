@extends('admin')

@section('content')
    <h2>Edit <span class="text-danger">{!! $company->Company_Full_Name !!}</span> Company</h2>

    {!! Form::model($company, ['method' => 'PATCH', 'route' => ['admin.companies.update', $company->id_Company], 'class'=>'','files' => true]) !!}

        @include('admin.companies.partials.item', ['submit_text' => 'Save'])
    {!! Form::close() !!}
@stop