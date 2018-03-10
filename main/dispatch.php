
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo DISPATCH_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_DISPATCH_TITLE; ?></font></h3>

</section>






		<section class="contact">
			<div class="container">
	<h1><?php echo MY_DISPATCH_TITLE; ?></h1>
	<hr>
	

<?php
$deprwy = $_POST['deprwy'];
$arrrwy = $_POST['arrrwy'];
$flproute = $_POST['flproute'];
$altitudeCONFIG = $_POST['altitude'];
$altitude_full = (($altitudeCONFIG*10)/1000);
$speed = $_POST['speed'];
$mach = round(($speed*0.0015130718954118),2);

if (strlen($altitude_full) == 3) {
	$altitude = $altitude_full;
} else if (strlen($altitude_full) == 2) {
	$altitude = '0' . $altitude_full;
} else if (strlen($altitude_full) == 1) {
	$altitude = '00' . $altitude_full;
}

$extras = $_POST['extra'];

	require('./check_login.php');
       require('./db_login.php'); 
	   
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	

	$sql = "select route_id from gvausers gu where	gu.gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	while ($row = $result->fetch_assoc()) {
		$route = $row["route_id"];
		$route_id = $row["route_id"];
	}
	if ($route <> '' && $route > 0)
	{
	$sql1 = "select * from routes ro, reserves re, fleets f, fleettypes ft where ft.fleettype_id=f.fleettype_id and f.fleet_id=re.fleet_id and ro.route_id=$route and ro.route_id=re.route_id and  re.gvauser_id=$id";
	if (!$result1 = $db->query($sql1)) {
		die('There was an error running the query [' . $db->error . ']');
	}

$sql2 = "select * from reserves re where re.gvauser_id=$id";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}


while ($row1 = $result1->fetch_assoc()) {
	
	
	if ($callsignaltern=="") {
		$flight = $row1["flight"];
	} else {
		$flight = $callsignaltern;
	}
	
	
	
	
	$operator_idp = $row1["operator_id"];
$sql_operator_globals ="select * from operators where operator_id=$operator_idp";

	if (!$result_operator_globals = $db->query($sql_operator_globals)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row_operators = $result_operator_globals->fetch_assoc()) {
	
	
		$airline = strtoupper($row_operators["operator"]);
				
	}
	
	$horasalida = str_replace(":", "", $row1["etd"]);
	$contar = strlen($horasalida);
	if($contar<4) {
	$etd = '0' . $horasalida;		
	} else {
	$etd = $horasalida;	
	}
	
	
	$horallegada = str_replace(":", "", $row1["eta"]);
	$contar2 = strlen($horallegada);
	if($contar2<4) {
	$eta = '0' . $horallegada;		
	} else {
	$eta = $horallegada;	
	}
	//$etd = $row1["etd"];
	//$eta = $row1["eta"];
	
	
	
	
	
	
	
	
	// VERIFICACION CALLSIGN
	$sql2mas = "select * from reserves re where re.gvauser_id=$id";
	if (!$result2mas = $db->query($sql2mas)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row2mas = $result2mas->fetch_assoc()) {
		$fecha_inicio	 = $row2mas["fecha_inicio"];
		$callsignaltern = $row2mas["callsign_alterno"];
		$airport_altern = $row2mas["airport_altern"];
	}
	
	
	

		$vuelocall = $callsignaltern;
		
	

$alternative = $row1["alternative"]; 
$locationa = $row1["arrival"]; 
		
		
		
		
$sql388 = "SELECT * FROM airports  where ident='$location'";

	if (!$result388 = $db->query($sql388)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row388 = $result388->fetch_assoc()) {

		$latitude_deg_loc8 = $row388['latitude_deg'];

		$longitude_deg_loc8 = $row388['longitude_deg'];

		$airportname = strtoupper($row388['name']);
	}



$sql488 = "SELECT * FROM airports  where ident='$alternative'";

	if (!$result488 = $db->query($sql488)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row488 = $result488->fetch_assoc()) {

		$latitude_deg_arr8 = $row488['latitude_deg'];

		$longitude_deg_arr8 = $row488['longitude_deg'];
		
		$iata_codealt = strtoupper($row488['iata_code']);
		
		$airportnamealt = strtoupper($row488['name']);

	}


    $km8 = 111.302;
$nms8 = 0.539957;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorad8 = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodeg8 = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlong8 = ($longitude_deg_loc8 - $longitude_deg_arr8); 
    $dvalue8 = (sin($latitude_deg_loc8 * $degtorad8) * sin(
$latitude_deg_arr8 * $degtorad8)) + (cos($latitude_deg_loc8 * $degtorad8) * cos(
$latitude_deg_arr8 * $degtorad8) * cos($dlong8 * $degtorad8)); 
    $dd8 = acos($dvalue8) * $radtodeg8; 
    $kms8 = round(($dd8 * $km8), 2);

           

                        $dist8 = $kms8;
			

			
			
     $distnmp = round($dist8*$nms8);

	
	
	/////////////////////////// FIN ALTERNO /////////////
	
	
	
	
		
$sql3 = "SELECT * FROM airports  where ident='$location'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];
		
		$iata_codedep = strtoupper($row3['iata_code']);
		
		$origen = $row388['iso_country'];

	}



