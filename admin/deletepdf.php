
       <?php
	   
	   $moduleid = $_GET['id'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
		$sql2p = "SELECT * FROM trainings_pdf where id='$moduleid'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$id_modulo = $row2p['id_modulo'];
		$pdf = $row2p['pdf'];
	}
			
				unlink('./pdf/' . $pdf);
				
				
				
		$sql1 = "delete from trainings_pdf where id=$moduleid";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=editarmodule&id=<?php echo $id_modulo; ?>';
 
</script>



