@extends('admin', ['no_boxes' => true])

@section('content')
    <section class="content">
        <div class="row">
            Analitics info.
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#pages" data-toggle="tab">
                                <i class="fa fa-file"></i> {{ trans('admin.fields.dashboard.pages') }}
                            </a>
                        </li>
                        <li>
                            <a href="#keywords" data-toggle="tab">
                                <i class="fa fa-key"></i> {{ trans('admin.fields.dashboard.keywords') }}
                            </a>
                        </li>
                        <li>
                            <a href="#entrance-pages" data-toggle="tab">
                                <i class="fa fa-building-o"></i> {{  trans('admin.fields.dashboard.entrance_pages') }}
                            </a>
                        </li>
                        <li>
                            <a href="#exit-pages" data-toggle="tab">
                                <i class="fa fa-power-off"></i> {{ trans('admin.fields.dashboard.exit_pages') }}
                            </a>
                        </li>
                        <li>
                            <a href="#time-pages" data-toggle="tab">
                                <i class="fa fa-clock-o"></i> {{ trans('admin.fields.dashboard.time_pages') }}
                            </a>
                        </li>
                        <li>
                            <a href="#traffic-sources" data-toggle="tab">
                                <i class="fa fa-lightbulb-o"></i> {{ trans('admin.fields.dashboard.traffic_sources') }}
                            </a>
                        </li>
                        <li>
                            <a href="#browsers" data-toggle="tab">
                                <i class="fa fa-android"></i> {{ trans('admin.fields.dashboard.browsers') }}
                            </a>
                        </li>
                        <li>
                            <a href="#os" data-toggle="tab">
                                <i class="fa fa-linux"></i> {{ trans('admin.fields.dashboard.os') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content no-padding">
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
            </div>
        </div>

    </section>
@endsection