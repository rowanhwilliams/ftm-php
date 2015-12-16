<script type="text/javascript">
    $(document).ready(function() {
        $("#id_Product_Focus").change(function() {
            $.getJSON("{{ URL::to("admin/source") }}" +"/" + $("#id_Product_Focus").val() + "/productFocusType", function(data) {
                var $productFocusType = $("#id_Product_Focus_Type");
                $productFocusType.empty();
                $.each(data, function(index, value) {
                    console.log(value);
                    $productFocusType.append('<option value="' + value.id_Product_Focus_Type +'">' + value.Product_Focus_Type + '</option>');
                });
                $("#id_Product_Focus_Type").trigger("change");
            });
        });
        $("#id_Product_Focus_Type").change(function() {
            $.getJSON("{{ URL::to("admin/source") }}" +"/" + $("#id_Product_Focus_Type").val() + "/productFocusSubType", function(data) {
                var $productFocusSubType = $("#id_Product_Focus_Sub_Type");
                $productFocusSubType.empty();
                $.each(data, function(index, value) {
                    console.log(value);
                    $productFocusSubType.append('<option value="' + value.id_Product_Focus_Sub_Type +'">' + value.Product_Focus_Sub_Type + '</option>');
                });
                $("#id_Product_Focus_Sub_Type").trigger("change");
            });
        });
        $(".item-to-remove").click(function() {
            $.ajax({
                url: $(this).attr("action-route"),
                type: "post",
                data: {'_token': $('input[name=_token]').val(), 'id_Product':"{!! $products->id_Product !!}", 'container':$(this).attr("item-id")+"_"+$(this).attr("item-type")},
                success: function(data){
                   var responseData = JSON.parse(data);
                   $("#"+responseData.container).remove();
                }
            });
            return false;
        });
        $("input[name='Availability_Territory_8']").click(function() {
           $.each($("input[name^='Availability_Territory']"), function(index, item) {
               if ($(item).attr("name") != "Availability_Territory_8") {
                   $(item).prop("checked",$("input[name='Availability_Territory_8']").prop("checked"));
               }
           });
        });
    });
