<?php
session_start();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "https://" . $host;

	
    if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['language'] = "es";
	}
	
		
	
	
    include("./../main/languages/lang_" . $_SESSION['language'] . ".php");
	
	$operator_id = $_GET['va']; ?>

<html>
<head>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ&callback=initMap" type="text/javascript">
</script>


</head>

<body>
<?php
include('./db_login.php');

	/* Connect to Database */
	$db_map = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db_map->set_charset("utf8");
	if ($db_map->connect_errno > 0) {
		die('Unable to connect to database [' . $db_map->connect_error . ']');
	}
	// Execute SQL query
	$sql_map = "select departure, arrival  from routes where operator_id='$operator_id'";

	if (!$result = $db_map->query($sql_map)) {
		die('There was an error running the query  [' . $db_map->error . ']');
	}
	unset($flights);
	$flights = array();
	$index = 0;
	while ($row = $result->fetch_assoc()) {
		$flights [$index] = $row["departure"];
		$index++;
		$flights [$index] = $row["arrival"];
		$index++;
	}
	
	$flights_coordinates = array ();
	$index = -1;
	foreach($flights as $flight) {
		$sql_map = "select latitude_deg, longitude_deg ,ident , airports.name as airport_name  from airports where ident='$flight'";

		if (!$result = $db_map->query($sql_map)) {
			die('There was an error running the query  [' . $db_map->error . ']');
		}

		while ($row = $result->fetch_assoc()) {
			$index++;
			$flights_coordinates [$index] = array ($row["latitude_deg"],  $row["longitude_deg"] ,  $row["ident"],  $row["airport_name"] ) ;

		}
	}

?>



		<div id="map-outer" class="col-md-13">
			<div id="map-container" class="col-md-13"></div>
		</div><!-- /map-outer -->
	



<style>
	body { background-color:#FFFFF }
	#map-outer {
		padding: 0px;
		border: 0px solid #CCC;
		margin-bottom: 0px;
		background-color:#FFFFF }
	#map-container { height: 500px }
	@media all and (max-width: 300px) {
		#map-outer  { height: 650px }
	}
</style>



</body>
<script type="text/javascript">

	function init_map() {

		var locations = <?php echo json_encode($flights_coordinates); ?>;

		var var_location = new google.maps.LatLng(<?php echo $flights_coordinates[0][0]; ?>,<?php echo $flights_coordinates[0][1]; ?>);


		var var_mapoptions = {
			center: var_location,
			zoom: 5,
			styles: [{featureType:"road",elementType:"geometry",stylers:[{lightness:100},{visibility:"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF",}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]
		};


		var var_map = new google.maps.Map(document.getElementById("map-container"),
				var_mapoptions);
		var k=0;
		while (k<<?php echo $index; ?>) {

			dep = new google.maps.LatLng(locations[k][0], locations[k][1]);
			arr = new google.maps.LatLng(locations[k+1][0], locations[k+1][1]);
			var icon_red = './../main/images/ubic.png';
			var icon_green = './../main/images/ubic.png';
							    
			var marker_dep = new google.maps.Marker({
				position: dep,
				icon: icon_green
			});															        
			var marker_arr = new google.maps.Marker({
				position: arr,
				icon: icon_green
			});									  		 
			marker_dep.setMap(var_map);
			marker_arr.setMap(var_map);										

			var var_marker = new google.maps.Polyline({
				path: [dep, arr],
				geodesic: true,
				strokeColor: '#FF0000',
				strokeOpacity: 1.0,
				strokeWeight: 2
			});
			var_marker.setMap(var_map);
			var marker_dep = new google.maps.Marker({
				position: dep,
				icon: icon_green
			});
			var marker_arr = new google.maps.Marker({
				position: arr,
				icon: icon_green
			});
			marker_dep.setMap(var_map);
			marker_arr.setMap(var_map);
			k=k+2;											
		}



	}

	google.maps.event.addDomListener(window, 'load', init_map);	

</script>
</html>
