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
                $('#datetimepicker').val(json.track.date);
                $('#timepicker').val(json.track.used_time);
                $('#progress').val(json.track.progress);
				$('<input>').attr({type: 'hidden',id: 'track_id',name: 'track_id', value: json.track.id}).appendTo('#trackform');
				$('#trackform').attr('action', json.route);

				
                $('#btn_save').val('Save again');
            },
            dataType: 'json',
        });

        return false;
    });
});