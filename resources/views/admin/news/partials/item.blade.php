<script type="text/javascript">
    $(document).ready(function() {
        $(function () {
            $('#datetimepicker').datetimepicker({
                showClear: true,
                showClose: true,
                format: 'DD-MMM-YYYY HH:mm'
            });
        });
    });
</script>
<script src="{{ asset('frontend/controllers/admin/adminModalSelect.js') }}"></script>
<script src="{{ asset('frontend/controllers/admin/adminModalSelectCtrl.js') }}"></script>
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
                        <span data-ng-repeat="tagsCategories in selected">
                            <label class="tag label" data-ng-repeat="tag in tagsCategories"
                               ng-class="{'label-primary':tag.target=='Companies','label-success':tag.target=='Products','label-warning':tag.target=='People'}">
                                <span><% tag.description %></span>
                                <input type="hidden" name="<% tag.target %>_<% tag.id %>" value="on">
                                <a data-ng-really-title="Remove tag from <% tag.target %> catrgory"
                                   data-ng-really-message="Do you want to remove <% tag.description %> tag from <% tag.target %> category?"
                                   data-ng-really-click="remove(tag.target,tag.id)"><i class="remove icon-white icon-remove-sign"></i></a>
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