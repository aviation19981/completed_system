



<?php
	require('./check_login.php');
	include('./db_login.php');
	
	$tourid = $_GET['tourid'];
	$legid = $_GET['legid'];

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

		$sql = "SELECT * FROM tour_legs where leg_number='$legid' and tour_id='$tourid'";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$tour_leg_id = $row['tour_leg_id'];
		$departure = $row['departure'];
		$arrival = $row['arrival'];
		$route = $row['route'];
	}
	
	// FIN

	

	
	?>
	
	
		<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white">Tour ColStar Alliance</font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo PIREP_TOUR_TITLE; ?> </font></h3>

</section>
		
		
		

			
			
			<section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-7">
                            <h1><?php echo INFO_PIREP_TOUR_TITLE; ?></h1>
                            <form action="./index_user.php?page=report_tour_cst" method="post">
						<div class="col-sm-12">
							<div class="input-icon">
	                            <i class="flaticon-departures color--black"></i>
	                            <input type="text" maxlength="4" name="departure" placeholder="<?php echo DEPARTURE_CHARTER; ?>" value="<?php echo $departure; ?>" readonly="readonly" required />
                            </div>
						</div>
						<div class="col-sm-12">	
							<div class="input-icon">
	                            <i class="flaticon-arrival color--black"></i>
	                            <input type="text" maxlength="4" name="arrival" placeholder="<?php echo ARRIVAL_CHARTER; ?>" value="<?php echo $arrival; ?>" readonly="readonly" required />
                            </div>
	                    </div>
						<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="airlines" id="airlines" required >
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
							<div class="input-icon">
	                            <i class="material-icons color--black">people</i>
	                            <input type="number" name="pax" placeholder="<?php echo PAX_TOUR_PIREP; ?>" required />
                            </div>
	                    </div>
						<div class="col-sm-12">	
							<div class="input-icon">
							    <i class="material-icons color--black">card_travel</i>
	                            <input type="number" name="cargo" placeholder="<?php echo CARGO_TOUR_PIREP; ?>" required/>
                            </div>
	                    </div>
								
							<input type="hidden" class="form-control" name="vid" id="vid" value="<?php echo $ivaovid; ?>">
					        <input type="hidden" class="form-control" name="legid" id="legid" value="<?php echo $legid; ?>">
			                <input type="hidden" class="form-control" name="tourid" id="tourid" value="<?php echo $tourid; ?>">
							
							<div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo SEND_TOUR_CST_PIREP; ?></button>
                                </div>
							</form>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>

	
