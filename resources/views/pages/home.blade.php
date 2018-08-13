@extends('layouts.default')

@section('content')

        <div class="row">
          <div class="col-sm-8">
            <h1 id="title">Issue Tracker</h1>
          </div>
          <div class="col-sm-4">
            @if (auth()->check())<span class="d-inline-block float-right">Welcome {{ auth()->user()->name }}</span>@endif
            @if (auth()->check())
            @if (auth()->user()->hasRole('manager'))
            <a href="{{ route('issue.create') }}" class="btn btn-primary btn-sm float-right btn-create_issue">
                <i class="fa fa-plus"></i>
                @lang('issue.add')
            </a>
       		  @endif
       		  @endif
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-1">@lang('issue.number')</div>
              <div class="col-sm-2">@lang('issue.client')</div>
              <div class="col-sm-3">@lang('issue.project')</div>
              <div class="col-sm-1">@lang('issue.status')</div>
              <div class="col-sm-1">@lang('issue.type')</div>
              <div class="col-sm-2">@lang('issue.title')</div>
              <div class="col-sm-1">@lang('issue.assigned')</div>
              <div class="col-sm-1">@lang('issue.progress')</div>
            </div>
          </div>
        </div>

          @foreach($issues as $issue)
          <div class="row">
            <div class="col-sm-12">
            @if (!$issue->isChild())<hr>@endif
              <div class="row">
                <div class="col-sm-1"><a href="#i{{ $issue->id }}" data-toggle="collapse">@if ($issue->isChild())<i class="fa fa-long-arrow-right"></i> @endif{{ $issue->id }}</a></div>
                <div class="col-sm-2">{{ $issue->project->client->name }}</div>
                <div class="col-sm-3">{{ $issue->project->title }}</div>
                <div class="col-sm-1">@if($issue->user){{ $issue->status->title }}@endif</div>
                <div class="col-sm-1">{{ $issue->type->title }}</div>
                <div class="col-sm-2">{{ $issue->title }}</div>
                <div class="col-sm-1">@if($issue->user){{ $issue->user->name }}@endif</div>
                <div class="col-sm-1">
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
                </div>
              </div>
              
              <div class="row">
                <div id="i{{ $issue->id }}" class="panel-collapse collapse col-sm-12"> <!-- Start Sub Issue -->
                  <div class="col-sm-1">&nbsp;</div>
                  <div class="col-sm-11">
                  @lang('issue.date'): {{ $issue->start_date->format('d-m-Y') }}, @lang('issue.plan_time'): <?php echo sprintf("%d:%02d", floor($issue->plan_time / 60), $issue->plan_time % 60); ?>
                  <br />{{ $issue->description }}
                           
                    @if ($issue->isChild())
                      <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                              <div class="col-md-5">@lang('issue.remark')</div>
                              <div class="col-md-2">@lang('issue.date')</div>
                              <div class="col-md-2">@lang('issue.time')</div>
                              <div class="col-md-3">@lang('issue.progress')</div>
                            </div>
                            <div class="row">
                            @foreach($issue->tracks as $track)
                              <div class="col-sm-12">
<!--                                  <a href="#s{{ $track->id }}"  data-parent="#i{{ $issue->id }}" data-toggle="collapse"> -->
                                    <div class="row">
                                      <div class="col-md-5">
                                        <span class="change-remark" data-url="/tracker/edit/{{ $track->id}}" title="@lang('issue.change.track')">{{ $track->remark }}</span>
                                        @if ($track->attachment)
                                         <a class="download" href="{{ route('tracker.download', $track->attachment) }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                        @endif
                                      </div>
                                      <div class="col-md-2">{{ $track->date->format('d-m-Y') }}</div>
                                      <div class="col-md-2"><?php echo sprintf("%d:%02d", floor($track->used_time / 60), $track->used_time % 60); ?></div>
                                      <div class="col-md-3">
                                        <div class="progress">
                                          <div class="progress-bar" role="progressbar" aria-valuenow="{{ $track->progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $track->progress}}%">
                                              <span class="sr-only">{{ $track->progress }}% Complete</span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                           <!--       </a> -->
                              <hr>
                              </div>
                            @endforeach

                              @if (auth()->check() && $issue->status_id != 3 && $issue->user->id == auth()->user()->id )
                                    <div id="s{{ $track->id }}" class="panel-collapse col-sm-12">
                                      <div class="row">
                                        {!! \Form::open(['route' => 'tracker.store', 'id' => 'trackform', 'class' => 'col-sm-12', 'files' => true]) !!}
                                        <div class="row">
                                          {!! \Form::hidden('issue_id', $issue->id) !!}
                                          {!! \Form::hidden('user_id', $issue->user->id) !!}
                                          <div class="col-md-5">{!! \Form::text('remark', null, ['class' => 'form-control', 'id'=> 'remark']) !!}</div>
                                          <div class="col-md-2">{{ Form::text('date', null, ['class' => 'form-control', 'id'=>'datepicker']) }}</div>
                                          <div class="col-md-2">
                                            <input id="timepicker" name="used_time" class="form-control" value="0:0" type="text"/>
                                            <a class="start-timer" href="#">Start</a> <a class="stop-timer" href="#">Stop</a>
                                          </div>
                                          <div class="col-md-3">
                                            <input name="progress" id="progress" type="range" min="0" max="100" value="0" style="width:75px;" />
                                            <div class="fileinput" id="fileinput">@lang('issue.upload')
                                              <input type="file" name="document" id="document" class="hide_file" size="10" accept=".pdf" />
                                            </div>
                                              {!! \Form::submit(__('issue.add_remark'), ['class' => 'btn btn-sm btn-outline-secondary', 'id' => 'btn_save']) !!}
                                          </div>
                                        </div>
                                        {!! \Form::close() !!}
                                      </div>
                                    </div>
                              @endif
                         </div>
                       </div>
                     </div>
                    @endif
                  </div>
                </div> <!-- End Sub Issue -->
              </div>
              </div>
            </div>
            @endforeach
        <div><!-- end row -->

    {{ $issues->links() }}

@endsection
