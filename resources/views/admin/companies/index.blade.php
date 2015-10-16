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
                  <a class="btn btn-success btn-xs" href="{{ URL::route('admin.companies.create') }}" role="button">Add</a>
              </div>

          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th nowrap="">Company Name</th>
                      <th nowrap="">Year Founded</th>
                      <th>Website</th>
                  </tr>
                  </thead>
                  <tbody>

                      @if ($companies->count() > 0)
                          @foreach ($companies as $id => $company)
                            <tr>
                                <td class="text-left">{{$company->Company_Full_Name}}</td>
                                <td class="text-center">{{$company->Year_Founded}}</td>
                                <td class="text-left">{{$company->Website}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-xs" href="{{ URL::route("admin.companies.edit", $company->id_Company) }}" role="button">Edit</a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger btn-xs" href="{{ URL::route("admin.companies.destroy", $company->id_Company) }}" role="button">Delete</a>
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
              {{--{!! $companies->render() !!}--}}
          </div>


    </section>
@endsection