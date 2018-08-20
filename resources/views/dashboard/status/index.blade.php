@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">@lang('status.overview')</strong>
                            @if (auth()->user()->hasRole('manager'))
                                <a href="{{ route('status.create') }}" class="btn btn-primary btn-sm float-right btn-create">
                                    <i class="fa fa-plus"></i>
                                    @lang('status.add')
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('status.title')</th>
                                    @if (auth()->user()->hasRole('manager'))<th>@lang('status.options')</th>@endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($statuses as $status)
                                    <tr>
                                        <td>{{ $status->title }}</td>
                                        @if (auth()->user()->hasRole('manager'))
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('status.edit', [$status->id]) }}">
                                                        <button class="btn btn-success btn-sm btn-edit">
                                                            <i class="fa fa-pencil"></i>
                                                            @lang('status.edit')
                                                        </button>
                                                    </a>

                                                    {!! \Form::open(['route' => 'status.destroy']) !!}
                                                    {!! \Form::button('<i class="fa fa-trash"></i> ' . __('status.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                                                    {!! \Form::hidden('id', $status->id) !!}
                                                    {!! \Form::close() !!}
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->

    </div><!-- .content -->



@stop