
<?php
	$registry_id = $_GET['registry_id'];

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}




	$sql = "select * from 
	fleets f inner join cstpireps ft on '$registry_id'=ft.registry 
	inner join gvausers gu on gu.ivaovid = ft.vid
	left outer join routes r on ft.route_id=r.route_id 
	where   f.registry='$registry_id' order by ft.fecha_envio desc";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
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
    
	<h1><font color="white"><?php echo NAME_PLANE_INFO; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white">  <?php echo DETAIL_PLANE_INFO; ?> <b><?php echo$registry_id; ?></b></font></h3>

</section>
		
			
	


		<section class="contact">
			<div class="container">


			

																	
                                        
				<?php
					$sql_aircraft = "select maximum_range,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow ,mlw,mzfw,aircraft_length,pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2, a.name airport ,a2.name hub_airport , f.name aircraft_name, location, hub_base from fleets f inner join airports a on a.ident=f.location inner join country_t c on c.iso2 = a.iso_country inner join airports a2 on a2.ident=f.hub_base inner join country_t c2 on c2.iso2 = a2.iso_country INNER JOIN fleettypes ft on f.fleettype_id=ft.fleettype_id where registry='$registry_id'";

					$sql_aircraft = "select hub,maximum_range,f.image_url,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow ,mlw,mzfw,aircraft_length,
pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2, a.name airport ,a2.name hub_airport ,
f.name aircraft_name, f.selcal , location, operator_id, hub_base
from fleets f
inner join hubs hu on hu.hub_id= f.hub_id
inner join airports a on a.ident=f.location
inner join airports a2 on a2.ident=f.hub_base
inner join fleettypes ft on f.fleettype_id=ft.fleettype_id where registry='$registry_id'";

					$sql_aircraft = "select hub,maximum_range,f.image_url, f.selcal,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow 
,mlw,mzfw,aircraft_length, pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2
, a.name airport ,a2.name hub_airport , f.name aircraft_name, location, operator_id, hub_base 
from fleets f 
inner join hubs hu on hu.hub_id= f.hub_id 
inner join airports a on a.ident=f.location 
inner join airports a2 on a2.ident=hub
inner join fleettypes ft on f.fleettype_id=ft.fleettype_id 
where registry='$registry_id'";
				

					if (!$result_aircraft = $db->query($sql_aircraft)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					
				while ($row_aircraft = $result_aircraft->fetch_assoc()) {
					
					echo '<font color="black">	<!--Sidebar Widget-->
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="sidebar">


                   
                    
                        <div class="serviceBox_5">
                            <div class="service-image">
                                <img src="./../admin/images/planes/' . $row_aircraft["image_url"] . '"  width="100%" />
								<br>
								<br>
								<hr>
                            </div>';
						
						echo '<div class="service-content">
                                <div class="internal">
                                    <div class="item_content">';
										
                        echo '<table id="table_list"  class="table">';
                        //echo '<tr>';						
						//echo '<td>';
						//echo '<img src="./'.$row_aircraft["image_url"].'" width="100%" >';
						//echo '</td></tr>';
						echo '<td>';
						echo '<div class="small"><strong>'.NAME_PLANE.'</strong></div>';
						echo $row_aircraft["aircraft_name"] . '</td></tr><td>';
						echo '<div class="small"><strong>'.SELCAL.'</strong></div>';
						echo $row_aircraft["selcal"] . '</td></tr><td>';
                                                echo '<div class="small"><strong>'.OPERATOR.'</strong></div>';



                                                       $sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row_aircraft["operator_id"]) {
							
							
							$img = $row_operator["file"];
							
							}
							

							

}
if ($row_aircraft["operator_id"] > 0) {
echo '<img src="../../admin/images/operators/' . $img . '" alt=""  WIDTH=70%></td></tr><td>';
		} else if ($row_aircraft["operator_id"] == 0){
echo '</td></tr><td>';

}




						echo '<div class="small"><strong>'.LOCATION_PLANE.'</strong></div>';
						echo $row_aircraft["location"].'<BR>';
						echo '<img src="./images/flags/24/' . $row_aircraft["location_iso2"] . '.png" alt="' . $row_aircraft["location_iso2"] . '">';
						echo '<font size="2">&nbsp;'.$row_aircraft["airport"].'</font>';
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.HUB.'</strong></div>';
						echo $row_aircraft["hub"].'<BR>';
						echo '<img src="./images/flags/24/' . $row_aircraft["hub_iso2"] . '.png" alt="' . $row_aircraft["hub_airport"] . '">';
						echo '<font size="2">&nbsp;'.$row_aircraft["hub_airport"].'</font>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.TYPE.'</strong></div>';
						echo $row_aircraft["plane_description"].'<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.HOURS_PLANE.'</strong></div>';


