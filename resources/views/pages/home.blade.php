@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card row">
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
                            <table id="bootstrap-data-table" class="table table-striped table-bordered row">

                                <thead class="col-md-12">
                                  <tr class="row">
                                      <th class="col-md-1">@lang('issue.number')</th>
                                      <th class="col-md-2">@lang('issue.client')</th>
                                      <th class="col-md-2">@lang('issue.project')</th>
                                      <th class="col-md-1">@lang('issue.status')</th>
                                      <th class="col-md-1">@lang('issue.type')</th>
                                      <th class="col-md-1">@lang('issue.title')</th>
                                      <th class="col-md-1">@lang('issue.assigned')</th>
                                      <th class="col-md-1">@lang('issue.progress')</th>
                                  </tr>
                                </thead>

                                <tbody  class="col-md-12">
                                @foreach($issues as $issue)
                                    <tr style="border-top:1px black solid;"></tr>
                                    <tr class="issue-main row">
                                        <td class="col-md-1"><a href="#i{{ $issue->id }}" data-toggle="collapse">{{ $issue->id }}</a></td>
                                        <td class="col-md-2">
                                            @if (auth()->check() && auth()->user()->hasRole('manager'))
                                                <a href="{{ route('issue.edit', $issue->id) }}" title="Update issue">{{ $issue->project->client->name }}</a>@else{{ $issue->project->client->name }}
                                            @endif
                                        </td>
                                        <td class="col-md-2">{{ $issue->project->title }}</td>
                                        <td class="col-md-1">{{ $issue->status->title }}</td>
                                        <td class="col-md-1">{{ $issue->type->title }}</td>
                                        <td class="col-md-1">{{ $issue->title }}</td>
                                        <td class="col-md-1">@if($issue->user){{ $issue->user->name }}@endif</td>
                                        <td class="col-md-1">
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

                                    <tr id="i{{ $issue->id }}" class="issue-info row panel-collapse collapse">
                                        <td  class=" col-md-12">
                                            <table class="issues-sub row">
                                                <tbody  class="col-md-12">

                                                <tr class="row">
                                                    <td class="col-md-1"></td>
                                                    <td  class="col-md-11">
                                                        @lang('issue.date'): {{ $issue->start_date->format('d-m-Y') }}, @lang('issue.plan_time'): <?php echo sprintf("%d:%02d", floor($issue->plan_time / 60), $issue->plan_time % 60); ?>
                                                        <br />{{ $issue->description }}
                                                    </td>
                                                </tr>

                                              @foreach($subissues as $subissue)
                                                  @if ($subissue->parent_id == $issue->id)

                                                  <tr class="issue-main row">
                                                      <td class="col-md-1"><a href="#s{{ $subissue->id }}" data-toggle="collapse"><i class="fa fa-long-arrow-right"></i>{{ $subissue->id }}</a></td>
                                                      <td class="col-md-2">
                                                          @if (auth()->check() && auth()->user()->hasRole('manager'))
                                                              <a href="{{ route('issue.edit', $subissue->id) }}" title="Update issue">{{ $subissue->project->client->name }}</a>@else{{ $subissue->project->client->name }}
                                                          @endif
                                                      </td>
                                                      <td class="col-md-2">{{ $subissue->project->title }}</td>
                                                      <td class="col-md-1">{{ $subissue->status->title }}</td>
                                                      <td class="col-md-1">{{ $subissue->type->title }}</td>
                                                      <td class="col-md-1">{{ $subissue->title }}</td>
                                                      <td class="col-md-1">@if($subissue->user){{ $subissue->user->name }}@endif</td>
                                                      <td class="col-md-1"></td>
                                                  </tr>

                                                  <tr id="s{{ $subissue->id }}" class="row sub-issue-heads panel-collapse collapse">
                                                      <th class="col-md-1"></th>
                                                      <th class="col-md-2">@lang('issue.remark')</th>
                                                      <th class="col-md-2">@lang('issue.date')</th>
                                                      <th class="col-md-2">@lang('issue.time')</th>
                                                      <th class="col-md-4">@lang('issue.progress')</th>

                                                  @foreach($subissue->tracks as $track)
                                                      <td id="t{{ $track->id }}" class="col-md-1 empty"></td>
                                                      <td id="t{{ $track->id }}" class="col-md-2 remarks-info">
                                                          <span class="change-remark" id="tr{{$track->id}}" data-url="/tracker/edit/{{ $track->id}}" title="@lang('issue.change.track')">{{ $track->remark }}</span>
                                                          @if ($track->attachment)
                                                              <a class="download" href="{{ route('tracker.download', $track->attachment) }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                          @endif
                                                      </td>
                                                      <td id="t{{ $track->id }}" class="col-md-2 datepickers-info">{{ $track->date->format('d-m-Y') }}</td>
                                                      <td id="t{{ $track->id }}" class="col-md-2 timepickers-info"><?php echo sprintf("%d:%02d", floor($track->used_time / 60), $track->used_time % 60); ?></td>
                                                      <td id="t{{ $track->id }}" class="col-md-4 progresses-info">
                                                          <div class="progress">
                                                              <div class="progress-bar" role="progressbar" aria-valuenow="{{ $track->progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $track->progress}}%">
                                                                  <span class="sr-only">{{ $track->progress }}% Complete</span>
                                                              </div>
                                                          </div>
                                                      </td>
                                                  @if (auth()->check() && $subissue->status_id != 3 && $subissue->user->id == auth()->user()->id )

                                                                {!! \Form::open(['route' => 'tracker.store', 'id' => 'trackform-tr' . $track->id, 'class' => 'trackinfo col-sm-12', 'files' => true]) !!}
                                                                {!! \Form::hidden('issue_id', $subissue->id) !!}
                                                                {!! \Form::hidden('user_id', $subissue->user->id) !!}
                                                                <td id="str{{ $track->id }}" class="col-md-1 empty"></td>
                                                                <td id="str{{ $track->id }}" class="col-md-2 remarks">{!! \Form::text('remark', null, ['class' => 'form-control remark', 'id'=> 'remark']) !!}</td>
                                                                <td id="str{{ $track->id }}" class="col-md-2 datepickers">{{ Form::text('date', null, ['class' => 'form-control datepicker', 'id'=>'datepicker']) }}</td>
                                                                <td id="str{{ $track->id }}" class="col-md-2 timepickers">
                                                                    <input id="timepicker" name="used_time" class="form-control timepicker" value="0:0" type="text"/>
                                                                    <a class="start-timer" href="#">Start</a> <a class="stop-timer" href="#">Stop</a>
                                                                </td>
                                                                <td id="str{{ $track->id }}" class="col-md-4 progresses">
                                                                    <input name="progress" class="progress" id="progress" type="range" min="0" max="100" value="0" style="width:75px;" />
                                                                    <div class="fileinput" id="fileinput">@lang('issue.upload')
                                                                        <input type="file" name="document" id="document" class="hide_file" size="10" accept=".pdf" />
                                                                    </div>
                                                                    {!! \Form::submit(__('issue.add_remark'), ['class' => 'btn btn-sm btn-outline-secondary', 'id' => 'btn_save']) !!}
                                                                </td>
                                                                {!! \Form::close() !!}
                                                  @endif
                                                @endforeach <!-- Tracks -->
                                              </tr>

                                                  @endif
                                              @endforeach <!-- Sub-Issues -->

                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach <!-- Issues -->
                                </tbody>
                            </table> <!-- End Issues-Table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{ $issues->links() }}

@endsection
