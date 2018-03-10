

<?php
	$route_id= $_GET['route_id'];
	include('va_parameters.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

?>


<?php



	$sql = " select * from routes where route_id=$route_id";
	

		

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}
	
	while ($row = $result->fetch_assoc()) {
		
		$flight = $row["flight"];
		$departure = $row["departure"];
		$arrival = $row["arrival"];
		$eta = $row["eta"];
		$etd = $row["etd"];
		$plane_description = $row["fleettype_id"];
		$flproute = $row["flproute"];
		$pax = $row["pax"];
		$sumas= $row["duration"];
		$price = $row["price"];
		
		$sql_flighttype = "SELECT * FROM flighttypes ORDER BY flighttype_id ASC";
							if (!$result_flighttype = $db->query($sql_flighttype)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_flighttype = $result_flighttype->fetch_assoc()) {
							
							if($row_flighttype["flighttype_id"] == $row["flighttype_id"]) {
							
							
							$flighttype = $row_flighttype["flighttype"];
							
							}
							}
		
		$sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row["operator_id"]) {
							
							
							$img = $row_operator["file"];
							
							}
							

							

}
if ($row["operator_id"] > 0) {
$montevideo = '<img src="../../admin/images/operators/' . $img . '" alt="' . $flight . '" height="50">';
		} else {
$montevideo = "";

}
		
		
		$sql8 = 'select ft.plane_icao from fleettypes_routes fr, routes r, fleettypes ft where r.route_id=' . $route_id . ' and r.route_id=fr.route_id and fr.fleettype_id=ft.fleettype_id ';
							$planes_icaos = '';
							if (!$result8 = $db->query($sql8)) {
								die('There was an error running the query [' . $db->error . ']');
							}
							while ($row8 = $result8->fetch_assoc()) {
								
								$vares = '<i class="fa fa-plane"></i>'; 
								$planes_icaos = $planes_icaos . $vares . $row8["plane_icao"] . '<br>';
							}
		
	}
	
	



// Get Location info details

	$sql4 = "SELECT * FROM airports  where ident='$departure'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row4 = $result4->fetch_assoc()) {

        $departure_airport = $row4['name'];
		$dep_iso_country = $row4['iso_country'];
		$latitude1 = $row4['latitude_deg'];

		$longitude1 = $row4['longitude_deg'];
		

	}
	
	
	// Get Location info details

	$sql5 = "SELECT * FROM airports  where ident='$arrival'";

	if (!$result5 = $db->query($sql5)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row5 = $result5->fetch_assoc()) {

        $arrival_airport = $row5['name'];
        $arr_iso_country = $row5['iso_country'];
		$latitude2 = $row5['latitude_deg'];

		$longitude2 = $row5['longitude_deg'];

		

	}
	
	
	
	
	
	
	
	
  $theta = $longitude1 - $longitude2;
  $Mi = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
  $Mi = acos($Mi);
  $Mi = rad2deg($Mi);
  $Mi = $Mi * 60 * 1.1515;
  $feet = $Mi * 5280;
  $yards = $feet / 3;
  $Km = $Mi * 1.609344;
  $meters = $Km * 1000;

?>

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo ROUTE_INFO_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo DETAIL_ROUTE_INFO_TITLE;?></font></h3>

</section>
		
		
	
	

		<section class="contact">
			<div class="container">


  
	
	


<div class="row">
<div class="col-md-3">

			
			
 			<div class="panel-body">
				<table class="table table-hover">
                
                <tr>
                <td><?php echo $montevideo; ?><br /><?php echo $flighttype; ?></td>
                
                </tr>
                
					
					<tr><td><font size="1"><?php echo DEPARTURE;?></font><br><i class="fa fa-sign-out"></i>&nbsp;<?php echo $departure; ?> (<?php echo $etd; ?> <i class="fa fa-clock-o"></i>) <img src="./images/flags/24/<?php echo $dep_iso_country; ?>.png" alt="<?php echo $dep_iso_country; ?>"> <br /><font size="1"><?php echo $departure_airport; ?></font></td>
					</tr>
                    
					<tr><td><font size="1"><?php echo ARRIVAL;?></font><br><i class="fa fa-sign-in"></i>&nbsp;<?php echo $arrival; ?> (<?php echo $eta; ?> <i class="fa fa-clock-o"></i>) <img src="./images/flags/24/<?php echo $arr_iso_country; ?>.png" alt="<?php echo $arr_iso_country; ?>"><br /><font size="1"><?php echo $arrival_airport; ?></font></td>
					</tr>
                    
                    
                    
                    
					<tr><td><font size="1"><?php echo TIME_CST;?></font><br>
					<?php
                        
						
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';
echo $total;
						
						
						
						?></td>
					</tr>
					
                    
                    
					
					
					<tr><td><font size="1"><?php echo DISTANCE_STATS;?></font><br>
                        
                        Mi: <?php echo round($Mi); ?> <br>
						Km: <?php echo round($Km); ?>
                        
                        </td>
					</tr>
					
					<tr><td><font size="1"><?php echo PLANE_USED;?></font><br><?php echo $planes_icaos; ?></td>
					</tr>

  


					
					
					
                    <tr  class="active"><td><STRONG><?php echo BOOK_ROUTE_ROUTE; ?></STRONG></td></tr>
					<tr><td><?php echo $flproute; ?></td>
					</tr>
					
				</table>
			</div>
		
        </div>
 <?php 
    //   }
	
?>





<div class="col-md-9">
		
			
				<h1><?php echo FLIGHT_MAP; ?></h1>
			
			<div class="panel-body">
            
				<table class="table table-hover">
					<tr>
						<td ><iframe src="maproute.php?route_id=<?php echo $route_id; ?>" width="100%" height="600px"></iframe></td>
					</tr>
				</table>
			</div>
		
		<div class="clearfix visible-lg"></div>
	</div>
</div>

</div>

</section>
