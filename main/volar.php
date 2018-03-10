
<?php

	require('./check_login.php');
    require('./db_login.php'); 

    $host= str_replace(".","",strtoupper($_SERVER["HTTP_HOST"]));
	$horas = ($gva_hourse + $transfered_hours);
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
    $db->query("SET SQL_BIG_SELECTS=1");  //Set it before your main query
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sqlrank = "select * from ranks where rank_id='$rank_id'";

	if (!$resultrank = $db->query($sqlrank)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank = $resultrank->fetch_assoc()) {
			$rank_idnew = $rowrank["maximum_hours"];
	}
	
	//////////////////////// PORCENTAJE
	$sql_per = "select * from va_parameters where va_parameters_id='1'";

	if (!$result_per = $db->query($sql_per)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($row_per = $result_per->fetch_assoc()) {
			$porcentaje = $row_per["percentage_test_rank"];
	}
	
	
	$intervalos = $rank_idnew*($porcentaje/100);
	///////////////////////////////////////////
	
	$sqltest = "select * from courses inner join ranktypes_course where courses.course_id=ranktypes_course.course_id and ranktypes_course.rank_id='$rank_id'";

	if (!$resultest = $db->query($sqltest)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowtest = $resultest->fetch_assoc()) {
	    $course_id = $rowtest['course_id'];
		$contartest=0;
		////////////////////////// SABER CUANTOS EXAMENES EXISTEN /////////////////
			$sqltest20 = "select * from config_examen where course_id='$course_id'";

	    if (!$resultest20 = $db->query($sqltest20)) {

		die('There was an error running the query [' . $db->error . ']');

	    }
		
		while ($rowtest20 = $resultest20->fetch_assoc()) {
			$contartest++;
		}
			
			///////////////////////// FIN /////////////////////////////////
		
		/////////////////////////// CONTAMOS LOS EXAMANES
		$sqltest2 = "select * from config_examen where course_id='$course_id'";

	    if (!$resultest2 = $db->query($sqltest2)) {

		die('There was an error running the query [' . $db->error . ']');

	    }
		
		while ($rowtest2 = $resultest2->fetch_assoc()) {
			
			
			
			$idexamen = $rowtest2['id'];
			$contarexamenes=0;
			//////////////// VALIDAMOS SI USUARIO PRESENTO Y GANÓ ESTE EXAMEN //////////////////
			
			$sqltest3 = "select * from training where examen='$idexamen' and gvauser_id=$id and nota>=3";

	    if (!$resultest3 = $db->query($sqltest3)) {

		die('There was an error running the query [' . $db->error . ']');

	    }
		
		while ($rowtest3 = $resultest3->fetch_assoc()) {
			$contarexamenes=$contarexamenes+1;
		}
			
			
			
			
			
			////////////////// FINALIZAR VALIDACION /////////////
			
			
		}
	
	    //////////////////////////////// FIN
	
	}
	
	/////////////////////////////////////////////////////////////////
	
	if(($horas>=$intervalos) && ($contartest>0) && ($contartest<>$contarexamenes)) {
		
		?>
		
		<script>
alert('<?php echo NO_ALLOW_FLY; ?>');
window.location = './index_user.php?page=center_training';
</script>

<?php
		
		
		
	} else {
		
		
		
		
		
		
	
		
		
		
		
		

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


	
	?>
	
	
	<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo YOUR_FLIGHT; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_YOUR_FLIGHT; ?></font></h3>

</section>






		<section class="contact">
			<div class="container">
			
			<?php


while ($row1 = $result1->fetch_assoc()) {
	
	
	$operator_idp = $row1["operator_id"];
$sql_operator_globals ="select * from operators where operator_id=$operator_idp";

	if (!$result_operator_globals = $db->query($sql_operator_globals)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row_operators = $result_operator_globals->fetch_assoc()) {
	
	
		$operator_name = strtoupper($row_operators["operator"]);
		$operator_iata	= $row_operators["iata"];
		$operator_icao	= $row_operators["callsign"];
	}


// VERIFICACION CALLSIGN
	$sql2mas = "select * from reserves re where re.gvauser_id=$id";
	if (!$result2mas = $db->query($sql2mas)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row2mas = $result2mas->fetch_assoc()) {
		$fecha_inicio	 = $row2mas["fecha_inicio"];
		$callsignaltern = $row2mas["callsign_alterno"];
		$alterno_landing = $row2mas["alterno_landing"];
		$cstpirepid = $row2mas["id"];
		$airport_altern = $row2mas["airport_altern"];
	}
	
	
	

		$vuelocall = $callsignaltern;
		
		
		

$locationas = $row1["departure"]; 
$locationa = $row1["arrival"]; 

		
		
		
		
$sql3 = "SELECT * FROM airports  where ident='$location'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

	}



$sql4 = "SELECT * FROM airports  where ident='$locationa'";

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

                        $flttime = $row1["duration"];

                        $dist = $kms;
			$speed = 440;
			$app = $speed / 60 ;
			

			
			
     $distnm = round($kms*$nms);

$flttime = round($distnm / $app,0)+ 20;
			$hours = intval($flttime / 60);
                        $minutes = (($flttime / 60) - $hours) * 60;
                       

	
	?>
	


		<style>


.tg  {border-collapse:collapse;border-spacing:0;
border-radius: 10px 10px 0px 0px;
-moz-border-radius: 10px 10px 0px 0px;
-webkit-border-radius: 10px 10px 0px 0px;
border: 0px solid #000000;
}



#caja {
background-color: #2d3b45;
height: 40px;
/*para Firefox*/
-moz-border-radius: 15px 15px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 15px 15px 0px 0px;
/* para Opera */
border-radius: 15px 15px 0px 0px;
padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
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
-moz-border-radius: 0px 0px 15px 15px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 15px 15px;
/* para Opera */
border-radius: 0px 0px 15px 15px;
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




  	
   
       				<div class="tg" >
                        <div class="panel-heading" id="caja">
                            <strong style="font-size: 26px;color: white;"><i class="fa fa-barcode fa-fw"></i> <?php if ($callsignaltern=="") {
		echo $row1["flight"];
	} else {
		echo $callsignaltern;
	} ?> | IVAO Acars<span class="pull-right"><i class="fa fa-plane fa-fw"></i><?php echo '<b>' . $row1["plane_icao"] . '</b> (' . $row1["plane_description"] . ' | ' . $row1["selcal"] . ')'; ?></span></strong>
                        </div>
						<div  id="caja1">
</div>
                        <div class="panel-body" style="background-color:#F2F2F2;">
                          <br>
                          <br>
						  <center>
                            
                        <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" style="undefined;table-layout: fixed; width: 971px" class="table table-hover">
<colgroup>
<col style="width: 66px">
<col style="width: 100px">
<col style="width: 99px">
<col style="width: 81px">
<col style="width: 106px">
<col style="width: 101px">
<col style="width: 110px">
<col style="width: 127px">
<col style="width: 181px">
</colgroup>
  <tr>
    <th class="tg-031e" colspan="6">
	<?php if($fecha_inicio=="0000-00-00 00:00:00") { ?>
	
		<form class="form-horizontal" id="change-location-form" action="./index_user.php?page=initfpl"
				      role="form" method="post">
					  <input type="hidden" name="vid" value="<?php echo $ivaovid; ?>">    
					  <input type="hidden" name="route" value="<?php echo $vuelocall; ?>">    
					  <input type="hidden" name="registry" value="<?php echo $row1["registry"]; ?>">    
					  <input type="hidden" name="route_id" value="<?php echo $route_id; ?>">    
					  <label><?php echo AIRPORT_ALTERN_ASK; ?></label>
					  <input class="form-control" type="text" name="airport_altern" maxlength="4" value="<?php echo $row1["alternative"]; ?>">   
					  <input type="hidden" name="airplane" value="<?php echo $row1["plane_icao"]; ?>">    
			<button type="submit"
							        class="btn btn-block btn-success"><i class="icon-Plane"></i>  <?php echo START_FLIGHT; ?></button>
					
					</form>
	<?php } else {
		?>
		<form class="form-horizontal" id="change-location-form" action="./index_user.php?page=cstreportar"
				      role="form" method="post">
					  <input type="hidden" name="vid" value="<?php echo $ivaovid; ?>">    
					  <input type="hidden" name="route" value="<?php echo $vuelocall; ?>">    
					  <input type="hidden" name="registry" value="<?php echo $row1["registry"]; ?>">    
					  <input type="hidden" name="route_id" value="<?php echo $route_id; ?>">    
					  <input type="hidden" name="airplane" value="<?php echo $row1["plane_icao"]; ?>">    
			<button type="submit"
							        class="btn btn-block btn-warning"><i class="icon-Plane"></i> <?php echo REPORT_FLIGHT; ?></button>
					
					</form>
				
		<?php
		
	}
	?>
					
					</th>
					<?php
					
						
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

 foreach ($pilots as $pilot) {
		
$callsign2 = $pilot[0];
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

	
if($callsign2==$vuelocall & $vid==$ivaovid)		{
			
			$salida=$pilot[11];
			$llegada=$pilot[13];
			
			$name=$pilot[2];
			$gs=$pilot[8];
			$altitude=$pilot[7];
			$departure=$pilot[11];
			$arrival=$pilot[13];
			$latitude=$pilot[5];	
			$longitude=$pilot[6];	
			$heading=$pilot[45];	
            $plane_type=$aeronave;
            $callsign_vuelo = $pilot[0];
            $fpl=$pilot[30];
            $rmks=$pilot[29];	
			
			
			$groundspeed = $pilot[8];	
			
			
		
			
			
			
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
			
			$flight["pending_nm"]= $totaldistance;
$status = '';
$percent = '';
						$percent = round(($distnm/$distnms)*100);		
			
		
		
			// PORCENTAJE 
			
			if  ($percent>=70){
							$bar='label label-success';
						}
						else if ($percent<=70 || $percent>=35 )

						{ $bar='label label-warning'; }

						if ($percent<35  ) {

							$bar='label label-danger';
						}
							
							
		
		if ($percent<0) {
			
			$porcentaje = "0";
		} else {
			
			$porcentaje= $percent;
		}
						
					// ESTADO	
						
			
				if($pilot[46]==0) {
$status = FLYING;
								
if (($percent >= 0) && ($percent <= 2)) {
$status = TAKE_OFF;
} 

if (($percent >= 2) && ($percent <= 7)) {
$status = GOING_UP;
 } 

if (($percent >= 7) && ($percent <= 10)) {
 $status = CLIMB;
}

if (($percent >= 10) && ($percent <= 80)) {
$status = ON_ROUTE;
} 

if (($percent >= 80) && ($percent <= 90)) {
$status = DESCENDING;
} 

if (($percent >= 90) && ($percent <= 97)) {
$status = START_APP;
}
  
if (((97 <= $percent) && ($percent <= 105)) && ((360 >= $groundspeed) && ($groundspeed >= 30))) {
$status = FINAL_APP;
}



						} else {
$status = ON_GROUND;


if (((0 < $groundspeed) && ($groundspeed <= 30)) && ($percent < 5)){
$status = TAXIING;
}

if (($groundspeed  > 30) && ($groundspeed  < 150) && ($percent < 5)) {
$status = TOOK_OFF;
}
                        
if (((97 <= $percent) && ($percent <= 105)) && ((270 >= $groundspeed) && ($groundspeed >= 30))) {
$status = LANDED;
}

if (($groundspeed < 30) && ($percent > 95)) {
$status = TAXIING_GATE;
}
                        
if (($groundspeed == 0) && ($percent > 95)) {
$status = ON_BLOCKS;
}
                        
if (($groundspeed == 0) && ($percent <= 5)) {
$status = BOARDING;
}
                        
if (($airport_altern<>'') && ($alterno_landing==1)) {
$status = APT_ALTERN;
}
						}
}
 }
			

?>
    <th class="tg-yw4l" colspan="3"><b>ColStar Alliance System</b></th>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="2"><b><?php echo BOOK_ROUTE_DEPARTURE; ?>:</b> <?php echo $row1["departure"]; ?> &rarr; ✈</td>
	 <?php if($alterno_landing==0) {
							  ?> 
							  <td class="tg-yw4l" colspan="2"><b><?php echo BOOK_ROUTE_ARRIVAL; ?>:</b> ✈ &rarr; <?php echo $row1["arrival"]; ?></td><?php
						  } else if($alterno_landing==1) {
							  ?> 
<td class="tg-yw4l" colspan="2"><b><?php echo BOOK_ROUTE_ARRIVAL; ?>:</b> ✈ &rarr; <?php echo $airport_altern; ?></td>							  <?php
						  }
						  ?>
    
    <td class="tg-yw4l" colspan="2"><?php echo $row1["plane_icao"]; ?></td>
    <td class="tg-yw4l" colspan="2"><i class="i i-clock i-2x text-warning-lter"></i> <b><?php echo ESTIMATED; ?>:</b> <?php echo $hours . ' hr ' . $minutes . ' min'; ?></td>
    <td class="tg-yw4l"><i class="fa fa-th-large"></i> <?php echo $distnm; ?>NM</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="6"><?php $numero  = $row1["plane_icao"];
if ($numero == "C172") {
    echo "OPR/" . $operator_name . "/" . $operator_iata . "/" . $operator_icao . " REG/" . $row1["registry"] . " PER/C LIC/" . $callsign . "/RMK/WWW" . $host . "/TRAINING";
} else {
    echo "OPR/" . $operator_name . "/" . $operator_iata . "/" . $operator_icao . " REG/" . $row1["registry"] . " PER/C LIC/" . $callsign . "/RMK/WWW" . $host . "/";
} ?></td>
    <td class="tg-yw4l" colspan="3"><em><?php if($fecha_inicio=="0000-00-00 00:00:00") { echo NO_ONLINE;  } else { echo '<span class="' . $bar . '">' . $status . '</span>';  }?></em></td>
  </tr>
</table>

						</center>
	                      <hr>
						  <?php if($fecha_inicio<>"0000-00-00 00:00:00") { ?>
						  <?php if($alterno_landing==0) {
							  ?> <a href="./index_user.php?page=alternovolando&id=<?php echo $cstpirepid; ?>" class="btn btn-block btn-danger"><i class="icon-Plane"></i> <?php echo FLY_TO_ALTERN; ?></a> <?php
						  } else if($alterno_landing==1) {
							  ?> <a href="./index_user.php?page=destinovolando&id=<?php echo $cstpirepid; ?>" class="btn btn-block btn-warning"><i class="icon-Plane"></i> <?php echo FLY_TO_DESTINATION; ?></a> <?php
						  }
						  ?>
							  
						  <?php } ?>
		                  <div class="container">
                          <br>
						  <hr>
						  <br>	

                                <?php if($fecha_inicio=="0000-00-00 00:00:00") { ?>
										<h3><font color="#890606"><?php echo REMEMBER_FLY; ?></font></h3>
										<p><?php echo DETAIL_REMEMBER_FLY; ?><br>
										<li>ICAO <?php echo PIREP_PLANE; ?>: <b><?php echo $row1["plane_icao"]; ?></b></li>
										<li><?php echo PIREP_DEPARTURE; ?>: <b><?php echo $row1["departure"]; ?></b></li>
										<li><?php echo PIREP_ARRIVAL; ?>: <b><?php echo $row1["arrival"]; ?></b></li>
										<li><?php echo LAST_DETAIL_FLY; ?>.</li>
										</p>
								<?php } else { ?>
										<h3><font color="#890606"><?php echo REMEMBER_FLY; ?></font></h3>
										<p><b><?php echo PIREP_FLIGHT_SEND; ?>:</b><br>
										<li><?php echo SUGGESTION_ONE; ?></li>
										<li><?php echo SUGGESTION_TWO; ?>.</li>
										<li><?php echo SUGGESTION_THREE; ?></li>
										<p><b><?php echo SUGGESTION_FOUR; ?></b></p>
										<li><?php echo SUGGESTION_FIVE; ?></li>
										</p>
								<?php
									
								}
								?>
								<br>
								</div>	
							
                        </div>
						

					<div  id="caja4">
</div>

<div  id="caja3">
</div>		
		
							
                    </div>
                
                    
   	<br>
	
	<hr>
	<br>
	
	

	
	<div class="tg" >
                        <div class="panel-heading" id="caja">
                            <strong style="font-size: 26px;color: white;"><i class="fa fa-barcode fa-fw"></i><?php echo $TITLETRES; ?> <?php if ($callsignaltern=="") {
		echo $row1["flight"];
	} else {
		echo $callsignaltern;
	} ?> <span class="pull-right"><i class="fa fa-plane fa-fw"></i><?php echo '<b>' . $row1["plane_icao"] . '</b> (' . $row1["plane_description"] . ' | ' . $row1["selcal"] . ')'; ?></span></strong>
                        </div>
						<div  id="caja1">
</div>
                        <div class="panel-body" style="background-color:#F2F2F2;">
 
<table id="table_list"  width="100%" border="0" class="table table-hover">
																	
                                       
										 <tbody>



<?php
echo '<form action="./index_user.php?page=dispatch" method="post">';
echo '<thead>
                                              <tr>
												<th><b>' . BOOK_ROUTE_FLIGHT . '</b></th>
												<th><b>' . BOOK_ROUTE_CANCEL . '</b></th>
                                            </tr>
											
                                        </thead>';

echo "<tbody><td>";
$operator_idp = $row1["operator_id"];
$sql_operator_globals ="select * from operators where operator_id=$operator_idp";

	if (!$result_operator_globals = $db->query($sql_operator_globals)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row_operators = $result_operator_globals->fetch_assoc()) {
	
	
		$name_operator = $row_operators["operator"];
				
	}
	
	

if ($callsignaltern=="") {
		echo '<b>' . $name_operator . ' :: ' . $row1["flight"]. '</b></td><td>';
	} else {
		echo '<b>' . $name_operator . ' :: ' . $callsignaltern. '</b></td><td>';
	}
	

echo '<a class="btn btn--icon bg--pinterest" href="./index_user.php?page=cancel_reserve&route=' . $route . '&plane=' . $row1["fleet_id"] . '">
	<span class="btn__text" style="width:100%"><i class="icon-Danger"></i>' . BOOK_ROUTE_FLIGHT . ' ' . BOOK_ROUTE_CANCEL . '</span>
</a>
</td></tbody><tr>';


echo "<thead><tr><th><b>" . BOOK_ROUTE_DEPARTURE . "</b></th><th><b>" . BOOK_ROUTE_ARRIVAL . "</b></th></tr></thead>";
echo "<td>";

echo $row1["departure"] . ' ' . '(' . $row1["etd"]  . '&nbsp<i class="fa fa-clock-o"></i>' . ')';
echo '<br>';

// Get Location info details

	$sql6 = "SELECT * FROM airports  where ident='$locationas'";

	if (!$result6 = $db->query($sql6)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6 = $result6->fetch_assoc()) {

		$location_airport_namesssls = $row6['name'];

		$location_airport_flagsssls = $row6['iso_country'];

echo '<img src="./images/flags/24/' . $location_airport_flagsssls . '.png" alt="' . $location_airport_flagsssls . '">';

                                                                        
						                         echo '<font size="2">&nbsp;'. $location_airport_namesssls .'</font>';
												 echo '<br><img src="http://status.ivao.aero/ATC/' . $locationas . '.png" alt="' . $locationas . '">';
												 
												 
												 echo '<br><br>';
												 
												 echo '<p><b>Dep Rwy</b></p>';
												 echo '<select class="form-control" id="deprwy" name="deprwy">';

$pista1 ="select * from NavAPTs where NavAPT_ICAO='$location'";

	if (!$resultpista1 = $db->query($pista1)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($pistaop1 = $resultpista1->fetch_assoc()) {
	
	echo '<option value="' . $pistaop1['NavAPT_RWY'] . '">' . $pistaop1['NavAPT_RWY'] . '</option>';
			
	}
	
	
	echo '</select>';
	
	
echo '</td><td>';

	}





echo $row1["arrival"] . ' ' . '(' . $row1["eta"]  . '&nbsp<i class="fa fa-clock-o"></i>' . ')';
echo '<br>';




// Get Location info details

	$sql5 = "SELECT * FROM airports  where ident='$locationa'";

	if (!$result5 = $db->query($sql5)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row5 = $result5->fetch_assoc()) {

		$location_airport_namesssl = $row5['name'];

		$location_airport_flagsssl = $row5['iso_country'];

echo '<img src="./images/flags/24/' . $location_airport_flagsssl . '.png" alt="' . $location_airport_flagsssl . '">';

                                                                       
						                         echo '<font size="2">&nbsp;'. $location_airport_namesssl .'</font>';
												 echo '<br><img src="http://status.ivao.aero/ATC/' . $locationa . '.png" alt="' . $locationa . '">';
												  echo '<br><br>';
												 
												 echo '<p><b>Arr Rwy</b></p>';
												 echo '<select class="form-control" id="arrrwy" name="arrrwy">';

$pista ="select * from NavAPTs where NavAPT_ICAO='$locationa'";

	if (!$resultpista = $db->query($pista)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($pistaop = $resultpista->fetch_assoc()) {
	
	echo '<option value="' . $pistaop['NavAPT_RWY'] . '">' . $pistaop['NavAPT_RWY'] . '</option>';
			
	}
	
	
	echo '</select>';
	
	
echo '</td><td>';

	}

echo "<tr></tr>";
echo "<td>";
echo '<a href="https://pilotweb.nas.faa.gov/PilotWeb/notamRetrievalByICAOAction.do?method=displayByICAOs&reportType=RAW&formatType=DOMESTIC&retrieveLocId=' . $row1["departure"] . '&actionType=notamRetrievalByICAOs">Click to view NOTAMS</a></td><td>';  

echo '<a href="https://pilotweb.nas.faa.gov/PilotWeb/notamRetrievalByICAOAction.do?method=displayByICAOs&reportType=RAW&formatType=DOMESTIC&retrieveLocId=' . $row1["arrival"] . '&actionType=notamRetrievalByICAOs">Click to view NOTAMS</a></td><td>'; 
echo "</td>";



echo "<thead><tr><th colspan=2><b>" . BOOK_ROUTE_ROUTE . "</b></th></tr></thead>";
echo "<td colspan=2>";
echo '<input type="text" class="form-control" name="flproute" value="' . $row1["flproute"] . '">';

echo '</td>';



	
	
	
	

echo "<thead colspan><tr><th><b>" . REMARKS . "</b></th><th></th></tr></thead>";
echo "<td colspan='2'>";
$numero  = $row1["plane_icao"];

if ($numero == "C172") {
    echo "OPR/" . $operator_name . "/" . $operator_iata . "/" . $operator_icao . " REG/" . $row1["registry"] . " PER/C LIC/" . $callsign . "/RMK/WWW" . $host . "/TRAINING";
} else {
    echo "OPR/" . $operator_name . "/" . $operator_iata . "/" . $operator_icao . " REG/" . $row1["registry"] . " PER/C LIC/" . $callsign . "/RMK/WWW" . $host . "/";
}

echo '</td><td>';  
echo "</td>";







echo "<thead><tr><th><b> PASSENGERS </b></th><th> <b>CARGO</b> </th></tr></thead>";
echo "<td>";
while ($row2 = $result2->fetch_assoc()) {
$pax = $row2['pax'];	
$cargo = $row2['cargo'];	
echo $pax;
echo "</td><td>";

//echo $cargo . ' Kg<BR>';
//$lb = round($cargo* 2.2046);
						//echo $lb.' Lb';
						
						echo $cargo.' Kg';
    echo "</td>";

	}


echo "<thead><tr><th><b>" . BOOK_ROUTE_ARICRAFT_TYPE . "</b></th><th><b>" . BOOK_ROUTE_ARICRAFT_REG . "</b></th></tr></thead>";
echo "<td>";
echo $row1["plane_icao"] . '</td><td>';
echo $row1["registry"] . '</td><td>';

echo "<thead><tr><th><b>" . DEPARTURE_METAR . "</b></th><th><b>" . ARRIVAL_METAR . "</b></th></tr></thead>";
echo "<tr></tr>";
echo "<td>";

$filecontentsmetar2 = file_get_contents('http://wx.ivao.aero/metar.php');
$rowsmetar2 = explode("\n", $filecontentsmetar2);
foreach ($rowsmetar2 as $rowmetar2) {

	$fieldsmetar2 = explode(" ", $rowmetar2);
	
if ($fieldsmetar2[0]==$row1["departure"]) {
	
echo $metar2 = $rowmetar2;
}
}


echo '</td><td>';  


$filecontentsmetar = file_get_contents('http://wx.ivao.aero/metar.php');
$rowsmetar = explode("\n", $filecontentsmetar);
foreach ($rowsmetar as $rowmetar) {

	$fieldsmetar = explode(" ", $rowmetar);
	
if ($fieldsmetar[0]==$row1["arrival"]) {
	
echo $metar = $rowmetar;
}
}

echo '</td><td>'; 
echo "</td>";
echo "<td>";



echo "<br>";
echo "<br>";

$numera  = $row1["plane_icao"];



		


echo "<thead><tr><th><b>Distancia | Distance</b></th><th><b>Mapa | Map</b></tr></thead>";
echo "<tr></tr>";
echo "<td>";
echo $distnm . ' NM';
echo '<br><br>';
echo '<p><b>Altitude ft</b></p>';
echo '<input type="number" class="form-control" name="altitude" id="altitude" value="' .  $row1["altitude"] . '">';
echo '<br><br>';
echo '<p><b>Velocidad Crucero Knots</b></p>';
echo '<input type="number" class="form-control" name="speed" id="speed" value="0">';
echo '<br><br>';
echo '<p><b>Combustible Extra KG</b></p>';
echo '<input type="number" class="form-control" name="extra" id="extra" value="0">';
echo '</td><td><iframe src="maproute.php?route_id=' . $route_id . '" width="540px" height="540px"></iframe></td>';





    
echo "<thead><tr><th> <b>" . PROIF . "</b></th><th></th></tr></thead>";
echo "<thead><tr><th><b>" . DEPARTURE_CHART .  $row1["departure"] . "</b></th><th><b>" . ARRIVAL_CHART . $row1["arrival"]  . "</b></th></tr></thead>";


echo "<tr></tr>";
echo "<td>";
echo '<a href="./images/chart/' . $row1["departure"] . '.jpg" target="_blank">
			<img border="0" src="./images/chart/' . $row1["departure"] . '.jpg"
				width="387px" height="594px" alt="No chart available" /></a></td><td>';


echo '<a href="./images/chart/' . $row1["arrival"] . '.jpg" target="_blank">
			<img border="0" src="./images/chart/' . $row1["arrival"] . '.jpg"
				width="387px" height="594px" alt="No chart available" /></a></td><td>';


//echo "<thead colspan='2'><tr><th>Clima | Weather " .  $row1["departure"] . "</th></tr></thead>";	

//echo '<td colspan="2">
//<iframe src="https://www.windytv.com/' .  $row1["departure"] . '?' .  $latitude_deg_loc  . ',' . $longitude_deg_loc . '" height="650" width="100%" scrolling="auto" sandbox="allow-same-origin allow-scripts" style="border:none;"></iframe></td>';

//echo "<thead colspan='2'><tr><th>Clima | Weather " .  $row1["arrival"]  . "</th></tr></thead>";	
//echo '<td colspan="2">
//<iframe src="https://www.windytv.com/' . $row1["arrival"] . '?' . $latitude_deg_arr . ',' . $longitude_deg_arr . '" height="650" width="100%" scrolling="auto" sandbox="allow-same-origin allow-scripts" style="border:none;"></iframe></td><td>';


				
		

$callsigns = $row1["flight"];
	$resultado = substr($callsigns, 0, 3);
	$resultados = substr($callsigns, 3);
				
				echo "<thead><tr><th> <b>CST Despacho | CST Dispatch</b></th><th></th></tr></thead>";
				
				
echo "<tr></tr>";
echo "<td colspan=2>";

//echo '<a class="btn btn-block btn-success" href="./index_user.php?page=dispatch" style="font-size:15px">Generate Dispatch</a>';
echo '<button type="submit" class="btn btn-block btn-success" style="width:100%;"><i class="icon-Plane"></i> Generate Dispatch ColStar VA</button>';
echo '</form>';

?>
<br>
<br>
<ul class="accordion accordion-1">
	<li>
		<div class="accordion__title">
			<span class="h5"><i class="icon-Plane"></i> Simbrief Dispatch</span>
		</div>
		<div class="accordion__content" >
			<form id="sbapiform" name="ColStarAlliance" style="width:100%;">





       <?php $planedata=$row1["plane_icao"];?>
       <input type="hidden" name="type" size="5" type="text" placeholder="ZZZZ"  value="<?php echo $row1["plane_icao"];?>">
    
 
       <input type="hidden" name="orig" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo $row1["departure"]; ?>">
       
       <input type="hidden" name="dest" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo $row1["arrival"]; ?>">
	   
	   <input type="hidden" name="altn" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo $airport_altern; ?>">
	   
	   <input type="hidden" name="cpt" size="5" type="text" placeholder="ZZZZ"  value="<?php echo $pilotname . ' ' . $pilotsurname; ?>">
	   
	   <input type="hidden" name="pid" type="text"  value="<?php echo $callsign; ?>">
     
       
        
        


<input type="hidden" name="airline" value="<?php echo $resultado; ?>"> 
<br>


<input type="hidden" name="fltnum" value="<?php echo $resultados; ?>"> 

<?php $today = date("dMy");?>

<input type="hidden" name="date" value="<?php echo $today?>"> 

<?php $deptimes = explode(":", $row1["etd"]); ?>

<input type="hidden" name="deph" value="<?php echo $deptimes[0]?>">
<input type="hidden" name="depm" value="<?php echo $deptimes[1]?>">    

<?php $arrtimes = explode(":", $row1["eta"]); ?>

<input type="hidden" name="steh" value="<?php echo $arrtimes[0]?>">
<input type="hidden" name="stem" value="<?php echo $arrtimes[1]?>">



<input type="hidden" name="reg" value="<?php echo $row1["registry"]; ?>">    
<input type="hidden" name="pax" value="<?php echo $pax; ?>">  

<? $milescarga = $cargo/1000;
   $cargamento = round($milescarga,1);
   ?>
<input type="hidden" name="cargo" value="<?php echo $cargamento; ?>">  
<?php
      echo '<p><b>Flp Route</b> ' . $location . ' to ' . $locationa . '</p>';
	 echo '<input type="text" class="form-control" name="route" value="' . $row1["flproute"]. '" style="width:100%;">';
	 echo '<br><br>';
	 
	 echo '<p><b>Dep Rwy</b> ' . $location . '</p>';
	echo '<div class="input-select"><select class="form-control" id="origrwy" name="origrwy" style="width:100%;">';

$pista1 ="select * from NavAPTs where NavAPT_ICAO='$location'";

	if (!$resultpista1 = $db->query($pista1)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($pistaop1 = $resultpista1->fetch_assoc()) {
	
	echo '<option value="' . $pistaop1['NavAPT_RWY'] . '">' . $pistaop1['NavAPT_RWY'] . '</option>';
			
	}
	
	
	echo '</select></div>';
	echo '<br><br>';
	
	
	echo '<p><b>Arr Rwy</b> ' . $locationa . '</p>';
	echo '<div class="input-select"><select class="form-control" id="destrwy" name="destrwy" style="width:100%;">';

$pista ="select * from NavAPTs where NavAPT_ICAO='$locationa'";

	if (!$resultpista = $db->query($pista)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($pistaop = $resultpista->fetch_assoc()) {
	
	echo '<option value="' . $pistaop['NavAPT_RWY'] . '">' . $pistaop['NavAPT_RWY'] . '</option>';
			
	}
	
	
	echo '</select></div>';

?>
<input type="hidden" name="navlog" value="1"> 
<input type="hidden" name="selcal" value="<?php echo $row1["selcal"]; ?>">    
<input type="hidden" name="units" value="KG">
<input type="hidden" name="navlog" value="True">
<input type="hidden" name="etops" value="True">
<input type="hidden" name="stepclimbs" value="True">
<input type="hidden" name="tlr" value="True">
<input type="hidden" name="notams" value="True">
<input type="hidden" name="firnot" value="True">
<input type="hidden" name="maps" value="Detailed">
<input type="hidden" name="planformat" value="lido">

<input type="button" class="btn btn-block btn-success" onclick="simbriefsubmit('./index_user.php?page=colstardispatch');"  value="Generate Simbrief">


</form>

		</div>
	</li>
</ul>   

<?

echo "</td><td></td>";
} 

            

?>
</tbody>

			</table>
			</div>
			<div  id="caja4">
</div>

<div  id="caja3">
</div>		
		
							
                    </div>
</div>





			<?php
				}
				else
				{
					
					
	$aeronave_post = $_POST['aeronave'];
	$destino_post = $_POST['destino'];
	$millas_post = $_POST['distancia'];
	$aerolinea_post = $_POST['aerolinea'];
	$typeflight = $_POST['typeflight'];
	
	if (!empty($aeronave_post)) {
		
		$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id,alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location  and f.fleettype_id =$aeronave_post
						inner join routes r on r.departure = f.location
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id 
						inner join fleettypes_gvausers ftu on ftu.fleettype_id =$aeronave_post
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id =$aeronave_post
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id";
						
	} else if (!empty($destino_post)) {
		
		$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id,alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location and r.arrival='$destino_post'
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id 
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id";
						
	} else if (!empty($millas_post)) {
		
		$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id, alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location and r.distance<=$millas_post
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id  
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id";
						
	} else if (!empty($aerolinea_post)) {
		
		$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id,alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location and r.operator_id='$aerolinea_post'
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id  
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id";
						
	} else if (!empty($typeflight)) {
		
		if($typeflight==1) {
			$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id,alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id 
						inner join airports airpt on airpt.ident = r.departure 
						inner join airports airpt2 on airpt2.ident = r.arrival 
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id and airpt.iso_country=airpt2.iso_country";
		} else if ($typeflight==2) {
			$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id,alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id 
						inner join airports airpt on airpt.ident = r.departure 
						inner join airports airpt2 on airpt2.ident = r.arrival 
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id and airpt.iso_country<>airpt2.iso_country";
		}
		
						
	}
	
	
	if (empty($millas_post) && empty($destino_post) && empty($aeronave_post) && empty($aerolinea_post) && empty($typeflight)) {
		
				$sql23 = "select distinct r.route_id as route, flight,r.departure,r.arrival, r.operator_id, r.flighttype_id,alternative,etd,eta,duration from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id 
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id";
						
	}

				if (!$result23 = $db->query($sql23)) {
					die('There was an error running the query [' . $db->error . ']');
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
    
	<h1><font color="white"><?php echo OPTIONS_FLIGHT; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo SCHEDULE_FINALLY; ?></font></h3>

</section>






		<section class="contact">
			<div class="container">
			
						
						<!-- Table -->
						<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo BOOK_ROUTE_FLIGHT; ?></b></th>
												<th><b><?php echo AIRLINE_SCHEDULE; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_DEPARTURE; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ARRIVAL; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_ALTERNATIVE; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_DURATION; ?></b></th>
												<th><b><?php echo BOOK_ROUTE_INFORMATION; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
							<?php

						$is = 0;
						
								while ($row23 = $result23->fetch_assoc()) {
									
									$is++;

$sql_flighttype = "SELECT * FROM flighttypes ORDER BY flighttype_id ASC";
							if (!$result_flighttype = $db->query($sql_flighttype)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_flighttype = $result_flighttype->fetch_assoc()) {
							
							if($row_flighttype["flighttype_id"] == $row23["flighttype_id"]) {
							
							
							$flighttype = $row_flighttype["flighttype"];
							
							}
							}






   
									echo '<tr><td><i class="fa fa-th-list"></i>&nbsp;';
                                                                        echo $row23["flight"] . '</a></br><font size="1">' . $flighttype . '</font></td><td>';
								



                                                       $sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row23["operator_id"]) {
							
							
							$img = $row_operator["file"];
							
							}
							

							

}
if ($row23["operator_id"] > 0) {
echo '<img src="../../admin/images/operators/' . $img . '" alt="' . $row23["flight"] . '" height="50px"  widht="100%"></td><td><i class="fa fa-sign-out"></i>&nbsp;';
		} else if ($row23["operator_id"] == 0){
echo '</td><td><i class="fa fa-arrow-sign-out"></i>&nbsp;';

}


									echo $row23["departure"] . ' ' . '(' . $row23["etd"]  . '&nbsp<i class="fa fa-clock-o"></i>' . ')';
                                                                        echo '<br>';  



$locations = $row23["departure"]; 


// Get Location info details

	$sql4 = "SELECT * FROM airports  where ident='$locations'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row4 = $result4->fetch_assoc()) {

		$location_airport_names = $row4['name'];

		$location_airport_flags = $row4['iso_country'];


                                                                        echo '<img src="./images/flags/24/' . $location_airport_flags . '.png" alt="' . $location_airport_flags . '">';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'.$location_airport_names.'</font>';

	}


                                                                        echo '</td><td><i class="fa fa-arrow-circle-down"></i>&nbsp;';


                                                                        echo $row23["arrival"] . ' ' . '(' . $row23["eta"]  . '&nbsp<i class="fa fa-clock-o"></i>' . ')';
                                                                        echo '<br>';  

$location = $row23["arrival"]; 


// Get Location info details

	$sql3 = "SELECT * FROM airports  where ident='$location'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row3 = $result3->fetch_assoc()) {

		$location_airport_namesss = $row3['name'];

		$location_airport_flagsss = $row3['iso_country'];

echo '<img src="./images/flags/24/' . $location_airport_flagsss . '.png" alt="' . $location_airport_flagsss . '">';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'. $location_airport_namesss .'</font>';

	}

                                                         
                                                               

	                                                          
	

									
                                                                        
                                                                        echo '</td><td><i class="fa fa-sign-out"></i>&nbsp;';
									echo $row23["alternative"] . '</td><td><i class="fa fa-clock-o"></i>&nbsp;';
									
									

$sql3 = "SELECT * FROM airports  where ident='$locations'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

	}



$sql4 = "SELECT * FROM airports  where ident='$location'";

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

                        $flttime = $row1["duration"];

                        $dist = $kms;
			$speed = 440;
			$app = $speed / 60 ;



     $distnm = round($kms*$nms);

$flttime = round($distnm / $app,0)+ 20;
			$hours = intval($flttime / 60);
                        $minutes = (($flttime / 60) - $hours) * 60;
						
						
							
							$horas = $hours;
							

						if ($minutes >9) {
							
							$minutess = $minutes;
							
						} else if ($minutes <10) {
							
							$minutess = '0' . $minutes;
						}





echo $horas . ' h ' . $minutess . ' m</td><td>';
                                                                      
									echo '<a href="./index_user.php?page=volar_reservado&route=' . $row23["route"] . '"><span class="flaticon-flight icon icon--sm"></span></a></td></tr>';
								}
								
								
									echo "</table>";
								
								
								
										
								//  Get plane certifications

	$sql5 = "select plane_icao from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id=$id order by plane_icao asc";

	if (!$result5 = $db->query($sql5)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	

	$planes_certificated = array();
$planes_icao = array();
	while ($row5 = $result5->fetch_assoc()) {

		$planes_certificated[] = $row5["fleettype_id"];
	$planes_icao[] = $row5["plane_icao"];
	}
		
		
		
		
		
		
		
		
				
								
								
								if($is == 0) {
									
									//  VER AVIONES
									
										$sql20 = "SELECT * FROM fleets  where location='$location' and hangar=0 and booked=0";

	if (!$result20 = $db->query($sql20)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


  $aviones = 0;

	while ($row20 = $result20->fetch_assoc()) {
		
		if (in_array($row20['fleettype_id'], $planes_certificated)) {
                $aviones++;
			}						
	}
	
	
								
		
		if ($aviones == 0) {
		
		
		echo '<div class="alert alert-danger" role="alert">No se encuentran aeronaves en este disponibles Aeropuerto.</div>';	
		
		}
		
	
	// AERONAVES MANTENIMIENTO
	
	$sql21 = "SELECT * FROM fleets  where location='$location' and hangar=1";

	if (!$result21 = $db->query($sql21)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


 

	while ($row21 = $result21->fetch_assoc()) {
		
		
		
		$registro = $row21["registry"];
		$name = $row21["name"];
									
			echo '<div class="alert alert-success" role="alert">En este aeropuerto, se encuentran las siguientes aeronaves en mantenimiento
			<br>
			<li>' . $name . ' ' . $registro . '</li></div>';
										
									
	}
	
	
	
	
	
	
	
	
							
	
											
								
								
							
								
				}
				
				
				
				
					
								
								
								

		
						
								
								
								}	
								
								
								$db->close();
							?>
						  </tbody></table>
						
					

				<div class="clearfix visible-lg"></div>
			
		</div>

		</section>
	<?php } ?>