
       <?php
	   
	   		include('./db_login.php');
			
        $hub = $_POST['hub'];
	    $web = $_POST['web'];
		$image_url = $_POST['image_url'];
		$training = $_POST['training'];
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		

		
		
		$sql1 = "insert into hubs (hub,web,image_url,training)                    
						values ('$hub','$web','$image_url','$training');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	
			
		
	   ?>
	   
	   
<script>   
	   
alert('Hub Agregado satisfactoriamente.');
window.location = './?page=hubs';
 
</script>



