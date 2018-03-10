
<?php

	$departure = $_GET['departure'];
	$arrival = $_GET['arrival'];
	$timedep = $_GET['timedep'];
	$timearr = $_GET['timearr'];
	$route_string = $_GET['route_string'];
	$routeairport = $departure;
	$category_acft = $_GET['category_acft'];
	
	$firstime =strlen($timedep);
	$secondtime =strlen($timearr);
	
	if($firstime==1) {
		$timedeparture = '000' . $timedep . 'z';
	} else if($firstime==2) {
		$timedeparture = '00' . $timedep . 'z';
	} else if($firstime==3) {
		$timedeparture = '0' . $timedep . 'z';
	} else if($firstime==4) {
		$timedeparture = $timedep . 'z';
	}
	
	
	if($secondtime==1) {
		$timearrival = '000' . $timearr . 'z';
	} else if($secondtime==2) {
		$timearrival = '00' . $timearr . 'z';
	} else if($secondtime==3) {
		$timearrival = '0' . $timearr . 'z';
	} else if($secondtime==4) {
		$timearrival = $timearr . 'z';
	}
	
	
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	

		

// Get Location info details

	$sql4 = "SELECT * FROM airports apt inner join country_t cou on apt.iso_country=cou.iso2 where apt.ident='$departure'";

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
		$departurename = $row4['name'];
        $departurecountry = $row4['short_name'];
		$departurecity = $row4['municipality'];
	}
	
	
	// Get Location info details

	$sql5 = "SELECT * FROM airports apt inner join country_t cou on apt.iso_country=cou.iso2 where apt.ident='$arrival'";

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
        $arrivalname = $row5['name'];
		$arrivalcountry = $row5['short_name'];
		$arrivalcity = $row5['municipality'];

	}
	
