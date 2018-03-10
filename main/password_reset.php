<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include ('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
	
	$email_user = strtoupper($_POST['email']);
	$birthdate_user = $_POST['birthdate'];
	$callsign_user = strtoupper($_POST['callsign']);
	
	
	$sql = 'select * from gvausers where UPPER(email)="' . $email_user . '"  and birth_date="' . $birthdate_user . '" and UPPER(callsign)="' . $callsign_user . '"';
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
    } else {
	$number_of_rows = $result->num_rows;
	if ($number_of_rows > 0)
	{
		
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	for ($i = 0 ; $i < 12 ; $i++) {
		$cad .= substr($str , rand(0 , 62) , 1);
	}
	$clave = $cad;
	$con_encriptada = md5($clave);
	
	// update the password
	$sql = 'UPDATE gvausers SET password="' . $con_encriptada . '" where  UPPER(email)="' . $email_user . '"';

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	
	    $sqluser = 'select * from gvausers where UPPER(email)="' . $email_user . '"';
		
		if (!$resultuser = $db->query($sqluser)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($rowex = $resultuser->fetch_assoc()) {
		$callsign = $rowex['callsign'];
		$nombres = $rowex['name'];
		$apellidos = $rowex['surname'];
		$vids = $rowex['ivaovid'];
		$idpilot = $rowex['gvauser_id'];
		}
	
	
	


        

		
	
	?>
	
		<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('./images/fondos/<?php echo rand(1,10); ?>.jpg')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_RECOVER ; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo INFO_RECOVER_VA; ?> </font></h3>

</section>



		<section class="contact">
			<div class="container">

				<div class="row">
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="page_404">
							<h1><?php echo PILOT_RECOVERY; ?> <?php echo $nombres . ' ' . $apellidos; ?></h1>
							<hr>
							<br>
							<br>
							<h3><?php echo NEW_PASSWORD; ?> </h3>
							<hr>
							<p align="center" style="font: arial;"><b><?php echo $clave; ?></b></p>
							<div class="cl-effect"><a href="./?page=form_login" data-gal="m_PageScroll2id" data-ps2id-offset="65"><span data-hover="<?php echo LOGIN_MENU; ?>"><?php echo LOGIN_MENU; ?></span></a></div>
							
						</div>
					</div>
				</div>
				
			</div>
		</section>

	</section>	<!--end wrapper-->

	
	
	
	<?php

     require_once('./sent_email.php');	
	 $mail = new system_mailer();
     $mail->password_reset($email_user,$nombres,$callsign,$clave,$idpilot,$vids);  
	  
		
		

							}
							else
							{
$mensaje = "Tu informacion es incorrecta :: Your information is wrong.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=form_recovery';";
echo "</script>";  
							}
						}
						?>
