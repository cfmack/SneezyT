<div class="category-add-container">
	<h1 class="visible-phone"><i class="fa <?php echo $icon; ?>"></i> <?php echo $header; ?></h1>
	<form action="post">
        <fieldset class="add-inputs">
            <div class="ui-widget">
                    <label for="<?php echo $name; ?>-types">Type: </label>
                    <input id="<?php echo $name; ?>-types" />
            </div>

            <div class="ui-widget">
                <label for="<?php echo $name; ?>-amount"><?php echo $amount_label; ?>: </label>
                <input id="<?php echo $name; ?>-amount" />
            </div>

            <div class="ui-widget">
                    <label for="<?php echo $name; ?>-note">Note: </label>
                    <input id="<?php echo $name; ?>-note" />
            </div>

            <div id="<?php echo $name; ?>-date-container" class="ui-widget visible-desktop visible-tablet">
                    <label for="<?php echo $name; ?>-date">Date: </label>
                    <input id="<?php echo $name; ?>-date" value="<?php echo date("m/d/Y h:i a"); ?>"/>
            </div>

            <div id="<?php echo $name; ?>-date-wheel-container" class="ui-widget visible-phone">
                    <label for="<?php echo $name; ?>-date-wheel">Date: </label>
                    <input id="<?php echo $name; ?>-date-wheel" type="datetime-local"/>
            </div>

            <div id='add-<?php echo $name; ?>-submit' class="add-submit pull-left">
                <button class="btn btn-primary" type="button">Submit</button>
            </div>
            <div class="add-question pull-right ">
                <i class="fa fa-2x fa-question-circle toggle-about"></i>
            </div>
        </fieldset>
	</form>
	<div id="<?php echo $name; ?>-response" class="alert_response"></div>
</div>
<script>
  	require(["modules/category"], function(category) {
        category.add('<?php echo $name; ?>');
        category.toggle('<?php echo $name; ?>');
    });
</script>
