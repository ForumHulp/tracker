@extends('layouts.default')

@section('content')
<h2>@lang('client.edit_client')</h2>
    {!! \Form::model($client, ['route' => 'client.update']) !!}
    {!! \Form::hidden('id', $client->id) !!}
    <div class="form-group">
        <label for="name">@lang('client.name')</label>
        {!! \Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="email">@lang('client.email')</label>
        {!! \Form::text('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="phone">@lang('client.phone')</label>
        {!! \Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="country">@lang('client.country')</label>
        {!! \Form::text('country', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="city">@lang('client.city')</label>
        {!! \Form::text('city', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="address">@lang('client.address')</label>
        {!! \Form::text('address', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('client.save'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('client.index') }}">@lang('client.cancel')</a>
    {!! \Form::close() !!}
@stop