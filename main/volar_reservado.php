
<?php
	require('./check_login.php');
	$route = $_GET['route'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT DISTINCT r.route_id,r.flight flight, f.fleet_id, f.operator_id, registry as reg,
	status , plane_description, r.departure, r.arrival, r.operator_id, duration, etd,eta,pax_price,flproute,comments, alternative
	FROM gvausers gu, fleets f, fleettypes ft, routes r, fleettypes_gvausers ftgu, fleettypes_routes ftro
	WHERE gu.gvauser_id = ftgu.gvauser_id
	AND ftgu.fleettype_id = f.fleettype_id
	AND ft.fleettype_id = f.fleettype_id
	AND ft.fleettype_id = ftgu.fleettype_id
	AND ftro.fleettype_id = f.fleettype_id
	AND ft.fleettype_id = ftro.fleettype_id
	AND ftro.route_id = r.route_id
	AND r.departure = gu.location
	AND gu.gvauser_id =$id 
	AND f.location = gu.location
	AND f.operator_id = r.operator_id
	AND	f.booked = 0	
	AND r.route_id=$route order by plane_description, registry asc";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	date_default_timezone_set('America/Bogota');
	$numeroYear = date("Y"); 
	$numeroSemana = date("W"); 
	$horas = 0;
	$sql_vuelos_myself = "SELECT * from cstpireps where operator_id='$operator_id_session' and YEAR(fecha_envio)='$numeroYear' and WEEK(fecha_envio, 1)='$numeroSemana' and gvauser_id='$id'";
    
	if (!$result_vuelos_myself = $db->query($sql_vuelos_myself)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_vuelos_myself = $result_vuelos_myself->fetch_assoc()) {
		$horas = $horas+$row_vuelos_myself['connection_time'];
	}
	
	///////////////////////// Parameters
	
	
	$sql_parat = "SELECT * from va_parameters where va_parameters_id=1";
    
	if (!$result_parat = $db->query($sql_parat)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_parat = $result_parat->fetch_assoc()) {
		$hours_min_per_week = $row_parat['hours_min_per_week'];
		
	}
	
	
	///////////////////////// Route INFO_PLANE_AIRPORT
	
	$sql_route_flight = "SELECT * from routes where route_id='$route'";
    
	if (!$result_route_flight = $db->query($sql_route_flight)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_route_flight = $result_route_flight->fetch_assoc()) {
		$operator_id_route_flight = $row_route_flight['operator_id'];
		
	}
	
	
	///////////////////////////// Info Airline Flight
	
	$sql_va_new = "select * from operators where operator_id=" . $operator_id_route_flight;

	if (!$result_va_new = $db->query($sql_va_new)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios_va_new = $result_va_new->fetch_assoc()) {
		$icao_va_full_altern = $rowusuarios_va_new["callsign"];
	}
	
	
	///////////////////////////// Operator Flight
	
	
	
	
	///////////////////// CONDICIONES FINALES //////////////////
	$permisovuelo = 0;
	/// 0 SI
	/// 1 NO
	
	if($operator_id_session==$operator_id_route_flight) {
		
		$permisovuelo = 0;
		
	} else {
	
	    if($horas>=$hours_min_per_week || $icao_va_full==$icao_va_full_altern) {
			
			$permisovuelo = 0;
			
		} else {
			
			$permisovuelo = 1;
			
		}
	
	
	
	}
	
	
	
	if($permisovuelo==0) {
	?>
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo CHOOSE_PLANE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_CHOOSE_PLANE; ?></font></h3>

</section>



		<section class="contact">
			<div class="container">
            <h1><?php echo INFO_PLANE_AIRPORT; ?> <?php echo '( ' . $location . ' ) ' . $location_airport_name; ?> </h1>
			<!-- Default panel contents -->
			<hr>
			<br>
			
			<!-- Table -->
				<table id="table_list"  class="table table-hover text-center">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo BOOK_ROUTE_FLIGHT; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_DEPARTURE; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ARRIVAL; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ARICRAFT_TYPE; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ARICRAFT_REG; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ARICRAFT_STATUS; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ARICRAFT_BOOK; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
				<?php

		
					while ($row = $result->fetch_assoc()) {
						
						$etd = $row["flight"];
						$eta = $row["eta"];
						$duration = $row["duration"];
						$etd = $row["etd"];
						$eta = $row["eta"];
						$departure = strtoupper($row["departure"]);
						$arrival = strtoupper($row["arrival"]);
						$price = $row["pax_price"];
						$flproute= $row["flproute"];
						$flight_level= $row["flight_level"];						
						$comments = $row["comments"];
						$alternative = strtoupper($row["alternative"]);
						$ioio = $row["flight"];
						
						echo "<tr><td>";
						echo $row["flight"] . '</td><td>';
						echo $row["departure"] . '</td><td>';
						echo $row["arrival"] . '</td><td>';
						echo $row["plane_description"] . '</td><td>';
						echo $row["reg"] . '</td><td>';

						
						?>
                          <?php echo $row["status"]; ?>%
							
						<?php
							echo '</td><td>
							<a href="./index_user.php?page=route_reserve_plane&plane=' . $row["fleet_id"] . '&route=' . $row["route_id"] . '"><i class="icon color--primary icon-Plane"></i></a>
							</td></tr>';
						}
							echo "</tbody></table>";
							$db->close();
						?>
		
		
		
	<div class="clearfix visible-lg"></div>

</div>
</section>
	<?php } else {
		
				?>
	
	<script>
alert('Debes realizar mínimo <?php echo $hours_min_per_week; ?> horas por semana, ya que realizaste <?php echo $horas; ?> horas en la semana actual (<?php echo $numeroSemana; ?>) con su aerolínea preferida <?php echo $name_operator_va; ?>, antes de volar con otra aerolínea. | You must make minimun <?php echo $hours_min_per_week; ?> hours per week, because you made  <?php echo $horas; ?> hours in this week (<?php echo $numeroSemana; ?>) with the airlines that you chose, <?php echo $name_operator_va; ?>, before flying with another airline.');
window.location = './index_user.php?page=intranet';
</script>
	
	
	<?php
		
	}
	
	?>


