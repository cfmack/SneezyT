<!DOCTYPE html>
<html lang="en">
<?php
echo $head;
?>

<body >

<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo base_url(); ?>">Sneezy T</a>
        </div>
    </div>
</div>
<div id="forgot-password-container" class="auth-container">
    <h1><?php echo lang('forgot_password_heading');?></h1>
    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("auth/forgot_password");?>

    <fieldset class="long-inputs">
        <div class="ui-widget">
            <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label>
            <?php echo form_input($email);?>
        </div>
    </fieldset>
     <div  class="button-container"><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></div>

    <?php echo form_close();?>
</div>
</body>
</html>