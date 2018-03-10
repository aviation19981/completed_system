

<?php
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select DISTINCT departure from routes order by departure asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$comboicao = '';
	while ($row = $result->fetch_assoc()) {




		$comboicao .= " <option value='" . $row['departure'] .  "'>" . $row['departure'] .  "</option>"; //concatenamos el los options para luego ser insertado en el HTML


}

?>
	