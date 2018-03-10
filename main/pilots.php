

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo OUR_COMMUNITY; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_OUR_COMMUNITY; ?></font></h3>
		

</section>

        	<div class="clear"></div>  
		  
			<section class="text-center bg--secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                            <div class="cta">
							<br>
		<br>
                                <h2><?php echo PILOTS_CST;?></h2>
                                <p class="lead">
                                    <?php echo INFO_PILOTS_CST; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
            <section class="switchable feature-large">
                <div class="container">
                    
					
					
					
		             									 
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
		$sql_airlines_allow = "SELECT * from operators";
	if (!$result_airlines_allow = $db->query($sql_airlines_allow)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_airlines_allow = $result_airlines_allow->fetch_assoc()) {
			$operator_id_rank = $row_airlines_allow['operator_id'];
			
		$contar=0;	
				$sql = "select * from gvausers where operator_id='$operator_id_rank' order by callsign asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
}


				
			   ?>
			   
			   
			   <ul class="accordion accordion-1">
	<li>
		<div class="accordion__title">
			<span class="h5"><?php echo INFO_PILOTS_CST; ?> :: <?php echo $row_airlines_allow['operator'] ; ?></span>
		</div>
		<div class="accordion__content">
	<div style="height:500px; width:100%; overflow-y: scroll; overflow-x: false;">		
		
		
		
		
<h2><?php echo $row_airlines_allow['operator'] ; ?></h2>
<hr>




				

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Callsign</b></th>
												<th><b><?php echo NAME; ?></b></th>
												<th><b><?php echo RANK; ?></b></th>
												<th><b><?php echo LOCATION; ?></b></th>
												<th><b><?php echo TIME_CST_HR; ?></b></th>
												<th><b>IVAO</b></th>
												<th><b><?php echo STATUS; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
<?php while ($row = $result->fetch_assoc()) { 
	$contar++;
	$locationas = $row["location"];

$sql6 = "SELECT * FROM airports  where ident='$locationas' ";

	if (!$result6 = $db->query($sql6)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6 = $result6->fetch_assoc()) {

		$location_airport_namesssls = $row6['name'];

		$location_airport_flagsssls = $row6['iso_country'];

	}
	
	$vidusuario = $row["gvauser_id"];
	$horasvuelo= 0;
	
	$sql_pcas = "select * from cstpireps where gvauser_id=$vidusuario"; 
if (!$result_pcas = $db->query($sql_pcas)) {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row_pcas = $result_pcas->fetch_assoc()) {
	$horasvuelo=$horasvuelo+$row_pcas["connection_time"];
	}
	

										    echo '<tr>';
											
										echo '<td><a href="./index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["callsign"] . '</a></td>';
										//echo '<td><a href=' . $row["callsign"] . '</td>';
										echo '<td>' . $row["name"] . ' ' . $row["surname"] . '</td>';
										
										echo '<td>';
										$imgrank = '';
										 $namerank ='';
										if (strlen($row["rank_id"]) <> 0) {
											
											$ranks_ides = $row["rank_id"];
											
											$sql6s = "select rank,salary_hour,img from ranks where rank_id='$ranks_ides'";

	if (!$result6s = $db->query($sql6s)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6s = $result6s->fetch_assoc()) {

		$imgrank = $row6s['img'];
        $namerank = $row6s['rank'];

	}
	
	
							echo '<img src="../admin/images/ranks/' . $imgrank . '" WIDTH=20%>' . ' ';
						}
						
										echo $namerank . '</td>';
										
										
										echo '<td>';
										
										echo $row["location"] . ' ';


echo '<img src="./images/flags/24/' . $location_airport_flagsssls . '.png" alt="' . $location_airport_flagsssls . '">';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'. $location_airport_namesssls .'</font>';
												 
												 
										echo '</td>';
										
										
										$sumas= $horasvuelo + $row["transfered_hours"];
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';


										echo '<td>' . $total . '</td>';
										
										
								
                                        $datos = '<a href="https://www.ivao.aero/Login.aspx?r=Member.aspx?Id=' . $row["ivaovid"] . '" target="_blank"><img src="http://status.ivao.aero/' . $row["ivaovid"] . '.png" align="middle"/></a><br><center>VID: <b>' . $row["ivaovid"] . '</b></center>';
						
						
						
										echo '<td>' . $datos . '</td>';
										
										
										
										if ($row["activation"] == 1)  { 
										
										$modulos = '<div class="alert bg--success">
                                                     <div class="alert__body ">
                                                       <span>' . USER_ACTIVE . '</span>
                                                     </div>
                                                  </div>';
												  
										} else if ($row["activation"] == 2)  { 
											
											
										$modulos = '<div class="alert">
                                                     <div class="alert__body">
                                                       <span>' . USER_INACTIVE . '</span>
                                                     </div>
                                                  </div>';
												  
										
										} else if ($row["activation"] == 3)  { 
										$modulos = '<div class="alert bg--error">
                                                     <div class="alert__body ">
                                                       <span>' . USER_SUSPENDED . '</span>
                                                     </div>
                                                  </div>';
										
										} else if ($row["activation"] == 4)  { 
											
										$modulos = '<div class="alert bg--primary">
                                                     <div class="alert__body">
                                                       <span>' . ON_VACATION . '</span>
                                                     </div>
                                                  </div>';
										
										}
										
										echo '<td>' . $modulos . '</td>';
										
										  echo '</tr>';
										  
										  
 } 
 
 if ($contar==0){
echo '<tr><td colspan="7">';
 echo '<div class="alert bg--error">
                                                     <div class="alert__body">
                                                       <span>No hay pilotos | There are not pilots</span>
                                                     </div></div>';
 echo '</tr></td>';                                                

 } 
 ?>

 </tbody>
                                    </table>
									

		
		
									</div><br/>
									
									
		</div>
	</li>
</ul>



			   
			
			
			<?php
            }
			
			
			
	
	
?>
			
					
					
					
	
									
									
					
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			