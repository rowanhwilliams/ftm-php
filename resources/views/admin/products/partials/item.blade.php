<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('product_title', 'Product Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('product_title', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('owner', 'Owner:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('owner', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_type', 'Product Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_type', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_focus', 'Product Focus:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_focus', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_focus', 'Product Focus Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_focus', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_focus', 'Product Focus Sub Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_focus', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('competitor_product', 'Competitor Product:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('competitor_product', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add New</a>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label( 'Year_Founded','First Launched:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::selectYear('Year_Founded', 1985, 2015, null, ['class'=>'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_availability_teritory', 'Product Availability Territory:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_availability_teritory', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add New</a>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('target_market', 'Target Market:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('target_market', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('target_end_user', 'Target End User:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('target_end_userl', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('asset_class', 'Asset Class:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('asset_class', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_vertical', 'Product Vertical:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_vertical', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="pull-right">
        <a class="btn btn-default btn-sm" href="#" role="button">Add</a>
    </div>
    <div class="form-group">
        <div>{!! Form::label('key_decision_maker', 'Key Decision Maker:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('key_decision_maker', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
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
        <div>{!! Form::label('FTM_product_description', 'FTM Product Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('FTM_product_description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
        </div>
    </div>
</div>