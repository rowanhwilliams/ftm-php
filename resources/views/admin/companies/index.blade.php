@extends('admin')

@section('content')
    <div class=" row">
        <div class="col-md-12">

        </div>
    </div>
    <section class='content'>
        {{--<script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/datatables/jquery.dataTables.min.js') }}'></script>--}}
        <script type="text/javascript">
            $(document).ready(function()
            {
//                $("#list-table_mc").tablesorter({
//                    sortList: [[0,0]]
//                });

                $("#list-table_mc").DataTable();
{{--//                $(".productsMore").hide();--}}
{{--//                $(".extraMinus").hide();--}}
                {{--$(".hideExtra").click(function() {--}}
                    {{--$("#showExtra-"+$(this).attr("data-id")).show();--}}
                    {{--$("#hideExtra-"+$(this).attr("data-id")).hide();--}}
                    {{--$("#moreProducts-"+$(this).attr("data-id")).hide()--}}
                {{--});--}}
                {{--$(".showExtra").click(function() {--}}
                    {{--$("#showExtra-"+$(this).attr("data-id")).hide();--}}
                    {{--$("#hideExtra-"+$(this).attr("data-id")).show();--}}
                    {{--$("#moreProducts-"+$(this).attr("data-id")).show()--}}
                {{--});--}}
            });
        </script>
        {{--<style type="text/css">--}}
            {{--#list-table_mc td {padding:1px}--}}
            {{--#list-table_mc .btn-xs {padding:1px 2px}--}}
            {{--table.tablesorter .tablesorter-headerAsc {--}}
                {{--background-image: url("{{ asset('images/icons/up.png') }}");--}}
                {{--background-size: 10px;--}}
                {{--padding-left: 12px;--}}
                {{--background-repeat: no-repeat;--}}
                {{--background-position: center left;--}}
            {{--}--}}
            {{--table.tablesorter .tablesorter-headerDesc {--}}
                {{--background-image: url("{{asset('images/icons/down.png')}}");--}}
                {{--background-size: 10px;--}}
                {{--padding-left: 12px;--}}
                {{--background-repeat: no-repeat;--}}
                {{--background-position: center left;--}}
            {{--}--}}
            {{--table.tablesorter .tablesorter-headerUnSorted {--}}
                {{--cursor: pointer;--}}
                {{--background-image: url("{{asset('images/icons/down.png')}}");--}}
                {{--background-size: 10px;--}}
                {{--padding-left: 12px;--}}
                {{--background-repeat: no-repeat;--}}
                {{--background-position: center left;--}}
            {{--}--}}
            {{--table.tablesorter .without-sort {--}}
                {{--background-image: none !important;--}}
            {{--}--}}
        {{--</style>--}}
          <div class="row">
              <div class="col-md-12">
                  {!! Form::open(['method'=>'POST', 'route' => ['admin.companies.search'], 'class'=>'form navbar-form searchform']) !!}
                  <div class="dropdown pull-right">
                      {!! Form::text('search', isset($search) ? $search : "", array('required', 'class'=>'form-control', 'placeholder'=>'Search for a companies...')) !!}
                      {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
                      <a class="btn btn-success" href="{{ URL::route('admin.companies.create') }}" role="button">Add</a>
                  </div>
                  <div>&nbsp;</div>
                  <div>&nbsp;</div>
                  {!! Form::close() !!}
              </div>
          </div>

          <div class="row">
              <div class="col-md-9">
              <div class="block">
                  <div class="head bg-default bg-light-ltr"><h2>Company list</h2></div>
                  <div class="content">
                  <table class="table table-striped sortable_default dataTable nm np" id="list-table_mc">
                      <thead>
                          <tr>
                              <th class="without-sort"> <i class="glyphicon glyphicon-tasks"></i></th>
                              <th nowrap="">Company Name</th>
                              <th nowrap="">Year Founded</th>
                              <th nowrap="">Employee Size</th>
                              <th nowrap="">Revenue stage</th>
                              <th>Headquarters</th>
                              <th>Website</th>
                              <th nowrap="">Product Name </th>
                          </tr>
                      </thead>
                      <tbody>
                      @if ($companies->count() > 0)
                          @foreach ($companies->get() as $id => $company)
                              <tr>
                                  <td class="text-center">
                                      {!! Form::open([ 'method'=>'DELETE', 'route' => ['admin.companies.destroy', $company->id_Company], 'class' => 'pull-center']) !!}
                                      {!! Form::hidden('_method', 'DELETE') !!}
                                      {!! Form::hidden('_object', '_company') !!}
                                      <button class='btn btn-clean btn-danger center' type='button' data-toggle="modal" data-target="#confirmDelete"
                                              data-title="Delete Company" data-message='Warning – You are about to delete {!! $company->Company_Full_Name !!}, please confirm?'
                                              data-extra-confirm="Are you sure (Y/N)?">
                                          <i class='icon-trash'></i>
                                      </button>
                                      {{--{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) !!}--}}
                                      {!! Form::close() !!}
                                  </td>
                                  <td class="text-left" nowrap="">
                                      {!! sizeof($company->Company_Full_Name) ? link_to(URL::route("admin.companies.edit", $company->id_Company),
                                              substr($company->Company_Full_Name, 0, 30).(strlen($company->Company_Full_Name) > 29 ? "..." : "")) : "-" !!}
                                  </td>
                                  <td class="text-center">{{ $company->Year_Founded > 0 ? $company->Year_Founded : ""}}</td>
                                  <td class="text-left">{{ $company->id_Employee_Size ? $company->Employee_Size : "" }}</td>
                                  <td>{{ strlen($company->Revenue_Stage) ? $company->Revenue_Stage : "" }}</td>
                                  <td class="text-left" nowrap="">{!! implode(", ", array_filter([$company->City, $company->State, $company->Country])) !!}</td>
                                  <td class="text-left">{!! sizeof($company->Website) > 0 ? link_to($company->Website, substr($company->Website, 0, 30).(strlen($company->Website) > 29 ? "..." : ""), ["target"=>"_blank"]) : "-" !!}</td>
                                  <td class="text-left">
                                      @if (count($ProductsToShow[$company->id_Company]) > 0)
                                          {!! link_to(URL::route("admin.products.edit", $ProductsToShow[$company->id_Company][0]["id"]), $ProductsToShow[$company->id_Company][0]["title"], ["target"=>"_blank"]) !!}
                                      @endif
                                      @if (count($ProductsToHide[$company->id_Company]) > 0)
                                          <span id="showExtra-{!! $company->id_Company !!}"><a class="btn btn-xs btn-primary showExtra" data-id="{!! $company->id_Company !!}"><i class="glyphicon glyphicon-plus "></i></a></span>
                                          <span id="hideExtra-{!! $company->id_Company !!}" class="extraMinus" style="display: none;"><a class="btn btn-xs btn-primary hideExtra" data-id="{!! $company->id_Company !!}"><i class="glyphicon glyphicon-minus "></i></a></span>
                                          <div id="moreProducts-{!! $company->id_Company !!}" class="productsMore" style="display: none;">
                                              @foreach ($ProductsToHide[$company->id_Company] as $product)
                                                  {!! link_to(URL::route("admin.products.edit", $product["id"]), $product["title"], ["target"=>"_blank"]) !!}
                                              @endforeach
                                          </div>
                                      @endif
                                  </td>

                              </tr>
                          @endforeach
                      @else
                          <tr>
                              <td colspan="7" class="text-center">No records found</td>
                          </tr>
                      @endif


                      </tbody>
                  </table>
                  <ul class="pagination">
                      {{--<li><a href="#">&laquo;</a></li>--}}
                      @foreach($paginationList as $index => $list)
                          @if($activePage == $index)
                              <li class="active">
                          @else
                              <li>
                                  @endif
                                  @if(isset($search))
                                      <a href="{{ URL::route("admin.companies.search") . "?page=" .  $index}}">
                                          @else
                                              <a href="{{ URL::route("admin.companies.index") . "?page=" .  $index}}">
                                                  @endif
                                                  {!! $index !!}</a>
                              </li>
                              @endforeach

                  </ul>
                  @if (count($paginationList))
                      <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                  @endif
                  <ul class="pagination">
                      <li class="{!! $activePage == "all" ? "active" : "" !!}"><a href="{{ URL::route("admin.companies.index") . "?page=all" }}">All</a></li>
                  </ul>
                  </div>
              </div>
              </div>

              {{--<div class="text-center"> {!! $companies->render() !!} </div>--}}
          </div>

        @include('partials.admin.confirm')
    </section>
@endsection