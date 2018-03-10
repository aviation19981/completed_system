
<?php
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select short_name,iso2 from country_t order by short_name asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$combocountry = '';
	while ($row = $result->fetch_assoc()) {
		$combocountry .= " <option value='" . $row['iso2'] . "'>" . $row['short_name'] . "</option>"; //concatenamos el los options para luego ser insertado en el HTML
	}	

?>