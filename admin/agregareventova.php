
       <?php
	   
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
		
		
		
			$sql12 = "insert into events (event_name,publish_date,hide_date,event_text,create_date,gvauser_id)                    
						values ('$event_name','$publish_date','$hide_date','$event_text',now(),'$id');";				
						if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Evento agregado satisfactoriamente.');
window.location = './?page=eventosva';
 
</script>



