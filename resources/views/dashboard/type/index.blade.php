@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">@lang('type.overview')</strong>
                            @if (auth()->user()->hasRole('manager'))
                                <a href="{{ route('type.create') }}" class="btn btn-primary btn-sm float-right btn-create">
                                    <i class="fa fa-plus"></i>
                                    @lang('type.add')
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('type.title')</th>
                                    @if (auth()->user()->hasRole('manager'))<th>@lang('type.options')</th>@endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types as $type)
                                    <tr>
                                        <td>{{ $type->title }}</td>
                                        @if (auth()->user()->hasRole('manager'))
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('type.edit', [$type->id]) }}">
                                                        <button class="btn btn-success btn-sm btn-edit">
                                                            <i class="fa fa-pencil"></i>
                                                            @lang('type.edit')
                                                        </button>
                                                    </a>

                                                    {!! \Form::open(['route' => 'type.destroy']) !!}
                                                    {!! \Form::button('<i class="fa fa-trash"></i> ' . __('type.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm delete']) !!}
                                                    {!! \Form::hidden('id', $type->id) !!}
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