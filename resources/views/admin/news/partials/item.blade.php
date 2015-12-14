<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            $('#datetimepicker').datetimepicker({
                        showClear:true,
                        showClose: true,
                        format: 'DD-MMM-YYYY HH:mm'
            });
        });
        prepareSelection();
        $("#NewsOpjectCategory").change(prepareSelection);

        function prepareSelection() {
            var $NewsObjectItems = $("#selectElements");
            $NewsObjectItems.addClass('btn-disabled')
            $NewsObjectItems.attr('disabled', 'disabled');
            $.getJSON("{{ URL::to("admin/news") }}" +"/" + $("#NewsOpjectCategory").val() + "/options", function(data) {
                $NewsObjectItems.removeClass('btn-disabled');
                $NewsObjectItems.removeAttr('disabled');
                $NewsObjectItems.attr("data-title", "Select Attached to(object name) - " + $("#NewsOpjectCategory").val());
                $NewsObjectItems.attr("data-parent-resource", $("#NewsOpjectCategory").val());
                var $outData = [];
                $.each(data, function(index, value) {
                    switch ($("#NewsOpjectCategory").val()){
                        case 'People':
                            $outData.push({id:value.id_People, description:value.First_Name});
                            break;
                        case 'Products':
                            $outData.push({id:value.id_Product, description:value.Product_Title});
                            break;
                        case 'Companies':
                            $outData.push({id:value.id_Company, description:value.Company_Full_Name});
                            break;
                    }

                });
                $NewsObjectItems.attr("modal-data", JSON.stringify($outData));
            });
        }
    });
</script>
<style>
    #news-tags-list {
        padding: 0 0 8px 0;
    }
</style>
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
        <div id="news-tags-list">
            @foreach($IdObjectItems as $tag)
                <label class="tag label label-primary">
                    <span>{!! $tag->description !!}</span>
                    <input type="hidden" name="{!! $tag->target."_".$tag->id !!}" value='on'>
                    <a><i class="remove glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
                </label>
            @endforeach
        </div>
        <div class="clearfix">
            <div class="col-md-9">
                {!! Form::select('id_Object_Group', array('Companies' => 'Companies', 'People' => 'People',
                    'Vertical' => 'Vertical', 'Products' => 'Products', 'Events' => 'Events'), null,
                    ['class' => 'form-control', 'id'=>'NewsOpjectCategory']) !!}
            </div>
            <div class="col-md-3">
                <a class="btn btn-warning btn-sm" href="#" role="button" id="selectElements" data-toggle="modal" data-target="#customModal"
                   data-title="Select Attached to(object name) - Company" data-result-container="news-tags-list">Select Object</a>
            </div>
        </div>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">
        <div class="pull-right">
            {!! Form::submit($submit_text, array('class' => 'btn btn-success btn-sm', 'name' => $submit_text)) !!}
        </div>
    </div>
    @include('partials.admin.modals.checkbox-modal')
</div>