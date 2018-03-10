<?php
  session_start();
  $id='';
  $admin_access='';
  
  $id = $_SESSION["id"] ;
  $admin_access= $_SESSION["access_administration_panel"];
  
  
       
  if (empty($id) || $admin_access<>1) {
	  ?>
	  
	  <script type="text/javascript">
      window.location="http://<?php echo $_SERVER['HTTP_HOST']; ?>/main/";
      </script>
<?php
  }
  else{



include('./db_login.php');


	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sqluser = "SELECT * FROM gvausers where gvauser_id='$id'";

	if (!$resultuser = $db->query($sqluser)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $resultuser->fetch_assoc()) {

		$user_type = $rowusuarios['user_type_id'];

		$pilotname = $rowusuarios['name'];

		$pilotsurname = $rowusuarios['surname'];

		$callsign = $rowusuarios['callsign'];

		$id = $rowusuarios['gvauser_id'];

		$location = $rowusuarios['location'];

		$usertype = $rowusuarios['user_type_id'];

		$hub_id = $rowusuarios['hub_id'];
		
		$operador_id = $rowusuarios['operator_id'];

		$register_date = $rowusuarios['register_date'];

		$rank_id = $rowusuarios['rank_id'];

		$email = $rowusuarios['email'];

		$ivaovid = $rowusuarios['ivaovid'];
		
		$country = $rowusuarios['country'];

		$city = $rowusuarios['city'];

		$transfered_hours = $rowusuarios['transfered_hours'];

		//$pilot_image = './img/uploads/'.$rowusuarios['pilot_image'];

		

		$ruta_img = '../../main/images/uploads/'.$rowusuarios['pilot_image'];
		
		
    if(empty($rowusuarios['pilot_image'])) {
		
 $pilot_image = "../../main/images/uploads/pilot_default.png";
 
	} else {
		
		if (file_exists($ruta_img)) {
   $pilot_image = $ruta_img; 
} else {
    $pilot_image = "../../main/images/uploads/pilot_default.png";
}
   
   
        
   
	
	}
	
	}


	
	
	$airlines = array();
	$sql_operator_id ="select * from staff_airline_allow where user_type_id='$user_type'";

	if (!$result_operator_id = $db->query($sql_operator_id)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_id = $result_operator_id->fetch_assoc()) {
		$airlines[]= $row_operator_id["operator_id"];
	}
	
	
	

	// Get Hub info details

	$sql = "SELECT * FROM airports a INNER  JOIN hubs h on a.ident = h.hub where hub_id='$hub_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {
		
		$hub_airports = $rowusuarios['hub'];

		$hub_airport_name = $rowusuarios['name'];

		$hub_airport_flag = $rowusuarios['iso_country'];

	}



	// Get Location info details

	$sql = "SELECT * FROM airports  where ident='$location'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$location_airport_name = $rowusuarios['name'];

		$location_airport_flag = $rowusuarios['iso_country'];

	}










	

	$sql = "select * from va_parameters ";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$no_count_rejected = $rowusuarios["no_count_rejected"];		

	}





	$gva_hourse=0;
	
	
	$sqlhours = "select * from cstpireps where vid='$ivaovid'";

	if (!$resulthours = $db->query($sqlhours)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarioshours = $resulthours->fetch_assoc()) {

	 
		$gva_hourse = $gva_hourse+$rowusuarioshours["connection_time"];		

	}
	
	
	
	
	
	
														$sumas= $gva_hourse+$transfered_hours;
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$gva_hours= $horas.' h '.$minutos . ' m';

	

// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps from cstpireps where vid='$ivaovid'";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosee = $resultee->fetch_assoc()) {

		$num_pireps = $rowusuariosee["numpireps"];

	}
	

// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse from cstpireps where vid='$ivaovid' and charter=1";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosees = $resultees->fetch_assoc()) {

		$charterspireps = $rowusuariosees["numpirepse"];

	}	
	

	//  Get plane certifications

	$sql = "select plane_icao from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' order by plane_icao asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	$planes = '';

	$planes_certificated = array();

	$i = 0;

	while ($rowusuarios = $result->fetch_assoc()) {

		$planes .= $rowusuarios["plane_icao"] . '</br>';

		$planes_certificated[$i] = $rowusuarios["plane_icao"];

		$i++;

	}

	// Get hub

	$hub = '';

	$sql = "select hub from hubs where hub_id='$hub_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$hub = $rowusuarios["hub"];

	}
	
	// Get operador

	$hub = '';

	$sql = "select operator from operators where operator_id='$operador_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$operator = $rowusuarios["operator"];

	}

	// Get Rank

	$rank = '';

	$salary_hour = '';

	$sql = "select rank,salary_hour,img from ranks where rank_id='$rank_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$rank = $rowusuarios["rank"];

		$salary_hour = $rowusuarios["salary_hour"];

		$rank_url_image = $rowusuarios["img"];
		
	}

	// Get Country

	$sql = "select * from country_t where iso2='$country'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$country = $rowusuarios["short_name"];

		$country_flag = $rowusuarios["iso2"];

	}

	// Get VA  parameters

	$sql = "select * from va_parameters";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$currency = $rowusuarios["currency"];

	}

	

	$sql = "select format(sum(quantity),2) money from bank where gvauser_id='$id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$money = $rowusuarios["money"];

	}
	
	
	
	$num_planes=0;
		//Calculation  per plane type
//  Get count number of planes
	$sql = "select * from fleets ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		if (in_array($row['operator_id'], $airlines)) {
		$num_planes++;
		}
	}
	
	//  Get count number of flights
	$sqlcst = "select count(*) num_cst from cstpireps where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$resultcst = $db->query($sqlcst)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowcst = $resultcst->fetch_assoc()) {
		$cstpireps = $rowcst["num_cst"];
	}
	
	$cstpirepse=0;
	//  Get count number of routes
	$sqlcste = "select * from routes ";
	if (!$resultcste = $db->query($sqlcste)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowcste = $resultcste->fetch_assoc()) {
		if (in_array($rowcste['operator_id'], $airlines)) {
		$cstpirepse++;
		}
	}
	
	// Contar aerolineas
	
	$i = 0;
	$sql_va = 'SELECT * from operators';
	if (!$result_va = $db->query($sql_va)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_va->fetch_assoc()) {
			$i++;
		}
		
		// Contar usuarios no agregados
		
	$issp = 0;	
		$sql_pcasa = 'SELECT * from gvausers where activation=0';
	if (!$result_pcasa = $db->query($sql_pcasa)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($rowa = $result_pcasa->fetch_assoc()) {
			if (in_array($rowa['operator_id'], $airlines)) {
			$issp++;
			}
		}
		
		
		if ($issp>0)
			
			{
				
				$hays = "1";
				
			} else
				
				{
					
					$hays = "0";
				}
		
		
		// HUBS CONTAR
		
	$isesaaa = 0;	
		$sql_reportse = 'SELECT * from hubs';
	if (!$result_reportse = $db->query($sql_reportse)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($rowssse = $result_reportse->fetch_assoc()) {
			
			$isesaaa++;
		}
	
	// PILOTS CONTAR
		
$num_pilots=0;
		$sql_reportsee = 'SELECT * from gvausers';
	if (!$result_reportsee = $db->query($sql_reportsee)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($rowsssee = $result_reportsee->fetch_assoc()) {
			if (in_array($rowsssee['operator_id'], $airlines)) {
			$num_pilots++;
			}
		}
	
	

	$icao_va = array();
	$sql_operator_global_first ="select * from operators order by operator asc";

	if (!$result_operator_global_first = $db->query($sql_operator_global_first)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_first = $result_operator_global_first->fetch_assoc()) {
		$icao_va[]= $row_operator_first["callsign"];
	}
	
	
	
	
	
	
	$sql_user_type = "SELECT * from user_types where user_type_id='$user_type'";
	if (!$result_user_type = $db->query($sql_user_type)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_user_type = $result_user_type->fetch_assoc()) {
			
			$user_type_name = $row_user_type['user_type'];
		}
		
		$airlines_allowed_staff = '';
		$sql_airlines_allow = "SELECT * from operators";
	if (!$result_airlines_allow = $db->query($sql_airlines_allow)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_airlines_allow = $result_airlines_allow->fetch_assoc()) {
			
			if (in_array($row_airlines_allow['operator_id'], $airlines)) {
               $airlines_allowed_staff = $airlines_allowed_staff . '<li>' . $row_airlines_allow['operator'] . '</li>';
            }
			
			
			
		}
		
		
		
		
		$sql12 = "select * from presentacionexamen where estado=2";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$continterview=0;
		while ($row12 = $result12->fetch_assoc()) {
			$continterview++;
			
		}
		
		
		
		$sql3 = "select * from request_entto where id_teacher='$id' and estado<>3 and estado<>4 order by fecha_solicitud asc";
		
		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$enttopendient=0;
		while ($row3 = $result3->fetch_assoc()) {
			$enttopendient++;
			
		}
		
		
	
	
	
	?>



<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>ColStar Alliance | Admin</title>
  <meta name="description" content="Alianza virtual Colombia, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/icon.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
  <link rel="stylesheet" href="js/calendar/bootstrap_calendar.css" type="text/css" />
  <link href="../../main/images/favicon.ico" type="image/x-icon" rel="icon" />
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
	
		
	
  <![endif]-->
  <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	

	
	<link href="../../main/css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->

	<script src="../../main/js/raphael.min.js" type="text/javascript"></script>
	<script src="../../main/js/morris.min.js" type="text/javascript"></script>
	
	
	
</head>
<body class="">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
          <i class="fa fa-bars"></i>
        </a>
        <a href="./" class="navbar-brand">
          <img src="images/logo.png" class="m-r-sm" alt="scale">
          <span class="hidden-nav-xs">Col</span>Star Alliance
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
     
      
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black aside-md hidden-print" id="nav">          
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">                        
                        <img src="<?php echo $pilot_image; ?>" class="dker" alt="...">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt"><?php echo $pilotname; ?></strong> 
                        </span>
                        <span class="text-muted text-xs block"><?php echo $user_type_name; ?></span>
						<a href="../../main/index_user.php"><i class="fa fa-power-off"></i> Cerrar Sesión <b><?php echo $user_type_name; ?></b></a>
						

                      </span>
                    </a>

                  </div>
                </div>                


                <!-- nav -->                 
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Panel Administrativo<br><?php echo $airlines_allowed_staff; ?></div>
                  <ul class="nav nav-main" data-ride="collapse">
                    <li class="active">
                      <a href="./" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-paperplane icon">
                        </i>
                        <span class="font-bold">Inicio</span>
                      </a>
					  </li>
                    <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <b class="badge bg-danger pull-right"><?php echo $num_pilots; ?></b>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Pilotos</span>
                      </a>
                      <ul class="nav dk">
                        <li >
						<?php 
                          if($_SESSION["access_pilot_manager"]==1 || $_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=admonpilotos" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>
                                                                                
                            <i class="i i-dot"></i>

                            <span>Admon Pilotos</span>
                          </a>
                        </li>
						<li >
						<?php 
                          if($_SESSION["access_pilot_manager"]==1 || $_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=suspensionespilots" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>
                                                                                
                            <i class="i i-dot"></i>

                            <span>Suspensiones Pilotos</span>
                          </a>
                        </li>
						 <li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=newpilots" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>
                            <b class="badge bg-danger pull-right"><?php echo $issp; ?></b>                                                    
                            <i class="i i-dot"></i>

                            <span>Nuevos Pilotos</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_rank_manager"]==1){
		                  ?>
		                  <a href="./?page=rangospilotos" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Rangos Pilotos</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_award_manager"]==1){
		                  ?>
		                  <a href="./?page=premiospilotos" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                        
                            <i class="i i-dot"></i>

                            <span>Premios Pilotos</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_user_type_manager"]==1){
		                  ?>
		                  <a href="./?page=tiposdeusuario" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>  
                            <i class="i i-dot"></i>

                            <span>Tipos de Usuario</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-lab icon">
                        </i>
                        <span class="font-bold">Aeronaves</span>
						
                            <b class="badge bg-info pull-right"><?php echo $num_planes; ?></b>        
                      </a>
                      <ul class="nav dk">
                        <li >
						<?php 
                          if($_SESSION["access_fleet_type_manager"]==1){
		                  ?>
		                  <a href="./?page=tiposdeaeronave" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Tipos de Aeronave</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_fleet_manager"]==1){
		                  ?>
		                  <a href="./?page=admonaeronaves" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                                            
                            <i class="i i-dot"></i>

                            <span>Admon Aeronaves</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_flight_types"]==1){
		                  ?>
		                  <a href="./?page=tiposdevuelo" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                          
                            <i class="i i-dot"></i>

                            <span>Tipos de Vuelo</span>
                          </a>
                        </li>
						<li >
						<?php 
                          if($_SESSION["access_operator_manager"]==1){
		                  ?>
		                  <a href="./?page=aerolineas" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                      
                            <i class="i i-dot"></i>

                            <span>Aerolíneas</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    <li >
					<?php 
                          if($_SESSION["access_route_manager"]==1){
		                  ?>
		                  <a href="./?page=rutasva" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?> 
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-docs icon">
                        </i>
                        <span class="font-bold">Rutas</span>
						<b class="badge bg-info pull-right"><?php echo $cstpirepse; ?></b>      
                      </a>
                    </li>
					   <li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-grid2 icon">
                        </i>
                        <span class="font-bold">General</span>
                      </a>
                      <ul class="nav dk">
					  <li >
					  <?php 
                          if($_SESSION["access_email_manager"]==1){
		                  ?>
		                  <a href="./?page=emails" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Emails</span>
                          </a>
                        </li>
					  <li >
					  <?php 
                          if($_SESSION["access_va_parameters"]==1){
		                  ?>
		                  <a href="./?page=vaparametros" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Parámetros Alianza</span>
                          </a>
                        </li>
                        <li >
						 <?php 
                          if($_SESSION["access_event_manager"]==1){
		                  ?>
		                  <a href="./?page=eventosva" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                                  
                            <i class="i i-dot"></i>

                            <span>Eventos</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_tour_manager"]==1){
		                  ?>
		                  <a href="./?page=toursva" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                         
                            <i class="i i-dot"></i>

                            <span>Tours</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_tienda"]==1){
		                  ?>
		                  <a href="./?page=ventastienda" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                     
                            <i class="i i-dot"></i>

                            <span>Tienda VA</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_airports_manager"]==1){
		                  ?>
		                  <a href="./?page=aeropuertosva" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Aeropuertos</span>
                          </a>
                        </li>
						<li >
						<?php 
                          if($_SESSION["access_airports_manager"]==1){
		                  ?>
		                  <a href="./airac/airac.php" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Airac</span>
                          </a>
                        </li>
						<li >
						<?php 
                          if($_SESSION["access_financial_parameters"]==1){
		                  ?>
		                  <a href="./?page=finanzasva" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                        
                            <i class="i i-dot"></i>

                            <span>Parámetros Finanzas</span>
                          </a>
                        </li>
						<li >
		                  <a href="./?page=simulators" class="auto">  
		                                                                      
                            <i class="i i-dot"></i>

                            <span>Sim | Texturas</span>
                          </a>
                        </li>
						<li >
		                  <a href="./?page=hubs" class="auto">  
		                                                                      
                            <i class="i i-dot"></i>

                            <span>Hubs</span>
                          </a>
                        </li>
						<li >
		                  <a href="./?page=ivao" class="auto">  
		                                                                      
                            <i class="i i-dot"></i>

                            <span>IVAO</span>
                          </a>
                        </li>
						 </ul>
						
						
						</li>
						
						
						
						
						
						
						
						
						<li >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-users2 icon">
                        </i>
                        <span class="font-bold">Docentes</span>
                      </a>
                      <ul class="nav dk">
					  <li >
					  <?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=docente" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Sala Profesores</span>
                          </a>
                        </li>
						
						
						<li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=my_enttos" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                        
                            <b class="badge bg-danger pull-right"><?php echo $enttopendient; ?></b>                                                    
                            <i class="i i-dot"></i>

                            <span>Entrenamientos por Dar</span>
                          </a>
                        </li>
						
						
                        <li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=editexamen" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                         
                            <i class="i i-dot"></i>

                            <span>Examen Admisión</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=interviewva" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?> 
                            <b class="badge bg-danger pull-right"><?php echo $continterview; ?></b>    						  
                            <i class="i i-dot"></i>

                            <span>Entrevistas a Calificar</span>
                          </a>
                        </li>
                        <li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=estadisticaexamen" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                       
                            <i class="i i-dot"></i>

                            <span>Estadísticas Examen</span>
                          </a>
                        </li>
						<li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=coursesadmon" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                        
                            <i class="i i-dot"></i>

                            <span>Cursos</span>
                          </a>
                        </li>
						
						<li >
						<?php 
                          if($_SESSION["access_docente"]==1){
		                  ?>
		                  <a href="./?page=calificar" class="auto">  
		                  <?php
                          } else {
	                      ?>
	                      <a href="./?page=nopermission" class="auto">                        
	                      <?php
                          }
                          ?>                                                        
                            <i class="i i-dot"></i>

                            <span>A Calificar</span>
                          </a>
                        </li>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
                      </ul>
                    </li>
					<li>
                      <a href="./?page=stats" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Estadísticas</span>
                      </a>
                    </li>
					<li>
                      <a href="./?page=finance_stats" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Finanzas</span>
                      </a>
                    </li>
					
					
					
						<li>
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Informes</span>
                      </a>
                      <ul class="nav dk">
					  <li >
		                  <a href="./?page=week_actual" class="auto">                                              
                            <i class="i i-dot"></i>

                            <span>Semana Actual</span>
                          </a>
                        </li>
                      <li >
		                  <a href="./?page=weel_per_year" class="auto">                                              
                            <i class="i i-dot"></i>

                            <span>Semanas del Año</span>
                          </a>
                        </li>
						
						
						
                      </ul>
                    </li>
					
					
					<li>
                      <a href="./?page=code_airlines" class="auto">
                        <i class="i i-code icon">
                        </i>
                        <span class="font-bold">Código HTML</span>
                      </a>
                    </li>
					
					
                 
                  </ul>
                  <div class="line dk hidden-nav-xs"></div>
                 
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="../../main/index_user.php" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
		<?php
	
if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
?>

        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable padder">              
                  <section class="row m-b-md">
                    <div class="col-sm-6">
                      <h3 class="m-b-xs text-black">Panel Administrativo</h3>
                      <small>Bienvenido de Nuevo, <?php echo $pilotname; ?>, <i class="fa fa-map-marker fa-lg text-primary"></i> Ciudad <?php echo $city; ?></small>
                    </div>
                    <div class="col-sm-6 text-right text-left-xs m-t-md">
                     
                      <a href="#nav, #sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs, show"><i class="fa fa-bars"></i></a>
                    </div>
                  </section>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="panel b-a">
                        <div class="row m-n">
                          <div class="col-md-6 b-b b-r">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                                <i class="i i-paperplane i-1x text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-danger"><?php echo $num_planes; ?></span>
                                <small class="text-muted text-u-c">Aeronaves</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
                                <i class="i i-users2 i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-success"><?php echo $num_pilots; ?></span>
                                <small class="text-muted text-u-c">Pilotos</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b b-r">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                                <i class="i i-location i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-info"><?php echo $cstpireps; ?></span>
                                <small class="text-muted text-u-c">Vuelos</small>
                              </span>
                            </a>
                          </div>
                          <div class="col-md-6 b-b">
                            <a href="#" class="block padder-v hover">
                              <span class="i-s i-s-2x pull-left m-r-sm">
                                <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                                <i class="i i-alarm i-sm text-white"></i>
                              </span>
                              <span class="clear">
                                <span class="h3 block m-t-xs text-primary"><?php echo $cstpirepse; ?></span>
                                <small class="text-muted text-u-c">Rutas</small>
                              </span>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="panel b-a">
                        <div class="panel-heading no-border bg-primary lt text-center">
                          <a href="#">
                            <i class="fa fa-plane fa fa-3x m-t m-b text-white"></i>
                          </a>
                        </div>
                        <div class="padder-v text-center clearfix">                            
                          <div class="col-xs-6 b-r">
                            <div class="h3 font-bold">+<?php echo $i; ?></div>
                            <small class="text-muted">Aerolíneas</small>
                          </div>
                          <div class="col-xs-6">
                            <div class="h3 font-bold">+<?php echo $isesaaa; ?></div>
                            <small class="text-muted">Hubs</small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                      <div class="panel b-a">
                        <div class="panel-heading no-border bg-info lter text-center">
                          <a href="#">
                            <i class="fa-fighter-jet fa fa-3x m-t m-b text-white"></i>
                          </a>
                        </div>
                        <div class="padder-v text-center clearfix">                            
                          <div class="col-xs-6 b-r">
                            <div class="h3 font-bold"><?php echo $issp; ?></div>
                            <small class="text-muted">Pendientes</small>
                          </div>
                          <div class="col-xs-6">
                            <div class="h3 font-bold">CST</div>
                            <small class="text-muted">Misma Pasión!</small>
                          </div>
                        </div>
                      </div>
                    </div>
					
					
					
					
					
					<?php


	
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
	$num_pilots=0;
	//  Get count number of pilots
	$sql = "select * from gvausers where activation=1 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		if (in_array($row['operator_id'], $airlines)) {
		$num_pilots++;
		}

	}
	
	$num_planes = 0;
	//  Get count number of planes
	$sql = "select * from fleets where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		if (in_array($row['operator_id'], $airlines)) {
		$num_planes++;
		}
	}
	
	$num_routes =0;
	//  Get count number of routes
	$sql = "select *  from routes where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		if (in_array($row['operator_id'], $airlines)) {
		$num_routes++;
		}
	}
	
	
	
	// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps, operator_id from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowee = $resultee->fetch_assoc()) {

		$num_pireps = $rowee["numpireps"];

	}
	
	
	// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse, operator_id from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and charter<>0 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowees = $resultees->fetch_assoc()) {

		$charterspireps = $rowees["numpirepse"];

	}	
	
	
	
	$vuelosactivos = 0;
	
	
	
		
			$filecontentss = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rowss = explode("\n", $filecontentss);
foreach ($rowss as $rowrs) {

	$fieldss = explode(":", $rowrs);
	$callss = substr($fieldss[0],0,3);
if ($fieldss[3] <> 'ATC' && in_array($callss, $airlines)) {
$ivaovid=$fieldss[1];

	$sqlpilot = "select * from gvausers where ivaovid='$ivaovid'";
	if (!$resultpilot = $db->query($sqlpilot)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowpilot = $resultpilot->fetch_assoc()) {
		$vuelosactivos++;
		
		
	

	}
  
	

}
	
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
		$sql2 = "select operator_id, IFNULL(count(id),0) as co from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%m')=$i and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
			$meses = array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
			
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_month = $count_per_month . "{ Mes: '" . $meses[$i] . "', Vuelos: ". $row2['co'] ." },";
		}
	}
	
	// Calculation for flights per day current month
	$count_per_day = '';
	for ($i = 1 ; $i <= $current_day ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select operator_id, IFNULL(count(id),0) as co from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and date_format(fecha_envio,'%m')=date_format(now(),'%m') and date_format(fecha_envio,'%d')=$i and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
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
	$sql = "select  connectiontime , SUM(cn) as cnt from (
select '0-1' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))<=1 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '1-2' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>1 and ABS(abs(connection_time))<=2 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '2-3' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>2 and ABS(abs(connection_time))<=3 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '3-4' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>3 and ABS(abs(connection_time))<=4 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '4-5' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>4 and ABS(abs(connection_time))<=5 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '5-6' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>5 and ABS(abs(connection_time))<=6 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '6-7' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>6 and ABS(abs(connection_time))<=7 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '7-8' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>7 and ABS(abs(connection_time))<=8 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '8-9' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>8 and ABS(abs(connection_time))<=9 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")
union
select '>9' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH((connection_time))>0 and ABS(abs(connection_time))>9 and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") )  as t group by connectiontime";
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
	$sql = "select operator_id, aircraft , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and  LENGTH(aircraft)>0  and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") group by aircraft";
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
		
		$resultado2[] = $val;
	}
	
	$entrada2=$resultado2; //Los 10 numeros de entrada
$mayor2=$entrada2[0]; //Ponemos que el mayor es el primer elemento
//Se cambia automaticamente en el bucle
$pos2=0; //la posicion en 0
//El bucle (lo importante)
//Iniciamos un bucle del tamaño de la cantidad de elementos del array
for($j2=0;$j2<count($entrada2);$j2++)
{
  //Si mayor es menor que el elemento elejido
  if($mayor2<$entrada2[$j2])
  {
    //cambiamos el mayor
    //y obtenemos su posicion
    $mayor2=$entrada2[$j2];
    $pos2=$j2;
  }
}

$valorfull2 = $mayor2;


$aviones = "NA";

$sql3 = "select operator_id, aircraft , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and  LENGTH(aircraft)>0 group by aircraft and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") ";
	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$aircarft_type_used_array[$row["aircraft"]] = $row["cn"];
		$aircarft_type_used_cnt +=  $row["cn"];
	}
	foreach($aircarft_type_used_array as $key => $value)
	{
		$val = number_format((100 * $value)/$aircarft_type_used_cnt,2);
		if($valorfull2==$val) {
	$aviones = $key;
	}
	}
	
	
		//Calculation  per plane type
	$sql = "select count(*) as c, vp.aircraft, vp.operator_id as plane_icao from cstpireps vp where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and  LENGTH(aircraft)>0 group by vp.aircraft and vp.operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") order by plane_icao asc";
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
			where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and  c.`iso2`=a.`iso_country`  and  vp.departure=a.ident and vp.operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") group by short_name) as t group by short_name;";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$totalcountry=0;
	$country='';
	$perccountry='';
	$countcountry='';
	$resultado=array();
	$contes = 0;
	$importantese='';
	
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
		
		
			$resultado[] = $perccountry;
		
		
	}
	
	
	

	$entrada=$resultado; //Los 10 numeros de entrada
