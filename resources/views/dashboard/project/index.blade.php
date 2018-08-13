@extends('layouts.default')

@section('content')
    <h1>@lang('project.overview')</h1>
    @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm float-right btn-create">
            <i class="fa fa-plus"></i>
            @lang('project.add')
        </a>
    @endif
    <table class="table">
        <tr>
            <th>@lang('project.title')</th>
            <th>@lang('project.client')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('project.options')</th>@endif
        </tr>
        @foreach($projects as $project)
		    <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->client->name }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <div class="btn-group">
                        <a href="{{ route('project.edit', [$project->id]) }}">
                            <button class="btn btn-success btn-sm btn-edit">
                                <i class="fa fa-pencil"></i>
                                @lang('project.edit')
                            </button>
                        </a>

                        {!! \Form::open(['route' => 'project.destroy']) !!}
                        {!! \Form::button('<i class="fa fa-trash"></i> ' . __('project.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                        {!! \Form::hidden('id', $project->id) !!}
                        {!! \Form::close() !!}
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop