<script type="text/javascript">
    $(document).ready(function() {
        $("#product_focus").change(function() {
            $.getJSON("{{ URL::to("admin/source") }}" +"/" + $("#product_focus").val() + "/productFocusType", function(data) {
                var $productFocusType = $("#product_focus_type");
                $productFocusType.empty();
                $.each(data, function(index, value) {
                    console.log(value);
                    $productFocusType.append('<option value="' + value.id_Product_Focus_Type +'">' + value.Product_Focus_Type + '</option>');
                });
                $("#product_focus_type").trigger("change");
            });
        });
        $("#product_focus_type").change(function() {
            $.getJSON("{{ URL::to("admin/source") }}" +"/" + $("#product_focus_type").val() + "/productFocusSubType", function(data) {
                var $productFocusSubType = $("#product_focus_sub_type");
                $productFocusSubType.empty();
                $.each(data, function(index, value) {
                    console.log(value);
                    $productFocusSubType.append('<option value="' + value.id_Product_Focus_Sub_Type +'">' + value.Product_Focus_Sub_Type + '</option>');
                });
                $("#product_focus_sub_type").trigger("change");
            });
        });
        $("input[name='Acquired_Subsidiary']").change(function() {
            if(this.checked) {
                $("#UltimateParent").show();
            }
            else {
                $("#UltimateParent").hide();
            }
        });
        if($("input[name='Acquired_Subsidiary']").is(':checked'))
            $("#UltimateParent").show();  // checked
        else
            $("#UltimateParent").hide();  // unchecked
        //myApp.showPleaseWait();
    });
</script>
<div class="row">
    <div class="pull-right">
        {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
    </div>
</div>
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
    <div style="font-size: 18px">Product Information</div>
    @if($products->count() > 0)
        <div class="row">
            <div class="col-md-3 small text-warn">Product Title</div>
            <div class="col-md-4 small text-warn">Product Focus Type</div>
            <div class="col-md-5 small text-warn">Product Focus Sub Type</div>
        </div>
            @foreach($products->get() as $product)
                <?php $display = true ?>
                <div class="form-group row">
                    @foreach($productFocusTypeList[$product->id_Product] as $id => $productAttrList)
                        <div class="col-md-3 small text-primary">
                            @if($display)
                                {!! link_to(URL::route("admin.products.edit", $product->id_Product), $product->Product_Title) !!}
                                <?php $display = false ?>
                            @endif
                        </div>
                        <div class="col-md-4 small text-primary">{!! $productAttrList[0] !!}</div>
                        <div class="col-md-5 small text-primary">{!! $productAttrList[1] !!}</div>
                    @endforeach
                </div>

            @endforeach
    @else
        <div class="form-group">No product found for <b>{!! $company->Company_Full_Name !!}</b></div>
    @endif
    <div class="form-group">
        <div>{!! Form::label('Website', 'Website:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Website', null, ["class" => "form-control",'placeholder'=>'Website']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Acquired_Subsidiary') !!} {!!  Form::label('Acquired_Subsidiary', 'Acquired/Subsidiory', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group" id="UltimateParent">
        <div>{!! Form::label('id_Ultimate_Parent', 'Ultimate Parent:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Ultimate_Parent', $ultimateParent, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Graduate_Program') !!} {!!  Form::label('Graduate_Program', 'Graduate Program', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Firm_Out_Of_Business') !!} {!!  Form::label('Firm_Out_Of_Business', 'Firm out of business', Array("style" => "font-size: 16px;")) !!} </div>
    </div>

</div>
<div class="col-md-6">
    <div style="font-size: 18px">Media Contact Information</div>
    <div style="border: solid 2px lightgrey; padding: 10px;">
        @if ($mediaContacts->count() > 0)
            <ul>
                @foreach($mediaContacts->toArray() as $id => $media)
                    <li style="list-style: none" class="row small text-primary">
                        {!! $media['Full_Name_Media_Contact'] !!} Mail: {!! $media['Media_contact_Email'] !!} Phone:({!! $media['Media_Contact_Phone'] !!})
                        {{--{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_media_$id")) !!}--}}
                    </li>
                @endforeach
            </ul>
        @endif
        <div class="form-group">
            <div>{!! Form::label('Full_Name_Media_Contact', 'Full Name:', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::text('Full_Name_Media_Contact', null, ["class" => "form-control",'placeholder'=>'Full Name']) !!}</div>
        </div>
        <div class="form-group">
            <div>{!! Form::label('Media_contact_Email', 'Email:', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::text('Media_contact_Email', null, ["class" => "form-control",'placeholder'=>'Email']) !!}</div>
        </div>
        <div class="form-group">
            <div>{!! Form::label('Media_Contact_Phone', 'Phone:', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::text('Media_Contact_Phone', null, ["class" => "form-control",'placeholder'=>'Media contact phone']) !!}</div>
        </div>
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_new')) !!}
        </div>
    </div>
    <div class="row">&nbsp</div>
    <div style="font-size: 18px">Headquarters Information</div>
    <div class="form-group">
        <div>{!! Form::label('AddressLine1', 'Address Line 1:', Array("style" => "font-size: 16px;")) !!}</div>

        <div>{!! Form::text('AddressLine1', $HQAddresses->AddressLine1, ["class" => "form-control",'placeholder'=>'Address Line 1']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('AddressLine2', 'Address Line 2:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('AddressLine2', $HQAddresses->AddressLine2, ["class" => "form-control",'placeholder'=>'Address Line 2']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('City', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('City', $HQAddresses->City, ["class" => "form-control",'placeholder'=>'City']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('State', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('State', $HQAddresses->State, ["class" => "form-control",'placeholder'=>'State']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            <div>{!! Form::select('id_Country', $country, $HQAddresses->id_Country, ['class' => 'form-control']) !!}</div>
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('PostalCode', 'Postal Code:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('PostalCode', $HQAddresses->PostalCode, ["class" => "form-control",'placeholder'=>'Postal Code']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('PhoneNumber', 'Phone:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('PhoneNumber', $HQPhones->PhoneNumber, ["class" => "form-control",'placeholder'=>'Phone']) !!}</div>
    </div>
    <div style="font-size: 18px;">Company Attachments:</div>
    <div style="border: solid 2px lightgrey; padding: 10px;">
        @if ($attachments->count() > 0)
            <ul>
                @foreach($attachments->toArray() as $id => $attachment)
                    <li style="color:blue; font-weight: bold; list-style: none" class="row">
                        {!! $attachment['Attachment_File_Name'] !!}
                        {{--{!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}--}}
                    </li>
                @endforeach
            </ul>
        @endif

        <div class="form-group">
            {!! Form::label('attached_file', "Company Attachments File Name:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('attached_file', ["class" => "form-control"]) !!}
        </div>
        <div class="pull-right">
            {!! Form::submit('Attach', array('class' => 'btn btn-default btn-sm', 'name' => 'attach_file')) !!}
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
</div>
<div class="row">
    <div class="pull-right">
        {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
    </div>
</div>
