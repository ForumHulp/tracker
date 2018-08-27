<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            @if (auth()->check())
                @if (auth()->user()->hasRole('manager'))
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                @endif
            @endif
            <div class="header-left">
                @if (auth()->check())
                    <span class="d-inline-block">@lang('site.welcome') {{ auth()->user()->name }}</span>
                @else
                        <a class="navbar-brand" href="./">Issue Tracker</a>
                @endif
            </div>
            <span>@include('includes.issue_count')</span>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                @if(\Auth::check())
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         @if (auth()->user()->attachment)<img class="user-avatar rounded-circle" src="/images/avatar/{{ auth()->user()->attachment }}" alt="User Avatar">
                         @else
                         <img class="user-avatar rounded-circle" src="/images/avatar/no_avatar.jpg" alt="User Avatar">
                         @endif
                    </a>

                    <div class="user-menu dropdown-menu">
                        <span>{{ auth()->user()->name }}</span>

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
                @else
                    <a title="Switch to english" href="{{ route('locale', 'en') }}"><i class="flag-icon flag-icon-us"></i></a>
                @endif
            </div>


        </div>
    </div>

</header><!-- /header -->