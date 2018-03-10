
       <?php
	   
	   $tour = $_GET['tour'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
	
		
		
		$sql123 = "delete from tour_legs where tour_leg_id='$tour'"; 

		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234 = "delete from tour_pilots where leg_id='$tour'"; 

		if (!$result1234 = $db->query($sql1234)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	   
	  
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=toursva';
 
</script>



