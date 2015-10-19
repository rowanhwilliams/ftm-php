@extends('admin')

@section('content')
    <section class="content">
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
          <table class="table table-striped">
              <thead>
              <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Employee Type</th>
              </tr>
              </thead>
              <tbody>
                  @if ($people->count() > 0)
                      @foreach ($people as $id => $person)
                          <tr>
                              <td class="text-left">{!! $person->First_Name !!}</td>
                              <td class="text-left">{!! $person->Surname !!}</td>
                              <td class="text-left"></td>
                              <td class="text-center">
                                  <a class="btn btn-warning btn-xs" href="{{ URL::route("admin.employee.edit", $person->id_People) }}" role="button">Edit</a>
                              </td>
                              <td class="text-center">
                                  <a class="btn btn-danger btn-xs" href="{{ URL::route("admin.employee.destroy", $person->id_People) }}" role="button">Delete</a>
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