$mayor=$entrada[0]; //Ponemos que el mayor es el primer elemento
//Se cambia automaticamente en el bucle
$pos=0; //la posicion en 0
//El bucle (lo importante)
//Iniciamos un bucle del tamaño de la cantidad de elementos del array
for($j=0;$j<count($entrada);$j++)
{
  //Si mayor es menor que el elemento elejido
  if($mayor<$entrada[$j])
  {
    //cambiamos el mayor
    //y obtenemos su posicion
    $mayor=$entrada[$j];
    $pos=$j;
  }
}

$valorfull = $mayor;
	
	$importantes =  "NA";
	// Country  stats
	$sql2 = "select SUM(c) as c, short_name from
(select count(*) as c, short_name
			from cstpireps vp, airports a , country_t c
			where date_format(fecha_envio,'%y')=date_format(now(),'%y')  and  c.`iso2`=a.`iso_country` and  vp.departure=a.ident and vp.operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") group by short_name) as t group by short_name;";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row2 = $result2->fetch_assoc()) {
	
	$perccountrys = round(($row2['c'] * 100) / $totalcountry , 2);
	
	if($valorfull==$perccountrys) {
	$importantes = $row2['short_name'];
	}
	
	
	
	
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

	$perccharterflights = round(($totalcharterflights * 100) / $totalflights , 2);



	
	// Contar aerolineas
	
	$i = 0;
	$sql_va = 'SELECT * from operators';
	if (!$result_va = $db->query($sql_va)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_va->fetch_assoc()) {
			$i++;
		}
		
		// Contar usuarios no agregados
		
	$is = 0;	
		$sql_pcas = 'SELECT * from gvausers where activation=0';
	if (!$result_pcas = $db->query($sql_pcas)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_pcas->fetch_assoc()) {
			$is++;
		}
		
		
		
		
		// Contar colstar acars y pax
		
	$isesas = 0;	
		$sql_cstpireps = 'SELECT * from cstpireps';
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

					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
                    <div class="col-sm-3 hide">
                      <section class="panel b-a">
                        <header class="panel-heading b-b b-light">
                          <ul class="nav nav-pills pull-right">
                            <li>
                              <a href="ajax.pie.html" class="text-muted" data-bjax data-target="#b-c">
                                <i class="i i-cycle"></i>
                              </a>
                            </li>
                            <li>
                              <a href="#" class="panel-toggle text-muted">
                                <i class="i i-plus text-active"></i>
                                <i class="i i-minus text"></i>
                              </a>
                            </li>
                          </ul>
                          Connection
                        </header>
                        <div class="panel-body text-center bg-light lter" id="b-c">
                          <div class="easypiechart inline m-b m-t" data-percent="60" data-line-width="4" data-bar-Color="#23aa8c" data-track-Color="#c5d1da" data-color="#2a3844" data-scale-Color="false" data-size="120" data-line-cap='butt' data-animate="2000">
                            <div>
                              <span class="h2 m-l-sm step"></span>%
                              <div class="text text-xs">completed</div>
                            </div>
                          </div>
                        </div>
                      </section>                      
                    </div>
                  </div>           
                  <div class="row bg-light dk m-b">
                    <div class="col-md-12 dker">
                      <section>
                        <header class="font-bold padder-v">
                         
                          Estadísticas Generales
                        </header>
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
                        <div class="row text-center no-gutter">
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block"><?php echo $percregularflights; ?>%</span>
                            <small class="text-muted m-b block">Vuelo Regular</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block"><?php echo $perccharterflights; ?>%</span>
                            <small class="text-muted m-b block">Vuelo Charter, Tour</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block"><?php echo $aviones; ?></span>
                            <small class="text-muted m-b block">Aeronave Preferida</small>
                          </div>
                          <div class="col-xs-3">
                            <span class="h4 font-bold m-t block"><?php echo $importantes; ?></span>
                            <small class="text-muted m-b block">Destino Preferido</small>                        
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
               
                </section>
              </section>
            </section>
            <!-- side content -->
			
			<?
/**
 * IVAO Traffic list
 *
 * @author Aki Kettunen www.akikettu.net
 * @package defaultPackage
 */
/*
BEGINNG OF CONFIGURATION
*/

/**
 * 	EDIT by Chris Doehring (272909), 2012-12-04
 *  Added check function for local airport country codes...
 *
 */
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

/*
END OF CONFIGURATION
*/

//http://www.ivao.aero/whazzup/status.txt
//http://dataservice.gatools.org/data/ivao.txt

// DOWNLOAD ONLINE-LISTAUS
//---------------------------------------------------------------------------------------------------------
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
                    if (checkCountryIcao(substr($fields[11],0,2)) OR checkCountryIcao(substr($fields[13],0,2))) {
                        array_push($pilots, $fields);
                    }
                }
                break;
            case 'GENERAL':
                list($key, $value) = explode('=', $row);
                $generaldata[trim($key)] = trim($value);
                break;
        }
    }
}




