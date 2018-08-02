@extends('layouts.default')

@section('content')
<h2>@lang('client.edit_client')</h2>
    {!! \Form::model($client, ['route' => 'client.update']) !!}
    {!! \Form::hidden('id', $client->id) !!}
    <div class="form-group">
        <label for="title">@lang('client.update_title')</label>
        {!! \Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('client.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop