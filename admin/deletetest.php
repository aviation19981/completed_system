
<?php
	
		
		$identificacion = $_GET['id'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	
	
		
		
		
		$sql1 = "delete from config_examen where id=$identificacion";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql12 = "delete from preguntasdeexamen where idexamen=$identificacion";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123 = "delete from training where examen=$identificacion";  

		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
?>


<script>
alert('Examen eliminado');
window.location = './?page=coursesadmon';
</script>
