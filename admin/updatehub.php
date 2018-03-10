
       <?php
	   
	   		include('./db_login.php');
			
       $hub_id = $_POST['hub_id'];
		$hub = $_POST['hub'];
		$web = $_POST['web'];
		$image_url = $_POST['image_url'];
		$training = $_POST['training'];
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	
			
			
			$sql1 = "update hubs set hub='$hub', web='$web', image_url='$image_url', training='$training'
			where hub_id='$hub_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	
			
		
	   ?>
	   
	   
<script>   
	   
alert('Hub actualizado satisfactoriamente.');
window.location = './?page=edithub&hubid=<?php echo $hub_id; ?>';
 
</script>



