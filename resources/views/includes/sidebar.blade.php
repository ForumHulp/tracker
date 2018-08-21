@if(\Auth::check())
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./">Issue Tracker</a>
            <a class="navbar-brand hidden" href="./">IT</a>
        </div>
        {{--@if(\Auth::check())--}}
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <h3 class="menu-title"><i class="menu-icon fa fa-tachometer"></i> &nbsp; @lang('site.dashboard')</h3>
                    <li @if (\Request::is('issue*')) class="active" @endif><a href="{{ route('home') }}"><i class="menu-icon fa fa-crosshairs"></i>@lang('dashboard.issue')</a></li>
                    <li @if (\Request::is('status*')) class="active" @endif><a href="{{ route('status.index') }}"><i class="menu-icon fa fa-adjust"></i>@lang('dashboard.status')</a></li>
                    <li @if (\Request::is('priority*')) class="active" @endif><a href="{{ route('priority.index') }}"><i class="menu-icon fa fa-exclamation-circle"></i>@lang('dashboard.priority')</a></li>
                    <li @if (\Request::is('user*')) class="active" @endif><a href="{{ route('user.index') }}"><i class="menu-icon fa fa-user"></i>@lang('dashboard.user')</a></li>
                    <li @if (\Request::is('client*')) class="active" @endif><a href="{{ route('client.index') }}"><i class="menu-icon fa fa-user-circle-o"></i>@lang('dashboard.client')</a></li>
                    <li @if (\Request::is('project*')) class="active" @endif><a href="{{ route('project.index') }}"><i class="menu-icon fa fa-pencil-square-o"></i>@lang('dashboard.project')</a></li>
                    <li @if (\Request::is('type*')) class="active" @endif><a href="{{ route('type.index') }}"><i class="menu-icon fa fa-bookmark"></i>@lang('dashboard.type')</a></li>
                    <li @if (\Request::is('planning*')) class="active" @endif><a href="{{ route('planning.index') }}"><i class="menu-icon fa fa-calendar"></i>@lang('site.planning')</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        {{--@endif--}}
    </nav>

</aside><!-- /#left-panel -->
@endif
