

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo INTRANET_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_INTRANET_TITLE; ?></font></h3>

</section>

			

<section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="boxed boxed--lg boxed--border">
                                <div class="text-block text-center">
								<?php if (strlen($pilot_image) <= 10) {
								$pilot_image = "./images/uploads/pilot_default.png";
							    }
								?>
                                    <img alt="avatar" src="<?php echo $pilot_image; ?>" class="image--md" />
                                    <span class="h5"><?php echo $pilotname; ?> <?php echo $pilotsurname; ?></span>
                                    <span><?php echo $rank; ?></span>
                                    <span class="label"><?php echo $callsign; ?></span>
                                </div>
                                <div class="text-block clearfix text-center">
                                    <ul class="row row--list">
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block"><?php echo INTRANET_LOCATION; ?>:</span>
                                            <span><?php echo $location_airport_name; ?> [<?php echo $location; ?>]&nbsp;</span>
                                            <img alt="<?php echo $location_airport_flag; ?>" class="flag" src="./images/flags/24/<?php echo $location_airport_flag; ?>.png">
                                        </li>
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block"><?php echo INTRANET_MEMBER_SINCE; ?>:</span>
                                            <span><?php echo $register_date; ?></span>
                                        </li>
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block"><?php echo INTRANET_EMAIL; ?>:</span>
                                            <a href="#"><?php echo $email; ?></a>
                                        </li>
									</ul>
                                </div>
								<div class="text-block clearfix text-center">
                                    <ul class="row row--list">
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block">Hub:</span>
                                            <span><?php echo $hub_airport_name; ?> [<?php echo $hub_airports; ?>]&nbsp;</span>
                                            <img alt="<?php echo $hub_airport_flag; ?>" class="flag" src="./images/flags/24/<?php echo $hub_airport_flag; ?>.png">
                                        </li>
                                        <li class="col-sm-4">
                                            <span class="type--fine-print block"><?php echo INTRANET_MONEY; ?>:</span>
                                            <span>$<?php echo $money . ' ' . $currency; ?></span>
                                        </li>
                                        <li class="col-sm-4">
                                            <span class="type--fine-print"><?php echo INTRANET_STATUS; ?>:</span>
											
                                           <?php if($activation==0) {
											   
	  echo '<div class="alert bg--success">
                                <div class="alert__body">
								   <span><center>' . NEW_USER . '</center></span>
								</div>
                            </div>';
							
  } else if ($activation==1) {
	  
	  echo '<div class="alert bg--success">
                                <div class="alert__body">
								   <span><center>' . ACTIVE_USER . '</center></span>
								</div>
                            </div>';
  } else if ($activation==2) {
	  echo '<div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>' . INACTIVE_USER . '</center></span>
								</div>
                            </div>';
  } else if ($activation==3) {
	  echo '<div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>' . SUSPENDED_USER . '</center></span>
								</div>
                            </div>';
  } else if ($activation==4) {
	   echo '<div class="alert bg--success">
                                <div class="alert__body">
								   <span><center>' . VACATIONS_USER . '</center></span>
								</div>
                            </div>';
  }
  ?>
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

$horas = ($gva_hourse + $transfered_hours);

$progreso_previous = round((($horas*100)/$maximum_hours),2);

