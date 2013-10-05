define(["jquery-ui", "fullcalendar"], function($, fullcalendar) {
    return {
        initialize: function _calendar_initialize(the_events) {
            $('#calendar').fullCalendar({
                theme: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                events: base_url + 'index.php/result/get_calendar_data'
            });
            console.log('here');
        }
    }
});