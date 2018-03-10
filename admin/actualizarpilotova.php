
       <?php
	   
	   $activation_pca = $_POST['activation'];
	   $gvauser_id_pca = $_POST['gvauser_id'];
	   $name_pca = $_POST['name'];
	   $surname_pca = $_POST['surname'];
	   $callsign_pca = $_POST['callsign'];
	   $email_pca = $_POST['email'];
	   $user_type_id_pca = $_POST['user_type_id'];
	   $ivaovid_pca = $_POST['ivaovid'];
	   $hub_id_pca = $_POST['hub_id'];
	   $location_pca = $_POST['location'];
	   $city_pca = $_POST['city'];
	   $birth_date_pca = $_POST['birth_date'];
	   $transfered_hours_pca = $_POST['transfered_hours'];
	   $callsign_prev_pca = $_POST['callsign_prev'];
	   $operator_id = $_POST['operator_id'];
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql1 = "update gvausers set operator_id='$operator_id', activation='$activation_pca', name='$name_pca',  surname='$surname_pca',  callsign='$callsign_pca',  email='$email_pca',  user_type_id='$user_type_id_pca', ivaovid='$ivaovid_pca', hub_id='$hub_id_pca', location='$location_pca', city='$city_pca', birth_date='$birth_date_pca', transfered_hours='$transfered_hours_pca'   where gvauser_id=$gvauser_id_pca";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		if($callsign_pca<>$callsign_prev_pca) {
			
			
			
			
			//////////////////////// ENVIAR CORREO ////////////////////////////////
			
			
				
			// EMAIL STAFF
	
	
	
		$sqlemail = "select * from config_emails where config_emails_id=0";
	if (!$resultemail = $db->query($sqlemail)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$staff_email = "";
	
	while ($rowemail = $resultemail->fetch_assoc()) {
		$staff_email = $rowemail["staff_email"];
	}
	
	
	
	
	
	
	
	
	
	// FIN
		
		// Send e-mail to pilot.
$sender = $staff_email;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
$headers .= 'From: '.$sender."\r\n";
		
		
		// Base URL for e-mail messages
$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
array_pop($baseuri);	array_pop($baseuri);
$baseuri = "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri);
		
		
$para      = $email_pca;
$titulo    = 'ColStar VA System - Datos de Ingreso Sistema';



$mensaje = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ColStar VA | Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="' . $baseuri . '/email_img/correos.png" alt="Pilot" width="600" height="230" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Saludos ' . $name_pca . ' ' . $surname_pca . ' desde ColStar VA!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										En este Email, encontrará la información actualizada en ColStar VA.<br><br>
										Usted tiene un nuevo callsign y es: <b>' . $callsign_pca . '  </b><br><br>
										
									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="' . $baseuri . '/email_img/inscripcion.png" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																
																<h3>Esperamos que disfrutes de nuestros servicios!</h3><br>
																<b>Mensaje Generado Automáticamente</b>
															</td>
														</tr>
													</table>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">
													&nbsp;
												</td>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="' . $baseuri . '/email_img/ivao.png" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																<h2><b>Compartiendo más que una pasión!</b></h2><br>

															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; ColStar VA Simulation<br/>
										<a href="#" style="color: #ffffff;"><font color="#ffffff">Compartiendo</font></a> la misma pasión!
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="http://colstarva.co/" style="color: #ffffff;">
														<img src="' . $baseuri . '/email_img/ivao.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.facebook.com/colstarva/?fref=ts" style="color: #ffffff;">
														<img src="' . $baseuri . '/email_img/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';





mail($para, $titulo, $mensaje, $headers);
			
			
			
			
			///////////////////////////// FIN ///////////////////
			
			
			
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Piloto actualizado satisfactoriamente.');
window.location = './?page=admonpilotos';
 
</script>



