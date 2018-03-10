

<?php



	require('./check_login.php');

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

alert('<?php echo NO_ALLOW_FLY; ?>.');

window.location = './index_user.php?page=center_training';

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
    
	<h1><font color="white">Tour ColStar Alliance</font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo INFO_TOUR_CST; ?> </font></h3>

</section>
		
		
		


		<section class="contact">
			<div class="container">
<?php

	$sql ="select DATEDIFF (t.end_date,CURDATE()) as diff_days,COALESCE(t3.accepted,0) as accepted,t.tour_id, t.tour_name, t.start_date, t.end_date, COALESCE(t1.tour_lenght,0)  as tour_len, t2.num_leg as legs from tours t left outer JOIN
  (select t.tour_id,count(leg_id) as tour_lenght from tour_pilots t inner join tours tl on t.tour_id = tl.tour_id where gvauser_id= $id GROUP BY tour_id) t1 on t.tour_id = t1.tour_id
  left outer JOIN (select t.tour_id,count(tour_leg_id) as num_leg from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t2 on t.tour_id = t2.tour_id left outer JOIN (select t.tour_id,count(leg_id) as accepted from tour_pilots t inner join tours tl on t.tour_id = tl.tour_id where gvauser_id= $id and t.status= 1 ) t3 on t3.tour_id = t.tour_id";



	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
?>


<h1><?php echo ACTIVE_TOURS_CST; ?></h1>
<hr>
<br>
<br>
<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Tour</b></th>
												<th><b><?php echo TOUR_CST_START; ?></b></th>
												<th><b><?php echo TOUR_CST_END; ?></b></th>
												<th><b><?php echo TOUR_CST_PHASES; ?></b></th>
												<th><b><?php echo TOUR_CST_INFORMATION; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
										 
										   <?php
					
					while ($row = $result->fetch_assoc()) {
						if ($row["diff_days"]>=0) {
							echo "<tr><td>";
							echo $row["tour_name"] . '</td><td>';
							echo $row["start_date"] . '</td><td>';
							echo $row["end_date"] . '</td><td>';
							echo '+' . $row["legs"] . '</td><td>';
							echo '<a href="./index_user.php?page=tour_detail_pilot&tour_id=' . $row["tour_id"] . '&pilot_id=' . $id . '"><span class="flaticon-flight icon icon--sm"></span></a></td><td>';
							
						}
					}
					
					

				?>
										 
										
										 
										 
										 
										  </tbody>
                                    </table>



<?php
	$sql ="select DATEDIFF (t.end_date,CURDATE()) as diff_days,COALESCE(t3.accepted,0) as accepted,t.tour_id, t.tour_name, t.start_date, t.end_date, COALESCE(t1.tour_lenght,0)  as tour_len, t2.num_leg as legs from tours t left outer JOIN
  (select t.tour_id,count(leg_id) as tour_lenght from tour_pilots t inner join tours tl on t.tour_id = tl.tour_id where gvauser_id= $id GROUP BY tour_id) t1 on t.tour_id = t1.tour_id
  left outer JOIN (select t.tour_id,count(tour_leg_id) as num_leg from tours t inner join tour_legs tl on t.tour_id = tl.tour_id GROUP BY tour_id) t2 on t.tour_id = t2.tour_id left outer JOIN (select t.tour_id,count(leg_id) as accepted from tour_pilots t inner join tours tl on t.tour_id = tl.tour_id where gvauser_id= $id and t.status= 1 ) t3 on t3.tour_id = t.tour_id";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
?>

<br>
<br>





<h1><?php echo INACTIVE_TOURS_CST; ?></h1>
<hr>
<br>
<br>
<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Tour</b></th>
												<th><b><?php echo TOUR_CST_START; ?></b></th>
												<th><b><?php echo TOUR_CST_END; ?></b></th>
												<th><b><?php echo TOUR_CST_PHASES; ?></b></th>
												<th><b><?php echo TOUR_CST_INFO_SHORT; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
										 
										   <?php
					
					while ($row = $result->fetch_assoc()) {
						if ($row["diff_days"]<0) {
							echo "<tr><td>";
							echo $row["tour_name"] . '</td><td>';
							echo $row["start_date"] . '</td><td>';
							echo $row["end_date"] . '</td><td>';
							echo '+' . $row["legs"] . '</td><td>';
							echo '<a href="./index_user.php?page=tour_detail_pilot&tour_id=' . $row["tour_id"] . '&pilot_id=' . $id . '"><span class="flaticon-flight icon icon--sm"></span></a></td></tr>';
						}
					}

				?>
										 
										
										 
										 
										 
										  </tbody>
                                    </table>
									
									
									<br>
									<br>
									<br>
									
									
									
									
									


</div>
</section>
	<?php } ?>