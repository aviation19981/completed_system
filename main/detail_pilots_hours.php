
<?php
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$numeroSemana = date("W"); 
	$numeroYear = date("Y"); 
	
	$sql_user = "SELECT * from gvausers order by callsign asc";
    
	if (!$result_user = $db->query($sql_user)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_user = $result_user->fetch_assoc()) {
	
	$gvauser_id = $row_user['gvauser_id'];
	$operator_id_session = $row_user['operator_id'];
	$pilotname = $row_user['name'] . ' ' . $row_user['surname'] . ' (' .  $row_user['callsign'] . ')';
	
	
	$horas = 0;
	$sql_vuelos_myself = "SELECT * from cstpireps where operator_id='$operator_id_session' and YEAR(fecha_envio)='$numeroYear' and WEEK(fecha_envio)='$numeroSemana' and gvauser_id='$gvauser_id'";
    
	if (!$result_vuelos_myself = $db->query($sql_vuelos_myself)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_vuelos_myself = $result_vuelos_myself->fetch_assoc()) {
		$horas = $horas+$row_vuelos_myself['connection_time'];
	}
	
	///////////////////////// Parameters
	
	
	$sql_parat = "SELECT * from va_parameters where va_parameters_id=1";
    
	if (!$result_parat = $db->query($sql_parat)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_parat = $result_parat->fetch_assoc()) {
		$hours_min_per_week = $row_parat['hours_min_per_week'];
		
	}
	
	
	
	if($horas>=$hours_min_per_week) {
		
		echo "El piloto " . $pilotname . " está cumpliendo las horas semanales ya que lo requerido es " . $hours_min_per_week . " hrs y realizó " . $horas . " hrs la semana " . $numeroSemana;
		
	} else {
		
		echo "El piloto " . $pilotname . "  no está cumpliendo las horas semanales ya que lo requerido es " . $hours_min_per_week . " hrs y realizó " . $horas . " hrs la semana " . $numeroSemana;
	

		
	}
	
	echo '<br>';
	
	
	}
	
	?>