$sql4 = "SELECT * FROM airports  where ident='$locationa'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row4 = $result4->fetch_assoc()) {

		$latitude_deg_arr = $row4['latitude_deg'];

		$longitude_deg_arr = $row4['longitude_deg'];
		
		$airportnamearrival = strtoupper($row4['name']);
		
		$iata_codearr = strtoupper($row4['iata_code']);
		
		$destino = $row488['iso_country'];

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

           

                        $dist = $kms;
			$speed = $row1["TAS"];
			$app = $speed / 60 ;
			

			
			
     $distnm = round($kms*$nms);
	 
	 
$flttime = round($distnm / $app,0)+ 20;
			$hourse = intval($flttime / 60);
                        $minutese = (($flttime / 60) - $hourse) * 60;
						
						if($hourse<10) {
							$horas = '0' . $hourse;
						} else {
							$horas = $hourse;
						}
						
						if($minutese<10) {
							$minutos = '0' . $minutese;
						} else {
							$minutos = $minutese;
						}
						$time = $horas . $minutos;
						
						while ($row2 = $result2->fetch_assoc()) {
$pax = $row2['pax'];	
$cargo = $row2['cargo'];
$adult = $row2['adult'];	
$children = $row2['children'];
$infants = $row2['infants'];	
// Calculating number of business and economy classes
$business = $row2['ejecutive_class'];	
$economy = $row2['tourist_class'];	
	}
	
	
	
	
	
	////////////////////// NUEVO /////////////////////
	
	
	
	
	
	
	    $routeReserve =0;
	    $hours = floor($distnm / $row1["TAS"]);
		$minutes = (int) (substr((string) round($distnm / $row1["TAS"], 1), 2)) * 6;
		if (strlen($minutes) == 1) {
			$minutes = "0" . $minutes;
		}
		if (strlen($hours) == 1) {
			$hours = "0" . $hours;
		}
		$totalMinutes = $hours * 60 + $minutes;
		$endFuelTime += $totalMinutes;
		$tripFuel = $totalMinutes * $row1["FF"];
		$tripTime = $hours . $minutes;
		if($origen==$destino) {
			/// Es Nacional
			$routeReserve = 0;
		}  else {
			/// Es Internacional
			$routeReserve = round($tripFuel / 100 * 10);
		}
		$rRTimeMin = floor($routeReserve / $row1["FF"]);
		$rRTimeHours = floor($rRTimeMin / 60);
		$rRTimeMin = $rRTimeMin - ($rRTimeHours * 60);
		if (strlen($rRTimeMin) == 1) {
			$rRTimeMin = "0" . $rRTimeMin;
		}
		if (strlen($rRTimeHours) == 1) {
			$rRTimeHours = "0" . $rRTimeHours;
		}
		$totalMinutes = $rRTimeHours * 60 + $rRTimeMin;
		$totalReserveTime += $totalMinutes;
		$rRTime = $rRTimeHours . $rRTimeMin;
		
	
	    // Calculating CONT fuel
	    $routeCont =0;
	    $hours = 0;
		if($origen==$destino) {
			/// Es Nacional
			$minutes = 45;
			$routeCont = round($minutes * $row1["FF"]);
		}  else {
			/// Es Internacional
			$minutes = 30;
			$routeCont = round($minutes * $row1["FF"]);
		}
		
		if (strlen($minutes) == 1) {
			$minutes = "0" . $minutes;
		}
		if (strlen($hours) == 1) {
			$hours = "0" . $hours;
		}
		$totalMinutes = $hours * 60 + $minutes;
		$rRCountTimeMin = floor($routeCont / $row1["FF"]);
		$rRCountTimeHours = floor($rRCountTimeMin / 60);
		$rRCountTimeMin = $rRCountTimeMin - ($rRCountTimeHours * 60);
		if (strlen($rRCountTimeMin) == 1) {
			$rRCountTimeMin = "0" . $rRCountTimeMin;
		}
		if (strlen($rRCountTimeHours) == 1) {
			$rRCountTimeHours = "0" . $rRCountTimeHours;
		}
		$totalMinutes = $rRCountTimeHours * 60 + $rRCountTimeMin;
		$totalReserveTime += $totalMinutes;
		$rRCountTime = $rRCountTimeHours . $rRCountTimeMin;
		
		

		// Calculating extra fuel
		$extraFuel = $extras;
		$minutes = floor($extraFuel / $row1["FF"]);
		$hours = floor($minutes / 60);
		$minutes = $minutes - ($hours * 60);
		if (strlen($minutes) == 1) {
			$minutes = "0" . $minutes;
		}
		if (strlen($hours) == 1) {
			$hours = "0" . $hours;
		}
		$totalMinutes = $hours * 60 + $minutes;
		$totalReserveTime += $totalMinutes;
		if($extraFuel==0) {
			$extraFuel = "0000";
		} else {
			$extraFuel = $extras;
		}
		$extraFuelTime = $hours . $minutes;
		
      
		// Calculating fuel for alternate
		$distNmAlt = $distnmp;
		$hours = floor($distNmAlt / $row1["TAS"]);
		$minutes = (int) (substr((string) round($distNmAlt / $row1["TAS"], 1), 2)) * 6;
		if (strlen($minutes) == 1) {
			$minutes = "0" . $minutes;
		}
		if (strlen($hours) == 1) {
			$hours = "0" . $hours;
		}
		$totalMinutes = $hours * 60 + $minutes;
		$totalReserveTime += $totalMinutes + 30;
		$altTime = $hours . $minutes;
		$totalFuelAlt = $totalMinutes * $row1["FF"];
		
		
		
		$hold_fuel = $row1["FF"]*30;

		$endFuelTime += $totalReserveTime;
		$totalReserve = $totalFuelAlt + $hold_fuel + $routeReserve + $extraFuel + $routeCont;
		$totalReserveTimeMin = $totalReserveTime;
		$totalReserveTimeHours = floor($totalReserveTimeMin / 60);
		$totalReserveTimeMin = $totalReserveTimeMin - ($totalReserveTimeHours * 60);
		if(strlen($totalReserveTimeMin) == 1) {
			$totalReserveTimeMin = "0" . $totalReserveTimeMin;
		}
		if(strlen($totalReserveTimeHours) == 1) {
			$totalReserveTimeHours = "0" . $totalReserveTimeHours;
		}
		$totalReserveTime = $totalReserveTimeHours . $totalReserveTimeMin;
		$endFuel = $tripFuel + $totalReserve;
		$taxi_fuel = $row1["FF"]*15;
		$totalFuel = $endFuel + $taxi_fuel;
		$totalFuelTime = $endFuelTime + 10;
		$totalFuelTimeMin = $totalFuelTime;
		$totalFuelTimeHours = floor($totalFuelTimeMin / 60);
		$totalFuelTimeMin = $totalFuelTimeMin - ($totalFuelTimeHours * 60);
		if(strlen($totalFuelTimeMin) == 1) {
			$totalFuelTimeMin = "0" . $totalFuelTimeMin;
		}
		if(strlen($totalFuelTimeHours) == 1) {
			$totalFuelTimeHours = "0" . $totalFuelTimeHours;
		}
		$totalFuelTime = $totalFuelTimeHours . $totalFuelTimeMin;
		$endFuelTimeMin = $endFuelTime;
		$endFuelTimeHours = floor($endFuelTimeMin / 60);
		$endFuelTimeMin = $endFuelTimeMin - ($endFuelTimeHours * 60);
		if(strlen($endFuelTimeMin) == 1) {
			$endFuelTimeMin = "0" . $endFuelTimeMin;
		}
		if(strlen($endFuelTimeHours) == 1) {
			$endFuelTimeHours = "0" . $endFuelTimeHours;
		}
		$endFuelTime = $endFuelTimeHours . $endFuelTimeMin;
		$missFuel = 15 * $row1["FF"];

	


		// Calculating weight of adult, children and infants
		$adultWeight = (80 + 10) * $adult;
		$childrenWeight = 30 * $children;
		$infantsWeight = 15 * $infants;
		$paxWeight = $adultWeight + $childrenWeight + $infantsWeight;

	

		// Calculating ZFW
		$DOW = $row1["DOW"];
		

		
		
		
		$ZFW = $DOW + $cargo + $paxWeight;
		$totalTrafficLoad = $cargo + $paxWeight;
		
        // Calculating weights
		$TOW = $ZFW + $totalFuel;
		$LW = $TOW - ($tripFuel + $taxi_fuel);
		
		
		/////////////////////// FIN //////////////
	?>










