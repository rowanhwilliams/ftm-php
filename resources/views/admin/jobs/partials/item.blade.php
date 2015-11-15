<script type="text/javascript">
    $(document).ready(function() {
        $("#id_Job_Family").change(function() {
            $.getJSON("{{ URL::to("admin/source") }}" +"/" + $("#id_Job_Family").val() + "/JobFamily", function(data) {
                var jobType = $("#id_Job_Type");
                jobType.empty();
                $.each(data, function(index, value) {
                    console.log(value);
                    jobType.append('<option value="' + value.id_Job_Type +'">' + value.Job_Type + '</option>');
                });
            });
        });
        $("#id_Region").change(function() {
            $.getJSON("{{ URL::to("admin/source") }}" +"/" + $("#id_Region").val() + "/GetCoutryRegion", function(data) {
                var country = $("#id_Country");
                country.empty();
                $.each(data, function(index, value) {
                    country.append('<option value="' + value.id_Country +'">' + value.Country + '</option>');
                });
            });
        });
    });
</script>
<div class="col-md-6">

    <div class="form-group">
        {{--{!! dd($companyPreference) !!}}--}}
        <div>{!! Form::label('Company', 'Company:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Company',$companies, $companyPreference->id_Company, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Why_This_Firm', 'Why this firm?', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Why_This_Firm', $companyPreference->Why_This_Firm, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Compensation_Notes', 'Compensation Notes', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Compensation_Notes', $companyPreference->Compensation_Notes, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_Family', 'Job Family:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Job_Family', $jobFamilyOptions, null, ['class' => 'form-control', "id" => "id_Job_Family"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Job_Type', 'Job Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Job_Type', $jobTypesOptions, null, ['class' => 'form-control', "id" => "id_Job_Type"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_Title', 'Job Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Job_Title', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div style="font-size: 18px">Job Location</div>
      <div class="form-group">
        <div>{!! Form::label('id_Region', 'Region', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Region', $regionsOptions, $address->getCountry()->id_Region, ['class' => 'form-control', "id" => "id_Region"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Country', $countryOptions, $address->id_Country, ['class' => 'form-control', "id" => "id_Country"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('State', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('State', $address->State, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('City', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('City', $address->City, ["class" => "form-control"]) !!}</div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('id_Target_End_User', 'Target End User', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Target_End_User', $targetEndUser, null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('id_Commission_Or_Bonus', 'Commission or Bonus?', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Commission_Or_Bonus', $commisionOrBonus, null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Job_Max_Salary', 'Job Max Salary:', Array("style" => "font-size: 16px;")) !!}</div>
        <span class="col-md-8">{!! Form::text('Job_Max_Salary', null, ["class" => "form-control"]) !!}</span>
        <span class="col-md-4">{!! Form::select('Select a curreny from a list bellow?', array('1' => 'AED ', '2' => 'AUD  ', '3' => ' CAD', '4' => ' CHF ',
                '5' => ' CHF  ', '6' => 'CNY', '7' => 'DKK ', '8' => 'EUR  ', '9' => 'GBP ', '10' => 'HKD ','11' => ' JPY  ','12' => ' NOK','13' => 'SEK',
                '14' => 'SGD','15' => 'USD ','16' => ' ZAR '), null, ['class' => 'form-control']) !!}
        </span>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Years_Experience_Required', 'Year Experience Required:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Years_Experience_Required', null, ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Percentage_Travel', 'Percentage Travel:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Percentage_Travel', null, ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::checkbox('Variable_Cap') !!} {!!  Form::label('variable_cap?', 'Variable Cap?(Y/N)', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Visa_Sponsorship_Possible') !!} {!!  Form::label('visa_sponsorship_possible?', 'Visa Sponsorship Possible?(Y/N)', Array("style" => "font-size: 16px;")) !!} </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('id_Language', 'Language:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Language', $languages, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add</a>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_Description', 'Job Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Job_Description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div style="font-size: 18px;">Job Description Attachments:</div>
    <div class="form-group">
        {!! Form::label('photo', "Job Description Attachments File Name:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('photo', ["class" => "form-control"]) !!}
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-default btn-sm" href="#" role="button">Add New</a>
            </div>
        </div>
        <div class="form-group">
            <div>{!! Form::label('Job_Requirements', 'Job Requirements', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::textarea('Job_Requirements',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
        </div>

        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                {!! Form::submit($submit_text, array('class' => 'btn btn-default btn-sm', 'name' => $submit_text)) !!}
            </div>
        </div>
    </div>
</div>
