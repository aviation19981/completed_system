
       <?php
	   $flighttype = $_POST['flighttype'];
		$flighttype_id = $_POST['flighttype_id'];
	
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql1 = "update flighttypes set flighttype='$flighttype'  where flighttype_id=$flighttype_id";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Tipo de vuelo actualizado satisfactoriamente.');
window.location = './?page=tiposdevuelo';
 
</script>



