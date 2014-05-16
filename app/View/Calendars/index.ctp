<?php
    echo $this->Html->css( 'fullcalendar/fullcalendar.css');
    echo $this->Html->script( 'jquery.min.js');
    echo $this->Html->script( 'fullcalendar/fullcalendar.min.js');
?>

<div id="fc1" class="fc"></div>

<script type="text/javascript">
$(document).ready(function() {
    $('#fc1').fullCalendar({})
});
</script>

<div id="fc2" class="fc"></div>
<script type="text/javascript">
$(document).ready(function() {
    $('#fc2').fullCalendar({
        calendars: "<?php echo $this->webroot;?>fcfeed/",
    })
});
</script>