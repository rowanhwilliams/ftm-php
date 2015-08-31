@extends('admin')

@section('content')
    <section class="content">
          <div class="row">
              <div class="pull-right">
                  <a class="btn btn-success btn-sm" href="{{ URL::to('/admin/companies/create') }}" role="button">Add</a>
                  <a href="#" class="btn btn-danger btn-sm">Delete</a>
              </div>
          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Company</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td colspan="4" class="text-center">No records found</td>
                  </tr>
                  </tbody>
              </table>
          </div>


    </section>
@endsection