function distanceBetweenPoints($lat1, $lng1, $lat2, $lng2)
	{
		/*	Use a radius depending on the final units we want to be in 
			New formula, from http://jan.ucc.nau.edu/~cvm/latlon_formula.html
		 */
		
			$radius = 3443.92;
			
		/*
		$distance = ($radius * 3.1415926 * sqrt(($lat2-$lat1) * ($lat2-$lat1)
					+cos($lat2/57.29578) * cos($lat1/57.29578) * ($lng2-$lng1) * ($lng2-$lng1))/180);
				
		return $distance;
		*/
		$lat1 = deg2rad(floatval($lat1));
		$lat2 = deg2rad(floatval($lat2));
		$lng1 = deg2rad(floatval($lng1));
		$lng2 = deg2rad(floatval($lng2));
		
		$a = sin(($lat2 - $lat1)/2.0);
		$b = sin(($lng2 - $lng1)/2.0);
		$h = ($a*$a) + cos($lat1) * cos($lat2) * ($b*$b);
		$theta = 2 * asin(sqrt($h)); # distance in radians
		
		$distance = $theta * $radius;
		
		return $distance;
				
		/* Convert all decimal degrees to radians */
		
		$dlat = $lat2 - $lat1;
		$dlng = $lng2 - $lng1;
		
		$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
		$distance = $r * $c;
		
		return $distance;
		/*$distance = acos(cos($lat1)*cos($lng1)*cos($lat2)*cos($lng2) 
							+ cos($lat1)*sin($lng1)*cos($lat2)*sin($lng2) 
							+ sin($lat1)*sin($lat2)) * $r;

		return floatval(round($distance, 2));*/
	}


	$latitudine_centro = (($dep_latitude_deg + $arr_latitude_deg )/2);
	$longitudine_centro = (($dep_longitude_deg + $arr_longitude_deg)/2);
		
	
	
    // calcolo la distanza
    $distanza = distanceBetweenPoints($dep_latitude_deg, $dep_longitude_deg, $arr_latitude_deg, $arr_longitude_deg);
   
	
		
		
	$nat_pattern = '/^([0-9]+)([A-Za-z]+)/';
	

	if($route_string == '') {
	   return array();
	}
	
	$sql = "select *  from airports where ident='$routeairport'";
    if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
    while ($row = $result->fetch_assoc()) {
		$fromlat  = $row['latitude_deg'];
		$fromlng  = $row['longitude_deg'];
	}
	
	// Remove any SID/STAR text
    $route_string = str_replace('SID', '', $route_string);
    $route_string = str_replace('STAR', '', $route_string);
	$route_string = str_replace('DCT', '', $route_string);
	$navpoints = array();
    $all_points = explode(' ', $route_string);
	
	foreach($all_points as $key => $value) {
          if(empty($value) === true) {
                continue;
          }
			$navpoints[] = strtoupper(trim($value));
    }

	
	
	$allpoints = array();
    $total = count($navpoints);
	$puntosdenavegacion = '';
	$informacion = '';
	$posiciones=array();
	$positioninfo = array();
	//////////////////////// Analizar cada punto //////////////////////////////
        for($i = 0; $i < $total; $i++)
		{
			$navpoint = cleanName($navpoints[$i]);
			$airwaycontador=0;
			$fixcontador=0;
			$vorcontador=0;
			
			/////////////////////////////// Miramos si ese puntos es un airway ////////////////
			$sql_airways = "SELECT * FROM RoutesAIRAC WHERE Route_Name='$navpoint'";
		    if (!$result_airways = $db->query($sql_airways)) {
			     die('There was an error running the query  [' . $db->error . ']');
		    } 
		    while ($row_airways = $result_airways->fetch_assoc()) {
			$airwaycontador++;
		    }
			
			/////////////////////////////// Miramos si ese puntos es un fix ////////////////
			$sql_fix = "SELECT * FROM RoutesAIRAC WHERE Route_FixName='$navpoint'";
		    if (!$result_fix = $db->query($sql_fix)) {
			     die('There was an error running the query  [' . $db->error . ']');
		    } 
		    while ($row_fix = $result_fix->fetch_assoc()) {
			$fixcontador++;
		    }
			
			
			
			//////////////////////// Si es un punto de navegacion y no airway /////////////
			if($fixcontador>0) {
				
			$positiones = $i-1;
			$beforeFixLat = $positioninfo[$positiones][0];
			$beforeFixLng = $positioninfo[$positiones][1];
			
				if($i==0) {
					 //////////////////////////////////////////////////
			$sql_fix = "SELECT Route_FixName, Route_FixLat,Route_FixLon,Route_Num, (6371 * ACOS( 
                                SIN(RADIANS(Route_FixLat)) * SIN(RADIANS($fromlat)) 
                                + COS(RADIANS(Route_FixLon - $fromlng)) * COS(RADIANS(Route_FixLat)) 
                                * COS(RADIANS($fromlat))
                                )
                   ) AS distance FROM RoutesAIRAC WHERE Route_FixName='$navpoint'  ORDER BY distance ASC limit 1";
		    if (!$result_fix = $db->query($sql_fix)) {
			     die('There was an error running the query  [' . $db->error . ']');
		    } 
		    while ($row_fix = $result_fix->fetch_assoc()) {
			$puntosdenavegacion = $puntosdenavegacion . '{ lat: ' . $row_fix['Route_FixLat'] . ', lng: ' . $row_fix['Route_FixLon'] . '},';
			$fromlat =$row_fix['Route_FixLat'];
			$fromlng = $row_fix['Route_FixLon'];
$informacion = $informacion . 'var ' . $row_fix['Route_FixName'] . ' = new google.maps.Marker({
position: new google.maps.LatLng(' . $row_fix['Route_FixLat'] . ',' . $row_fix['Route_FixLon'] . '),
map: map,
icon: imgfix,
title: "' . $row_fix['Route_FixName'] . '"
});';


		         }
				 //////////////////////////////////////////////////
				 
				} else {
			
		   
			
					 //////////////////////////////////////////////////
			$sql_fix = "SELECT Route_FixName, Route_FixLat,Route_FixLon,Route_Num, (6371 * ACOS( 
                                SIN(RADIANS(Route_FixLat)) * SIN(RADIANS($fromlat)) 
                                + COS(RADIANS(Route_FixLon - $fromlng)) * COS(RADIANS(Route_FixLat)) 
                                * COS(RADIANS($fromlat))
                                )
                   ) AS distance FROM RoutesAIRAC WHERE Route_FixName='$navpoint'  ORDER BY distance ASC limit 1";
		    if (!$result_fix = $db->query($sql_fix)) {
			     die('There was an error running the query  [' . $db->error . ']');
		    } 
		    while ($row_fix = $result_fix->fetch_assoc()) {
			$puntosdenavegacion = $puntosdenavegacion . '{ lat: ' . $row_fix['Route_FixLat'] . ', lng: ' . $row_fix['Route_FixLon'] . '},';
			$fromlat =$row_fix['Route_FixLat'];
			$fromlng = $row_fix['Route_FixLon'];
			
$informacion = $informacion . 'var ' . $row_fix['Route_FixName'] . ' = new google.maps.Marker({
position: new google.maps.LatLng(' . $row_fix['Route_FixLat'] . ',' . $row_fix['Route_FixLon'] . '),
map: map,
icon: imgfix,
title: "' . $row_fix['Route_FixName'] . '"
});';


		         }
				 //////////////////////////////////////////////////
				 
					
				}
				
				
				
		    } 
				
				
				
		    
				
				
				
	
				
			
			
	}
		
		
		
		
		function cleanName($name)
	{
		if(substr_count($name, '/') > 0)
		{
			$tmp = explode('/', $name);
			$name = $tmp[0];
			unset($tmp);
		}
		
		return $name;
	}
	
	
	
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
var centro = new google.maps.LatLng(<?php echo $dep_latitude_deg; ?>,<?php echo $dep_longitude_deg; ?>);
var departure = new google.maps.LatLng(<?php echo $dep_latitude_deg; ?>,<?php echo $dep_longitude_deg; ?>)
var arrival = new google.maps.LatLng(<?php echo $arr_latitude_deg; ?>,<?php echo $arr_longitude_deg; ?>)
var route_distance = <?php if($distanza<=500){ echo '5';} else { if($distanza<=2500){ echo '3';} else { echo '2';} } ?>
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
var imgfix = 'images/icon_fix.png'
var imgvor = 'images/icon_vor.png'

