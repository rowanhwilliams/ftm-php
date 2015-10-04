
<div class="col-md-6">

    <div class="form-group">
        <div>{!! Form::label('Company', 'Company:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Company', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
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
        <div>{!! Form::select('Job_Family', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_type', 'Job Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Job_type', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Job_title', 'Job Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('job_title', "", ["class" => "form-control"]) !!}</div>
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
        <div>{!! Form::label('country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            @include('admin.employee.partials.countries', ['default' => null])
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Region', 'Region', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Region', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('Target_End_User', 'Target End User', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Target_End_User', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Commission_or_Bonus?', 'Commission or Bonus?', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Commission_or_Bonus?', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Job_max_salary', 'Job Max Salary:', Array("style" => "font-size: 16px;")) !!}</div>
        <span class="col-md-8">{!! Form::text('Job_max_salary', "", ["class" => "form-control"]) !!}</span>
        <span class="col-md-4">{!! Form::select('Select a curreny from a list bellow?', array('1' => 'AED ', '2' => 'AUD  ', '3' => ' CAD', '4' => ' CHF ',
                '5' => ' CHF  ', '6' => 'CNY', '7' => 'DKK ', '8' => 'EUR  ', '9' => 'GBP ', '10' => 'HKD ','11' => ' JPY  ','12' => ' NOK','13' => 'SEK',
                '14' => 'SGD','15' => 'USD ','16' => ' ZAR '), null, ['class' => 'form-control']) !!}
        </span>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Year_experience_required', 'Year Experience Required:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Year_experience_required', "", ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('percentage_travel', 'Percentage Travel:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('percentage_travel', "", ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::checkbox('agree') !!} {!!  Form::label('variable_cap?', 'Variable Cap?(Y/N)', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('agree') !!} {!!  Form::label('visa_sponsorship_possible?', 'Visa Sponsorship Possible?(Y/N)', Array("style" => "font-size: 16px;")) !!} </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('language', 'Language:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('language', array('1' => '', '2' => '', '3' => ''), null, ['class' => 'form-control']) !!}</div>
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
            <div>{!! Form::label('Job_requirements', 'Job Requirements', Array("style" => "font-size: 16px;")) !!}</div>
            <div>{!! Form::textarea('Job_requirements',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
        </div>

        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
            </div>
        </div>
    </div>
</div>
