
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo REGISTER_PLACE_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_REGISTER_PLACE_TITLE; ?></font></h3>

</section>
	
	
			
			
			
			 <section class="text-center">
                <div class="container">
                    <div class="row">
					<?php
    $pass = $_POST['invitation_code'];
	include('./hubdd.php');
    include('./languagesdd.php');
	include('./countriesdd.php');
	include('./opedd.php');
    include ('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
	
	$iff = 0;
		
		$Encrypt_Pass = md5(mysqli_real_escape_string($db , $_POST['invitation_code']));
		
		$sql1 = "SELECT * FROM invitacion where  codigo='" . $Encrypt_Pass . "' and used=0";
		
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		while ($row1 = $result1->fetch_assoc()) {
			$iff = "1";
			$name = $row1["name"];
			$surname = $row1["surname"];
			$email = $row1["email"];
		}

if ($iff == "1") {

	//  Get va parameters

	$sql = "select * from gvausers where activation=1";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	$number_current_pilots = $result->num_rows;

	

	if ($number_pilots < $number_current_pilots){

?>

                           <div class="alert bg--error">
                                <div class="alert__body">
                                    <span><?php echo ALERT_FULL_PILOTS; ?></span>
                                </div>
                            </div>

	<?php

							}

							else {

								?>
                        <div class="col-md-12">
                            <h2><?php echo ONE_DETAIL_REGISTER_PLACE; ?></h2>
                            <p class="lead"><?php echo TWO_DETAIL_REGISTER_PLACE; ?></p>
                            <form action="./pilot_insert_premium.php" method="post">
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">directions_walk</i>
	                            <input type="text" name="name" placeholder="<?php echo REGISTER_YOUR_NAMES; ?>" value="<?php echo $name; ?>" readonly="readonly" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">directions_run</i>
	                            <input type="text"  name="surname" placeholder="<?php echo REGISTER_YOUR_SURNAMES; ?>" value="<?php echo $surname; ?>" readonly="readonly" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">vpn_key</i>
	                            <input type="text"name="codigo" placeholder="<?php echo REGISTER_CODE_INVITATION; ?>" value="<?php echo $pass; ?>" readonly="readonly" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">perm_contact_calendar</i>
	                            <input type="date"  name="birthdate" placeholder="<?php echo REGISTER_BIRTHDAY; ?>" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">account_circle</i>
	                            <input type="number"  name="ivao" placeholder="<?php echo REGISTER_VID_IVAO; ?>" required />
                            </div>
						</div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="language" id="language" required>
                                            <option value="" disabled selected hidden><?php echo REGISTER_LANGUAGE; ?></option>
											<?php echo $combolanguage; ?>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="country" id="country" required>
                                            <option value="" disabled selected hidden><?php echo REGISTER_COUNTRY; ?></option>
											<?php echo $combocountry; ?>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">location_city</i>
	                            <input type="text"  name="city" placeholder="<?php echo REGISTER_CITY; ?>" required/>
                            </div>
						</div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="hub" id="hub" required>
                                            <option value="" disabled selected hidden>Hub</option>
											<?php echo $combohub_id; ?>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="ope" id="ope" required>
                                            <option value="" disabled selected hidden><?php echo REGISTER_AIRLINE; ?></option>
											<?php echo $combooperador_id; ?>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">location_city</i>
	                            <input type="email"  name="email" placeholder="<?php echo REGISTER_EMAIL; ?>" value="<?php echo $email; ?>" readonly="readonly" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">face</i>
	                            <input type="facebook"  name="facebook" placeholder="<?php echo FACEBOOKTITLE; ?> => https://www.facebook.com/nickname"/>
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">lock</i>
	                            <input type="password"  name="password" placeholder="<?php echo REGISTER_PASSWORD; ?>" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="material-icons color--black">lock</i>
	                            <input type="password"  name="password2" placeholder="<?php echo REGISTER_CONFIRM_PASSWORD; ?>" required />
                            </div>
						</div>
						
						
						
						<div class="col-sm-12">	
							<div class="input-icon">
								<textarea name="notes" id="notes"  placeholder="<?php echo REGISTER_COMMENTS; ?>"></textarea>
                            </div>
	                    </div>
						
						<div class="col-sm-12">
						<?php echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="' . CAPTCHA_ALERT . '">'; ?>
						</div>
						
						<div class="col-sm-12">
							<i class="material-icons color--black">lock_open</i>
							<input type="text" class="form-control" name="captcha" id="captcha" placeholder="<?php echo REGISTER_CAPTCHA; ?>" required >
						</div>
						
							
						<div class="col-sm-12">
                              <div class="input-checkbox">
                                    <input type="checkbox" name="accept_emails" value="1"/>
                                    <label></label>
                              </div>
                              <span><?php echo AGREE_PROFILE; ?></span>
                        </div>
						
														
						<input type="hidden"  name="captchahidden" id="captchahidden"  value="<?php echo $_SESSION['captcha']['code']?>"/>
							<div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo REGISTER_BUTTON; ?></button>
                                </div>
							</form>
                            
							

                        </div>
							<?php

							} // Else close

						

} else {



	$mensaje = ERROR_INVITACION;
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=admisiones';";
echo "</script>";  


}

?> 
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
