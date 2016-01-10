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
                        <h2>News list</h2>
                        <span class="pull-right"><a class="btn btn-success" href="{{ URL::route('admin.news.create') }}" role="button">Add New</a></span>
                    </div>
                    <div class="content">
                        <table class="table index-table table-striped table-responsive display compact nowrap" id="table-item-list">
                            <thead>
                            <tr>
                              <th><i class="center-block icon-tasks"></i></th>
                              <th nowrap="">Date Time</th>
                              <th class="without-sort">Tags</th>
                              <th nowrap="">News type</th>
                              <th>Headline</th>
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
                                              <button class='btn btn-xs btn-danger center btn-clean' type='button' data-toggle="modal" data-target="#confirmDelete"
                                                      data-title="Delete News" data-message='Warning – You are about to delete {!! $newsItem->Story_Headline !!}, please confirm?'
                                                      data-extra-confirm="Are you sure (Y/N)?">
                                                  <i class='icon-trash'></i>
                                              </button>
                                              {!! Form::close() !!}
                                          </td>
                                          <td class="text-left" nowrap="">{!! \Carbon\Carbon::parse($newsItem->Story_Date)->format("d-M-Y H:i") !!}</td>
                                          <td class="text-left">
                                              <strong>
                                                @foreach($newsItem->tags() as $tag)
                                                    @if ($tag->target == "Companies")
                                                        <span class="text-info">
                                                    @elseif($tag->target == "Products")
                                                        <span class="text-success">
                                                    @elseif($tag->target == "People")
                                                        <span class="text-warning">
                                                    @else
                                                        <span class="text-default">
                                                    @endif
                                                            {!! $tag->description !!}
                                                        </span>
                                              @endforeach
                                              </strong>
                                          </td>
                                          <td class="text-left">{!! $newsItem->News_Type_Name !!}</td>
                                          <td class="text-left">{!! link_to(URL::route("admin.news.edit", $newsItem->id_News),
                                              strlen($newsItem->Story_Headline) > 30 ?
                                                    substr($newsItem->Story_Headline,0, 30). "..." : $newsItem->Story_Headline) !!}
                                          </td>
                                      </tr>
                                  @endforeach
                              @else
                                  <tr>
                                      <td colspan="5" class="text-center">No records found</td>
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
                        <h2>Recent News</h2>
                    </div>
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>
        @include('partials.admin.confirm')
    </section>
@endsection