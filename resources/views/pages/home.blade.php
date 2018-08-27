@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header col-md-12">
                            <strong class="card-title">@lang('issue.overview')</strong>
                            {{--@if (auth()->check())<span class="d-inline-block float-right">Welcome {{ auth()->user()->name }}</span>@endif--}}
                            @if (auth()->check())
                                @if (auth()->user()->hasRole('manager'))
                                    <a href="{{ route('issue.create') }}" class="btn btn-primary btn-sm float-right btn-create_issue">
                                        <i class="fa fa-plus"></i>
                                        @lang('issue.add')
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="card-body col-md-12">
                            <table id="bootstrap-data-tables" class="table table-striped table-bordered row">

                                <thead class="col-md-12">
                                  <tr class="">
                                      <th class="md-1">@lang('issue.number')</th>
                                      <th class="md-2">@lang('issue.client')</th>
                                      <th class="md-2">@lang('issue.project')</th>
                                      <th class="md-1">@lang('issue.status')</th>
                                      <th class="md-1">@lang('issue.type')</th>
                                      <th class="md-3">@lang('issue.title')</th>
                                      <th class="md-1">@lang('issue.assigned')</th>
                                      <th class="md-1">@lang('issue.progress')</th>
                                  </tr>
                                </thead>

                                <tbody class="col-md-12">
                                @foreach($issues as $issue)
	                                @if (!$issue->isChild())
                                    <tr class="issue-main @if ($loop->iteration % 2 == 0) even @else odd @endif" style="border-top:1px black solid;">
                                        <td><a href="#i{{ $issue->id }}" data-toggle="collapse" class="collapse-all">{{ $issue->id }}</a></td>
                                        <td>{{ $issue->project->client->name }}</td>
                                        <td>@if (auth()->check() && auth()->user()->hasRole('manager'))<a href="{{ route('issue.edit', $issue->id) }}" title="Update issue">{{ $issue->project->title }}</a>@else{{ $issue->project->title }}@endif</td>
                                        <td>{{ $issue->status->title }}</td>
                                        <td>{{ $issue->type->title }}</td>
                                        <td>{{ $issue->title }}</td>
                                        <td>@if($issue->user){{ $issue->user->name }}@endif</td>
                                        <td>
                                            <?php $progress = 0;
											$childs = $issue->getLeaves()->count();
											$child = 0;
											 ?>
                                            @if ($issue->status_id != 3)
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
                                            @else
                                            	@if (empty($issue->order->payment_id))
                                                	<a href="{{ route('issue.order', $issue->id) }}" class="btn btn-primary">{{ __('site.pay') }}</a>
                                                @else
                                                	{{ __('site.payed') }}
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    <tr id="i{{ $issue->id }}" class="issue-info panel-collapse collapse">
                                        <td colspan="8" style="width:100%;">
                                        @lang('issue.date'): {{ $issue->start_date->format('d-m-Y') }}, @lang('issue.plan_time'): <?php echo sprintf("%d:%02d", floor($issue->plan_time / 60), $issue->plan_time % 60); ?>
                                        <br />{{ $issue->description }}
                                    @else
										<table class="subissue" style="width:100%;">
                                        @if (!$child)
                                        <tr>
                                            <th class="md-1">@lang('issue.number')</th>
                                            <th class="md-3">@lang('issue.title')</th>
                                            <th class="md-1">@lang('issue.status')</th>
                                            <th class="md-1">@lang('issue.type')</th>
                                            <th class="md-1">@lang('issue.assigned')</th>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td><a href="#r{{ $issue->id }}" data-toggle="collapse">{{ $issue->id }}</a></td>
                                            <td>
                                             @if (auth()->check() && auth()->user()->hasRole('manager'))
                                             	<a href="{{ route('issue.edit', $issue->id) }}" title="Update issue">{{ $issue->title }}</a>
                                             @else
                                             {{ $issue->title }}
                                             @endif</td>
                                            <td>{{ $issue->status->title }}</td>
                                            <td>{{ $issue->type->title }}</td>
                                            <td>@if($issue->user){{ $issue->user->name }}@endif</td>
                                        </tr>
                                        
                                        <tr id="r{{ $issue->id }}" class="issue-info panel-collapse collapse">
                                        	<td colspan="5">
                                        	@foreach($issue->tracks as $track)
                                            @if ($loop->first)
                                            <div class="row">
                                            	<div class="col-md-8">@lang('issue.remark')</div>
                                                <div class="col-md-2">@lang('issue.date')</div>
                                                <div class="col-md-2">@lang('issue.time')</div>
                                            </div>
                                            <hr>
                                            @endif
                                            <div class="row">
                                            	<div class="col-md-8">
                                                @if (auth()->check() && $issue->status_id != 3 && $issue->user->id == auth()->user()->id )
                                                    <span class="change-remark" data-url="/tracker/edit/{{ $track->id}}" title="@lang('issue.change.track')">{{ $track->remark }}</span>
                                                    @else
												      <span>{{ $track->remark }}</span>
                                                    @endif
                                                    @if ($track->attachment)
                                                     <a class="download" href="{{ route('tracker.download', $track->attachment) }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">{{ $track->date->format('d-m-Y') }}</div>
                                                <div class="col-md-2"><?php echo sprintf("%d:%02d", floor($track->used_time / 60), $track->used_time % 60); ?></div>
                                            </div>
                                            <hr>
                                            @if ($loop->last)
                                            @if (auth()->check() && $issue->status_id != 3 && $issue->user->id == auth()->user()->id )
                                            {!! \Form::open(['route' => 'tracker.store', 'id' => 'trackform' . $issue->id, 'class' => 'col-sm-12', 'files' => true]) !!}

											<div class="row">
                                            	{!! \Form::hidden('issue_id', $issue->id) !!}
                                            	{!! \Form::hidden('user_id', $issue->user->id) !!}
                                            	<div class="col-md-5">{!! \Form::text('remark', null, ['class' => 'form-control', 'id' => 'remark']) !!}</div>
                                            	<div class="col-md-2">{!! Form::text('date', null, ['class' => 'form-control datepick', 'id' => 'datepicker' . $issue->id]) !!}</div>
                                            	<div class="col-md-2">
                                                	<input id="timepicker{{ $issue->id }}" name="used_time" class="form-control timepicker" value="0:0" type="text"/>
                                                	<a class="start-timer" href="#" data-target="{{ $issue->id }}">Start</a> <a class="stop-timer" href="#" data-target="{{ $issue->id }}">Stop</a>
                                              	</div>
                                              	<div class="col-md-3">
                                                	<div class="fileinput" id="fileinput{{ $issue->id }}">@lang('issue.upload')
                                                	  <input type="file" name="document" id="document" class="hide_file" size="10" accept=".pdf" />
                                                	</div>
                                                	{!! \Form::submit(__('issue.add_remark'), ['class' => 'btn btn-sm btn-outline-secondary', 'id' => 'btn_save']) !!}
                                              	</div>
                                            </div>
                                            
                                            {!! \Form::close() !!}
                                            @endif
                                            @endif
                                            @endforeach
                                       		</td>
                                       </tr>
                                        </table>
									<?php $child++; ?>
									@endif
                                    @if ($child == $childs)
                                        </td>
                                    </tr>
									@endif
                                @endforeach <!-- Issues -->
                                </tbody>
                            </table> <!-- End Issues-Table -->
                        </div>
                    </div>
                </div>
        </div>
    </div>

    {{ $issues->links() }}

@endsection
