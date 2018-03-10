
<?php 
		$pilotID = $_GET['pilot_id']; 
	
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT * FROM gvausers where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$user_type = $row['user_type_id'];
		$pilotname = $row['name'];
		$pilotsurname = $row['surname'];
		$callsign = $row['callsign'];
		$id = $row['gvauser_id'];
		$location = $row['location'];
		$usertype = $row['user_type_id'];
		$hub_id = $row['hub_id'];
		$hub = $row['hub_id'];
		$ivaovid = $row['ivaovid'];
		$operador_id = $row['operator_id'];
		$register_date = $row['register_date'];
		$rank_id = $row['rank_id'];
		$email = $row['email'];
		$country = $row['country'];
		$city = $row['city'];
		$transfered_hours = $row['transfered_hours'];				
		//$other_pilot_images = '../../va/images/uploads/'.$row['pilot_image'];
		$birth_date = $row['birth_date'];
		$activation = $row['activation'];
		$ruta_img = '../../main/images/uploads/'.$row['pilot_image'];

    
	
	  if(empty($row['pilot_image'])) {
		
 $other_pilot_images = "../../main/images/uploads/pilot_default.png";
 
	} else {
		
		if (file_exists($ruta_img)) {
   $other_pilot_images = $ruta_img; 
} else {
    $other_pilot_images = "../../main/images/uploads/pilot_default.png";
}
   
   
        
   
	
	}
	
	
	
	
	}
	
	
	// Get Hub info details

	$sql = "SELECT * FROM airports a INNER  JOIN hubs h on a.ident = h.hub where hub_id=$hub_id";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {

		$hub_airport_name = $row['name'];

		$hub_airport_flag = $row['iso_country'];

	}



	// Get Location info details

	$sql = "SELECT * FROM airports  where ident='$location'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {

		$location_airport_name = $row['name'];

		$location_airport_flag = $row['iso_country'];

	}
	
	
	// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps from cstpireps where vid='$ivaovid'";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowee = $resultee->fetch_assoc()) {

		$num_pireps = $rowee["numpireps"];

	}

	


	
	
	
	$horasvuelo= 0;
	
	$sql_pcas = "select * from cstpireps where vid=$ivaovid"; 
if (!$result_pcas = $db->query($sql_pcas)) {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row_pcas = $result_pcas->fetch_assoc()) {
	$horasvuelo=$horasvuelo+$row_pcas["connection_time"];
	}
	
	
	
														$sumas= $horasvuelo+$transfered_hours;
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$gva_hours= $horas.':'.$minutos . '';
	
	
	$sql = "select format(sum(quantity),2) money from bank where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$money = $row["money"];
	}
	
	//  Get plane certifications
	$sql = "select plane_icao from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id=$pilotID order by plane_icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$planes = '';
	$planes_certificated = array();
	$i = 0;
	while ($row = $result->fetch_assoc()) {
		$planes .= $row["plane_icao"] . '</br>';
		$planes_certificated[$i] = $row["plane_icao"];
		$i++;
	}
	// Get hub
	$sql = "select hub from hubs where hub_id=$hub_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$hub = $row["hub"];
	}
	
	// Get operador
	$sql = "select * from operators where operator_id=$operador_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$operator = $row["operator"];
		$imagen_aerolinea = $row["imagen_aerolinea"];
		$file = $row["file"];
		$callsignva = $row["callsign"];
	}
	
	// Get Rank
	
	$sql_ranks ="select * from ranks order by maximum_hours desc limit 1";
	if (!$result_ranks = $db->query($sql_ranks)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_ranks = $result_ranks->fetch_assoc()) {
	
	$maximum_hours_last = $row_ranks["maximum_hours"];
	$minimum_hours_last = $row_ranks["minimum_hours"];
	
	
	}
	// Get Rank
	$rank = '';
	$salary_hour = '';
	$sql = "select * from ranks where rank_id='$rank_id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowusuarios = $result->fetch_assoc()) {
		$rank = $rowusuarios["rank"];
		$salary_hour = $rowusuarios["salary_hour"];
		$rank_url_image = $rowusuarios["img"];
		
		
		if($maximum_hours_last==$rowusuarios["maximum_hours"] && $minimum_hours_last ==$rowusuarios["minimum_hours"]) {
			
			$maximum_hours = $rowusuarios["minimum_hours"];
			
		} else {
		
		$minimum_hours = $rowusuarios["minimum_hours"];
		
		$maximum_hours = $rowusuarios["maximum_hours"];
		}
		
		
		
	}
	// Get Country
	$sql = "select * from country_t where iso2='$country'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$country = $row["short_name"];
		$country_flag = $row["iso2"];
	}
	// Get VA  parameters
	$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$currency = $row["currency"];
	}
	
