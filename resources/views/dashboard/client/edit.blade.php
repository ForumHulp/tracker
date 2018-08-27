@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('client.edit')</strong>
            </div>
            <div class="card-body card-block">
                {!! \Form::model($client, ['route' => 'client.update', 'class' => 'form-horizontal']) !!}
                {!! \Form::hidden('id', $client->id) !!}

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
                {!! \Form::submit(__('client.save'), ['class' => 'btn btn-small btn-primary']) !!}
                <a class="btn btn-small btn-primary" href="{{ route('client.index') }}">@lang('client.cancel')</a>
            </div>
            {!! \Form::close() !!}
        </div>
    </div>
@stop

