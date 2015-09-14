<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('Company_Full_Name', 'Company Full Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Company_Full_Name', null, Array('class'=>'form-control','placeholder'=>'Company Full Name')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Year_Founded', 'Year Founded:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Year_Founded', null, ['class'=>'form-control','placeholder'=>'Year Founded']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Employee_Size', 'Employee Size:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Employee_Size', $employeeSize, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Revenue_Stage', 'Revenue Stage:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Revenue_Stage', $revenueStage, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Growth_Profile', 'Growth Profile:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Growth_Profile', $growthProfile, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Ownership', 'Ownership:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Ownership', $ownership, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Company_Type', 'Company Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Company_Type', $companyType, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Company_Sub_Type', 'Company Sub Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Company_Sub_Type', $companySubType, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div style="font-size: 18px">Produc Focus Information</div>
    <div class="form-group">
        <div>{!! Form::label('product_focus', 'Product Focus:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_focus', $productFocus, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_focus_type', 'Product Focus Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_focus_type', $productFocusType, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('product_focus_sub_type', 'Product Focus Sub Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('product_focus_sub_type', $productFocusSubType, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Website', 'Website:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Website', null, ["class" => "form-control",'placeholder'=>'Website']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('FinTechMonitor_Company_Code', 'FTM Code:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('FinTechMonitor_Company_Code', null, ["class" => "form-control",'placeholder'=>'FTM Code']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Acquired_Subsidiary') !!} {!!  Form::label('Acquired_Subsidiary', 'Acquired/Subsidiory', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Ultimate_Parent', 'Ultimate Parent:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Ultimate_Parent', $ultimateParent, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Graduate_Program') !!} {!!  Form::label('Graduate_Program', 'Graduate Program', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Firm_Out_Of_Business') !!} {!!  Form::label('Firm_Out_Of_Business', 'Firm out of business', Array("style" => "font-size: 16px;")) !!} </div>
    </div>

    <div style="font-size: 18px">Media Contact Information</div>
    <div class="form-group">
        <div>{!! Form::label('full_name', 'Full Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('full_name', null, ["class" => "form-control",'placeholder'=>'Full Name']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('email', 'Email:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('email', null, ["class" => "form-control",'placeholder'=>'Email']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('phone', 'Phone:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('phone', null, ["class" => "form-control",'placeholder'=>'Company Full Name']) !!}</div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add New</a>
        </div>
    </div>
</div>
<div class="col-md-6">

    <div style="font-size: 18px">Headquarters Information</div>
    <div class="form-group">
        <div>{!! Form::label('address1', 'Address Line 1:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('address1', null, ["class" => "form-control",'placeholder'=>'Address Line 1']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('address2', 'Address Line 2:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('address2', null, ["class" => "form-control",'placeholder'=>'Address Line 2']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('city', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('city', null, ["class" => "form-control",'placeholder'=>'City']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('state', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('state', null, ["class" => "form-control",'placeholder'=>'State']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            @include('admin.employee.partials.countries', ['default' => null])
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('postal_code', 'Postal Code:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('postal_code', null, ["class" => "form-control",'placeholder'=>'Postal Code']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('phone', 'Phone:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('phone', null, ["class" => "form-control",'placeholder'=>'Phone']) !!}</div>
    </div>
    <div style="font-size: 18px;">Company Attachments:</div>
    <div class="form-group">
        {!! Form::label('photo', "Company Attachments File Name:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('photo', ["class" => "form-control"]) !!}
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-default btn-sm" href="#" role="button">Add</a>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Company_About_Us', 'Company About Us:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Company_About_Us',null, ['size' => '30x2', 'class' => 'form-control','placeholder'=>'Company About Us']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Company_Description_FTM', 'Company Description:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Company_Description_FTM',null, ['size' => '30x2', 'class' => 'form-control','placeholder'=>'Company Description']) !!}</div>
    </div>

    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit($submit_text, array('class' => 'btn btn-default')) !!}
        </div>
    </div>
</div>
