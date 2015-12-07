<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            $('#datetimepicker').datetimepicker({
                        showClear:true,
                        showClose: true,
                        format: 'DD-MMM-YYYY HH:mm'
            });
        });
        $("#NewsOpjectCategory").change(function() {
            $.getJSON("{{ URL::to("admin/news") }}" +"/" + $("#NewsOpjectCategory").val() + "/options", function(data) {
                var $NewsObjectItems = $("#NewsObjectItems");
                $NewsObjectItems.empty();
                $.each(data, function(index, value) {
                    switch ($("#NewsOpjectCategory").val()){
                        case 'People':
                            $NewsObjectItems.append('<option value="' + value.id_People +'">' + value.First_Name + '</option>');
                            break;
                        case 'Products':
                            $NewsObjectItems.append('<option value="' + value.id_Product +'">' + value.Product_Title + '</option>');
                            break;
                        case 'Companies':
                            $NewsObjectItems.append('<option value="' + value.id_Company +'">' + value.Company_Full_Name + '</option>');
                            break;
                    }

                });
            });
        });
        $("#selectElements").click(function(){
            $("#myModal").modal();
            $('#myModal').on('shown.bs.modal', function(){
                $('#myModal .load_modal').html(data);
            });
            $('#myModal').on('hidden.bs.modal', function(){
                $('#myModal .modal-body').data('');
            });
        });
    });
</script>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Attached to(object name):<span id="objectParent"></span></h4>
            </div>
            <div class="modal-body" id="modelBody">
                {{--<form role="form">--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>--}}
                        {{--<input type="text" class="form-control" id="usrname" placeholder="Enter email">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>--}}
                        {{--<input type="text" class="form-control" id="psw" placeholder="Enter password">--}}
                    {{--</div>--}}
                    {{--<div class="checkbox">--}}
                        {{--<label><input type="checkbox" value="" checked>Remember me</label>--}}
                    {{--</div>--}}
                    {{--<button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>--}}
                {{--</form>--}}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            </div>
        </div>

    </div>
</div>

<div class="col-md-push-3 col-md-6">
    <div class="row">
        <div class="pull-right">
            {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('id_News_Type', 'News Type:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_News_Type', $newsTypesOptions, null, ['class' => 'form-control']) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story_Headline', 'Story Headline:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::text('Story_Headline', null, ["class" => "form-control"]) !!}</div>
    </div>

    <div class="form-group">
        <div>{!! Form::label('Story_Date_Time', 'Story Date and Time:', Array("style" => "font-size: 16px;")) !!}</div>
        <div>
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker'>
                            {!! Form::text('Story_Date',$Story_Date, array('id' => 'datepicker','class'=>'form-control')) !!}
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

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
        <div>{!! Form::label('id_News_Group', 'Attached to:', Array("style" => "font-size: 16px;")) !!}</div>
        <div class="col-md-10">
            {!! Form::select('id_Object_Group', array('Companies' => 'Companies', 'People' => 'People',
                'Vertical' => 'Vertical', 'Products' => 'Products', 'Events' => 'Events'), $IdObjectGroup,
                ['class' => 'form-control', 'id'=>'NewsOpjectCategory']) !!}
        </div>
        <div class="col-md-2">
            <a class="btn btn-warning btn-sm" href="#" role="button" id="selectElements">Select Object</a>
        </div>
    </div>
    <div class="form-group">
        <div>{!! Form::label('Attached to', 'Attached to(object name):', Array("style" => "font-size: 16px;")) !!}</div>
        <div>{!! Form::select('id_Object_Item', $IdObjectItems, $IdObjectItemSelected, ['class' => 'form-control', 'id'=>'NewsObjectItems']) !!}</div>
    </div>

    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
        </div>
    </div>
</div>