@extends('admin')

@section('content')
    <section class="content">
          <div class="row">

              <div class="col-md-11">
                  {!! Form::open(['method'=>'POST', 'route' => ['admin.companies.search'], 'class'=>'form navbar-form navbar-right searchform']) !!}
                  {!! Form::text('search', $search, array('required', 'class'=>'form-control', 'placeholder'=>'Search for a companies...')) !!}
                  {!! Form::submit('Search', array('class'=>'btn btn-xs')) !!}
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
                                <td class="text-left">{{ sizeof($company->Company_Full_Name) ? $company->Company_Full_Name : "-"}}</td>
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