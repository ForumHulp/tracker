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
                <th>@lang('issue.progress')</th>
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
                    <td>
                    <?php $progress = 0; ?>
                    @if (!$issue->isChild() && $issue->getLeaves()->count())
                        @foreach($issue->getLeaves() as $leave)
                        @if ($leave->status_id == 3) <?php $progress++; ?> @endif
                   
                        @endforeach
                        <?php $progress = ($progress / $issue->getLeaves()->count()) * 100; ?>
                    
	                    <div class="progress">
    	                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $progress}}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress}}%">
            	            	<span class="sr-only">{{ $progress }}% Complete</span>
                	    	</div>
                    	</div> 
                    @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection