
<?php




require('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$pilot = $id;
	$vid_usuario = $_POST['vid'];
	$icao = $_POST['plane'];
	
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
	
	
	$callsign_vuelo = $icao_full . $_POST['vuelo'];
	
	
	date_default_timezone_set('America/Bogota');
	
	$numeroYear = date("Y"); 
	$numeroSemana = date("W"); 
	$horas = 0;
	$sql_vuelos_myself = "SELECT * from cstpireps where operator_id='$operator_id_session'  and YEAR(fecha_envio)='$numeroYear' and WEEK(fecha_envio, 1)='$numeroSemana' and gvauser_id='$id'";
    
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
window.location = './index_user.php?page=tour_ivao';
</script>
	
	
	<?php
	} else {
	

$registry = "TOUR";
$airplane = $icao;	

$lugarsalida = $_POST['departure'];
$lugarllegada = $_POST['arrival'];

// DAR PASAJEROS Y CARGA


// Set number of PAX & cargo and get plane details
		$sql70 = "select * from fleets f inner join fleettypes ft on f.fleettype_id = ft.fleettype_id where ft.plane_icao='$airplane'";
		if (!$result70 = $db->query($sql70)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row70 = $result70->fetch_assoc()) {
			$pax =  intval ($row70['pax'] * (rand (85,100) / 100));
			$cargo =  intval ($row70['cargo_capacity'] * (rand (85,100) / 100));
			$operator_id_plane = $row70['operator_id'];
		}
		
	if($icao_va<>$operator_id_plane)
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



$code_info_money = $pilot . '-' . $callsign_vuelo . '-' . date('YmdHis');
// FIN

	
$contarvuelos=0;
	
	$filecontents = file_get_contents_curl('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = explode("\n", $filecontents);
foreach ($rows as $rowr) {

	$fields = explode(":", $rowr);
	$callsign = $fields[0];
	$vid = $fields[1];
	$aeronave = substr($fields[9], 2, 4);	
$departure = $fields[11];	
$arrival = $fields[13];	

if (($callsign_vuelo==$callsign) && ($vid_usuario==$vid) && ($airplane==$aeronave) && ($lugarsalida==$departure) && ($lugarllegada==$arrival)) {
$callsign2 = $fields[0];
	$vid2 = $fields[1];
$nombres = $fields[2];
$posicionuna = $fields[5];				  
$posiciondos = $fields[6];	
$altitud = $fields[7];
$groundspeed = $fields[8];	
$aeronave = substr($fields[9], 2, 4);		
$tipes = substr($fields[9], 7, 1);	
$cruisingspeed = $fields[10];
$departure = $fields[11];	
$requestlevel = $fields[12];	
$arrival = $fields[13];	
$trasponder = $fields[17];	
$ranks = $fields[41];	
$rmk = $fields[29];	
$ruta = $fields[30];	
$rumbo = $fields[45];					
$fechados = $fields[37];	
$estado = $fields[46];	
$salida=$fields[11];
$llegada=$fields[13]; 
$fobhr = $fields[26];
$fobmin = $fields[27];	
$eta = $fields[30];	
$etod = $fields[22];	
$etoda = $fields[23];	


$etehr = $fields[24];
$etemin = $fields[25];	

			
}		
			
}

// OTRAS COSAS


if ($fobhr <10) {
	$hrfob = '0' . $fields[26];
} else {
	$hrfob = $fields[26];
}


if ($fobmin <10) {
	$minfob = '0' . $fields[27];
} else {
	$minfob = $fields[27];
}


$fob = $hrfob . ':' . $minfob;	




if ($etehr <10) {
	$hrete = '0' . $fields[24];
} else {
	$hrete = $fields[24];
}


if ($etemin <10) {
	$minete = '0' . $fields[25];
} else {
	$minete = $fields[25];
}






$ete = $hrete . ':' . $minete;	




	 
	 
// CALCULOS DISTANCIAS Y PORCENTAJES









if (($callsign_vuelo==$callsign2) && ($vid_usuario==$vid2)) {
	
$contarvuelos++;
		
			
	 $iso_countryaa = "";
  $callsignesaa = "";
  
  $iso_countryaaa="";
  $callsignesaaa = "";
  
  if($salida<>"" && $llegada<>""){
	  
  $sql3991a ="select * from airports where ident='$salida'";

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
	
   
	
  
   $sql3991aa ="select * from airports where ident='$llegada'";

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
	
	
	
	
	}

	// DISTANCIA RESTANTE
	
	
	  $km = 111.302;
$nms = 0.539957;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorad = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodeg = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlong = ($longitude_deg_loc - $longitude_deg_arr1); 
    $dvalue = (sin($latitude_deg_loc * $degtorad) * sin(
$latitude_deg_arr1 * $degtorad)) + (cos($latitude_deg_loc * $degtorad) * cos(
$latitude_deg_arr1 * $degtorad) * cos($dlong * $degtorad)); 
    $dd = acos($dvalue) * $radtodeg; 
    $kms = round(($dd * $km), 2);

                  
				 

                        $dist = $kms;
						 $distnm = round($kms*$nms);
		
			
			
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
	$totaldistance = $distnms - $distnm;
			
			
$status = '';
$percent = '';
						$percent = round(($distnm/$distnms)*100);		
			
			
			
	 
	 	
 
$quitarespacio=str_replace("/","",$aeronave);
$acft = $quitarespacio;


	



 $flttime = ($distnm / 390);
														$sumas= ($flttime);
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.':'.$minutos;



 $timestamp=date('H:i', time());
 
 
										
											
											$Horas = strtotime($timestamp)+strtotime($total); 

$arrivaltime = date('Hi',$Horas); 

/////////////////////// Calculo Ingresos Vuelos ////////////////
$millas_standar = 306;
$precio_standar = 170000;
$millas_standar_cargo = 306;
$precio_standar_cargo = 70000;
$cargo_price = ($distnms*$precio_standar)/$millas_standar;
$pax_price = ($distnms*$precio_standar_cargo)/$millas_standar_cargo;




////////////////////////// Fin

	   // DURACION VUELO
	  

//$fechaprimaria = date("Hi");  
//$fechasecundaria = substr($fechados, 8, 2)  . substr($fechados, 10, 2);





//$fecha = strtotime($fechaprimaria)-strtotime($fechasecundaria); 
//$horas = substr($fecha,0,2);
//$minutes = substr($fecha,2,2)*0.02;

//$duration = $horas+$minutes;




$fechaprimaria = date("Y-m-d H:i:s");  
$fechasecundaria = substr($fechados, 0, 4) . '-' . substr($fechados, 4, 2) . '-' . substr($fechados, 6, 2) . ' ' . substr($fechados, 8, 2) . ':' . substr($fechados, 10, 2) . ':' . substr($fechados, 12, 2);



$fechass = $fechasecundaria;
$fechassa = $fechaprimaria;

$fecha1 = new DateTime($fechass);
$fecha2 = new DateTime($fechassa);
$fechas = $fecha1->diff($fecha2);


$horas = $fechas->h;
$minutes = ($fechas->i)*0.02;

$durationivao = $horas+$minutes;


// DURACION ESTIMADA 


            $dist = $distnms;
			$speed = 380;
			$app = $speed / 60 ;
			$flttime = round($dist / $app,0)+ 20;
			$hours = ($flttime / 60);
			$moretime = $hours+($hours*0.60);

			
			
		    // if($durationivao<$hours) {
				//$duration = $hours;
			//} else {
				//$duration = $durationivao;
			//}
			
		$duration = $durationivao;	
$hoy = getdate();


	 
if($percent>=94 && $estado==1) {
	
	

	
	
	
	
	
	
	
	// get VA parameters
		$sqlva = "select * from va_parameters";
		$flight_wear = '';
		$plane_status_hangar = '';
		$hangar_maintenance_days = '';
		$hangar_maintenance_value = '';
		$charter_reduction = '';
		if (!$resultva = $db->query($sqlva)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $resultva->fetch_assoc()) {
			$flight_wear = $row["flight_wear"];
			$charter_reduction = $row["charter_reduction"];
			$plane_status_hangar = $row["plane_status_hangar"];
			$hangar_maintenance_days = $row["hangar_maintenance_days"];
			$hangar_maintenance_value = $row["hangar_maintenance_value"];
			
		}	
		
		
		
		
		
		


	
	$sql20 = "insert into cstpireps (operator_id,callsign,vid,gvauser_id,aircraft,cruising_speed,departure,arrival,sq,route,rmk,departure_time,eet,connection_time,distance,time_arrival,category_acft,requestlevel,fecha_envio,charter,registry,pax,cargo,route_id,code_info_money) 
	values ('$icao_va','$callsign2','$vid2','$pilot','$airplane','$cruisingspeed','$salida','$llegada','$trasponder','$ruta','$rmk','$etod','$ete','$duration','$distnms','$arrivaltime','$tipes','$requestlevel',now(),3,'$registry','$assigned_pax','$assigned_cargo','0','$code_info_money')";


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
        $rebaja = ((($duration * $salary_hour)*$charter_reduction)/100);
		$quantity = ($duration * $salary_hour)-$rebaja;
        $quantity_neg = (-1)*($duration * $salary_hour)-$rebaja;
		$sql22 = "insert into bank (gvauser_id,date,pirep,quantity,jump) values ($pilot,now(),'$code_info_money',$quantity,'Vuelo Charter: $salida - $llegada')";


		if (!$result22 = $db->query($sql22)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		
		// insert pilot salary in Va finance module
		$sqla = "insert into va_finances (operator_id,amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values ($icao_va, $quantity_neg, '99995',now(),$pilot ,'Vuelo Charter:$salida - $llegada','IVAO', '$code_info_money')";
		if (!$resulta = $db->query($sqla)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
		
		
			$sql1123 = "UPDATE gvausers set location='$llegada', route_id='0' where gvauser_id='$pilot'";

		if (!$result1123 = $db->query($sql1123)) {
			die('There was an error running the query [' . $db->error . ']');
		}

	

		
				$origen = $departure;
		
	
		
		
	
		
		
		// RUTA
	
	
	

			$route_ids = "0";
           

		
		
		
		$gananciasvuelo = round($pax_price*$assigned_pax)+($cargo_price*$assigned_cargo);
		
		

		
		// insert ganancias vuelo
		//$sql23 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values ($gananciasvuelo, '99995',now(),$pilot ,'Vuelo Charter: $salida - $llegada','IVAO', '$callsign_vuelo')";

		//if (!$result23 = $db->query($sql23)) {
			//die('There was an error running the query [' . $db->error . ']');
		//}
		
		
		

		
		
			///////////////////////////////////////////////////////// FINANZAS PARA LA VA //////////////////////////////////////////////////////////
		
		

	// IVAO flights
			$gvauser_id =  $pilot;
			$flight_id =  $callsign2;
			$flight_duration = $duration;
			$pax =  $assigned_pax;
			$cargo =  $assigned_cargo;
			$distance =  $distnms;
			$reporttype = 'TOUR IVAO';
			$route_id =  '0';
			
			
		
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id,operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money',$icao_va)";

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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id,operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money',$icao_va)";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', $icao_va)";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', $icao_va)";
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
					$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values (99999,now(),$amount,$gvauser_id,'$descrip','$reporttype','$code_info_money', $icao_va)";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
				}

				$amount = $cargo_price * $cargo;
				$descrip= 'Cargo:' .$cargo.' .Price per Cargo Unit:'.$cargo_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values (99998,now(),$amount,$gvauser_id,'$descrip','$reporttype','$code_info_money', $icao_va)";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', $icao_va)";

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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', $icao_va)";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', $icao_va)";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', $icao_va)";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 		


		// End income for any flight


			
		

	
	
	
	   ///////////////////////////////////////////////////////// FIN FINANZAS PARA LA VA //////////////////////////////////////////////////////////
		
	
	
	$query2 = "UPDATE gvausers set activation=1 where gvauser_id='$pilot'";
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			
			}

	
		
		
	


	
	
	//FIN
	
		?>
	
	<script>
alert('<?php echo REPORT_ALERT; ?>');
window.location = './index_user.php?page=intranet';
</script>
	
	
	<?php

	
} else {
	?>
	
	<script>
alert('<?php echo ERROR_ONE; ?>');
window.location = './index_user.php?page=tour_ivao';
</script>
	
	
	<?php
}
	 
	 
	 
	 
	 
	 
	 
 
} 





