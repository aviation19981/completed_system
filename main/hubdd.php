
<?php
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$sqlgva = " select * from gvausers where gvauser_id='$id'";
	if (!$resultgva = $db->query($sqlgva)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowgva = $resultgva->fetch_assoc()) {
		$hub_id = $rowgva['hub_id'];
	}
	
	$sql = "select hub_id,hub from hubs order by hub asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combohub_id = '';
	while ($row = $result->fetch_assoc()) {
		if($hub_id==$row['hub_id']) {
				$combohub_id .= " <option value='" . $row['hub_id'] . "' selected>" . $row['hub'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
		} else {
$combohub_id .= " <option value='" . $row['hub_id'] . "'>" . $row['hub'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
		
		}
	}
?>
