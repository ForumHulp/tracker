$(document).ready(function(){
'use strict';
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('click', '.change-remark', function() {
       $('#fileinput').remove();
       var url = $(this).data('url');

        $.ajax({
            type: "POST",
            url: url,
			data: {
				_token: CSRF_TOKEN,
				},
            success: function(json) {
                $('#remark').val(json.track.remark);
                $('#datepicker').val(json.track.datum);
                $('#timepicker').val(json.track.used_time);
                $('#progress').val(json.track.progress);
				$('#track_id').remove();
				$('<input>').attr({type: 'hidden',id: 'track_id',name: 'track_id', value: json.track.id}).appendTo('#trackform');
				$('#trackform').attr('action', json.route);

                $('#btn_save').val('Save again');
            },
            dataType: 'json',
        });

        return false;
    });

	var startDate = new Date();
	$('#timepicker').durationpicker();
	$('#datepicker').datepicker({
    	language: 'en',
		dateFormat: 'dd-mm-yyyy',
		onShow: function(dp, animationCompleted){
			if ($('#datepicker').val() !== '')
			{
				var from = $('#datepicker').val().split('-');
				startDate = new Date(from[2], parseInt(from[1] - 1), parseInt(from[0]));
			}
			dp = $('#datepicker').datepicker({startDate: startDate}).data('datepicker');
			dp.selectDate(startDate);
		}
	});

});