<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('title', 'Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('size', array('mr' => 'Mr', 'ms' => 'Ms', 'miss' => 'Miss', 'sir' => 'Sir', 'mrs' => 'Mrs', 'dr' => 'Dr', 'lady' => 'Lady', 'lord' => 'Lord')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('first_name', 'First Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('first_name') !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Midle Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name') !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('last_name', 'Last Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('last_name') !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Continent :', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('asia' => 'Asia', 'africa' => 'Africa', 'na' => 'North America', "sa" => "South America", "antarctica" => "Antarctica", "europe"=>"Europe","australia"=>"Australia")) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('country', array('uk' => 'United Kingdom', 'us' => 'United States', 'ug' => 'Uganda')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('state', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('state') !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('city', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('city') !!}</div>
    </div>
    <div style="font-size: 16px;">Upload photo:</div>
    <div class="form-group">
        {!! Form::label('photo', "File:", Array("style" => "font-size: 16px;")) !!}
        {!! Form::file('photo', null) !!}
    </div>
    <div class="form-group">
        <div>{!! Form::label('country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('country', array('uk' => 'United Kingdom', 'us' => 'United States', 'ug' => 'Uganda')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('employee_type', 'Employee Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('employee_type', array('1' => 'Employee type 1', '2' => 'Employee type 2', '3' => 'Employee type 3')) !!}</div>
    </div>
</div>
<div class="col-md-6">
    <div style="font-size: 18px">Education History</div>
    <div class="form-group">
        <div>{!! Form::label('university', 'University:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('university', array('1' => 'University 1', '2' => 'University 2', '3' => 'University 3')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('attends_date', 'Dates Attends:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::selectYear('attends_date_start', 1920, 2015) !!} - {!! Form::selectYear('attends_date_end', 1920, 2015) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('degree', 'Degree:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('degree', array('1' => 'Degree 1', '2' => 'Degree 2', '3' => 'Degree 3')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('education_description', 'Education Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('education_description') !!}</div>
    </div>

    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add</a>
        </div>
    </div>
    <div style="font-size: 18px">Career History</div>
    <div class="form-group">
        <div>{!! Form::label('company', 'Company:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('company', array('1' => 'Company 1', '2' => 'Company 2', '3' => 'Company 3')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('position', 'Position:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('position', array('1' => 'Position 1', '2' => 'Position 2', '3' => 'Position 3')) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('time_period', 'Time Period:', Array("style" => "font-size: 16px;")) !!}</div>
        <div> {!! Form::selectMonth('month') !!} {!! Form::selectYear('time_period_start', 1920, 2015) !!} - {!! Form::selectMonth('month') !!} {!! Form::selectYear('time_period_end', 1920, 2015) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('agree') !!} {!!  Form::label('time_period', 'Currently work here', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('carrer_description', 'Cereer Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('carrer_description') !!}</div>
    </div>
    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add</a>
        </div>
    </div>
</div>
