
       <?php
	   
	   $tour = $_GET['tour'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		$sql2p = "SELECT * FROM tours where tour_id='$tour'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$tour_image = $row2p['tour_image'];
		$tour_award_image = $row2p['tour_award_image'];
	}
			
				unlink('./images/tour/logo/' . $tour_image);
				unlink('./images/tour/premio/' . $tour_award_image);
				
		$sql1 = "delete from tours where tour_id='$tour'";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql12 = "delete from tour_finished where tour_id='$tour'";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123 = "delete from tour_legs where tour_id='$tour'"; 

		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234 = "delete from tour_pilots where tour_id='$tour'"; 

		if (!$result1234 = $db->query($sql1234)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	   
	  
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=toursva';
 
</script>



