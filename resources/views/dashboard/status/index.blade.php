@extends('layouts.default')

@section('content')
    <h1>@lang('status.overview')</h1>
    @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('status.create') }}" class="btn btn-primary btn-sm float-right btn-create">
            <i class="fa fa-plus"></i>
            @lang('status.add')
        </a>
    @endif
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
                    <div class="btn-group">
                        <a href="{{ route('status.edit', [$status->id]) }}">
                            <button class="btn btn-success btn-sm btn-edit">
                                <i class="fa fa-pencil"></i>
                                @lang('status.edit')
                            </button>
                        </a>

                        {!! \Form::open(['route' => 'status.destroy']) !!}
                        {!! \Form::button('<i class="fa fa-trash"></i> ' . __('status.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                        {!! \Form::hidden('id', $status->id) !!}
                        {!! \Form::close() !!}
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop