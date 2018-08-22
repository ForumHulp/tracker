<span class="" title="@foreach($issue_count->status as $status)@lang('issue.status' . $status->status_id): {{ $status->total }} @endforeach">
Issues: {{ $issue_count->total }}, 
@foreach($issue_count->types as $type)
@lang('issue.type' . $type->type_id): {{ $type->total }}@if (!$loop->last), @endif 
@endforeach
</span>