<?php
$codes = array(" INTERNATIONAL AIRPORT", " AIRPORT", " INTERCONTINENTAL AIRPORT");

	$nombreseaa = $pilotname;
	$cantidad = strlen($nombreseaa);

	 $IndiceEspacio = strpos($nombreseaa," "); 
	$numeros = $IndiceEspacio;
$CadenaRecortada = substr($nombreseaa,0,$numeros);


$nombreseaa2 = $pilotsurname;
	$cantidad2 = strlen($nombreseaa);

	$IndiceEspacio2 = strpos($nombreseaa2," "); 
	$numeros2 = $IndiceEspacio2;
$CadenaRecortada2 = substr($nombreseaa2,0,$numeros2);



$DesdeLetra = "A";
$HastaLetra = "Z";
$DesdeNumero = 150;
$HastaNumero = 900;
 
$letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
$letraAleatoria2 = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
$numeroAleatorio = rand($DesdeNumero, $HastaNumero);
 
 date_default_timezone_set('UTC');
 $timestamp=date('H:i', time());
 
 
 if(empty($airport_altern)) {
	 $alterno = $row1["alternative"];
 } else {
	 $alterno = $airport_altern;
 }
 
?>

<br>
<br>
<br>
<div class="container" style="width:100%;position:relative;z-index:1;" readonly="readonly">
<pre>
<b>[ OFP ]
--------------------------------------------------------------------</b>
<?=$flight?>   <?=strtoupper(gmdate("yMd"))?>    <?=$row1["departure"]?>-<?=$row1["arrival"]?>   <?=$row1["plane_icao"]?> <?=$row1["registry"]?>  RELEASE <?=date('ym')?> <?=strtoupper(gmdate("yMd"))?><br>
OFP 1    <?=str_replace($codes, "", $airportname)?>-<?=str_replace($codes, "", $airportnamearrival)?>
	
ATC C/S   <?=$flight?>       <?=$location?>/<?=$iata_codedep?>   <?=$row1["arrival"]?>/<?=$iata_codearr?>      
<?=strtoupper(gmdate("yMd"))?>   <?=$row1["registry"]?>       <?=$etd?>       <?=$eta?>          GND DIST  <?=$distnm?>

MAXIMUM    TOW  <?=$row1["mtow"]?>  LAW  <?=$row1["mlw"]?>  ZFW  <?=$row1["mzfw"]?>     
ESTIMATED  TOW  <?=$TOW?>  LAW  <?=$LW?>  ZFW  <?=$ZFW?>     
                                                  
                                                  
ALTN <?=$alterno?>                                       
FL STEPS <?=$row1["departure"]?>/0<?=$altitude?>/
--------------------------------------------------------------------
DISP RMKS   PLANNED OPTIMUM FLIGHT LEVEL

--------------------------------------------------------------------
      ----------- <?=$airline?> FLIGHT PLAN -------------
------- ALL SPEEDS IN KTS   DISTANCE IN NM   WEIGHT IN KG ----------

  FLT    AC/REG    DATE     ROUTE   MACH  ETD  ETA ALTN   FL
------- -------- -------- --------- ---- ---- ---- ---- -------
<?=$flight?>  <?=$row1["registry"]?> <?=gmdate("d/m/y")?> <?=$row1["departure"]?> <?=$row1["arrival"]?> <?=$mach?> <?=$etd?> <?=$eta?> <?=$alterno?>  <?=$altitude?>
  

