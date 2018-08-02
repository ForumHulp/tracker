@extends('layouts.default')

@section('content')
    <h1>@lang('client.overview')</h1>
    @if (auth()->user()->hasRole('manager'))<a href="{{ route('client.create') }}" class="btn btn-primary btn-sm float-right">@lang('client.add')</a>@endif
    <table class="table">
        <tr>
            <th>@lang('client.name')</th>
            <th>@lang('client.email')</th>
            <th>@lang('client.phone')</th>
            <th>@lang('client.country')</th>
            <th>@lang('client.city')</th>
            <th>@lang('client.address')</th>
            @if (auth()->user()->hasRole('manager'))<th>@lang('client.options')</th>@endif
        </tr>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->country }}</td>
                <td>{{ $client->city }}</td>
                <td>{{ $client->address }}</td>
                @if (auth()->user()->hasRole('manager'))
                <td>
                    <a href="{{ route('client.edit', [$client->id]) }}" class="float-left">@lang('client.edit')</a>

                    {!! \Form::open(['route' => 'client.destroy', 'class' => 'float-left']) !!}
                    {!! \Form::button( __('client.dell'), ['type' => 'submit', 'class' => 'btn btn-link']) !!}
                    {!! \Form::hidden('id', $client->id) !!}
                    {!! \Form::close() !!}
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop