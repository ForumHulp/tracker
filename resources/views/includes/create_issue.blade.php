@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('issue.create_issue')</strong>
            </div>
            <div class="card-body card-block">
                {!! \Form::open(['route' => 'issue.store', 'class' => 'form-horizontal']) !!}

                <div class="form-group row">
                    <div class="col col-sm-4">
                        <label for="client_id">@lang('issue.client')</label>
                        {!! Form::select('client_id', $clients, null, ['class' => 'form-control', 'id' => 'client_id']) !!}
                    </div>
                    <div class="col col-sm-4">
                        <label for="project_id">@lang('issue.project')</label>
                        {!! Form::select('project_id', $projects, null, ['class' => 'form-control', 'id' => 'project_id']) !!}
                    </div>
                    <div class="col col-sm-4">
                        <label for="parent_id">@lang('issue.parent_id')</label>
                        {!! Form::select('parent_id', $issues, null, ['class' => 'form-control', 'id' => 'parent_id']) !!}
                    </div>
                </div><hr>

                <div class="form-group row">
                    <div class="col col-sm-4">
                        <label for="status_id">@lang('issue.status')</label>
                        {!! Form::select('status_id', $status, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col col-sm-4">
                        <label for="type_id">@lang('issue.type')</label>
                        {!! Form::select('type_id', $types, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col col-sm-4">
                        <label for="assigned">@lang('issue.assigned')</label>
                        {!! Form::select('assigned', $users, null, ['class' => 'form-control']) !!}
                    </div>
                </div><hr>

                <div class="form-group row">
                    <div class="col-12">
                        <label for="title">@lang('issue.title')</label>
                        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <label for="description">@lang('issue.description')</label>
                        {!! \Form::text('description', null, ['class' => 'form-control']) !!}
                    </div>
                </div><hr>

                <div class="form-group row">
                    <div class="col col-sm-4">
                        <label for="start_date">@lang('issue.start_date')</label>
                        {!! \Form::text('start_date', $start_date, ['class' => 'form-control', 'id' => 'start_date']) !!}
                    </div>
                    <div class="col col-sm-4">
                        <label for="plan_time">@lang('issue.plan_time')</label>
                        {!! \Form::text('plan_time', '1:00', ['class' => 'form-control', 'id' => 'plan_time']) !!}
                    </div>
                    <div class="col col-sm-4">
                        <label for="priority_id">@lang('issue.priority')</label>
                        {!! Form::select('priority_id', $priorities, null, ['class' => 'form-control']) !!}
                    </div>
                </div>

            </div>
            <div class="card-footer">
                {!! \Form::submit(__('issue.add'), ['class' => 'btn btn-small btn-primary']) !!}
                <a class="btn btn-small btn-primary" href="{{ route('home') }}">@lang('issue.cancel')</a>
            </div>
            {!! \Form::close() !!}
        </div>
    </div>
@stop