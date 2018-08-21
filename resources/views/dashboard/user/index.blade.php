@extends('layouts.default')

@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">@lang('user.overview')</strong>
                            @if (auth()->user()->hasRole('manager'))
                                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right btn-create">
                                    <i class="fa fa-plus"></i>
                                    @lang('user.add')
                                </a>
                            @endif
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('user.name')</th>
                                    <th>@lang('user.email')</th>
                                    <th>@lang('user.role')</th>
                                    <th>@lang('user.registered')</th>
                                    @if (auth()->user()->hasRole('manager'))<th>@lang('user.options')</th>@endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@foreach ($user->roles as $role){{ $role->name }}@endforeach</td>
                                        <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                        @if (auth()->user()->hasRole('manager'))
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('user.edit', [$user->id]) }}">
                                                        <button class="btn btn-success btn-sm btn-edit">
                                                            <i class="fa fa-pencil"></i>
                                                            @lang('user.edit')
                                                        </button>
                                                    </a>

                                                    {!! \Form::open(['route' => 'user.destroy']) !!}
                                                    {!! \Form::button('<i class="fa fa-trash"></i> ' . __('user.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm delete']) !!}
                                                    {!! \Form::hidden('id', $user->id) !!}
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