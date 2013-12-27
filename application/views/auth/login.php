<?php
    $this->view('metadata');
?>
<div id="login-container">
    <div class="navbar" style="">
        <div class="navbar-inner">
            <div class="container" >
                <a class="brand" href="#">Sneezy T</a>
            </div>
        </div>
    </div>
    <div class="login-inner-container">
        <div id="login-about" class="hidden-phone">
            <?php
                $this->view('help/logon_about');
            ?>
        </div>
        <div id="login-form" >
            <div id="infoMessage"><?php echo $message;?></div>

            <?php echo form_open("welcome/login");?>
              <fieldset class="long-inputs">
                  <div class="ui-widget">
                    <?php echo lang('login_identity_label', 'identity');?>
                    <?php echo form_input($identity);?>
                  </div>

                  <div class="ui-widget">
                    <?php echo lang('login_password_label', 'password');?>
                    <?php echo form_input($password);?>
                  </div>

                  <div class="ui-widget">
                    <?php echo lang('login_remember_label', 'remember');?>
                    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                  </div>
              </fieldset>

              <div class="login-button-container" ><?php echo form_submit('submit', lang('login_submit_btn'));?></div>

            <?php echo form_close();?>
            <div class="login-link-container" >
                <a href="../auth/forgot_password"><?php echo lang('login_forgot_password');?></a><br />
                <a href="../auth/create_user"><?php echo lang('login_register');?></a>
            </div>
        </div>
    </div>
</div>