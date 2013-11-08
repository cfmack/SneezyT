<!DOCTYPE html>
<html lang="en">
<head>
<title>Sneezy T Food Tracker</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script>
	// globals
	var base_url = '<?php echo base_url();?>';
	</script>
	

	<!-- CSS -->
	<link rel=stylesheet href="<?php echo base_url();?>public/lib/jquery-ui/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" type="text/css" />
	<link rel=stylesheet href="<?php echo base_url();?>public/lib/jtable/themes/metro/blue/jtable.min.css" type="text/css" />
	<link rel=stylesheet href="<?php echo base_url();?>public/lib/jtable/themes/metro/darkgray/jtable.css" type="text/css" />
	<link rel=stylesheet href="<?php echo base_url();?>public/lib/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel=stylesheet href="<?php echo base_url();?>public/lib/bootstrap/css/bootstrap-responsive.min.css"  type="text/css">
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
                "bootstrap": ['jquery']
            }
        });
    </script>

</head>
<body >
<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<div class="container">
			<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<!-- Be sure to leave the brand out there if you want it shown -->
			<a class="brand" href="#">Sneezy T</a>

			<!-- Everything you want hidden at 940px or less, place within here -->
			<div class="nav-collapse">
				<ul class="nav">
				      <li class="active"><a href="#" id="nav-food">Food</a></li>
				      <li><a href="#" id="nav-reaction">Reaction</a></li>
				      <li><a href="#" id="nav-environment">Environment</a></li>
				      <li><a href="#" id="nav-medicine">Medicine</a></li>
				      <li class="dropdown">
                          <div class="btn-group">
                              <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user"></i> Visual</a>
                              <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
                              <span class="icon-caret-down"></span></a>
                              <ul class="dropdown-menu">
                                    <li><a href="#" id="nav-timeline">Timeline</a></li>
                                    <li><a href="#" id="nav-hours-from-reaction">Reaction Time from Food</a></li>
                                    <li><a href="#" id="nav-type-merge">Merge Types</a></li>
                                    <li><a href="#" id="nav-calendar">Calendar</a></li>
                              </ul>
                        </div>
     				  </li>
				</ul>
                <div class="btn-group">
                    <a class="btn btn-inverse" href="#" id="nav-logout" title="Logout"><i class="icon-unlock"></i></a>
                    <a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="icon-caret-down"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" title="Logout" id="nav-logout-menu"><i class="icon-fixed-width icon-unlock"></i> Log out</a></li>
                            <li class="divider"></li>
                            <li><a href="#" id="nav-person"><i class="i"></i> Person Admin</a></li>
                            <li><a href="#"><i class="i"></i> Edit Profile</a></li>
                        </ul>
                </div>
			</div>
        </div>
	</div>
</div>
<div class="content-pane">
	<?php 
		echo $food;
		echo $reaction;
		echo $environment;
		echo $medicine;	
	?>
	<div id="container-timeline"  class="content-category-container hide"></div>
	<div id="container-hours-from-reaction"  class="content-category-container hide"></div>
	<div id="container-type-merge"  class="content-category-container hide"></div>
    <div id="container-calendar"  class="content-category-container hide"></div>
    <div id="container-person"  class="content-category-container hide"></div>
</div>
<script>
    require(["modules/nav"], function(nav) {
        nav.initialize();
    });
</script>
</body>
</html>