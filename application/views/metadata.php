<head>
    <title>Sneezy T Food Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
        // globals
        var base_url = '<?php echo base_url();?>';
    </script>


    <!-- CSS -->
    <link rel=stylesheet href="<?php echo base_url();?>public/css/reset.css" type="text/css" />
    <link rel=stylesheet href="<?php echo base_url();?>public/lib/jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" type="text/css" />
    <link rel=stylesheet href="<?php echo base_url();?>public/css/theme/bootstrap.purple.css" type="text/css" />
    <link rel=stylesheet href="<?php echo base_url();?>public/lib/jtable/themes/lightcolor/customgray/jtable.css" type="text/css" />
    <link rel=stylesheet href="<?php echo base_url();?>public/lib/bootstrap/css/bootstrap-responsive.css"  type="text/css">
    <link rel=stylesheet href="<?php echo base_url();?>public/lib/fullcalendar/fullcalendar.css"  type="text/css">
    <link rel=stylesheet href="<?php echo base_url();?>public/css/font-awesome/css/font-awesome.css " type="text/css" />
    <link rel=stylesheet href="<?php echo base_url();?>public/css/sneezy.css" type="text/css" />



    <script src="<?php echo base_url();?>public/require.js"></script>
    <script>
        // ... but be aware that the data-main script is loaded asynchronously.
        require.config({
            baseUrl: 'public',
            deps: ["main"],
            paths: {
                "jquery"        :   'lib/jquery-ui/js/jquery-1.9.1',
                "jquery-ui"     :   'lib/jquery-ui/js/jquery-ui-1.10.2.custom.min',
                "timepicker"    :   'lib/jquery-ui/js/jquery-ui-timepicker-addon',
                "jtable"        :   'lib/jtable/jquery.jtable.min',
                "fullcalendar"  :   'lib/fullcalendar/fullcalendar.min',
                "bootstrap"     :   "lib/bootstrap/js/bootstrap",
                "timeline"      :   "http://static.simile.mit.edu/timeline/api/timeline-api"
            },
            shim: {
                "jquery-ui": {
                    exports: "$",
                    deps: ['jquery']
                },
                "timepicker" : {
                    deps: ['jquery', "jquery-ui"]
                },
                "jtable" : {
                    deps: ['jquery', "jquery-ui"]
                },
                "fulltable" : {
                    deps: ['jquery', "jquery-ui"]
                },
                "bootstrap": ['jquery', "jquery-ui"]
            }
        });
    </script>
    <! -- GOOGLE ANALYTICS -->
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-46625743-1']);
        _gaq.push(['_setDomainName', 'sneezyt.com']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>


</head>