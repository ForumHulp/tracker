@extends('layouts.default')

@section('content')
    <h1>@lang('user.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right">@lang('user.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('user.name')</th>
            <th>@lang('user.email')</th>
            <th>@lang('user.role')</th>
            <th>@lang('user.registered')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('user.options')</th>@endif
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>@foreach ($user->roles as $role){{ $role->name }}@endforeach</td>
                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <a href="{{ route('user.edit', [$user->id]) }}" class="float-left">@lang('user.edit')</a>

                    {!! \Form::open(['route' => 'user.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('user.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $user->id) !!}
                    {!! \Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop