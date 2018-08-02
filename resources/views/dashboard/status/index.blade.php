@extends('layouts.default')

@section('content')
    <h1>@lang('status.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('status.create') }}" class="btn btn-primary btn-sm float-right">@lang('status.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('status.title')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('status.options')</th>@endif
        </tr>
        @foreach($statuses as $status)
            <tr>
                <td>{{ $status->title }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <a href="{{ route('status.edit', [$status->id]) }}" class="float-left">@lang('status.edit')</a>

                    {!! \Form::open(['route' => 'status.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('status.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $status->id) !!}
                    {!! \Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop