
       <?php
	   
	   $rank_id = $_GET['rank_id'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
		$sql2p = "SELECT * FROM ranks where rank_id='$rank_id'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$imagens = $row2p['img'];
		$imagens2 = $row2p['diploma'];
	}
			
				unlink('./images/ranks/' . $imagens);
				unlink('./images/diplomas/' . $imagens2);
				
				
				
		$sql1p = "delete from ranks where rank_id=$rank_id";  

		if (!$result1p = $db->query($sql1p)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql5 = "delete from fleettypes_ranks where rank_id='$rank_id'";  

		if (!$result5 = $db->query($sql5)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql23p = "select * from courses where rank_id='$rank_id'";  
	    if (!$result23 = $db->query($sql23)) {
		  die('There was an error running the query [' . $db->error . ']');
	    }
	
	    while ($row23p = $result23p->fetch_assoc()) {
		    $idcurso = $row23["course_id"];
		
		
		
		$sql = "delete from courses where course_id='$idcurso'";  

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1 = "delete from ranktypes_course where course_id='$idcurso'";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql2 = "delete from trainings where course_id='$idcurso'";  

		if (!$result2 = $db->query($sql2)) {
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
		
		
		
		
		
		}
		
	   ?>
	   
	   
<script>   
	   
alert('Información eliminada satisfactoriamente.');
window.location = './?page=rangospilotos';
 
</script>



