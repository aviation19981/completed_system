<?php 
// Desactivar toda notificación de error
error_reporting(0); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="refresh" content="300">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ColStar Alliance | Mapa</title>
    <meta name="keywords" content="aerolinea, airlines, colombia, colstar, acars, va , fsx, ivao, virtual" />
<meta name="description" content="Aerol&iacute;nea virtual Colombiana, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?"/>
<link href="./images/favicon.ico" type="image/x-icon" rel="icon" />
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ&callback=initMap" type="text/javascript">
</script>

 <script src="Charts/Chart.js"></script>
 
	
	
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css"/>
	<script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="js/moment-with-locales.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/numeric-comma.js"></script>
	<script src="js/raphael.min.js" type="text/javascript"></script>
	<script src="js/morris.min.js" type="text/javascript"></script>




  <!-- CSS FILES -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/skins/blue.css" media="screen" data-name="skins">


    <link rel="stylesheet" href="css/animate.css"/>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Page loader -->    
	
	<style>
	html {
  height: 100%;
}



.loader{
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  
   background-image: radial-gradient(circle farthest-corner at center, #3C4B57 0%, #1C262B 100%);
  z-index: 999; 
  width: 100%;
  height: 100%;
}



.cssload-loader {
	position: relative;
	left: calc(50% - 68px);
        top: 30%;
	width: 136px;
	height: 136px;
	border-radius: 50%;
        -o-border-radius: 50%;
        -ms-border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
	perspective: 1700px;
}

.cssload-inner {
	position: absolute;
	width: 100%;
	height: 100%;
	box-sizing: border-box;
        -o-box-sizing: border-box;
        -ms-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
	border-radius: 50%;
        -o-border-radius: 50%;
        -ms-border-radius: 50%;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;	
}

.cssload-inner.cssload-one {
	left: 0%;
	top: 0%;
	animation: cssload-rotate-one 1.15s linear infinite;
        -o-animation: cssload-rotate-one 1.15s linear infinite;
        -ms-animation: cssload-rotate-one 1.15s linear infinite;
        -webkit-animation: cssload-rotate-one 1.15s linear infinite;
        -moz-animation: cssload-rotate-one 1.15s linear infinite;
	border-bottom: 6px solid #CBCBCB;

}

.cssload-inner.cssload-two {
	right: 0%;
	top: 0%;
	animation: cssload-rotate-two 1.15s linear infinite;
        -o-animation: cssload-rotate-two 1.15s linear infinite;
        -ms-animation: cssload-rotate-two 1.15s linear infinite;
        -webkit-animation: cssload-rotate-two 1.15s linear infinite;
        -moz-animation: cssload-rotate-two 1.15s linear infinite;
	border-right: 6px solid #c09309;
}

.cssload-inner.cssload-three {
	right: 0%;
	bottom: 0%;
	animation: cssload-rotate-three 1.15s linear infinite;
        -o-animation: cssload-rotate-three 1.15s linear infinite;
        -ms-animation: cssload-rotate-three 1.15s linear infinite;
        -webkit-animation: cssload-rotate-three 1.15s linear infinite;
        -moz-animation: cssload-rotate-three 1.15s linear infinite;
	border-top: 6px solid #9c1515;
}

.loadercaption{
    color: #CBCBCB;
    font-weight: 400;
    font-size: 1.8em;
    text-align: center;
    top: 30%;
    position: relative;
}

@keyframes cssload-rotate-one {
	0% {
		transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
	}
	100% {
		transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
	}
}

@-o-keyframes cssload-rotate-one {
	0% {
		-o-transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
	}
	100% {
		-o-transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
	}
}

@-ms-keyframes cssload-rotate-one {
	0% {
		-ms-transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
	}
	100% {
		-ms-transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
	}
}

@-webkit-keyframes cssload-rotate-one {
	0% {
		-webkit-transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
	}
	100% {
		-webkit-transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
	}
}

@-moz-keyframes cssload-rotate-one {
	0% {
		-moz-transform: rotateX(35deg) rotateY(-45deg) rotateZ(0deg);
	}
	100% {
		-moz-transform: rotateX(35deg) rotateY(-45deg) rotateZ(360deg);
	}
}

@keyframes cssload-rotate-two {
	0% {
		transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
	}
	100% {
		transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
	}
}

@-o-keyframes cssload-rotate-two {
	0% {
		-o-transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
	}
	100% {
		-o-transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
	}
}

@-ms-keyframes cssload-rotate-two {
	0% {
		-ms-transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
	}
	100% {
		-ms-transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
	}
}

@-webkit-keyframes cssload-rotate-two {
	0% {
		-webkit-transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
	}
	100% {
		-webkit-transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
	}
}

@-moz-keyframes cssload-rotate-two {
	0% {
		-moz-transform: rotateX(50deg) rotateY(10deg) rotateZ(0deg);
	}
	100% {
		-moz-transform: rotateX(50deg) rotateY(10deg) rotateZ(360deg);
	}
}

@keyframes cssload-rotate-three {
	0% {
		transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
	}
	100% {
		transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
	}
}

@-o-keyframes cssload-rotate-three {
	0% {
		-o-transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
	}
	100% {
		-o-transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
	}
}

@-ms-keyframes cssload-rotate-three {
	0% {
		-ms-transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
	}
	100% {
		-ms-transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
	}
}

@-webkit-keyframes cssload-rotate-three {
	0% {
		-webkit-transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
	}
	100% {
		-webkit-transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
	}
}

@-moz-keyframes cssload-rotate-three {
	0% {
		-moz-transform: rotateX(35deg) rotateY(55deg) rotateZ(0deg);
	}
	100% {
		-moz-transform: rotateX(35deg) rotateY(55deg) rotateZ(360deg);
	}
}




</style>


<?php 
	

include('./get_va_data.php');

	
	
	?>
	
	
	



<div class="loader">
    <div class="cssload-loader">
            <div class="cssload-inner cssload-one"></div>
            <div class="cssload-inner cssload-two"></div>
            <div class="cssload-inner cssload-three"></div>
    </div>        
   <br>
    <div class="loadercaption"><span style="color:#097D81;">ColStar</span> Alliance</div>
  
 <?php if ($vuelosactivos==0) {
		echo ' <div class="loadercaption"><span style="color:#097D81;"><br><p>No hay vuelos en vivo.</p></span></div>';
	} else {
		echo ' <div class="loadercaption"><span style="color:#097D81;"><br><p>Próximos a despegar...!</p></span></div>';
	}
	
	?>
    </div>        


<!---->








</head>
<body>
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

 
 
// For easy translation..
$lng['staffingb'] = 'Staff en linea';
$lng['atcingb'] = 'ATC en linea - CO';
$lng['noatcingb'] = 'No hay ATC en linea.';
$lng['trafficingb'] = 'Trafico Salidas/Llegadas';
$lng['notrafficingb'] = 'No hay trafico Salidas/Llegadas.';
$lng['atcbingb'] = '<a href="http://www.ivao.aero/atcss/new.asp" target="_blank">Add a Booking</a>';
$lng['noatcbingb'] = 'No se puede reservar.';
$lng['totalonline'] = 'Hay %s ATC(s) y %s  piloto(s) conectado(s) en IVAO.';
$lng['today'] = 'Hoy';
$lng['tomorrow'] = 'Mañana';
$weekdays = array(
    1 => 'Lunes',
    2 => 'Martes',
    3 => 'Miercoles',
    4 => 'Jueves',
    5 => 'Viernes',
    6 => 'Sabado',
    0 => 'Domingo'
);

// Put here 2 first letter of airport ICAO codes
#$countryicao = 'NW';

// Put here country code of staff members
$staffcountry = 'CO';

$airports = array(
'SKBO' => '', 
'SKRG' => '', 
'SKCL' => '', 
'SKPE' => '', 
'SKSP' => '', 
'SKSM' => '', 
'SKCG' => '', 
'SKRH' => '', 
'SKBG' => '', 
'SKMD' => '', 
'SKBQ' => '', 
'SKBS' => '', 
);

$validcontrollers = array('DEL','GND','TWR','DEP','APP','CTR','FSS');

$ctrlevel = array(
   1 => 'OBS',
   2 => 'AS1',
   3 => 'AS2',
   4 => 'AS3',
   5 => 'ADC',
   6 => 'APC',
   7 => 'ACC',
   8 => '<span class="green">SEC</span>',
   9 => '<span class="green">SAI</span>',
  10 => '<span class="green">CAI</span>',
  11 => '<span class="red">SUP</span>',
  12 => '<span class="red">ADM</span>'
);


$filecontents = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
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
$datos [$index2][$index] = $flights_coordinates;


$flightindex ++;
		$index=0  ;
		$index2 ++;	
		
	$jsonarray[0]=$liveflights;
	$jsonarray[1]=$datos;
			
}
	
			
			
		
	}		
	
		
					
			
		
	}
		


	
	
	
		 

