<?php
    include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	$ivao = 0;
	$admisiones ='';
	$pirep_manual = 0;
	$allow_charter_flight = '';
	$flight_wear = '';
	$plane_status_hangar = '';
	$hangar_maintenance_days = '';
	$hangar_maintenance_value = '';
	$number_pilots = '';
	
	while ($row = $result->fetch_assoc()) {
		$ivao = $row["ivao"];
        $admisiones = $row["admisiones"];
		$pirep_manual = $row["pirep_manual"];
	    $allow_charter_flight = $row["allow_charter_flight"];
		$flight_wear = $row["flight_wear"];
		$plane_status_hangar = $row["plane_status_hangar"];
		$hangar_maintenance_days = $row["hangar_maintenance_days"];
		$hangar_maintenance_value = $row["hangar_maintenance_value"];
		$number_pilots = $row["number_pilots"];
	}
	
?>
