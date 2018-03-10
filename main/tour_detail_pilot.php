<?php
	$tour_id = $_GET['tour_id'];

	$pilot = $_GET['pilot_id'];
	include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	// hub
	$sql = "select tour_award_image, t.tour_image as tour_image , t.tour_id, t.tour_description, t.tour_name, t.start_date, t.end_date, t1.tour_lenght as tour_len, t2.num_leg as legs from tours t
  INNER JOIN
(select t.tour_id,sum(leg_length) as tour_lenght from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t1
on t1.tour_id = t.tour_id
  INNER JOIN
(select t.tour_id,count(tour_leg_id) as num_leg from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t2
on t.tour_id = t2.tour_id and t2.tour_id= $tour_id";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$tour_image = $row["tour_image"];
		$tour_award_image = $row["tour_award_image"];
		$tour_name = $row["tour_name"];
		$tour_description = $row["tour_description"];
		$start_date = $row["start_date"];
		$end_date = $row["end_date"];
		$tour_len = $row["tour_len"];
		$legs= $row["legs"];
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
    
	<h1><font color="white">Tour ColStar Alliance</font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white">  <?php echo DETAIL_TOUR_CST . ' ' . $tour_name ; ?></font></h3>

</section>
		
		
		


		<section class="contact">
			<div class="container">

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo TOUR_CST_START; ?></b></th>
												<th><b><?php echo TOUR_CST_END; ?></b></th>
												<th><b><?php echo DISTANCE_STATS; ?></b></th>
												<th><b><?php echo TOUR_CST_PHASES; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
										 <tr>
										 <td><?php echo $start_date; ?></td>
										 <td><?php echo $end_date; ?></td>
										  <td><?php echo $tour_len . ' NM'; ?></td>
										   <td>+<?php echo $legs; ?></td>
										 
										 </tr>
										 
										 
										 
										  </tbody>
                                    </table>
									
									
									<br>
									
									
									<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo PROFILE_DETAIL_TOUR_CST; ?>! #<?php echo $tour_name; ?></b></th>
												<th><b><?php echo AWARD_DETAIL_TOUR_CST; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
										 <tr>
										 <td><center><img src="../../admin/images/tour/logo/<?php echo $tour_image; ?>" width="70%" ></center></td>
										 <td><center><img src="../../admin/images/tour/premio/<?php echo $tour_award_image; ?>" width="70%" ></center></td>
										 
										 </tr>
										 
										 
										 
										  </tbody>
                                    </table>
									<br>
									<h2><b><?php echo TOUR_CST_INFO_SHORT; ?>!</b></h2><br>
									<h3><?php echo $tour_description; ?></h3>
<br>
<br>
<br>
<h1><?php echo STATUS_TOUR_CST; ?> #<?php echo $tour_name; ?></h1>
<?php 
$vue_apo =0;
	$sqls ="select leg_number,departure,arrival, IFNULL(status,9) as status from tour_legs tl left OUTER JOIN tour_pilots tp on tp.tour_id = tl.tour_id

and tp.leg_id = tl.leg_number and tp.gvauser_id=$id 

where tl.tour_id= $tour_id and status=1  order by leg_number asc";

	if (!$results = $db->query($sqls)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($rows = $results->fetch_assoc()) {
	
$vue_apo++;



	}

	$vares=0;
	$sqlsa ="select leg_number,departure,arrival, IFNULL(status,9) as status from tour_legs tl left OUTER JOIN tour_pilots tp on tp.tour_id = tl.tour_id

and tp.leg_id = tl.leg_number and tp.gvauser_id=$id 

where tl.tour_id= $tour_id and status=1  order by leg_number asc";

	if (!$resultsa = $db->query($sqlsa)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($rowsa = $resultsa->fetch_assoc()) {
	$vares++;
if($vue_apo == $vares)
	
	{
		$loca = $rowsa["arrival"];
	}



	}

	
	$calculos = round((100*$vue_apo)/$legs);
?>
<br>
<h3><b><?php echo PERFORMANCE_TOUR_CST; ?>:</b> <?php echo $calculos; ?>%</h3>


									<br>
									<h3><b><?php echo APPROVED_FLIGHTS; ?>: +<?php echo $vue_apo; ?></b></h3><br>
									<h3><b><?php echo LOCATION_TOUR_CST; ?>: <br>
									
									<?php 
									
									
									
							
							
							// Get Location info details

	$sql444 = "SELECT * FROM airports  where ident='$loca'";

	if (!$result444 = $db->query($sql444)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row444 = $result444->fetch_assoc()) {

		$location_airport_names = $row444['name'];

		$location_airport_flags = $row444['iso_country'];


                                                                        echo '<img src="./images/flags/24/' . $location_airport_flags . '.png" alt="' . $location_airport_flags . '">';
                                                                echo  '('. $loca . ')';
                                                                        echo '<br>';
						                         echo '<font size="4">&nbsp;'.$location_airport_names.'</font>';

	}


                                                                        echo '</td><td>&nbsp;&nbsp;<i class="fa fa-arrow-circle-down"></i>&nbsp;';
																		
																		?>
																		</b></h3>
																		
									<br>
									<br>
									
									<hr>


<?php

	

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}



	$sql = "select DATEDIFF (t.end_date,CURDATE()) as diff_days ,tour_award_image, t.tour_image as tour_image , t.tour_id,  t.tour_name, t.start_date, t.end_date, t1.tour_lenght as tour_len, t2.num_leg as legs from tours t

  INNER JOIN

(select t.tour_id,sum(leg_length) as tour_lenght from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t1

on t1.tour_id = t.tour_id

  INNER JOIN

(select t.tour_id,count(tour_leg_id) as num_leg from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t2

on t.tour_id = t2.tour_id and t2.tour_id= $tour_id";



	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {

		$diff_days = $row["diff_days"];

		$tour_image = $row["tour_image"];

		$tour_award_image = $row["tour_award_image"];

		$tour_name = $row["tour_name"];

		$start_date = $row["start_date"];

		$end_date = $row["end_date"];

		$tour_len = $row["tour_len"];

		$legs= $row["legs"];

	}

?>



	<?php

		// legs

		$sql ="select leg_number,departure,arrival,route, IFNULL(status,9) as status from tour_legs tl left OUTER JOIN tour_pilots tp on tp.tour_id = tl.tour_id

and tp.leg_id = tl.leg_number and tp.gvauser_id=$id 

where tl.tour_id= $tour_id  order by leg_number asc";



	?>

	<br>
	<br>
	
	<br>
	<br>
	<br>
	<h1>#<?php echo $tour_name; ?> <?php echo PROCESS_TOUR_CST; ?></h1>
	<br>
	<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											<?php

						if (!$result = $db->query($sql)) {

							die('There was an error running the query [' . $db->error . ']');

						}

						if ($diff_days<0) {
                       echo '<th><b>#</b></th>';
						echo '<th><b>' . DEPARTURE_TOUR_CST . '</b></th>';
						echo '<th><b>' . ARRIVAL_TOUR_CST . '</b></th>';
						echo '<th><b>' . STATUS_PROCESS_TOUR_CST . '</b></th>';

						}else {
                        
						  echo '<th><b>#</b></th>';
						echo '<th><b>' . DEPARTURE_TOUR_CST . '</b></th>';
						echo '<th><b>' . ARRIVAL_TOUR_CST . '</b></th>';
						echo '<th><b>' . BOOK_ROUTE_ROUTE . '</b></th>';
						echo '<th><b>' . STATUS_PROCESS_TOUR_CST . '</b></th>';
						echo '<th><b>' . PIREP_LEG_TOUR_CST . '</b></th>';
						echo '<th><b>' . DISPATCH_TOUR_CST . '</b></th>';
						
							

						}
						
						?>
												
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
										 <tr>
										 	<?php


$numeros = 0;
					

						while ($row = $result->fetch_assoc()) {
$numeros++;
							echo '<tr><td>';

							echo $numeros .').</td><td>';
							
							
							
							
							
							$locations = $row["departure"];
							
							
							// Get Location info details

	$sql4 = "SELECT * FROM airports  where ident='$locations'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row4 = $result4->fetch_assoc()) {

		$location_airport_names = $row4['name'];

		$location_airport_flags = $row4['iso_country'];


                                                                        echo '<i class="fa fa-arrow-circle-down"></i>&nbsp;<img src="./images/flags/24/' . $location_airport_flags . '.png" alt="' . $location_airport_flags . '">';
                                                                echo  '('. $row["departure"] . ')';
                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'.$location_airport_names.'</font>';

	}


                                                                        echo '</td><td>';

                                                                    

																		
																		
																		

							
							
							$locationss = $row["arrival"];
							
							
							// Get Location info details

	$sql44 = "SELECT * FROM airports  where ident='$locationss'";

	if (!$result44 = $db->query($sql44)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row44 = $result44->fetch_assoc()) {

		$location_airport_names = $row44['name'];

		$location_airport_flags = $row44['iso_country'];


                                                                        echo '<i class="fa fa-arrow-circle-down"></i>&nbsp;<img src="./images/flags/24/' . $location_airport_flags . '.png" alt="' . $location_airport_flags . '">';
                                                                echo  '('. $row["arrival"] . ')';
                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'.$location_airport_names.'</font>';

	}


                                                                        echo '</td><td>';
																		
																if (($numeros==1 && $vue_apo==0)){
																	
																
													echo $row["route"] .'</td><td>';	
													$route = $row["route"];

}			else 		if ($vue_apo >= $numeros){
	
	echo '<font color="green">' . DONE_FLIGHT_TOUR_CST . '!</font></td><td>';	
}	else 		if ($vue_apo < $numeros){
	
	echo '<font color="red">' . NO_AVAILABLE_FLIGHT . '</font></td><td>';	
}								
																		
																		

							if ($row["status"]==1)

							{

								echo '<i class="icon color--primary icon-Check icon--sm"></i>';

							}

							elseif ($row["status"]==0)

							{

								echo '<i class="icon color--primary icon-Pause icon--sm"></i>';

							}

							elseif ($row["status"]==2)

							{

								echo '<i class="icon color--primary icon-Danger icon--sm"></i>';

							}

							else

							{

								echo '</td><td>';

							}

							if ($row["status"]==1)

							{

								echo '</td><td>';

							}

							elseif ($row["status"]==0)

							{

								echo '</td><td>';

							}

							elseif ($row["status"]==2)

							{

								if ($diff_days>=0) {
									
if (($locations == $loca) || ($numeros==1 && $vue_apo==0)){
	
	echo '<a href="./index_user.php?page=tour_report&tourid=' . $tour_id . '&legid=' . $row["leg_number"] . '"><i class="icon color--primary icon-Check"></i></a></td><td>';
}	else {
	echo '<a href="#"><i class="icon color--primary icon-Pause"></i><br>' . WAITING_FLIGHT . '</a></td><td>';
	
}

	
	
}
									

								}

							

							else

							{

								if ($diff_days>=0) {

									
if (($locations == $loca) || ($numeros==1 && $vue_apo==0)){
	
	echo '<a href="./index_user.php?page=tour_report&tourid=' . $tour_id . '&legid=' . $row["leg_number"] . '"><i class="icon color--primary icon-Check"></i></a></td><td>';

	}		else {
	echo '<a href="#"><i class="icon color--primary icon-Pause"></i><br>' . WAITING_FLIGHT . '</a></td><td>';
	
}


								}

							}
							
							
							
							if (($locations == $loca) || ($numeros==1 && $vue_apo==0)){
																	
																
													?>
													
													<button class="btn btn--primary" onclick="window.location.href='./index_user.php?page=dispatch_tour&departure=<?php echo $locations; ?>&arrival=<?php echo $locationss; ?>&route=<?php echo $route; ?>'"><?php echo CREATE_DISPATCH_TOUR_CST; ?></button>
													<?
}			else 		if ($vue_apo >= $numeros){
	
	echo '<font color="green">Check-In!</font></td>';	
}	else 		if ($vue_apo < $numeros){
	
	echo '<font color="red">' . COMING_SOON_FLIGHT . '.</font></td>';	
}		
							?>


						





							
							
							<?
							
							echo '</tr>';

						}



					?>

										 </tr>
										 
										 
										 
										  </tbody>
                                    </table>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

					
						
					
				
				
				



	<div class="clearfix visible-lg"></div>

</div>


</div>
</section>