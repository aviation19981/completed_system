
<?php
	
		
		$pilot = $_GET['pilotid'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql = "select * from gvausers where gvauser_id=$pilot";  
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {
			$name = $row['name'];
			$callsign = $row['callsign'];
			$usertype = $row['user_type_id'];
			$language = $row['language'];
			$pilot_vid = $row['ivaovid'];
			$imagens = $row['pilot_image'];
			$email_pilot = $row['email'];
		}
		
		
		
		
		unlink('./images/uploads/' . $imagens);
		
		$sql1 = "delete from gvausers where gvauser_id=$pilot";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql12 = "delete from cstpireps where vid=$pilot_vid";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123 = "delete from award_pilots where gvauser_id=$pilot";  

		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234 = "delete from cancellations where gvauser_id=$pilot";  

		if (!$result1234 = $db->query($sql1234)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	   
	   $sql12345 = "delete from bank where gvauser_id=$pilot";  

		if (!$result12345 = $db->query($sql12345)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123456 = "delete from compras_tienda where gvauser_id=$pilot";  

		if (!$result123456 = $db->query($sql123456)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234567 = "delete from fleettypes_gvausers where gvauser_id=$pilot";  

		if (!$result1234567 = $db->query($sql1234567)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql12345678 = "delete from jumps where gvauser_id=$pilot";  

		if (!$result12345678 = $db->query($sql12345678)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   
	   $sql1234567890 = "delete from tour_pilots where gvauser_id=$pilot";  

		if (!$result1234567890 = $db->query($sql1234567890)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql12345678900 = "delete from va_finances where gvauser_id=$pilot";  

		if (!$result12345678900 = $db->query($sql12345678900)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		
		
$contadores=0;
$contadores2=0;		
 $sqlstaff = "select * from config_emails where config_emails_id<>0";
	if (!$resultstaff = $db->query($sqlstaff)) {
		die('There was an error running the query [' . $db->error . ']');
	}
while ($rowstaff = $resultstaff->fetch_assoc()) {
	$contadores++;
}



//$sqlemstaff = "select * from config_emails where config_emails_id<>0";
	//if (!$resultemstaff = $db->query($sqlemstaff)) {
		//die('There was an error running the query [' . $db->error . ']');
	//}
//while ($rowemstaff = $resultemstaff->fetch_assoc()) {
	//$contadores2++;
	
	//if($contadores2==1) {
		//$para  = $rowemstaff['staff_email'] . ", " ; // fijese en la comma
	//} else {
	
	//if($contadores==$contadores2) {
		//$para .= $rowemstaff['staff_email'];
	//} else {
		//$para  .= $rowemstaff['staff_email'] . ", " ; // fijese en la comma
	//}
	
	//}
	
	
//}
	
		
		

		
		
		
$para = 'aviation19981@live.com';
$titulo    = 'ColStar VA System - Solicito Retiro';
$mensaje = 'Buen dia, yo Piloto de ColStar VA, solicito formalmente el retiro de la misma.

- Nombre: ' . $name . '
- Callsign: ' . $callsign . '
- La Ip del solicitante es: ' . $_SERVER["REMOTE_ADDR"] . '
- Hora envio: ' . date("d-m-Y H:i:s") . '

---------------------------------------------------
MENSAJE ENVIADO AUTOMATICAMENTE.
---------------------------------------------------

Saludos ColStar VA System';


$cabeceras = 'From: ' . $email_pilot . "\r\n" .
    'Reply-To: ' . $email_pilot . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
		
		
	session_start();
	session_unset();
	unset($pilot);
	unset($callsign);
	unset($language);
	unset($usertype);
	session_destroy();
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=../">'
		
	
?>


<script>
alert('<?php echo BYE_SYSTEM; ?>');
window.location = './index.php';
</script>
