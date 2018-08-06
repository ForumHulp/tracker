<ul
	<li>@lang('site.dashboard')</li>   
	<li @if (\Request::is('status*')) class="selected" @endif><a href="{{ route('status.index') }}">@lang('dashboard.status')</a></li>
	<li @if (\Request::is('priority*')) class="selected" @endif><a href="{{ route('priority.index') }}">@lang('dashboard.priority')</a></li>
	<li @if (\Request::is('user*')) class="selected" @endif><a href="{{ route('user.index') }}">@lang('dashboard.user')</a></li>
	<li @if (\Request::is('client*')) class="selected" @endif><a href="{{ route('client.index') }}">@lang('dashboard.client')</a></li>
	<li @if (\Request::is('project*')) class="selected" @endif><a href="{{ route('project.index') }}">@lang('dashboard.project')</a></li>
	<li @if (\Request::is('type*')) class="selected" @endif><a href="{{ route('type.index') }}">@lang('dashboard.type')</a></li>
 </ul>