<!DOCTYPE html>
<html lang="en" ng-app="admin">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@section('title') Admin FinTechMonitor.com @show</title>
    @section('meta_keywords')
        <meta name="keywords" content="your, awesome, keywords, here"/>
    @show @section('meta_author')
        <meta name="author" content="AY"/>
    @show

    <link href="{{ asset('themes/taurus/css/stylesheets.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css ') }}">

    @yield('styles')

    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/jquery/jquery.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/jquery/jquery-ui.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/jquery/jquery-migrate.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/jquery/globalize.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/bootstrap/bootstrap.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/datatables/jquery.dataTables.min.js') }}'></script>

    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/uniform/jquery.uniform.min.js') }}'></script>

    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/knob/jquery.knob.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/sparkline/jquery.sparkline.min.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/flot/jquery.flot.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/flot/jquery.flot.pie.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/flot/jquery.flot.categories.js') }}'></script>
    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins/flot/jquery.flot.resize.js') }}'></script>

    <script type='text/javascript' src='{{ asset('themes/taurus/js/plugins.js') }}'></script>

    <script type='text/javascript' src="{{ asset('js/moment.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    <script type='text/javascript' src="{{ asset('frontend/underscore-min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/angular.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/admin.js') }}"></script>

    <script type='text/javascript' src="{{ asset('frontend/ui-bootstrap.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('frontend/ui-bootstrap-tpls.min.js') }}"></script>

    {{--<link href="{{ asset('adm/css/bootstrap.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('adm/css/bootstrap-theme.css') }}" rel="stylesheet">--}}
    {{--<script src="{{ asset('adm/js/bootstrap.js') }}"></script>--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{ asset('assets/site/ico/favicon.ico') }}">
</head>
<body class="bg-img-num9 theme-dark">
    <base href="/">
    @include('partials.admin.nav')
    @include('partials.admin.breadcrumb')
    <div class="container">
        @include('errors.list')
        @include('partials.admin.content')
    </div>
    @include('partials.app.footer')
</body>
</html>