$sumas= $row_aircraft["hours"];
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';
						echo $total .'<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.BOOKED_PLANE.'</strong></div>';
						if ($row_aircraft["booked"] == 1) {
							echo '<font color="#B20000"><b>'. PLANE_BOOKED. '</b></font><br>';
						} else {
							echo '<font color="#125D06"><b>'. PLANE_FREE . '</b></font><br>';
						}

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.STATUS_PLANE.'</strong></div>';
						echo $row_aircraft["status"].'%<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_PAX.'</strong></div>';
						echo $row_aircraft["pax"].' Pax<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MAX_RANGE.'</strong></div>';
						echo $row_aircraft["maximum_range"].' NM<BR>';
						
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CARGO.'</strong></div>';
						echo $row_aircraft["cargo_capacity"].' Kg<BR>';
						
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_LENGTH.'</strong></div>';
						echo $row_aircraft["aircraft_length"].' m<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MZFW.'</strong></div>';
						echo $row_aircraft["mzfw"].' Kg<BR>';
						
						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MLW.'</strong></div>';
						echo $row_aircraft["mlw"].' Kg<BR>';
						

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_MTOW.'</strong></div>';
						echo $row_aircraft["mtow"].' Kg<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CRUISE_SPEED.'</strong></div>';
						echo $row_aircraft["cruising_speed"].' Kts<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CEILING.'</strong></div>';
						echo $row_aircraft["service_ceiling"].' ft<BR>';

						echo '</td></tr><td>';
						echo '<div class="small"><strong>'.AIRCRAFT_DETAILS_CREW.'</strong></div>';
						echo $row_aircraft["crew_members"].'<BR>';
						echo '</td>';

					}


				?>
			</table>
			 </div>
                                </div>
                            </div>
                        </div>
</div>
</div>
</font>



 <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="blog_large">

  
  	<div class="post_content">
									<div class="post_meta">
										<h1><?php echo LOCATION_PLANE; ?></h1>
										<hr>
									</div>
									<p>
									<iframe src="mapaircraft.php?registry_id=<?php echo $registry_id; ?>" width="100%" height="600px" border="0"></iframe>
									</p>
									
									<hr>
									
										<h2><?php echo AIRCRAFT_HANGAR . '<strong>' . $registry_id . '</strong>' ?></h2>
										<br>
										<div class="table-responsive" style="height:400px;overflow:auto">	
				<table id="fleet_public" class="border--round">
				<?php
					$sql5 = "select date_in as datein, date_out as dateout, name, surname, reason from hangar h inner join gvausers gu on (h.gvauser_id=gu.gvauser_id) where registry='$registry_id'";
					if (!$result5 = $db->query($sql5)) {
						die('There was an error running the query [' . $db->error . ']');
					}
					echo "<thead><tr><th>" . HANGAR_IN . " </th><th>" . HANGAR_OUT . "</th><th>" . LAST_PILOT . "</th><th>" . REASON . "</th></tr></thead>";
					while ($row5 = $result5->fetch_assoc()) {
						echo "<td>";
						echo $row5["datein"] . '</td><td>';
						echo $row5["dateout"] . '</td><td>';
						echo $row5["name"] .' '. $row5["surname"]. '</td><td>';
						echo $row5["reason"] . '</td></tr>';
					}
					
				?>
			</table>
			</div>
									</div>
					
						</div>
						
					</div>
		







<div class="row">

	<div class="col-md-12">
		<br>
		<br>
		<br>
		<hr>
		<br>
			<!-- Default panel contents -->
			<h2><?php echo AIRCRAFT_FLIGHTS . '<strong>' . $registry_id . '</strong>' ?></h2>
