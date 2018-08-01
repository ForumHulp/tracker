@extends('layouts.default')

@section('content')
    {!! \Form::open(['route' => 'timeslot.store']) !!}

    <div class="form-group">
        <label for="title">@lang('timeslot.add')</label>
        {!! \Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    {!! \Form::submit(__('timeslot.add'), ['class' => 'btn btn-small btn-primary']) !!}

    {!! \Form::close() !!}
@stop
