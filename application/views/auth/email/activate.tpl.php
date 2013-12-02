<html>
<head>
<style media="screen" type="text/css">
    h3 {
        color: #8c2096
    }
</style>
</head>
<body>
<h3><?php echo sprintf(lang('email_activate_heading'));?></h3>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link')));?></p>
</body>
</html>