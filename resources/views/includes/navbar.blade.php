<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">@lang('site.issue_tracker')</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                	@include('includes.issue_count')
                </li>
                <li class="nav-item">
                	@if (\Config::get('app.locale') == 'en')
                    <a class="nav-link" title="Schakel naar nederlands" href="{{ route('locale', 'nl') }}">NL</a>
                    @else
                    <a class="nav-link" title="Switch to english" href="{{ route('locale', 'en') }}">En</a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('status.index') }}">@lang('site.dashboard')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('planning.index') }}">@lang('site.planning')</a>
                </li>
				<li>
                @if(\Auth::check())
                    {!! \Form::open(['route' => 'logout']) !!}
                    {!! \Form::submit(__('site.logout'), ['class' => 'btn btn-danger float-right']) !!}
                    {!! \Form::close() !!}
                @endif
				</li>
            </ul>
        </div>
    </div>
</nav>