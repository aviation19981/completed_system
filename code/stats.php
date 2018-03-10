 <?php
session_start();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "https://" . $host;

	
    if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['language'] = "es";
	}
	
		
	
	
    include("./../main/languages/lang_" . $_SESSION['language'] . ".php");
	
	$aerolinea_id = $_GET['va']; ?>

<!doctype html>
<html lang="en">
  <head>
    <title>ColStar Alliance</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="./../main/images/favicon.ico" type="image/x-icon" rel="icon" />
    
	
	
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="./../main/css/base.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="./../main/css/skeleton.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="./../main/css/layout.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="./../main/css/settings.css" />
	<link rel="stylesheet" type="text/css" media="all" href="./../main/css/owl.carousel.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="./../main/css/retina.css"/>
	<link rel="stylesheet" type="text/css" href="./../main/css/colors/color-blue.css" title="blue">
    <link rel="stylesheet" href="./../main/css/font-awesome.css">
	


	

	
	
	<!-- New
	================================================== -->
	
	<link href="./../main/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/socicon.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/flickity.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/iconsmind.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./../main/css/custom.css" rel="stylesheet" type="text/css" media="all" />
	<link href="./../main/css/planeicon.css" rel="stylesheet" type="text/css" media="all" />
	
	
	<!-- New
	================================================== -->


   <!-- New
	================================================== -->
	
	
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script src="./../main/Charts/Chart.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="./../main/css/bootstrap-datetimepicker.min.css"/>
	<script src="./../main/js/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="./../main/js/moment-with-locales.js"></script>
	<script type="text/javascript" src="./../main/js/bootstrap-datetimepicker.min.js"></script>
	<script src="./../main/js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="./../main/css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/numeric-comma.js"></script>
	<script src="./../main/js/raphael.min.js" type="text/javascript"></script>
	<script src="./../main/js/morris.min.js" type="text/javascript"></script>



 </head>
  <body>

<div class="container">
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las Estadísticas de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">    
			
			
			
			
<?php

include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	
		//  Get va parameters
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$ivao = $row["ivao"];
$admisiones = $row["admisiones"];
	}
	
	$no_count_rejected=0;
	$sql = "select * from va_parameters ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$no_count_rejected = $row["no_count_rejected"];		
	}

	$vuelosactivos=0;
	//  Get count number of pilots
	$sql = "select count(*) num_pilots, operator_id from gvausers where activation=1 and operator_id='$aerolinea_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		
		$num_pilots = $row["num_pilots"];
	

	}
	//  Get count number of planes
	$sql = "select count(*) num_planes, operator_id from fleets where  operator_id='$aerolinea_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_planes = $row["num_planes"];
	}
	//  Get count number of routes
	$sql = "select count(*) num_routes, operator_id from routes where operator_id='$aerolinea_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_routes = $row["num_routes"];
	}
	
	
	
	// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps, operator_id from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and  operator_id='$aerolinea_id'";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowee = $resultee->fetch_assoc()) {

		$num_pireps = $rowee["numpireps"];

	}
	
	
	// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse, operator_id from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and  charter>0 and operator_id='$aerolinea_id'";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowees = $resultees->fetch_assoc()) {

		$charterspireps = $rowees["numpirepse"];

	}	
	


	


	
// INICIO
	
	
	
	
	// select current day
	$sql = " select day(now()) as 'current_day', month(now()) as 'current_month',year(now()) as 'current_year' ; ";
	$current_day;
	$current_month;
	$current_year;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$current_day = $row['current_day'];
		$current_month = $row['current_month'];
		$current_year = $row['current_year'];
	}
	
	
	// Calculation for flights per month current year
	$count_per_month = '';
	for ($i = 1 ; $i <= 12 ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select operator_id, IFNULL(count(id),0) as co from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%m')=$i and operator_id='$aerolinea_id'";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
			
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_month = $count_per_month . "{ Mes: '" . $meses[$i] . "', Vuelos: ". $row2['co'] ." },";
		}
	}
	$diasmes= date("d",mktime(0,0,0,$current_month+1,0,$current_year));
	// Calculation for flights per day current month
	$count_per_day = '';
	for ($i = 1 ; $i <= $diasmes ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select operator_id, IFNULL(count(id),0) as co from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%m')=date_format(now(),'%m') and date_format(fecha_envio,'%d')=$i and operator_id='$aerolinea_id'";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
		
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_day = $count_per_day . "{ day: '".$i."', flights: ".$row2['co']." },";
		}
	}
	
	

	
	
	
