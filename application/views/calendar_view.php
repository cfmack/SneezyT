<div id='calendar'></div>

<script>
    require(["modules/calendar"], function(calendar) {
        calendar.initialize( '<?php echo $events; ?>' );
    });
</script>