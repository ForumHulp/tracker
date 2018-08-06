@extends('layouts.default')

@section('content')
<h2>@lang('type.create_type')</h2>
    {!! \Form::open(['route' => 'type.store']) !!}

    <div class="form-group">
        <label for="title">@lang('type.add')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('type.add'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('type.index') }}">@lang('type.cancel')</a>
    {!! \Form::close() !!}
@stop