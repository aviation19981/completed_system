<?php
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$idreserve = $_GET['id'];

	$query21 = "update reserves set alterno_landing='1' where id='$idreserve'";
	
	if (!$result21 = $db->query($query21)) {
	die('There was an error running the query [' . $db->error . ']');
	} 
		?>
		
			
			<script>
alert('<?php echo ALTERN_FLIGHT; ?>');
window.location = './index_user.php?page=volar';
</script>
		