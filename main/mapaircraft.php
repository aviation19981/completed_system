<?php
	
	$registry_id = $_GET['registry_id'];
	
	include('./db_login.php');
	//include('./get_plane_data.php');

$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

$sql = "select * from 
	fleets f inner join cstpireps ft on f.registry=ft.registry 
	inner join gvausers gu on gu.ivaovid = ft.vid
	left outer join routes r on ft.route_id=r.route_id 
	";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}




$sql_aircraft = "select maximum_range,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow ,mlw,mzfw,aircraft_length,pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2, a.name airport ,a2.name hub_airport , f.name aircraft_name, location, hub_base from fleets f inner join airports a on a.ident=f.location inner join country_t c on c.iso2 = a.iso_country inner join airports a2 on a2.ident=f.hub_base inner join country_t c2 on c2.iso2 = a2.iso_country INNER JOIN fleettypes ft on f.fleettype_id=ft.fleettype_id where registry='$registry_id'";

					$sql_aircraft = "select hub,maximum_range,f.image_url,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow ,mlw,mzfw,aircraft_length,
pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2, a.name airport ,a2.name hub_airport ,
f.name aircraft_name, location, hub_base
from fleets f
inner join hubs hu on hu.hub_id= f.hub_id
inner join airports a on a.ident=f.location
inner join airports a2 on a2.ident=f.hub_base
inner join fleettypes ft on f.fleettype_id=ft.fleettype_id where registry='$registry_id'";

					$sql_aircraft = "select hub,maximum_range,f.image_url,booked,status, hours, crew_members ,service_ceiling,cruising_speed,mtow 
,mlw,mzfw,aircraft_length, pax,cargo_capacity,plane_description, a.iso_country location_iso2, a2.iso_country hub_iso2
, a.name airport ,a2.name hub_airport , f.name aircraft_name, location, hub_base 
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

$ubic = $row_aircraft["location"];
$plane_description = $row_aircraft["plane_description"];
$name = $row_aircraft["aircraft_name"] . ' ' . $registry_id;


$sql6 = "SELECT * FROM airports  where ident='$ubic'";

	if (!$result6 = $db->query($sql6)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6 = $result6->fetch_assoc()) {

		$location_airport = $row6['name'];

		$location_airport_flags = $row6['iso_country'];
$location = $ubic;
$loc_city = $municipality;

$latitudine_centro = $row6['latitude_deg'];
$longitudine_centro = $row6['longitude_deg'];

	}
}
	
?>







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
// definisco l’array dei punti di interesse, a cui passo la stringa costruita in Php
var puntiinteresse = [<?php echo $stringa_coords; ?>];
// definisco l’array delle descrizioni, a cui passo la stringa costruita in Php
var descrizioni = [<?php echo $stringa_descrizioni; ?>];
var markers = [];
var iterator = 0;
var map;

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var imgdeparture = './images/inair/medium/306.png'
var imgarrival = './images/inair/medium/306.png'

function initialize() {
directionsDisplay = new google.maps.DirectionsRenderer();
var mapOptions = {
zoom: 5,
mapTypeId: google.maps.MapTypeId.ROADMAP,
center: centro
};
map = new google.maps.Map(document.getElementById('map-canvas'),
mapOptions);
directionsDisplay.setMap(map);


var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $registry_id; ?></h1>'+
      '<div id="bodyContent">'+
      '<p><b><?php echo $name; ?></b><br><?php echo $plane_description; ?><br></p>'+
      '<p>(<?php echo $location; ?>) <?php echo $loc_city; ?><br><?php echo $location_airport; ?></p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });


var originMarker = new google.maps.Marker({
position: centro,
map: map,
icon: imgdeparture,
title: 'Hello World!'
});


google.maps.event.addListener(originMarker, 'click', function() {
    infowindow.open(map,originMarker);
  });


<?php
//while ($row = $result->fetch_assoc()) {
//$stringa_coords .= "new google.maps.LatLng(" . $row["Lat"] . ",". $row["Lon"] . "),";
//$ok = $row["Lat"];
//$ok1 = $row["Lon"];

?>


	
	//var flightPlanCoordinates = [
    //new google.maps.LatLng(<?php echo $latitudine_centro; ?>, <?php echo $longitudine_centro; ?>),
	 //new google.maps.LatLng(<?php echo $ok; ?>, <?php echo $ok1; ?>)
    
  //];
  //var flightPath = new google.maps.Polyline({
    //path: flightPlanCoordinates,
    //geodesic: true,
    //strokeColor: '#FF0000',
    //strokeOpacity: 1.0,
    //strokeWeight: 1
  //});

  //flightPath.setMap(map);
  
  
  
  
markers.push(new google.maps.Marker({
position: [<?php echo $stringa_coords; ?>][iterator],
map: map,
draggable: false,
title: descrizioni[iterator],
icon: imgarrival,
animation: google.maps.Animation.DROP
}));
iterator++;	



var styles = [
  {
    stylers: [
      { hue: "#3ca0cf" },
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
<body>
<div id="map-canvas"/>
</body>

