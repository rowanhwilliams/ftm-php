@extends('admin')

@section('content')
    <section class="content">
        <script type="text/javascript">
            $(document).ready(function() {
                $("#search-property li > a").click(function () {
                    $("#search-property-title").text($(this).text());
                    $("#search-filter").val(this.id);
                    return true;
                })
            });
        </script>
          <div class="row">

              <div class="col-md-11">
                  {!! Form::open(['method'=>'POST', 'route' => ['admin.companies.search'], 'class'=>'form navbar-form searchform']) !!}
                  <div class="row">
                      <div class="col-lg-11">
                          <div class="input-group">

                              <div class="input-group-btn">
                                  <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span id="search-property-title">Company Name</span><span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right" id="search-property">
                                      <li><a href="#" id="Company_Full_Name">Company Name</a></li>
                                      <li><a href="#" id="Year_Founded">Year Founded</a></li>
                                      <li><a href="#" id="Company_About_Us">Company Description</a></li>
                                  </ul>
                                  {!! Form::text('search', $search, array('required', 'class'=>'form-control', 'placeholder'=>'Search for a companies...')) !!}
                                  {!! Form::hidden('search-filter', $searchFilter,['id' => 'search-filter']) !!}
                              </div><!-- /btn-group -->
                          </div><!-- /input-group -->
                          {!! Form::submit('Search', array('class'=>'btn btn-xs')) !!}
                      </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->
                  {!! Form::close() !!}
              </div>
              <div class="col-md-1">
                  <a class="btn btn-success btn-xs" href="{{ URL::route('admin.companies.create') }}" role="button">Add</a>
              </div>

          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th nowrap="">Company Name</th>
                      <th nowrap="">Year Founded</th>
                      <th nowrap="">Employee Size</th>
                      <th>Website</th>
                      <th nowrap="">Product Name </th>
                      <th colspan="2"></th>
                  </tr>
                  </thead>
                  <tbody>

                      @if ($companies->count() > 0)
                          @foreach ($companies as $id => $company)
                            <tr>
                                <td class="text-left">{!! sizeof($company->Company_Full_Name) ? link_to(URL::route("admin.companies.edit", $company->id_Company), $company->Company_Full_Name) : "-" !!}</td>
                                <td class="text-center">{{ $company->Year_Founded > 0 ? $company->Year_Founded : "-"}}</td>
                                <td class="text-left">{{ $company->id_Employee_Size ? $employeeSize->find($company->id_Employee_Size)->Employee_Size : "-" }}</td>
                                <td class="text-left">{!! sizeof($company->Website) > 0 ? link_to($company->Website) : "-" !!}</td>
                                <td class="text-left" nowrap>
                                    @foreach ($products as $id => $product)
                                        @if($product->id_Owner_Company == $company->id_Company)
                                            {!! link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title) !!}
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning btn-xs" href="{{ URL::route("admin.companies.edit", $company->id_Company) }}" role="button">Edit</a>
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
                            <td colspan="7" class="text-center">No records found</td>
                        </tr>
                      @endif


                  </tbody>
              </table>
              <div class="text-center"> {!! $companies->render() !!} </div>
          </div>


    </section>
@endsection