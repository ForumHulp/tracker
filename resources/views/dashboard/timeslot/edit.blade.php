@extends('layouts.default')

@section('content')
    {!! \Form::model($timeslot, ['route' => 'timeslot.update']) !!}
    {!! \Form::hidden('id', $timeslot->id) !!}


    <div class="form-group">
        <label for="time_amount">@lang('timeslot.add')</label>
        {!! Form::select('time_amount', $time_amounts, $time_amounts[''.$record_time.''], ['class' => 'form-control']) !!}
    </div>




    {!! Form::hidden('user_id', $user_id) !!}
    {!! \Form::submit(__('timeslot.save'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop
