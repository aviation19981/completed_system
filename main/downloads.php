<?php
include('./db_login.php');
include('./check_login.php');
$id = $_SESSION["id"];

if (empty($id)) {
		echo '<meta http-equiv="refresh" content="0; url=./index.php?page=nosession" />';
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
    
	<h1><font color="white"><?php echo DOWNLOAD_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_DOWNLOAD_TITLE; ?></font></h3>

</section>




		<section class="contact">
			<div class="container">
	
	 <!-- Classic Heading -->
              <h3 class="classic-title"><b><span>Livery Ground Service X (GSX) [FSDreamTeam]</span></b></h3>
			  <br>
			  <p><b><?php echo PASSWORD_PRODUCT; ?>:</b> 49ICI43493J603I1435990837541KLT30D613916296L306L406H2L6M441U23898MPE2</p>
			  <hr>
	<!-- Simulador  -->
	
	
	
	<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo SIMULATOR_PRODUCT; ?></b></th>
												<th><b>Link</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
									 
				<tr>
				<td>Microsoft Flight Simulator X, Steam</td>
				<td><a href="http://www.mediafire.com/file/nsa57y75p0ecan1/GSX+Installer+ColStar+VA%282%29.exe">Link</a></td>
				</tr>
				
				<tr>
				<td>Lockeed Martin Prepar3D	</td>
				<td><a href="http://www.mediafire.com/file/x82f4r7fxjd4w8n/GSX+Installer+ColStar+VA.exe">Link</a></td>
				</tr>
			
			
 </tbody>
                                    </table>
										<br>
		<br>
		
		
		
		
		 <!-- Classic Heading -->
              <h3 class="classic-title"><b><span>Livery Ground Service X-Plane [10-11] [2018] [JARDesign Ground Handling]</span></b></h3>
			  <br>
			  <hr>
	<!-- Simulador  -->
	
	
	
	<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo SIMULATOR_PRODUCT; ?></b></th>
												<th><b>Link</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
									 
				<tr>
				<td>X-Plane 10 <?php echo AND_INFO; ?> 11</td>
				<td><a href="http://www.mediafire.com/file/zn896l9n79uir6j/Livery%20ColStar%20Alliance%20-%20Ground%20Handling%20Deluxe%20by%20JARDesign.rar">Link</a></td>
				</tr>
			
 </tbody>
                                    </table>
										<br>
		<br>
		
		
		
	
 <!-- Classic Heading -->
              <h3 class="classic-title"><b><span>SplashScreen <?php echo FOR_THE_SIM; ?></span></b></h3>
			  <hr>
	<!-- Simulador  -->
	
	
	
	<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo SIMULATOR_PRODUCT; ?></b></th>
												<th><b>Link</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
				<tr>
				<td>Microsoft Flight Simulator 2004</td>
				<td><a href="http://www.mediafire.com/file/gf2or1804qdx3no/Dlgsplash%20FS9.rar">Link</a></td>
				</tr>
				
				<tr>
				<td>Microsoft Flight Simulator X</td>
				<td><a href="http://www.mediafire.com/file/5pfsgnx1vtdr965/Dlgsplash%20FSX.rar">Link</a></td>
				</tr>
				
				<tr>
				<td>Lockeed Martin Prepar3D</td>
				<td><a href="http://www.mediafire.com/file/hzwg410lwf646nv/Dlgsplash%20P3D.rar">Link</a></td>
				</tr>
				
				<tr>
				<td>X-Plane 11</td>
				<td><a href="http://www.mediafire.com/file/ahfekoaxd12va1m/Dlgsplash%20X-Plane%2011.rar">Link</a></td>
				</tr>
 </tbody>
                                    </table>
										<br>
		<br>
		
		
		
	       									 
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	
	 //  Get plane certifications

	$sql_plane = "select DISTINCT  * from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' order by plane_description asc";

	if (!$result_plane = $db->query($sql_plane)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	$planes = '';

	$planes_certificated = array();

	$i = 0;

	while ($rowusuarios = $result_plane->fetch_assoc()) {
         
		$planes .= $rowusuarios["fleettype_id"] . '</br>';
		
		if(in_array($rowusuarios["fleettype_id"],$planes_certificated)) {
			
		} else {

		$planes_certificated[$i] = $rowusuarios["fleettype_id"];

		$i++;
		}

	}
	
	//////////////////////
	
	
	$sql = "select DISTINCT  * from simuladores order by nombre asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	$sims=$row["id"];
?>


	
	 <!-- Classic Heading -->
              <h3 class="classic-title"><b><span><?php echo $row["nombre"]; ?></span></b></h3>
			  <hr>
	<!-- Simulador  -->
	
	
	
	<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>ICAO</b></th>
												<th><b><?php echo PICTURE_PRODUCT; ?></b></th>
												<th><b>Link</b></th>
												<th><b><?php echo STATUS_PRODUCT; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
										 <?php
										 
										
										 
										 $sql2 = "select DISTINCT  * from textures where idsim='$sims' order by nombre asc";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row2 = $result2->fetch_assoc()) {
		$icaos = $row2["icao"];
		$x_value = '';
						if (sizeof($planes_certificated) > 0) {
							foreach ($planes_certificated as $x => $x_value) {
								
								if ($x_value == $icaos) {
		
			if($row2["estado"]==1) {
		$estados = '<div class="alert bg--success">
                                <div class="alert__body">
                                    <span>' . ACTIVE_PRODUCT . '</span>
                                </div>
                            </div>';
	} else {
		 $estados = '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_ACTIVE_PRODUCT . '</span>
                                </div>
                            </div>';
	}
	
	
	
		echo '<tr>';
  echo '<td>' . $row2["nombre"] . '</td>';
  echo '<td><img src="../../admin/images/aviones/' . $row2["imagen"] . '" WIDTH="200px" heigh="80px"></td>';
  echo '<td><a href="' . $row2["link"] . '" target="_blank">Link</a></td>';
  echo '<td><center>' . $estados . '</center></td>';
echo ' </tr>';
								}
							}
		
	}

	}	
						
							?>
 </tbody>
                                    </table>
										<br>
		<br>
	
	<?php  
} ?>
	

		
		
								
								
								
								
							
								
					</div>			
								
								
								
								
			</section>
			
	<?php } ?>
	

