<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            $('#datetimepicker').datetimepicker({
                        showClear:true,
                        showClose: true,
                        format: 'DD-MMM-YYYY HH:mm'
            });
        });
//        prepareSelection();
//        $("#NewsOpjectCategory").change(prepareSelection);

        function prepareSelection() {
            var $NewsObjectItems = $("#selectElements");
//            $NewsObjectItems.addClass('btn-disabled')
            {{--$NewsObjectItems.attr('disabled', 'disabled');--}}
            {{--$.getJSON("{{ URL::to("admin/news") }}" +"/" + $("#NewsOpjectCategory").val() + "/options", function(data) {--}}
                {{--$NewsObjectItems.removeClass('btn-disabled');--}}
                {{--$NewsObjectItems.removeAttr('disabled');--}}
                {{--$NewsObjectItems.attr("data-title", "Select Attached to(object name) - " + $("#NewsOpjectCategory").val());--}}
                {{--$NewsObjectItems.attr("data-parent-resource", $("#NewsOpjectCategory").val());--}}
                {{--var $outData = [];--}}
                {{--$.each(data, function(index, value) {--}}
                    {{--switch ($("#NewsOpjectCategory").val()){--}}
                        {{--case 'People':--}}
                            {{--$outData.push({id:value.id_People, description:value.First_Name});--}}
                            {{--break;--}}
                        {{--case 'Products':--}}
                            {{--$outData.push({id:value.id_Product, description:value.Product_Title});--}}
                            {{--break;--}}
                        {{--case 'Companies':--}}
                            {{--$outData.push({id:value.id_Company, description:value.Company_Full_Name});--}}
                            {{--break;--}}
                    {{--}--}}

                {{--});--}}
                {{--$NewsObjectItems.attr("modal-data", JSON.stringify($outData));--}}
            {{--});--}}
        }
    });
</script>
{{--<style>--}}
    {{--#news-tags-list {--}}
        {{--padding: 0 0 8px 0;--}}
    {{--}--}}
{{--</style>--}}
@include('partials.admin.modals.checkbox-modal')
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-push-3 col-md-push-3 col-sm-push-3 col-xs-push-3" ng-controller="adminModalSelect">
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
                        {!! Form::label('id_News_Type', 'News Type:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::select('id_News_Type', $newsTypesOptions, null, ['class' => 'form-control']) !!}
                    </div>
                    <div></div>
                </div>

                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('Story_Headline', 'Story Headline:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::text('Story_Headline', null, ["class" => "form-control"]) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('Story_Date_Time', 'Story Date and Time:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <div class='input-group date' id='datetimepicker'>
                            {!! Form::text('Story_Date',$Story_Date, array('id' => 'datepicker','class'=>'form-control')) !!}
                            <span class="input-group-addon">
                                <span class="icon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('Story_Description', 'Story Description:') !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::textarea('Story_Description',null, ['size' => '30x5', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {!! Form::label('photo', "News Attachments:") !!}
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('photo', "File:") !!}
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::file('photo', ["class" => "form-control"]) !!}
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a class="btn btn-primary btn-sm pull-right" href="#" role="button">Add</a>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="news-tags-list">
                        {{--@foreach($IdObjectItems as $tag)--}}
                            {{--<label class="tag label label-primary">--}}
                                {{--<span>{!! $tag->description !!}</span>--}}
                                {{--<input type="hidden" name="{!! $tag->target."_".$tag->id !!}" value='on'>--}}
                                {{--<a><i class="remove icon-white icon-remove-sign"></i></a>--}}
                            {{--</label>--}}
                        {{--@endforeach--}}
                        <span data-ng-repeat="tagsCategories in selected">
                            <label class="tag label label-primary" data-ng-repeat="tag in tagsCategories">
                                <span><% tag.description %></span>
                                <input type="hidden" name="<% tag.target %>_<% tag.id %>" value="on">
                                <a><i class="remove icon-white icon-remove-sign"></i></a>
                            </label>
                        </span>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        {!! Form::label('id_News_Group', 'Attached to:') !!}
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        {!! Form::select('id_Object_Group', array('Companies' => 'Companies', 'People' => 'People',
                                'Vertical' => 'Vertical', 'Products' => 'Products', 'Events' => 'Events'), null,
                                ['class' => 'form-control', 'id'=>'NewsOpjectCategory', 'ng-change'=>'preparation()', 'ng-model'=>'data.tagParent']) !!}
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <button type="button" class="btn btn-warning btn-sm pull-right" ng-click="open({resultContainer:'news-tags-list'})">
                            Select Object
                        </button>
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