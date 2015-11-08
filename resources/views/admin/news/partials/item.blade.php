<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('News Type', 'News Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('News Type', array('1' => 'Financing / Funding', '2' => 'Earnings / Guidance ', '3' => ' M&A', '4' => ' Recruitment Event ',
            '5' => ' Investor Day ', '6' => 'Product Award', '7' => 'Sales Win ', '8' => 'Office open / close  ', '9' => 'Product Launch / EOL', '10' => 'Mgmt Change','11' => ' Significant Hire / Promotion ','12' => ' Interview','13' => 'Regulatory Report','14' => 'Industry Research Report','15' => 'Company Whitepaper'), null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story Headline', 'Story Headline:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Story Headline', "", ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story Time', 'Story Time:', Array("style" => "font-size: 16px;")) !!}</div>
    </div>


    <div class="form-group">
        <div>{!! Form::label('Story Date', 'Story Date:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::selectRange('number',01,31) !!} {!! Form::selectMonth('month') !!} {!! Form::selectYear('Story Date', 2015, 2020) !!} </div>
    </div>



    <div class="form-group">
        <div>{!! Form::label('Story Description', 'Story Description:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Story Description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>

    <div style="font-size: 16px;">News Attachments:</div>
    <div class="form-group">
        {!! Form::label('photo', "File:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('photo', ["class" => "form-control"]) !!}

    </div>

    <div class="row">
        <div class="pull-right">
            <a class="btn btn-default btn-sm" href="#" role="button">Add</a>
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Attached to', 'Attached to:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Attached to', array('1' => 'People', '2' => 'Companies ', '3' => ' Vertical', '4' => ' Products',
            '5' => ' Events '), null, ['class' => 'form-control']) !!}</div>
    </div>


    <div class="form-group">
        <div>{!! Form::label('Attached to', 'Attached to(object name):', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('Attached to', array('1' => '', '2' => ' ', '3' => ' ', '4' => ' ',
            '5' => '  '), null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Create', array('class' => 'btn btn-default')) !!}
        </div>
    </div>

</div>