
<?php
	$title = $_POST['title'];
	$coment = $_POST['coment'];
	$duration = $_POST['duration'];
	$training_id = $_POST['training_id'];
	$limite = $_POST['limite'];
	$course_id = $_POST['course_id'];
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				$sql1 = "insert into config_examen (titulo,duracion,limite,descripcion,course_id,training_id)
                    values ('$title','$duration','$limite','$coment','$course_id','$training_id');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			


	
							
?>

<script>
alert('Examen agregado, sactisfactoriamente.');
window.location = './?page=moduleexamens&id=<?php echo $course_id; ?>';
</script>
			