function initialize() {
directionsDisplay = new google.maps.DirectionsRenderer();
var mapOptions = {
zoom: route_distance,
mapTypeId: google.maps.Weather,
center: {lat: <?php echo $dep_latitude_deg; ?>, lng: <?php echo $dep_longitude_deg; ?>},
};
map = new google.maps.Map(document.getElementById('map-canvas'),
mapOptions);
directionsDisplay.setMap(map);

var departureinfo = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $departurename; ?></h1>'+
      '<div id="bodyContent">'+
      '<p><b>Origen:</b> <?php echo $departure; ?></p>'+
	  '<p><b>País Origen:</b> <?php echo $departurecountry; ?></p>'+
	  '<p><b>Ciudad Origen:</b> <?php echo $departurecity; ?></p>'+
	  '<p><b>Hora Salida:</b> <?php echo $timedeparture; ?></p>'+
      '</div>';
	  
	   var infowindows = new google.maps.InfoWindow({
      content: departureinfo
  });

var originMarker = new google.maps.Marker({
position: departure,
map: map,
icon: imgdeparture
});

<?php  if($category_acft<>"L") { echo $informacion; } ?>

google.maps.event.addListener(originMarker, 'click', function() {
    infowindows.open(map,originMarker);
  });

	var flightPlanCoordinates = [
	      {lat: <?php echo $dep_latitude_deg; ?>, lng: <?php echo $dep_longitude_deg; ?>},
		  <?php 
		  if($category_acft<>"L") {
		  echo $puntosdenavegacion;
		  }		  ?>
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
  
  
  var arrivalinfo = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $arrivalname; ?></h1>'+
      '<div id="bodyContent">'+
      '<p><b>Destino:</b> <?php echo $arrival; ?></p>'+
	  '<p><b>País Destino:</b> <?php echo $arrivalcountry; ?></p>'+
	  '<p><b>Ciudad Destino:</b> <?php echo $arrivalcity; ?></p>'+
	  '<p><b>Hora Llegada:</b> <?php echo $timearrival; ?></p>'+
      '</div>'+
      '</div>';
	  
	   var infowindow = new google.maps.InfoWindow({
      content: arrivalinfo
  });
  
  

  
var arrivalMarker = new google.maps.Marker({
position: arrival,
map: map,
icon: imgarrival
});
  
  google.maps.event.addListener(arrivalMarker, 'click', function() {
    infowindow.open(map,arrivalMarker);
  });

	
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