</script>
<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('Product_Title', 'Product Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Product_Title', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Owner_Company', 'Owner:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Owner_Company', $Companies, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div style="border: solid 2px lightgrey; padding: 10px;">
        @if ($productFocusSubTypeList->count() > 0)
            <ul class="list-unstyled">
                @foreach($productFocusSubTypeList as $id => $FocusSubType)
                    <li class="small" id="{{$FocusSubType->id_Product_Focus_Sub_Type}}_productFocusSubType">
                        {!! \App\Models\ProductFocus::findOrNew(\App\Models\ProductFocusType::
                            findOrNew($FocusSubType->id_Product_Focus_Type)->id_Product_Focus)->Product_Focus !!},
                        {!! \App\Models\ProductFocusType::findOrNew($FocusSubType->id_Product_Focus_Type)->Product_Focus_Type !!},
                        {!! $FocusSubType->Product_Focus_Sub_Type !!}
                        <a href='#' class="btn btn-danger btn-xs item-to-remove" item-id="{{$FocusSubType->id_Product_Focus_Sub_Type}}"
                           action-route="{{ URL::route("admin.products.delete", [$FocusSubType->id_Product_Focus_Sub_Type, "productFocusSubType"]) }}" item-type="productFocusSubType">Delete</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            <div>{!! Form::label('id_Product_Focus', 'Product Focus:', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::select('id_Product_Focus', $productFocus, null, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="form-group">
            <div>{!! Form::label('id_Product_Focus_Type', 'Product Focus Type:', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::select('id_Product_Focus_Type', $productFocusType, null, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="form-group">
            <div>{!! Form::label('id_Product_Focus_Sub_Type', 'Product Focus Sub Type:', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::select('id_Product_Focus_Sub_Type', $productFocusSubType, null, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_Product_Focus_Sub_type')) !!}
        </div>
    </div>

    <div class="form-group" style="padding-top: 15px;">
        <div>{!! Form::label('id_Competitor_Product', 'Competitor Product:', Array("style" => "font-size: 16px;")) !!}</div>
        @if ($productCompetitors->count() > 0)
            <ul class="list-unstyled">
                @foreach($productCompetitors as $id => $productComp)
                    <li class="small" id="{{$productComp->id_Product}}_competitor">
                        {!! $productComp->Product_Title !!}
                        <a href='#' class="btn btn-danger btn-xs item-to-remove" item-id="{{$productComp->id_Product}}"
                                    action-route="{{ URL::route("admin.products.delete", [$productComp->id_Product, "competitor"]) }}" item-type="competitor">Delete</a>
                    </li>
                @endforeach
            </ul>
        @endif
        <div>{!! Form::select('id_Competitor_Product', $competitorProducts, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_competitor')) !!}
        </div>
    </div>

    <div style="font-size: 18px;">Product Attachments:</div>
    @if ($attachments->count() > 0)
        <ul class="list-unstyled">
            @foreach($attachments as $id => $attachment)
                <li class="small" id="{{$attachment->id_Attachments ? $attachment->id_Attachments : $id}}_file">
                    {!! $attachment->Attachment_File_Name !!}
                    <a href='#' class="btn btn-danger btn-xs item-to-remove" item-id="{{$attachment->id_Attachments ? $attachment->id_Attachments : $id}}"
                       action-route="{{ URL::route("admin.products.delete", [$attachment->id_Attachments ? $attachment->id_Attachments : $id, "file"]) }}" item-type="file">Delete</a>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="form-group">
        {!! Form::label('attached_file', "Product Attachments File Name:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('attached_file', ["class" => "form-control"]) !!}
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                {!! Form::submit('Attach', array('class' => 'btn btn-default btn-sm', 'name' => 'attach_file')) !!}
            </div>
        </div>
    </div>


</div>
<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('First_Launched','First Launched:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('First_Launched', null, ['class'=>'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTMarket">
                    <div class="panel-title">
                        <div>
                            <div class="visible-lg-inline">
                                Target Market:
                            </div>
                            <div class="visible-lg-inline">
                                <a role="button" class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapseTMarket" aria-expanded="true" aria-controls="collapseTMarket">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseTMarket" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTMarket">
                    <div class="panel-body">
                        @foreach($TargetMarket as $TargetMarketItem)
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {!! Form::checkbox($TargetMarketItem->name, null, in_array($TargetMarketItem->description, $TargetMarketSelection)) !!}
                                </span>
                                <div class="form-control-static ">{{ $TargetMarketItem->description }}</div>
                            </div><!-- /input-group -->
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTEndUser">
                    <div class="panel-title">
                        <div>
                            <div class="visible-lg-inline">
                                Target End User:
                            </div>
                            <div class="visible-lg-inline">
                                <a role="button" class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapseTEndUser" aria-expanded="true" aria-controls="collapseTEndUser">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseTEndUser" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTEndUser">
                    <div class="panel-body">
                        @foreach($TargetEndUser as $TargetItem)
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {!! Form::checkbox($TargetItem->name, null, in_array($TargetItem->description, $TargetEndUserSelection)) !!}
                                </span>
                                <div class="form-control-static ">{{ $TargetItem->description }}</div>
                            </div><!-- /input-group -->
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingAssetClass">
                    <div class="panel-title">
                        <div>
                            <div class="visible-lg-inline">
                                Asset Class:
                            </div>
                            <div class="visible-lg-inline">
                                <a role="button" class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapseAssetClass" aria-expanded="true" aria-controls="collapseAssetClass">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseAssetClass" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingAssetClass">
                    <div class="panel-body">
                        @foreach($AssetClass as $AssetClassItem)
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {!! Form::checkbox($AssetClassItem->name, null, in_array($AssetClassItem->description, $ClassAssetsSelection)) !!}
                                </span>
                                <div class="form-control-static ">{{ $AssetClassItem->description }}</div>
                            </div><!-- /input-group -->
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTerritory">
                    <div class="panel-title">
                        <div>
                            <div class="visible-lg-inline">
                                Product Availability Territory:
                            </div>
                            <div class="visible-lg-inline">
                                <a role="button" class="btn btn-warning" data-toggle="collapse" data-parent="#accordion" href="#collapseTerritory" aria-expanded="true" aria-controls="collapseTerritory">Select</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="collapseTerritory" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTerritory">
                    <div class="panel-body">
                        @foreach($AvailabilityTerritory as $Territory)
                            <div class="input-group">
                                <span class="input-group-addon">
                                    {!! Form::checkbox($Territory->name, null, in_array($Territory->description, $TerritorySelection)) !!}
                                </span>
                                <div class="form-control-static ">{{ $Territory->description }}</div>
                            </div><!-- /input-group -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Key_Decision_Maker', 'Key Decision Maker:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Key_Decision_Maker', $positions, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('FTM_Product_Description', 'FTM Product Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('FTM_Product_Description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
    <div class="pull-right">
        {!! Form::submit($submit_text, array('class' => 'btn btn-default btn-sm', 'name' => $submit_text)) !!}
    </div>
</div>