function remove_accents( $string )
{
   $string = htmlentities($string);
   return preg_replace("/&([a-z])[a-z]+;/i","$1",$string);
}




// BOOKINGS
//-------------------------------------------------------------------------------------------------------------------
// ATC




function DateAdd($v,$d=null , $f="Ymd"){
 	
$d=($d?$d:GMdate("Y-m-d")); 
    return GMdate($f,strtotime($v." days",strtotime($d))); 
}










?>


            <aside class="aside-md bg-black hide" id="sidebar">
              <section class="vbox animated fadeInRight">
                <section class="scrollable">
                  <div class="wrapper"><strong>Vuelos En Vivo</strong></div>
                  <ul class="list-group no-bg no-borders auto">
                  
				  <?php
				  $contarvuelos=0;
				  	$filecontentss = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rowss = explode("\n", $filecontentss);
foreach ($rowss as $rowrs) {

	$fieldss = explode(":", $rowrs);
	$callss = substr($fieldss[0],0,3);
if ($fieldss[3] <> 'ATC' && (in_array($callss,$icao_va))) {
$ivaovid=$fieldss[1];

	$sqlpilot = "select * from gvausers where ivaovid='$ivaovid'";
	if (!$resultpilot = $db->query($sqlpilot)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowpilot = $resultpilot->fetch_assoc()) {
		$contarvuelos++;
		?>
		 <li class="list-group-item">
                      <span class="fa-stack pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-plane fa-stack-1x text-white"></i>
                      </span>
                      <span class="clear">
                        <a href="#"><?php echo '(' . $fieldss[0] . ') ' . $rowpilot['name']; ?></a> <br>VID
                        <small class="icon-muted"><?php echo $rowpilot['ivaovid']; ?></small>
                      </span>
                    </li>
	
        <?php
	}
  
	

}
	
}

