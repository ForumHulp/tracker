@extends('layouts.default')

@section('content')
<h2>@lang('priority.create_priority')</h2>
    {!! \Form::open(['route' => 'status.store']) !!}

    <div class="form-group">
        <label for="title">@lang('status.add')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('status.add'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop