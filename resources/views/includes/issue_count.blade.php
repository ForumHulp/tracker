issues: {{ $issue_count->total }}
@foreach($issue_count->types as $type)
@lang('issue.type' . $type->type_id): {{ $type->total }}
@endforeach