
<?php
	
		
		

	
	
	        $title = $_POST['title'];
			$coment = $_POST['coment'];
			$duration = $_POST['duration'];
			$limite = $_POST['limite'];
			
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
				$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql1 = "UPDATE config_examen set titulo='$title', duracion='$duration', descripcion='$coment', limite='$limite' where id=1";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Examen actualizado, satisfactoriamente.');
window.location = './?page=editexamen';
</script>