// Calculate % by flight duration
	$duration_perc='';
	$duration_array = array();
	$duration_cnt = 0;
	$duration_graph ='';
	$sql = "select connectiontime , SUM(cn) as cnt from (
select '0-1' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))<=1 and operator_id='$aerolinea_id'
union
select '1-2' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>1 and ABS(abs(connection_time))<=2 and operator_id='$aerolinea_id'
union
select '2-3' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>2 and ABS(abs(connection_time))<=3 and operator_id='$aerolinea_id'
union
select '3-4' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>3 and ABS(abs(connection_time))<=4 and operator_id='$aerolinea_id'
union
select '4-5' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>4 and ABS(abs(connection_time))<=5 and operator_id='$aerolinea_id'
union
select '5-6' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>5 and ABS(abs(connection_time))<=6 and operator_id='$aerolinea_id'
union
select '6-7' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>6 and ABS(abs(connection_time))<=7 and operator_id='$aerolinea_id'
union
select '7-8' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>7 and ABS(abs(connection_time))<=8 and operator_id='$aerolinea_id'
union
select '8-9' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>8 and ABS(abs(connection_time))<=9 and operator_id='$aerolinea_id'
union
select '>9' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH((connection_time))>0 and ABS(abs(connection_time))>9 and operator_id='$aerolinea_id') as t group by connectiontime";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$duration_array[$row["connectiontime"]] = $row["cnt"];
		$duration_cnt +=  $row["cnt"];
	}
	if ($duration_cnt>0)
	{
		foreach($duration_array as $key => $value)
		{
			$val = number_format((100 * $value)/$duration_cnt,2);
			if ($val>0)
			{
				$duration_graph = $duration_graph. '{label: "'.$key.' h", value: '.$val.'},';
			}
		}
	}
	
	
	
	
 
 
 // Calculate aircraft used by the pilot
	$perc_aircarft_type_used='';
	$aircarft_type_used_array = array();
	$aircarft_type_used_cnt = 0;
	$sql = "select aircraft , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH(aircraft)>0 and operator_id='$aerolinea_id' group by aircraft";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$aircarft_type_used_array[$row["aircraft"]] = $row["cn"];
		$aircarft_type_used_cnt +=  $row["cn"];
	}
	foreach($aircarft_type_used_array as $key => $value)
	{
		$val = number_format((100 * $value)/$aircarft_type_used_cnt,2);
		$perc_aircarft_type_used = $perc_aircarft_type_used. '{label: "'.$key.'", value: '.$val.'},';
	}
	
	
		//Calculation  per plane type
	$sql = "select  count(*) as c, vp.aircraft as plane_icao from cstpireps vp where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH(aircraft)>0 and vp.operator_id='$aerolinea_id' group by vp.aircraft order by plane_icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$countpanepertype = $countpanepertype . '{label: "'.$row['plane_icao'] .'", value: '.$percplanetype.'},';
	}
	
	
	
	
	
	// Country  stats
	$sql = "select SUM(c) as c, short_name from
(select count(*) as c, short_name
			from cstpireps vp, airports a , country_t c
			where date_format(fecha_envio,'%y')=date_format(now(),'%y') and vp.operator_id='$aerolinea_id' and c.`iso2`=a.`iso_country`  and  vp.departure=a.ident group by short_name  ) as t group by short_name;";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$totalcountry=0;
	$country='';
	$perccountry='';
	$countcountry='';
	while ($row = $result->fetch_assoc()) {
		$totalcountry += $row['c'];
	}
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$country = $country . ',"' . $row['short_name'] . '"';
		$perccountry = round(($row['c'] * 100) / $totalcountry , 2);
		$countcountry = $countcountry . '{label: "'.$row['short_name'] .'", value: '.$perccountry.'},';
	}
	
	
	
	
	
	
	
	
	
	// Calculation global % Charter VS Regular
	$totalflights = $num_pireps;
	$totalregularflights = $num_pireps-$charterspireps;
	$totalcharterflights = $charterspireps;
	if ($totalflights == 0) {
		$percregularflights = 0;
		$perccharterflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
		$perccharterflights = round(100 - $percregularflights , 2);
	}
	$perc_charter_reg = '';
	$perccharterflights_pilot=0;
	if ($percregularflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Regular", value: '.$percregularflights.'},';
	}
	if ($perccharterflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Charter", value: '.$perccharterflights.'},';
	}
	if (($percregularflights+$perccharterflights)<1)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "No flights", value: 0 },';
	}
	// Calculation for type of report
	if ($totalflights == 0) {
		$percfsacars = 0;	}
	else {
		$percfsacars = round(($num_reports * 100) / $totalflights , 2);
	}
	if ($totalflights == 0) {
		$percfskeeper = 0;	}
	else {
		$percfskeeper = round(($num_fskeeper * 100) / $totalflights , 2);
	}
	if ($totalflights == 0) {
		$percvamacars = 0;	}
	else {
		$percvamacars = round(($num_vamacars * 100) / $totalflights , 2);
	}
	if ($num_pireps>0)
	{
		$percmanual = round((100 - $percfskeeper - $percfsacars - $percvamacars) , 2);
	}
	else
	{
		$percmanual = round(0 , 2);
	}
	
	
	$total= ($num_pireps);
	if ($total == 0){
		$cstacars = 0;
	} else {
		$vuelosregulares=$num_pireps-$charterspireps;
		$cstacars = ($vuelosregulares / $total) * 100 ;
		$charter = ($charterspireps / $total) * 100 ;
	}
	$per_type_report='';
	if ($num_pireps>0)
	{
		
		if ($charter>0)
		{
			$per_type_report = $per_type_report . '{label: "Charter", value: '.$charter.'},';
		}
		if ($cstacars>0)
		{
			$per_type_report = $per_type_report . '{label: "CST IVAO", value: '.$cstacars.'},';
		}
	}
	else
	{
		$per_type_report = $per_type_report ;
	}
	
			
			?>
			
			
			
			
			
			
				<?php







	// Calculation global % Charter VS Regular

	$totalflights = $num_pireps;	
	$totalregularflights = $num_pireps-$charterspireps;
	$totalcharterflights = $charterspireps;
	if ($totalflights == 0) {
		$percregularflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
	}

	$perccharterflights = round(100 - $percregularflights , 2);



	
	// Contar aerolineas
	
	$i = 0;
	$sql_va = "SELECT * from operators where operator_id='$aerolinea_id'";
	if (!$result_va = $db->query($sql_va)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_va->fetch_assoc()) {
			$i++;
		}
		
		// Contar usuarios no agregados
		
	$is = 0;	
		$sql_pcas = "SELECT * from gvausers where activation=0 and operator_id='$aerolinea_id'";
	if (!$result_pcas = $db->query($sql_pcas)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_pcas->fetch_assoc()) {
			$is++;
		}
		
		
		
		
		// Contar colstar acars y pax
		
	$isesas = 0;	
		$sql_cstpireps = "SELECT * from cstpireps where operator_id='$aerolinea_id'";
	if (!$result_cstpireps = $db->query($sql_cstpireps)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($rowsel = $result_cstpireps->fetch_assoc()) {
			$comb_cstpireps = $comb_cstpireps+$rowsel["cargo"];
			$pax_cstpireps = $pax_cstpireps+$rowsel["pax"];
			$dist_cstpireps = $dist_cstpireps+$rowsel["distance"];
			$connection_times = $connection_times+$rowsel["connection_time"];
		}
		
		
		
		
		
		
?>


<br>

  
	
	

<div class="row">


    
     	<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Estadísticas de la aerolínea</h3>
			</div>
			<div class="panel-body">
       
            

				<table class="table table-striped" width="100%">
				  <tbody>
				  <tr>
					<td valign="top" width="20%" ><strong>Pilotos activos:</strong></td>
					<td valign="top" width="30%"><?php echo $num_pilots; ?></td>
					<td valign="top" width="20%" ><strong>Pasajeros:</strong></td>
					<td valign="top" width="30%" ><?php echo $pax_cstpireps; ?></td>
				  </tr>
				  <tr>
					<td><strong>Horas:</strong></td>
					<td><?php 

$sumass= $connection_times;
$segundoss = $sumass*3600;
$horass = floor($segundoss/3600);
$minutoss = floor(($segundoss-($horass*3600))/60);
$segundoss = $segundoss-($horass*3600)-($minutoss*60);
$totals= $horass.' h '.$minutoss.' m ';

echo $totals; ?></td>
					<td><strong>Pilotos Pendientes:</strong></td>
					<td><?php echo $is; ?></td>
				  </tr>
				  <tr>
					<td><strong>Vuelos:</strong></td>
					<td><?php echo $num_pireps; ?></td>
					<td><strong>Aerolíneas:</strong></td>
					<td><?php echo $i; ?></td>
				  </tr>
				  <tr>
					<td><strong>Distancia:</strong></td>
					 <td><?php echo round($dist_cstpireps); ?> NM</td>
					<td><strong>Aeronaves:</strong></td>
					<td>+<?php echo $num_planes; ?></td>   
				  </tr>
				  <tr>
					<td><strong>Rutas:</strong></td>
					<td><?php echo $num_routes; ?></td>
					
				  </tr>
				</tbody>
				</table>
		  
		
</div>
		</div>
	</div>
</div>


	









			
				
			
	<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Número de vuelos por día en el mes actual.</h3>
			</div>
			<div class="panel-body">
				<div id="flights_per_day" ></div>
				<script>
					  var flights_per_day= Morris.Bar({
					  element: 'flights_per_day',
					  data: [<?php echo $count_per_day;?>
					  ],
					  xkey: 'day',
					  ykeys: ['flights'],
					  labels: ['flights'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_day.redraw();
				    });
				</script>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Número de vuelos por mes del año actual</h3>
			</div>
			<div class="panel-body">
				<div id="flights_per_month" ></div>
				<script>
					  var flights_per_month= Morris.Line({
					  element: 'flights_per_month',
					  data: [<?php echo $count_per_month;?>
					  ],
					  xkey: 'Mes',
					  ykeys: ['Vuelos'],
					  labels: ['Vuelos'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_month.redraw();
				    });
				</script>
			</div>
		</div>
	</div>
</div>
<!-- Row 2-->
<div class="row">
	
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Porcentaje tipo de reporte</h3>
			</div>
			<div class="panel-body">
				<div id="perc_countr2" style="height: 350px;"></div>
					<script>
						  var perc_countr2 = Morris.Donut({
						  element: 'perc_countr2',
						  data: [<?php echo $per_type_report ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_countr2.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Porcentaje tipo de vuelo</h3>
			</div>
			<div class="panel-body">
				<div id="perc_charter_reg" style="height: 350px;"></div>
					<script>
						  var perc_ch_re = Morris.Donut({
						  element: 'perc_charter_reg',
						  data: [<?php echo $perc_charter_reg ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_ch_re.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
</div>
<!-- Row 3-->
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Porcentaje por país</h3>
			</div>
			<div class="panel-body">
				<div id="perc_by_country" style="height: 350px;"></div>
					<script>
						  var perc_by_country =  Morris.Donut({
						  element: 'perc_by_country',
						  data: [<?php echo $countcountry ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_by_country.redraw();
				    });
					</script>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Porcentaje por tipo de avión</h3>
			</div>
			<div class="panel-body">
				<div id="perc_type_report" style="height: 350px;"></div>
					<script>
						  var perc_aircarft_type_used =  Morris.Donut({
						  element: 'perc_type_report',
    					  data: [<?php echo $perc_aircarft_type_used ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_aircarft_type_used.redraw();
				            });
					</script>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Porcentaje por duración de vuelo</h3>
			</div>
			<div class="panel-body">
				<div id="perc_flight_duration" style="height: 350px;"></div>
					<script>
						  var perc_flight_time = Morris.Donut({
						  element: 'perc_flight_duration',
						  data: [<?php echo $duration_graph ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_flight_time.redraw();
				            });
					</script>
			</div>
		</div>
		</div>
		</div>
			
			
				
	<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;Últimos Vuelos</h3>
			</div>
			<div class="panel-body">
	
	<?php
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
		$sqltt = "select * from cstpireps where operator_id='$aerolinea_id' order by fecha_envio desc limit 10";
							if (!$resulttt = $db->query($sqltt)) {
								die('There was an error running the query [' . $db->error . ']');
							}
	echo '<table id="pilots_flights_per_month" class="table table-hover">';
	echo '<thead>';
	echo '<tr><th>Callsign</th><th>Piloto</th><th>Origen</th><th>Destino</th><th>Fecha</th><th>Duración</th></tr>';
	echo '</thead>';
		while ($rowtt = $resulttt->fetch_assoc()) {
										
										$vid_user =$rowtt["vid"];
										$sql = "SELECT * FROM gvausers where ivaovid=$vid_user";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		$pilotname = $row['name'] . ' ' . $row['surname'];
	}
										echo '<td>';
										echo $rowtt["callsign"] . '</td><td>';
										echo $pilotname . '</td><td>';
										echo $rowtt["departure"] . '</td><td>';
										echo $rowtt["arrival"] . '</td><td>';



										echo $rowtt["fecha_envio"] . '</td><td>';

$sumas= $rowtt["connection_time"];
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';
										echo $total . '</td></tr>';
									}
	echo "</table></br>";

?>

</div>
		</div>
	</div>
</div>

			
			
			
			
			
			
			
			
			
			
			
  </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
		</div>
  
  


	
			<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>





