@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('user.create_user')</strong>
            </div>
            <div class="card-body card-block">
                {!! \Form::open(['route' => 'user.store', 'files' => true , 'class' => 'form-horizontal']) !!}

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="name">@lang('user.name')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! \Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="email">@lang('user.email')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! \Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="password">@lang('user.password')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {{ Form::password('password', array('id' => 'password', 'class' => 'form-control')) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="role">@lang('user.role')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! Form::select('role', $roleList, $selected, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="image">@lang('user.image')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! Form::file('image', null, ['class' => 'form-control', 'accept' => '.jpg']) !!}
                    </div>
                </div>

            </div>
            <div class="card-footer">
                {!! \Form::submit(__('user.add'), ['class' => 'btn btn-small btn-primary']) !!}
                <a class="btn btn-small btn-primary" href="{{ route('user.index') }}">@lang('user.cancel')</a>
            </div>
            {!! \Form::close() !!}
        </div>
    </div>
@stop