?>
	
	<div id="map-outer" >
<div style=" position: absolute; z-index: 1; margin: 10px;">
                                                      <a href="./"><img src="./images/logo.png" width="20%" alt="ColStar Alliance" /> </a>
                                                  </div> 
			<div id="map-container" ></div>
			<div id="over_map">
			       
												  </div>
		</div><!-- /map-outer -->

<style>
	body { background-color:#FFFFF }
	#map-outer {
		padding: 0px;
		border: 0px solid #CCC;
		margin-bottom: 0px;
		background-color:#FFFFF }
	#map-container { height: 100% }
	@media all and (max-width: 100%) {
		#map-outer  { height: 100% }
	}
	
	.panel-map > .panel-heading {
   
		border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 0px solid #000000;
}

.table-map > tbody > tr > td, .table > tfoot > tr > td {
    padding: 0px;
    line-height: 1.42857;
    vertical-align: top;
	border-radius: 15px 15px 15px 15px;
-moz-border-radius: 15px 15px 15px 15px;
-webkit-border-radius: 15px 15px 15px 15px;
border: 0px solid #000000;
}



</style>
<style>
   #wrapper { position: relative; }
   #over_map { position: absolute; top: 0px; left: 0px; z-index: 99;width: 30%;height:100%}
</style>


<style type="text/css">

.progress{margin-top:15px;height:6px;box-shadow:none;margin-bottom:10px}#tbl-flights .progress{margin-top:7px;height:10px;margin-bottom:0}.progress-bar{box-shadow:none}

.tg  {border-collapse:collapse;border-spacing:0;
border-radius: 45px 45px 45px 45px;
-moz-border-radius: 45px 45px 45px 45px;
-webkit-border-radius: 45px 45px 45px 45px;
border: 0px solid #000000;
background-color: #ffffff;
}

.tg td{font-family:Arial, sans-serif;font-size:14px;padding:6px 20px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:6px 20px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}




#caja {
background-color: #2d3b45;
height: 40px;
/*para Firefox*/
-moz-border-radius: 0px 15px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 15px 0px 0px;
/* para Opera */
border-radius: 0px 15px 0px 0px;

}

