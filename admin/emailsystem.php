
       <?php
	   
	   		include('./db_login.php');
		 $host= $_SERVER["HTTP_HOST"];	
         $correosystem = "staff@";
		 $emailfinal = str_replace("www.", "", $host);
		 $system_email = $correosystem . $emailfinal;
		 
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	
			
			
			$sql1 = "update config_emails set staff_email='$system_email' where config_emails_id=0";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	
			
		
	   ?>
	   
	   
<script>   
	   
alert('Correo actualizado satisfactoriamente.');
window.location = './?page=emails';
 
</script>



