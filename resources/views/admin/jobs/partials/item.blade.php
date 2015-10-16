
<div class="col-md-6">

    <div class="form-group">
        <div>{!! Form::label('Company', 'Company:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Company_Preference',$companies, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('why_this_firm?', 'Why this firm?', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('why_this_firm?',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('compensation_notes', 'Compensation Notes', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('compensation_notes',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_Family', 'Job Family:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Job_Family', $jobFamily, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_job_Type', 'Job Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_job_Type', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_Title', 'Job Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Job_Title', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div style="font-size: 18px">Job Location</div>
    <div class="form-group">
        <div>{!! Form::label('City', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('City', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('state', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('state', "", ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('id_Country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            <div>{!! Form::select('id_Country', $country, null, ['class' => 'form-control']) !!}</div>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Region', 'Region', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Region', $regions, null, ['class' => 'form-control']) !!}</div>
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
        <span class="col-md-8">{!! Form::text('Job_Max_Salary', "", ["class" => "form-control"]) !!}</span>
        <span class="col-md-4">{!! Form::select('Select a curreny from a list bellow?', array('1' => 'AED ', '2' => 'AUD  ', '3' => ' CAD', '4' => ' CHF ',
                '5' => ' CHF  ', '6' => 'CNY', '7' => 'DKK ', '8' => 'EUR  ', '9' => 'GBP ', '10' => 'HKD ','11' => ' JPY  ','12' => ' NOK','13' => 'SEK',
                '14' => 'SGD','15' => 'USD ','16' => ' ZAR '), null, ['class' => 'form-control']) !!}
        </span>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Years_Experience_Required', 'Year Experience Required:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Years_Experience_Required', "", ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Percentage_Travel', 'Percentage Travel:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Percentage_Travel', "", ["class" => "form-control"]) !!}</div>
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