#caja1 {
background-color: #f16836;
height: 5px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}

#caja2 {
background-color: #2d3b45;
padding: 10px;
height: 85px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}


#caja3 {
background-color: #f16836;
height: 40px;
/*para Firefox*/
-moz-border-radius: 0px 0px 15px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 15px 0px;
/* para Opera */
border-radius: 0px 0px 15px 0px;
}


#caja4 {
background-color: #f69533;
height: 5px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}




#caja8 {
background-color: #d1d2d4;
height: 100px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}
</style>


</body>
<script type="text/javascript">
	var mapCentre;
	var map ;
	function init_map() {
		var flights = <?php echo json_encode($jsonarray[0]); ?>;
		var locations = <?php echo json_encode($jsonarray[1]); ?>;
		var numpoints=(locations.length);
		console.log(locations);
		var var_location = new google.maps.LatLng(<?php echo $datos[0][0]["latitude"]; ?>,<?php echo $datos[0][0]["longitude"]; ?>);
		var var_mapoptions = {
			center: var_location,
            minZoom: 3,
			zoom: 3,
			refreshTime: 10000,
autorefresh: true,
disableDefaultUI: true,
			styles: [
    {
        "featureType": "administrative",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape.natural.landcover",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "saturation": "-47"
            },
            {
                "lightness": "-57"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": "-63"
            },
            {
                "lightness": "-55"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#519c2f"
            },
            {
                "gamma": "1.27"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#e4bd2e"
            },
            {
                "weight": "3.14"
            },
            {
                "gamma": "1.58"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "weight": "0.38"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#f28a17"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "saturation": "-78"
            },
            {
                "lightness": "-32"
            },
            {
                "gamma": "1.11"
            },
            {
                "hue": "#ff0000"
            },
            {
                "weight": "9.68"
            },
            {
                "invert_lightness": true
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#7f0000"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#ff7676"
            },
            {
                "weight": "0.69"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#4ba7b2"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": "-51"
            },
            {
                "lightness": "-59"
            }
        ]
    }
]};
		map = new google.maps.Map(document.getElementById('map-container'),	var_mapoptions);
		var mapas=[];
		var flightPlanCoordinates=[];
		var flightPath = new google.maps.Polyline({
		strokeColor: "#c3524f",
		strokeOpacity: 1,
		strokeWeight: 2,
		geodesic: true
		});
		var k=0;
		var z=0;
		var coordinate;
		while (k<numpoints) {
			while (z < locations[k].length)
			{
				coordinate =new google.maps.LatLng(locations[k][z]['latitude'],locations[k][z]['longitude']);
				flightPlanCoordinates.push(coordinate);
				z=z+1;
			}
			ruta = new google.maps.Polyline({
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
			});
			ruta.setPath(flightPlanCoordinates);
			mapas.push(ruta);
			z=0;
			k=k+1;
		};
		function createMarker(pos, t) {
		var coord=[];
		var pathcoord=[];
		var flight_id = t;
		currentPath = new google.maps.Polyline({
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
			});
		// Plane marker begin
		var image = new google.maps.MarkerImage(flights[t]['typesairplane']+flights[t]['heading'] +".png",null,new google.maps.Point(0,0),new google.maps.Point(15, 15),new google.maps.Size(40, 40));
		var icon_airport_dep = new google.maps.MarkerImage("./map_icons/airport_yellow_marker.png");
		var icon_airport_arr = new google.maps.MarkerImage("./map_icons/airport_blue_marker.png");
		var lineSymbol = {path: 'M 0,-1 0,1', strokeOpacity: 1, scale: 1 };
		var lat1 = flights[t]["dep_lat"];
		var lat2 = flights[t]["arr_lat"];
		var lng1 = flights[t]["dep_lon"];
		var lng2 = flights[t]["arr_lon"];
		var dep = new google.maps.LatLng(lat1, lng1)
		var arr = new google.maps.LatLng(lat2, lng2)
		
		var informaciones = flights[t]['callsign_vuelo'];
		  var informacionespro = '<div style="width:270px;">'+'<h3>Flight Information</h3>'+
	  '<span style="font-size: 10px; text-align:left; width: 100%" align="left">'+'<center>'+
	  flights[t]['operators'] + '</center>'+
	  '<hr>'+
      '<p> <strong>Flight:</strong> ' + flights[t]['callsign_vuelo'] +  '<br>'+
	  '<strong>Pilot:</strong> ' + flights[t]['name'] +  '<br>'+
      '<strong>Origin: </strong>' + flights[t]['dep_name'] + ' (' + flights[t]['departure'] + ') <br>'+
      '<strong>Destination: </strong>' + flights[t]['arr_name'] + ' (' + flights[t]['arrival'] + ') <br>'+
	  '<strong>Aircraft:</strong> ' + flights[t]['plane_type'] + '<br>'+
      '<strong>Status:</strong> ' + flights[t]['flight_status'] +
      '</p>'+
      '<hr>'+
      '<p> <strong>Altitude:</strong> ' + flights[t]['altitude'] + 'ft <br>'+
      '<strong>Ground Speed:</strong> ' + flights[t]['gs']+ 'kts <br>'+
      '<strong>Heading:</strong> ' + flights[t]['heading'] + ' <br>'+
      '<strong>Distance Remaining:</strong> ' + flights[t]['pending_nm'] + 'nm<br>'+
	  '<hr>'+
	  '<strong>Network IVAO:</strong> ' + flights[t]['networkss'] + '</center><br>' + 
	  '<strong>Remarks:</strong> ' + flights[t]['rmks'] + '</center><br>' +
	  '<strong>Route:</strong> ' + flights[t]['fpl'] + '</center><hr>'+
	  '<div class="progress"><div class="' + flights[t]['bar'] + '" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'   + flights[t]['porcentaje'] +  '%"><center><font color="black">'  + flights[t]['perc_completed'] + '%</font></center></div></div>'+
	  
      '</p>'+  
    '</span>'+
    '</div>';
			
			
		var marker = new google.maps.Marker({
			position: pos,
			icon: image,
			name: t,
			<?php
  
$tablet_browser = 0;
$mobile_browser = 0;
$body_class = 'desktop';
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
    $body_class = "tablet";
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
}
if ($tablet_browser > 0) {
?>
contenido: informacionespro,
<?
}
else if ($mobile_browser > 0) {
?>
contenido: informacionespro,
<?
}
else {
	?>
contenido: informaciones,
<?
}  
?>

icao1:new google.maps.Marker({
							position: dep,
							 map: map,
							 icon: icon_airport_dep,
							 visible: false
						}),
						icao2:new google.maps.Marker({
							position: arr,
							 map: map,
							 icon: icon_airport_arr,
							 visible: false
						}),
                        line1:new google.maps.Polyline({
							path: [dep, pos],
							strokeColor: "#08088A",
							strokeOpacity: 1,
							strokeWeight: 2,
							geodesic: true,
							map: map,
							polylineID: t,
							visible: false
                        })	,
                        line2:new google.maps.Polyline({
							path: [pos, arr],
							strokeColor: "#FE2E2E",
							strokeOpacity: .3,
							geodesic: true,
							map: map,
							icons: [{
								icon: lineSymbol,
								offset: '0',
								repeat: '5px'
							}],
							polylineID: t,
							visible: false
                        })
			
		});
		// On mouse over
        google.maps.event.addListener(marker, 'mouseover', function () {
            //infowindow.open(map, marker);
            this.get('line1').setVisible(true);
            this.get('line2').setVisible(true);
			this.get('icao1').setVisible(true);
			this.get('icao2').setVisible(true);
			 //infowindow.open(map,marker);
		   infowindow.setContent(marker.contenido);
		    var s=0;
		   coord.length = 0;
		   pathcoord.length = 0;
		  while (s < locations[flight_id].length)
			{
				coord= new google.maps.LatLng(locations[flight_id][s]['latitude'],locations[flight_id][s]['longitude']);
				pathcoord.push(coord);
				s=s+1;
			}
			currentPath.setPath(pathcoord);
			currentPath.setMap(map);
			
			
		
			
			<?php
  
$tablet_browser = 0;
$mobile_browser = 0;
$body_class = 'desktop';
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
    $body_class = "tablet";
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
}
if ($tablet_browser > 0) {
?>
flight_detail='<table class="tg"  width="100%" height="100%">'+

'<tr>'+
    '<th class="tg-031e"    id="caja"  colspan="3"></th>'+
  '</tr>'+
  '<tr >'+
    '<td class="tg-031e" color="white" id="caja1" colspan="3" ></td>'+
  '</tr>'+
 '<tr   height="70px">'+
    '<th class="th-yw4l" color="white" colspan="3"><center><img src="'+
	  flights[t]['aviones'] + '" width="80%" ></center></th>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3"><center>'+
	  flights[t]['operators'] + '</center></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Flight No.<br><b>' + flights[t]['callsign_vuelo'] +  '</b></td>'+
    '<td class="tg-yw4l">Aircraft<br><b>' + flights[t]['plane_type'] + '</b></td>'+
    '<td class="tg-yw4l">Tail<br><b>' + flights[t]['aeronaveregistro'] + '</b></td>'+
  '</tr>'+
  '<tr height="15px">'+
    '<td class="tg-yw4l" colspan="2">' + flights[t]["departure"] + '<br><b>' + flights[t]["dep_name"] + ' , ' + flights[t]["dep_name_iso"] + '</b></td>'+
   '<td class="tg-yw4l">' + flights[t]["arrival"] + '<br><b>' + flights[t]["arr_name"] + ' , ' + flights[t]["arr_name_iso"] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td height="5" colspan="3"><div class="progress"><div class="' + flights[t]['bar'] + '" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"  style="width:'   + flights[t]['porcentaje'] +  '%"></div></div></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="2"><small><font color="#B68E29">' + flights[t]['distanciar'] + ' miles</font></small></td>'+
    '<td class="tg-yw4l"><small><font color="#308414">' + flights[t]['distanciatotal'] + ' miles</font></small></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Altitude<br><b>' + flights[t]['altitude'] + 'ft</b></td>'+
    '<td class="tg-yw4l">Heading<br><b>' + flights[t]['heading'] + '°</b></td>'+
    '<td class="tg-yw4l">Speed<br><b>' + flights[t]['gs']+ ' kts</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">ETOD<br><b>' + flights[t]['etod']+ '</b></td>'+
    '<td class="tg-yw4l">ETA<br><b>' + flights[t]['eta']+ '</b></td>'+
    '<td class="tg-yw4l">STA<br><b>' + flights[t]['sta']+ '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Status<br><b>' + flights[t]['flight_status'] + '</b></td>'+
    '<td class="tg-yw4l" colspan="2">Last Update<br><b><?php date_default_timezone_set('UTC'); echo date("Y-m-d H:i:s"); ?></b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3">Pilot<br><b>' + flights[t]['nombrepiloto'] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja4" colspan="3"></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja3" colspan="3"></td>'+
  '</tr>'+
'</table>';
			
			
			
			
			
			
			
			
	
			//flights[t]['departure'] + '-' + flights[t]['arrival'] + '<br />' + flights[t]['callsign']+ ' '+flights[t]['name']+ ' '+flights[t]['surname'] + '<br />' + 'ALTITUDE: ' + flights[t]['altitude'] + '<br />' + 'GS: ' + flights[t]['gs']+ '<br />' + 'HEADING: ' + flights[t]['heading'] + '<br />' + flights[t]['flight_status'];
			$('#over_map').html("<div id='mySecondDiv' width='370px' height='100%'>"+flight_detail+"</div>");
<?
}
else if ($mobile_browser > 0) {
?>

<?
}
else {
	?>
flight_detail='<table class="tg"  width="100%" height="100%">'+

'<tr>'+
    '<th class="tg-031e"    id="caja"  colspan="3"></th>'+
  '</tr>'+
  '<tr >'+
    '<td class="tg-031e" color="white" id="caja1" colspan="3" ></td>'+
  '</tr>'+
 '<tr   height="70px">'+
    '<th class="th-yw4l" color="white" colspan="3"><center><img src="'+
	  flights[t]['aviones'] + '" width="80%" ></center></th>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3"><center>'+
	  flights[t]['operators'] + '</center></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Flight No.<br><b>' + flights[t]['callsign_vuelo'] +  '</b></td>'+
    '<td class="tg-yw4l">Aircraft<br><b>' + flights[t]['plane_type'] + '</b></td>'+
    '<td class="tg-yw4l">Tail<br><b>' + flights[t]['aeronaveregistro'] + '</b></td>'+
  '</tr>'+
  '<tr height="15px">'+
    '<td class="tg-yw4l" colspan="2">' + flights[t]["departure"] + '<br><b>' + flights[t]["dep_name"] + ' , ' + flights[t]["dep_name_iso"] + '</b></td>'+
   '<td class="tg-yw4l">' + flights[t]["arrival"] + '<br><b>' + flights[t]["arr_name"] + ' , ' + flights[t]["arr_name_iso"] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td height="5" colspan="3"><div class="progress"><div class="' + flights[t]['bar'] + '" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"  style="width:'   + flights[t]['porcentaje'] +  '%"></div></div></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="2"><small><font color="#B68E29">' + flights[t]['distanciar'] + ' miles</font></small></td>'+
    '<td class="tg-yw4l"><small><font color="#308414">' + flights[t]['distanciatotal'] + ' miles</font></small></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Altitude<br><b>' + flights[t]['altitude'] + 'ft</b></td>'+
    '<td class="tg-yw4l">Heading<br><b>' + flights[t]['heading'] + '°</b></td>'+
    '<td class="tg-yw4l">Speed<br><b>' + flights[t]['gs']+ ' kts</b></td>'+
  '</tr>'+
  '<tr>'+
   '<td class="tg-yw4l">ETOD<br><b>' + flights[t]['etod']+ '</b></td>'+
    '<td class="tg-yw4l">ETA<br><b>' + flights[t]['eta']+ '</b></td>'+
    '<td class="tg-yw4l">STA<br><b>' + flights[t]['sta']+ '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Status<br><b>' + flights[t]['flight_status'] + '</b></td>'+
    '<td class="tg-yw4l" colspan="2">Last Update<br><b><?php date_default_timezone_set('UTC'); echo date("Y-m-d H:i:s"); ?></b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3">Pilot<br><b>' + flights[t]['nombrepiloto'] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja4" colspan="3"></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja3" colspan="3"></td>'+
  '</tr>'+
'</table>';
			
			
			
			
			
			
			
			
	
			//flights[t]['departure'] + '-' + flights[t]['arrival'] + '<br />' + flights[t]['callsign']+ ' '+flights[t]['name']+ ' '+flights[t]['surname'] + '<br />' + 'ALTITUDE: ' + flights[t]['altitude'] + '<br />' + 'GS: ' + flights[t]['gs']+ '<br />' + 'HEADING: ' + flights[t]['heading'] + '<br />' + flights[t]['flight_status'];
			$('#over_map').html("<div id='mySecondDiv' width='370px' height='100%'>"+flight_detail+"</div>");
<?
}  
?>
        });
		// On mouse end
		// mouse out
        google.maps.event.addListener(marker, 'mouseout', function () {
            //infowindow.close();
            this.get('line1').setVisible(false);
            this.get('line2').setVisible(false);
			this.get('icao1').setVisible(false);
			this.get('icao2').setVisible(false);
			$('#over_map').html("");
			//currentPath.setMap(null);
        });
		// mouse out end
	
		return marker;
	}
		var numflight=0
		while (numflight < flights.length )
		{
			var avionicon =new google.maps.LatLng(flights[numflight]['latitude'],flights[numflight]['longitude']);
			var m1 = createMarker(avionicon, numflight);
			m1.setMap(map);
			numflight = numflight +1;
		}
		var s=0;
		while (s < mapas.length)
		{
			s=s+1;
		}
		var infowindow = new google.maps.InfoWindow({
		  });
		google.maps.event.addListener(infowindow, 'closeclick', function() {
		$('#over_map').html("");
		});
		
		
	}
	google.maps.event.addDomListener(window, 'load', init_map);
	$( document ).ready(refreshflights);
	function refreshflights(){
		setInterval(function () {$.ajax({
			  url: 'get_map_coordinates.php',
			  data: "",
			  dataType: 'json',
			  success: function(data, textStatus, jqXHR) {
				init_map();
				}
			})}, 120000);
	}
</script>
<?php if ($vuelosactivos==0) {
		
	} else {
		?>
	<script type="text/javascript">
(function($) {
    $(window).load(function() { 
	$('.loader').fadeOut(); 
	$('.cssload-loader').delay(500).fadeOut('slow'); 
	$('body').delay(500).css({'overflow':'visible'}); 
    });
})(jQuery)
</script> 
		<?php
	}
	
	?>

</html>