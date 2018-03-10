
<?php
	
		
		
	$pilot= $_POST['pilotos'];
	$nota = $_POST['note'];
	$fecha = $_POST['date'];
	$ids = $_POST['ids'];
	$comments = $_POST['comments'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql1 = "UPDATE training set nota=$nota, fecha='$fecha', comments='$comments' where id=$ids";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Nota actualizada, satisfactoriamente.');
window.location = './?page=perfomance&pilotid=<?php echo $pilot; ?>';
</script>
