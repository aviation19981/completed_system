
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
	   $operator_id  = $_POST['operator_id'];
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
$reconocido = 0;		
$sql = "select * from gvausers where callsign='$callsign_pca'";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row = $result->fetch_assoc()) { 
$reconocido++;
}

		
		
		if($reconocido==0) {
			$sql1 = "update gvausers set activation='$activation_pca', name='$name_pca',  rank_id='0', surname='$surname_pca',  callsign='$callsign_pca',  email='$email_pca',  user_type_id='$user_type_id_pca', ivaovid='$ivaovid_pca', hub_id='$hub_id_pca', location='$location_pca', city='$city_pca', birth_date='$birth_date_pca', operator_id='$operator_id' where gvauser_id=$gvauser_id_pca";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	
			
			
			
			
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
	
	
	
	// INFO VIRTUAL AIRLINE
	
	
	
		$sqlairline = "select * from operators where operator_id='$operator_id'";
	if (!$resultairline = $db->query($sqlairline)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($rowairline = $resultairline->fetch_assoc()) {
		$nombreaerolinea = $rowairline["operator"];
		$facebook_url = $rowairline["facebook"];
		$whatsapp_url = $rowairline["whatsapp"];
	}
	
	
	if(empty($facebook_url)) {
		$informacionfacebook = '<li>' . $nombreaerolinea . ' no tiene aún grupo de facebook.</li>';
	} else {
		$informacionfacebook = '<li><a href="' . $facebook_url . '">Grupo Facebook :: ' . $nombreaerolinea . '</a></li>';
	}
	
	
	if(empty($whatsapp_url)) {
		$informacionwhatsapp = '<li>' . $nombreaerolinea . ' no tiene aún grupo de Whatsapp.</li>';
	} else {
		$informacionwhatsapp = '<li><a href="' . $whatsapp_url . '">Grupo Whatsapp :: ' . $nombreaerolinea . '</a></li>';
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
$titulo    = 'ColStar Alliance System - Datos de Ingreso Sistema';







$mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar Alliance | Email</title>
  <style type="text/css">
    sup { vertical-align:top; line-height:100%; }
    
    .ReadMsgBody {width: 100%;}
    .ExternalClass {width: 100%;}
    .applelinks a { color:#999999 !important;
    text-decoration:none !important;}
    
     * {
     -webkit-text-size-adjust: none;
     -ms-text-size-adjust: none;
     -moz-text-size-adjust: none;
    }
    
    
    .ReadMsgBody {
    	width: 100%;
    }
    body {
    	margin: 0;
    	padding: 0;
    	width: 100%;
    }
  </style>

</head>


<body bgcolor="#ebeff0">
  <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#ebeff0">
    <tbody>
      <tr>
        <td align="center">
          <table border="0" cellspacing="0" cellpadding="0" width="600" align="center" bgcolor="#ffffff">
            <tbody>
              <tr>
                <td style="padding:20px 0 20px 0;" bgcolor="#ebeff0">
                  <table border="0" cellspacing="0" cellpadding="0" width="600">
                    <tbody>
                      <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#374959; padding:0 0 0 30px;"><a href="' . $baseuri . '" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #374959; text-decoration: none; line-height: 12px;" target="_blank" title="">Compartiendo la misma pasión!</a></td>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#374959; padding:0 30px 0 0;" align="right"><a href="' . $baseuri . '" style="color:#374959; text-decoration:none;" target="_blank">Ver sitio web</a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td>
                  <table border="0" cellspacing="0" cellpadding="0" width="600">
                    <tbody>
                      <tr>
                        <td width="512" align="left" style="padding-left:30px;">
                          <a href="' . $baseuri . '" target="_blank"><img style="display:block;" src="' . $baseuri . '/email_img/company_logo.jpg" border="0" alt="ColStar Airlines" title="ColStar Airlines" width="202" height="61"></a>
                        </td>

                        <td width="88" align="right">
                          <a href="https://www.ivao.aero/" target="_blank"><img style="display:block;" title="IVAO" src="' . $baseuri . '/email_img/ivao.jpg" border="0" alt="IVAO" width="88" height="67"></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="52" style="padding:0px; border-bottom:1px solid #bfbfbf;  border-top:1px solid #bfbfbf;">
                  <table height="52" border="0" cellspacing="0" cellpadding="0" width="600" style="border-collapse:collapse; padding=0;">
                    <tbody>
                      <tr>
                        <td width="250" style="padding:0 0 0 35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767;" align="left">Cordial Saludo ' . $name_pca . ',
                        </td>

                        <td height="52" align="right" style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767; border-collapse:collapse; display:block;"><img src="' . $baseuri . '/email_img/NAV-wing-tier-R.gif" alt="*" width="52" height="52" border="0"></td>

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Miembro<br><a href="' . $baseuri . '/main/index.php?page=pilot_details&pilot_id=' . $gvauser_id_pca . '" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $ivaovid_pca . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Estado de Registro<br>
                  <span style="font-size:28px; line-height:45px;"></span></td>
              </tr>
              <tr>
                <td><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td align="center">
                  <a href="' . $baseuri . '" target="_blank"><img style="display:block;" title="ColStar" src="' . $baseuri . '/email_img/160927HDR600x338.jpg" border="0" alt="ColStar" height="338" width="600"></a>
                </td>
              </tr>

              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:25px; color:#374959; padding:35px 75px 35px 75px;" align="left">
                  <span style="font-size:18px; line-height:22px;">

                  A continuación encontrará la información de su <a href="' . $baseuri . '/main/index.php?page=search" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">registro</a> en ColStar Alliance, registrado con la filial ' . $nombreaerolinea . '.
                  <br><br> Callsign: <b>' .$callsign_pca . '</b>.
                  <br><br> Password: <b> La que ingresaste</b>.
				  <br><br> Estado: <b>Activo</b>.
				  <br><br> Estado Registro: <b>Aprobado en el Sistema</b>.
				  <br>
				  <h3>Redes Sociales de ' . $nombreaerolinea . '</h3><hr>
				  ' . $informacionfacebook . '<br>
				  ' . $informacionwhatsapp . '<br>
                  </span>
                </td>
              </tr>
              <!--CTA Button-->
              <tr>
                <td height="70" align="center" bgcolor="#ffffff">
                  <table border="0" cellspacing="0" cellpadding="0" width="500">
                    <tbody>
                      <tr>
                        <td style="padding-bottom:40px;">
                          
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <!-- End CTA Button-->
              <!--Extra Partner Benefits-->
              <tr>
                <td style="padding:0 0 10px 0;">
                  <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                    <tbody>
                      <tr>
                        <td style="padding:0px 0 10px 0;">
                          <table border="0" cellspacing="0" cellpadding="0" width="600">
                            <tbody>
                              <tr>
                                <td style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:16px; color:#374959; padding:10px 50px 25px 50px;"><span style="font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:24px; color:#374959;">
								Muchas gracias por usar los servicios de ColStar Alliance, recuerde que ya puede iniciar sesión en el sistema, solicitar sus entrenamientos via web o facebook, iniciar entrenamientos para poder volar.
								</span>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <!--End Partner Benefits-->
              <!--Begin Partner Logo

<tr>
<td>
<table  align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="center">
<a href="http://link.aa.com/r/837VNI/GK99LG/I7CPTG/EFFXPC/A7HO66/5Z/h" target="_blank">
<img src="http://www.aa.com/content/images/email/-AAdvPartners/Partner-logo-module-FTD-600x215.jpg" border="0" align="center"  style="display:block;" alt="Partner logo" title="Partner logo"  width="600" height="215" /></a>
</td>
</tr>
</table>
</td>
</tr>
End Partner Logo-->
              <!--Begin Partner Logo-->

              <!--<tr>
<td>
<table  align="center" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="606" align="center">
<a
 href="http://link.aa.com/r/837VNI/GK99LG/I7CPTG/EFFXPC/3ONL1L/5Z/h" target="_blank"
><img src="http://www.aa.com/content/images/email/-AAdvPartners/Partner-logo-module-600x124.jpg" border="0" style="display:block;" alt="Partner logo 2" title="Partner logo 2"  width="600" height="124" /></a>
</td>
</tr>
</table>
</td>
</tr>-->
              <!-- End Partner Logo-->


              <!--Begin GLOBAL NAV - lower -->
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#137acf; border-bottom:1px solid #b8b7b8; padding:20px 0 20px 0; font-weight:bold;" align="center" bgcolor="#ebeff0"><a href="' . $baseuri . '/main/?page=staff" style="color:#137acf; text-decoration:none;" target="_blank">Staff</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                  <a href="' . $baseuri . '/main/?page=mgo" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                  <a href="' . $baseuri . '/main/?page=pilots" style="color:#137acf; text-decoration:none;" target="_blank">Pilotos</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                  <a href="' . $baseuri . '/main/?page=contact" style="color:#137acf; text-decoration:none;" target="_blank">Contacto</a>
                </td>
              </tr>
              <!--End GLOBAL NAV - lower  -->
              <tr>
                <td align="center" bgcolor="#ebeff0" style="padding:20px 0 20px 0; border-bottom:1px solid #b8b7b8;">
                  <table width="300" cellspacing="0" cellpadding="0" align="center">
                    <tbody>
                      <tr>
                        <td style="font-family:Arial, Helvetica, sans-serif; font-size:18px; line-height:24px; color:#999999;">
                          Conectado con nosotros
                        </td>
                        <td>
                          <a href="' . $baseuri . '" target="_blank"><img style="display:block;" title="Mobile" src="' . $baseuri . '/email_img/icon_mobile-app.gif" border="0" alt="Mobile" width="30" height="30"></a>
                        </td>
                        <td><img style="display:block;" src="' . $baseuri . '/email_img/spacer_clear.gif" border="0" alt="" width="4" height="1"></td>
                        <td>
                          <a href="https://www.facebook.com/colstarva/" target="_blank"><img style="display:block;" title="Facebook" src="' . $baseuri . '/email_img/icon_facebook.gif" border="0" alt="Facebook" width="30" height="30"></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <!--Begin FOOTER NAV and SM 
              <tr>
                <td align="center" style="padding:20px 0 20px 0; border-bottom:1px solid #b8b7b8;" bgcolor="#ebeff0">
                  <table align="center" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                      <tr>
                        <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#999999;"><a href="#" style="color:#999999; text-decoration:none;" target="_blank">Update  Email Preferences</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                          <a href="#" style="color:#999999; text-decoration:none;" target="_blank">Change&nbsp;Email&nbsp;Address</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                          <a href="#" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #999999; text-decoration: none;" target="_blank">Unsubscribe</a> &nbsp;&nbsp;|&nbsp;&nbsp;
                          <a href="https://www.aa.com/i18n/customer-service/support/privacy-policy.jsp?c=EML|BGS|20160927|ADV|MKT|SOLO|DEF|BGS" style="color:#999999; text-decoration:none;" target="_blank"> Privacy&nbsp;Policy</a>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr> -->
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#999999; padding:20px 30px 40px 30px;" align="left" bgcolor="#ebeff0">

                  <!--Partner T and Cs-->
                  <a href="#" style="color:#137acf; text-decoration:none;" target="_blank">Términos y Condiciones</a>
                  <br>
                  <br>
                  <!--End Partner T and Cs-->
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $email_pca . ' </a>debido a que usted es miembro de ColStar Alliance.
                  <!--To unsubscribe, please <a
 href="#" style="color:#0078d2; text-decoration:none;"
>click here</a>.-->
                  <br>
                  <br> Este correo electrónico y cualquier información o archivos transmitidos con él son exclusivamente para el uso confidencial del destinatario. Este mensaje contiene información confidencial y propiedad de ColStar Alliance (como ColStar Pilotos,
                  Datos de clientes y empresas) que no pueden ser leídos, buscados, distribuidos o usados&nbsp;de otra manera por nadie que no sea el destinatario. Si ha recibido este correo electrónico por error, notifique al remitente y elimine rápidamente este mensaje
                  y sus anexos.

                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>


</body>
</html>';





mail($para, $titulo, $mensaje, $headers);
			
			
			
			
			///////////////////////////// FIN ///////////////////
			
			
			
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Piloto agregado satisfactoriamente.');
window.location = './?page=admonpilotos';
 
</script>


		<?php } else {
			
			
			?>
	   
	   
<script>   
	   
alert('El callsign ya existe, cambie el número de callsign.');
window.location = './?page=agregarnuevopiloto&pilot_id=<?php echo $gvauser_id_pca; ?>';
 
</script>


		<?php 
			
			
		} ?>
