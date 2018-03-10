<?php 
		$pilotID = $_GET['pilot_id']; 
		include('./get_pilotID_data.php'); 
		?>
<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo INFO_PILOT_PUBLIC; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_INFO_PILOT_PUBLIC; ?></font></h3>
    <br>
	<br>
</section>


					
<div class="clear"></div>
	

 <section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="boxed boxed--lg boxed--border">
                                <div class="text-block text-center">
                                    <img alt="avatar" src="<?php echo $ruta_foto; ?>" class="image--sm" />
                                    <span class="h5"><?php echo $pilotname; ?> <?php echo $pilotsurname; ?></span>
                                    <span><?php echo $rank; ?></span>
                                    <span class="label"><?php echo $callsign; ?></span>
                                </div>
                                <hr>
                                <div class="text-block">
                                    <ul class="menu-vertical">
									    <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-password;hidden"><?php echo PILOT_PUBLIC_DETAIL; ?></a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-profile;hidden"><?php echo PILOT_PUBLI_FLIGHT; ?></a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-notifications;hidden"><?php echo HABILITATION_PLANES; ?></a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-billing;hidden"><?php echo AWARDS_PUBLIC_PILOT; ?></a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="boxed boxed--lg boxed--border">
							
							      <div id="account-password" class="account-tab">
                                    <h4><?php echo INFO_PILOT_PUBLIC; ?></h4>
									<hr>
                                    <div class="boxed boxed--lg boxed--border">
                               
                                <div class="text-block clearfix text-center">
                                    <ul class="row row--list">
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block"><?php echo INTRANET_LOCATION; ?>:</span>
                                            <span><?php echo $location_airport_name; ?> [<?php echo $location; ?>]&nbsp;</span>
                                            <img alt="<?php echo $location_airport_flag; ?>" class="flag" src="./images/flags/24/<?php echo $location_airport_flag; ?>.png">
                                        </li>
                                        <li class="col-sm-8">
                                            <span class="type--fine-print block"><?php echo INTRANET_MEMBER_SINCE; ?>:</span>
                                            <span><?php echo $register_date; ?></span>
                                        </li>
									</ul>
                                </div>
								<div class="text-block clearfix text-center">
                                    <ul class="row row--list">
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block">Hub:</span>
                                            <span><?php echo $hub_airport_name; ?> [<?php echo $hub_airports; ?>]&nbsp;</span>
                                            <img alt="<?php echo $hub_airport_name; ?>" class="flag" src="./images/flags/24/<?php echo $hub_airport_flag; ?>.png">
                                        </li>
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block"><?php echo INTRANET_MONEY; ?>:</span>
                                            <span>$<?php echo $money . ' ' . $currency; ?></span>
                                        </li>
                                        <li class="col-sm-4">
                                            <span class="type--fine-print"><?php echo INTRANET_STATUS; ?>:</span>
											<b>
                                           <?php if($activation==0) {
	  echo NEW_USER;
  } else if ($activation==1) {
	  echo  ACTIVE_USER;
  } else if ($activation==2) {
	  echo  INACTIVE_USER;
  } else if ($activation==3) {
	  echo SUSPENDED_USER;
  } else if ($activation==4) {
	  echo  VACATIONS_USER;
  }
  ?></b>
                                        </li>
									</ul>
                                </div>
                                
                            </div>
							<div class="boxed boxed--border">
                                <ul class="row row--list clearfix text-center">
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h6 type--uppercase type--fade"><?php echo INTRANET_FLIGHTS; ?></span>
                                        <span class="h3"><?php echo $num_pireps; ?></span>
                                    </li>
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h6 type--uppercase type--fade"><?php echo INTRANET_HOURS; ?></span>
                                        <span class="h3"><?php echo $gva_hours;; ?></span>
                                    </li>
									<?php 

$horas = ($horasvuelo+$transfered_hours);

$progreso_previous = round(($horas*100)/$maximum_hours);

