
<?php
	include('./db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	

	
	
	// HORARIO CANCELACION
	
	
	
		$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$hours_auto_cancellation = 0;
	
	while ($row = $result->fetch_assoc()) {
		$hours_auto_cancellation = $row["hours_auto_cancellation"];
	}
	
	
	
	
	
	
	
	
	
	// FIN
	
	
	
	
	
	$sql = "select route_id, gvauser_id, fleet_id  from reserves where HOUR(timediff(now(),date))>='$hours_auto_cancellation'";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$plane = $row["fleet_id"];
		$pilot = $row["gvauser_id"];
		$sql1  = "update gvausers set route_id= NULL, book_date= NULL where gvauser_id='$pilot'";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
		$sql1 = "update fleets set booked=0 , booked_at=null where fleet_id='$plane'";
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	}
	$sql = "delete  from reserves where HOUR(timediff(now(),date))>='$hours_auto_cancellation'";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	
	// Clean not used aircraft for charter
	$sql = "update fleets set booked=0 , booked_at=null where booked=1 and HOUR(timediff(now(),booked_at))>='$hours_auto_cancellation'";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	
?>

