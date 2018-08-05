<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
    <body>

        <div id="navbar">
            @include('includes.navbar')
        </div>


        <div class="container content">
        	<div class="row">

            @if(auth()->check())
                @if (auth()->user()->hasRole('manager'))
               <div id="dashboard" class="col-md-2">
                    @include('dashboard.sidebar')
                </div>
                @endif
            @endif

            <div class="@if(auth()->check() && auth()->user()->hasRole('manager')) col-md-10 @else col-md-12 @endif" id="content">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                @endif
                @yield('content')
            </div>

			</div>
	    </div>

        <div id="footer">
            @include('includes.footer')
        </div>

    </body>
</html>
