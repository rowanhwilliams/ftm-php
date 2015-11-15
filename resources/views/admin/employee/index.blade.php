@extends('admin')

@section('content')
    <section class="content">
        <style>
            #list-table_mc td {padding:1px}
            #list-table_mc .btn-xs {padding:1px 2px}
        </style>
        <div class="row">

            <div class="col-md-11">
                {!! Form::open(['method'=>'PATCH', 'url' => 'admin/companies/search', 'class'=>'form navbar-form navbar-right searchform']) !!}
                {!! Form::text('search', null, array('required', 'class'=>'form-control', 'placeholder'=>'Search for a companies...')) !!}
                {!! Form::submit('Search', array('class'=>'btn btn-xs')) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-md-1">
                <a class="btn btn-success btn-xs" href="{{ URL::route('admin.employee.create') }}" role="button">Add</a>
            </div>

        </div>
        <div class="row">
          <table class="table table-striped" id="list-table_mc">
              <thead>
              <tr>
                  <th>First Name</th>
                  <th>Employee Type</th>
                  <th></th>
              </tr>
              </thead>
              <tbody>
                  @if ($people->count() > 0)
                      @foreach ($people as $id => $person)
                          <tr>
                              <td class="text-left">{!! link_to(URL::route("admin.employee.edit", $person->id_People), $person->First_Name . " " . $person->Surname) !!}</td>
                              <td class="text-left">{!! $person->employee()->first()->employeeType()->first()->Type_Name !!}</td>
                              <td class="text-center">
                                  {!! Form::open([ 'method'=>'DELETE', 'route' => ['admin.employee.destroy', $person->id_People], 'class' => 'pull-right']) !!}
                                  {!! Form::hidden('_method', 'DELETE') !!}
                                  {!! Form::hidden('_object', '_company') !!}
                                  {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                                  {!! Form::close() !!}
                              </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                          <td colspan="3" class="text-center">No records found</td>
                      </tr>
                  @endif
              </tbody>
          </table>
        </div>


    </section>
@endsection