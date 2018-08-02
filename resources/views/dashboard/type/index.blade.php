@extends('layouts.default')

@section('content')
    <h1>@lang('type.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('type.create') }}" class="btn btn-primary btn-sm float-right">@lang('type.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('type.title')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('type.options')</th>@endif
        </tr>
        @foreach($types as $type)
            <tr>
                <td>{{ $type->title }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <a href="{{ route('type.edit', [$type->id]) }}" class="float-left">@lang('type.edit')</a>

                    {!! \Form::open(['route' => 'type.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('type.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $type->id) !!}
                    {!! \Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop