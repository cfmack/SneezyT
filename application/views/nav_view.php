<!DOCTYPE html>
<html lang="en">
<?php
    echo $head;
?>

<body >
<div class="navbar">
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
                              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user"></i> Visual</a>
                              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
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
                    <a class="btn" href="#" id="nav-logout" title="Logout"><i class="icon-unlock"></i></a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
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
	?>
    <div id="container-reaction" class="content-category-container hide"></div>
    <div id="container-environment" class="content-category-container hide"></div>
    <div id="container-medicine" class="content-category-container hide"></div>
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