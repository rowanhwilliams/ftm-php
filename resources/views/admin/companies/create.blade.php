@extends('admin')

@section('content')
    <div class="text-danger">{!! HTML::ul($errors->all()) !!}</div>
    <h2>New Company</h2>

    {!! Form::model(new App\Models\Companies, ['route' => ['admin.companies.store'], 'class'=>'','files' => true]) !!}

    @include('admin/companies/partials/item', ['submit_text' => 'Create'])
    {!! Form::close() !!}
@stop