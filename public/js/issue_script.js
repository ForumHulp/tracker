$(document).ready(function(){
'use strict';
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('change', '#client_id', function() {
        $.ajax({
            type: "POST",
            url: '/issue/select',
			data: {
				_token: CSRF_TOKEN,
				id: $(this).val(),
				type: 'client_id'
				},
            success: function(json) {
				$('#project_id').empty(); // remove old options
				$.each(json.combo1, function(key, value) {
				  $('#project_id').append($("<option></option>")
					 .attr("value", value.key).text(value.value));
				});
				$('#parent_id').empty(); // remove old options
				$.each(json.combo2, function(key, value) {
				  $('#parent_id').append($("<option></option>")
					 .attr("value", value.key).text(value.value));
				});
            },
            dataType: 'json',
        });

        return false;
    });

    $(document).on('change', '#project_id', function() {
        $.ajax({
            type: "POST",
            url: '/issue/select',
			data: {
				_token: CSRF_TOKEN,
				id: $(this).val(),
				type: 'project_id'
				},
            success: function(json) {
				$('#client_id').empty(); // remove old options
				$.each(json.combo1, function(key, value) {
				  $('#client_id').append($("<option></option>")
					 .attr("value", value.key).text(value.value));
				});
				$('#client_id option:eq(1)').attr('selected', 'selected');
				$('#parent_id').empty(); // remove old options
				$.each(json.combo2, function(key, value) {
				  $('#parent_id').append($("<option></option>")
					 .attr("value", value.key).text(value.value));
				});
            },
            dataType: 'json',
        });

        return false;
    });
	
    $(document).on('change', '#parent_id', function() {
        $.ajax({
            type: "POST",
            url: '/issue/select',
			data: {
				_token: CSRF_TOKEN,
				id: $(this).val(),
				type: 'parent_id'
				},
            success: function(json) {
				$('#client_id').empty(); // remove old options
				$.each(json.combo1, function(key, value) {
				  $('#client_id').append($("<option></option>")
					 .attr("value", value.key).text(value.value));
				});
				$('#client_id option:eq(1)').attr('selected', 'selected');
				$('#project_id').empty(); // remove old options
				$.each(json.combo2, function(key, value) {
				  $('#project_id').append($("<option></option>")
					 .attr("value", value.key).text(value.value));
				});
				$('#project_id option:eq(1)').attr('selected', 'selected');
            },
            dataType: 'json',
        });

        return false;
    });

	var startDate = new Date();
	$('#plan_time').durationpicker();
	$('#start_date').datepicker({
    	language: 'en',
		dateFormat: 'dd-mm-yyyy',
		onShow: function(dp, animationCompleted){
			if ($('#start_date').val() !== '')
			{
				var from = $('#start_date').val().split('-');
				startDate = new Date(from[2], parseInt(from[1] - 1), parseInt(from[0]));
			}
			dp = $('#start_date').datepicker({startDate: startDate}).data('datepicker');
			dp.selectDate(startDate);
		}
	});

});