@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('project.edit_project')</strong>
            </div>
            <div class="card-body card-block">
                {!! \Form::model($project, ['route' => 'project.update', 'class' => 'form-horizontal']) !!}
                {!! \Form::hidden('id', $project->id) !!}

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="title">@lang('project.title')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="description">@lang('project.description')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! \Form::text('description', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="client_id">@lang('project.client')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! Form::select('client_id', $clientList, $selected, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! \Form::submit(__('project.save'), ['class' => 'btn btn-small btn-primary']) !!}
                <a class="btn btn-small btn-primary" href="{{ route('project.index') }}">@lang('project.cancel')</a>
            </div>
            {!! \Form::close() !!}
        </div>
    </div>
@stop