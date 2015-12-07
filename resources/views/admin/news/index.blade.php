@extends('admin')

@section('content')
    <section class="content">
        <script type="text/javascript">
            $(document).ready(function()
                    {
                        $("#list-table_mc").tablesorter({
                            sortList: [[0,1]]
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
                  <th nowrap="">Date Time</th>
                  <th nowrap="">News type</th>
                  <th nowrap="">Headline</th>
                  <th nowrap="">About</th>
                  <th nowrap="" class="without-sort"></th>
              </tr>
              </thead>
              <tbody>
                  @if ($news->count() > 0)
                      @foreach ($news as $id => $newsItem)
                          <tr>
                              <td class="text-left">{!! \Carbon\Carbon::parse($newsItem->Story_Date)->format("d-M-Y H:i") !!}</td>
                              <td class="text-left">{!! $newsItem->News_Type_Name !!}</td>
                              <td class="text-left">{!! link_to(URL::route("admin.news.edit", $newsItem->id_News), $newsItem->Story_Headline) !!}</td>
                              <td class="text-left"></td>
                              <td class="text-center">
                                  {!! Form::open([ 'method'=>'DELETE', 'route' => ["admin.news.destroy", $newsItem->id_News], 'class' => 'pull-right']) !!}
                                  {!! Form::hidden('_method', 'DELETE') !!}
                                  {!! Form::hidden('_object', '_news') !!}
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