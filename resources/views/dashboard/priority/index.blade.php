@extends('layouts.default')

@section('content')
    <h1>@lang('priority.overview')</h1>
    @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('priority.create') }}" class="btn btn-primary btn-sm float-right btn-create">
            <i class="fa fa-plus"></i>
            @lang('priority.add')
        </a>
    @endif
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
                    <div class="btn-group">
                        <a href="{{ route('priority.edit', [$priority->id]) }}">
                            <button class="btn btn-success btn-sm btn-edit">
                                <i class="fa fa-pencil"></i>
                                @lang('priority.edit')
                            </button>
                        </a>

                        {!! \Form::open(['route' => 'priority.destroy']) !!}
                        {!! \Form::button('<i class="fa fa-trash"></i> ' . __('priority.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                        {!! \Form::hidden('id', $priority->id) !!}
                        {!! \Form::close() !!}
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop