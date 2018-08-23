@if (auth()->check())
@if (auth()->user()->hasRole('manager'))
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/">Issue Tracker</a>
            <a class="navbar-brand hidden" href="/">IT</a>
        </div>
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <h3 class="menu-title"><i class="menu-icon fa fa-tachometer"></i> &nbsp; @lang('site.dashboard')</h3>
                    <li @if (\Request::is('issue*')) class="active" @endif><a href="{{ route('home') }}" title="@lang('dashboard.issue')"><i class="menu-icon fa fa-crosshairs"></i>@lang('dashboard.issue')</a></li>
                    <li @if (\Request::is('status*')) class="active" @endif><a href="{{ route('status.index') }}" title="@lang('dashboard.status')"><i class="menu-icon fa fa-adjust"></i>@lang('dashboard.status')</a></li>
                    <li @if (\Request::is('priority*')) class="active" @endif><a href="{{ route('priority.index') }}" title="@lang('dashboard.priority')"><i class="menu-icon fa fa-exclamation-circle"></i>@lang('dashboard.priority')</a></li>
                    <li @if (\Request::is('user*')) class="active" @endif><a href="{{ route('user.index') }}" title="@lang('dashboard.user')<"><i class="menu-icon fa fa-user"></i>@lang('dashboard.user')</a></li>
                    <li @if (\Request::is('client*')) class="active" @endif><a href="{{ route('client.index') }}" title="@lang('dashboard.client')"><i class="menu-icon fa fa-user-circle-o"></i>@lang('dashboard.client')</a></li>
                    <li @if (\Request::is('project*')) class="active" @endif><a href="{{ route('project.index') }}" title="@lang('dashboard.project')"><i class="menu-icon fa fa-pencil-square-o"></i>@lang('dashboard.project')</a></li>
                    <li @if (\Request::is('type*')) class="active" @endif><a href="{{ route('type.index') }}" title="@lang('dashboard.type')"><i class="menu-icon fa fa-bookmark"></i>@lang('dashboard.type')</a></li>
                    <li @if (\Request::is('planning*')) class="active" @endif><a href="{{ route('planning.index') }}" title="@lang('site.planning')"><i class="menu-icon fa fa-calendar"></i>@lang('site.planning')</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
    </nav>

</aside><!-- /#left-panel -->
@endif
@endif