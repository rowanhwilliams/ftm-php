<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('companie_name', 'Company Full Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('companie_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('attends_date', 'Year Founded:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::selectYear('attends_date_start', 1920, 2015, null, ['class'=>'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Employee Size:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Revenue Stage:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Growth Profile:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Ownership:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Company Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Company Sub Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div style="font-size: 18px">Produc Focus Information</div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Product Focus:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Product Focus Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Product Focus Sub Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Website:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Ultimate Parent:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('1' => '0-1000', '2' => '1000-5000', '3' => '5000-50000'), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'FTM Code:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('agree') !!} {!!  Form::label('time_period', 'Acquired/Subsidiory', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('agree') !!} {!!  Form::label('time_period', 'Graduate Program', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('agree') !!} {!!  Form::label('time_period', 'Firm out of business', Array("style" => "font-size: 16px;")) !!} </div>
    </div>

    <div style="font-size: 18px">Media Contact Information</div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Full Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Email:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Phone:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
</div>





<div class="col-md-6">

    <div style="font-size: 18px">Headquarters Information</div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Address Line 1:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Address Line 2:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Phone:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('continent', 'Continent :', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('continent', array('asia' => 'Asia', 'africa' => 'Africa', 'na' => 'North America', "sa" => "South America", "antarctica" => "Antarctica", "europe"=>"Europe","australia"=>"Australia"), null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            @include('admin.employee.partials.countries', ['default' => null])
        </div>
    </div>    <div class="form-group">
        <div>{!! Form::label('state', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('state', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('city', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('city', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('midle_name', 'Postal Code:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('midle_name', "", ["class" => "form-control"]) !!}</div>
    </div>
    <div style="font-size: 18px;">Company Attachments:</div>
    <div class="form-group">
        {!! Form::label('photo', "Company Attachments File Name:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('photo', ["class" => "form-control"]) !!}
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="pull-right">
                <a class="btn btn-default btn-sm" href="#" role="button">Add New</a>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('education_description', 'Company About Us', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('education_description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('education_description', 'Ftm Company Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('education_description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>

    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Save', array('class' => 'btn btn-default')) !!}
        </div>
    </div>
</div>
