
<?php
	
		
		
	$identis = $_POST['identi'];
	$hours = $_POST['hour'];
	$dates = $_POST['date'];
	$coments = $_POST['coment'];
	
	
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql1 = "UPDATE citacion set hora='$hours', fecha='$dates', comentarios='$coments' where id=$identis";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Citación actualizada, satisfactoriamente.');
window.location = './?page=docente';
</script>
