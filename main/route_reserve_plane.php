
<?php
	require('./check_login.php');
	$id=$_SESSION["id"];
	if ($id !='')
	{
		$route = $_GET['route'];
		$plane = $_GET['plane'];
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "UPDATE gvausers set route_id=$route where gvauser_id=$id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$sql = "UPDATE fleets set booked=1, gvauser_id= $id, booked_at=now() where fleet_id=$plane";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		// Get route detials

		$sql = "select * from routes where route_id=$route";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$flight =  $row['flight'];
			$departure = $row['departure'] ;
			$arrival = $row['arrival'] ;
			$alternative = $row['alternative'] ;
			$flproute = $row['flproute'] ;
			$duration = $row['duration'] ;
			$flight_level = $row['flight_level'] ;
			$flighttype_id = $row['flighttype_id'] ;
			$operator_id = $row['operator_id'] ;
		}
		
		
	$sql_operator = "SELECT * FROM operators where operator_id='$operator_id'";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
		                      $operator_icao = $row_operator["callsign"];
							}     	
		
		
		
		
$sql3 = "SELECT * FROM airports  where ident='$departure'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

	}



$sql4 = "SELECT * FROM airports  where ident='$arrival'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row4 = $result4->fetch_assoc()) {

		$latitude_deg_arr = $row4['latitude_deg'];

		$longitude_deg_arr = $row4['longitude_deg'];

	}


    $km = 111.302;
$nms = 0.539957;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorad = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodeg = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlong = ($longitude_deg_loc - $longitude_deg_arr); 
    $dvalue = (sin($latitude_deg_loc * $degtorad) * sin(
$latitude_deg_arr * $degtorad)) + (cos($latitude_deg_loc * $degtorad) * cos(
$latitude_deg_arr * $degtorad) * cos($dlong * $degtorad)); 
    $dd = acos($dvalue) * $radtodeg; 
    $kms = round(($dd * $km), 2);

                        //$flttime = $row1["duration"];

                        $dist = $kms;
			$speed = 440;
			$app = $speed / 60 ;
			

			
			
     $distnm = round($kms*$nms);

$flttime = round($distnm / $app,0)+ 20;
		
	
			$paxpercentege = rand (85,100);
			$cargopercentege = rand (85,100);
			
			
		
		
		// Set number of PAX & cargo and get plane details
		$sql = "select * from fleets f inner join fleettypes ft on f.fleettype_id = ft.fleettype_id and f.fleet_id=$plane";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $result->fetch_assoc()) {
			$pax =  intval ($row['pax'] * ($paxpercentege / 100));
			$cargo =  intval ($row['cargo_capacity'] * ($cargopercentege / 100));
			$registry = $row['registry'];
			$ejecutive_class = $row['ejecutive_class'];
			$name = $row['name'];
			$plane_icao = $row['plane_icao'];
			$status = $row['status'];
		}
		
		
		





		$sql = "delete from reserves where gvauser_id=$id";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		$reservados=0;
		$sqlrese = "select * from reserves where route_id=$route";
		if (!$resultrese = $db->query($sqlrese)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($rowrese = $resultrese->fetch_assoc()) {
			$reservados++;
		}
		
	
		if($reservados>0) {
		$largocadena = strlen($flight); 
		$numerovuelo = preg_replace('/[^0-9]+/', '', $flight); 
		$callsignfinalvuelo = $numerovuelo+$reservados;
		
		$letrafinal = substr($flight,$largocadena-2,$largocadena-1);
		
		if($letrafinal=="G") {
			$callsigntotal = $operator_icao . $callsignfinalvuelo . $letrafinal;
		} else 	if($letrafinal=="F") {
			$callsigntotal = $operator_icao . $callsignfinalvuelo . $letrafinal;
		} else {
			$callsigntotal = $operator_icao . $callsignfinalvuelo;
		}
		
		
		$callsignfinal = $callsigntotal;
		} else {
		$callsignfinal=	$flight;
		}
		
		
		
		
		// Calculating number of adult, children and infants
		$percent = $pax / 100;
		$adultPer = rand(50, 70);
		$adult = round($percent * $adultPer);
		$allChildrerPer = ($pax - $adult) / 100;
		$childrenPer = rand(50, 70);
		$children = round($allChildrerPer * $childrenPer);
		$infants = $pax - ($adult + $children);
		
		// Calculating number of business and economy classes
		$business = rand(0, $ejecutive_class);
		$economy = $pax - $business;
		
		
		

		$sql = "INSERT into reserves (route_id,callsign_alterno,gvauser_id,fleet_id,pax,cargo,adult,children,infants,ejecutive_class,tourist_class) values ($route,'$callsignfinal',$id,$plane,$pax,$cargo,$adult,$children,$infants,$business,$economy)";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		// HORARIO CANCELACION
	
	
	
		$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$hours_auto_cancellation = 0;
	
	while ($row = $result->fetch_assoc()) {
		$hours_auto_cancellation = $row["hours_auto_cancellation"];
	}
	
	
	
	
	
	
	
	
	
	// FIN
	
	
	}

	
	
	
	?>
	
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo PROCESS_SCHEDULE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_PROCESS_SCHEDULE; ?></font></h3>

</section>
	


		<section class="contact">
			<div class="container">
<h1><?php echo FINAL_DETAILS; ?></h1>
<hr>
                           <div class="alert bg--success">
                                <div class="alert__body">
                                    <span><?php echo CONFIRMATION_SCHEDULE_ONE . ' ' . $hours_auto_cancellation . ' ' .CONFIRMATION_SCHEDULE_TWO; ?></span>
                                </div>
                            </div>
<hr>						

 <div class="row">
                        <div class="col-sm-6">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <a class="btn btn--primary btn--icon" href="./index_user.php?page=volar">
	<span class="btn__text" style="width:100%"><i class="icon-Plane"></i><?php echo WATCH_SCHEDULE; ?></span>
</a>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-6">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                               <a class="btn btn--icon bg--pinterest" href="./index_user.php?page=cancel_reserve&plane=<?php echo $plane; ?>&route=<?php echo $route; ?>">
	<span class="btn__text" style="width:100%"><i class="icon-Danger"></i><?php echo CANCEL_FLIGHT; ?></span>
</a>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
					

<br>


			

</div>
</section>
</section>