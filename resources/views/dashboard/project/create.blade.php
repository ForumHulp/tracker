@extends('layouts.default')

@section('content')
<h2>@lang('project.create_project')</h2>
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
    <a class="btn btn-small btn-primary" href="{{ route('project.index') }}">@lang('project.cancel')</a>
    {!! \Form::close() !!}
@stop