if($progreso_previous>100) {
	$progreso = 100;
} else {
	$progreso = $progreso_previous;
}

                                    ?>
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h6 type--uppercase type--fade"><?php echo INTRANET_PROGRESS; ?></span>
                                        <span class="h3">
										<?php echo  $progreso; ?>%
										</span>
                                    </li>
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h6 type--uppercase type--fade"><?php echo INTRANET_CITY; ?></span>
                                        <span class="h3"><?php echo $city; ?></span>
                                    </li>
                                </ul>
                            </div>
							<?php if(!empty($facebook_url) || !empty($whatsapp_url)) { ?>
							<div class="boxed boxed--border">
                                <ul class="row row--list clearfix text-center">
                                    <li class="col-sm-3 col-xs-6">
                                        <span class="h4 type--uppercase type--fade"><?php echo SOCIAL_NETWORKS; ?> <?php echo $name_operators; ?></span>
										<?php if(!empty($facebook_url)) { ?>
                                        <li>Facebook <a href="<?php echo $facebook_url; ?>"><?php echo ADDFACEBOOKTITLE; ?></a></li>
										<?php } ?>
										<?php if(!empty($whatsapp_url)) { ?>
										<li>WhatsApp <a href="<?php echo $whatsapp_url; ?>"><?php echo REQUESTADDFACEBOOKTITLE; ?></a></li>
										<?php } ?>
                                    </li>
                                </ul>
                            </div>
							<?php } ?>
							<div class="boxed boxed--border">
							 <h4><?php echo INTRANET_OPTIONS; ?></h4>
                                <ul class="row row--list clearfix text-center">
                                    <li class="col-sm-3 col-xs-6">
									<a href="./index_user.php?page=schedule">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_FLIGHT; ?></span>
                                        <i class="icon color--primary icon-Calendar"></i>
									</a>
                                    </li>
                                    <li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=ticket">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_TICKET; ?></span>
                                        <i class="icon color--primary icon-Ticket"></i>
									</a>
                                    </li>
									
                                    <li class="col-sm-3 col-xs-6">
                                       <a href="./index_user.php?page=balance_money">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_MONEY; ?></span>
                                        <i class="icon color--primary icon-Money"></i>
									</a>
                                    </li>
                                    <li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=charter">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_CHARTER; ?></span>
                                        <i class="icon color--primary icon-Plane-2"></i>
									</a>
									</li>
								</ul>
								<ul class="row row--list clearfix text-center">
                                   
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=my_profile">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_MY_PROFILE; ?></span>
                                        <i class="icon color--primary icon-User"></i>
									</a>
                                    </li>
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=my_stats">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_STATISTICS; ?></span>
                                        <i class="icon color--primary icon-File-Graph"></i>
									</a>
                                    </li>
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=academy">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_ACADEMY; ?></span>
                                        <i class="icon color--primary icon-File-Bookmark"></i>
									</a>
                                    </li>
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=downloads">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_DOWNLOAD; ?></span>
                                        <i class="icon color--primary icon-File-Download"></i>
									</a>
                                    </li>
									</ul>
								<ul class="row row--list clearfix text-center">
                                   
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=tour_cst">
                                        <span class="h6 type--uppercase type--fade">Tour CST</span>
                                        <i class="icon color--primary icon-Glasses"></i>
									</a>
                                    </li>
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=tour_ivao">
                                        <span class="h6 type--uppercase type--fade">Tour IVAO</span>
                                        <i class="icon color--primary icon-Global-Position"></i>
									</a>
                                    </li>
									<li class="col-sm-3 col-xs-6">
                                        <a href="./index_user.php?page=store">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_STORE; ?></span>
                                        <i class="icon color--primary icon-Clothing-Store"></i>
									</a>
                                    </li>
									<li class="col-sm-3 col-xs-6">
                                        <a href="./charts_navigraph.php">
                                        <span class="h6 type--uppercase type--fade"><?php echo OPTIONS_CHARTS; ?></span>
                                        <i class="icon color--primary icon-Map"></i>
									</a>
                                    </li>
									<li class="col-sm-12 col-xs-6">
                                        <a href="./index_user.php?page=manual_pirep">
                                        <span class="h6 type--uppercase type--fade">Pirep Manual</span>
                                        <i class="icon color--primary icon-Letter-Open"></i>
									</a>
                                    </li>
                                </ul>
					<hr>		
