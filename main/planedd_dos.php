
<?php
    include('./db_login.php');
	include('./get_pilot_data.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	 //  Get plane certifications

	$sql = "select * from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' order by plane_description asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	$planes = '';

	$planes_certificated = array();

	$i = 0;

	while ($rowusuarios = $result->fetch_assoc()) {

		$planes .= $rowusuarios["fleettype_id"] . '</br>';

		$planes_certificated[$i] = $rowusuarios["fleettype_id"];

		$i++;

	}
	
	//////////////////////
	
	
	// get VA parameters
		$sqlva = "select * from va_parameters";
		$va_name = '';
		
		$plane_status_hangar = '';
		$hangar_maintenance_days = '';
		$hangar_maintenance_value = '';
		
		if (!$resultva = $db->query($sqlva)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row3 = $resultva->fetch_assoc()) {
			$va_name = $row3["va_name"];
			
			$flight_wear = $row3["flight_wear"];
			
			$plane_status_hangar = $row3["plane_status_hangar"];
			$hangar_maintenance_days = $row3["hangar_maintenance_days"];
			$hangar_maintenance_value = $row3["hangar_maintenance_value"];
			
		}	
		
		
		
	$query = "select fleet_id,fleettype_id, registry,status,location,booked,gvauser_id from fleets where location='$location' and status>='$plane_status_hangar' and booked=0";
	if (!$result = $db->query($query)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combobit = '';
	//while ($row = $result->fetch_array(MYSQLI_ASSOC))
		
		
		
	while ($row = $result->fetch_assoc()) {
		
$fleettype_id = $row['fleettype_id'];

		$query2 = "select fleettype_id, plane_description	 from fleettypes where fleettype_id='$fleettype_id'";
	if (!$result2 = $db->query($query2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row2 = $result2->fetch_assoc()) {
$fleettype_id	= $row2['fleettype_id'];
$plane_description	 = $row2['plane_description'];
	}
		
	foreach ($planes_certificated as $x => $x_value) {
		if ($x_value == $fleettype_id	) {
		$combobit .= " <option value='" . $row['fleet_id'] .  "'>" . $plane_description	 . " (" . $row['registry'] . ")</option>"; //concatenamos el los options para luego ser insertado en el HTML
	    }
	}
	
		}
?>
