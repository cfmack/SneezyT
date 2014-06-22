<?php
    $this->view('metadata');
?>
<div id="login-container">
    <div class="navbar" style="">
        <div class="navbar-inner">
            <div class="container" >
                <a class="brand" href="<?php echo base_url();?>">Sneezy T</a>
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
            <div id="new-to-sneezy-button" class="pull-left visible-phone">
                <button class="btn btn-success" type="button">New to Sneezy?</button>
            </div>
            <div class="login-link-container" >
                <a href="../auth/forgot_password"><?php echo lang('login_forgot_password');?></a><br />
                <a href="../auth/create_user"><?php echo lang('login_register');?></a>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // kicking it old school as require.js settings are screwed up prior to log in
    var b = document.getElementById("new-to-sneezy-button");
    b.onclick = function () {
        window.location.replace(base_url + 'index.php/welcome/newtosneezy');
    };
</script>