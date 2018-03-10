
	
			<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo INFO_FLIGHT_SEARCHER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white">  <?php echo DETAIL_INFO_FLIGHT_SEARCHER; ?></font></h3>

</section>
		

		
					


		<section class="contact">
			<div class="container">
			<?php
			$departure = strtoupper($_POST['departure']);
			$arrival = strtoupper($_POST['arrival']);
			$departure1 = strtoupper($_POST['departure1']);
			$arrival1 = strtoupper($_POST['arrival1']);
			
			
			
			
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	$db->query("SET SQL_BIG_SELECTS=1");  //Set it before your main query
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	
	        if($departure<>'' && $arrival=='') {
				$sql = "select flight, a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,route_id,departure,arrival, duration, operator_id from routes r, airports a1 , airports a2 where departure='$departure' and departure=a1.ident and arrival=a2.ident order by departure asc,arrival asc ";
				//$sql = "select* from routes where departure='$departure' order by departure asc,arrival asc ";
			} else if($arrival<>'' && $departure=='') {
				$sql = "select flight, a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,route_id,departure,arrival, duration, operator_id from routes r, airports a1 , airports a2 where arrival='$arrival' and departure=a1.ident and arrival=a2.ident order by departure asc,arrival asc ";
				//$sql = "select* from routes where arrival='$arrival' order by departure asc,arrival asc ";
			} else if(($departure1<>'') && ($arrival1<>'')) {
				$sql = "select flight, a1.name as dep_name, a2.name as arr_name, a1.iso_country as dep_country,a2.iso_country as arr_country,route_id,departure,arrival, duration, operator_id from routes r, airports a1 , airports a2 where departure='$departure1' and arrival='$arrival1' and departure=a1.ident and arrival=a2.ident order by departure asc,arrival asc ";
				//$sql = "select * from routes departure='$departure' and arrival='$arrival' order by departure asc,arrival asc ";
			} else {
				?>
<script type="text/javascript">
window.location="./index_user.php?page=routes_search";
</script>
				<?php
			}
			
			if (!$result = $db->query($sql)) {
		        die('There was an error running the query [' . $db->error . ']');
	        }
?>

			
			<table id="routes_public" class="table table-hover">
					<?php
					    $contadores=0;
						echo '<thead>';
						echo '<tr><th>' . AIRLINE_SCHEDULE . '</th><th>' . BOOK_ROUTE_FLIGHT . '</th><th>' . DEPARTURE . '</th><th>' . ARRIVAL . '</th><th>' . TABLE_AIRPLANES . '</th></tr>';
						echo '</thead>';
						while ($row = $result->fetch_assoc()) {
							$contadores++;
							$sql2 = 'select ft.plane_icao from fleettypes_routes fr, routes r, fleettypes ft where r.route_id=' . $row["route_id"] . ' and r.route_id=fr.route_id and fr.fleettype_id=ft.fleettype_id ';
							$planes_icaos = '';
							if (!$result2 = $db->query($sql2)) {
								die('There was an error running the query [' . $db->error . ']');
							}
							while ($row2 = $result2->fetch_assoc()) {
								$planes_icaos = $planes_icaos . ' ' . $row2["plane_icao"];
							}
							
							
                                                       $sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row["operator_id"]) {
							
							
							$img = $row_operator["file"];
							
							}
							}
							
							echo '<tr><td>';
							if ($row["operator_id"] > 0) {
echo '<img src="../../admin/images/operators/' . $img . '" alt="' . $row["flight"] . '" height="50px"  widht="100%"></td>';
		} else if ($row["operator_id"] == 0){
echo 'Chárter</td>';

}
     
							echo '<td>
							<i class="icon color--primary icon-Calendar"></i>&nbsp; <a href="./index_user.php?page=route_info_public&route_id=' . $row["route_id"] . '">' . $row["flight"] . '</a></td><td><i class="flaticon-departures color--primary icon--sm"></i>&nbsp;<IMG src="img/flags/24/'.$row["dep_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row["departure"] . '<br><font size="1">'.str_replace("Airport","",$row["dep_name"]).'</font> </td><td><i class="flaticon-arrival color--primary icon--sm"></i>&nbsp;<IMG src="img/flags/24/'.$row["arr_country"].'.png" WIDTH="25" HEIGHT="20" BORDER=0 ALT="">&nbsp;';
							echo $row["arrival"] . '<br><font size="1">'.str_replace("Airport","",$row["arr_name"]).'</font> </td>';
						    echo '<td><i class="icon color--primary icon-Plane"></i>&nbsp;';
							echo $planes_icaos . '</td></tr>';
						}
						$db->close();
					?>
				</table>
				<?php if($contadores==0) {
					
			if($departure<>'' && $arrival=='') {
				echo '<div class="alert alert-danger" role="alert">' . NO_FLIGHT_FROM .  ' ' . $departure . '</div>';
			} else if($arrival<>'' && $departure=='') {
				echo '<div class="alert alert-danger" role="alert">' . NO_FLIGHT_TO . ' ' . $arrival . '</div>';
			} else if($departure1<>'' && $arrival1<>'') {
				echo '<div class="alert alert-danger" role="alert">' . NO_FLIGHT_FROM_TO . ' ' . $departure1 . ' ' . TO_ARRIVAL_SEARCHER . ' ' . $arrival1 . '</div>';
			}
					
					
				} ?>
			
</div>




</section>