_________________________________  
         PLANNED FUEL
=================================
FUEL                  TIME   FUEL
=================================
TRIP FUEL             <?=$tripTime?>  <?=$tripFuel?>   
TAXI                  0015  <? if(strlen($taxi_fuel) == 3) echo "0"; if (strlen($taxi_fuel) == 2) echo "00"; ?><?=$taxi_fuel?>   
ALTERNATE             <?=$altTime?>  <?=$totalFuelAlt?>         
MFT HOLD ALTN         0030  <?=$hold_fuel?>           
MISSED APP MIN FUEL   0015  <? if(strlen($missFuel) == 3) echo "0"; ?><?=$missFuel?>      
<?php if($origen<>$destino) {?>ROUTE RES  10%        <?=$rRTime?>  <? if(strlen($routeReserve) == 3) echo "0"; ?><?=$routeReserve?> <?php }  ?>
CONT                  <?=$rRCountTime?>  <? if(strlen($routeCont) == 3) echo "0"; if (strlen($routeCont) == 2) echo "00"; ?><?=$routeCont?>                 
EXTRA                 <?=$extraFuelTime?>  <? if(strlen($extraFuel) == 3) echo "0"; ?><?=$extraFuel?>             <!-- TOTAL RESERVES        <?//=$totalReserveTime?>  <? //if(strlen($totalReserve) == 3) echo "0"; if (strlen($totalReserve) == 2) echo "00"; ?><?//=$totalReserve?>  -->
TAKE OFF FUEL         <?=$endFuelTime?>  <? if(strlen($endFuel) == 3) echo "0"; ?><? if(strlen($endFuel) == 2) echo "00"; ?><?=$endFuel?><? if(strlen($endFuel) == 4) echo " "; ?>   
BLOCK                 <?=$totalFuelTime?>  <?=$totalFuel?><? if(strlen($totalFuel) == 4) echo " "; ?><br>
--------------------------------------------------------------------
NO TANKERING RECOMMENDED (P)
--------------------------------------------------------------------
I HEREWITH CONFIRM THAT I HAVE PERFORMED A THOROUGH SELF BRIEFING
ABOUT THE DESTINATION AND ALTERNATE AIRPORTS OF THIS FLIGHT 
INCLUDING THE APPLICABLE INSTRUMENT APPROACH PROCEDURES, AIRPORT 
FACILITIES, NOTAMS AND ALL OTHER RELEVANT PARTICULAR INFORMATION.

DISPATCHER: MICHAEL PEREZ              PIC NAME: <?=strtoupper($CadenaRecortada2)?>, <?=strtoupper($CadenaRecortada)?>
 
TEL: +57 <?=rand(300, 399)?> <?=rand(1234567, 9999999)?>               PIC SIGNATURE: ...............<br>
--------------------------------------------------------------------

MEL/CDL ITEMS DESCRIPTION
------------- -----------

--------------------------------------------------------------------

ROUTING:

ROUTE ID: DEFRTE
<?=$row1["departure"]?>/<?=$deprwy?> <?=$flproute?> <?=$row1["arrival"]?>/<?=$arrrwy?>

--------------------------------------------------------------------
DEPARTURE ATC CLEARANCE:
.
.
.
--------------------------------------------------------------------<h2 style="page-break-after: always;">&nbsp;</h2><!--BKMK///Times and Weights///1-->--------------------------------------------------------------------
ATIS:
.
.
--------- --------- --------- --------- --------- --------- --------
RVSM: ALT SYS  LEFT:             STBY:             RIGHT:

--------- --------- --------- --------- --------- --------- --------

--------------------------------------------------------------------
                               WEIGHTS
                               -------

      L O A D S H E E T          CHECKED     APPROVED     COMPANY 
