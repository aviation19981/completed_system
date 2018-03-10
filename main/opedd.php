
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
		$operator_id = $rowgva['operator_id'];
	}
	
	$sql = "select operator_id,operator from operators order by operator asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combooperador_id = '';
	while ($row = $result->fetch_assoc()) {
		if($operator_id==$row['operator_id']) {
			$combooperador_id .= " <option value='" . $row['operator_id'] . "' selected>" . $row['operator'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
		} else {
			$combooperador_id .= " <option value='" . $row['operator_id'] . "'>" . $row['operator'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
	}
?>
