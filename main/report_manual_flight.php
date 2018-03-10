
<?php


require('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$pilot = $id;
	$departure = strtoupper($_POST['departure']);
	$arrival = strtoupper($_POST['arrival']);
	$alternative = strtoupper($_POST['alternative']);
	
	$plane_icao = $_POST['plane_icao'];
	$category_acft = $_POST['category_acft'];
	$sq = $_POST['sq'];
	$cruising_speed = $_POST['cruising_speed'];
	$route = strtoupper($_POST['route']);
	$rmk = strtoupper($_POST['rmk']);
	$requestlevel = $_POST['requestlevel'];
	$departure_time = $_POST['departure_time'];
	$time_arrival = $_POST['time_arrival'];
	//$pax = $_POST['pax'];
	//$cargo = $_POST['cargo'];
	//$connection_time = $_POST['hours'] + (0.0166667*$_POST['minutes']);
	$altern_landing = $_POST['altern_landing'];
	$charter = $_POST['charter'];
	$vid_usuario = $_POST['vid'];
	
	
	
	//$callsign = $_POST['airlines'] . $_POST['vuelo'];
   
	
	
	
	/////////////////////////// Mirar el número de vuelo
	$icao_va = $_POST['airlines'];
	
	
	$sql_operator_global ="select * from operators where operator_id='$icao_va'";

	if (!$result_operator_global = $db->query($sql_operator_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator = $result_operator_global->fetch_assoc()) {
		$icao_full = $row_operator['callsign'];
	}
	
	$number_flight = strtoupper($_POST['vuelo']);
	$analisis_number_flight = substr($number_flight, 0, 3);
	
	
	$callsign = $icao_full . $_POST['vuelo'];
	
	 $code_info_money = $pilot . '-' . $callsign . '-' . date('YmdHis');
	
	date_default_timezone_set('America/Bogota');
	$numeroYear = date("Y"); 
	$numeroSemana = date("W"); 
	$horas = 0;
	$sql_vuelos_myself = "SELECT * from cstpireps where operator_id='$operator_id_session' and YEAR(fecha_envio)='$numeroYear'  and WEEK(fecha_envio, 1)='$numeroSemana' and gvauser_id='$id'";
    
	if (!$result_vuelos_myself = $db->query($sql_vuelos_myself)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_vuelos_myself = $result_vuelos_myself->fetch_assoc()) {
		$horas = $horas+$row_vuelos_myself['connection_time'];
	}
	
	date_default_timezone_set('UTC');
	///////////////////////// Parameters
	
	
	$sql_parat = "SELECT * from va_parameters where va_parameters_id=1";
    
	if (!$result_parat = $db->query($sql_parat)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_parat = $result_parat->fetch_assoc()) {
		$hours_min_per_week = $row_parat['hours_min_per_week'];
		
	}
	
	

	
	///////////////////////////// Info Airline Flight
	
	$sql_va_new = "select * from operators where operator_id=" . $icao_va;

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
	
	if($operator_id_session==$icao_va) {
		
		$permisovuelo = 0;
		
	} else {
	
	    if($horas>=$hours_min_per_week || $icao_va_full==$icao_va_full_altern) {
			
			$permisovuelo = 0;
			
		} else {
			
			$permisovuelo = 1;
			
		}
	
	
	
	}
	
	
	if($permisovuelo==0) {
		
		
		
	
	if($icao_full==$analisis_number_flight) {
		
			?>
	
	<script>
alert('<?php echo NUMBER_FLIGHT_MISTAKE; ?>');
window.location = './index_user.php?page=manual_pirep';
</script>
	
	
	<?php
	} else {
	
	
	
	// Set number of PAX & cargo and get plane details
		$sql70 = "select * from fleettypes where fleettype_id='$plane_icao'";
		if (!$result70 = $db->query($sql70)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row70 = $result70->fetch_assoc()) {
			$pax =  intval ($row70['pax'] * (rand (85,100) / 100));
			$cargo =  intval ($row70['cargo_capacity'] * (rand (85,100) / 100));
			$plane = $row70['plane_icao'];
		}
		
		$planecount= 0;
		// Set number of PAX & cargo and get plane details
		$sql71 = "select * from fleettypes_ranks where fleettype_id='$plane_icao' and operator_id='$icao_va'";
		if (!$result71 = $db->query($sql71)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row71 = $result71->fetch_assoc()) {
			$planecount++;
		}
		
		if($planecount==0)
	{
		?>
	
	<script>
alert('No puedes reportar el vuelo, ya que la aeronave escogida, no pertenece a dicha compañía | You can´t report the flight, because the chosen plane is not part of that airline.');
window.location = './index_user.php?page=charter';
</script>
	
	
	<?php
		
	} else {		
		
$assigned_pax=$pax;
$assigned_cargo=$cargo;
	
	
	///////////////////////// Información Aeropuertos //////////////////////
	
	$sql3991a ="select * from airports where ident='$departure'";

	if (!$result3991a = $db->query($sql3991a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3991a = $result3991a->fetch_assoc()) {
		
		$iso_countryaa= $row3991a["iso_country"];
		$callsignesaa= $row3991a["name"];
		$ciudad= $row3991a["municipality"];

		$latitude_deg_loc = $row3991a['latitude_deg'];

		$longitude_deg_loc = $row3991a['longitude_deg'];
		
		
	}
	
   
	
  
   $sql3991aa ="select * from airports where ident='$arrival'";

	if (!$result3991aa = $db->query($sql3991aa)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3991aa = $result3991aa->fetch_assoc()) {
		
		$iso_countryaaa= $row3991aa["iso_country"];
		$callsignesaaa= $row3991aa["name"];
		$ciudada= $row3991aa["municipality"];
			$latitude_deg_arr = $row3991aa['latitude_deg'];

		$longitude_deg_arr = $row3991aa['longitude_deg'];
		
		$latitude_deg_arr1 = $posicionuna;

		$longitude_deg_arr1 = $posiciondos;
				
	}
	
	/////////////////////////////////// Fin Información

// DISTANCIA TOTAL


    $kmsss = 111.302;
    $nmss = 0.539957;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorads = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodegs = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlongs = ($longitude_deg_loc - $longitude_deg_arr); 
    $dvalues = (sin($latitude_deg_loc * $degtorads) * sin(
    $latitude_deg_arr * $degtorads)) + (cos($latitude_deg_loc * $degtorads) * cos(
    $latitude_deg_arr * $degtorads) * cos($dlongs * $degtorads)); 
    $dds = acos($dvalues) * $radtodegs; 
    $kmss = round(($dds * $kmsss), 2);

      $distnms = round($kmss*$nmss);
	  
	  
	  /////////////////////// Calculo Ingresos Vuelos ////////////////
$millas_standar = 306;
$precio_standar = 170000;
$millas_standar_cargo = 306;
$precio_standar_cargo = 70000;
$cargo_price = ($distnms*$precio_standar)/$millas_standar;
$pax_price = ($distnms*$precio_standar_cargo)/$millas_standar_cargo;


       ////////////////////////////// Duración Vuelos
	   
	   $dist = $distnms;
			$speed = 380;
			$app = $speed / 60 ;
			$flttime = round($dist / $app,0)+ 20;
			$connection_time = ($flttime / 60);
	
	$sql20 = "insert into cstpireps (operator_id, code_info_money,distance,altern_landing,callsign,vid,gvauser_id,aircraft,cruising_speed,departure,arrival,alternative,sq,route,rmk,departure_time,eet,connection_time,time_arrival,category_acft,requestlevel,fecha_envio,charter,registry,pax,cargo,route_id) 
	values ($icao_va, '$code_info_money','$distnms','$altern_landing','$callsign','$vid_usuario','$pilot','$plane','$cruising_speed','$departure','$arrival','$alternative','$sq','$route','$rmk','$departure_time',0,'$connection_time','$time_arrival','$category_acft','$requestlevel',now(),'$charter','N/A','$pax','$cargo','0')";


		if (!$result20 = $db->query($sql20)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		// get the salary per hour for the pilot's rank

		$sql21 = "select * from ranks r , gvausers g where g.gvauser_id=$pilot and g.rank_id=r.rank_id ";

		if (!$result21 = $db->query($sql21)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($row21 = $result21->fetch_assoc()) {

			$salary_hour = $row21["salary_hour"];

		}
	
	

	
	
	
	    //PAGO SALARIO
        $rebaja = ((($connection_time * $salary_hour)*$charter_reduction)/100);
		$quantity = ($connection_time * $salary_hour)-$rebaja ;
        $quantity_neg = (-1)*($connection_time * $salary_hour)+$rebaja ;
		$sql22 = "insert into bank (gvauser_id,date,pirep,quantity,jump) values ($pilot,now(),'$code_info_money',$quantity,'Vuelo Pirep Manual: $departure - $arrival')";


		if (!$result22 = $db->query($sql22)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		// insert pilot salary in Va finance module
		$sqla = "insert into va_finances (operator_id, amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values ($icao_va,  $quantity_neg, '99995',now(),$pilot ,'Vuelo Pirep Manual:$departure - $arrival','PIREP MANUAL', '$code_info_money')";
		if (!$resulta = $db->query($sqla)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
		
		
			$sql1123 = "UPDATE gvausers set location='$arrival', route_id='0' where gvauser_id='$pilot'";

		if (!$result1123 = $db->query($sql1123)) {
			die('There was an error running the query [' . $db->error . ']');
		}

	
	
		
				$origen = $departure;
		
	
		
		
		$gananciasvuelo = round($pax_price*$assigned_pax)+($cargo_price*$assigned_cargo);
		
		

		
		
		
		
		
		

	// IVAO flights
	
			$gvauser_id =  $pilot;
			$flight_id =  $callsign2;
			$flight_duration = $connection_time;
			$pax =  $assigned_pax;
			$cargo =  $assigned_cargo;
			$distance =  $distnms;
			$reporttype = 'PIREP MANUAL';
			$route_id =  0;
			
	
			
		
	$sql_cost = 'select * from financial_parameters where parameter_active=1 and is_cost=1';

		if (!$result_cost = $db->query($sql_cost)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row_cost = $result_cost->fetch_assoc()) {
				$amount=0;
				// Cost by time
				if ($row_cost['linked_to_time']==1){			
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Flight duration: '.$flight_duration;
					$amount = -1 * $row_cost['amount'] * $flight_duration;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";

						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
					

				// Cost by distance
				if ($row_cost['linked_to_distance']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Distance: '.$distance;
					$amount = -1 * $row_cost['amount'] * $distance;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// Cost by pax
				if ($row_cost['linked_to_pax']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Number of PAX: '.$pax;
					$amount = -1 * $row_cost['amount'] * $pax;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

			

				// Cost by flight
				if ($row_cost['linked_to_flight']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'];
					$amount = -1 * $row_cost['amount'] ;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 
		// End cost

		// Begin income section for regular flights
		
		
				// Income by PAX				
				
				$amount = $pax_price * $pax;
				$descrip= 'Number of PAX:' .$pax.' .Price per PAX:'.$pax_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, 99999,now(),$amount,$gvauser_id,'$descrip','$reporttype','$code_info_money')";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
				}

				$amount = $cargo_price * $cargo;
				$descrip= 'Cargo:' .$cargo.' .Price per Cargo Unit:'.$cargo_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, 99998,now(),$amount,$gvauser_id,'$descrip','$reporttype','$code_info_money')";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
				}
		
		
		// End income for regular flights
		// Begin income section for any flight
		$sql_cost = 'select * from financial_parameters where parameter_active=1 and is_profit=1';

		if (!$result_cost = $db->query($sql_cost)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row_cost = $result_cost->fetch_assoc()) {
				$amount=0;
				// income by time
				if ($row_cost['linked_to_time']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Flight duration: '.$flight_duration;
					$amount =  $row_cost['amount'] * $flight_duration;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";

						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
					

				// income by distance
				if ($row_cost['linked_to_distance']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].').Distance: '.$distance;
					$amount =  $row_cost['amount'] * $distance;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

				// income by pax
				if ($row_cost['linked_to_pax']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'].'('.$row_cost['amount'].'). Number of PAX: '.$pax;
					$amount =  $row_cost['amount'] * $pax;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}

			

				// income by flight
				if ($row_cost['linked_to_flight']==1){
					$para_id = $row_cost['id'];
					$para_desc = $row_cost['financial_parameter'];
					$amount =  $row_cost['amount'] ;
					if ($amount!=0)
					{
						$sql = "insert into va_finances (operator_id, parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id) values ($icao_va, $para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 		


		// End income for any flight

	
	$query2 = "UPDATE gvausers set activation=1 where gvauser_id='$pilot'";
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			
			}
	
		?>
	
<script>
alert('Su pirep ha sido registrado.');
window.location = './index_user.php?page=intranet';

</script>

	
	<?php } 
	
	}
	           } else {
		
				?>
	
	<script>
alert('Debes realizar mínimo <?php echo $hours_min_per_week; ?> horas por semana, ya que realizaste <?php echo $horas; ?> horas en la semana actual (<?php echo $numeroSemana; ?>) con su aerolínea preferida <?php echo $name_operator_va; ?>, antes de volar con otra aerolínea. | You must make minimun <?php echo $hours_min_per_week; ?> hours per week, because you made  <?php echo $horas; ?> hours in this week (<?php echo $numeroSemana; ?>) with the airlines that you chose, <?php echo $name_operator_va; ?>, before flying with another airline.');
window.location = './index_user.php?page=manual_pirep';
</script>
	
	
	<?php
		
	}
	
	?>

		
			