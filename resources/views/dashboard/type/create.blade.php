@extends('layouts.default')

@section('content')
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <strong>@lang('type.create_type')</strong>
            </div>
            <div class="card-body card-block">
                {!! \Form::open(['route' => 'type.store', 'class' => 'form-horizontal']) !!}

                <div class="form-group row">
                    <div class="col col-md-3">
                        <label for="title">@lang('type.add')</label>
                    </div>
                    <div class="col-12 col-md-9">
                        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! \Form::submit(__('type.add'), ['class' => 'btn btn-small btn-primary']) !!}
                <a class="btn btn-small btn-primary" href="{{ route('type.index') }}">@lang('type.cancel')</a>
            </div>
            {!! \Form::close() !!}
        </div>
    </div>
@stop