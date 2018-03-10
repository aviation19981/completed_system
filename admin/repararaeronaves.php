
       <?php
	   
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql1 = 'update fleets set status="100" where status<100 and operator_id IN (' . implode(',', array_map('intval', $airlines)) . ')';

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$aeronavesupdate= $db->affected_rows;
		
	   ?>
	   
	   
<script>   
	   
alert('<?php echo $aeronavesupdate; ?> Aeronaves actualizadas satisfactoriamente.');
window.location = './?page=admonaeronaves';
 
</script>



