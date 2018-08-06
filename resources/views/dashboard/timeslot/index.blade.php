@extends('layouts.default')

@section('content')
    <h1>@lang('timeslot.overview')</h1>
    @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('timeslot.create') }}" class="btn btn-primary btn-sm float-right btn-create">
            <i class="fa fa-plus"></i>
            @lang('timeslot.add')
        </a>
    @endif
    <table class="table">
        <tr>
            <th>@lang('timeslot.time_amount')</th>
            <th>@lang('timeslot.date')</th>
            <th>@lang('timeslot.user')</th>
            <th>@lang('timeslot.options')</th>
        </tr>
        @foreach($timeslots as $timeslot)
            <tr>
                <td>
                @if (auth()->user()->hasRole('manager'))
                    <a href="{{ route('timeslot.edit', [$timeslot->id]) }}" class="float-left">{{\Carbon\Carbon::createFromFormat('H:i:s',$timeslot->time_amount)->format('H:i')}}</a>
                @else
                {{\Carbon\Carbon::createFromFormat('H:i:s',$timeslot->time_amount)->format('H:i')}}
                @endif
                </td>
                <td>{{ date("d/m/Y", strtotime($timeslot->date)) }}</td>
                <td>{{ $timeslot->user_id }}</td>
                <td>
                    <div class="btn-group">
                        @if (auth()->user()->hasRole('manager'))
                            <a href="{{ route('timeslot.edit', [$timeslot->id]) }}">
                                <button class="btn btn-success btn-sm btn-edit">
                                    <i class="fa fa-pencil"></i>
                                    @lang('timeslot.edit')
                                </button>
                            </a>
                            {!! \Form::open(['route' => 'timeslot.destroy', 'class' => 'float-left']) !!}
                            {!! \Form::button('<i class="fa fa-trash"></i> ' . __('timeslot.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                            {!! \Form::hidden('id', $timeslot->id) !!}
                            {!! \Form::close() !!}
                    </div>
                @else
                @endif
                </td>
            </tr>
        @endforeach
    </table>
@stop
