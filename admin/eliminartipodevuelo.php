
       <?php
	   
	   $tipovuelo = $_GET['tipovuelo'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql1 = "delete from flighttypes where flighttype_id=$tipovuelo";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	$sql2 = "update routes set flighttype_id=''	where flighttype_id='$tipovuelo'";

		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=tiposdevuelo';
 
</script>



