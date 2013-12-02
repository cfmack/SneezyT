<html>
<head>
<style media="screen" type="text/css">
h3 {
    color: #8c2096
}
</style>
</head>
<body>
	<h3><?php echo lang('email_forgot_password_heading');?></h3>
	<p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
</body>
</html>