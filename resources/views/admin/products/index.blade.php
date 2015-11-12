@extends('admin')

@section('content')
    <section class="content">
        <style>
            #list-table_mc td {padding:1px}
            #list-table_mc .btn-xs {padding:1px 2px}
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
                  <th nowrap=""></th>
                  <th nowrap=""></th>
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
                              <a class="btn btn-danger btn-xs" href="{{ URL::route("admin.products.destroy", $product->id_Product) }}" role="button">Delete</a>
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