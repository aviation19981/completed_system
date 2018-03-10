
       <?php
	   
	   $pilot_id = $_GET['pilot_id'];
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql1 = "update gvausers set activation=2 where gvauser_id=$pilot_id";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Piloto inactivado satisfactoriamente.');
window.location = './?page=admonpilotos';
 
</script>



