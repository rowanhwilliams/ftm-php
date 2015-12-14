@extends('admin')

@section('content')
    <section class="content">
        <script type="text/javascript">

            $(document).ready(function()
                    {
                        $.tablesorter.addParser({
                            id: "date",
                            is: function (s) {
                                return false;
                            },
                            format: function (s, table) {
                                return new Date(s).getTime() || '';
                            },
                            type: "numeric"
                        })
                        $("#list-table_mc").tablesorter({
                            sortList: [[1,1]],
                            headers: {1: {sorter:'date'}}
                        });
                    }
            );
        </script>
        <style>
            #list-table_mc td {padding:1px}
            #list-table_mc .btn-xs {padding:1px 2px}
            table.tablesorter .tablesorter-headerAsc {
                background-image: url("{{ asset('images/icons/up.png') }}");
                background-size: 10px;
                padding-left: 12px;
                background-repeat: no-repeat;
                background-position: center left;
            }
            table.tablesorter .tablesorter-headerDesc {
                background-image: url("{{asset('images/icons/down.png')}}");
                background-size: 10px;
                padding-left: 12px;
                background-repeat: no-repeat;
                background-position: center left;
            }
            table.tablesorter .tablesorter-headerUnSorted {
                cursor: pointer;
                background-image: url("{{asset('images/icons/down.png')}}");
                background-size: 10px;
                padding-left: 12px;
                background-repeat: no-repeat;
                background-position: center left;
            }
            table.tablesorter .without-sort {
                background-image: none !important;
            }
        </style>
        <div class="row">
          <div class="pull-right">
              <a class="btn btn-success btn-xs" href="{{ URL::route('admin.news.create') }}" role="button">Add</a>
          </div>
        </div>

        <div class="row">
          <table class="table table-striped" id="list-table_mc">
              <thead>
              <tr>
                  <th class="without-sort"> <i class="glyphicon glyphicon-tasks"></i></th>
                  <th nowrap="">Date Time</th>
                  <th nowrap="">News type</th>
                  <th nowrap="">Headline</th>
                  <th nowrap="">About</th>

              </tr>
              </thead>
              <tbody>
                  @if ($news->count() > 0)
                      @foreach ($news as $id => $newsItem)
                          <tr>
                              <td class="text-center" width="1%">
                                  {!! Form::open([ 'method'=>'DELETE', 'route' => ["admin.news.destroy", $newsItem->id_News], 'class' => 'pull-center']) !!}
                                  {!! Form::hidden('_method', 'DELETE') !!}
                                  {!! Form::hidden('_object', '_news') !!}
                                  <button class='btn btn-xs btn-danger center' type='button' data-toggle="modal" data-target="#confirmDelete"
                                          data-title="Delete News" data-message='Warning – You are about to delete {!! $newsItem->Story_Headline !!}, please confirm?'
                                          data-extra-confirm="Are you sure (Y/N)?">
                                      <i class='glyphicon glyphicon-trash'></i>
                                  </button>
                                  {!! Form::close() !!}
                              </td>
                              <td class="text-left">{!! \Carbon\Carbon::parse($newsItem->Story_Date)->format("d-M-Y H:i") !!}</td>
                              <td class="text-left">{!! $newsItem->News_Type_Name !!}</td>
                              <td class="text-left">{!! link_to(URL::route("admin.news.edit", $newsItem->id_News), $newsItem->Story_Headline) !!}</td>
                              <td class="text-left">
                                  @foreach($newsItem->tags() as $tag)
                                      <span class="label label-info">{!! $tag->target.":".$tag->description !!}</span>
                                  @endforeach
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
        @include('partials.admin.confirm')
    </section>
@endsection