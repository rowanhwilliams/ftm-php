@extends('admin')

@section('content')
    <section class="content">
        <script type="text/javascript">
            $(document).ready(function()
                {
                    $("#list-table_mc").tablesorter();
                }
            );
            $(document).ready(function() {
                $("#search-property li > a").click(function () {
                    $("#search-property-title").text($(this).text());
                    $("#search-filter").val(this.id);
                    return true;
                })
            });
        </script>
        <style>
            #list-table_mc td {padding:1px}
            #list-table_mc .btn-xs {padding:1px 2px}
        </style>
          <div class="row col-md-11">
              {!! Form::open(['method'=>'POST', 'route' => ['admin.companies.search'], 'class'=>'form navbar-form searchform']) !!}
              <div class="dropdown">
                  {!! Form::text('search', isset($search) ? $search : "", array('required', 'class'=>'form-control', 'placeholder'=>'Search for a companies...')) !!}
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <span id="search-property-title">Company Name</span>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="search-property">
                      <li><a href="#" id="Company_Full_Name">Company Name</a></li>
                      <li><a href="#" id="Year_Founded">Year Founded</a></li>
                      <li><a href="#" id="Company_About_Us">Company Description</a></li>
                  </ul>
                  {!! Form::hidden('search-filter', $searchFilter,['id' => 'search-filter']) !!}
                  {!! Form::submit('Search', array('class'=>'btn btn-default btn-xs')) !!}
                  <a class="btn btn-success btn-xs" href="{{ URL::route('admin.companies.create') }}" role="button">Add</a>
              </div>
              {!! Form::close() !!}

          </div>

          <div class="row">
              <table class="table table-striped" id="list-table_mc">
                  <thead>
                  <tr>
                      <th nowrap="">Company Name</th>
                      <th nowrap="">Year Founded</th>
                      <th nowrap="">Employee Size</th>
                      <th>Headquarters</th>
                      <th>Website</th>
                      <th nowrap="">Product Name </th>
                      <th colspan="2"></th>
                  </tr>
                  </thead>
                  <tbody>

                      @if ($companies->count() > 0)
                          @foreach ($companies->get() as $id => $company)
                            <tr>
                                <td class="text-left" nowrap="">{!! sizeof($company->Company_Full_Name) ? link_to(URL::route("admin.companies.edit", $company->id_Company), $company->Company_Full_Name) : "-" !!}</td>
                                <td class="text-center">{{ $company->Year_Founded > 0 ? $company->Year_Founded : ""}}</td>
                                <td class="text-left">{{ $company->id_Employee_Size ? $company->Employee_Size : "" }}</td>
                                <td class="text-left" nowrap="">{!! implode(", ", array_filter([$company->City, $company->State, $company->Country])) !!}</td>
                                <td class="text-left">{!! sizeof($company->Website) > 0 ? link_to($company->Website, $company->Website, ["target"=>"_blank"]) : "-" !!}</td>
                                <td class="text-left" nowrap>
                                    @foreach ($products as $id => $product)
                                        @if($product->id_Owner_Company == $company->id_Company)
                                            {!! link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title, ["target"=>"_blank"]) !!}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {!! Form::open([ 'method'=>'DELETE', 'route' => ['admin.companies.destroy', $company->id_Company], 'class' => 'pull-right']) !!}
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
              <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <ul class="pagination">
                  <li class="{!! $activePage == "all" ? "active" : "" !!}"><a href="{{ URL::route("admin.companies.index") . "?page=all" }}">All</a></li>
              </ul>
              {{--<div class="text-center"> {!! $companies->render() !!} </div>--}}
          </div>


    </section>
@endsection