if($progreso_previous>100) {
	$progreso = 100;
} else {
	$progreso = $progreso_previous;
}                          ?>
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h6 type--uppercase type--fade"><?php echo INTRANET_PROGRESS; ?></span>
                                        <span class="h4">
										<?php echo  $progreso; ?>%
										</span>
                                    </li>
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h6 type--uppercase type--fade"><?php echo INTRANET_CITY; ?></span>
                                        <span class="h3"><?php echo $city; ?></span>
                                    </li>
                                </ul>
                            </div>
                                </div>
								
								
                                <div id="account-profile" class="hidden account-tab">
                                    <h4>PIREPS</h4>
																		
<div style="height:500px; width:100%; overflow-y: scroll; overflow-x: false;">
                                    <table  class="border--round">
																	
                                        <thead>
                                               <tr>
												<th><?php echo PIREP_FLIGHT; ?></th>
												<th><?php echo PIREP_PLANE; ?></th>
												<th><?php echo PIREP_DEPARTURE; ?></th>
												<th><?php echo PIREP_ARRIVAL; ?></th>
												<th><?php echo PIREP_TIME; ?></th>
												<th><?php echo PIREP_DATE; ?></th>
												<th><?php echo PIREP_STATUS; ?></th>
                                            </tr>
											
                                        </thead>
									

								
                                        <tbody>
											
										<?php 
										$distancia=0;
										$contarvuelos=0;
										$pasajeros = 0;
										$cargas = 0;
											//$sql21s = "select * from cstpireps where vid='$ivaovid'";
											
											
											
		$sql21s = "select * from cstpireps where gvauser_id='$id' order by fecha_envio desc";
		  

		if (!$result21s = $db->query($sql21s)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($row21s = $result21s->fetch_assoc()) {
        $contarvuelos++;
		
		if($row21s["estado"]==1) {
			$estados = ACCEPTED;
		} else {
			$estados = REJECTED;
		}
		
		if($row21s["charter"]==0) {
		$tipo_vuelo ="Regular";
		} else if($row21s["charter"]==1) {
		$tipo_vuelo ="Charter";
		} else if($row21s["charter"]==2) {
		$tipo_vuelo ="Tour ColStar";
		} else if($row21s["charter"]==2) {
		$tipo_vuelo ="Tour IVAO";
		}
		
		$dep = $row21s["departure"];
		
		$departure_info = "select iso_country from airports where ident='$dep'";
		  

		if (!$result_dep_info = $db->query($departure_info)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($row_dep_info = $result_dep_info->fetch_assoc()) {
			$dep_iso_country = $row_dep_info['iso_country'];
		}
		
		
		
		$arr = $row21s["arrival"];
		
		$arrival_info = "select iso_country from airports where ident='$arr'";
		  

		if (!$result_arr_info = $db->query($arrival_info)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($row_arr_info = $result_arr_info->fetch_assoc()) {
			$arr_iso_country = $row_arr_info['iso_country'];
		}
		
		
		if($dep_iso_country==$arr_iso_country) {
			$tipo_vuelo_info = NATIONAL;
		} else {
			$tipo_vuelo_info = INTERNATIONAL;
		}
		
		echo '<tr>';
		echo '<td><a href="./?page=tracker&idflight=' . $row21s["id"] . '">' . $row21s["callsign"] . '</a></td>';
		echo '<td>' . $row21s["aircraft"] . '</td>';
		echo '<td>' . $row21s["departure"] . '</td>';
		echo '<td>' . $row21s["arrival"] . '</td>';
		$distancia = $distancia+$row21s["distance"];
	$pasajeros = $pasajeros+$row21s["pax"];
	$cargas = $cargas+$row21s["cargo"];
$sumas= $row21s["connection_time"];
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$totales= $horas.' h '.$minutos . ' m';


		echo '<td>' . $totales . '</td>';
		echo '<td>' . $row21s["fecha_envio"] . '</td>';
		echo '<td>' . $estados . '</td>';	
        echo '</tr>';
		}
		
		
		?>
											
									<?php if ($contarvuelos==0) {
										
										echo '<tr><td colspan="7"><div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_FLIGHTS . '</span>
                                </div>
                            </div></td></tr>';
									}
									?>	
										
										                                        
										  
                                        </tbody>
                                    </table><br/>
									</div>
									
									<!-- Divider -->
                                </div>
                                <div id="account-notifications" class="hidden account-tab">
                                    <h4><?php echo DETAIL_PLANES_APROVED; ?></h4>
                                    <table id="table_list"  class="border--round">
<thead>
                                            

                                            
                                        </thead>
					<?php foreach ($planes_certificated as $x => $x_value) { ?>
						
							<tr><td><i class="icon color--primary icon-Plane"></i></td><td><?php echo $x_value; ?></td></tr>
						                       <?php } ?>                
				</table>
				</div>
				
				
				
				
				
				
				
				<div id="account-billing" class="hidden account-tab">
                                    <h4><?php echo AWARDS_PUBLIC_PILOT; ?></h4>
                                    <div class="boxed boxed--border bg--secondary">
                                        <h5><?php echo CONGRATULATIONS_AWARDS_PUBLIC_PILOT; ?></h5>
                                        <hr>
                                        <?php
$contarpremios=0;
////////////// VARIABLE /////////////////////////
// 0 HORAS
// 1 VUELOS
// 2 TOURS
// 3 CHARTER
// 4 REGULAR
// 5 DINERO
// 6 DISTANCIA
// 7 PASAJEROS
// 8 CARGA

$horastotales = ($horasvuelo+$transfered_hours);
$vuelostotales = $num_pireps;
$tourvuelos = $tourspireps;
$chartervuelos = $charterspireps;
$regularvuelos = $num_pireps-$charterspireps-$tourspireps;
$dinerototal = $money;


////////////// CONDICIONES /////////////////////////
// 0 MAYOR
// 1 MENOR
// 2 MAYOR O IGUAL
// 3 MENOR O IGUAL
// 4 IGUAL
// 5 DIFERENTE

$db->set_charset("utf8");
	$premios = "select * from awards";

		if (!$resultpremios = $db->query($premios)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($premios = $resultpremios->fetch_assoc()) {

// EXAMINAR TIPO DE VARIABLE ---------------- HORAS ----------------
		if($premios['variable']==0) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}
		
		
		
		
		
		



// EXAMINAR TIPO DE VARIABLE ---------------- VUELOS ----------------
		if($premios['variable']==1) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}

		
		
		
		
		
		
		
		
		
		
		
		
				

// EXAMINAR TIPO DE VARIABLE ---------------- TOURS ----------------
		if($premios['variable']==2) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

// EXAMINAR TIPO DE VARIABLE ---------------- CHARTER ----------------
		if($premios['variable']==3) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

// EXAMINAR TIPO DE VARIABLE ---------------- REGULAR ----------------
		if($premios['variable']==4) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

// EXAMINAR TIPO DE VARIABLE ---------------- DINERO ----------------
		if($premios['variable']==5) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}		
		
		
		
		
		
		
		
		
		
		
		
		
		
				
		
		
		

// EXAMINAR TIPO DE VARIABLE ---------------- DISTANCIA ----------------
		if($premios['variable']==6) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}	
		
		
		
		
		
		
		
		
		
		
		
				

// EXAMINAR TIPO DE VARIABLE ---------------- PASAJEROS ----------------
		if($premios['variable']==7) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}	
		
		
		
		
		
		
		
		
		
		// EXAMINAR TIPO DE VARIABLE ---------------- CARGA ----------------
		if($premios['variable']==8) {
		// EXAMINAR TIPO DE CONDICION ---	MAYOR
			if($premios['condicion']==0) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 140px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}		
			
		}	
		
		
		
                 
        }
		
		
		
		
		$premios2 = "select * from tour_finished tr inner join tours tor on tr.tour_id=tor.tour_id where tr.gvauser_id='$id'";

		if (!$resultpremios2 = $db->query($premios2)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($premios2 = $resultpremios2->fetch_assoc()) {
                  $contarpremios++;

					echo '<img src="../../admin/images/tour/premio/' . $premios2['tour_award_image'] . '" title="' . $premios2['tour_name'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
   
		
		}

		
		?>
	


<?php if ($contarpremios==0) {
										
										echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_AWARDS . '</span>
                                </div>
                            </div>';
									}
									?>
                                    </div>
                                </div>
                          
                            </div>
                                </div>     
                <!--end of container-->
            </section>