@extends('admin')

@section('content')
    <section class="content">
          <div class="row">
              <div class="pull-right">
                  <a class="btn btn-success btn-xs" href="{{ URL::route('admin.news.create') }}" role="button">Add</a>
              </div>
          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th nowrap="">News Description</th>
                      <th nowrap=""></th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td colspan="3" class="text-center">No records found</td>
                    </tr>
                  </tbody>
              </table>
          </div>


    </section>
@endsection