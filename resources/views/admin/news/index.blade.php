@extends('admin')

@section('content')
    <section class="content">
        <style>
            #list-table_mc td {padding:1px}
            #list-table_mc .btn-xs {padding:1px 2px}
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
                  <th nowrap="">News Description</th>
                  <th nowrap=""></th>
                  <th></th>
              </tr>
              </thead>
              <tbody>
                  @if ($news->count() > 0)
                      @foreach ($news as $id => $newsItem)
                          <tr>
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
                          <td colspan="3" class="text-center">No records found</td>
                      </tr>
                  @endif
              </tbody>
          </table>
        </div>

    </section>
@endsection