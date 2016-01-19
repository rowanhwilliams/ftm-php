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
                        <h2>People list</h2>
                        <span class="pull-right"><a class="btn btn-success" href="{{ URL::route('admin.employee.create') }}" role="button">Add New</a></span>
                    </div>
                    <div class="content">
                        <table class="table index-table table-striped table-responsive display compact nowrap" id="table-item-list">
                          <thead>
                              <tr>
                                  <th><i class="center-block icon-tasks"></i></th>
                                  <th>First Name</th>
                                  <th>Employee Type</th>
                              </tr>
                          </thead>
                          <tbody>
                              @if ($people->count() > 0)
                                  @foreach ($people as $id => $person)
                                      <tr>
                                          <td class="text-center" width="1%">
                                              {!! Form::open([ 'method'=>'DELETE', 'route' => ['admin.employee.destroy', $person->id_People], 'class' => 'pull-center']) !!}
                                              {!! Form::hidden('_method', 'DELETE') !!}
                                              {!! Form::hidden('_object', '_employee') !!}
                                              <button class='btn btn-xs btn-danger center btn-clean' type='button' data-toggle="modal" data-target="#confirmDelete"
                                                      data-title="Delete person" data-message='Warning – You are about to delete {!! $person->First_Name . " " . $person->Surname !!}, please confirm?'
                                                      data-extra-confirm="Are you sure (Y/N)?">
                                                  <i class='icon-trash'></i>
                                              </button>
                                              {!! Form::close() !!}
                                          </td>
                                          <td class="text-left">{!! link_to(URL::route("admin.employee.edit", $person->id_People), $person->First_Name . " " . $person->Surname) !!}</td>
                                          {{--@if ($person->employee()->first()->employeeType()->first())--}}
                                            {{--<td class="text-left">{!! $person->employee()->first()->employeeType()->first()->Type_Name !!}</td>--}}
                                          {{--@else--}}
                                            <td class="text-left"></td>
                                          {{--@endif--}}
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
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="block">
                    <div class="head bg-default bg-light-ltr">
                        <h2>Recently added People</h2>
                    </div>
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>
        @include('partials.admin.confirm')

    </section>
@endsection