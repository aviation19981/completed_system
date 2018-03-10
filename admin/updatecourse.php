
<?php
	$name = $_POST['name'];
	$docentes = $_POST['docentes'];
	$aeronaves = $_POST['aeronaves'];
	$rank_id = $_POST['rank_id'];
	$description = $_POST['description'];
	$course_id = $_POST['course_id'];
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			

			
$sql1 = "update courses set name='$name', docentes='$docentes',  
			aeronaves='$aeronaves',  description='$description' where course_id='$course_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		
		$sql12 = "delete from ranktypes_course where course_id='$course_id'";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		for ($i=0;$i<count($rank_id);$i++)    
        {     
	
		
		$sql1 = "insert into ranktypes_course (course_id,rank_id)                    
						values ('$course_id','$rank_id[$i]');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
        } 
	
							
?>

<script>
alert('Curso actualizado, sactisfactoriamente.');
window.location = './?page=editarcurso&id=<?php echo $course_id; ?>';
</script>
			


