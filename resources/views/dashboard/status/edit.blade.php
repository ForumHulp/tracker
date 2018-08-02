@extends('layouts.default')

@section('content')
<h2>@lang('status.edit_status')</h2>
    {!! \Form::model($status, ['route' => 'status.update']) !!}
    {!! \Form::hidden('id', $status->id) !!}
    <div class="form-group">
        <label for="title">@lang('status.update_title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('status.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop