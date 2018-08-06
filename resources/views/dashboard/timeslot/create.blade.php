@extends('layouts.default')

@section('content')
<h2>@lang('timeslot.create_timeslot')</h2>
    {!! \Form::open(['route' => 'timeslot.store']) !!}

    <div class="form-group">
        <label for="time_amount">@lang('timeslot.add')</label>
        {!! Form::select('time_amount', $time_amounts, $time_amounts[$default_time], ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="date">@lang('timeslot.create_date')</label>
        {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']); !!}
    </div>

    {!! Form::hidden('user_id', $user_id) !!}
    {!! \Form::button( __('timeslot.add'), ['type' => 'submit', 'class' => 'btn btn-small btn-primary']) !!}
    <a class="btn btn-small btn-primary" href="{{ route('timeslot.index') }}">@lang('timeslot.cancel')</a>
    {!! \Form::close() !!}
@stop
