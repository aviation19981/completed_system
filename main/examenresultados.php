<?php
require_once('./sent_email.php');	
		$vid = $_POST['vid'];
        $limite  = $_POST['numpreg'];

		
		// ESTADO 0 Logeado
		// ESTADO 1 Perdido Teorico
		// ESTADO 2 Ganado Teorico
		// ESTADO 3 Perdido Practico
		// ESTADO 4 Ganado Practico INGRESO
		
		$sql = "select * from config_examen where id='1'";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
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

		

		?>

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white">Centro de Admisiones</font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> Estas próximo a ser parte de nuestra familia!</font></h3>

</section>



		<section class="contact">
			<div class="container">


			

<?php

	$sqlexamen = "select * from presentacionexamen where vid='$vid'";
		
		if (!$resultexamen = $db->query($sqlexamen)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($rowex = $resultexamen->fetch_assoc()) {
			
	    $nombres = $rowex['nombres'];
		$apellidos = $rowex['apellidos'];
		$vids = $rowex['vid'];
		$correo = $rowex['email'];
		$rangoivao = $rowex['rangoivao'];
		}


        $sql12 = "select * from preguntasdeexamen";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$contarpreguntas = 0;
		$contarbuenas = 0;
		$porcentaje = 0;
		while ($row12 = $result12->fetch_assoc()) {
			// CONTAR PREGUNTAS
			$contarpreguntas++;
			// ID Y RESPUESTA CORRECTA
			$identificacion = $row12["id"];
			$respuesta_correcta = $row12["respuesta_correcta"];
			
			// VALIDAR RESPUESTA
			if($_POST[$identificacion]==$respuesta_correcta) {
				$contarbuenas++;
			}
			
		}
		// 80 PORCIENTO EN TEORICO
		
		$porcentaje = (($contarbuenas*80)/$limite);
        $preguntasmalas = $limite-$contarbuenas;





if ($porcentaje < 50) {



echo '<h3>  PUNTAJE</H3>';
echo '<hr>';
echo 'Usted tiene un puntaje de ' .  $porcentaje . '%';
echo '<br>';
echo '<br>';

echo '<h3>RESPUESTAS CORRECTAS</H3>';
echo '<hr>';
echo 'Usted tiene ' . $contarbuenas . ' respuestas buenas';
echo '<br>';
echo '<br>';

echo '<h3>RESPUESTAS INCORRECTAS</H3>';
echo '<hr>';

if ($preguntasmalas == 1) {
echo 'Usted tiene ' . $preguntasmalas . ' respuesta mala';
} else {
echo 'Usted tiene ' . $preguntasmalas . ' respuestas malas';
}
echo '<br>';
echo '<br>';
echo '<br>';


echo '<h2><font color=red>  ESTADO DE ADMISIÓN</font></h2>';
echo '<hr><br>';


echo '<font color=black>Buen día ' . $nombres . ' ' . $apellidos .', usted no ha sido admitido a la aerolínea. Por favor vuelve a intentarlo de nuevo dentro de un mes, gracias por preferirnos como aerolínea virtual. Staff ColStar VA.<br><br>';




//////////////////////////////// Email PERDIO /////////////////////////

$mail = new system_mailer();
$mail->lost_test($nombres,$apellidos,$vids,$correo,$rangoivao,$porcentaje,$contarbuenas,$preguntasmalas);  

//////////////////////////////////////

$sql1 = "update presentacionexamen set calificacion='$porcentaje', calificaciontotal='$porcentaje', estado=1 where vid='$vid'";
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		

}  else if ($porcentaje >= 50) {


echo '
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="' . $baseuri . '/va/img/logo/cst.png" alt="Pilot" width="60%"  style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Saludo ' . $nombres . ' ' . $apellidos . ' desde ColStar VA!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										En este mensaje informativo, encontrará la información de proceso de admisión en ColStar VA.<br><br>
										Usted ha pasado al filtro de entrevista con un puntaje de <b>' . $porcentaje . '</b>  %. ' . $contarbuenas . ' respuesta(s) buena(s) y ' . $preguntasmalas  . ' respuesta(s) mala(s)<br><br>
										<b>Recuerde:</b> Contactar a uno de los instructores que a continuación se encontrará (sus datos de contacto vía Facebook). 
										
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
																<img src="https://pbs.twimg.com/profile_images/634221886143090688/MdGspVK2.png" alt="" width="200" height="200" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																<h2><b>Felicitaciones!</b></h2><br>
																<h3><b>Los docentes son:</b></h3><br>
																' . $teachers . '
																<b>Contactar a uno de ellos para continuar el proceso de admisión.</b>
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
																<img src="https://login.ivao.aero/img/logo1-default.png" alt="" width="200" height="200" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																<h2><b>ColStar Alliance</b></h2><br>
																<i>Tendrá <b>máximo un mes</b> para la solicitud de la entrevista para <b>determinar su situación.</b></i>
																<b>Leer el MGO y las reglas de la aerolínea, están en la web.</b><br><br>

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
										&reg; ColStar Alliance<br/>
										<a href="#" style="color: #ffffff;"><font color="#ffffff">Compartiendo</font></a> la misma pasión!
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="' . $baseuri . '" style="color: #ffffff;">
														<img src="https://www.ivao.aero/assets//img/logo1-default.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.facebook.com/colstarva/?fref=ts" style="color: #ffffff;">
														<img src="http://tutsplus.github.io/build-an-html-email-template-from-scratch/images/fb.gif" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
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
';








//////////////////////////////// Email GANADO /////////////////////////

$mail = new system_mailer();
$mail->passed_test($nombres,$apellidos,$vids,$correo,$rangoivao,$porcentaje,$contarbuenas,$preguntasmalas);  


//////////////////////////////////////


$sql1 = "update presentacionexamen set calificacion='$porcentaje', calificaciontotal='$porcentaje', estado=2 where vid='$vid'";
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}








}






?>






</div>

</section>
</section>

