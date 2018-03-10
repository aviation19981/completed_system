<?php
    include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$language = "";
	$sqlgva = " select * from gvausers where gvauser_id='$id'";
	if (!$resultgva = $db->query($sqlgva)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowgva = $resultgva->fetch_assoc()) {
		$language = $rowgva['language'];
	}
	
	$sql = "select language_name, file_sufix from languages order by language_name asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$linklanguage = '';
	$combolanguage = '';
	while ($row = $result->fetch_assoc()) {
		if($language==$row['file_sufix']) {
			$combolanguage .= " <option value='" . $row['file_sufix'] . "' selected>" . $row['language_name'] . "</option>";
		} else {
			$combolanguage .= " <option value='" . $row['file_sufix'] . "'>" . $row['language_name'] . "</option>";
		}
		
	}
?>
