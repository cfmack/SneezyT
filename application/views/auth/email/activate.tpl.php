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
<p>
    You will need to activate your account by clicking the link below.
</p>
<p>
    As a reminder, you can use Sneezy T to track food and symptoms associated with Food Allergies and Gastrointestinal Disorders, such as Eosinophilic Esophagitis (EoE). A food diary and symptom tracker, such as this application, can help you decide what is plaguing your body. Using this program, you can track the type of food or beverage, the time you ate or drank it, the amount and any notes you would like to include. Additionally, you can track symptoms, the time you experienced them and how long they lasted. Also, you can keep track of your treatment and environmental factors that might play a role into your health.
</p>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/activate/'. $id .'/'. $activation, lang('email_activate_link')));?></p>
</body>
</html>