// Get VA  USer Type
	$sql = "select * from user_types where user_type_id=$user_type";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$user_types = $row["user_type"];
	}
	


$progreso_previous = round((($sumas*100)/$maximum_hours),2);
if($progreso_previous>100) {
	$progreso = 100;
} else {
	$progreso = $progreso_previous;
}
?>

	
   <section id="content">
          <section class="vbox">
            <section class="scrollable">
              <section class="hbox stretch">
                <aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                        <section class="panel no-border bg-primary lt">
                          <div class="panel-body">
                            <div class="row m-t-xl">
                           <div class="col-xs-3 text-right padder-v">
                                <a href="#" class="btn btn-primary btn-icon btn-rounded m-t-xl"><i class="fa fa-plane"></i></a>
                              </div>
                              <div class="col-xs-6 text-center">
                                <div class="inline">
                                  <div class="easypiechart" data-percent="<?php echo $progreso; ?>" data-line-width="6" data-bar-color="#fff" data-track-Color="#2796de" data-scale-Color="false" data-size="140" data-line-cap='butt' data-animate="1000">
                                    <div class="thumb-lg avatar">
                                      <img src="<?php echo $other_pilot_images; ?>" class="dker">
                                    </div>
                                  </div>
                                  <div class="h4 m-t m-b-xs font-bold text-lt"><?php echo $pilotname . ' ' . $pilotsurname; ?></div>
                                  <small class="text-muted m-b"><?php echo $callsign; ?></small>
                                </div>
                              </div>
                          <div class="col-xs-3 text-right padder-v">
                                <a href="#" class="btn btn-primary btn-icon btn-rounded m-t-xl"><i class="fa fa-plane"></i></a>
                              </div>
                            </div>
                            <div class="wrapper m-t-xl m-b">
                              <div class="row m-b">
                                <div class="col-xs-6 text-right">
                                  <small>Ubicación</small>
                                  <div class="text-lt font-bold"><?php echo $location; ?>
							<?php echo '<img src="../../main/images/flags/24/' . $location_airport_flag . '.png" alt="' . $location_airport_flag . '">' ?>
							<br>
							<?php echo '<font size="2">&nbsp;'.$location_airport_name.'</font>'; ?></div>
                                </div>
                                <div class="col-xs-6">
                                  <small>Hub</small>
                                  <div class="text-lt font-bold"><?php echo $hub; ?>
						<?php echo '<img src="../../main/images/flags/24/' . $hub_airport_flag . '.png" alt="' . $hub_airport_flag . '">' ?>
						<br>
						<?php echo '<font size="2">&nbsp;'.$hub_airport_name.'</font>'; ?></div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xs-6 text-right">
                                  <small>Rango</small>
                                  <div class="text-lt font-bold"><?php echo $rank; ?></div>
                                </div>
                                <div class="col-xs-6">
                                  <small>Registro</small>
                                  <div class="text-lt font-bold"><?php echo $register_date; ?></div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <footer class="panel-footer dk text-center no-border">
                            <div class="row pull-out">
                              <div class="col-xs-4">
                                <div class="padder-v">
                                  <span class="m-b-xs h3 block text-white"><?php echo $gva_hours; ?></span>
                                  <small class="text-muted">Horas</small>
                                </div>
                              </div>
                              <div class="col-xs-4 dker">
                                <div class="padder-v">
                                  <span class="m-b-xs h3 block text-white"><?php echo $num_pireps; ?></span>
                                  <small class="text-muted">Vuelos</small>
                                </div>
                              </div>
                              <div class="col-xs-4">
                                <div class="padder-v">
                                  <span class="m-b-xs h3 block text-white"><?php $contar=0; foreach ($planes_certificated as $x => $x_value) { $contar++;} echo '+' . $contar;?></span>
                                  <small class="text-muted">Certificaciones</small>
                                </div>
                              </div>
                            </div>
                          </footer>
                        </section>
                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-4 b-l no-padder">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                       
                        <section class="panel panel-default">
                          <h4 class="padder">Más Detalles</h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Tipo de Usuario <a href="#" class="text-info"><?php echo $user_types; ?></a></p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 sec ago</small>
                            </li>
                            <li class="list-group-item">
                                <p>Email <a href="#" class="text-info"><?php echo $email; ?></a></p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 sec ago</small>
                            </li>
                            <li class="list-group-item">
                                <p>Cumpleaños <a href="#" class="text-info"><?php echo $birth_date; ?></a></p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 sec ago</small>
                            </li>
							<li class="list-group-item">
                                <p>Hrs. Transferidas <a href="#" class="text-info"><?php echo $transfered_hours; ?></a></p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 1 sec ago</small>
                            </li>
                          </ul>
                        </section>
                        <section class="panel clearfix bg-info dk">
                          <div class="panel-body">
                            <a href="#" class="thumb pull-left m-r">
                              <img src="<?php echo $other_pilot_images; ?>" class="img-circle b-a b-3x b-white">
                            </a>
                            <div class="clear">
                              <a href="#" class="text-info">@<?php echo $pilotname . ' ' . $pilotsurname; ?> <i class="fa fa-user"></i></a>
                              <small class="block text-muted">IVAO <?php echo $ivaovid; ?></small>
                              <a href="#" class="btn btn-xs btn-info m-t-xs">ColStar Alliance</a>
                            </div>
                          </div>
                        </section>
						<section class="panel clearfix bg-info dk">
                          <div class="panel-body">
                            <a href="#" class="thumb pull-left m-r">
							<?php if(!empty($imagen_aerolinea)) { ?>
                              <img src="./images/portada/<?php echo $imagen_aerolinea; ?>" class="img-circle b-a b-3x b-white">
							<?php } else { ?>
							  <img src="./images/operators/<?php echo $file; ?>" class="img-circle b-a b-3x b-white">
							<?php } ?>
                            </a>
							<?php if($activation==0) {
								$estadopca = "Nuevo";
							} else if ($activation==1) {
								$estadopca = "Activo";
							} else if ($activation==2) {
								$estadopca = "Inactivo";
							} else if ($activation==3) {
								$estadopca = "Suspendido";
							} else if ($activation==4) {
								$estadopca = "En Vacaciones";
							}
								?>
                            <div class="clear">
                              <a href="#" class="text-info"><?php echo $operator; ?> <i class="fa fa-plane"></i></a>
                              <small class="block text-muted">Miembro <?php echo $estadopca; ?></small>
                              <a href="#" class="btn btn-xs btn-info m-t-xs"><?php echo $callsignva; ?></a>
                            </div>
                          </div>
                        </section>
                      </div>
                    </section>
                  </section>              
                </aside>
				<aside class="aside-lg bg-light lter b-r">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">
                       
                        <section class="panel panel-default">
                          <h4 class="padder">Información de Login Usuario</h4>
                          <ul class="list-group">
