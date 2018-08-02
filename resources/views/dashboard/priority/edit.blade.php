@extends('layouts.default')

@section('content')
<h2>@lang('priority.edit_priority')</h2>
    {!! \Form::model($priority, ['route' => 'priority.update']) !!}
    {!! \Form::hidden('id', $priority->id) !!}
    <div class="form-group">
        <label for="title">@lang('priority.update_title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('priority.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop