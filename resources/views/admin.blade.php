<!DOCTYPE html>
<html lang="en">
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
    <script src="{{ asset('adm/js/jquery.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.tablesorter.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css ') }}">
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <link href="{{ asset('adm/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('adm/css/bootstrap-theme.css') }}" rel="stylesheet">
    <script src="{{ asset('adm/js/bootstrap.js') }}"></script>


    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="shortcut icon" href="{{{ asset('assets/site/ico/favicon.ico') }}}">
</head>
<body>
@include('partials.admin.nav')

<div class="container">
@yield('content')
</div>
@include('partials.app.footer')

<!-- Scripts -->
<script>
    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-danger').delay(3000).slideUp(300);
</script>

@yield('scripts')

</body>
</html>
