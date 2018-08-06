@extends('layouts.default')

@section('content')
    <h1>@lang('client.overview')</h1>
    @if (auth()->user()->hasRole('manager'))
        <a href="{{ route('client.create') }}" class="btn btn-primary btn-sm float-right btn-create">
            <i class="fa fa-plus"></i>
            @lang('client.add')
        </a>
    @endif
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
                    <div class="btn-group">
                        <a href="{{ route('client.edit', [$client->id]) }}">
                            <button class="btn btn-success btn-sm btn-edit">
                                <i class="fa fa-pencil"></i>
                                @lang('client.edit')
                            </button>
                        </a>

                        {!! \Form::open(['route' => 'client.destroy']) !!}
                        {!! \Form::button('<i class="fa fa-trash"></i> ' . __('client.dell'), ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                        {!! \Form::hidden('id', $client->id) !!}
                        {!! \Form::close() !!}
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
    </table>
@stop