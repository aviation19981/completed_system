
       <?php
	   
	   $identis = $_GET['id'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql1 = "delete from airports where id='$identis'";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	   ?>
	   
	   
<script>   
	   
alert('Aeropuerto eliminado satisfactoriamente.');
window.location = './?page=aeropuertosva';
 
</script>



