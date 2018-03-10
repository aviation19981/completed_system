
<?php
	
		
		
	$entrevistanote = $_POST['entrevistanote'];
	$vidusuario = $_POST['vidusuario'];
	$idtest = $_POST['idtest'];
	
	
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		// CONSULTA NOTA ANTERIOR
			$sql1va = "select * from presentacionexamen where vid='$vidusuario' and id='$idtest'";

		if (!$result1va = $db->query($sql1va)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1va = $result1va->fetch_assoc()) {
			
			$calificacion = $row1va['calificacion'];
			$correos =  $row1va['email'];    
			$vidivaos =  $row1va['vid'];    
            $nombres = $row1va['nombres'];
			$apellidos = $row1va['apellidos'];    			
		}
		
			// Base URL for e-mail messages
$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
array_pop($baseuri);	array_pop($baseuri);
$baseuri = "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri);


// EMAIL STAFF
	
	
	
		$sqlemail = "select * from config_emails where config_emails_id=0";
	if (!$resultemail = $db->query($sqlemail)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$host = "";
	
	while ($rowemail = $resultemail->fetch_assoc()) {
		$host = $rowemail["staff_email"];
	}
	
		
		// PORCENTAJE EXAMEN
		$porcentaje = (($entrevistanote*20)/10);
		
		// NOTA FINAL
		
	$totaladmision = $calificacion+$porcentaje;
	
	// VALIDAR ESTADO ADMISION
	
	
	if ($totaladmision<70) {
		// PERDIDO
		
			$sql1 = "UPDATE presentacionexamen set calificacionentrevista='$porcentaje', calificaciontotal='$totaladmision', estado=3 where vid=$vidusuario";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		$para      = $correos;
$titulo    = 'ColStar Alliance System - Proceso Admision';








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
                        <td width="250" style="padding:0 0 0 35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767;" align="left">Cordial Saludo ' . $nombres . ',
                        </td>

                        <td height="52" align="right" style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767; border-collapse:collapse; display:block;"><img src="' . $baseuri . '/email_img/NAV-wing-tier-R.gif" alt="*" width="52" height="52" border="0"></td>

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Aspirante<br><a href="https://www.ivao.aero/Login.aspx?r=Member.aspx?Id=' . $vidivaos . '" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $vidivaos . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Proceso de Admisión<br>
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

                  A continuación encontrará la información de su <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">proceso de admisión</a> con la aerolínea ColStar Alliance.
                  <br><br> Porcentaje ambas pruebas: <b>' .$totaladmision . '%</b>.
                  <br><br> Prueba teórica: <b>' .$calificacion . '%</b>.
				  <br><br> Entrevista: <b>' .$porcentaje . '%</b>.
				  <br><br> Estado Admisión: <b>NO ADMITIDO</b>.			  
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
								Muchas gracias por preferirnos como aerolínea virtual, recuerda puedes volver a presentar el examen dentro de 1 mes de haber presentado la primer prueba.
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $correos . ' </a>debido a que usted es miembro de ColStar Alliance.
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


 


$cabeceras = 'From: ' . $host . "\r\n" .
    'Reply-To: ' . $host . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";

mail($para, utf8_decode($titulo), utf8_decode($mensaje), $cabeceras);


		
		
	} else if ($totaladmision>=70) {
		// GANADO
		
			$sql1 = "UPDATE presentacionexamen set calificacionentrevista='$porcentaje', calificaciontotal='$totaladmision', estado=4 where vid=$vidusuario";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		// ENVIAR CORREO 
		
		
				
			
	
	
	
	
	
	
	
	
	// FIN
		
	
		
		
	
		
		
$para      = $correos;
$titulo    = 'ColStar Alliance System - Proceso Admision';








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
                        <td width="250" style="padding:0 0 0 35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767;" align="left">Cordial Saludo ' . $nombres . ',
                        </td>

                        <td height="52" align="right" style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767; border-collapse:collapse; display:block;"><img src="' . $baseuri . '/email_img/NAV-wing-tier-R.gif" alt="*" width="52" height="52" border="0"></td>

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Miembro<br><a href="https://www.ivao.aero/Login.aspx?r=Member.aspx?Id=' . $vidivaos . '" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $vidivaos . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Proceso de Admisión<br>
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

                  A continuación encontrará la información de su <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">proceso de admisión</a> con la aerolínea ColStar Alliance.
                  <br><br> Porcentaje ambas pruebas: <b>' .$totaladmision . '%</b>.
                  <br><br> Prueba teórica: <b>' .$calificacion . '%</b>.
				  <br><br> Entrevista: <b>' .$porcentaje . '%</b>.
				  <br><br> Estado Admisión: <b>ADMITIDO</b>.
				  
                  <br><br>
                                                                <h2><b>Felicitaciones!</b></h2><br>
																<h3>Esperamos que disfrutes de nuestros servicios, cuando sea registrado y aprobado le llegará al correo los datos de ingreso y las redes sociales!</h3>

                  <br><br>

                                                                <h2><b>Registro ColStar Alliance:</b></h2><br>
																<i>Por favor registrarse con sus datos legítimos en el siguiente link, el cual es el sistema de la aerolínea.</i>
                                                                <li><a href="' . $baseuri . '/main/index.php?page=registromiembros&iduser=' . $idtest . '"><b>Registrarse!</b></a></li><br>
																<b>Leer el MGO y las reglas de la aerolínea, están en la web.</b><br><br>
																<h2>SOLICITAR ENTRENAMIENTO A LOS INSTRUCTORES, Y GUÍA DEL SISTEMA.</h2>				  
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
								Muchas gracias por usar los servicios de ColStar Alliance, ya puede registrarse, y esperar a ser aprobado por un miembro del Staff en el sistema, ya ha sido admitido a la aerolínea.
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $correos . ' </a>debido a que usted es miembro de ColStar Alliance.
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


 


$cabeceras = 'From: ' . $host . "\r\n" .
    'Reply-To: ' . $host . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";

mail($para, utf8_decode($titulo), utf8_decode($mensaje), $cabeceras);
	
		
	}
		
		
		
		
		
		
	
?>


<script>
alert('Nota agregada satisfactoriamente.');
window.location = './?page=interviewva';
</script>
