@extends('layouts.default')

@section('content')
<h2>@lang('issue.create_issue')</h2>
    {!! \Form::open(['route' => 'issue.store']) !!}

    <div class="form-group">
        <label for="title">@lang('issue.client'), @lang('issue.project')</label>
        {!! Form::select('client_id', $clientList, null, ['class' => 'form-control']) !!}
        {!! Form::select('project_id', $projectList, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.status')</label>
        {!! Form::select('status_id', $statusList, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.type')</label>
        {!! \Form::text('type', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.description')</label>
        {!! \Form::text('description', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.start_date')</label>
        {!! \Form::text('start_date', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.assigned')</label>
        {!! \Form::text('assigned', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.parent_id')</label>
        {!! \Form::text('parent_id', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('issue.add'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('home') }}">@lang('issue.cancel')</a>
    {!! \Form::close() !!}
@stop