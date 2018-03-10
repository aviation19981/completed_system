
<?php
	$title = $_POST['title'];
	$content = $_POST['content'];
	$description = $_POST['description'];
	$training_id = $_POST['training_id'];
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			

			
$sql1 = "update trainings set title='$title', content='$content',  
			description='$description'  where training_id='$training_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}

	
							
?>

<script>
alert('Módulo actualizado, sactisfactoriamente.');
window.location = './?page=editarmodule&id=<?php echo $training_id; ?>';
</script>
			


