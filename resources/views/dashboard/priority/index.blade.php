@extends('layouts.default')

@section('content')
    <h1>@lang('priority.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('priority.create') }}" class="btn btn-primary btn-sm float-right">@lang('priority.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('priority.title')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('priority.options')</th>@endif
        </tr>
        @foreach($priorities as $priority)
            <tr>
                <td>{{ $priority->title }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <a href="{{ route('priority.edit', [$priority->id]) }}" class="float-left">@lang('priority.edit')</a>

                    {!! \Form::open(['route' => 'priority.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('priority.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $priority->id) !!}
                    {!! \Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop