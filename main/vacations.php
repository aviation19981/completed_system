
<?php
	
		
		$pilot = $_GET['pilotid'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
			$sql1 = "update gvausers set activation=4 where gvauser_id=$pilot";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_user.php?page=logout">';
	
?>


