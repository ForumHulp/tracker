<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Issue Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Knop 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Knop 2</a>
                </li>
				<li>
                @if(\Auth::check())
                    {!! \Form::open(['route' => 'logout']) !!}
                    {!! \Form::submit('Uitloggen', ['class' => 'btn btn-danger float-right']) !!}
                    {!! \Form::close() !!}
                @endif
				</li>
            </ul>
        </div>
    </div>
</nav>