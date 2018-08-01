@extends('layouts.default')

@section('content')
    <h1>@lang('priority.overview')</h1>
    <a href="{{ route('priority.create') }}" class="btn btn-primary btn-sm float-right">@lang('priority.add')</a>
    <table class="table">
        <tr>
            <th>@lang('priority.title')</th>
            <th>@lang('priority.options')</th>
        </tr>
        @foreach($priorities as $priority)
            <tr>
                <td>{{ $priority->title }}</td>
                <td>
                    <a href="{{ route('priority.edit', [$priority->id]) }}" class="float-left">@lang('priority.edit')</a>

                    {!! \Form::open(['route' => 'priority.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('priority.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $priority->id) !!}
                    {!! \Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@stop