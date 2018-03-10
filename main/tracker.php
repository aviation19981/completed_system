<?php
include('./db_login.php');
$idflight = $_GET['idflight'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sqlflight = "select * from cstpireps where id='$idflight'";
	if (!$resultflight = $db->query($sqlflight)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($flight = $resultflight->fetch_assoc()) {
	$callsignvuelo = $flight['callsign'];
	$route_id = $flight['route_id'];
	$vid = $flight['vid'];
	$estado = $flight['estado'];
	$aircraft = $flight['aircraft'];
	$aeronavenombre = $flight['aircraft'];
	$registry = $flight['registry'];
	$charter = $flight['charter'];
	$cruising_speed = $flight['cruising_speed'];
	$departure = $flight['departure'];
	$arrival = $flight['arrival'];
	$alternative = $flight['alternative'];
	$altern_landing = $flight['altern_landing'];
	$sq = $flight['sq'];
	$route = $flight['route'];
	$rmk = $flight['rmk'];
	$departure_time = $flight['departure_time'];
	$eet = $flight['eet'];
	$connection_time = $flight['connection_time'];
	$distance = $flight['distance'];
	$time_arrival = $flight['time_arrival'];
	$category_acft = $flight['category_acft'];
	$requestlevel = $flight['requestlevel'];
	$fecha_envio = $flight['fecha_envio'];
	$pax = $flight['pax'];
	$cargo = $flight['cargo'];
	$code_info_money = $flight['code_info_money'];
	$piloto = $flight['gvauser_id'];
	$operator_id_route_flight = $flight['operator_id'];
    $aeronaveimg = "./images/charter/unknown.png";	
	
	if ($charter==1) {
		$operator = "ColStar Chárter";
	} else if ($charter==2) {
		$operator = "ColStar Tour";
	} else if ($charter==3) {
		$operator = "IVAO Tour";
	}
	}
	
	$sqlivao = "select * from gvausers  where gvauser_id='$piloto'";
				

if (!$resultivao = $db->query($sqlivao)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($rowivao = $resultivao->fetch_assoc()) {
		$piloto_nombre = $rowivao['name'] . ' ' . $rowivao['surname'];			
		$piloto_callsign = $rowivao['callsign'];		
}

$sql_aircraft = "select * from fleets f inner join fleettypes ft on f.fleettype_id=ft.fleettype_id  where registry='$registry'";
				

if (!$result_aircraft = $db->query($sql_aircraft)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_aircraft = $result_aircraft->fetch_assoc()) {
		$aeronaveimg = './../admin/images/planes/' . $row_aircraft["image_url"];			
		$aeronavenombre = $row_aircraft["plane_description"];			
}
	
	

    $sqlrt = "select * from routes where route_id='$route_id'";
	
	if (!$resultrt = $db->query($sqlrt)) {

		die('There was an error running the query [' . $db->error . ']');

	}
	
	while ($rowrt = $resultrt->fetch_assoc()) {
		
		$operator_id = $rowrt["operator_id"];
		
		          $sql_operator = "SELECT * FROM operators where operator_id='$operator_id'";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
		                      $operator = $row_operator["operator"];
							}          
		
	}
	
	

	// Get Location info details

	$sql4 = "SELECT * FROM airports  where ident='$departure'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row4 = $result4->fetch_assoc()) {

        $departure_airport = $row4['name'];
		$dep_iso_country = $row4['iso_country'];
		$latitude1 = $row4['latitude_deg'];

		$longitude1 = $row4['longitude_deg'];
		

	}
		
	
	
	///////////////////////////// Info Airline Flight
	
	$sql_va_new = "select * from operators where operator_id=" . $operator_id_route_flight;

	if (!$result_va_new = $db->query($sql_va_new)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios_va_new = $result_va_new->fetch_assoc()) {
		$va_flight = $rowusuarios_va_new["operator"];
	}
	
	

		?>
		
	
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('./images/fondos/<?php echo rand(1,10); ?>.jpg')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_PIREP; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_TITLE_PIREP; ?> (<?php echo $callsignvuelo; ?>)</font></h3>
	

</section>	
		
			
															 
<section class="imagebg" data-overlay="7">
                
				<div class="background-image-holder background--top">
                    <img alt="background" src="./images/sky.jpg" />
                </div>
				<div class="container">
				<div class="row">
                        <div class="col-sm-8">
                            <img alt="Image" class="unmarg--bottom" src="<?php echo $aeronaveimg; ?>" width="75%"/>
                            
                        </div>
                    </div>
                <div class="row">
      <div class="col-sm-12">
        <h1><b><?php echo $aeronavenombre; ?></b> </h1>
        <h2>
          Detalles de la aeronave <b>  </b>                                           </h2>
        </div>
      </div>  
	  
	  	<?php 		
									
								$contar_avion=0;
					$sql_aircraft = "select * from fleets f inner join fleettypes ft on f.fleettype_id=ft.fleettype_id  where registry='$registry'";
				

if (!$result_aircraft = $db->query($sql_aircraft)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_aircraft = $result_aircraft->fetch_assoc()) {
	$contar_avion++;
		$aeronaveimg = str_replace("images","img",$row_aircraft["image_url"]);			
		$aeronavenombre = $row_aircraft["plane_description"];		 ?>
		
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="feature feature-5 boxed boxed--md boxed--border"> <i class="icon icon-Plane icon--md"></i>
                                <div class="feature__body">
                                    <h2><b><?php echo REGISTRY_PLANE; ?></b><br> <em><?php echo $registry; ?></em></h2>
                                    </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="feature feature--featured feature-5 boxed boxed--lg boxed--border"> <i class="icon icon-Information  icon--md"></i>
                                <div class="feature__body">
                                    <h2><b><?php echo DETAIL_PLANE_PIREP; ?></b></h2>
								    <table cellspacing="0">
									<tr>
									<td><div class="small"><strong><?php echo PLANE_PIREP; ?></strong></div>
									<em><?php echo $row_aircraft["plane_description"]; ?></em></td>
									<td><div class="small"><strong>Selcal</strong></div>
									<em><?php echo $row_aircraft["selcal"]; ?></em></td>
									</tr>
									<tr>
									<td><div class="small"><strong><?php echo AIRLINE_SCHEDULE; ?></strong></div>
									<em><?php  $sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row_aircraft["operator_id"]) {
							
							
							$operator = $row_operator["operator"];
							
							}
							

							

}


