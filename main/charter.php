
<?php
	require('check_login.php');
	include('planedd_dos.php');
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
	
	
	
		$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$allow_charter_flight = 0;
	$hours_charter = 0;
	while ($row = $result->fetch_assoc()) {
		$allow_charter_flight = $row["allow_charter_flight"];
		$hours_charter = $row["hours_charter"];
	}
	
	
	if($allow_charter_flight==1) {
	

	
	$horas = ($gva_hourse + $transfered_hours);
	
	if($horas<$hours_charter) {
		?>
		
			<script>
alert('<?php echo str_replace("HOURS_CHARTER",$horas,HOURS_CHARTER_PRO); ?>');
window.location = './index_user.php';
</script>
	
		<?php
	} else {
		
	
	
	
	?>
	
	
	<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white">Chárter ColStar Alliance</font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo CHARTER_INFO_TITLE; ?></font></h3>

</section>
		
		
			
			
			<section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-7">
                            <h1><?php echo PIREP_CHARTER_INFO_TITLE; ?></h1>
                            <form action="./index_user.php?page=manualcst" method="post">
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="flaticon-departures color--black"></i>
	                            <input type="text" maxlength="4" name="departure" placeholder="<?php echo DEPARTURE_CHARTER; ?>" value="<?php echo $location; ?>" readonly="readonly"/>
                            </div>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="flaticon-arrival color--black"></i>
	                            <input type="text" maxlength="4" name="arrival" placeholder="<?php echo ARRIVAL_CHARTER; ?>" required />
                            </div>
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
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text" name="vuelo" placeholder="<?php echo FLIGHT_NUMBER_CHARTER; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="plane" id="plane" required >
										    <option value="" disabled selected hidden><?php echo PLANE_CHARTER; ?></option>
											<?php echo $combobit; ?>
                                        </select>
                                    </div>
                        </div>
						
						<input type="hidden" class="form-control" name="vid" id="vid"
						      value="<?php echo $ivaovid; ?>" required >
						
							<div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo REGISTER_PIREP_CHARTER; ?></button>
                                </div>
							</form>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>

		<?php } 
	
	
	} else {?>
		<script>
alert('<?php echo CHARTER_NO_ALLOW; ?>');
window.location = './index_user.php';
</script>
	
	<?php }?>
		<?php } ?>
