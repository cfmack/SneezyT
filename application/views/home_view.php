<div id="container-home" class="content-category-container">
    <div class="category-inner-container">
        <div class="category-inner-left hidden-phone">
            <h1>Sneezy T's Food Tracker</h1>
            <p>
                This is an app that tracks food and symptoms associated with Food Allergies and Gastrointestinal Disorders, such as Eosinophilic Esophagitis (EoE).  With this application, you can track the diet of multiple
                people and their reactions.  Reactions include vomiting, hives, or other external symptoms.  Additionally, you can track the medicine used to treat a reaction and environmental pollens
            </p>
            <p>
                This app is currently provided by a family who has personal struggles with EoE and food allergies of our son.  You can read about our adventures on our blog: <a href="sneezty.wordpress.com">sneezty.wordpress.com</a>
            </p>
            </p>
            <p>
                Hosting this costs money but we do this to help the community at large.  If you would like contribute code, I have open sourced the entire package.  Please reach out. If you would like to donate to keep this site going, please do so at our Paypal account.
            </p>
        </div>
        <div class="category-inner-right" >
            <div id="welcome-button-food" class="welcome-nav pull-left welcome-nav-left" >
                <i class="fa fa-4x fa-cutlery"></i> <div class="icon-label">Food</div>
            </div>
            <div  id="welcome-button-medicine" class="welcome-nav pull-right">
                <i class="fa fa-4x fa-medkit"></i> <div class="icon-label">Medicine</div>
            </div>
            <div id="welcome-button-environment" class="welcome-nav pull-left welcome-nav-left" >
                <i class="fa fa-4x fa-cloud"></i> <div class="icon-label">Environment</div>
            </div>
            <div id="welcome-button-reaction" class="welcome-nav pull-right">
                <i class="fa fa-4x fa-frown-o"></i> <div class="icon-label">Reaction</div>
            </div>
        </div>
    </div>
</div>
<script>
    require(["modules/home"], function(home) {
        home.initialize();
    });
</script>
