@extends('layouts.default')

@section('content')
    <h1>@lang('project.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('project.create') }}" class="btn btn-primary btn-sm float-right">@lang('project.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('project.title')</th>
            <th>@lang('project.client')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('project.options')</th>@endif
        </tr>
        @foreach($projects as $project)
		    <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->clients->name }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <a href="{{ route('project.edit', [$project->id]) }}" class="float-left">@lang('project.edit')</a>

                    {!! \Form::open(['route' => 'project.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('project.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $project->id) !!}
                    {!! \Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop