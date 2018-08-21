{{--<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">--}}
    {{--<div class="container">--}}
        {{--<a class="navbar-brand" href="/">@lang('site.issue_tracker')</a>--}}
        {{--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">--}}
            {{--<span class="navbar-toggler-icon"></span>--}}
        {{--</button>--}}
        {{--<div class="collapse navbar-collapse" id="navbarResponsive">--}}
            {{--<ul class="navbar-nav ml-auto">--}}
                {{--<li class="nav-item">--}}
                	{{--@include('includes.issue_count')--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                	{{--@if (\Config::get('app.locale') == 'en')--}}
                    {{--<a class="nav-link" title="Schakel naar nederlands" href="{{ route('locale', 'nl') }}">NL</a>--}}
                    {{--@else--}}
                    {{--<a class="nav-link" title="Switch to english" href="{{ route('locale', 'en') }}">En</a>--}}
                    {{--@endif--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ route('status.index') }}">@lang('site.dashboard')</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ route('planning.index') }}">@lang('site.planning')</a>--}}
                {{--</li>--}}
				{{--<li>--}}
                {{--@if(\Auth::check())--}}
                    {{--{!! \Form::open(['route' => 'logout']) !!}--}}
                    {{--{!! \Form::submit(__('site.logout'), ['class' => 'btn btn-danger float-right']) !!}--}}
                    {{--{!! \Form::close() !!}--}}
                {{--@endif--}}
				{{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}

<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <div class="header-left">
                @if (auth()->check())<span class="d-inline-block">Welcome {{ auth()->user()->name }}</span>@endif
                {{--<a class="btn btn-link" href="{{ route('status.index') }}"><i class="fa fa-tachometer"></i> @lang('site.dashboard')</a>--}}
                {{--@if (Auth::guest())--}}
                    {{--<a class="btn btn-small btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
                {{--@endif--}}

                {{--<a class="btn btn-link" href="#"><i class="fa fa-tachometer"></i>&nbsp; Dashboard</a>--}}
            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                @if(\Auth::check())
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="/images/avatar/{{ auth()->user()->attachment }}" alt="User Avatar">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <span>{{ auth()->user()->name }}</span>
                        <span>@include('includes.issue_count')</span>
                        {{--<a class="nav-link" href="#"><i class="fa fa-power -off"></i>Logout</a>--}}

                        {!! \Form::open(['route' => 'logout']) !!}
                        {!! \Form::submit(__('site.logout'), ['class' => 'btn btn-small btn-primary']) !!}
                        {!! \Form::close() !!}
                    </div>
                @else
                    <a class="btn btn-small btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif

            </div>
            <div class="language-select dropdown" id="language-select">
                @if (\Config::get('app.locale') == 'en')
                    <a title="Schakel naar nederlands" href="{{ route('locale', 'nl') }}"><i class="flag-icon flag-icon-nl"></i></a>
                    {{--<a title="Schakel naar nederlands" href="#"><i class="flag-icon flag-icon-nl"></i></a>--}}
                @else
                    <a title="Switch to english" href="{{ route('locale', 'en') }}"><i class="flag-icon flag-icon-us"></i></a>
                    {{--<a title="Switch to english" href="#"><i class="flag-icon flag-icon-us"></i></a>--}}
                @endif
            </div>


        </div>
    </div>

</header><!-- /header -->