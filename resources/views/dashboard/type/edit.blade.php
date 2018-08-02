@extends('layouts.default')

@section('content')
<h2>@lang('type.edit_type')</h2>
    {!! \Form::model($type, ['route' => 'type.update']) !!}
    {!! \Form::hidden('id', $type->id) !!}
    <div class="form-group">
        <label for="title">@lang('type.update_title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('type.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop