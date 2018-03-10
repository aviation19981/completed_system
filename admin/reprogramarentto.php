<?php
    include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	   error_reporting(E_ALL);
       ini_set('display_errors', '1');
	   
	   
	   $fecha_entto = $_POST["fecha_entto"];
	   $hora_entto = $_POST["hora_entto"];
	   $id_entto = $_POST["id_entto"];
	 
		
		$sql = "update request_entto set estado='5', fecha_entto='$fecha_entto', hora_entto='$hora_entto' where id_entto='$id_entto'";

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   

<script>   
	   
alert('Entrenamiento Programado.');
window.location = './?page=my_enttos';
 
</script>

