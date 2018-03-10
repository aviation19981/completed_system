 <?php


$gvauserteacher = $_POST['docente'];
$aeronave = $_POST['aeronave'];
$comentarios = $_POST['comentarios'];

if (empty($aeronave)) {
	
?>

<script>
alert('<?php echo NEEDED_INFORMATION; ?>');
window.location.href='./index_user.php?page=center_training';
</script>

<?php	
	
	
} else
	
	{
		
		include ('./db_login.php');
	    require_once('./sent_email.php');	
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	
//// HOSTING 
	
$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
array_pop($baseuri);	array_pop($baseuri);
$baseuri = "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri);

//////////////// INFORMACIÓN DOCENTE
		
        $sql2 = "SELECT * FROM gvausers where  gvauser_id='" . $gvauserteacher . "'";
		
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		while ($row2 = $result2->fetch_assoc()) {
			
			$nombre_user = $row2["name"];
			$apellido_user = $row2["surname"];
			$email_user = $row2["email"];
			$ivao_vid_user = $row2["ivaovid"];
			$idpilot = $row2["gvauser_id"];
			
		}




            /////////////////////////// EMAIL SENT 
	
	
	     
		   $mail = new system_mailer();
		   $mail->training_request($email_user,$nombre_user,$apellido_user,$ivao_vid_user,$idpilot,$comentarios,$aeronave,$pilotname,$pilotsurname,$callsign,$email);  
		

           ///////////////////////// ADD TO DATABASE
		   
		        $sql = "insert into request_entto (id_teacher,id_student,plane,comments,estado,fecha_solicitud)
                    values ('$gvauserteacher','$id','$aeronave','$comentarios','0',now());";
				if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
				}





?>

<script>
alert('<?php echo EMAIL_READY_TWO; ?>');
window.location.href='./index_user.php?page=center_training';
</script>

<?php

	} ?>