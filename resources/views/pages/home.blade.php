@extends('layouts.default')

@section('content')

    <div class="row">
        <h1 id="title">Issue Tracker</h1>@if (auth()->check())<span class="d-inline-block float-right">Welcome {{ auth()->user()->name }}</span>@endif
    	@if (auth()->check())
        @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('issue.create') }}" class="btn btn-primary btn-sm float-right btn-create_issue">
            <i class="fa fa-plus"></i>
            @lang('issue.add')
        </a>
   		@endif
   		@endif
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
                    <td><a href="#i{{ $issue->id }}" data-toggle="collapse">@if ($issue->isChild())<i class="fa fa-long-arrow-right"></i> @endif{{ $issue->id }}</a></td>
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
    	                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $progress}}%">
            	            	<span class="sr-only">{{ $progress }}% Complete</span>
                	    	</div>
                    	</div>
                    @endif
                    </td>
                </tr>
                <tr id="i{{ $issue->id }}" class="collapse">
                <td></td>
                <td colspan="7">{{ $issue->description }}
                @if ($issue->isChild())
                <table class="table table-hover table-sm">
                	<thead>
                    <tr>
                    	<th class="col-md-5">@lang('issue.remark')</th>
                     	<th class="col-md-2">@lang('issue.date')</th>
                        <th class="col-md-2">@lang('issue.time')</th>
                        <th class="col-md-3">@lang('issue.progress')</th>
                    </tr>
					</thead>

					<tbody>
                    @foreach($issue->tracks as $track)
                   	<tr class="change-remark" data-url="/tracker/edit/{{ $track->id}}" title="@lang('issue.change.track')">
                    	<td>{{ $track->remark }}</td>
                        <td>{{ $track->date->format('d-m-Y') }}</td>
                        <td>{{ $track->used_time }}</td>
                        <td>
                        <div class="progress">
    	                  <div class="progress-bar" role="progressbar" aria-valuenow="{{ $track->progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $track->progress}}%">
            	            	<span class="sr-only">{{ $track->progress }}% Complete</span>
                	    	</div>
                    	</div>
                        </td>
                    </tr>
                    @endforeach
                    @if (auth()->check() && $issue->status_id != 3 && $issue->users->id == auth()->user()->id )
                    {!! \Form::open(['route' => 'tracker.store', 'id' => 'trackform']) !!}
                   	<tr>
                        {!! \Form::hidden('issue_id', $issue->id) !!}
                        {!! \Form::hidden('user_id', $issue->users->id) !!}

                   		<td>{!! \Form::text('remark', null, ['class' => 'form-control', 'id'=> 'remark']) !!}</td>
                        <td>{{ Form::date('date', null, ['class' => 'form-control', 'id'=>'datetimepicker']) }}</td>
                        <td>{!! Form::text('used_time', null, ['class' => 'form-control timepicker', 'id' => 'timepicker']) !!}</td>
                        <td><input name="progress" id="progress" type="range" min="0" max="100" value="0" style="width:75px;" />
                        {!! \Form::submit(__('issue.add_remark'), ['class' => 'btn btn-sm btn-outline-secondary', 'id' => 'btn_save']) !!}
                        </td>
                    </tr>
                    {!! \Form::close() !!}
                    @endif

					</tbody>

                </table>
                @endif
                </td>
                </tr>
            @endforeach
        </table>
    {{ $issues->links() }}

    </div>

  <script type="text/javascript">
 // $('.timepicker').datetimepicker({
//	  format: 'HH:mm',
//	  stepping: 15,
//  });
  </script>
@endsection
