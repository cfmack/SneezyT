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
<div id="create-user-container">
    <h1><?php echo lang('create_user_heading');?></h1>
    <p><?php echo lang('create_user_subheading');?></p>

    <div id="infoMessage"><?php echo $message;?></div>

    <?php echo form_open("auth/create_user");?>

        <fieldset class="long-inputs">
            <div class="ui-widget">
                <?php echo lang('create_user_fname_label', 'first_name');?>
                <?php echo form_input($first_name);?>
            </div>
            <div class="ui-widget">
                <?php echo lang('create_user_lname_label', 'first_name');?>
                <?php echo form_input($last_name);?>
            </div>

            <div class="ui-widget">
                <?php echo lang('create_user_email_label', 'email');?>
                <?php echo form_input($email);?>
            </div>

            <div class="ui-widget">
                <?php echo lang('create_user_password_label', 'password');?>
                <?php echo form_input($password);?>
            </div>

            <div class="ui-widget">
                <?php echo lang('create_user_password_confirm_label', 'password_confirm');?>
                <?php echo form_input($password_confirm);?>
            </div>
        </fieldset>

       <div class="button-container">
          <?php echo form_submit('submit', lang('create_user_submit_btn'));?>
       </div>
    <?php echo form_close();?>
</div>
</body>
</html>