
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
	$airplane = $_POST['airplane'];
	$airport_altern = $_POST['airport_altern'];
    $contarvuelos=0;
	
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
			$speed = 440;
			$app = $speed / 60 ;
			$flttime = round($dist / $app,0)+ 20;
			$hours = ($flttime / 60);
			
			
			if($durationivao<$hours) {
				$duration = $hours;
			} else {
				$duration = $horas+$minutes;
			}
			
			
$hoy = getdate();


	 
if($percent<10 && $estado==1) {
	
	
	
	
	
		
	
	$sql1123 = "UPDATE reserves set fecha_inicio='$fechass', airport_altern='$airport_altern' where gvauser_id='$pilot'";

		if (!$result1123 = $db->query($sql1123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
		
		
	

	
	//FIN
	
		?>
	
	<script>
window.location = './index_user.php?page=volar';
</script>
	
	
	<?php
	
	
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
		
			
	