=================================================================
ALL WEIGHTS IN KG
PASSENGER STANDARD WEIGHT USED ON LOADSHEET M80/F80/CH30/INF15

FROM TO     FLIGHT   ACTYPE   ACREG   VERSION     CREW     DATE
<?=$row1["departure"]?> <?=$row1["arrival"]?>   <?=$flight?>  <?=$row1["plane_icao"]?>     <?=$row1["registry"]?> <?=strtoupper(gmdate("yMd"))?>     02/<?php $miembros = $row1["crew_members"]-2; if ($miembros<9) { echo '0' . $miembros; } else { echo $miembros; } ?>   <?=strtoupper(gmdate("dMy"))?> 

================================================================
DEST      M/ADL CHLD INF   CABIN     BAGG     CARGO     MAIL
----------------------------------------------------------------
<?=$row1["arrival"]?>        <?=$adult?>   <?=$children?>   <?=$infants?>     <?=$row1["crew_members"]?>       <?=$adult * 80?>     <?=$cargo?>      <?=round($cargo / 100 * 20)?> 
================================================================
BSN/<?=$business?> ECN/<?=$economy?>   TOTAL/<?=$business + $economy?>   SOB/0

                         WEIGHT DISTRIBUTION
================================================================
LOAD IN COMPARTMENTS      <?=$totalTrafficLoad + 100?>     
&INX/+100KG                             
================================================================
PASSENGER/CABIN BAG        <?=($adult + 1) * 80?>   
&INX/+1PAX                             
================================================================
TOTAL TRAFFIC LOAD        <?=$totalTrafficLoad?> 
DRY OPERATING WEIGHT      <?=$row1["DOW"]?> 
ZERO FUEL WEIGHT ACTUAL   <?=$ZFW?> MAX  <?=$row1["mzfw"]?>  ADJ 
TAKE OFF FUEL              <?=$totalFuel - $row1["taxi_fuel"]?> 
TAKE OFF WEIGHT  ACTUAL   <?=$TOW?> MAX  <?=$row1["mtow"]?>    ADJ 
TRIP FUEL                  <?=$tripFuel?>  
LANDING WEIGHT   ACTUAL   <?=$LW?> MAX  <?=$row1["mlw"]?>      ADJ 
================================================================

--------------------------------------------------------------------
                       TERRAIN CLEARANCE CHECK
                       -----------------------
DD CHECK - TERRAIN CLEARANCE CHECK DISABLED

DP CHECK - TERRAIN CLEARANCE CHECK DISABLED
--------------------------------------------------------------------
                          ICAO FLIGHT PLAN                           
                          ----------------                           


(FPL-<?=$flight?>-IS
-<?=$row1["plane_icao"]?>/<?=$row1["equip"]?> 
-<?=$row1["departure"]?><?=$etd?>

-<?=$flproute?>

-<?=$row1["arrival"]?><?=$eta?> <?=$alterno?>

 PBN/<?=$row1["performance"]?>  DOF/<?=date('ymd')?> REG/<?=$row1["registry"]?> OPR/CST RMK/TCAS)<h2 style="page-break-after: always;">&nbsp;</h2><!--BKMK///Additional Info///0--><b>[ Additional Info ]
--------------------------------------------------------------------</b>
D I S P A T C H  B R I E F I N G  I N F O    <?=$letraAleatoria . $letraAleatoria2 . '0' . $numeroAleatorio?>    <?=$row1["departure"]?>/<?=$row1["arrival"]?>

<h2 style="page-break-after: always;">&nbsp;</h2><!--BKMK///Airport WX List///0--><b>[ Airport WX List ]
--------------------------------------------------------------------</b>
<?=$row1["departure"]?> --> <?=$row1["arrival"]?>    <?=$letraAleatoria . $letraAleatoria2?>   <?=$numeroAleatorio?>  / <?=strtoupper(gmdate("dMY"))?>

LIDO/WEATHER SERVICE       DATE : <?=gmdate("dMY")?>   TIME : <?=$timestamp?> UTC

AIRMETs:
  No Wx data available

SIGMETSs:
  No Wx data available

Tropical Cyclone SIGMETs:
  No Wx data available

Volcanic Ash SIGMETs:
  No Wx data available

