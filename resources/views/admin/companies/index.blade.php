@extends('admin')

@section('content')
    <section class="content">
          <div class="row">
              <div class="pull-right">
                  <a class="btn btn-success btn-sm" href="{{ URL::to('/admin/companies/create') }}" role="button">Add</a>
              </div>
          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Company Name</th>
                      <th>Year Founded</th>
                      <th>Website</th>
                  </tr>
                  </thead>
                  <tbody>

                      @if ($companies->count() > 0)
                          @foreach ($companies as $company)
                            <tr>
                                <td class="text-center">{{$company->id_Company}}</td>
                                <td class="text-left">{{$company->Company_Full_Name}}</td>
                                <td class="text-left">{{$company->Year_Founded}}</td>
                                <td class="text-left">{{$company->Website}}</td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-sm" href="{{ URL::route("admin.companies.edit", $company->id_Company) }}" role="button">Edit</a>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-danger btn-sm" href="{{ URL::route("admin.companies.destroy", $company->id_Company) }}" role="button">Delete</a>
                                </td>
                            </tr>
                          @endforeach
                      @else
                        <tr>
                            <td colspan="4" class="text-center">No records found</td>
                        </tr>
                      @endif


                  </tbody>
              </table>
          </div>


    </section>
@endsection