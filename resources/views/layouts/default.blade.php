<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
    <body>

        <div id="navbar">
            @include('includes.navbar')
        </div>

        <div class="container-fluid" id="content">
            @yield('content')
        </div>

        <div id="footer">
            @include('includes.footer')
        </div>

    </body>
</html>