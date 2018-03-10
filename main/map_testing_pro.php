
<?php
   //error_reporting(E_ALL);
    //ini_set('display_errors', '1');
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	

		
		
	$route_string = $_GET['route_string'];
	$departure = $_GET['departure'];
	$arrival = $_GET['arrival'];
	$routeairport = $departure;
   
	$fulllocation='';

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
                   ) AS distance FROM RoutesAIRAC WHERE Route_FixName='$navpoint'  ORDER BY distance ASC limit 2";
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
				
				
				
		    
			
			
			
			
			
			
			
			
			
			
			//////////////////////// Si es un punto de navegacion y no airway /////////////
			if($airwaycontador>=0) {
				$beforeVOR = $navpoints[$i-1];
				$afterVOR = $navpoints[$i+1];
				
				
				
					 //////////////////////////////////////////////////
			$sql_checking = "SELECT Route_FixName, Route_FixLat,Route_FixLon,Route_Num, (6371 * ACOS( 
                                SIN(RADIANS(Route_FixLat)) * SIN(RADIANS($fromlat)) 
                                + COS(RADIANS(Route_FixLon - $fromlng)) * COS(RADIANS(Route_FixLat)) 
                                * COS(RADIANS($fromlat))
                                )
                   ) AS distance FROM RoutesAIRAC WHERE Route_FixName='$afterVOR'  ORDER BY distance ASC limit 1";
		    if (!$result_checking = $db->query($sql_checking)) {
			     die('There was an error running the query  [' . $db->error . ']');
		    } 
		    while ($row_checking = $result_checking->fetch_assoc()) {
			$fromlatAFTER = $row_checking['Route_FixLat'];
			$fromlngAFTER = $row_checking['Route_FixLon'];
	        }
			
			
			$sql_fix = "SELECT Route_FixName, Route_FixLat,Route_FixLon,Route_Num, Route_Name, (6371 * ACOS( 
                                SIN(RADIANS(Route_FixLat)) * SIN(RADIANS($fromlatAFTER)) 
                                + COS(RADIANS(Route_FixLon - $fromlngAFTER)) * COS(RADIANS(Route_FixLat)) 
                                * COS(RADIANS($fromlatAFTER))
                                )
                   ) AS distance, (6371 * ACOS( 
                                SIN(RADIANS(Route_FixLat)) * SIN(RADIANS($fromlat)) 
                                + COS(RADIANS(Route_FixLon - $fromlng)) * COS(RADIANS(Route_FixLat)) 
                                * COS(RADIANS($fromlat))
                                )
                   ) AS distance_two FROM RoutesAIRAC WHERE Route_Name='$navpoint' and Route_FixName BETWEEN '$beforeVOR' and '$afterVOR' HAVING distance and distance_two < 10 ORDER BY distance and distance_two ASC";
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
icon: imgvor,
title: "' . $row_fix['Route_FixName'] . '"
});';


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
	
	function getPointIndex($point_name, $list)
	{
		$total = count($list);
		
		for($i=0; $i<$total; $i++)
		{
			if($navpoints[$i] == $point_name)
			{
				return $i;
			}
		}
		
		return -1;
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
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ&callback=initMap" type="text/javascript">
</script>
    <script>
// definisco l’oggetto che rappresenta il centro della mappa,
// a cui passo le coordinate (variabili Php)
var centro = new google.maps.LatLng(<?php echo $latitudine_centro; ?>,<?php echo $longitudine_centro; ?>);
var departure = new google.maps.LatLng(<?php echo $dep_latitude_deg; ?>,<?php echo $dep_longitude_deg; ?>)
var arrival = new google.maps.LatLng(<?php echo $arr_latitude_deg; ?>,<?php echo $arr_longitude_deg; ?>)
var route_distance = <?php if($route_distance<=500){ echo '6';} else { if($route_distance<=2500){ echo '5';} else { echo '4';} } ?>

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

<?php echo $informacion; ?>

	
  
var flightPlanCoordinates = [
	      {lat: <?php echo $dep_latitude_deg; ?>, lng: <?php echo $dep_longitude_deg; ?>},
		  <?php echo $puntosdenavegacion; ?>
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