<div class="table-responsive" style="height:400px;overflow:auto">	
			<!-- Table -->
			<table id="table_list"  class="border--round">
			
			  <thead>
                                            <tr>
												<th><b><?php echo AIRCRAFT_FLIGHTS_DATE; ?></b></th>
												<th><b><?php echo AIRCRAFT_FLIGHTS_CALLSIGN; ?></b></th>
												<th><b><?php echo AIRCRAFT_FLIGHTS_PILOT; ?></b></th>
												<th><b><?php echo AIRCRAFT_FLIGHTS_FLIGHT; ?></b></th>
												<th><b><?php echo AIRCRAFT_FLIGHTS_DEP; ?></b></th>
												<th><b><?php echo AIRCRAFT_FLIGHTS_ARR; ?></b></th>
												<th><b><?php echo AIRCRAFT_FLIGHTS_DISTANCE; ?></b></th>
                                            </tr>
											
                                        </thead>
										<tbody>
				<?php
			
					while ($row = $result->fetch_assoc()) {
						echo '<td><i class="fa fa-calendar"></i>&nbsp;';
						echo $row["fecha_envio"] . '</td><td>';
						
						
						$sql_rank = "SELECT * FROM ranks WHERE rank_id='" . $row["rank_id"] ."'" ;
											if (!$result_rank = $db->query($sql_rank)) {
											die('There was an error running the query [' . $db->error . ']');
										}
										
										while ($row_rank = $result_rank->fetch_assoc()) {
										$pilot_rank = $row_rank["img"];
										}
						
						
						
						
						echo '<a href="./index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '">' . $row["callsign"] . '</a> </td><td>';
						
						echo ' <img src="../../admin/images/ranks/' . $pilot_rank . '" alt="' . $pilot_rank . '" width="12%" > ' . $row["name"] . ' ' . $row["surname"] . '</td><td><i class="fa fa-th-list"></i>&nbsp;';
						
						if(!empty($row["route_id"])) {
						$sql_route = "select * from routes where route_id='" . $row["route_id"] ."'" ;

							if (!$result_route = $db->query($sql_route)) {
							die('There was an error running the query [' . $db->error . ']');
							}
							while ($row_route = $result_route->fetch_assoc()) {
								$etd = $row_route["etd"];
								$eta = $row_route["eta"];
								$route_id = $row_route["route_id"];
								$flighttype_id = $row_route["flighttype_id"];
							
							}
							
							$sql_flighttype = "SELECT * FROM flighttypes WHERE flighttype_id=$flighttype_id";
							if (!$result_flighttype = $db->query($sql_flighttype)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_flighttype = $result_flighttype->fetch_assoc()) {
							
							$flighttype = $row_flighttype["flighttype"];
							
							}
							
						}
						
						echo  '<a href="./index_user.php?page=route_info_public&route_id=' . $route_id . '">' . $row["flight"] . '</a> '. '</br><font size="1">' . $flighttype . '</font></td><td><i class="fa fa-sign-out"></i>&nbsp;';
						
						    
						
						
							$sql_departure = "select * from airports where ident='" . $row["departure"] ."'" ;

							if (!$result_departure = $db->query($sql_departure)) {
							die('There was an error running the query [' . $db->error . ']');
							}
							while ($row_departure = $result_departure->fetch_assoc()) {
								$departure_name = $row_departure["name"];
								$iso_country = $row_departure["iso_country"];
								$latitude_deg = $row_departure["latitude_deg"];
								$longitude_deg = $row_departure["longitude_deg"];
							}
							
							
						echo  $row["departure"] .  ' ('. $etd .' <i class="fa fa-clock-o"></i>)' . ' <img src="./images/flags/24/' . $iso_country . '.png" alt="' . $iso_country . '"> ' . '<br><font size="1">' . $departure_name .  '</td><td><i class="fa fa-sign-in"></i>&nbsp;';
						
							$sql_arrival = "select * from airports where ident='" . $row["arrival"] ."'" ;

							if (!$result_arrival = $db->query($sql_arrival)) {
							die('There was an error running the query [' . $db->error . ']');
							}
							while ($row_arrival = $result_arrival->fetch_assoc()) {
								$arrival_name = $row_arrival["name"];
								$iso_country1 = $row_arrival["iso_country"];
								$latitude_deg1 = $row_arrival["latitude_deg"];
								$longitude_deg1 = $row_arrival["longitude_deg"];
							}
						
						echo $row["arrival"] . ' ('. $eta .' <i class="fa fa-clock-o"></i>)' . ' <img src="./images/flags/24/' . $iso_country1 . '.png" alt="' . $iso_country1 . '"> ' . '<br><font size="1">' . $arrival_name . '</td><td><i class="fa fa-expand"></i>&nbsp;';
						
						echo $row["distance"] . '</td></tr>';
					}
					$db->close();
				?>
			</tbody></table>
		</div>
	</div>

	</div>

</div>
</div>
</section>
</section>