if ($contarvuelos==0) {
		?>
		 <li class="list-group-item">
                      <span class="fa-stack pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-plane fa-stack-1x text-white"></i>
                      </span>
                      <span class="clear">
                        <a href="#">No hay vuelos en vivo</a>
                      </span>
                    </li>
	
        <?php
	}
?>
                   
               
			   
			   
                  </ul>
                  <div class="wrapper"><strong>Staff IVAO CO</strong></div>
                  <ul class="list-group no-bg no-borders auto">
				  <?

//STAFF
//-------------------------------------------------------------------------------------------------------------------
if (count($staff) != 0) {
  //  echo '<h3>' . $lng['staffingb'] . '</h3>
  
    foreach ($staff as $staffmember) {
        $realname = $staffmember[2];
        $realname = remove_accents(ucwords($realname));
    ?>
   <li class="list-group-item">
                      <div class="media">
                        <span class="fa-stack pull-left m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-warning"></i>
                        <i class="fa fa-user fa-stack-1x text-white"></i>
                        </span>
                        <div class="media-body">
                          <div><a href="http://www.ivao.aero/staff/details.asp?id=<?php $staffmember[0]; ?>"><?php echo $staffmember[0]; ?></a></div>
                          <small class="text-muted"><?php echo $staffmember[1]; ?></small>
                        </div>
                      </div>
                    </li>
  <?php
   }
   
} else {
	?>
	 <li class="list-group-item">
                      <div class="media">
                        <span class="fa-stack pull-left m-r-sm">
                          <i class="fa fa-circle fa-stack-2x text-success"></i>
                        <i class="fa fa-user fa-stack-1x text-white"></i>
                        </span>
                        <div class="media-body">
                          <div><a href="#">No hay Staff en Línea</a></div>
                          <small class="text-muted">División IVAO Co</small>
                        </div>
                      </div>
                    </li>
	
	<?php
}

?>
                    
                
                  </ul>
                </section>
              </section>              
            </aside>
            <!-- / side content -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
	  <?php
		
		
	} else {
		
			}
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
		$Existe = file_exists($_GET["page"] . ".php");
		if ($Existe == true) {
			include($_GET["page"] . ".php");
		} else {
			include("404.php");
		}
	}
	
	

?>
    </section>
  </section>
   </section>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="js/charts/flot/jquery.flot.min.js"></script>
  <script src="js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="js/charts/flot/jquery.flot.spline.js"></script>
  <script src="js/charts/flot/jquery.flot.pie.min.js"></script>
  <script src="js/charts/flot/jquery.flot.resize.js"></script>
  <script src="js/charts/flot/jquery.flot.grow.js"></script>
  <script src="js/charts/flot/demo.js"></script>

  <script src="js/calendar/bootstrap_calendar.js"></script>
  <script src="js/calendar/demo.js"></script>

  <script src="js/sortable/jquery.sortable.js"></script>
  <script src="js/app.plugin.js"></script>
</body>
</html>
<?php 
  } ?>