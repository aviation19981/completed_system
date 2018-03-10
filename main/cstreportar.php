<?php
date_default_timezone_set('UTC');
require('./db_login.php');
	require('./check_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$pilot = $id;
	$vid_usuario = $_POST['vid'];
	$callsign_vuelo = $_POST['route'];
	$registry = $_POST['registry'];
	$route_id = $_POST['route_id'];
	$airplane_s = $_POST['airplane'];
	if($airplane_s=="B74F") {
	$airplane = "B744";	
	} else {
	$airplane = $_POST['airplane'];	
	}
    $contarvuelos=0;
	$code_info_money = $pilot . '-' . $callsign_vuelo . '-' . date('YmdHis');
	
	$filecontents = file_get_contents_curl('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = explode("\n", $filecontents);
foreach ($rows as $rowr) {

	$fields = explode(":", $rowr);
	$callsign = $fields[0];
	$vid = $fields[1];
	$aeronave = substr($fields[9], 2, 4);	

if (($callsign_vuelo==$callsign) && ($vid_usuario==$vid) && ($airplane==$aeronave)) {
$callsign2 = $fields[0];
$vid2 = $fields[1];
$nombres = $fields[2];
$posicionuna = $fields[5];				  
$posiciondos = $fields[6];	
$altitud = $fields[7];
$groundspeed = $fields[8];	
$aeronave = $airplane;		
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
$destino=$fields[13]; 
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
	
	
	// Get pax and cargo from regular flight
				$assigned_pax=0;
				$assigned_cargo=0;
				$fecha_inicio=0;
				$query = "select * from reserves where gvauser_id=$pilot";
				if (!$result_sta = $db->query($query)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				while ($row = $result_sta->fetch_assoc()) {
					$assigned_pax = $row["pax"];
					$assigned_cargo = $row["cargo"];
					$fecha_inicio = $row["fecha_inicio"];
					$route = $row["route_id"];
					$plane = $row["fleet_id"];
					$airport_altern = $row["airport_altern"];
					$alterno_landing = $row["alterno_landing"];
				}
	
  $contarvuelos++;		
  $iso_countryaa = "";
  $callsignesaa = "";
  
  $iso_countryaaa="";
  $callsignesaaa = "";
  
  
  //////////////////// Saber a donde se va a aterrizar /////////////////////////
  if($alterno_landing==0) {
	 $llegada= $destino; 
  } else {
	  $llegada= $airport_altern;
  }
  
 
  ////////////////////////////////////////////////////////////////////////
  
  
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



	   // DURACION VUELO
	  

//$fechaprimaria = date("Hi");  
//$fechasecundaria = substr($fechados, 8, 2)  . substr($fechados, 10, 2);





//$fecha = strtotime($fechaprimaria)-strtotime($fechasecundaria); 
//$horas = substr($fecha,0,2);
//$minutes = substr($fecha,2,2)*0.02;

//$duration = $horas+$minutes;

	


$fechaprimaria = date("Y-m-d H:i:s");  
$fechasecundaria = substr($fechados, 0, 4) . '-' . substr($fechados, 4, 2) . '-' . substr($fechados, 6, 2) . ' ' . substr($fechados, 8, 2) . ':' . substr($fechados, 10, 2) . ':' . substr($fechados, 12, 2);



//$fechass = $fecha_inicio;
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
			$divide = $hours*0.8;
		
			
			
$hoy = getdate();


	 
if($percent>=94 && $estado==1) {
	
	
		if($durationivao>=$divide) {
			//if($moretime>=$durationivao) {
			//	$duration = $durationivao;
			//} else {
			//	$duration = $hours;
			//}
	       $duration = $durationivao;
	
	
		// RUTA
	
	
	$sql21s = "select * from routes where flight='$callsign_vuelo'";

		if (!$result21s = $db->query($sql21s)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($row21s = $result21s->fetch_assoc()) {

			$route_ids = $row21s["route_id"];
            $cargo_price = $row21s["cargo_price"];
			$pax_price = $row21s["pax_price"];
			$operator_id_flight = $row21s["operator_id"];
		}
		
	
	
	
	// get VA parameters
		$sqlva = "select * from va_parameters";
		
		$flight_wear_damage = '';
		$plane_status_hangar = '';
		$hangar_maintenance_days = '';
		$hangar_maintenance_value = '';
		
		if (!$resultva = $db->query($sqlva)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row = $resultva->fetch_assoc()) {
			$flight_wear_damage = $row["flight_wear"];
			$plane_status_hangar = $row["plane_status_hangar"];
			$hangar_maintenance_days = $row["hangar_maintenance_days"];
			$hangar_maintenance_value = $row["hangar_maintenance_value"];
			$nm_for_damage = $row["hangar_maintenance_value"];
			
		}	
		
		
		///////////////////// Damages airplane
		
		$flight_wear = round((($distnms*$flight_wear_damage)/$nm_for_damage),1);
		
		////////////////////// End damages
		
		
		
		
	// AGREGAR VUELO A LA BBDD
	

  if($alterno_landing==0) {
	 //$llegada= $destino; 
	 $sql20 = "insert into cstpireps (operator_id,callsign,vid,gvauser_id,aircraft,cruising_speed,departure,arrival,sq,route,rmk,departure_time,eet,connection_time,distance,time_arrival,category_acft,requestlevel,fecha_envio,charter,registry,pax,cargo,route_id,altern_landing,alternative,code_info_money) 
	values ('$operator_id_flight','$callsign2','$vid2','$pilot','$airplane','$cruisingspeed','$departure','$arrival','$trasponder','$ruta','$rmk','$etod','$ete','$duration','$distnms','$arrivaltime','$tipes','$requestlevel',now(),0,'$registry','$assigned_pax','$assigned_cargo','$route_id',0,'$airport_altern','$code_info_money')";

  } else if($alterno_landing==1) {
	  //$llegada= $airport_altern;
	  $sql20 = "insert into cstpireps (operator_id,callsign,vid,gvauser_id,aircraft,cruising_speed,departure,arrival,sq,route,rmk,departure_time,eet,connection_time,distance,time_arrival,category_acft,requestlevel,fecha_envio,charter,registry,pax,cargo,route_id,altern_landing,alternative,code_info_money) 
	values ('$operator_id_flight','$callsign2','$vid2','$pilot','$airplane','$cruisingspeed','$departure','$arrival','$trasponder','$ruta','$rmk','$etod','$ete','$duration','$distnms','$arrivaltime','$tipes','$requestlevel',now(),0,'$registry','$assigned_pax','$assigned_cargo','$route_id',1,'$airport_altern','$code_info_money')";

  }
	
	//$sql20 = "insert into cstpireps (callsign,vid,gvauser_id,aircraft,cruising_speed,departure,arrival,sq,route,rmk,departure_time,eet,connection_time,distance,time_arrival,category_acft,requestlevel,fecha_envio,charter,registry,pax,cargo,route_id) 
	//values ('$callsign2','$vid2','$pilot','$airplane','$cruisingspeed','$departure','$arrival','$trasponder','$ruta','$rmk','$etod','$ete','$duration','$distnms','$arrivaltime','$tipes','$requestlevel',now(),0,'$registry','$assigned_pax','$assigned_cargo','$route_id')";


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
	
		$quantity = ($duration * $salary_hour);
        $quantity_neg = (-1)*($duration * $salary_hour);
		$sql22 = "insert into bank (gvauser_id,date,pirep,quantity,jump) values ($pilot,now(),'$code_info_money',$quantity,'Vuelo Regular: $departure - $llegada')";


		if (!$result22 = $db->query($sql22)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		
		// insert pilot salary in Va finance module
		$sqla = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id, operator_id) values ($quantity_neg, '99995',now(),$pilot ,'Vuelo Regular:$salida - $llegada','IVAO', '$code_info_money', '$operator_id_flight')";
		if (!$resulta = $db->query($sqla)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
		
		
			$sql1123 = "UPDATE gvausers set location='$llegada', route_id='0' where gvauser_id='$pilot'";

		if (!$result1123 = $db->query($sql1123)) {
			die('There was an error running the query [' . $db->error . ']');
		}

	
	$sql1123p = "UPDATE fleets set booked='0', booked_at='0', gvauser_id='0',location='$llegada',hours=hours+$duration,status=status-$flight_wear where registry='$registry'";

		if (!$result1123p = $db->query($sql1123p)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
				$origen = $departure;
		
		// check damage in plane and send it to the hangar if needed
				$query3 = 'select * from  fleets  where fleet_id = (select fleet_id from  reserves where gvauser_id=' . $pilot . ');';
				
				if (!$result3 = $db->query($query3)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				$estado = 0;
				while ($row3 = $result3->fetch_assoc()) {
					$estado = $row3["status"];
					$avion = $row3["fleet_id"];
					$matricula = $row3["registry"];
					$location = $row3["location"];
				}
		
		
		
		if ($estado < $plane_status_hangar && $estado > 0) {
					$query1 = "insert into hangar (registry,gvauser_id,fleet_id,departure,location,date_in,date_out,reason) values ('$matricula',$pilot,$avion,'$origen','$llegada',CURDATE(),ADDDATE(CURDATE(),$hangar_maintenance_days),'Maintenance')";
					
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "update fleets set booked=1 ,hangar=1, hangardate=now() where fleet_id=$avion";
				
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					$query1 = "insert into vaprofits (value,date,gvauser_id,description,operator_id) values (-$hangar_maintenance_value, now(),$pilot ,'Maintenance $matricula',''$operator_id_flight'')";
					
					if (!$result_sta = $db->query($query1)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					// Cost for the VA for the maintenance
				    $query1 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id,operator_id) values (-$hangar_maintenance_value, '99997', now(),$pilot ,'Aircraft Maintenace $matricula','IVAO', '$code_info_money','$operator_id_flight')";
				    if (!$result_sta = $db->query($query1)) {
					  die('There was an error running the query [' . $db->error . ']');
				    }
				}
		
		
		
	
		
		
		$gananciasvuelo = round($pax_price*$assigned_pax)+($cargo_price*$assigned_cargo);
		
		

		
		// insert ganancias vuelo
		//$sql23 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values ($gananciasvuelo, '99995',now(),$pilot ,'Vuelo Regular: $departure - $arrival','IVAO', '$callsign_vuelo')";

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
			$reporttype = 'IVAO';
			$route_id =  $route_ids;
			
			
		
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money','$operator_id_flight')";

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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', '$operator_id_flight')";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', '$operator_id_flight')";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', '$operator_id_flight')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 
		// End cost

		// Begin income section for regular flights
		$sql_cost = "select * from routes where route_id=$route_id";	
		if (!$result_cost = $db->query($sql_cost)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_cost = $result_cost->fetch_assoc()) {
				// Income by PAX				
				$pax_price = $row_cost['pax_price'];
				$cargo_price = $row_cost['cargo_price'];
				$amount = $pax_price * $pax;
				$descrip= 'Number of PAX:' .$pax.' .Price per PAX:'.$pax_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values (99999,now(),$amount,$gvauser_id,'$descrip','$reporttype','$code_info_money', '$operator_id_flight')";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
				}

				$amount = $cargo_price * $cargo;
				$descrip= 'Cargo:' .$cargo.' .Price per Cargo Unit:'.$cargo_price;
				if ($amount!=0)
				{
					$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values (99998,now(),$amount,$gvauser_id,'$descrip','$reporttype','$code_info_money','$operator_id_flight')";
					if (!$result = $db->query($sql)) {
						die('There was an error running the query [' . $db->error . ']');
					}					
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', '$operator_id_flight')";

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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money', '$operator_id_flight')";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money','$operator_id_flight')";
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
						$sql = "insert into va_finances (parameter_id,finance_date,amount,gvauser_id, description, report_type,report_id, operator_id) values ($para_id,now(),$amount,$gvauser_id,'$para_desc','$reporttype','$code_info_money','$operator_id_flight')";
						if (!$result = $db->query($sql)) {
							die('There was an error running the query [' . $db->error . ']');
						}
					}
				}
		} 		


		// End income for any flight


			
		

	
	
	
	   ///////////////////////////////////////////////////////// FIN FINANZAS PARA LA VA //////////////////////////////////////////////////////////
	
	$sql1p = "delete from reserves where gvauser_id=$pilot";  

		if (!$result1p = $db->query($sql1p)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
	
		
		
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
alert('<?php echo ERROR_REPORT; ?>');
window.location = './index_user.php?page=cancel_reserve&route=<?php echo $route; ?>&plane=<?php echo $plane; ?>';
</script>
	
	
	<?php
			
			}
	
} else {
	?>
	
	<script>
alert('<?php echo ERROR_ONE; ?>');
window.location = './index_user.php?page=volar';
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
window.location = './index_user.php?page=volar';
</script>
	
	
	<?php
	
}
		?>
		
			
	