<?php 
    $contadores = 0;
    $sql = "SELECT * FROM historial_login where gvauser_id=$pilotID order by fecha desc limit 5";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) { 
	$contadores++;?>
                            <li class="list-group-item">
                                <p>IP <a href="http://es.geoipview.com/?q=<?php echo $row['ip']; ?>" target="_BLANK" class="text-info"><?php echo $row['ip']; ?></a> Navegador <a href="#" class="text-info"><?php echo $row['navegador']; ?></a></p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> <?php echo $row['fecha']; ?></small>
                            </li>
	<?php } 
	
	if ($contadores==0) { ?>
	                       <li class="list-group-item">
                                <div class="alert alert-danger"> No se encuentran inicios de sesión por parte del usuario.</div>
                            </li>
	<?php } ?>
                          </ul>
                        </section>
						 <section class="panel panel-default">
                          <h4 class="padder">Última Sancion de Usuario</h4>
                          <ul class="list-group">
<?php 
    $contadores = 0;
    $sql = "SELECT * FROM historial_status where gvauser_id=$pilotID order by fecha_inicio desc limit 1";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) { 
	$contadores++;
	
$comments = $row['comments']; 
$fecha_fin = $row['fecha_fin'];
$fecha_inicio = $row['fecha_inicio'];	
$datetime1 = new DateTime($fecha_inicio);
$datetime2 = new DateTime($fecha_fin);
$intervalos = $datetime1->diff($datetime2);
$interval = $intervalos->days;
$estado = $row['estado'];	
	
	if($estado==1) {
		$textosancion = "Activa";
	} else {
		$textosancion = "Finalizada";
	}
	?>
                            <li class="list-group-item">
                                <p><a href="#" class="text-info">Causa:</a> <?php echo $comments; ?></a><br>
                                * Fecha Inicio: <b><?php echo $row['fecha_inicio']; ?></b><br>
								* Fecha Fin: <b><?php echo $row['fecha_fin']; ?></b><br>
								* Total días: <b><?php echo $interval; ?></b></br></p>
								<small class="block text-muted"><i class="fa fa-clock-o"></i> <?php echo $textosancion; ?></small>
                            </li>
	<?php } 
	
	if ($contadores==0) { ?>
	                       <li class="list-group-item">
                                <div class="alert alert-danger"> No se encuentran sanciones al usuario.</div>
                            </li>
	<?php } ?>
                          </ul>
                        </section>
                      </div>
                    </section>
                  </section>              
                </aside>
              </section>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
	
	
	
	
	
	

	
	
	
	