Departure:
<?php
$webdeparturemetar = 'http://tgftp.nws.noaa.gov/data/observations/metar/stations/'.$row1["departure"].'.TXT';
$file_headers_dep_metar = @get_headers($webdeparturemetar);
if($file_headers_dep_metar[0] <> 'HTTP/1.1 404 Not Found') {
$data_departure_metar = file_get_contents_curl($webdeparturemetar);
echo $data_departure_metar;
echo '<br>';
} else {
	echo "No Metar data available";
	echo '<br>';
}

$webdeparturetaf = 'http://tgftp.nws.noaa.gov/data/forecasts/taf/stations/'.$row1["departure"].'.TXT';
$file_headers_dep_taf = @get_headers($webdeparturetaf);
if($file_headers_dep_taf[0] <> 'HTTP/1.1 404 Not Found') {
$data_departure_taf = file_get_contents_curl($webdeparturetaf);
echo $data_departure_taf;
} else {
	echo "No Taf data available";
	echo '<br>';
}
?>

Destination:
<?php
$webarrivalmetar = 'http://tgftp.nws.noaa.gov/data/observations/metar/stations/'.$row1["arrival"].'.TXT';
$file_headers_arr_metar = @get_headers($webarrivalmetar);
if($file_headers_arr_metar[0] <> 'HTTP/1.1 404 Not Found') {
$data_arrival_metar = file_get_contents_curl($webarrivalmetar);
echo $data_arrival_metar;
echo '<br>';
} else {
	echo "No Metar data available";
	echo '<br>';
}

$webarrivaltaf = 'http://tgftp.nws.noaa.gov/data/forecasts/taf/stations/'.$row1["arrival"].'.TXT';
$file_headers_arr_taf = @get_headers($webarrivaltaf);
if($file_headers_arr_taf[0] <> 'HTTP/1.1 404 Not Found') {
$data_arrival_taf = file_get_contents_curl($webarrivaltaf);
echo $data_arrival_taf;
} else {
	echo "No Taf data available";
	echo '<br>';
}
?>

Destination Alternates:
<?php
$webarrivalmetar_altern = 'http://tgftp.nws.noaa.gov/data/observations/metar/stations/'.$row1["alternative"].'.TXT';
$file_headers_arr_metar_altern = @get_headers($webarrivalmetar_altern);
if($file_headers_arr_metar_altern[0] <> 'HTTP/1.1 404 Not Found') {
$data_arrival_metar_altern = file_get_contents_curl($webarrivalmetar_altern);
echo $data_arrival_metar_altern;
echo '<br>';
} else {
	echo "No Metar data available";
	echo '<br>';
}

$webarrivaltaf_altern = 'http://tgftp.nws.noaa.gov/data/forecasts/taf/stations/'.$row1["alternative"].'.TXT';
$file_headers_arr_taf_altern = @get_headers($webarrivaltaf_altern);
if($file_headers_arr_taf_altern[0] <> 'HTTP/1.1 404 Not Found') {
$data_arrival_taf_altern = file_get_contents_curl($webarrivaltaf_altern);
echo $data_arrival_taf_altern;
} else {
	echo "No Taf data available";
	echo '<br>';
}
?>

  AIRPORTLIST ENDED<h2 style="page-break-after: always;">&nbsp;</h2><!--BKMK///NOTAM///0--><b>[ NOTAM ]
--------------------------------------------------------------------</b>
LIDO-NOTAM-BULLETIN INCLUDES NOTAM, COMP NOTAM AND AIP-REGULATION

<b>=================================
DEPARTURE AIRPORT - DETAILED INFO
=================================</b>

<b><?=$row1["departure"]?>/<?=$iata_codedep?>     <?=str_replace($codes, "", $airportname)?>
-------------------------------</b>

+++++++++++++++++++++++++++++ AIRPORT ++++++++++++++++++++++++++++++

<?php 
$orig = $row1["departure"];
$stream = "http://www.ourairports.com/airports/$orig/notams.rss"; 






