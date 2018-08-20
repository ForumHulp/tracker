{{--@extends('layouts.default')--}}

{{--@section('content')--}}
{{--<h2>@lang('client.create_client')</h2>--}}
    {{--{!! \Form::open(['route' => 'client.store']) !!}--}}

    {{--<div class="form-group">--}}
        {{--<label for="name">@lang('client.name')</label>--}}
        {{--{!! \Form::text('name', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
        {{--<label for="email">@lang('client.email')</label>--}}
        {{--{!! \Form::text('email', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
        {{--<label for="phone">@lang('client.phone')</label>--}}
        {{--{!! \Form::text('phone', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
        {{--<label for="country">@lang('client.country')</label>--}}
        {{--{!! \Form::text('country', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
        {{--<label for="city">@lang('client.city')</label>--}}
        {{--{!! \Form::text('city', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
        {{--<label for="address">@lang('client.address')</label>--}}
        {{--{!! \Form::text('address', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}


    {{--{!! \Form::submit(__('client.add'), ['class' => 'btn btn-small btn-primary']) !!}--}}
    {{--<a class="btn btn-small btn-primary" href="{{ route('client.index') }}">@lang('client.cancel')</a>--}}
    {{--{!! \Form::close() !!}--}}
{{--@stop--}}






@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('client.create_client')</strong>
            </div>
            <div class="card-body card-block">
    {!! \Form::open(['route' => 'client.store', 'class' => 'form-horizontal']) !!}

    <div class="form-group row">
        <div class="col col-md-3">
            <label for="name">@lang('client.name')</label>
        </div>
        <div class="col-12 col-md-9">
            {!! \Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-3">
            <label for="email">@lang('client.email')</label>
        </div>
        <div class="col-12 col-md-9">
            {!! \Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-3">
            <label for="phone">@lang('client.phone')</label>
        </div>
        <div class="col-12 col-md-9">
            {!! \Form::text('phone', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-3">
            <label for="country">@lang('client.country')</label>
        </div>
        <div class="col-12 col-md-9">
            {!! \Form::text('country', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-3">
            <label for="city">@lang('client.city')</label>
        </div>
        <div class="col-12 col-md-9">
            {!! \Form::text('city', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        <div class="col col-md-3">
            <label for="address">@lang('client.address')</label>
        </div>
        <div class="col-12 col-md-9">
            {!! \Form::text('address', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

    <div class="card-footer">
    {!! \Form::submit(__('client.add'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('client.index') }}">@lang('client.cancel')</a>
    </div>
    {!! \Form::close() !!}
        </div>
    </div>
@stop