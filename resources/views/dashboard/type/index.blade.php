@extends('layouts.default')

@section('content')
    <h1>@lang('type.overview')</h1>
    @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('type.create') }}" class="btn btn-primary btn-sm float-right btn-create">
            <i class="fa fa-plus"></i>
            @lang('type.add')
        </a>
    @endif
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
                    <div class="btn-group">
                        <a href="{{ route('type.edit', [$type->id]) }}">
                            <button class="btn btn-success btn-sm btn-edit">
                                <i class="fa fa-pencil"></i>
                                @lang('type.edit')
                            </button>
                        </a>

                        {!! \Form::open(['route' => 'type.destroy']) !!}
                        {!! \Form::button('<i class="fa fa-trash"></i> ' . __('type.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                        {!! \Form::hidden('id', $type->id) !!}
                        {!! \Form::close() !!}
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop