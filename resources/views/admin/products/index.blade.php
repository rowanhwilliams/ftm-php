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
            });
        </script>

        <div class="row">
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <div class="block">
                    <div class="head bg-default bg-light-ltr">
                        <h2>Products list</h2>
                        <span class="pull-right"><a class="btn btn-success" href="{{ URL::to('/admin/products/create') }}" role="button">Add New</a></span>
                    </div>
                    <div class="content">
                        <table class="table index-table table-striped table-responsive display compact nowrap" id="table-item-list">
                            <thead>
                            <tr>
                                <th><i class="center-block icon-tasks"></i></th>
                                <th nowrap="">Product Title</th>
                                <th nowrap="">Product Owner</th>
                                <th nowrap="">Product Focus Type</th>
                                <th nowrap="">Product Focus Sub Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center" width="1%">
                                            {!! Form::open([ 'method'=>'DELETE', 'route' => ["admin.products.destroy", $product->id_Product], 'class' => 'pull-center']) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::hidden('_object', '_company') !!}
                                            <button class='btn btn-xs btn-danger center btn-clean' type='button' data-toggle="modal" data-target="#confirmDelete"
                                                    data-title="Delete Product" data-message='Warning – You are about to delete {!! $product->Product_Title !!}, please confirm?'
                                                    data-extra-confirm="Are you sure (Y/N)?">
                                                <i class='icon-trash'></i>
                                            </button>

                                            {!! Form::close() !!}
                                        </td>
                                        <td class="text-left">{!! link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title) !!}</td>
                                        <td class="text-left">{!! $product->owner()->first()->Company_Full_Name !!}</td>
                                        <td class="text-left">
                                            @foreach($product->focusSubType()->get() as $productFocusSubType )
                                                <div>
                                                    {!! $productFocusSubType->Product_Focus_Sub_Type !!}
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="text-left">
                                            @foreach($product->focusSubType()->get() as $productFocusSubType )
                                                <div>
                                                    {!! $productFocusSubType->focusType()->first()->Product_Focus_Type !!}
                                                </div>
                                            @endforeach
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
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <div class="block">
                    <div class="head bg-default bg-light-ltr">
                        <h2>Recent products</h2>
                    </div>
                    <div class="content">
                    </div>
                </div>
            </div>
        </div>
        @include('partials.admin.confirm')
    </section>
@endsection