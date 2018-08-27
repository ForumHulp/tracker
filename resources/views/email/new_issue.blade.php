<html>
<head></head>
<body>
    <h1>{{ $title }} @lang('issue.issue_added')</h1>
    @lang('issue.should') {{ \Carbon\Carbon::parse($start_date)->format('d m Y') }} @lang('issue.have') <?php echo sprintf("%d:%02d", floor($plan_time / 60), $plan_time % 60); ?> @lang('issue.hours_minutes')
</body>
</html>