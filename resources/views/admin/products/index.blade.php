@extends('admin')

@section('content')
    <section class="content">
          <div class="row">
              <div class="pull-right">
                  <a class="btn btn-success btn-xs" href="{{ URL::to('/admin/products/create') }}" role="button">Add</a>
              </div>
          </div>

          <div class="row">
              <table class="table table-striped">
                  <thead>
                  <tr>
                      <th class="text-center">#</th>
                      <th nowrap="">Product Title</th>
                      <th nowrap="">Product Owner</th>
                      <th nowrap="">Product Focus Type</th>
                      <th nowrap="">Product Focus Sub Type</th>
                      <th nowrap=""></th>
                      <th nowrap=""></th>
                  </tr>
                  </thead>
                  <tbody>
                  @if ($products->count() > 0)
                      @foreach ($products as $product)
                          <tr>
                              <td class="text-center">{{$product->id_Product}}</td>
                              <td class="text-left">{{$product->Product_Title}}</td>
                              <td class="text-left">{{$product->owner()->first()->Company_Full_Name}}</td>
                              <td class="text-left">{{$product->focusType()->first()->Product_Focus_Type}}</td>
                              <td class="text-left">{{$product->focusSubType()->first()->Product_Focus_Sub_Type}}</td>
                              <td class="text-right" width="1%">
                                  <a class="btn btn-warning btn-xs" href="{{ URL::route("admin.products.edit", $product->id_Product) }}" role="button">Edit</a>
                              </td>
                              <td class="text-left" width="1%">
                                  <a class="btn btn-danger btn-xs" href="{{ URL::route("admin.products.destroy", $product->id_Product) }}" role="button">Delete</a>
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
          </div>


    </section>
@endsection