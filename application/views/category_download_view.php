<div>
	<form action="post">
        <fieldset class="add-inputs">
            <div id="<?php echo $name; ?>-download-start-container" class="ui-widget visible-desktop visible-tablet">
                    <label for="<?php echo $name; ?>-download-start">Start: </label>
                    <input id="<?php echo $name; ?>-download-start" value="<?php echo date("m/d/Y", strtotime("-7 days")); ?>"/>
            </div>

            <div id="<?php echo $name; ?>-download-start-wheel-container" class="ui-widget visible-phone">
                    <label for="<?php echo $name; ?>-download-start-wheel">Start: </label>
                    <input id="<?php echo $name; ?>-download-start-wheel" type="date"/>
            </div>

            <div id="<?php echo $name; ?>-download-end-container" class="ui-widget visible-desktop visible-tablet">
                <label for="<?php echo $name; ?>-download-end">End: </label>
                <input id="<?php echo $name; ?>-download-end" value="<?php echo date("m/d/Y"); ?>"/>
            </div>

            <div id="<?php echo $name; ?>-download-end-wheel-container" class="ui-widget visible-phone">
                <label for="<?php echo $name; ?>-download-end-wheel">End: </label>
                <input id="<?php echo $name; ?>-download-end-wheel" type="date"/>
            </div>

            <div id='category-download-<?php echo $name; ?>-submit' class="left-button pull-left" >
                <button class="btn btn-primary" type="button">Download</button>
            </div>

            <div id='category-email-<?php echo $name; ?>-submit' class="right-button pull-right" >
                <button class="btn btn-primary" type="button">Email</button>
            </div>
        </fieldset>
	</form>
</div>
<div id="<?php echo $name; ?>-email-response" class="alert_response"></div>
<script>
  	require(["modules/category"], function(category) {
        category.download('<?php echo $name; ?>');
    });
</script>