echo $operator; ?></em></td>
									
									<td><div class="small"><strong><?php echo STATUS_DETAIL_PLANE_PIREP; ?></strong></div>
									<em><?php echo $row_aircraft["status"]; ?>%</em></td>
									</tr>
									</table>
										
                                       
									
						
<?php } 

if ($contar_avion==0) {
	
	if(!empty($aircraft)) {
		echo '<h2><b>' . PLANE_PIREP . '</b> <em>' . $aircraft . '</em></h2>';
		echo '<hr>';
	}
	
						
	
	
	echo '<h2>' . NO_INFO_PLANE . '</h2>';
	
}


?>
									
							 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			  
			  
			  
			  
			  
			  															 
<section class="imagebg" data-overlay="7">
                
				<div class="background-image-holder background--top">
                    <img alt="background" src="./images/fondos/<?php echo rand(1,10); ?>.jpg" />
                </div>
				<div class="container">
				<div class="row">
                    </div>
                <div class="row">
      <div class="col-sm-12">
        <h1><b><?php echo GET_FROM_IVAO; ?></b> </h1>
		<hr>
        </div>
      </div>  
	  
	
		
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="feature feature--featured feature-5 boxed boxed--lg boxed--border"> <i class="icon icon-Information  icon--md"></i>
                                <div class="feature__body">
                                    <h2><b>Vuelo <?php echo $callsignvuelo; ?></b></h2>
								
                                       
									<?php if($altern_landing==0) { $finalstatus= LANDED_CORRECT_APT . "<b> " . $arrival . "</b>"; } else if($altern_landing==1) { $finalstatus= LANDED_ALTN_APT . "<b> " . $alternative . "</b>"; } ?>
 
										<b><?php echo DEPARTURE; ?>:</b> <?php echo $departure; ?><br>
										<b><?php echo ARRIVAL; ?>:</b> <?php echo $arrival; ?><br>
										<b><?php echo ROUTE_FP; ?>:</b> <?php echo $route; ?><br>
										<b><?php echo RMK_FP; ?>:</b> <?php echo $rmk; ?><br>
										<b><?php echo SPEED_FP; ?>:</b> <?php echo $cruising_speed; ?><br>
										<b><?php echo ALTITUDE_FP; ?>:</b> <?php echo $requestlevel; ?><br>
										<b><?php echo DISTANCE_STATS; ?>: </b> <?php echo $distance; ?> NM<br>
										<b><?php echo SQ_FP; ?>:</b> <?php echo $sq; ?><br>
										<b><?php echo TYPE_FP; ?>:</b> <?php if($charter==0) { echo "Regular"; } else if($charter==1) { echo "Chárter"; } else if($charter==2) { echo "ColStar Tour"; } else if($charter==2) { echo "IVAO Tour"; }  ?><br>
										<b><?php echo STATUS_FP; ?>:</b> <?php if($estado==1) { echo ACCEPTED; } else { echo REJECTED;} ?><br>
										<b><?php echo TIME_CST; ?>:</b> <?php $sumas= $connection_time;
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
echo $totales= $horas.' h '.$minutos . ' m'; ?><br>
										<b><?php echo PAX_STATISTICS; ?>:</b> <?php echo $pax; ?><br>
										<b><?php echo DATE_CST; ?>:</b> <?php echo $fecha_envio; ?><br>
										<b><?php echo FINAL_STATUS_FP; ?>: </b> <?php echo $finalstatus; ?><br>

									
							 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			  
			  
		<section class="contact">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="feature feature--featured feature-5 boxed boxed--lg boxed--border"> <i class="icon icon-Boy icon--lg"></i>
          <div class="feature__body">
            <h4><?php echo $piloto_callsign; ?></h4>
            <p><b>VID: </b><?php echo $vid; ?><br><b><?php echo NAME; ?>:</b> <?php echo $piloto_nombre; ?></p>
            </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="feature feature--featured feature-5 boxed boxed--lg boxed--border"> <i class="icon icon-Plane icon--lg"></i>
          <div class="feature__body">
            <h4><?php echo INDEX_USER_DETAILS; ?></h4>
            <p><b><?php echo AIRLINE_SCHEDULE;  ?>: </b><?php echo $va_flight; ?>   </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
			
			  <section class="unpad ">
			    <iframe src="<?php echo './maptracker.php?departure=' . $departure . '&arrival=' . $arrival . '&timedep=' . $departure_time . '&timearr=' . $time_arrival . '&route_string=' . $route . '&category_acft=' . $category_acft; ?>" width="100%" height="300px"></iframe>
              </section>
			  
			 
			
			
			 <section class="pricing-section-2 text-center">
                <div class="container">
				
				    <h1>Informes Financieros</h1>
					<hr>
					<?php if(!empty($code_info_money)) { ?>
                    <div class="row">
					<?php 		
							// Get VA  parameters

	$sql = "select * from va_parameters";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$currency = $rowusuarios["currency"];

	}

					
$sql_finance_sum_piloto = "select * from bank where pirep='$code_info_money'";
				

if (!$result_finance_sum_piloto = $db->query($sql_finance_sum_piloto)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_finance_sum_piloto = $result_finance_sum_piloto->fetch_assoc()) {
$ingresoneto_piloto= $row_finance_sum_piloto['quantity'];
	
}



	?>
                        <div class="col-sm-6 col-md-3">
                            <div class="pricing pricing-3">
                                <div class="pricing__head bg--secondary boxed">
                                    <h5>Salario Piloto</h5>
                                    <span class="h3">
                                        <span class="pricing__dollar">$</span><?php echo number_format($ingresoneto_piloto,2,',', '.'); ?> <?php echo $currency; ?></span>
                                    <p class="type--fine-print">Información Obtenida del Vuelo</p>
                                </div>
                                <ul>
                                    <li>
									<span class="checkmark bg--primary-1"></span>
                                        <span><b>Ingresos Netos:</b> <?php echo number_format($ingresoneto_piloto,2,',', '.'); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <!--end pricing-->
                        </div>
						<?php 		
									
$ingresoneto_bruto =	0;							
$sql_finance_sum = "select * from va_finances where report_id='$code_info_money' and amount>=0";
				

if (!$result_finance_sum = $db->query($sql_finance_sum)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_finance_sum = $result_finance_sum->fetch_assoc()) {
$ingresoneto_bruto= $ingresoneto_bruto + $row_finance_sum['amount'];
	
}



	?>
                        <div class="col-sm-6 col-md-3">
                            <div class="pricing pricing-3">
                                <div class="pricing__head bg--secondary boxed">
                                    <h5>Ingresos Brutos</h5>
                                    <span class="h3">
                                        <span class="pricing__dollar">$</span><?php echo number_format($ingresoneto_bruto,2,',', '.'); ?> <?php echo $currency; ?></span>
                                    <p class="type--fine-print">Información Obtenida de Vuelo</p>
                                </div>
                                <ul>
                                    <?php $sql_finance = "select * from va_finances where report_id='$code_info_money' and amount>=0";
				