if($contarvuelos==0) {
		if (($callsign_vuelo==$callsign) && ($vid_usuario==$vid)) {
		$errorunos = "";
	} else {
		$errorunos = ERROR_TWO;
	}
	
	if ($vid_usuario==$vid) {
		$errordos = "";
	} else {
		$errordos = ERROR_THREE;
	}
		
	if (($airplane==$aeronave)&& ($vid_usuario==$vid)) {
		$errortres = "";
	} else {
		$errortres = ERROR_FOUR;
	}	
	
	?>
	
	<script>
alert('<?php echo ERROR_FIVE . ' ' . $errorunos . ' | ' .  $errordos . ' | ' . $errortres; ?>');
window.location = './index_user.php?page=tour_ivao';
</script>
	
	
	<?php
	
	
}

	}

	}
		 } else {
		
				?>
	
	<script>
alert('Debes realizar mínimo <?php echo $hours_min_per_week; ?> horas por semana, ya que realizaste <?php echo $horas; ?> horas en la semana actual (<?php echo $numeroSemana; ?>) con su aerolínea preferida <?php echo $name_operator_va; ?>, antes de volar con otra aerolínea. | You must make minimun <?php echo $hours_min_per_week; ?> hours per week, because you made  <?php echo $horas; ?> hours in this week (<?php echo $numeroSemana; ?>) with the airlines that you chose, <?php echo $name_operator_va; ?>, before flying with another airline.');
window.location = './index_user.php?page=tour_ivao';
</script>
	
	
	<?php
		
	}
	
	?>

		
			
	

		
			
	
