@extends('layouts.default')

@section('content')
    <h1>@lang('timeslot.overview')</h1>
    <a href="{{ route('timeslot.create') }}" class="btn btn-primary btn-sm float-right">@lang('timeslot.add')</a>
    <table class="table">
        <tr>
            <th>@lang('timeslot.title')</th>
            <th>@lang('timeslot.options')</th>
        </tr>
        @foreach($timeslots as $timeslot)
            <tr>
                <td>{{ $timeslot->title }}</td>
                <td>
                    <a href="{{ route('timeconsumed.edit', [$status->id]) }}" class="float-left">@lang('timeslot.edit')</a>

                    {!! \Form::open(['route' => 'timeslot.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('timeslot.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $timeslot->id) !!}
                    {!! \Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@stop
