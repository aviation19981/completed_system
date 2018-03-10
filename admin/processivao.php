
<?php
	$nombredest = $_POST['nombredest'];
	$emaildest = $_POST['emaildest'];
	$subject = $_POST['subject'];
	$contenidos = $_POST['contenidos'];
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				
$para      = $emaildest;
$titulo    = 'ColStar VA System - ' . $subject;
$mensaje = $contenidos;


// EMAIL STAFF
	
	
	
		$sqlemail = "select * from config_emails where config_emails_id=0";
	if (!$resultemail = $db->query($sqlemail)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$staff_email = "";
	
	while ($rowemail = $resultemail->fetch_assoc()) {
		$staff_email = $rowemail["staff_email"];
	}

$cabeceras = 'From: ' . $staff_email . "\r\n" .
    'Reply-To: ' . $staff_email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($para, utf8_decode($titulo), utf8_decode($mensaje), $cabeceras);




		
		$db->close();

	
							
?>

<script>
alert('Correo enviado, sactisfactoriamente.');
window.location = './?page=ivao';
</script>
			


