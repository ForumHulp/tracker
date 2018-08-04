@extends('layouts.default')

@section('content')

    <div class="row">
        <h1 id="title">Issue Tracker</h1>

        <table class="table">
            <tr>
                <th>@lang('issue.number')</th>
                <th>@lang('issue.client')</th>
                <th>@lang('issue.project')</th>
                <th>@lang('issue.status')</th>
                <th>@lang('issue.type')</th>
                <th>@lang('issue.title')</th>
                <th>@lang('issue.assigned')</th>
            </tr>
            @foreach($issues as $issue)
                <tr>
                    <td>@if ($issue->isChild())<i class="fa fa-long-arrow-right"></i> @endif{{ $issue->id }}</td>
                    <td>{{ $issue->projects->clients->name }}</td>
                    <td>{{ $issue->projects->title }}</td>
                    <td>{{ $issue->statuses->title }}</td>
                    <td>{{ $issue->types->title }}</td>
                    <td>{{ $issue->title }}</td>
                    <td>{{ $issue->users->name }}</td>
                    <td></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection