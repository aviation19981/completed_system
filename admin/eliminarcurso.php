
<?php
	
		
		$idcurso = $_GET['id'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	
	
		
		
		
		$sql = "delete from courses where course_id='$idcurso'";  

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1 = "delete from ranktypes_course where course_id='$idcurso'";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		
		$sql23 = "select * from config_examen where course_id='$idcurso'";  
	    if (!$result23 = $db->query($sql23)) {
		  die('There was an error running the query [' . $db->error . ']');
	    }
	
	    while ($row23 = $result23->fetch_assoc()) {
		    $idexamen = $row23["id"];
		}
		
		$sql3 = "delete from config_examen where course_id='$idcurso'";  

		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql4 = "delete from preguntasdeexamen where idexamen='$idexamen'";  

		if (!$result4 = $db->query($sql4)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql9 = "select * from trainings where course_id='$idcurso'";  
		
		if (!$result9 = $db->query($sql9)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row9 = $result9->fetch_assoc()) { 
		/////////////////////
		$training_id_module = $row9['training_id'];
		$sql6 = "select * from trainings_pdf where id_modulo='$training_id_module'";  
		
		if (!$result6 = $db->query($sql6)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row6 = $resul6->fetch_assoc()) { 
		$linkpdf = $row6['pdf'];
		unlink('./pdf/' . $linkpdf);
		$idpdf = $row6['id'];
		
		$sql7 = "delete from trainings_pdf where id=$idpdf";  

		if (!$result7 = $db->query($sql7)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		}
		////////////////////
		}
		
		
		
		
		
		$sql2 = "delete from trainings where course_id='$idcurso'";  

		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
?>


<script>
alert('Objetivo eliminado');
window.location = './?page=coursesadmon';
</script>
