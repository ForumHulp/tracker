$(document).ready(function(){
'use strict';

    var hr = 0;
    var minute = 0;
    var sec = 0;
    var counter = 0;
	var target = 0;
    $('.start-timer').on('click', start);
    $('.stop-timer').on('click', function () {
        clearInterval(counter);
		$('.start-timer').show();
        $('.stop-timer').hide();
        $('.start-timer').on('click', start);
    });
    function start(e) {
       e.preventDefault();
	   target = $(this).data('target');
       var time = $('#timepicker' + target).val().split(':');
       hr = parseInt(time[0]);
       minute = parseInt(time[1]);

       $('.start-timer').hide();
       $('.stop-timer').show();
       counter = setInterval(step, 100);
       $('.start-timer').off('click');
    }

    function step() {
        sec = sec + 1;
        if (sec > 59) {
            sec = 0;
            minute = minute + 1;
        }
        if (minute > 59) {
            minute = 0;
            hr = hr + 1;
        }
   
		$('#timepicker' + target).val(hr + ':' + ((minute < 10) ? '0' + minute : minute));
    }
});
