
<?php
	
		
		$training_id = $_GET['id'];
		$moduloid = $_GET['moduloid'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	
	
		
		
		
		$sql1 = "delete from trainings where training_id=$training_id";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql4 = "select * from trainings_pdf where id_modulo='$training_id'";  
		
		if (!$result4 = $db->query($sql4)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row4 = $result4->fetch_assoc()) { 
		$linkpdf = $row4['pdf'];
		unlink('./pdf/' . $linkpdf);
		$idpdf = $row4['id'];
		
		$sql6 = "delete from trainings_pdf where id=$idpdf";  

		if (!$result6 = $db->query($sql6)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		}
		
	
?>


<script>
alert('Módulo eliminado');
window.location = './?page=moduloscursos&id=<?php echo $moduloid; ?>';
</script>
