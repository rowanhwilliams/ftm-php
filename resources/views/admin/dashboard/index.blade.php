@extends('admin', ['no_boxes' => true])

@section('content')
    <style>
        /* custom inclusion of right, left and below tabs */

        .tabs-below > .nav-tabs,
        .tabs-right > .nav-tabs,
        .tabs-left > .nav-tabs {
            border-bottom: 0;
        }

        .tab-content > .tab-pane,
        .pill-content > .pill-pane {
            display: none;
        }

        .tab-content > .active,
        .pill-content > .active {
            display: block;
        }

        .tabs-below > .nav-tabs {
            border-top: 1px solid #ddd;
        }

        .tabs-below > .nav-tabs > li {
            margin-top: -1px;
            margin-bottom: 0;
        }

        .tabs-below > .nav-tabs > li > a {
            -webkit-border-radius: 0 0 4px 4px;
            -moz-border-radius: 0 0 4px 4px;
            border-radius: 0 0 4px 4px;
        }

        .tabs-below > .nav-tabs > li > a:hover,
        .tabs-below > .nav-tabs > li > a:focus {
            border-top-color: #ddd;
            border-bottom-color: transparent;
        }

        .tabs-below > .nav-tabs > .active > a,
        .tabs-below > .nav-tabs > .active > a:hover,
        .tabs-below > .nav-tabs > .active > a:focus {
            border-color: transparent #ddd #ddd #ddd;
        }

        .tabs-left > .nav-tabs > li,
        .tabs-right > .nav-tabs > li {
            float: none;
        }

        .tabs-left > .nav-tabs > li > a,
        .tabs-right > .nav-tabs > li > a {
            min-width: 74px;
            margin-right: 0;
            margin-bottom: 3px;
        }

        .tabs-left > .nav-tabs {
            float: left;
            margin-right: 19px;
            border-right: 1px solid #ddd;
        }

        .tabs-left > .nav-tabs > li > a {
            margin-right: -1px;
            -webkit-border-radius: 4px 0 0 4px;
            -moz-border-radius: 4px 0 0 4px;
            border-radius: 4px 0 0 4px;
        }

        .tabs-left > .nav-tabs > li > a:hover,
        .tabs-left > .nav-tabs > li > a:focus {
            border-color: #eeeeee #dddddd #eeeeee #eeeeee;
        }

        .tabs-left > .nav-tabs .active > a,
        .tabs-left > .nav-tabs .active > a:hover,
        .tabs-left > .nav-tabs .active > a:focus {
            border-color: #ddd transparent #ddd #ddd;
            *border-right-color: #ffffff;
        }

        .tabs-right > .nav-tabs {
            float: right;
            margin-left: 19px;
            border-left: 1px solid #ddd;
        }

        .tabs-right > .nav-tabs > li > a {
            margin-left: -1px;
            -webkit-border-radius: 0 4px 4px 0;
            -moz-border-radius: 0 4px 4px 0;
            border-radius: 0 4px 4px 0;
        }

        .tabs-right > .nav-tabs > li > a:hover,
        .tabs-right > .nav-tabs > li > a:focus {
            border-color: #eeeeee #eeeeee #eeeeee #dddddd;
        }

        .tabs-right > .nav-tabs .active > a,
        .tabs-right > .nav-tabs .active > a:hover,
        .tabs-right > .nav-tabs .active > a:focus {
            border-color: #ddd #ddd #ddd transparent;
            *border-left-color: #ffffff;
        }

    </style>
    <script src="{{ asset("js/chart.js") }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            var companyData = [
                {
                    value: 80,
                    color:"#3F9F3F"
                },
                {
                    value : 1682-80,
                    color : "#FFFFFF"
                }
            ], peopleData = [
                {
                    value: 10,
                    color:"#3F9F3F"
                },
                {
                    value : 15-10,
                    color : "#FFFFFF"
                }
            ],newsData = [
                {
                    value: 18,
                    color:"#3F9F3F"
                },
                {
                    value : 18-18,
                    color : "#FFFFFF"
                }
            ], productData = [
                {
                    value: 10,
                    color:"#3F9F3F"
                },
                {
                    value : 15-10,
                    color : "#FFFFFF"
                }
            ];

            var companyPie = new Chart(document.getElementById("companyCanvas").getContext("2d")).Doughnut(companyData,{percentageInnerCutout : 80});
            var peoplePie = new Chart(document.getElementById("peopleCanvas").getContext("2d")).Doughnut(peopleData,{percentageInnerCutout : 80});
            var newsPie = new Chart(document.getElementById("newsCanvas").getContext("2d")).Doughnut(newsData,{percentageInnerCutout : 80});
            var productsPie = new Chart(document.getElementById("productsCanvas").getContext("2d")).Doughnut(productData,{percentageInnerCutout : 80});
        });
    </script>
    <section class="content">
        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#one" data-toggle="tab">Statistics per month</a></li>
                <li><a href="#two" data-toggle="tab">Statistics</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="one">
                    <div class="cleatfix">
                        <div class="col-md-5 center">
                            <div class="text-center wight">Company
                                <canvas id="companyCanvas" height="100" width="100"></canvas>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-left wight">People
                                <canvas id="peopleCanvas" height="100" width="100"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="cleatfix">
                        <div class="col-md-5 center">
                            <div class="text-center wight">News
                                <canvas id="newsCanvas" height="100" width="100"></canvas>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-left wight">Products
                                <canvas id="productsCanvas" height="100" width="100"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane" id="two">

                </div>
            </div>
        </div>

        {{--<div class="row text-center">--}}

            {{--This page is currently under construction.--}}
        {{--</div>--}}


        {{--<div class="row">--}}
            {{--<div class="col-md-10">--}}
                {{--<div class="nav-tabs-custom">--}}
                    {{--<ul class="nav nav-tabs">--}}
                        {{--<li class="active">--}}
                            {{--<a href="#pages" data-toggle="tab">--}}
                                {{--<i class="fa fa-file"></i> {{ trans('admin.fields.dashboard.pages') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#keywords" data-toggle="tab">--}}
                                {{--<i class="fa fa-key"></i> {{ trans('admin.fields.dashboard.keywords') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#entrance-pages" data-toggle="tab">--}}
                                {{--<i class="fa fa-building-o"></i> {{  trans('admin.fields.dashboard.entrance_pages') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#exit-pages" data-toggle="tab">--}}
                                {{--<i class="fa fa-power-off"></i> {{ trans('admin.fields.dashboard.exit_pages') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#time-pages" data-toggle="tab">--}}
                                {{--<i class="fa fa-clock-o"></i> {{ trans('admin.fields.dashboard.time_pages') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#traffic-sources" data-toggle="tab">--}}
                                {{--<i class="fa fa-lightbulb-o"></i> {{ trans('admin.fields.dashboard.traffic_sources') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#browsers" data-toggle="tab">--}}
                                {{--<i class="fa fa-android"></i> {{ trans('admin.fields.dashboard.browsers') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<a href="#os" data-toggle="tab">--}}
                                {{--<i class="fa fa-linux"></i> {{ trans('admin.fields.dashboard.os') }}--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<div class="tab-content no-padding">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-2">--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="row">--}}
            {{--<div class="col-xs-12">--}}
            {{--</div>--}}
        {{--</div>--}}

    </section>
@endsection