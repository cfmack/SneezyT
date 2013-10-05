define(["jquery-ui", "fullcalendar"], function($, fullcalendar) {
    return {
        initialize: function _calendar_initialize(the_events) {
            console.log('in initialize');
            /*
            $('#calendar').fullCalendar({
                theme: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                editable: true,
                events: the_events
            });
            */
        }
    }
});