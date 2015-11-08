@extends('admin')

@section('content')
    <section class="content">
          <div class="row">
              <div class="pull-right">
                  <a class="btn btn-success btn-xs" href="{{ URL::route('admin.jobs.create') }}" role="button">Add</a>
              </div>
          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th nowrap="">Job Title</th>
                      <th nowrap="">Job Description</th>
                      <th>Job type</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if ($jobs->count() > 0)
                      @foreach ($jobs as $id => $job)
                          <tr>
                              <td class="text-left">{!! $job->Job_Title !!}</td>
                              <td class="text-left">{!! $job->Job_Description !!}</td>
                              <td class="text-left"></td>
                              <td class="text-center">
                                  <a class="btn btn-warning btn-xs" href="{{ URL::route("admin.jobs.edit", $job->id_Job) }}" role="button">Edit</a>
                              </td>
                              <td class="text-center">
                                  <a class="btn btn-danger btn-xs" href="{{ URL::route("admin.jobs.destroy", $job->id_Job) }}" role="button">Delete</a>
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