
       <?php
	   
	   $tipousuario = $_GET['tipousuario'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
	
				
		$sql1 = "delete from user_types where user_type_id=$tipousuario";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql3 = "delete from staff_airline_allow where user_type_id=$tipousuario";  

		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql12 = "update gvausers set user_type_id='2' where user_type_id=$tipousuario";

		if (!$result2 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=tiposdeusuario';
 
</script>



