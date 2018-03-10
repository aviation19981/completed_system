
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo KNOW_PLANE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_KNOW_PLANE; ?></font></h3>
	

</section>



<?php


	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$sql = "select * FROM fleets order by name asc";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}


	
	?>
	



		<section class="contact">
			<div class="container">
            <br>
			<br>
			<!-- Table -->
			<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                                <tr>
												
												<th><b><?php echo TYPE; ?></b></th>
												<th><b><?php echo REGISTRY_PLANE; ?></b></th>
												<th><b><?php echo LOCATION_PLANE; ?></b></th>
												<th><b>Hub</b></th>
												<th><b><?php echo STATUS_PLANE; ?></b></th>
												<th><b><?php echo HOURS_PLANE; ?></b></th>
												<th><b><?php echo BOOKED_PLANE; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
				<?php
					
					while ($row = $result->fetch_assoc()) {
						
						$fleettype_id =$row["fleettype_id"];
						
	$sql1 = "select * from fleettypes where fleettype_id=$fleettype_id";
	if (!$result1 = $db->query($sql1)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row1 = $result1->fetch_assoc()) {
		$plane_icao = $row1["plane_icao"];
	}
	
	$hub_id =$row["hub_id"];
		$sql1h = "select * from hubs where hub_id=$hub_id";
	if (!$result1h = $db->query($sql1h)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row1h = $result1h->fetch_assoc()) {
		$hub = $row1h["hub"];
	}
	
	
	
				
						echo "<td>";
						
					
					
     echo $plane_icao . '</td><td>';
     echo $row["registry"] . '</td><td>';
	
						
						
					 echo $row["location"];	
						
						
						$locations = $row["location"]; 


// Get Location info details

	$sql4 = "SELECT * FROM airports  where ident='$locations'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row4 = $result4->fetch_assoc()) {

		$location_airport_names = $row4['name'];

		$location_airport_flags = $row4['iso_country'];


                                                                        echo '<img class="flag" src="./images/flags/24/' . $location_airport_flags . '.png" width="8%" alt="' . $location_airport_flags . '">';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'.$location_airport_names.'</font></td><td>';
												

	}

	
						
						
						
						
						
						
						
				   echo $hub;		
						
						// INFO HUB
		

// Get Location info details

	$sql3 = "SELECT * FROM airports  where ident='$hub'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row3 = $result3->fetch_assoc()) {

		$location_airport_namesss = $row3['name'];

		$location_airport_flagsss = $row3['iso_country'];

echo '<img src="./images/flags/24/' . $location_airport_flagsss . '.png" width="8%" class="flag" alt="' . $location_airport_flagsss . '" >';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'. $location_airport_namesss .'</font></td><td>';

	}
	
	
	
	
	
						?>

						
<?php echo $row["status"]; ?>%

</td><td>
						<?php

$sumas= $row["hours"];
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';
///////////////// PERSONA QUE RESERVÓ
$fleet_id =$row["fleet_id"];
if ($row["booked"] == 1) {
	
	
	$sqlreserva = "SELECT * FROM reserves  where fleet_id='$fleet_id'";

	if (!$resultreserva = $db->query($sqlreserva)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($rowreserva = $resultreserva->fetch_assoc()) {

		$gvausers_identi = $rowreserva['gvauser_id'];
	}
	
	
	$sqlreserva2 = "SELECT callsign FROM gvausers  where gvauser_id='$gvausers_identi'";

	if (!$resultreserva2 = $db->query($sqlreserva2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($rowreserva2 = $resultreserva2->fetch_assoc()) {

		$nombresreservado = $rowreserva2['callsign'];
	}
	
	
}

	/////////////
                	echo $total . '</td><td>';
						//echo $row["name"] . '</td><td>';
						if ($row["hangar"] == 1) {
							echo '<font color="#A16F0C"><b>'. PLANE_MAINTENANCE . '</b></font></td><td>';
						} else {
							if ($row["booked"] == 1) {
								echo '<font color="#B20000"><b>'. PLANE_BOOKED. ' [' . $nombresreservado . ']</b></font></td><td>';
							} else {
								echo '<font color="#125D06"><b>'. PLANE_FREE . '</b></font></td><td>';
							}
						}
						
						echo '</tr>';
					}
					
					
					
					
					$db->close();
				?>
			</tbody></table>
			

	<div class="clearfix visible-lg"></div>
</div>
</div>
</section>