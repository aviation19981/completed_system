
<?php
include('./db_login.php');
	$operator_id = $_GET['operator_id'];
	$name_operator = $_GET['name_operator'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}



	// fleet

	$sql_fleet= "select registry, status, hours,plane_description, location
			from fleets f
			inner join fleettypes ft on f.fleettype_id=ft.fleettype_id
			where operator_id = $operator_id";

	if (!$result_fleet = $db->query($sql_fleet)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	// Hub info

	$sql_hub = "select count(*) num_pilots from gvausers where operator_id=$operator_id ";
	if (!$result_hub = $db->query($sql_hub)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_hub = $result_hub->fetch_assoc()) {
		$num_pilots= $row_hub["num_pilots"];
	}

	$sql_hub = "select count(*) num_fleet from fleets where operator_id=$operator_id ";
	if (!$result_hub = $db->query($sql_hub)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_hub = $result_hub->fetch_assoc()) {
		$num_fleet= $row_hub["num_fleet"];
	}

	$sql_operator_global ="select * from operators where operator_id=$operator_id";

	if (!$result_operator_global = $db->query($sql_operator_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator = $result_operator_global->fetch_assoc()) {
		$operator_ids= $row_operator["operator_id"];
        $name_operators= $row_operator["operator"];
		$imgs = $row_operator["file"];
		$ceo = $row_operator["ceo"];
		$hub_principal = $row_operator["hub_principal"];
		$descripcion1 = $row_operator["parrafo_primero"];
		$imagen_va = $row_operator["imagen_aerolinea"];
		
		
		// Get Location info details

	$sql4 = "SELECT * FROM airports  where ident='$hub_principal'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row4 = $result4->fetch_assoc()) {

        $departure_airport = $row4['name'];
		$dep_iso_country = $row4['iso_country'];
		
		

	}
	
	}
	

	//$sql_hub = "select * from hubs h inner join airports a on a.ident = h.hub where hub_id=$hub_id ";
	//if (!$result_hub = $db->query($sql_hub)) {
		//die('There was an error running the query [' . $db->error . ']');
	//}
	//while ($row_hub = $result_hub->fetch_assoc()) {
		//$iso_country= $row_hub["iso_country"];
		//$hub_name= $row_hub["name"];
		//$hub_web= $row_hub["web"];
 //$hub_icao= $row_hub["hub"];
		//$hub_image = $row_hub["image_url"];
//$servicios= $row_hub["municipality"];
	//}

	$sql_routes = "select * from routes where operator_id=$operator_id ";

	if (!$result_routes = $db->query($sql_routes)) {
		die('There was an error running the query [' . $db->error . ']');
	}

$sql_hub = "select count(*) num_routes from routes where operator_id=$operator_id ";
	if (!$result_hub = $db->query($sql_hub)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_hub = $result_hub->fetch_assoc()) {
		$num_routes= $row_hub["num_routes"];
	}

$sql_operator_globals ="select * from operators order by operator asc";

	if (!$result_operator_globals = $db->query($sql_operator_globals)) {
		die('There was an error running the query [' . $db->error . ']');
	}


		

	?>
	
	
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('./images/fondos/<?php echo rand(1,10); ?>.jpg')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo AIRLINES_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_AIRLINES_TITLE; ?></font></h3>
	

</section>

		

		<section class="contact">
			<div class="container">


	


<div class="row">
	
   
              <p> <?php echo AIRLINE_DETAIL; ?></p>
			  
			  <hr>

<!--Sidebar-->
					<div class="col-md-3 sidebar left-sidebar">

						<!-- Categories Widget -->
						<div class="widget widget-categories">
						
						
						<?php
						
						
	while ($row_operators = $result_operator_globals->fetch_assoc()) {
		$operator_ide= $row_operators["operator_id"];
        $name_operatore= $row_operators["operator"];
		$imge = $row_operators["file"];
		
		
					
									echo '<a href="./index.php?page=filiales&operator_id=' . $operator_ide . '"><img src="../../admin/images/operators/' .$imge . '" alt="" width="80%"/><br><br></a>';
				
				
				
				
	}
	?>
				   
						</div>


					</div>
					<!--End sidebar-->
					
					
					<!-- Start Blog Posts -->
					<div class="col-md-9 blog-box">
						
						<!-- Start Post -->
						<div class="blog-post image-post">
							<!-- Post Thumb -->
							<center><img alt="" src="../../admin/images/operators/<?php echo $imgs; ?>" /></center><br><br>
							<div class="post-head">
								
									<center><img alt="" src="../../admin/images/portada/<?php echo $imagen_va; ?>" width="80%"/></center>
						
							</div>
							
<br>
							<!-- Post Content -->
							<div class="post-content">
							<table class="table table-boxed">
							<tr>
							<th><center><?php echo FLIGHTS_TOTAL_AIRLINE; ?></center></th>
							
							<th><center><?php echo PILOTS_TOTAL_AIRLINE; ?></center></th>
							
							<th><center><?php echo PLANES_TOTAL_AIRLINE; ?></center></th>
							</tr>
							<tr>
							<td><center><?php echo $num_routes; ?></center></td>
							
							<td><center><?php echo $num_pilots; ?></center></td>
							
							<td><center><?php echo $num_fleet; ?></center></td>
							</table>
				


									
							
							
							<p><em><b><?php echo MORE_INFO_VA; ?></b></em></p>
<table class="table table-striped" width="100%">
<thead>
  <tr>
    <th style="text-align:center;">HUB</th><th>CEO</th>
  </tr>
</thead>
<tbody>
  <tr>
    
<td style="text-align:center;"><font size="1"></font><i class="fa fa-sign-out"></i>&nbsp;<?php echo $departure_airport . ' ' . '(' . $hub_principal . ')' ?>&nbsp;<img src="./images/flags/24/<?php echo $dep_iso_country; ?>.png" alt="<?php echo $dep_iso_country; ?>"></td><td><?php echo $ceo; ?></td>

  </tr>
</tbody>
</table>



							<p>
							
						<?php echo $descripcion1; ?>
							</p>
							
							<br>
							<br>
							
							<table class="table table-striped" width="100%">
<thead>
  <tr>
    <th style="text-align:center;"><?php echo MAP_VA; ?></th>
  </tr>
</thead>
<tbody>
  <tr>
    
<td style="text-align:center;">
<?php 
	
	include ('./maps_operator.php');
	
	?>
	</td>
	</tr>
	</tbody>
</table>
							
	
	<br>
	<br>
</div>
</div>

						<!-- End Post -->
						

					</div>
					<!-- End Blog Posts -->
					
					
					<hr>
					
					</div>
					</div>
	</section>