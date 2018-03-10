
       <?php
	   
	   		include('./db_login.php');
			
       $staff_email = $_POST['staff_email'];
	    $cargo = $_POST['cargo'];
		$staff = $_POST['staff'];
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		

		
		
		$sql1 = "insert into config_emails (staff_email,cargo,staff)                    
						values ('$staff_email','$cargo','$staff');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	
			
		
	   ?>
	   
	   
<script>   
	   
alert('Email Agregado satisfactoriamente.');
window.location = './?page=emails';
 
</script>



