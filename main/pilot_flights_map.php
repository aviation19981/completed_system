
<!DOCTYPE html>
<html>
<head>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' type='text/javascript'></script>
	<script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ &callback=initMap" type="text/javascript">
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
	$sql_map = "SELECT departure, arrival, 	fecha_envio as date from cstpireps where vid='$ivaovid'";

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


<div class="container">
	<div class="row">
		<div id="map-outer" class="col-md-11">
			<div id="map-container" class="col-md-12"></div>
		</div><!-- /map-outer -->
	</div> <!-- /row -->

</div><!-- /container -->

<style>
	body { background-color:#FFFFF }
	#map-outer {
		padding: 0px;
		border: 0px solid #CCC;
		margin-bottom: 0px;
		background-color:#FFFFF }
	#map-container { height: 500px }
	@media all and (max-width: 991px) {
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
			styles: [{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]
			};




		var var_map = new google.maps.Map(document.getElementById("map-container"),
				var_mapoptions);
				
				
var lineSymbol = {
  path: 'M 0,-1 0,1',
  strokeOpacity: 1,
  strokeWeight: 1,
  scale: 6
};

var lineSymbol2 = {
  path: 'M 0,-0.5 0,0.5',
  scale: 6,
  strokeWeight: 1,
  strokeColor: '#99CBFF'
};


		var k=0;
		while (k<<?php echo $index; ?>) {

			dep = new google.maps.LatLng(locations[k][0], locations[k][1]);
			arr = new google.maps.LatLng(locations[k+1][0], locations[k+1][1]);
			var icon_red = 'images/ubic.png';
			var icon_green = 'images/ubic.png';

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
			
			function animateCircle4() {
    var count = 0;
    offsetId = window.setInterval(function() {
      count = (count + 1) % 200;
      var icons = marker_dep.get('icons');
      icons[0].offset = (count / 2) + '%';
      marker_dep.set('icons', icons);
  }, 20);
}
 
animateCircle4();

			marker_dep.setMap(var_map);
			marker_arr.setMap(var_map);
			k=k+2;
		}



	}

	google.maps.event.addDomListener(window, 'load', init_map);

</script>
</html>
