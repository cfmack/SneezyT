<div id='calendar'></div>

<script>
        $('#calendar').fullCalendar({
            theme: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            editable: true,
            events: <?php echo $events; ?>
        });
</script>