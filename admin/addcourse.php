
<?php
	$name = $_POST['name'];
	$docentes = $_POST['docentes'];
	$aeronaves = $_POST['aeronaves'];
	$rank_id = $_POST['rank_id'];
	$description = $_POST['description'];
	
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				$sql1 = "insert into courses (name,description,docentes,aeronaves)
                    values ('$name','$description','$docentes','$aeronaves');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}

			 $idcouse = $db->insert_id;
			 
        for ($i=0;$i<count($rank_id);$i++)    
        {     
	
		
		$sql1 = "insert into ranktypes_course (rank_id,course_id)                    
						values ('$rank_id[$i]','$idcouse');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
        } 

	
							
?>

<script>
alert('Curso agregado, sactisfactoriamente.');
window.location = './?page=coursesadmon';
</script>
			


