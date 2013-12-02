<!DOCTYPE html>
<html lang="en">
<?php
echo $head;
?>

<body >

<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="#">Sneezy T</a>
        </div>
    </div>
</div>
<div id="reset-password-container" class="auth-container">

    <h1><?php echo lang('reset_password_heading');?></h1>

    <h4><?php echo sprintf(lang('reset_password_new_password_requirements'), $min_password_length);?></h4>

    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open('auth/reset_password/' . $code);?>

    <fieldset class="long-inputs">
        <div class="ui-widget">
            <label for="new_password"><?php echo lang('reset_password_new_password_label');?></label>
		    <?php echo form_input($new_password);?>
	    </div>

        <div class="ui-widget">
		    <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?>
		    <?php echo form_input($new_password_confirm);?>
	    </div>
    </fieldset>
    <?php echo form_input($user_id);?>
    <?php echo form_hidden($csrf); ?>
    <div class="button-container"><?php echo form_submit('submit', lang('reset_password_submit_btn'));?></div>

    <?php echo form_close();?>
</div>
</body>
</html>