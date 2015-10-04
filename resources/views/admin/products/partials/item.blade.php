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
    });
</script>
<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('Product_Title', 'Product Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Product_Title', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Owner_Company', 'Owner:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Owner_Company', $companies, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div style="border: solid 2px lightgrey; padding: 10px;">
        @if ($productFocusSubTypeList->count() > 0)
            <ul>
                @foreach($productFocusSubTypeList->toArray() as $id => $FocusSubType)
                    <li style="list-style: none" class="row small text-primary">
                        {!! \App\Models\ProductFocus::findOrNew(\App\Models\ProductFocusType::
                            findOrNew($FocusSubType['id_Product_Focus_Type'])->id_Product_Focus)->Product_Focus !!},
                        {!! \App\Models\ProductFocusType::findOrNew($FocusSubType['id_Product_Focus_Type'])->Product_Focus_Type !!},
                        {!! $FocusSubType['Product_Focus_Sub_Type'] !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
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
        {{--@if ($productCompetitors->count() > 0)--}}
            {{--<ul>--}}
                {{--@foreach($productCompetitors as $id => $productComp)--}}

                    {{--<li style="list-style: none" class="row small text-primary">--}}

                        {{--{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}--}}
                    {{--</li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--@endif--}}
        <div>{!! Form::select('id_Competitor_Product', $competitorProducts, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_competitor')) !!}
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label( 'First_Launched','First Launched:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::selectYear('First_Launched', 1985, 2015, null, ['class'=>'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Availability_Territory', 'Product Availability Territory:', Array("style" => "font-size: 16px;")) !!}</div>
        @if ($territories->count() > 0)
            <ul>
                @foreach($territories->toArray() as $id => $territory)
                    <li style="list-style: none" class="row small text-primary">
                        {!! $territory['Territory_Name'] !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                    </li>
                @endforeach
            </ul>
        @endif
        <div>{!! Form::select('id_Availability_Territory', $regions, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_teritory')) !!}
        </div>
    </div>
    <div class="form-group">
         <div>{!! Form::label('id_Target_Market', 'Target Market:', Array("style" => "font-size: 16px;")) !!}</div>
        @if ($productTargetMarket->count() > 0)
            <ul>
                @foreach($productTargetMarket->toArray() as $id => $tmarket)
                    <li style="list-style: none" class="row small text-primary">
                        {!! $tmarket['Target_Market'] !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                    </li>
                @endforeach
            </ul>
        @endif
        <div>{!! Form::select('id_Target_Market', $targetMarket, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_target_market')) !!}
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('id_Target_End_User', 'Target End User:', Array("style" => "font-size: 16px;")) !!}</div>
        @if ($productTargetEndUser->count() > 0)
            <ul>
                @foreach($productTargetEndUser->toArray() as $id => $endUser)
                    <li style="list-style: none" class="row small text-primary">
                        {!! $endUser['Target_End_User'] !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                    </li>
                @endforeach
            </ul>
        @endif
        <div>{!! Form::select('id_Target_End_User', $targetEndUser, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_target_end_user')) !!}
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Asset_Class', 'Asset Class:', Array("style" => "font-size: 16px;")) !!}</div>
        @if ($productAssetClass->count() > 0)
            <ul>
                @foreach($productAssetClass->toArray() as $id => $productAssetCl)
                    <li style="list-style: none" class="row small text-primary">
                        {!! $productAssetCl['Asset_Class'] !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                    </li>
                @endforeach
            </ul>
        @endif
        <div>{!! Form::select('id_Asset_Class', $assetClass, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_asset_class')) !!}
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Key_Decision_Maker', 'Key Decision Maker:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Key_Decision_Maker', $positions, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div style="font-size: 18px;">Product Attachments:</div>
    @if ($attachments->count() > 0)
        <ul>
            @foreach($attachments->toArray() as $id => $attachment)
                <li style="list-style: none" class="row small text-primary">
                    {!! $attachment['Attachment_File_Name'] !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
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
    <div class="form-group">
        <div>{!! Form::label('FTM_Product_Description', 'FTM Product Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('FTM_Product_Description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit($submit_text, array('class' => 'btn btn-default btn-sm', 'name' => $submit_text)) !!}
        </div>
    </div>
</div>