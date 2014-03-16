<!DOCTYPE html>
<html lang="en">
<?php
    echo $head;
?>

<body >
<div class="navbar">
	<div class="navbar-inner">
		<div class="container">

			<!-- Be sure to leave the brand out there if you want it shown -->
			<a id="nav-home" class="brand" href="#">Sneezy T</a>

            <!-- Everything you want hidden at 940px or less, place within here -->
			<div class="">
				<ul class="nav primary">
				      <li><a href="#" id="nav-food" class="primary-tab" title="Food"><i class="fa fa-cutlery"></i>Food</a></li>
				      <li><a href="#" id="nav-reaction" class="primary-tab" title="Reaction"><i class="fa fa-frown-o"></i>Reaction</a></li>
				      <li><a href="#" id="nav-environment" class="primary-tab" title="Environment"><i class="fa fa-cloud"></i>Environment</a></li>
				      <li><a href="#" id="nav-treatment" class="primary-tab" title="Treatment"><i class="fa fa-medkit"></i>Treatment</a></li>
                </ul>
                <ul class="nav secondary">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="#navbar-more" title="More options">
                            <b class="caret"></b>
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="#" id="nav-hours-from-reaction" class="secondary-tab" title="Food Analyzer"><i class="fa fa-search"></i>Food Analyzer</a></li>
                                  <?php
                                    if ($is_admin)
                                    {
                                        echo '<li><a href="#" id="nav-timeline" class="secondary-tab" title="Timeline">Timeline</a></li>';
                                        echo '<li><a href="#" id="nav-type-merge" class="secondary-tab" title="Merge Types">Merge Types</a></li>';
                                    }
                                  ?>
                                    <li><a href="#" id="nav-calendar" class="secondary-tab" title="Calendar"><i class="fa fa-calendar"></i>Calendar</a></li>

                            <li class="divider"></li>
     				        <li><a href="#" id="nav-person" class="secondary-tab" title="Person Admin"><i class="fa fa-user"></i>Person Admin</a></li>
                            <li><a href="#"  id="nav-person-change" class="secondary-tab" title="Change Person"><i class="fa fa-group"></i>Change Person</a></li>
                            <li class="divider"></li>
                            <li><a href="#"  id="nav-disclaimer" class="secondary-tab" title="Disclaimer"><i class="fa fa-gavel"></i>Disclaimer</a></li>
                            <li><a href="#"  id="nav-license" class="secondary-tab" title="License"><i class="fa fa-file"></i>License</a></li>
                            <li><a href="https://github.com/cfmack/SneezyT/wiki/FAQ" target="_blank" id="nav-faq" class="secondary-tab" title="FAQ"><i class="fa fa-question"></i>FAQ</a></li>
                            <li><a href="#"  id="nav-our-story" class="secondary-tab" title="Our Story"><i class="fa fa-book"></i>Our Story</a></li>
                            <li><a href="http://sneezyt.wordpress.com/"  target="_blank"  id="nav-blog" class="secondary-tab" title="Blog"><i class="fa fa-pagelines"></i>Blog</a></li>
                        </ul>
                    </li>
				</ul>

                <div id="logout">
                    <a href="#" title="Logout" id="nav-logout-menu"><i class="fa fa-fw fa-unlock"></i></a></li>
                </div>
                <div id="current-person-notification" class="hidden-phone">
                    <?echo $person_name; ?>
                </div>
			</div>
        </div>
	</div>
</div>
<div class="content-pane">
	<?php 
		echo $home;
	?>
    <div id="container-food" class="content-category-container hide"></div>
    <div id="container-reaction" class="content-category-container hide"></div>
    <div id="container-environment" class="content-category-container hide"></div>
    <div id="container-treatment" class="content-category-container hide"></div>
    <div id="container-timeline"  class="content-category-container hide"></div>
	<div id="container-hours-from-reaction"  class="content-category-container hide"></div>
	<div id="container-type-merge"  class="content-category-container hide"></div>
    <div id="container-calendar"  class="content-category-container hide"></div>
    <div id="container-person"  class="content-category-container hide"></div>
    <div id="container-person-change"  class="content-category-container hide"></div>
    <div id="container-license"  class="content-category-container hide"></div>
    <div id="container-disclaimer"  class="content-category-container hide"></div>
    <div id="container-our-story"  class="content-category-container hide"></div>
</div>
<script>
    require(["modules/nav"], function(nav) {
        nav.initialize(nav);
    });
</script>
</body>
</html>