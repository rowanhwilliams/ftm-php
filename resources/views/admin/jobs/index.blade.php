@extends('admin')

@section('content')
    <section class="content">
        <style>
            #list-table_mc td {padding:1px}
            #list-table_mc .btn-xs {padding:1px 2px}
        </style>
        <div class="row">
          <div class="pull-right">
              <a class="btn btn-success btn-xs" href="{{ URL::route('admin.jobs.create') }}" role="button">Add</a>
          </div>
        </div>

        <div class="row">
          <table class="table table-striped" id="list-table_mc">
              <thead>
              <tr>
                  <th nowrap="">Job Title</th>
                  <th nowrap="">Job Description</th>
                  <th nowrap="">Job type</th>
                  <th nowrap=""></th>
              </tr>
              </thead>
              <tbody>
              @if ($jobs->count() > 0)
                  @foreach ($jobs as $id => $job)
                      <tr>
                          <td class="text-left">{!! link_to(URL::route("admin.jobs.edit", $job->id_Job), $job->Job_Title) !!}</td>
                          <td class="text-left">{!! $job->Job_Description !!}</td>
                          <td class="text-left">{!! $job->getJobType()->Job_Type !!}</td>
                          <td class="text-center">
                              {!! Form::open([ 'method'=>'DELETE', 'route' => ["admin.jobs.destroy", $job->id_Job], 'class' => 'pull-right']) !!}
                              {!! Form::hidden('_method', 'DELETE') !!}
                              {!! Form::hidden('_object', '_company') !!}
                              {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                              {!! Form::close() !!}
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