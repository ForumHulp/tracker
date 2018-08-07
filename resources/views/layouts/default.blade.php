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

            @if(auth()->check() && \Request::getPathInfo() != '/')
                @if (auth()->user()->hasRole('manager'))
               <div id="dashboard" class="col-md-2">
                    @include('dashboard.sidebar')
                </div>
                @endif
            @endif
        
            <div class="@if(auth()->check() && auth()->user()->hasRole('manager') && \Request::getPathInfo() != '/') col-md-10 @else col-md-12 @endif" id="content">
                @yield('content')
            </div>

			</div>
	    </div>

        <div id="footer">
            @include('includes.footer')
        </div>

    @if( Session::has('message') || $errors->any())
	<script type="text/javascript">
	$(document).ready(function() {
		$('#myModal').modal();
	});
    </script>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Notification!!</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    {{ Session::get('message') }}
                    @if ($errors->any())
                        <ul class="@if ($errors->any()) alert @endif">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                    @endif
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            
            </div>
        </div>
    </div>
    @endif 
    </body>
</html>