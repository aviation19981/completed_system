
<?php
	$pregunta = $_POST['pregunta'];
	$A = $_POST['A'];
	$B = $_POST['B'];
	$C = $_POST['C'];
	$D = $_POST['D'];
	$correcta = $_POST['correcta'];
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				$sql1 = "insert into preguntasdeexamen (pregunta,idexamen,A,B,C,D,respuesta_correcta)
                    values ('$pregunta','1','$A','$B','$C','$D','$correcta');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			

			
		
			
			
		

	
							
?>

<script>
alert('Pregunta agregada, sactisfactoriamente.');
window.location = './?page=editexamen';
</script>
			


