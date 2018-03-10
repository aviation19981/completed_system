<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo OUR_ROUTES_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_OUR_ROUTES_TITLE; ?></font></h3>
	

</section>


									

	<div class="clear"></div>


	<section class="about" id="about">
			<div class="container">
			<?php
	include('./db_login.php');
	$vuelos=0;
	/* Connect to Database */
	$db_map = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db_map->set_charset("utf8");
	if ($db_map->connect_errno > 0) {
		die('Unable to connect to database [' . $db_map->connect_error . ']');
	}
	$sql_map = "select departure, arrival  from routes";
	if (!$result = $db_map->query($sql_map)) {
		die('There was an error running the query  [' . $db_map->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$vuelos++;
	}
	// Execute SQL query
	
	
	?>


				<h4><?php echo str_replace('NUMROUTES',$vuelos,RUTAS_INFO); ?></h4>
				<hr>
				<center><?php include('./maps_global.php'); ?></center>


</div>
</section>