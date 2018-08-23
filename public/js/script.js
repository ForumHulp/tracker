$(document).ready(function(){
'use strict';
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	if (Boolean(sessionStorage.getItem("sidebar-toggle-collapsed"))) {
		$("body").removeClass('open')
	}
	
	$('#menuToggle').click(function() {
		event.preventDefault();
		if (Boolean(sessionStorage.getItem("sidebar-toggle-collapsed"))) {
			sessionStorage.setItem("sidebar-toggle-collapsed", "");
		} else {
			sessionStorage.setItem("sidebar-toggle-collapsed", "1");
		}
	});

    $(document).on('click', '.collapse-all', function() {
		$('.issue-info').removeClass('show');
		return false;
    });

    $(document).on('click', '.change-remark', function() {
       var url = $(this).data('url');
        $.ajax({
            type: "POST",
            url: url,
			data: {
				_token: CSRF_TOKEN,
				},
            success: function(json) {
				 $('#fileinput' + json.track.issue_id).remove();
				 $('#trackform' + json.track.issue_id + ' input[name=remark]').val(json.track.remark);
				 $('#trackform' + json.track.issue_id + ' input[name=date]').val(json.track.datum);
				 $('#trackform' + json.track.issue_id + ' input[name=used_time]').val(json.track.used_time);
 				 $('<input>').attr({type: 'hidden',id: 'track_id', name: 'track_id', value: json.track.id}).appendTo('#trackform' + json.track.issue_id);
				 $('#trackform' + json.track.issue_id).attr('action', json.route);
                 $('#trackform' + json.track.issue_id + ' input[id=btn_save]').val('Save again');
            },
            dataType: 'json',
        });

        return false;
    });

    $(document).on('click', '.delete', function(element) {
		element.preventDefault();
		var url = $(this).closest("form").attr('action');
		var tr = $(this).closest('tr');
		tr.remove();
        $.ajax({
            type: "POST",
            url: url,
			data: {
				_token: CSRF_TOKEN,
				id: $(this).closest('form').find(':input[name=id]').val()
				},
            success: function(json) {
				$('.modal-body').html(json.message);
				$('#myModal').modal("show");
            },
            dataType: 'json',
        });

        return false;
    });

	var startDate = new Date();
	$('.timepicker').durationpicker();
	$('.datepick').datepicker({
    	language: 'en',
		dateFormat: 'dd-mm-yyyy',
		onShow: function(id, dp, animationCompleted){
			if ($('#' + id.el.id).val() !== '')
			{
				var from = $('#' + id.el.id).val().split('-');
				startDate = new Date(from[2], parseInt(from[1] - 1), parseInt(from[0]));
			}
			dp = $('#' + id.el.id).datepicker({startDate: startDate}).data('datepicker');
			dp.selectDate(startDate);
		}
	});

    if ( $("#bootstrap-data-table").find('tr').not(':first').length <= 10)
    {
        $('.sorting, .sorting_asc, .sorting_desc').click(function() {
            $(".pagination").css("display", "none")
        });
        $(".pagination").css("display", "none");
        $(".dataTables_length").css("display", "none");
        $(".dataTables_info").css("display", "none");
        $(".dataTables_filter").css("display", "none");
    }
    else
	{
        $('.sorting, .sorting_asc, .sorting_desc').click(function() {
            $(".pagination").css("display", "flex")
        });
        $(".pagination").css("display", "flex");
        $(".dataTables_length").css("display", "block");
        $(".dataTables_info").css("display", "block");
        $(".dataTables_filter").css("display", "block");
	}

});
