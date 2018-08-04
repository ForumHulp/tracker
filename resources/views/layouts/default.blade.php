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

            @if(\Auth::check())
            <div id="dashboard" class="col-md-2">
                @include('dashboard.sidebar')
            </div>
            @endif
        
            <div class="@if(\Auth::check()) col-md-10 @else col-md-12 @endif" id="content">
                @yield('content')
            </div>

			</div>
	    </div>

        <div id="footer">
            @include('includes.footer')
        </div>

    </body>
</html>