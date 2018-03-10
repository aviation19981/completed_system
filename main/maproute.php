
<?php

	$route_id = $_GET['route_id'];
	
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$sql = " select * from routes where route_id=$route_id";
	

		

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}
	
	while ($row = $result->fetch_assoc()) {
		
		
		$departure = $row["departure"];
		$arrival = $row["arrival"];
		$route_string = $row["flproute"];
	
		
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
		
		$dep_latitude_deg = $row4['latitude_deg'];

		$dep_longitude_deg = $row4['longitude_deg'];
		

	}
	
	
	// Get Location info details

	$sql5 = "SELECT * FROM airports  where ident='$arrival'";

	if (!$result5 = $db->query($sql5)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

while ($row5 = $result5->fetch_assoc()) {

        $arrival_airport = $row5['name'];
        $arr_iso_country = $row5['iso_country'];
		$latitude2 = $row5['latitude_deg'];

		$longitude2 = $row5['longitude_deg'];
		
			$arr_latitude_deg = $row5['latitude_deg'];

		$arr_longitude_deg = $row5['longitude_deg'];

		

	}
	
function calcola_distanza($latitude1, $longitude1, $latitude2, $longitude2) {
  $theta = $longitude1 - $longitude2;
  $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
  $miles = acos($miles);
  $miles = rad2deg($miles);
  $miles = $miles * 60 * 1.1515;
  $feet = $miles * 5280;
  $yards = $feet / 3;
  $kilometers = $miles * 1.609344;
  $meters = $kilometers * 1000;
  return compact('miles','kilometers'); 
}


	$latitudine_centro = (($dep_latitude_deg + $arr_latitude_deg )/2);
	$longitudine_centro = (($dep_longitude_deg + $arr_longitude_deg)/2);
		
	
	
    // calcolo la distanza
    $distanza = calcola_distanza($dep_latitude_deg, $dep_longitude_deg, $arr_latitude_deg, $arr_longitude_deg);
    foreach ($distanza as $unita => $valore) {
  	$route_distance = $valore;
	}
    echo $test;            

	
?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0;}
#map-canvas { height: 100% }
</style>
<script
      src="https://maps.googleapis.com/maps/api/js?key= AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ &callback=initMap" type="text/javascript">
</script>
    <script>
// definisco l’oggetto che rappresenta il centro della mappa,
// a cui passo le coordinate (variabili Php)
var centro = new google.maps.LatLng(<?php echo $latitudine_centro; ?>,<?php echo $longitudine_centro; ?>);
var departure = new google.maps.LatLng(<?php echo $dep_latitude_deg; ?>,<?php echo $dep_longitude_deg; ?>)
var arrival = new google.maps.LatLng(<?php echo $arr_latitude_deg; ?>,<?php echo $arr_longitude_deg; ?>)
var route_distance = <?php if($route_distance<=500){ echo '6';} else { if($route_distance<=2500){ echo '5';} else { echo '4';} } ?>
// definisco l’array dei punti di interesse, a cui passo la stringa costruita in Php
var puntiinteresse = [<?php echo $stringa_coords; ?>];
// definisco l’array delle descrizioni, a cui passo la stringa costruita in Php
var descrizioni = [<?php echo $stringa_descrizioni; ?>];
var markers = [];
var iterator = 0;
var map;

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var imgdeparture = 'images/airport_runway_green.png'
var imgarrival = 'images/airport_runway_red.png'

function initialize() {
directionsDisplay = new google.maps.DirectionsRenderer();
var mapOptions = {
zoom: route_distance,
mapTypeId: google.maps.Weather,
center: centro
};
map = new google.maps.Map(document.getElementById('map-canvas'),
mapOptions);
directionsDisplay.setMap(map);

var originMarker = new google.maps.Marker({
position: departure,
map: map,
icon: imgdeparture
});



	var flightPlanCoordinates = [
	      {lat: <?php echo $dep_latitude_deg; ?>, lng: <?php echo $dep_longitude_deg; ?>},
          {lat: <?php echo $arr_latitude_deg; ?>, lng: <?php echo $arr_longitude_deg; ?>}
        
    
  ];
  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
  
  
  
  
markers.push(new google.maps.Marker({
position: arrival,
map: map,
draggable: false,
title: descrizioni[iterator],
icon: imgarrival

}));

	
var styles = [
  {
    stylers: [
      { hue: "#778899" },
      { saturation: -20 }
    ]
  },{
    featureType: "road",
    elementType: "geometry",
    stylers: [
      { lightness: 100 },
      { visibility: "simplified" }
    ]
  },{
    featureType: "road",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
];

map.setOptions({styles: styles});	
	


}



google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'load', drop);


</script>
</head>
<body>
<div id="map-canvas"/>
</body>
</html>

