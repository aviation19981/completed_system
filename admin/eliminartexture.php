
       <?php
	   
	   $text = $_GET['text'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	$sql = "select * from textures where id='$text'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$imagen = $row['imagen'];
		$idsim = $row['idsim'];
	}
		unlink('./images/aviones/' . $imagen);
		
		$sql1 = "delete from textures where id=$text";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=texturasim&sim_id=<?php echo $idsim; ?>';
 
</script>



