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
    <div class="form-group">
        <div>{!! Form::label('id_Product_Type', 'Product Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Product_Type', $productType, null, ['class' => 'form-control']) !!}</div>
    </div>
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
        <a class="btn btn-default btn-sm disabled" href="#" role="button">Add</a>
    </div>
    <div class="form-group">
        <div>{!! Form::label('competitor_product', 'Competitor Product:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('competitor_product', $competitorProducts, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm disabled" href="#" role="button">Add New</a>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label( 'First_Launched','First Launched:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::selectYear('First_Launched', 1985, 2015, null, ['class'=>'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_availability_teritory', 'Product Availability Territory:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_availability_teritory', $regions, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm disabled" href="#" role="button">Add New</a>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Target_Market', 'Target Market:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Target_Market', $targetMarket, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="pull-right">
        <a class="btn btn-default btn-sm disabled" href="#" role="button">Add</a>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Target_End_User', 'Target End User:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Target_End_User', $targetEndUser, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="pull-right">
        <a class="btn btn-default btn-sm disabled" href="#" role="button">Add</a>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Asset_Class', 'Asset Class:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Asset_Class', $assetClass, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="pull-right">
        <a class="btn btn-default btn-sm disabled" href="#" role="button">Add</a>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Key_Decision_Maker', 'Key Decision Maker:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Key_Decision_Maker', $positions, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div style="font-size: 18px;">Product Attachments:</div>
    <div class="form-group">
        {!! Form::label('photo', "Product Attachments File Name:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('photo', ["class" => "form-control"]) !!}
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-default btn-sm" href="#" role="button">Add New</a>
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