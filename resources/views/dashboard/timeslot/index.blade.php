@extends('layouts.default')

@section('content')
    <h1>@lang('timeslot.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('timeslot.create') }}" class="btn btn-primary btn-sm float-right">@lang('timeslot.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('timeslot.id')</th>
            <th>@lang('timeslot.time_amount')</th>
            <th>@lang('timeslot.date')</th>
            <th>@lang('timeslot.user')</th>
        </tr>
        @foreach($timeslots as $timeslot)
            <tr>
                <td>{{ $timeslot->id }}</td>
                <td>
                @if (auth()->user()->hasRole('manager'))
                    <a href="{{ route('timeslot.edit', [$timeslot->id]) }}" class="float-left">{{\Carbon\Carbon::createFromFormat('H:i:s',$timeslot->time_amount)->format('H:i')}}</a>
                    {!! \Form::open(['route' => 'timeslot.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('timeslot.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $timeslot->id) !!}
                    {!! \Form::close() !!}
                @else
                {{\Carbon\Carbon::createFromFormat('H:i:s',$timeslot->time_amount)->format('H:i')}}
                @endif
                </td>
                <td>{{ date("d/m/Y", strtotime($timeslot->date)) }}</td>
                <td>{{ $timeslot->user_id }}</td>
            </tr>
        @endforeach
    </table>
@stop
