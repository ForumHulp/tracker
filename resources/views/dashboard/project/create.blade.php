@extends('layouts.default')

@section('content')
    {!! \Form::open(['route' => 'project.store']) !!}

    <div class="form-group">
        <label for="title">@lang('project.title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="description">@lang('project.description')</label>
        {!! \Form::text('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="client_id">@lang('project.client')</label>
        {!! Form::select('client_id', $clientList, $selected, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('project.add'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop