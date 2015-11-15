<div class="col-md-6">
    <div class="form-group">
        <div>{!! Form::label('id_News_Type', 'News Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_News_Type', $newsTypesOptions, null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story_Headline', 'Story Headline:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Story_Headline', null, ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story Time', 'Story Time:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            <span class="col-md-6">Hour: {!! Form::selectRange('Story_Hour',00,24, $Story_Date->hour, ["class" => "form-control"]) !!}</span>
            <span class="col-md-6">Minute: {!! Form::selectRange('Story_Minutes',00,60,$Story_Date->minute,["class" => "form-control"]) !!}</span>
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story_Date', 'Story Date:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            <span class="col-md-4">{!! Form::selectRange('Story_Day',01,31,$Story_Date->day,["class" => "form-control"]) !!}</span>
            <span class="col-md-4">{!! Form::selectMonth('Story_Month',$Story_Date->month,["class" => "form-control"]) !!}</span>
            <span class="col-md-4">{!! Form::selectYear('Story_Year', 2015, 2020,$Story_Date->year,["class" => "form-control"]) !!}</span>
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story_Description', 'Story Description:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Story_Description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
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
        <div>{!! Form::label('id_News_Type', 'Attached to:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_News_Type', array('1' => 'People', '2' => 'Companies ', '3' => ' Vertical', '4' => ' Products',
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
            {!! Form::submit($submit_text, array('class' => 'btn btn-default btn-sm', 'name' => $submit_text)) !!}
        </div>
    </div>
</div>