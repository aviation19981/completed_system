<?php
require_once ('./db_login.php');
require_once ('PHPMailer-master/PHPMailerAutoload.php');
        $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "http://" . $host;

// Base URL for e-mail messages
$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
array_pop($baseuri);	array_pop($baseuri);
$baseuri = "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri);


/////////////////////////////////////// EMAIL STAFF

		   $sqlemail = 'select * from config_emails where config_emails_id=0';
			if (!$result2email = $db->query($sqlemail)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row2email = $result2email->fetch_assoc()) {
               $staff_email  = $row2email["staff_email"];
			}

			
			$teachers = '';
	$sql_teach = 'select * from gvausers where  user_type_id=4';
	if (!$result_teach = $db->query($sql_teach)) {
	die('There was an error running the query [' . $db->error . ']');
    }
	
	while ($row_teach = $result_teach->fetch_assoc()) {
		
		if(empty($row_teach['facebook'])) {
			$facebook = '';
		} else {
			$facebook = ' [' . $row_teach['facebook'] . ']';
		}
		
		$teachers = $teachers . '<li>' . $row_teach['name'] . ' ' . $row_teach['surname'] . ' [' . $row_teach['email'] . ']' . $facebook . '</li><br>';
	}
	
/////////////////////////////////////// END EMAIL STAFF			
			
			
			
			
class system_mailer
	{
		


       function invitation_code($email_user,$name,$clave)
        {
			
			global $web, $staff_email, $baseuri;

            $mail = new PHPMailer;
			$mail->addReplyTo($staff_email , 'ColStar Alliance System');
			$mail->From = $staff_email;
			$mail->FromName = 'ColStar Alliance System';
			$mail->addAddress($email_user);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Invitacion';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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
                        <td width="250" style="padding:0 0 0 35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767;" align="left">Cordial Saludo ' . $name . ',
                        </td>

                        <td height="52" align="right" style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767; border-collapse:collapse; display:block;"><img src="' . $baseuri . '/email_img/NAV-wing-tier-R.gif" alt="*" width="52" height="52" border="0"></td>

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Futuro<br><a href="#" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">Miembro</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Tú código de invitación<br>
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

                  A continuación encontrará la información de su <a href="' . $baseuri . '/main/index.php?page=admisiones#steps-uid-0-h-2" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">invitación</a> ColStar Alliance, con su correspondiente código.
                  <br><br> Email: <b>' .$email_user . '</b>.
                  <br><br> Código Invitación: <b>' .$clave . '</b>
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
                          <div align="center">
                            <a href="' . $baseuri . '/main/?page=admisiones#steps-uid-0-h-2" target="_blank">
                              <img style="display:block" src="' . $baseuri . '/email_img/registro.jpg" border="0" alt="Registro" title="Registro" width="500" height="70" valign="top"></a>
                          </div>
                          <a href="' . $baseuri . '/main/?page=admisiones#steps-uid-0-h-2" target="_blank">
                          </a>
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
								Muchas gracias por usar los servicios de ColStar Alliance, y esperamos que prontamente sea un miembro activo de nuestra aerolínea.
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $email_user . ' </a>debido a que usted es miembro de ColStar Alliance.
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }


		
	




       function training_request($email_user,$nombre_user,$apellido_user,$ivao_vid_user,$idpilot,$comentarios,$aeronave,$pilotname,$pilotsurname,$callsign,$email)
        {
			
			global $web, $staff_email, $baseuri;

            $mail = new PHPMailer;
			$mail->addReplyTo($email , $pilotname);
			$mail->From = $email;
			$mail->FromName = 'ColStar Alliance System';
			$mail->addAddress($email_user);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Entrenamiento';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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
                        <td width="250" style="padding:0 0 0 35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767;" align="left">Cordial Saludo ' . $nombre_user .'
                        </td>

                        <td height="52" align="right" style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767; border-collapse:collapse; display:block;"><img src="' . $baseuri . '/email_img/NAV-wing-tier-R.gif" alt="*" width="52" height="52" border="0"></td>

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Docente<br><a href="https://www.ivao.aero/members/person/details.asp?ID=#' . $ivao_vid_user . '" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $ivao_vid_user . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Solicitud Entrenamiento<br>
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

                  A continuación encontrará la información de su <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">entrenamiento</a> programado en ColStar Alliance.
                  <br><br> Estudiante: <b>' . $pilotname . ' ' . $pilotsurname . ' (' . $callsign . ')</b>.
                  <br><br> Aeronave: <b>' .$aeronave . '</b>.
				  <br><br> Comentarios: <b>' . $comentarios . '</b>.
				  <br><br> Para contactarlo lo puede hacer a través de: <b><a href="mailto:' . $email . '">' . $email . '</a>	</b>.	
               		  
		  
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
								Muchas gracias por usar los servicios de ColStar Alliance, y por ser uno de nuestros docentes.
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $email_user . ' </a>debido a que usted es miembro de ColStar Alliance.
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }

	
		
	











       function contact_us($email_from,$name,$asuntos,$mensajes,$staff_email_pro)
        {
			
			global $web, $baseuri;

            $mail = new PHPMailer;
			$mail->addReplyTo($email_from , $name);
			$mail->From = $email_from;
			$mail->FromName = $name;
			$mail->addAddress($staff_email_pro);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Mensaje';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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
                        <td width="250" style="padding:0 0 0 35px; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767;" align="left">Cordial Saludo Señor Staff
                        </td>

                        <td height="52" align="right" style="padding:0; font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#253767; border-collapse:collapse; display:block;"><img src="' . $baseuri . '/email_img/NAV-wing-tier-R.gif" alt="*" width="52" height="52" border="0"></td>

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Docente<br><a href="#" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">Staff</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Contacto vía web<br>
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

                  A continuación encontrará la información de una mensaje de un  <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">usuario</a>.
                 <hr>
				 Buen dia, mi nombre es <b>' . $name . '.</b><br>
				 Mi mensaje es el siguiente:<br>' . $mensajes . '<br>
				 <hr>
				 Gracias por su atencion prestada.<br>
<li>La Ip del usuario es: ' . $_SERVER["REMOTE_ADDR"] . '</li>
<li>Hora envio de mensaje: ' . date("d-m-Y H:i:s") . '</li>

               		  
		  
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
								Muchas gracias por usar los servicios de ColStar Alliance.
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $email_user . ' </a>debido a que usted es miembro de ColStar Alliance.
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }

		
		
		
		
		
		
		
		
		
		
		
		function password_reset($email_user,$nombres,$callsign,$clave,$idpilot,$vids)
        {
			
			global $web, $staff_email, $baseuri;

            $mail = new PHPMailer;
			$mail->addReplyTo($staff_email , 'ColStar Alliance System');
			$mail->From = $staff_email;
			$mail->FromName = 'ColStar Alliance System';
			$mail->addAddress($email_user);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Nueva Contraseña';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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
                          <a href="https://www.ivao.aero/" target="_blank"><img style="display:block;" title="oneworld" src="' . $baseuri . '/email_img/ivao.jpg" border="0" alt="IVAO" width="88" height="67"></a>
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

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Miembro<br><a href="' . $baseuri . '/main/index.php?page=pilot_details&pilot_id=' . $idpilot . '" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $vids . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Tú nueva contraseña<br>
                  <span style="font-size:28px; line-height:45px;"></span></td>
              </tr>
              <tr>
                <td><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td align="center">
                  <a href="' . $baseuri . '" target="_blank"><img style="display:block;" title="Buy or gift miles today" src="' . $baseuri . '/email_img/160927HDR600x338.jpg" border="0" alt="Buy or gift miles today" height="338" width="600"></a>
                </td>
              </tr>

              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:25px; color:#374959; padding:35px 75px 35px 75px;" align="left">
                  <span style="font-size:18px; line-height:22px;">

                  A continuación encontrará la información de su <a href="' . $baseuri . '/main/index.php?page=pilot_details&pilot_id=' . $idpilot . '" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">cuenta</a> ColStar Alliance, con su correspondiente clave.
                  <br><br> Usuario: <b>' .$callsign . '</b>.
                  <br><br> Contraseña: <b>' .$clave . '</b>.
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
                          <div align="center">
                            <a href="' . $baseuri . '/main/?page=form_login" target="_blank">
                              <img style="display:block" src="' . $baseuri . '/email_img/login.jpg" border="0" alt="Iniciar Sesión" title="Iniciar Sesión" width="500" height="70" valign="top"></a>
                          </div>
                          <a href="' . $baseuri . '/main/?page=form_login" target="_blank">
                          </a>
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
								Muchas gracias por usar los servicios de ColStar Alliance, ya puede hacer uso de su cuenta y recuerda cambiar la clave a la de tu preferencia.
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $email_user . ' </a>debido a que usted es miembro de ColStar Alliance.
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }

		
		
		
		
		
		
		
				
		function lost_test($nombres,$apellidos,$vids,$correo,$rangoivao,$porcentaje,$contarbuenas,$preguntasmalas)
        {
			
			global $web, $staff_email, $baseuri;

            $mail = new PHPMailer;
			$mail->addReplyTo($staff_email , 'ColStar Alliance System');
			$mail->From = $staff_email;
			$mail->FromName = 'ColStar Alliance System';
			$mail->addAddress($correo);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Estado Admisión';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Aspirante<br><a href="' . $baseuri . '/main/index.php?page=searchexamen" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $vids . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Estado Admisión<br>
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

                  A continuación encontrará la información de su <a href="' . $baseuri . '/main/index.php?page=searchexamen" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">admisión</a> en ColStar Alliance.
                  <br><br> Porcentaje: <b>' .$porcentaje . '%</b>.
                  <br><br> Respuestas Correctas: <b>' .$contarbuenas . '</b>.
				  <br><br> Respuestas Incorrecta: <b>' .$preguntasmalas . '</b>.
				  <br><br> Estado Admisión: <b>No ha sido admitido</b>.
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
								Muchas gracias por usar los servicios de ColStar Alliance, recuerde que puede volverse a presentar después de 1 mes de haber presentado la prueba siempre en cuando las admisiones esten abiertas.
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $correo . ' </a>debido a que usted es miembro de ColStar Alliance.
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		function passed_test($nombres,$apellidos,$vids,$correo,$rangoivao,$porcentaje,$contarbuenas,$preguntasmalas)
        {
			
			global $web, $staff_email, $baseuri, $teachers;
			
			
			


            $mail = new PHPMailer;
			$mail->addReplyTo($staff_email , 'ColStar Alliance System');
			$mail->From = $staff_email;
			$mail->FromName = 'ColStar Alliance System';
			$mail->addAddress($correo);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Estado Admisión';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Aspirante<br><a href="' . $baseuri . '/main/index.php?page=searchexamen" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $vids . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Estado Admisión<br>
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

                  A continuación encontrará la información de su <a href="' . $baseuri . '/main/index.php?page=searchexamen" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">admisión</a> en ColStar Alliance.
                  <br><br> Porcentaje: <b>' .$porcentaje . '%</b>.
                  <br><br> Respuestas Correctas: <b>' .$contarbuenas . '</b>.
				  <br><br> Respuestas Incorrecta: <b>' .$preguntasmalas . '</b>.
				  <br><br> Estado Admisión: <b>Ha pasado a entrevista!</b>.
				  <hr>
				                                                <h2><b>Felicitaciones!</b></h2><br>
																<h3><b>Los docentes son:</b></h3><br>
																' . $teachers . '
																<b>Contactar a uno de ellos para continuar el proceso de admisión.</b>
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
								Muchas gracias por preferirnos como su aerolínea virtual de preferencia, recuerde que tendrá <b>máximo un mes</b> para la solicitud de la entrevista para <b>determinar su situación. Leer el MGO y las reglas de la aerolínea, están en la web.
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
                  Este correo fue enviado a <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank">' . $correo . ' </a>debido a que usted es miembro de ColStar Alliance.
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		function fired_alliance($name_pca,$ivaovid_pca,$email_pca,$diastotales_pca,$maximium_days_fired)
        {
			
			global $web, $staff_email, $baseuri;
			
			
			


            $mail = new PHPMailer;
			$mail->addReplyTo($staff_email , 'ColStar Alliance System');
			$mail->From = $staff_email;
			$mail->FromName = 'ColStar Alliance System';
			$mail->addAddress($email_pca);
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->CharSet = 'UTF-8';
			$mail->Subject = 'ColStar Alliance - Carta de Despido';
			$mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ColStar VA | Email</title>
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

                        <td height="52" align="left" style="padding:0px 35px 0px 0px; font-family:Arial, Helvetica, sans-serif; text-align: right; font-size:14px; color:#ffffff; background-color:#0078d2; border-collapse:collapse;">ColStar<small><sup>©</sup></small> Ex-miembro<br><a href="#" style="color:#ffffff; text-decoration:underline; display:block;" target="_blank"><span style="font-size:18px;">' . $ivaovid_pca . '</span></a></td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td height="30"><img style="display:block;" src="' . $baseuri . '/email_img/spacer50.gif" border="0" alt="" height="25"></td>
              </tr>
              <tr>
                <td style="font-family:Arial, Helvetica, sans-serif; font-size:40px; color:#374959;" align="center">Estado en la Alianza<br>
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

                  A continuación encontrará la información de su <a href="#" style="color:#0078d2; text-decoration:none;" target="_blank" title="cuenta">estado de despido</a> en ColStar Alliance.
                  <br><br> Estado: <b>Eliminado del Sistema</b>.
                  <br><br> Fecha: <b>' . date('Y-m-d h:i:s') . '</b>.
				  <br><br> Causa: <b>Inactividad en la alianza.</b>.
				  <br><br> Inactividad: <b>' . $diastotales_pca . ' días de inactividad | Limite de inactividad ' . $maximium_days_fired . ' días</b>.
				  <br><br> Gracias por haber sido parte de la aerolínea, por la dedicación y por habernos preferido como aerolínea virtual.
				  <hr>
				  <h3>Si desea saber la causa en específica contactar a un Staff por la plataforma o redes sociales</h3>
				  
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
								Muchas gracias por preferirnos como su aerolínea virtual de preferencia, recuerde que tendrá <b>oportunidad</b> de volver a presentarse a la <b>alianza</b>
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
                  <a href="' . $baseuri . '/main/?page=rules" style="color:#137acf; text-decoration:none;" target="_blank">MGO</a> &nbsp;&nbsp;|&nbsp;&nbsp;
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
			//$mail->AltBody = $register_text;
			if (!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo '';
			}
        }		
		
		
		
		
		
}

?>