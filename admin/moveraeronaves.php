
       <?php
	   
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$aeronavesupdate=0;
	$hub_id = '';
	$location = '';
		
	$sql = "select * from fleets where booked=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	if (in_array($row['operator_id'], $airlines)) {
	$hub_id = $row['hub_id'];
	$location = $row['location'];
	$fleet_id = $row['fleet_id'];
	
	$sqlhub = "select * from hubs where hub_id='$hub_id'";
	if (!$resulthub = $db->query($sqlhub)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($rowhub = $resulthub->fetch_assoc()) {
	$hub= $rowhub['hub'];
}

if($location==$hub) {
	
} else {
	
	$sql1 = "update fleets set location='$hub' where fleet_id='$fleet_id'";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
	    
	$aeronavesupdate++;	
}

	
	}		
		
}	


	   ?>
	   
	   
<script>   
	   
alert('<?php echo $aeronavesupdate; ?> Aeronaves actualizadas satisfactoriamente.');
window.location = './?page=admonaeronaves';
 
</script>



