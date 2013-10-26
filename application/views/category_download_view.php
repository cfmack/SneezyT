<div>
	<form action="post">
		<div id="<?php echo $name; ?>-download-start-container" class="ui-widget visible-desktop visible-tablet">
  				<label for="<?php echo $name; ?>-download-start">Start: </label>
  				<input id="<?php echo $name; ?>-download-start" value="<?php echo date("m/d/Y h:i a", strtotime("-7 days")); ?>"/>
		</div>
		
		<div id="<?php echo $name; ?>-download-start-wheel-container" class="ui-widget visible-phone">
  				<label for="<?php echo $name; ?>-download-start-wheel">Date: </label>
  				<input id="<?php echo $name; ?>-download-start-wheel" type="datetime-local"/>
		</div>

        <div id="<?php echo $name; ?>-download-end-container" class="ui-widget visible-desktop visible-tablet">
            <label for="<?php echo $name; ?>-download-end">End: </label>
            <input id="<?php echo $name; ?>-download-end" value="<?php echo date("m/d/Y h:i a"); ?>"/>
        </div>

        <div id="<?php echo $name; ?>-download-end-wheel-container" class="ui-widget visible-phone">
            <label for="<?php echo $name; ?>-download-end-wheel">Date: </label>
            <input id="<?php echo $name; ?>-download-end-wheel" type="datetime-local"/>
        </div>

		<div id='category-download-<?php echo $name; ?>-submit' >
			<button class="btn btn-primary" type="button">Download</button>
		</div>
	</form>
</div>
<script>
  	require(["modules/category"], function(category) {
        category.download('<?php echo $name; ?>');
    });
</script>
