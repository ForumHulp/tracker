@extends('layouts.default')

@section('content')
    <h1>@lang('status.overview')</h1>
    <a href="{{ route('status.create') }}" class="btn btn-primary btn-sm float-right">@lang('status.add')</a>
    <table class="table">
        <tr>
            <th>@lang('status.title')</th>
            <th>@lang('status.options')</th>
        </tr>
        @foreach($statuses as $status)
            <tr>
                <td>{{ $status->title }}</td>
                <td>
                    <a href="{{ route('status.edit', [$status->id]) }}" class="float-left">@lang('status.edit')</a>

                    {!! \Form::open(['route' => 'status.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('status.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $status->id) !!}
                    {!! \Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@stop