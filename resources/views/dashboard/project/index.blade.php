@extends('layouts.default')

@section('content')
    <h1>@lang('project.overview')</h1>
    <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm float-right">@lang('project.add')</a>
    <table class="table">
        <tr>
            <th>@lang('project.title')</th>
            <th>@lang('project.client')</th>
            <th>@lang('project.options')</th>
        </tr>
        @foreach($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->client_id }}</td>
                <td>
                    <a href="{{ route('project.edit', [$project->id]) }}" class="float-left">@lang('project.edit')</a>

                    {!! \Form::open(['route' => 'project.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('project.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $project->id) !!}
                    {!! \Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@stop