@extends('layouts.default')

@section('content')
<h2>@lang('status.create_status')</h2>
    {!! \Form::open(['route' => 'status.store']) !!}

    <div class="form-group">
        <label for="title">@lang('status.add')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('status.add'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('status.index') }}">@lang('status.cancel')</a>
    {!! \Form::close() !!}
@stop