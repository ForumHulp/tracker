<!doctype html>
<html class="no-js" lang="">
<head>
    @include('includes.head')
</head>
    <body class="open">


                    @include('includes.sidebar')

        <div id="right-panel" class="right-panel">

            @include('includes.navbar')

            @yield('content')

        </div><!-- /#right-panel -->


        @include('includes.footer')

    @if( Session::has('message') || $errors->any())
	<script type="text/javascript">
	$(document).ready(function() {
		$('#myModal').modal();
	});
    </script>
    @endif 
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
    </body>
</html>



