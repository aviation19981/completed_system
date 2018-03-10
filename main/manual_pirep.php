
<?php
	require('check_login.php');
	  require('./db_login.php'); 
	
	  $horas = ($gva_hourse + $transfered_hours);

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");



	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	

	

	$sqlrank = "select * from ranks where rank_id='$rank_id'";



	if (!$resultrank = $db->query($sqlrank)) {



		die('There was an error running the query [' . $db->error . ']');



	}



	while ($rowrank = $resultrank->fetch_assoc()) {

			$rank_idnew = $rowrank["maximum_hours"];

	}

	//////////////////////// PORCENTAJE
	$sql_per = "select * from va_parameters where va_parameters_id='1'";

	if (!$result_per = $db->query($sql_per)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($row_per = $result_per->fetch_assoc()) {
			$porcentaje = $row_per["percentage_test_rank"];
	}
	
	
	$intervalos = $rank_idnew*($porcentaje/100);
	///////////////////////////////////////////

	

	$sqltest = "select * from courses inner join ranktypes_course where courses.course_id=ranktypes_course.course_id and ranktypes_course.rank_id='$rank_id'";



	if (!$resultest = $db->query($sqltest)) {



		die('There was an error running the query [' . $db->error . ']');



	}



	while ($rowtest = $resultest->fetch_assoc()) {

	    $course_id = $rowtest['course_id'];

		$contartest=0;

		////////////////////////// SABER CUANTOS EXAMENES EXISTEN /////////////////

			$sqltest20 = "select * from config_examen where course_id='$course_id'";



	    if (!$resultest20 = $db->query($sqltest20)) {



		die('There was an error running the query [' . $db->error . ']');



	    }

		

		while ($rowtest20 = $resultest20->fetch_assoc()) {

			$contartest++;

		}

			

			///////////////////////// FIN /////////////////////////////////

		

		/////////////////////////// CONTAMOS LOS EXAMANES

		$sqltest2 = "select * from config_examen where course_id='$course_id'";



	    if (!$resultest2 = $db->query($sqltest2)) {



		die('There was an error running the query [' . $db->error . ']');



	    }

		

		while ($rowtest2 = $resultest2->fetch_assoc()) {

			

			

			

			$idexamen = $rowtest2['id'];

			$contarexamenes=0;

			//////////////// VALIDAMOS SI USUARIO PRESENTO Y GANÓ ESTE EXAMEN //////////////////

			

			$sqltest3 = "select * from training where examen='$idexamen' and gvauser_id=$id and nota>=3";



	    if (!$resultest3 = $db->query($sqltest3)) {



		die('There was an error running the query [' . $db->error . ']');



	    }

		

		while ($rowtest3 = $resultest3->fetch_assoc()) {

			$contarexamenes=$contarexamenes+1;

		}

			

			

			

			

			

			////////////////// FINALIZAR VALIDACION /////////////

			

			

		}

	

	    //////////////////////////////// FIN

	

	}

	

	/////////////////////////////////////////////////////////////////

	

	if(($horas>=$intervalos) && ($contartest>0) && ($contartest<>$contarexamenes)) {

		

		?>

		

		<script>

alert('<?php echo NO_ALLOW_FLY; ?>');

window.location = './index_user.php?page=center_training';

</script>



<?php

		

		

		

	} else {

	// HORARIO CANCELACION
	
	
	

	
		// FIN


//  Get plane certifications

	$sql = "select * from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' order by plane_description asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}


	while ($rowusuarios = $result->fetch_assoc()) {

		
		$combobit .= " <option value='" . $rowusuarios['fleettype_id'] .  "'>" . $rowusuarios['plane_icao']	 . " (" . $rowusuarios['plane_description'] . ")</option>";

	}
	

	
	?>
	
	
			<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo MANUAL_PIREP_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white">  <?php echo MANUAL_PIREP_INFO; ?></font></h3>

</section>
		

		

			
			 <section class="cover imagebg  text-center" data-overlay="4">
                <div class="background-image-holder">
                    <img alt="background" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1><?php echo MANUAL_PIREP_TITLE_SECOND; ?></h1>
                            <p class="lead">
                                <?php echo MANUAL_PIREP_INFO_SECOND; ?>
                            </p>
                            <div class="boxed boxed--lg bg--white text-left">
                                <form class="form--horizontal" action="./index_user.php?page=report_manual_flight" method="post">
                                    <div class="col-sm-12">
							<div class="input-icon">
	                            <i class="flaticon-departures color--black"></i>
	                            <input type="text" maxlength="4" name="departure" placeholder="<?php echo DEPARTURE_CHARTER; ?>" required />
                            </div>
						</div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="flaticon-arrival color--black"></i>
	                            <input type="text" maxlength="4" name="arrival" placeholder="<?php echo ARRIVAL_CHARTER; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="flaticon-arrival color--black"></i>
	                            <input type="text" maxlength="4" name="alternative" placeholder="<?php echo MANUAL_PIREP_ALTERN; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="airlines" id="airlines" required>
                                            <option value="" disabled selected hidden><?php echo AIRLINE_CHARTER; ?></option>
											<?php 
    $sql_operator_global ="select * from operators";

	if (!$result_operator_global = $db->query($sql_operator_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator = $result_operator_global->fetch_assoc()) { ?>
                                            <option value="<?php echo $row_operator['operator_id']; ?>"><?php echo $row_operator['operator']; ?></option>
    <?php } ?>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="vuelo" placeholder="<?php echo FLIGHT_NUMBER_CHARTER; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="plane_icao" id="plane_icao" required>
                                            <option value="" disabled selected hidden><?php echo PLANE_CHARTER; ?></option>
											<?php echo $combobit; ?>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="category_acft" id="category_acft" required>
                                            <option value="" disabled selected hidden><?php echo MANUAL_PIREP_CATEGORY; ?></option>
                                            <option value="L"><?php echo MANUAL_PIREP_ACFT_LIGHT; ?></option>
											<option value="M"><?php echo MANUAL_PIREP_ACFT_MEDIUM; ?></option>
											<option value="H"><?php echo MANUAL_PIREP_ACFT_HEAVY; ?></option>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="sq" placeholder="<?php echo MANUAL_PIREP_FP_SQ; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="cruising_speed" placeholder="<?php echo MANUAL_PIREP_FP_CRUISE_SPEED; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="route" placeholder="<?php echo MANUAL_PIREP_FP_ROUTE; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="rmk" placeholder="<?php echo MANUAL_PIREP_FP_RMK; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="requestlevel" placeholder="<?php echo MANUAL_PIREP_FP_ALTITUDE; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">alarm</i>
	                            <input  maxlength="4" min="0000" max="2400" type="number" name="departure_time" placeholder="<?php echo MANUAL_PIREP_DEPARTURE_TIME; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">alarm</i>
	                            <input  maxlength="4"  min="0000" max="2400" type="number" name="time_arrival" placeholder="<?php echo MANUAL_PIREP_ARRIVAL_TIME; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<!--<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="material-icons color--black">people</i>
	                            <input type="number" name="pax" placeholder="<?php echo PAX_TOUR_PIREP; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
							    <i class="material-icons color--black">card_travel</i>
	                            <input type="number" name="cargo" placeholder="<?php echo CARGO_TOUR_PIREP; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-6">
                             <input type="number" min="0" max="24" name="hours" placeholder="<?php echo MANUAL_PIREP_HOURS; ?>" required />
                        </div>
                        <div class="col-sm-6">
                             <input type="number" min="0" max="60" name="minutes" placeholder="<?php echo MANUAL_PIREP_MINUTES; ?>" required />
                        </div>
						<div class="col-sm-12">  
						 <br>
						</div>-->
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="altern_landing" id="altern_landing" required>
                                            <option value="" disabled selected hidden><?php echo MANUAL_PIREP_LANDED; ?></option>
                                            <option value="0"><?php echo MANUAL_PIREP_LANDED_DEST; ?></option>
											<option value="1"><?php echo MANUAL_PIREP_LANDED_ALTN; ?></option>
                                        </select>
                                    </div>
                        </div>
						<div class="col-sm-12">  
						 <br>
						</div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="charter" id="charter" required>
                                            <option value="" disabled selected hidden><?php echo MANUAL_PIREP_TYPE; ?></option>
											<option value="0"><?php echo MANUAL_PIREP_TYPE_SCHEDULED; ?></option>
                                            <option value="1">Chárter</option>
											<option value="2">Tour ColStar</option>
											<option value="3">Tour IVAO</option>
                                        </select>
                                    </div>
                        </div>
						<input type="hidden" class="form-control" name="vid" id="vid"
						      value="<?php echo $ivaovid; ?>" required >
						<div class="col-sm-12">  
						 <br>
						</div>
							<div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo MANUAL_PIREP_BUTTON; ?></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			

		<?php } 
	
?>
