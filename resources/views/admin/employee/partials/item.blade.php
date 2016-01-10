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
        $('#starYearAttends').datetimepicker({
            showClear: true,
            showClose: true,
            format: 'DD-MMM-YYYY'
        });
        $('#finishYearAttends').datetimepicker({
            showClear: true,
            showClose: true,
            format: 'DD-MMM-YYYY'
        });
        $('#starYearJob').datetimepicker({
            showClear: true,
            showClose: true,
            format: 'DD-MMM-YYYY'
        });
        $('#finishYearJob').datetimepicker({
            showClear: true,
            showClose: true,
            format: 'DD-MMM-YYYY'
        });
    });
</script>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-push-3 col-md-push-3 col-sm-push-3 col-xs-push-3">
        <div class="block">
            <div class="header">
                <h2>{!! $BlockHeader !!}</h2>
                <div class="pull-right">
                    {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
                </div>
            </div>
            <div class="content">
                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <div class="head np tac">
                            <img src="themes/taurus/img/user.jpg" class="img-thumbnail img-circle"/>
                        </div>
                        <div class="">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="input-group file">
                                        <input type="text" class="form-control" value="img/example/user/dmitry_b.jpg"/>
                                        <input type="file" name="file"/>
                                    <span class="input-group-btn">
                                        <button class="btn" type="button">Browse</button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 np">
                        <div class="form-row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                {!! Form::label('title', 'Title:') !!}
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                {!! Form::select('id_People_Title', $peopleTitle, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                {!! Form::label('First_Name', 'First Name:') !!}
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                {!! Form::text('First_Name', null, ["class" => "form-control"]) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                {!! Form::label('Middle_Name', 'Midle Name:') !!}
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                {!! Form::text('Middle_Name', null, ["class" => "form-control"]) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                {!! Form::label('Surname', 'Last Name:') !!}
                            </div>
                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                {!! Form::text('Surname', null, ["class" => "form-control"]) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('id_Availability_Territory', 'Region:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::select('id_Region', $regionsOptions, $address->getCountry()->id_Region, ['class' => 'form-control', 'id' => 'id_Region']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('id_Country', 'Country:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::select('id_Country', $countryOptions, $address->id_Country, ['class' => 'form-control', 'id' => 'id_Country']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('State', 'State:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::text('State', $address->State, ["class" => "form-control"]) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('City', 'City:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::text('City', $address->City, ["class" => "form-control"]) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('id_Employee_Type', 'Employee Type:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::select('id_Employee_Type',$employeeType, $employee->id_Employee_Type, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-row">

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-row">{!! Form::label('Education_History', 'Education History:') !!}</div>
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {!! Form::label('University_Name', 'University:') !!}
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                {!! Form::text('University_Name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {!! Form::label('Degree_title', 'Degree:') !!}
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                {!! Form::text('Degree_title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {!! Form::label('attends_date', 'Dates Attends:') !!}
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class='input-group date' id='starYearAttends'>
                                    {!! Form::text('Start_year',null, array('id' => 'starYear','class'=>'form-control')) !!}
                                    <span class="input-group-addon">
                                        <span class="icon-calendar-empty"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class='input-group date' id='finishYearAttends'>
                                    {!! Form::text('Finish_year',null, array('id' => 'finishYear','class'=>'form-control')) !!}
                                    <span class="input-group-addon">
                                        <span class="icon-calendar-empty"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="pull-right">
                                    {!! Form::submit('Add', array('class' => 'btn btn-warning btn-sm pull-right', 'name' => 'add_education')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                {!! Form::label('Education_Description', 'Education Description') !!}
                            </div>
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                {!! Form::textarea('Education_Description',$employee->Education_Description, ['size' => '20x3', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-row">{!! Form::label('Career_History', 'Career History:') !!}</div>
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {!! Form::label('Company_Name', 'Company:') !!}
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                {!! Form::text('Company_Name', null, ["class" => "form-control"]) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {!! Form::label('Position_Name', 'Position:') !!}
                            </div>
                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                {!! Form::text('Position_Name', null, ["class" => "form-control"]) !!}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                {!! Form::label('time_period', 'Time Period:') !!}
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class='input-group date' id='starYearJob'>
                                    {!! Form::text('Start_Month',null, array('id' => 'starYearJ','class'=>'form-control')) !!}
                                    <span class="input-group-addon">
                                        <span class="icon-calendar-empty"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class='input-group date' id='finishYearJob'>
                                    {!! Form::text('Finish_Month',null, array('id' => 'finishYearJ','class'=>'form-control')) !!}
                                    <span class="input-group-addon">
                                        <span class="icon-calendar-empty"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                {!! Form::checkbox('Current_Position_Status') !!} {!!  Form::label('time_period', 'Currently work here') !!}
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="pull-right">
                                    {!! Form::submit('Add', array('class' => 'btn btn-warning btn-sm', 'name' => 'add_career')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                {!! Form::label('Career_Description', 'Cereer Description') !!}
                            </div>
                            <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
                                {!! Form::textarea('Career_Description',null, ['size' => '20x3', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="pull-right">
                        {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    @if ($universityHisttory->count() > 0)
        <ul>
            @foreach($universityHisttory as $id => $historyItem)
                <li class="row">
                    {!! $historyItem->University_Name !!}
                    {!! $historyItem->Degree_title !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                </li>
            @endforeach
        </ul>
    @endif
    @if ($careerHistory->count() > 0)
        <ul>
            @foreach($careerHistory as $id => $historyItem)
                <li class="row">
                    {!! $historyItem->Company_Name !!}
                    {!! $historyItem->Position_Name !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'name' => "del_attachment_$id")) !!}
                </li>
            @endforeach
        </ul>
    @endif
</div>
