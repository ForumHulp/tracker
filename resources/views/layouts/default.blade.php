<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
    <body>

        <div id="navbar">
            @include('includes.navbar')
        </div>
        
        <div class="container">
        	<div class="row">

            @if(auth()->check())
                @if (auth()->user()->hasRole('manager'))
               <div id="dashboard" class="col-md-2">
                    @include('dashboard.sidebar')
                </div>
                @endif
            @endif
        
            <div class="@if(auth()->check() && auth()->user()->hasRole('manager')) col-md-10 @else col-md-12 @endif" id="content">
                @yield('content')
            </div>

			</div>
	    </div>

        <div id="footer">
            @include('includes.footer')
        </div>

    </body>
</html>