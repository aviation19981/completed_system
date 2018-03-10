<?php
include('./db_login.php');
	$idevent = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from events where event_id='$idevent'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		
        $create_date= $row3["create_date"];
		$publish_date= $row3["publish_date"];
		$hide_date= $row3["hide_date"];
		$gvauser_id_event= $row3["gvauser_id"];
		$event_name= $row3["event_name"];
		$event_text= $row3["event_text"];
		
		
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
    
	<h1><font color="white"><?php echo EVENT_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo DETAIL_EVENT; ?> <b><?php echo $event_name; ?></b>   </font></h3>

</section>
		
                                         
						 

	<section class="contact">
			<div class="container">

	
                            
                    
                            <div class="row">
							<center><h1><font color="red"><?php echo $event_name; ?></font></h1></center>
								
								
								<hr>
                                <div class="col-md-12">
								<br>
								
                                         <h3><?php echo PILOT_FLIGTHS_DETAILS; ?></h3>
									
										<hr>
										<?php echo $event_text; ?>
										<br>
										<hr>
										
										<p><?php 
										
	$sql33 ="select * from gvausers where gvauser_id='$gvauser_id_event'";

	if (!$result33 = $db->query($sql33)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row33 = $result33->fetch_assoc()) {
		$nombrese= $row33["name"] . ' ' . $row33["surname"];
		$callsign_user = $row33["callsign"];
		$vidivao = $row33["ivaovid"];
	}
	echo '<span style="color: #2a4982; font-family: Arial; font-size: 11pt;"><strong>' . $nombrese . '</strong></span><br>';
	
	

		echo '<span style="color: #666666; font-size: 10pt;"><strong>' . $callsign_user . ' - ' . $vidivao . '</strong></span><br>';
		
	
	

		?>
										
										<span style="color: #666666; font-size: 8pt;">ColStar Alliance<br />
										<a href="<?php echo $web; ?>"><font color="blue"><?php echo $web; ?></font></a></span></p>

										

                                 
                                </div>
								
								
								
													   
                            </div>
							
							 </div>
							 </section>
                       									 
					