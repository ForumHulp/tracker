@extends('layouts.default')

@section('content')
    {!! \Form::model($timeslot, ['route' => 'timeslot.update']) !!}
    {!! \Form::hidden('id', $timeslot->id) !!}
    <div class="form-group">
        <label for="title">@lang('timeslot.update_title')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('timeslot.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop
