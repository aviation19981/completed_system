
       <?php
	   
	   $gallery_id = $_GET['va'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
		$sql2p = "SELECT * FROM gallery_operators where id='$gallery_id'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$img_operator = $row2p['img_operator'];
		$operator_id = $row2p['operator_id'];
	}
			
				unlink('./images/portada/' . $img_operator);
				
				
				
		$sql1 = "delete from gallery_operators where id=$gallery_id";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=galleryerolinea&va=<?php echo $operator_id; ?>';
 
</script>



