@extends('layouts.default')

@section('content')
<h2>@lang('issue.update_issue')</h2>
    {!! \Form::open(['route' => 'issue.update']) !!}
    {!! \Form::hidden('id', $issue->id) !!}

   <div class="form-group">
       <label for="title">@lang('issue.client'), @lang('issue.project'), @lang('issue.parent_id')</label>
        {!! Form::select('client_id', $clients, $issue->project->client_id, ['class' => 'form-control select-small', 'id' => 'client_id']) !!}
        {!! Form::select('project_id', $projects, $issue->project_id, ['class' => 'form-control select-small', 'id' => 'project_id']) !!}
        {!! Form::select('parent_id', $issues, $issue->parent_id, ['class' => 'form-control select-small', 'id' => 'parent_id']) !!}
    </div>

    <div class="form-group">
    <label for="title">@lang('issue.status'), @lang('issue.type'), @lang('issue.assigned')</label>
        {!! Form::select('status_id', $status, $issue->status_id, ['class' => 'form-control select-small']) !!}
        {!! Form::select('type_id', $types, $issue->type_id, ['class' => 'form-control select-small']) !!}
        {!! Form::select('assigned', $users, $issue->assigned, ['class' => 'form-control select-small']) !!}
    </div>
    
    <div class="form-group">
        <label for="title">@lang('issue.title')</label>
        {!! \Form::text('title', $issue->title, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.description')</label>
        {!! \Form::text('description', $issue->description, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="title">@lang('issue.start_date'),  @lang('issue.plan_time'), @lang('issue.priority')</label>
        {!! \Form::text('start_date', $issue->start_date->format('d-m-Y'), ['class' => 'form-control select-small', 'id' => 'start_date']) !!}
        {!! \Form::text('plan_time', $issue->plan_time, ['class' => 'form-control select-small', 'id' => 'plan_time']) !!}
        {!! Form::select('priority_id', $priorities, $issue->priority_id, ['class' => 'form-control select-small']) !!}
    </div>

    {!! \Form::submit(__('issue.save'), ['class' => 'btn btn-small btn-primary pull-left']) !!}
    {!! \Form::close() !!}

    {!! \Form::open(['route' => 'issue.destroy']) !!}
    {!! \Form::hidden('id', $issue->id) !!}
    {!! \Form::submit(__('issue.delete'), ['class' => 'btn btn-small btn-primary btn-delete']) !!}
    {!! \Form::close() !!}
@stop