if (!$result_finance = $db->query($sql_finance)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_finance = $result_finance->fetch_assoc()) { ?>
                                    <li>
									    <span class="checkmark bg--success"></span>
                                        <span><?php echo '<b>' . $row_finance['description'] . ':</b> ' . number_format($row_finance['amount'],2,',', '.'); ?></span>
                                    </li>
<?php } ?>
                                </ul>
                            </div>
                            <!--end pricing-->
                        </div>
	<?php 		
									
$gasto_bruto =	0;							
$sql_finance_sum = "select * from va_finances where report_id='$code_info_money' and amount<0";
				

if (!$result_finance_sum = $db->query($sql_finance_sum)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_finance_sum = $result_finance_sum->fetch_assoc()) {
$gasto_bruto= $gasto_bruto + $row_finance_sum['amount'];
	
}



	?>
						<div class="col-sm-6 col-md-3">
                            <div class="pricing pricing-3">
                                <div class="pricing__head bg--secondary boxed">
                                    <h5>Gastos Operativos</h5>
                                    <span class="h3">
                                        <span class="pricing__dollar">$</span><?php echo number_format($gasto_bruto,2,',', '.'); ?> <?php echo $currency; ?></span>
                                    <p class="type--fine-print">Información Obtenida de Vuelo</p>
                                </div>
                                <ul>
                                    <?php $sql_finance = "select * from va_finances where report_id='$code_info_money' and amount<0";
				

if (!$result_finance = $db->query($sql_finance)) {
			die('There was an error running the query [' . $db->error . ']');
}
					
while ($row_finance = $result_finance->fetch_assoc()) { ?>
                                    <li>
									    <span class="checkmark bg--error"></span>
                                        <span><?php echo '<b>' . $row_finance['description'] . ':</b> ' . number_format($row_finance['amount'],2,',', '.'); ?></span>
                                    </li>
<?php } ?>
                                </ul>
                            </div>
                            <!--end pricing-->
                        </div>
							<?php 		
									
$ingresoneto =	$ingresoneto_bruto + $gasto_bruto; 



	?>
                        <div class="col-sm-6 col-md-3">
                            <div class="pricing pricing-3">
                                <div class="pricing__head bg--primary boxed">
                                    <h5>Ingresos Netos</h5>
                                    <span class="h3">
                                        <span class="pricing__dollar">$</span><?php echo number_format($ingresoneto,2,',', '.'); ?> <?php echo $currency; ?></span>
                                    <p class="type--fine-print">Información Obtenida del Vuelo</p>
                                </div>
                                <ul>
                                    <li>
									    <span class="checkmark  bg--success"></span>
                                        <span><b>Ingresos Brutos:</b> <?php echo number_format($ingresoneto_bruto,2,',', '.'); ?></span>
                                    </li>
									<li>
									    <span class="checkmark bg--error"></span>
                                        <span><b>Gastos Operativos:</b> <?php echo number_format($gasto_bruto,2,',', '.'); ?></span>
                                    </li>
                                </ul>
                            </div>
                            <!--end pricing-->
                        </div>
                        
                    </div>
                    <!--end of row-->
					<?php } else {
						
						echo ' <div class="alert bg--error">
                                <div class="alert__body">
                                    <span>No se encontró informes financieros en el sistema!</span>
                                </div>
                            </div>';
						
					} ?>
                </div>
                <!--end of container-->
				<br>
				<br>
            </section>
			
			
			
