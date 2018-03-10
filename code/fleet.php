<?php
session_start();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "https://" . $host;

	
    if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['language'] = "es";
	}
	
		
	
	
    include("./../main/languages/lang_" . $_SESSION['language'] . ".php");
	
	$aerolinea_id = $_GET['va']; ?>

<!doctype html>
<html lang="en">
  <head>
    <title>ColStar Alliance</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../../main/images/favicon.ico" type="image/x-icon" rel="icon" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>


<?php

   include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$sql = "select * FROM fleets where operator_id='$aerolinea_id' order by name asc ";

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


                                                                        echo '<img class="flag" src="../../main/images/flags/24/' . $location_airport_flags . '.png" width="8%" alt="' . $location_airport_flags . '">';

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

echo '<img src="../../main/images/flags/24/' . $location_airport_flagsss . '.png" width="8%" class="flag" alt="' . $location_airport_flagsss . '" >';

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


	
			
			<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>