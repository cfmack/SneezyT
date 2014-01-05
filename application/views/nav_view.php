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
				      <li><a href="#" id="nav-food" class="primary-tab" >Food</a></li>
				      <li><a href="#" id="nav-reaction" class="primary-tab">Reaction</a></li>
				      <li><a href="#" id="nav-environment" class="primary-tab">Environment</a></li>
				      <li><a href="#" id="nav-medicine" class="primary-tab">Medicine</a></li>
                </ul>
                <ul class="nav secondary">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="#navbar-more">
                            More
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#" id="nav-hours-from-reaction" class="secondary-tab">Reaction Time from Food</a></li>
                                  <?php
                                    if ($is_admin)
                                    {
                                        echo '<li><a href="#" id="nav-timeline" class="secondary-tab">Timeline</a></li>';
                                        echo '<li><a href="#" id="nav-type-merge" class="secondary-tab" >Merge Types</a></li>';
                                    }
                                  ?>
                                    <li><a href="#" id="nav-calendar" class="secondary-tab">Calendar</a></li>

                            <li class="divider"></li>
     				        <li><a href="#" id="nav-person" class="secondary-tab"><i class="i"></i> Person Admin</a></li>
                            <li><a href="#"  id="nav-person-change" class="secondary-tab"><i class="i"></i> Change Person</a></li>
                        </ul>
                    </li>
				</ul>
                <ul class="nav">
                    <li><a href="#" title="Logout" id="nav-logout-menu"><i class="fa fa-fw fa-unlock"></i></a></li>
                </ul>
                <div id="current-person-notification" >
                    <? echo $person_name; ?>
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
    <div id="container-medicine" class="content-category-container hide"></div>
    <div id="container-timeline"  class="content-category-container hide"></div>
	<div id="container-hours-from-reaction"  class="content-category-container hide"></div>
	<div id="container-type-merge"  class="content-category-container hide"></div>
    <div id="container-calendar"  class="content-category-container hide"></div>
    <div id="container-person"  class="content-category-container hide"></div>
    <div id="container-person-change"  class="content-category-container hide"></div>
</div>
<script>
    require(["modules/nav"], function(nav) {
        nav.initialize(nav);
    });
</script>
</body>
</html>