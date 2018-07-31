@extends('layouts.default')

@section('content')
    {!! \Form::model($priority, ['route' => 'priority.update']) !!}
    {!! \Form::hidden('id', $priority->id) !!}
    <div class="form-group">
        <label for="title">@lang('priority.update_title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('priority.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop