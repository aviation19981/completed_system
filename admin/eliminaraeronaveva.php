
       <?php
	   
	   $aeronave = $_GET['aeronave'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
	$sql2p = "SELECT * from fleets where fleet_id='$aeronave'";  

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$image_url = $row2p['image_url'];
	}
			
				unlink('./images/planes/' . $image_url);
		
		$sql12 = "delete from fleets where fleet_id='$aeronave'";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=admonaeronaves';
 
</script>



