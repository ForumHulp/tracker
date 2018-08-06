@extends('layouts.default')

@section('content')
<h2>@lang('user.create_user')</h2>
    {!! \Form::open(['route' => 'user.store']) !!}

    <div class="form-group">
        <label for="name">@lang('user.name')</label>
        {!! \Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="email">@lang('user.email')</label>
        {!! \Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="password">@lang('user.password')</label>
        {{ Form::password('password', array('id' => 'password', 'class' => 'form-control')) }}
    </div>

    <div class="form-group">
        <label for="role">@lang('user.role')</label>
        {!! Form::select('role', $roleList, $selected, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('user.add'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('user.index') }}">@lang('user.cancel')</a>
    {!! \Form::close() !!}
@stop