<ul class="accordion accordion-1">
	<li>
		<div class="accordion__title">
			<span class="h5"><?php echo PIREPS_TITLE; ?></span>
		</div>
		<div class="accordion__content">
	<div style="height:500px; width:100%; overflow-y: scroll; overflow-x: false;">		
			<table  class="border--round" >
																	
                                        <thead>
                                               <tr>
												<th><?php echo PIREP_FLIGHT; ?></th>
												<th><?php echo PIREP_PLANE; ?></th>
												<th><?php echo PIREP_DEPARTURE; ?></th>
												<th><?php echo PIREP_ARRIVAL; ?></th>
												<th><?php echo PIREP_DISTANCE; ?></th>
												<th><?php echo PIREP_TIME; ?></th>
												<th><?php echo PIREP_DATE; ?></th>
												<th><?php echo PIREP_STATUS; ?></th>
												<th><?php echo PIREP_SCHEDULE; ?></th>
												<th><?php echo PIREP_TYPE; ?></th>
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
		} else if($row21s["charter"]==3) {
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
		echo '<td><a href="./index_user.php?page=tracker&idflight=' . $row21s["id"] . '">' . $row21s["callsign"] . '</a></td>';
		echo '<td>' . $row21s["aircraft"] . '</td>';
		echo '<td>' . $row21s["departure"] . '</td>';
		echo '<td>' . $row21s["arrival"] . '</td>';
		echo '<td>' . $row21s["distance"] . '</td>';
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
		echo '<td>' . $tipo_vuelo . '</td>';	
		echo '<td>' . $tipo_vuelo_info . '</td>';	
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
                                    </table>
									</div><br/>
									
									
		</div>
	</li>
</ul>




<ul class="accordion accordion-1">
	<li>
		<div class="accordion__title">
			<span class="h5"><?php echo PILOT_CERTIFICATIONS; ?></span>
		</div>
		<div class="accordion__content">
		  <div class="container">
		  	<div style="height:500px; width:100%; overflow-y: scroll; overflow-x: false;">		
					<?php foreach ($planes_certificated as $x => $x_value) { 
						if(!empty($x_value)) {       ?>
						
							<i class="icon color--primary icon-Plane"></i>  <?php echo $x_value; ?><br><br>
						                      <?php } }?>      
</div>											  
				             	
		  </div>
		</div>
	</li>
</ul>




<br>
<h1><?php echo PILOT_FLIGTH_MAP; ?></h1>
<hr>



<?php if ($contarvuelos==0) {
echo '<tr><td colspan="7"><div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_FLIGHTS . '</span>
                                </div>
                            </div></td></tr>';
		} else {
			include './pilot_flights_map.php';
			} ?> 


                                
                            </div>
                            <div class="boxed boxed--border">
                                <h4><?php echo AWARDS_TITLE; ?></h4>
                                <ul class="clearfix row row--list text-center">
								
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

$horastotales = ($gva_hourse + $transfered_hours);
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($horastotales<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($vuelostotales<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($tourvuelos<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($chartervuelos<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($regularvuelos<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($dinerototal<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($distancia<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($pasajeros<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR	
			if($premios['condicion']==1) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas<$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MAYOR O IGUAL	
			if($premios['condicion']==2) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas>=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}
		// EXAMINAR TIPO DE CONDICION ---	MENOR O IGUAL	
			if($premios['condicion']==3) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas<=$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	IGUAL	
			if($premios['condicion']==4) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas==$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
                }	
			}	
		// EXAMINAR TIPO DE CONDICION ---	DIFERENTE	
			if($premios['condicion']==5) {
				// EXAMINAR SI LA CONDICION ES VALIDA
				if($cargas<>$premios['comparar']) {
					$contarpremios++;
					echo '<img src="../../admin/images/premios/' . $premios['award_image'] . '" title="' . $premios['descripcion'] . '" alt="" style="padding-left: 2%;padding-right: 2%;padding-bottom: 2%;padding-top: 2%;background-color: rgba(142, 139, 140, 0.07);width: 24%; height: 180px; margin-bottom: 5px;" />&nbsp;&nbsp;';
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
                                </ul>
                            </div>
                            <div class="boxed boxed--border">
                                <h4><?php echo DEGREE; ?></h4>
                                <ul>
								<?php 
// OBTENER RANGO QUE CORRESPONDE PARA AERONAVES
	
	$horastotalesvuelo=$transfered_hours+$gva_hourse;
	$sqlrank2= "select * from ranks where operator_id='$operator_id_session' order by minimum_hours asc ";

	if (!$resultrank2 = $db->query($sqlrank2)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank2 = $resultrank2->fetch_assoc()) {
		
		$minimum_hours = $rowrank2["minimum_hours"];
		
		if ($horastotalesvuelo >= $minimum_hours) {
			$rank_idnew2 = $rowrank2["rank_id"];
            $rangotitulo = $rowrank2["rank"];
			?>
			
			
			<li class="clearfix">
                                        <div class="row">
                                            <div class="col-md-2 col-xs-3 text-center">
                                                    <i class="icon color--primary icon-Key-2"></i>
                                            </div>
                                            <div class="col-md-8 col-xs-7">
                                                <span class="type--fine-print"><?php echo DEGREE_TITLE . ': ' . $rangotitulo; ?></span>
                                                <a href="./diploma.php?rank_id=<?php echo $rank_idnew2; ?>" class="block color--primary"><?php echo CONGRATULATIONS_DEGREE; ?></a>
                                                <p>
                                                    <?php echo SHARING_THE_SAME_PASSION; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                    </li>
			
			<?php
			
	
	}
		
		
	}
	
	$db->close();

                          ?>
                                    
                                </ul>
                               
							   
                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
