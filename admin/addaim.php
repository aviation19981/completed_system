
<?php
	$objetivo = $_POST['objetivo'];
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				$sql1 = "insert into temascalificacion (nombre)
                    values ('$objetivo');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			


	
							
?>

<script>
alert('Objetivo agregado, sactisfactoriamente.');
window.location = './?page=calificar';
</script>
			


