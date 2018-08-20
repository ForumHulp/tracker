@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('status.edit_status')</strong>
            </div>
            <div class="card-body card-block">
                {!! \Form::model($status, ['route' => 'status.update', 'class' => 'form-horizontal']) !!}
                {!! \Form::hidden('id', $status->id) !!}

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="title">@lang('status.update_title')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! \Form::submit(__('status.save'), ['class' => 'btn btn-small btn-primary']) !!}
                <a class="btn btn-small btn-primary" href="{{ route('status.index') }}">@lang('status.cancel')</a>
            </div>
            {!! \Form::close() !!}
        </div>
    </div>
@stop