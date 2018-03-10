<?php
	include('./db_login.php');
			
	$pregunta = $_POST['pregunta'];
	$A = $_POST['A'];
	$B = $_POST['B'];
	$C = $_POST['C'];
	$D = $_POST['D'];
	$correcta = $_POST['correcta'];
	$idquestion = $_POST['idquestion'];

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		

			
			$sql1 = "update preguntasdeexamen set pregunta='$pregunta', A='$A',  B='$B',  C='$C',  D='$D',  respuesta_correcta='$correcta' 	where id='$idquestion'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Pregunta examen actualizada.');
window.location = './?page=editaskexamen&id=<?php echo $idquestion; ?>';
 
</script>



