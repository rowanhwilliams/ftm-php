<div class="row nm">
    <div class="col-md-12">
        <div class="navbar brb" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{!!(Request::is('admin') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/') }}"><i class="fa fa-1x fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="{!!(Request::is('admin/verticals') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/') }}">Verticals</a>
                    </li>
                    <li class="{!!(Request::is('admin/companies') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/companies') }}">Companies</a>
                    </li>
                    <li class="{!!(Request::is('admin/news') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/news') }}">News</a>
                    </li>
                    <li class="{!!(Request::is('admin/products') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/products') }}">Products</a>
                    </li>
                    <li class="{!!(Request::is('admin/events') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/') }}">Events</a>
                    </li>
                    <li class="{!!(Request::is('admin/indices') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/') }}">Indices</a>
                    </li>
                    <li class="{!!(Request::is('admin/jobs') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/jobs') }}">Jobs</a>
                    </li>
                    <li class="{!!(Request::is('admin/employee') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/employee') }}">People</a>
                    </li>
                    <li class="{!!(Request::is('admin/cities') ? 'active' : '')!!}">
                        <a href="{{ URL::to('/admin/') }}">Cities</a>
                    </li>

                </ul>

                {{--<ul class="nav navbar-nav navbar-right">--}}
                    {{--@if (Auth::guest())--}}
                        {{--<li class="{{ (Request::is('auth/login') ? 'active' : '') }}"><a href="{{ URL::to('auth/login') }}"><i--}}
                                        {{--class="fa fa-sign-in"></i> Login</a></li>--}}
                        {{--<li class="{{ (Request::is('auth/register') ? 'active' : '') }}"><a--}}
                                    {{--href="{{ URL::to('auth/register') }}">Register</a></li>--}}
                    {{--@else--}}
                        {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                               {{--aria-expanded="false"><i class="fa fa-user"></i> {{ Auth::user()->name }} <i--}}
                                        {{--class="fa fa-caret-down"></i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                                {{--@if(Auth::check())--}}
                                    {{--@if(Auth::user()->userType=='admin')--}}
                                        {{--<li>--}}
                                            {{--<a href="{{ URL::to('admin') }}"><i class="fa fa-tachometer"></i> Dashboard </a>--}}
                                        {{--</li>--}}
                                    {{--@endif--}}
                                    {{--<li role="presentation" class="divider"></li>--}}
                                {{--@endif--}}
                                {{--<li>--}}
                                    {{--<a href="{{ URL::to('auth/logout') }}"><i class="fa fa-sign-out"></i> Logout </a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
            </div>
        </div>
    </div>
</div>