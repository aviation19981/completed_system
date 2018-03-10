	

<?php

	require('./check_login.php');
    require('./db_login.php'); 
	   
	$horas = ($gva_hourse + $transfered_hours);
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
    $db->query("SET SQL_BIG_SELECTS=1");  //Set it before your main query
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
	
	$intervalos = $rank_idnew-5;
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
		
		
		
		
		
		
	
		$contadores=0;
		
		
		
		

	$sql = "select route_id from gvausers gu where	gu.gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	while ($row = $result->fetch_assoc()) {
		$route = $row["route_id"];
		$route_id = $row["route_id"];
	}
	if ($route <> '' && $route > 0)
	{
	$sql1 = "select * from routes ro, reserves re, fleets f, fleettypes ft where ft.fleettype_id=f.fleettype_id and f.fleet_id=re.fleet_id and ro.route_id=$route and ro.route_id=re.route_id and  re.gvauser_id=$id";
	if (!$result1 = $db->query($sql1)) {
		die('There was an error running the query [' . $db->error . ']');
	}

$sql2 = "select * from reserves re where re.gvauser_id=$id";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	
	while ($row1 = $result1->fetch_assoc()) {
	$contadores++;
	}
    if($contadores>0){
	 ?>
	   
	   
<script>   
window.location = './index_user.php?page=volar';
 
</script>
<?php
	}
				}
				else
				{
				
				
			

	
	?>




<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo FILTER_FLIGHTS; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_FILTER_FLIGHTS; ?></font></h3>

</section>

	
			
		
	
<section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="tabs-container tabs--vertical">
                                <ul class="tabs">
                                    <li class="active">
                                        <div class="tab__title">
                                            <i class="icon icon--sm block icon-Plane"></i>
                                            <span class="h5"><?php echo PLANE_SCHEDULE; ?></span>
                                        </div>
                                        <div class="tab__content">
                                            
											 <center>
<form action="./index_user.php?page=volar" method="post">
    <div>
		<h2 style="margin-top: 0;color:#2a4982"><?php echo PLANE_SCHEDULE; ?></h2>
 <div class="input-select">       
<select id="aeronave" name="aeronave"  >
<?php //  Get plane certifications

	$sql = "select DISTINCT ft.fleettype_id, ft.plane_description from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' order by plane_description asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	$planes = '';

	$planes_certificated = array();

	$i = 0;

	while ($rowusuarios = $result->fetch_assoc()) {


	echo '<option value="' . $rowusuarios["fleettype_id"] . '">' . $rowusuarios["plane_description"] . '</option>';
	
	 } ?>   
</select>	
</div>
<br>
<br>										   
    </div>
    <div>
        <button type="submit" class="btn btn-primary btn-lg" value="Submit"><?php echo SEARCH_FLIGHTS; ?></button>
    </div>
</form>
                    </center>
											
                                        </div>
                                    </li>
                                    <li>
                                        <div class="tab__title">
                                            <i class="icon icon--sm block icon-Road-2"></i>
                                            <span class="h5"><?php echo DISTANCE_SCHEDULE; ?></span>
                                        </div>
                                        <div class="tab__content">
                                            
											   <center>
<form action="./index_user.php?page=volar" method="post">
    <div>
		<h2 style="margin-top: 0;color:#2a4982"><?php echo DISTANCE_SCHEDULE; ?> <b>NM</b></h2>
        
<input type="number"  id="distancia" name="distancia"  placeholder="0"/>										   
    </div>
	<br>
	<br>
    <div>
        <button type="submit" class="btn btn-primary btn-lg" value="Submit">SEARCH_FLIGHTS</button>
    </div>
</form>
                    </center>
					
                                        </div>
                                    </li>
                                    <li>
                                        <div class="tab__title">
                                            <i class="flaticon-arrival color--primary icon--sm block"></i>
                                            <span class="h5"><?php echo ARRIVAL_SCHEDULE; ?></span>
                                        </div>
                                        <div class="tab__content">
                                            
											 <center>
<form action="./index_user.php?page=volar" method="post">
    <div>
        <h2 style="margin-top: 0;color:#2a4982"><?php echo ARRIVAL_SCHEDULE; ?></h2>
		<div class="input-select">     
<select id="destino" name="destino">
<?php //  Get plane certifications

	$sql2 = "select DISTINCT r.arrival from 
						fleets f inner join gvausers g on g.location = f.location 
						inner join routes r on r.departure = f.location
						inner join fleettypes_routes ftr on ftr.route_id = r.route_id 
						inner join fleettypes_gvausers ftu on ftu.fleettype_id = f.fleettype_id
						where f.booked=0 and f.hangar=0
						and ftr.fleettype_id = f.fleettype_id
						and g.gvauser_id=$id
						and ftu.gvauser_id=$id";
						
				if (!$result2 = $db->query($sql2)) {
					die('There was an error running the query [' . $db->error . ']');
				}

	while ($row2 = $result2->fetch_assoc()) {


	echo '<option value="' . $row2["arrival"] . '">' . $row2["arrival"] . '</option>';
	
	 } ?>   
</select>		
</div>									   
    </div>
	<br>
	<br>
    <div>
        <button type="submit" class="btn btn-primary btn-lg" value="Submit"><?php echo SEARCH_FLIGHTS; ?></button>
    </div>
</form>
                    </center>
					
                                        </div>
                                    </li>
									<li>
                                        <div class="tab__title">
                                            <i class="icon icon--sm block icon-Business-Mens"></i>
                                            <span class="h5"><?php echo AIRLINE_SCHEDULE; ?></span>
                                        </div>
                                        <div class="tab__content">
                                            
											       <center>
<form action="./index_user.php?page=volar" method="post">
    <div>
        <h2 style="margin-top: 0;color:#2a4982"><?php echo AIRLINE_SCHEDULE; ?></h2>
		<div class="input-select">     
<select id="aerolinea" name="aerolinea"  >
<?php //  Get plane certifications

	$sql2 = "select * from operators";
						
				if (!$result2 = $db->query($sql2)) {
					die('There was an error running the query [' . $db->error . ']');
				}

	while ($row2 = $result2->fetch_assoc()) {


	echo '<option value="' . $row2["operator_id"] . '">' . $row2["operator"] . '</option>';
	
	 } ?>   
</select>											   
    </div>
	</div>
	<br>
	<br>
    <div>
        <button type="submit" class="btn btn-primary btn-lg" value="Submit"><?php echo SEARCH_FLIGHTS; ?></button>
    </div>
</form>
                    </center>
											
                                        </div>
                                    </li>
									<li>
                                        <div class="tab__title">
                                            <i class="icon icon--sm block icon-Chacked-Flag"></i>
                                            <span class="h5"><?php echo OPTIONS_FLIGHT; ?></span>
                                        </div>
                                        <div class="tab__content">
                                            
											  <center>
<form action="./index_user.php?page=volar" method="post">
    <div>
        <h2 style="margin-top: 0;color:#2a4982"><?php echo OPTIONS_FLIGHT; ?></h2>
		<div class="input-select">     
<select id="typeflight" name="typeflight"  >
<option value="1"><?php echo NATIONALS; ?></option>  
<option value="2"><?php echo INTERNATIONALS; ?></option> 
</select>											   
    </div>
	</div>
	<br>
	<br>
    <div>
        <button type="submit" class="btn btn-primary btn-lg" value="Submit"><?php echo SEARCH_FLIGHTS; ?></button>
    </div>
</form>
                    </center>
											
                                        </div>
                                    </li>
									<li>
                                        <div class="tab__title">
                                            <i class="icon icon--sm block icon-Paper-Plane"></i>
                                            <span class="h5"><?php echo ALL; ?></span>
                                        </div>
                                        <div class="tab__content">
                                            
											 <center>
                      <h1 class="icon icon--sm block icon-Plane" style="font-size:12em;color:#2a4982"></h1>
                      <h2 style="margin-top: 0;color:#2a4982"><?php echo ALL_SCHEDULE; ?></h2>
                      
					  <form action="./index_user.php?page=volar" method="post">
					  <button type="submit" class="btn btn-primary btn-lg" value="Submit"><h3 style="margin-top: 0;color:#ffffff"><?php echo SEARCH; ?></h3></button>
					  </form>
                    </center>
					
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--end of tabs container-->
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>


		
		


		
		
		
<?php	}	 } ?>