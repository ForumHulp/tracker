@extends('layouts.default')

@section('content')
    {!! \Form::open(['route' => 'timeslot.store']) !!}

    <div class="form-group">
        <label for="time_amount">@lang('timeslot.add')</label>
        {!! Form::select('time_amount', $time_amounts, $time_amounts[$default_time], ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="date">@lang('timeslot.edit')</label>
        {!! Form::date('date', \Carbon\Carbon::now()); !!}
    </div>

    {!! Form::hidden('user_id', $user_id) !!}
    {!! \Form::submit(__('timeslot.add'), ['class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('timeslot.index') }}">@lang('timeslot.cancel')</a>
    {!! \Form::close() !!}
@stop
