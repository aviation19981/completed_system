
       <?php
	    $event_id = $_POST["event_id"];
		$event_name = $_POST["event_name"];
		$publish_date=  $_POST["publish_date"];
		$hide_date= $_POST["hide_date"];
		$event_text= $_POST["event_text"];
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql1 = "update events set event_name='$event_name', publish_date='$publish_date',  
		hide_date='$hide_date',  event_text='$event_text'  where event_id=$event_id";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Evento actualizado satisfactoriamente.');
window.location = './?page=updateeventova&evento=<?php echo $event_id; ?>';
 
</script>



