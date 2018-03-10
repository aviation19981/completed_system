
       <?php
	   
	   		include('./db_login.php');
			
	   $nombrea = $_POST["nombre"];
		$abreviaciona=  $_POST["abreviacion"];
		$logoa= $_POST["logo"];

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
	
	
		$sql1 = "insert into simuladores (nombre,abreviacion,logo)                    
						values ('$nombrea','$abreviaciona','$logoa');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
  
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Simulador agregado satisfactoriamente.');
window.location = './?page=simulators';
 
</script>



