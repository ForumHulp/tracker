@extends('layouts.default')

@section('content')
<h2>@lang('timeslot.edit_timeslot')</h2>
    {!! \Form::model($timeslot, ['route' => 'timeslot.update']) !!}
    {!! \Form::hidden('id', $timeslot->id) !!}


    <div class="form-group">
        <label for="time_amount">@lang('timeslot.edit')</label>
        {!! Form::select('time_amount', $time_amounts, $timeslot->time_amount, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="date">@lang('timeslot.edit')</label>
        {{ Form::date('date', $timeslot->date, ['class' => 'form-control']) }}
    </div>

    {!! Form::hidden('user_id', $user_id) !!}
    {!! \Form::submit(__('timeslot.save'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('timeslot.index') }}">@lang('timeslot.cancel')</a>
    {!! \Form::close() !!}
  @stop