function readXML($filename, $limit){
    $file_XML = file_get_contents_curl($filename);
    if (empty($file_XML))
        die("No pudimos conectar");

    preg_match_all("|<item>(.*)</item>|sU", $file_XML, $items);

    $nodes = array();

    foreach ($items[1] as $key => $item) {
        preg_match("|<title>(.*)</title>|s", $item, $title);
        preg_match("|<link>(.*)</link>|s", $item, $link);
        preg_match("|<description>&lt;pre&gt;(.*)&lt;/pre&gt;</description>|s", $item, $description);

        $nodes[$key]['title'] = $title[1];
        $nodes[$key]['link'] = $link[1];
        $nodes[$key]['description'] = $description[1];
    }

    for ($i = 0; $i < $limit; $i++) {
        //echo '<a href="' . $nodes[$i]['link']. '" target="_blank">' . $nodes[$i]['title']. '</a><br>';
		echo $nodes[$i]['title']."<br><br>";
        echo $nodes[$i]['description']."<br><br><br>";
    }
    $archivo_XML = "";
}



readXML($stream, 3);
?> 

<b>===================================
DESTINATION AIRPORT - DETAILED INFO
===================================</b>

<b><?=$row1["arrival"]?>/<?=$iata_codearr?>     <?=str_replace($codes, "", $airportnamearrival)?>
--------------------------</b>

+++++++++++++++++++++++++++++ AIRPORT ++++++++++++++++++++++++++++++

<?php 
$dest = $row1["arrival"];
$stream2 = "http://www.ourairports.com/airports/$dest/notams.rss"; 






function readXML2($filename, $limit){
    $file_XML = file_get_contents_curl($filename);
    if (empty($file_XML))
        die("No pudimos conectar");

    preg_match_all("|<item>(.*)</item>|sU", $file_XML, $items);

    $nodes = array();

    foreach ($items[1] as $key => $item) {
        preg_match("|<title>(.*)</title>|s", $item, $title);
        preg_match("|<link>(.*)</link>|s", $item, $link);
        preg_match("|<description>&lt;pre&gt;(.*)&lt;/pre&gt;</description>|s", $item, $description);

        $nodes[$key]['title'] = $title[1];
        $nodes[$key]['link'] = $link[1];
        $nodes[$key]['description'] = $description[1];
    }

    for ($i = 0; $i < $limit; $i++) {
        //echo '<a href="' . $nodes[$i]['link']. '" target="_blank">' . $nodes[$i]['title']. '</a><br>';
		echo $nodes[$i]['title']."<br><br>";
        echo $nodes[$i]['description']."<br><br><br>";
    }
    $archivo_XML = "";
}



readXML2($stream2, 3);
?> 

<b>================================
DESTINATION ALTERNATE AIRPORT(S)
================================</b>

<b><?=$alterno?>/<?=$iata_codealt?>     <?=str_replace($codes, "", $airportnamealt)?>
----------------------------</b>

+++++++++++++++++++++++++++++ AIRPORT ++++++++++++++++++++++++++++++

<?php 
$alternative = $row1["alternative"];
$stream3 = "http://www.ourairports.com/airports/$alternative/notams.rss"; 






function readXML3($filename, $limit){
    $file_XML = file_get_contents_curl($filename);
    if (empty($file_XML))
        die("No pudimos conectar");

    preg_match_all("|<item>(.*)</item>|sU", $file_XML, $items);

    $nodes = array();

    foreach ($items[1] as $key => $item) {
        preg_match("|<title>(.*)</title>|s", $item, $title);
        preg_match("|<link>(.*)</link>|s", $item, $link);
        preg_match("|<description>&lt;pre&gt;(.*)&lt;/pre&gt;</description>|s", $item, $description);

        $nodes[$key]['title'] = $title[1];
        $nodes[$key]['link'] = $link[1];
        $nodes[$key]['description'] = $description[1];
    }

    for ($i = 0; $i < $limit; $i++) {
        //echo '<a href="' . $nodes[$i]['link']. '" target="_blank">' . $nodes[$i]['title']. '</a><br>';
		echo $nodes[$i]['title']."<br><br>";
        echo $nodes[$i]['description']."<br><br><br>";
    }
    $archivo_XML = "";
}



readXML2($stream3, 3);
?> 
==================== END OF FLIGHT PLAN ====================

COMPUTERIZED FLIGHT PLAN 
COL<b>STAR</b> ALLIANCE VA
</pre>
</div>

	<?php } 
	
	}
	?>
	
		 </div>
	 
	 </section>