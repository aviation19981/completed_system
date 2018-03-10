
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo HUBS_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_HUBS_TITLE; ?></font></h3>
	

</section>

<section class="section-team team" id="team">
			<div class="container">
				<div class="sixteen columns">
					<h1><?php echo INFO_HUBS_TITLE_TWO; ?></h1>
				</div>
				<div class="sixteen columns">
					<div class="sub-text-line"></div>
				</div>
				<div class="clear"></div>
				<div class="sixteen columns">
				<?php
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql_hub_global ="select * from hubs order by hub asc";
	if (!$result_hub_global = $db->query($sql_hub_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_hubs = $result_hub_global->fetch_assoc()) {
		$hub_id= $row_hubs["hub_id"];
		$training= $row_hubs["training"];
		
		

		// fleet
		$sql_fleet= "select registry, status, hours,plane_description, location
				from fleets f
				inner join fleettypes ft on f.fleettype_id=ft.fleettype_id
				where hub_id = $hub_id";
		if (!$result_fleet = $db->query($sql_fleet)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		// Hub info
		$sql_hub = "select count(*) num_pilots from gvausers where hub_id=$hub_id and activation=1";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$num_pilots= $row_hub["num_pilots"];
		}
		$sql_hub = "select count(*) num_fleet from fleets where hub_id=$hub_id ";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$num_fleet= $row_hub["num_fleet"];
		}
		
	    $sql_hub = "select count(*) pilots from gvausers where hub_id=$hub_id ";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$pilots= $row_hub["pilots"];
		}

		$sql_hub = "select * from hubs h inner join airports a on a.ident = h.hub where hub_id=$hub_id ";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$iso_country= $row_hub["iso_country"];
			$ident= $row_hub["ident"];
			$hub_name= $row_hub["name"];
			$hub_web= $row_hub["web"];
			$hub_image = $row_hub["image_url"];
			
		$iata_code = $row_hub['iata_code'];
		$type = $row_hub['type'];
		$latitude_deg = $row_hub['latitude_deg'];
		$longitude_deg = $row_hub['longitude_deg'];
		$elevation_ft = $row_hub['elevation_ft'];
		$municipality = $row_hub['municipality'];
		$continent = $row_hub['continent'];
        $iso_region = $row_hub['iso_region'];
		$iso_country = $row_hub['iso_country'];
		}
		
		
		$sql_hub = "select count(*) num_routes from routes where departure='$ident' or arrival='$ident'";
		if (!$result_hub = $db->query($sql_hub)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_hub = $result_hub->fetch_assoc()) {
			$num_routes= $row_hub["num_routes"];
		}
		
		
			$sql23 = "select * from country_t where iso2='$iso_country'";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		
			$country = $row23["short_name"];
		
		
	}
	
		
		?>
					<article>
						<img src="<?php echo $hub_image; ?>" alt=""/>
						<h6><?php echo str_replace("Airport","",str_replace("International Airport", "",$hub_name)); ?></h6>
						<p><span><?php echo $row_hubs['hub'] . ' [' . $iso_country . ']'; ?> / <?php echo $ident; ?></span></p>
						<p>
						<i class="icon color--primary icon-Plane"></i> <b><?php echo PLANE_MENU; ?>:</b> +<?php echo  $num_fleet; ?><br>
									<i class="icon color--primary flaticon-pilot"></i> <b><?php echo PILOT_MENU; ?>:</b> +<?php echo  $pilots; ?><br>
									<i class="icon color--primary flaticon-travel"></i> <b><?php echo ROUTE_MENU; ?>:</b> +<?php echo  $num_routes; ?> <br>
						
						</p>
					</article>
				
					
					<?php } ?>				
					</div>
			</div>
		</section> 
		
	
	
	