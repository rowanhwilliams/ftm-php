@extends('admin')

@section('content')
    <section class="content">
        <script type="text/javascript">
            $(document).ready(function()
                    {
                        $("#list-table_mc").tablesorter({
                            sortList: [[0,0]]
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
              <a class="btn btn-success btn-xs" href="{{ URL::to('/admin/products/create') }}" role="button">Add</a>
          </div>
        </div>

        <div class="row">
          <table class="table table-striped" id="list-table_mc">
              <thead>
              <tr>
                  <th nowrap="">Product Title</th>
                  <th nowrap="">Product Owner</th>
                  <th nowrap="">Product Focus Type</th>
                  <th nowrap="">Product Focus Sub Type</th>
                  <th nowrap="" class="without-sort"></th>
                  <th nowrap="" class="without-sort"></th>
              </tr>
              </thead>
              <tbody>
              @if ($products->count() > 0)
                  @foreach ($products as $product)
                      <tr>
                          <td class="text-left">{!! link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title) !!}</td>
                          <td class="text-left">{!! $productOwnerList[$product->id_Product]['Company_Full_Name'] !!}</td>
                          <td class="text-left">{!! $productFocusTypeList[$product->id_Product] !!}</td>
                          <td class="text-left">{!! $productFocusSubTypeList[$product->id_Product] !!}</td>
                          <td class="text-left" width="1%">
                              {!! Form::open([ 'method'=>'DELETE', 'route' => ["admin.products.destroy", $product->id_Product], 'class' => 'pull-right']) !!}
                              {!! Form::hidden('_method', 'DELETE') !!}
                              {!! Form::hidden('_object', '_company') !!}
                              {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}
                              {!! Form::close() !!}
                          </td>
                      </tr>
                  @endforeach
              @else
              <tr>
                  <td colspan="6" class="text-center">No records found</td>
              </tr>
              @endif
              </tbody>
          </table>
        </div>
    </section>
@endsection