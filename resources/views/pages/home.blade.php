@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
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
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
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
                                </thead>
                                <tbody>

                                @foreach($issues as $issue)
                                    <tr style="border-top:1px black solid;"></tr>
                                    <tr class="issue-main">
                                        <td><a href="#i{{ $issue->id }}" data-toggle="collapse">{{ $issue->id }}</a></td>
                                        <td>
                                            @if (auth()->check() && auth()->user()->hasRole('manager'))
                                                <a href="{{ route('issue.edit', $issue->id) }}" title="Update issue">{{ $issue->project->client->name }}</a>@else{{ $issue->project->client->name }}
                                            @endif
                                        </td>
                                        <td>{{ $issue->project->title }}</td>
                                        <td>{{ $issue->status->title }}</td>
                                        <td>{{ $issue->type->title }}</td>
                                        <td>{{ $issue->title }}</td>
                                        <td>@if($issue->user){{ $issue->user->name }}@endif</td>
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

                                    <tr class="issue-info">
                                        <td id="i{{ $issue->id }}" class="panel-collapse collapse"> <!-- Start Sub Issue -->
                                            <table id="bootstrap-data-table" class="table table-striped table-bordered issues-sub">

                                                <tbody >
                                                <tr style="border-top:1px black solid;"></tr>
                                                <tr>
                                                    <td></td>
                                                    <td >
                                                        @lang('issue.date'): {{ $issue->start_date->format('d-m-Y') }}, @lang('issue.plan_time'): <?php echo sprintf("%d:%02d", floor($issue->plan_time / 60), $issue->plan_time % 60); ?>
                                                        <br />{{ $issue->description }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td >
                                                        @foreach($subissues as $subissue)
                                                            @if ($subissue->parent_id == $issue->id)
                                                                <table id="bootstrap-data-table" class="table table-striped table-bordered issues-sub">
                                                                    <tbody >


                                                                    <tr class="issue-main">
                                                                        <td><a href="#s{{ $subissue->id }}" data-toggle="collapse"><i class="fa fa-long-arrow-right"></i>{{ $subissue->id }}</a></td>
                                                                        <td>
                                                                            @if (auth()->check() && auth()->user()->hasRole('manager'))
                                                                                <a href="{{ route('issue.edit', $subissue->id) }}" title="Update issue">{{ $subissue->project->client->name }}</a>@else{{ $subissue->project->client->name }}
                                                                            @endif
                                                                        </td>
                                                                        <td>{{ $subissue->project->title }}</td>
                                                                        <td>{{ $subissue->status->title }}</td>
                                                                        <td>{{ $subissue->type->title }}</td>
                                                                        <td>{{ $subissue->title }}</td>
                                                                        <td>@if($subissue->user){{ $subissue->user->name }}@endif</td>
                                                                        <td>
                                                                        </td>
                                                                        <td >
                                                                            <table id="s{{ $subissue->id }} bootstrap-data-table" class="table table-striped table-bordered issues-sub panel-collapse collapse">
                                                                                <thead >
                                                                                <tr>
                                                                                    <td></td>
                                                                                    <td  style="border-top:1px black solid;"></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th></th>
                                                                                    <th>@lang('issue.remark')</th>
                                                                                    <th>@lang('issue.date')</th>
                                                                                    <th>@lang('issue.time')</th>
                                                                                    <th>@lang('issue.progress')</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody >
                                                                                <tr>
                                                                                    <td >
                                                                                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                                                                            <tbody  >
                                                                                            <tr>
                                                                                                @foreach($subissue->tracks as $track)
                                                                                                    <td >
                                                                                                    <!--                                  <a href="#s{{ $track->id }}"  data-parent="#i{{ $issue->id }}" data-toggle="collapse"> -->
                                                                                            <tr>
                                                                                                <td></td>
                                                                                                <td>
                                                                                                    <span class="change-remark" id="tr{{$track->id}}" data-url="/tracker/edit/{{ $track->id}}" title="@lang('issue.change.track')">{{ $track->remark }}</span>
                                                                                                    @if ($track->attachment)
                                                                                                        <a class="download" href="{{ route('tracker.download', $track->attachment) }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                                                                    @endif
                                                                                                </td>
                                                                                                <td>{{ $track->date->format('d-m-Y') }}</td>
                                                                                                <td><?php echo sprintf("%d:%02d", floor($track->used_time / 60), $track->used_time % 60); ?></td>
                                                                                                <td>
                                                                                                    <div class="progress">
                                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="{{ $track->progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $track->progress}}%">
                                                                                                            <span class="sr-only">{{ $track->progress }}% Complete</span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            @if (auth()->check() && $subissue->status_id != 3 && $subissue->user->id == auth()->user()->id )
                                                                                                <tr>
                                                                                                    <td id="s{{ $track->id }}" class="panel-collapse">
                                                                                                <tr id="str{{ $track->id }}">
                                                                                                    {!! \Form::open(['route' => 'tracker.store', 'id' => 'trackform-tr' . $track->id, 'class' => 'trackinfo col-sm-12', 'files' => true]) !!}
                                                                                                    {!! \Form::hidden('issue_id', $subissue->id) !!}
                                                                                                    {!! \Form::hidden('user_id', $subissue->user->id) !!}
                                                                                                    <td></td>
                                                                                                    <td class="remarks">{!! \Form::text('remark', null, ['class' => 'form-control remark', 'id'=> 'remark']) !!}</td>
                                                                                                    <td class="datepickers">{{ Form::text('date', null, ['class' => 'form-control datepicker', 'id'=>'datepicker']) }}</td>
                                                                                                    <td class="timepickers">
                                                                                                        <input id="timepicker" name="used_time" class="form-control timepicker" value="0:0" type="text"/>
                                                                                                        <a class="start-timer" href="#">Start</a> <a class="stop-timer" href="#">Stop</a>
                                                                                                    </td>
                                                                                                    <td class="progresses">
                                                                                                        <input name="progress" class="progress" id="progress" type="range" min="0" max="100" value="0" style="width:75px;" />
                                                                                                        <div class="fileinput" id="fileinput">@lang('issue.upload')
                                                                                                            <input type="file" name="document" id="document" class="hide_file" size="10" accept=".pdf" />
                                                                                                        </div>
                                                                                                        {!! \Form::submit(__('issue.add_remark'), ['class' => 'btn btn-sm btn-outline-secondary', 'id' => 'btn_save']) !!}
                                                                                                    </td>
                                                                                                    {!! \Form::close() !!}
                                                                                                </tr>
                                                                                                </td>
                                                                                                </tr>
                                                                                            @endif
                                                                                            <!--       </a> -->
                                                                                            <hr>
                                                                                            </td>
                                                                                            @endforeach
                                                                                            </tr>


                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>

                                                                                </tbody>
                                                                            </table>
                                                                        </td>






                                                                    </tr>


                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table> <!-- End Issues-Sub -->
                                        </td> <!-- End Sub Issue -->
                                    </tr>
                                @endforeach


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
