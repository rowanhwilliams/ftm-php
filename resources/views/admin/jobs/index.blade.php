@extends('admin')

@section('content')
    <section class="content">
        <script type="text/javascript">
            $(document).ready(function()
                    {
                        $("#table-item-list").dataTable({
                            "iDisplayLength": 50,
                            "aLengthMenu": [25,50,100],
                            "sPaginationType": "full_numbers",
                            "aoColumns": [
                                { "bSortable": false },
                                null,
                                null,
                                null
                            ]
                        });
                    }
            );
        </script>
        <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <div class="block">
                    <div class="head bg-default bg-light-ltr">
                        <h2>Jobs list</h2>
                        <span class="pull-right"><a class="btn btn-success" href="{{ URL::route('admin.jobs.create') }}" role="button">Add New</a></span>
                    </div>
                    <div class="content">
                        <table class="table index-table table-striped table-responsive display compact nowrap" id="table-item-list">
                          <thead>
                          <tr>
                              <th><i class="center-block icon-tasks"></i></th>
                              <th nowrap="">Job Title</th>
                              <th nowrap="">Job Description</th>
                              <th nowrap="">Job type</th>
                          </tr>
                          </thead>
                          <tbody>
                          @if ($jobs->count() > 0)
                              @foreach ($jobs as $id => $job)
                                  <tr>
                                      <td class="text-center" width="1%">
                                          {!! Form::open([ 'method'=>'DELETE', 'route' => ["admin.jobs.destroy", $job->id_Job], 'class' => 'pull-center']) !!}
                                          {!! Form::hidden('_method', 'DELETE') !!}
                                          {!! Form::hidden('_object', '_job') !!}
                                          <button class='btn btn-xs btn-danger center btn-clean' type='button' data-toggle="modal" data-target="#confirmDelete"
                                                  data-title="Delete job vacancy" data-message='Warning – You are about to delete {!! $job->Job_Description !!}, please confirm?'
                                                  data-extra-confirm="Are you sure (Y/N)?">
                                              <i class='icon-trash'></i>
                                          </button>
                                          {!! Form::close() !!}
                                      </td>
                                      <td class="text-left">{!! link_to(URL::route("admin.jobs.edit", $job->id_Job), $job->Job_Title) !!}</td>
                                      <td class="text-left">{!! $job->Job_Description !!}</td>
                                      <td class="text-left">{!! $job->getJobType()->Job_Type !!}</td>
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
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="block">
                    <div class="head bg-default bg-light-ltr">
                        <h2>Recently added Jobs</h2>
                    </div>
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>
        @include('partials.admin.confirm')

    </section>
@endsection