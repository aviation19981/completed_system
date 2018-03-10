<?php
	 date_default_timezone_set('UTC');
     include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	$icao_va = array();
	$sql_operator_global_first ="select * from operators order by operator asc";

	if (!$result_operator_global_first = $db->query($sql_operator_global_first)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_first = $result_operator_global_first->fetch_assoc()) {
		$icao_va[]= $row_operator_first["callsign"];
	}
	
	
	 function checkCountryIcao($check) {
    $countryicao = array('SK');
    
    foreach($countryicao as $id => $value) {
        if(trim($value) == trim($check)) {
            return true;
        }
    }
    return false;
 }




$filecontents = file_get_contents_curl('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = explode("\n", $filecontents);

$filepart = '';
$pilots = array();
$pilotcount = 0;
$controllers = array();
$staff = array();
$controllercount = 0;
$generaldata = array();

foreach ($rows as $row) {
    if (substr($row,0,1) == '!') {
        $filepart = substr($row,1);
    } else {
        switch ($filepart) {
            case 'CLIENTS':
                $fields = explode(":", $row);
                if ($fields[3] == 'ATC') {
                    $controllercount++;
                    if (in_array(substr($fields[0],-3), $validcontrollers) && checkCountryIcao(substr($fields[0],0,2))) { array_push($controllers, $fields); }
                        if (substr($fields[0],0,3) == $staffcountry . '-') { array_push($staff, $fields); }
                } else {
                    $pilotcount++;
                        array_push($pilots, $fields);
                    
                }
                break;
            case 'GENERAL':
                list($key, $value) = explode('=', $row);
                $generaldata[trim($key)] = trim($value);
                break;
        }
    }
}




	
	unset($flights_coordinates);
	unset($flight);
	unset($liveflights);
	unset($datos);
	unset($jsonarray);
	$flights_coordinates = array();
	$datos = array ();
	$flight = array();
	$liveflights = array ();
	$jsonarray = array ();
	$index = 0;
	$index2=0;
	$flightindex=0;
	
    foreach ($pilots as $pilot) {
		
		$callsign = $pilot[0];
$vid = $pilot[1];
$nombres = $pilot[2];
$posicionuna = $pilot[5];				  
$posiciondos = $pilot[6];	
$altitud = $pilot[7];
$groundspeed = $pilot[8];	
$aeronave = substr($pilot[9], 2, 4);		
$tipes = substr($pilot[9], 7, 1);	
$cruisingspeed = $pilot[10];
$departure = $pilot[11];	
$requestlevel = $pilot[12];	
$arrival = $pilot[13];	
$trasponder = $pilot[17];	
$ranks = $pilot[41];	//26
$rmk = $pilot[29];	
$ruta = $pilot[30];	
$rumbo = $pilot[45];					
$fechados = $pilot[37];	
$estado = $pilot[46];	

	$callsign2 = substr($callsign,0,3);
if(in_array($callsign2,$icao_va))		{
			
			$salida=$pilot[11];
			$llegada=$pilot[13];
			
			$flight["callsign"]=$pilot[0];
			$flight["name"]=$pilot[2];
			$flight["gs"]=$pilot[8];
			$flight["altitude"]=$pilot[7];
			$flight["departure"]=$pilot[11];
			$flight["arrival"]=$pilot[13];
			$flight["latitude"]=$pilot[5];	
			$flight["longitude"]=$pilot[6];	
			$flight["heading"]=$pilot[45];	
            $flight["plane_type"]=$aeronave;
            $flight["callsign_vuelo"] = $pilot[0];
			$flight["operators"] = '<img src="../../admin/images/operators/charter.png" alt="" height="30"  WIDTH=30%>';
            $flight["fpl"]=$pilot[30];
            $flight["rmks"]=$pilot[29];	
			
			
			$groundspeed = $pilot[8];	
			
			
			
			// CALCULOS DISTANCIAS Y PORCENTAJES
		$vida=	$pilot[1];
		
$vuelosactivos=0;
	$sqlpilot = "select * from gvausers where ivaovid=$vida";
	if (!$resultpilot = $db->query($sqlpilot)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowpilot = $resultpilot->fetch_assoc()) {
		$vuelosactivos++;
		
		
	

	}
  		
			
			if($vuelosactivos>0){		
			
			
			
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
		
		// LINEAS
		$flight["dep_lat"]=$row3991a["latitude_deg"];
		$flight["dep_lon"]=$row3991a["longitude_deg"];
		
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
		
		// LINEAS
		$flight["arr_lat"]=$row3991aa["latitude_deg"];
		$flight["arr_lon"]=$row3991aa["longitude_deg"];
				
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
			
			$flight["pending_nm"]= $totaldistance;
$status = '';
$percent = '';
						$percent = round(($distnm/$distnms)*100);		
			
			
			 $flight["perc_completed"]=$percent;
			$flight["distanciatotal"]=$distnm;
			$flight["distanciar"]=$distnms;
			// PORCENTAJE 
			
			if  ($percent>=70){
							$flight["bar"]='progress-bar progress-bar-success';
						}
						else if ($percent<=70 || $percent>=35 )

						{ $flight["bar"]='progress-bar progress-bar-warning'; }

						if ($percent<35  ) {

							$flight["bar"]='progress-bar progress-bar-danger';
						}
							
							
		
		if ($percent<0) {
			
			$flight["porcentaje"] = "0";
		} else {
			
			$flight["porcentaje"]= $percent;
		}
						
					// ESTADO	
						
			
				if($pilot[46]==0) {
								$status = 'En Vuelo';
								
if (($percent >= 0) && ($percent <= 2)) {
$status = 'Despegue';
} 

if (($percent >= 2) && ($percent <= 7)) {
$status = 'Inicio Ascenso';
 } 

if (($percent >= 7) && ($percent <= 10)) {
 $status = 'Crucero';
}

if (($percent >= 10) && ($percent <= 80)) {
$status = 'En Ruta';
} 

if (($percent >= 80) && ($percent <= 90)) {
$status = 'Descendiendo';
} 

if (($percent >= 90) && ($percent <= 97)) {
$status = 'Iniciando Aproximación';
}
  
if (((97 <= $percent) && ($percent <= 105)) && ((360 >= $groundspeed) && ($groundspeed >= 30))) {
$status = 'Aproximación Final';
}



						} else {
$status = 'En Tierra';


if (((0 < $groundspeed) && ($groundspeed <= 30)) && ($percent < 5)){
$status = 'Rodando';
}

if (($groundspeed  > 30) && ($groundspeed  < 150) && ($percent < 5)) {
$status = 'Despegue';
}
                        
if (((97 <= $percent) && ($percent <= 105)) && ((270 >= $groundspeed) && ($groundspeed >= 30))) {
$status = 'Aterrizado';
}

if (($groundspeed < 30) && ($percent > 95)) {
$status = 'Rodando al Gate';
}
                        
if (($groundspeed == 0) && ($percent > 95)) {
$status = 'En Bloques';
}
                        
if (($groundspeed == 0) && ($percent <= 5)) {
$status = 'Embarcando';
}
                        
if (($groundspeed == 0) && ((10 <= $percent) && ($percent <= 90))) {
$status = 'Aeropuerto Alterno';
}
                        
						}
			
			
			
$flight["flight_status"] = $status;
			
			
			// PILOTO NOMBRE 
			
			$sqlpilot = "select * from gvausers where ivaovid=$vida";
	if (!$resultpilot = $db->query($sqlpilot)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowpilot = $resultpilot->fetch_assoc()) {
		$vuelosactivos++;
		

	$idpiloto = $rowpilot['gvauser_id'];
$flight["nombrepiloto"]= $rowpilot['name'] . ' ' . $rowpilot['surname'];
	}
			
				
		
		// NOMBRE AEROPUERTOS
		$dep = $pilot[11];
		$arr = $pilot[13];
		$sql_map_info = "select * from airports where ident='$dep'";
		if (!$resultados = $db->query($sql_map_info)) {
		die('There was an error running the query  [' . $db->error . ']');
          	}
			
while ($row_name = $resultados->fetch_assoc()) {

	$flight["dep_name"]= $row_name["municipality"];
$flight["dep_name_iso"]=$row_name["iso_country"];

}	

$sql_map_info2 = "select * from airports where ident='$arr'";
		if (!$resultados2 = $db->query($sql_map_info2)) {
		die('There was an error running the query  [' . $db->error . ']');
          	}
			
while ($row_name2 = $resultados2->fetch_assoc()) {

	$flight["arr_name"]= $row_name2["municipality"];
$flight["arr_name_iso"]=$row_name2["iso_country"];

}	
// FIN AEROPUERTOS
						
		
		// RESERVA
			
	
	$flight["aeronaveregistro"] = "Unknown";
	
	
	
	
	
	$nombre_fichero = './images/charter/' . $flight["plane_type"] . '.png';


if (file_exists($nombre_fichero)) {
     $flight["aviones"] = './images/charter/' . $flight["plane_type"] . '.png';
} else {
     $flight["aviones"] = './images/charter/unknown.png';
}
	
	
	
	
			
	$sql_maps = "select * from reserves where gvauser_id='$idpiloto'";
		
     if (!$results = $db->query($sql_maps)) {
		die('There was an error running the query  [' . $db->error . ']');
	}		
		
		while ($rows = $results->fetch_assoc()) {
			
			$ids_rutas = $rows["route_id"];
			 
			$flight["callsign_vuelo"] = $rows["callsign_alterno"];
			$fleet_ide = $rows["fleet_id"];
			
			$sql_mapsa2 = "select * from fleets where fleet_id='$fleet_ide'";
	
	 if (!$resultsa2 = $db->query($sql_mapsa2)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	
	
	while ($rowsa2 = $resultsa2->fetch_assoc()) {
$flight["aeronaveregistro"] = $rowsa2["registry"]; 
	 $flight["aviones"] =	"../../admin/images/planes/" .$rowsa2["image_url"];
	}
			
	$sql_mapsa = "select * from routes where route_id=$ids_rutas";
	
	 if (!$resultsa = $db->query($sql_mapsa)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	
	
	while ($rowsa = $resultsa->fetch_assoc()) {
		
		$ops = 	$rowsa["operator_id"];	
		
		$flighta = 'http://webeye.ivao.aero/c/' . $rowsa["flight"];
		
		$sql_map_op = "select * from operators where operator_id=$ops";
	
	 if (!$result_op = $db->query($sql_map_op)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
		
	while ($row_op = $result_op->fetch_assoc()) {
    $flight["operators"] = '<img src="./../admin/images/operators/' . $row_op["file"] . '" alt="" height="60"  WIDTH=50%>';
	}	
		
		
	}
			
			
	}


	
		// TIEMPOS 
			
			
			

$fobhr = $pilot[26];
$fobmin = $pilot[27];	

if ($fobhr <10) {
	$hrfob = '0' . $pilot[26];
} else {
	$hrfob = $pilot[26];
}


if ($fobmin <10) {
	$minfob = '0' . $pilot[27];
} else {
	$minfob = $pilot[27];
}


$fob = $hrfob . ':' . $minfob;	



$etod = $pilot[22];	
$etoda = $pilot[23];	


$etehr = $pilot[24];
$etemin = $pilot[25];	

if ($etehr <10) {
	$hrete = '0' . $pilot[24];
} else {
	$hrete = $pilot[24];
}


if ($etemin <10) {
	$minete = '0' . $pilot[25];
} else {
	$minete = $pilot[25];
}






$ete = $hrete . ':' . $minete;	




			
			$flight["etod"] ="--:--";
			$flight["eta"]  = "--:--";
			$flight["sta"]  = "--:--";
			// ETA 
			if($groundspeed>0) {
			 $flttime = ($distnm / $groundspeed);
			} else {
             $flttime = 0;
			}
														$sumas= ($flttime);
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.':'.$minutos;


			
					
 $timestamp=date('H:i', time());
 	
$Horas = strtotime($timestamp)+strtotime($total); 


								
	$flight["eta"] =  date('H:i',$Horas); 						
								// FIN ETA
								
							// STA	
							$hrss = substr($etod,0,2) . ':' . substr($etod,2,2);
												$Hora = strtotime($hrss)+strtotime($ete); 

$flight["sta"] = date('H:i',$Hora); 
			// FIN STA
			
			// ETOD
			$flight["etod"] = date('H:i',$etod); 	
			
			// FIN ETOD 
			
			// FINES
		
		
		

		
		
		










			

	
	// FIN DE ESO //
	
	
	
	
	$flight["idivao"] = '<a href="' . $flighta . '"><img src="http://status.ivao.aero/R/' . $pilot[0] . '.png" alt="" height="25"  WIDTH=40%></a>';
	
	if($tipes=="H") {
		$flight["typesairplane"] = "./images/inair/heavy/";
	} else if($tipes=="M") {
		$flight["typesairplane"] = "./images/inair/medium/";
	} else if($tipes=="L") {
		$flight["typesairplane"] = "./images/inair/light/";
	}
		
			

	

                $liveflights[$flightindex] =$flight;
                $flights_coordinates ["gvauser_id"] = $pilot[0];	
				$flights_coordinates ["latitude"] = $latitude_deg_loc;	
				$flights_coordinates ["longitude"] = $longitude_deg_loc;	
				$flights_coordinates ["latitude"] = $latitude_deg_arr;	
				$flights_coordinates ["longitude"] = $longitude_deg_arr;	
				$flights_coordinates ["heading"] = $pilot[45];	
				$flights_coordinates ["altitude"] = $pilot[7];
                $datos[$index2][$index] = $flights_coordinates;
				

        $index++;
		$index2++;
		$flightindex++;
		
	
			
}
	
			
    $jsonarray[0]=$liveflights;
	$jsonarray[1]=$datos;			
		
	}		
	
		
					
			
		
	}
		


	
	
	
		 

?>