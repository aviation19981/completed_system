
<?php
	include('./db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	////////////////////////// Review Class /////////////////////////////////////////////
	
	$sql = "delete  from citacion where fecha<now()";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	
	
	$sql_pca = 'UPDATE request_entto SET estado="3" where fecha_entto<now() and estado<>3 and estado<>4 and fecha_entto<>""';

	if (!$result_pca = $db->query($sql_pca)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	////////////////////////// Review Suspensions //////////////////////////////////////////////////
	
	$today = date("Y-m-d");
	$sql_suspension = "select * from historial_status where '$today'>=DATE(fecha_fin) and estado='1'";

	if (!$result_suspension = $db->query($sql_suspension)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row_suspension = $result_suspension->fetch_assoc()) {
		   $gvauser_id_pca = $row_suspension['gvauser_id'];
		   $id_sancion = $row_suspension['id'];
		   
		    $query2 = "UPDATE gvausers set activation='1' where gvauser_id='$gvauser_id_pca'";
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
			$query3 = "UPDATE historial_status set estado='2' where id='$id_sancion'";
			if (!$result3 = $db->query($query3)) {
				die('There was an error running the query [' . $db->error . ']');
			}
		
	}
	
	
?>

