@extends('layouts.default')

@section('content')
<h2>@lang('issue.create_issue')</h2>
    {!! \Form::open(['route' => 'issue.store']) !!}

   <div class="form-group">
       <label for="title">@lang('issue.client'), @lang('issue.project'), @lang('issue.parent_id')</label>
        {!! Form::select('client_id', $clients, null, ['class' => 'form-control select-small', 'id' => 'client_id']) !!}
        {!! Form::select('project_id', $projects, null, ['class' => 'form-control select-small', 'id' => 'project_id']) !!}
        {!! Form::select('parent_id', $issues, null, ['class' => 'form-control select-small', 'id' => 'parent_id']) !!}
    </div>

    <div class="form-group">
    <label for="title">@lang('issue.status'), @lang('issue.type'), @lang('issue.assigned')</label>
        {!! Form::select('status_id', $status, null, ['class' => 'form-control select-small']) !!}
        {!! Form::select('type_id', $types, null, ['class' => 'form-control select-small']) !!}
        {!! Form::select('assigned', $users, null, ['class' => 'form-control select-small']) !!}
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
        <label for="title">@lang('issue.start_date'),  @lang('issue.plan_time'), @lang('issue.priority')</label>
        {!! \Form::text('start_date', $start_date, ['class' => 'form-control select-small', 'id' => 'start_date']) !!}
        {!! \Form::text('plan_time', '1:00', ['class' => 'form-control select-small', 'id' => 'plan_time']) !!}
        {!! Form::select('priority_id', $priorities, null, ['class' => 'form-control select-small']) !!}
    </div>

    {!! \Form::submit(__('issue.add'), ['class' => 'btn btn-small btn-primary']) !!}
    {!! \Form::close() !!}

@stop