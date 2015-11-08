<script type="text/javascript">
    $(document).ready(function() {
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
        <div>{!! Form::label('title', 'Title:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_People_Title', $peopleTitle, null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('First_Name', 'First Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('First_Name', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Middle_Name', 'Midle Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Middle_Name', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Surname', 'Last Name:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Surname', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Availability_Territory', 'Region:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Region', $regions, null, ['class' => 'form-control', 'id' => 'id_Region']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_Country', 'Country:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Country', $country, null, ['class' => 'form-control', 'id' => 'id_Country']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('State', 'State:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('State', $address->State, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('City', 'City:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('City', $address->City, ["class" => "form-control"]) !!}</div>
    </div>
    <div style="font-size: 16px;">Upload photo:</div>
    <div class="form-group">
        {!! Form::label('photo', "File:", Array("style" => "font-size: 16px;")) !!}{!! Form::file('photo', ["class" => "form-control"]) !!}

    </div>

    <div class="form-group">
        <div>{!! Form::label('id_Employee_Type', 'Employee Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Employee_Type',$employeeType, $employee->id_Employee_Type, ['class' => 'form-control']) !!}</div>
    </div>
</div>
<div class="col-md-6">
    <div style="font-size: 18px">Education History</div>
    @if ($universityHisttory->count() > 0)
        <ul>
            @foreach($universityHisttory as $id => $historyItem)
                <li style="color:blue; font-weight: bold; list-style: none" class="row">
                    {!! $historyItem->University_Name !!}
                    {!! $historyItem->Degree_title !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="form-group">
        <div>{!! Form::label('University_Name', 'University:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('University_Name', null, ['class' => 'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('attends_date', 'Dates Attends:', Array("style" => "font-size: 16px;")) !!}</div>
        <div class="col-md-5">{!! Form::selectYear('Start_year', 1920, 2015, null, ['class'=>'form-control']) !!}</div>
        <div class="col-md-2"> - </div>
        <div class="col-md-5">{!! Form::selectYear('Finish_year', 1920, 2015, null, ['class'=>'form-control']) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Degree_title', 'Degree:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Degree_title', null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_education')) !!}
        </div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Education_Description', 'Education Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Education_Description',$employee->Education_Description, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>

    <div style="font-size: 18px">Career History</div>
    @if ($careerHistory->count() > 0)
        <ul>
            @foreach($careerHistory as $id => $historyItem)
                <li style="color:blue; font-weight: bold; list-style: none" class="row">
                    {!! $historyItem->Company_Name !!}
                    {!! $historyItem->Position_Name !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                </li>
            @endforeach
        </ul>
    @endif
    <div class="form-group">
        <div>{!! Form::label('Company_Name', 'Company:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Company_Name', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Position_Name', 'Position:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Position_Name', null, ["class" => "form-control"]) !!}</div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('time_period', 'Time Period:', Array("style" => "font-size: 16px;")) !!}</div>
        <div class="row">
            <div class="col-md-2">From:</div>
            <div class="col-md-5">{!! Form::selectMonth('Start_Month', null, ['class' => 'form-control']) !!}</div>
            <div class="col-md-5">{!! Form::selectYear('Start_year', 1920, 2015, null, ['class' => 'form-control']) !!}</div>
        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-2">To:</div>
            <div class="col-md-5">{!! Form::selectMonth('Finish_Month', null, ['class' => 'form-control']) !!}</div>
            <div class="col-md-5">{!! Form::selectYear('Finish_year', 1920, 2015, null, ['class' => 'form-control']) !!}</div>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::checkbox('Current_Position_Status') !!} {!!  Form::label('time_period', 'Currently work here', Array("style" => "font-size: 16px;")) !!} </div>
    </div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit('Add', array('class' => 'btn btn-default btn-sm', 'name' => 'add_career')) !!}
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Career_Description', 'Cereer Description', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::textarea('Career_Description',null, ['size' => '30x2', 'class' => 'form-control']) !!}</div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit($submit_text, array('class' => 'btn btn-default btn-sm', 'name' => $submit_text)) !!}
        </div>
    </div>
</div>
