
       <?php
	   
	   $premio = $_GET['premio'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
		$sql2p = "SELECT * FROM awards where award_id='$premio'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$imagens = $row2p['award_image'];
	}
			
				unlink('./images/premios/' . $imagens);
				
				
				
				
		$sql1 = "delete from awards where award_id='$premio'";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=premiospilotos';
 
</script>



