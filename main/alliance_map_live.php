<?php
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>ColStar Alliance | Mapa</title>
	<meta name="keywords" content="aerolinea, airlines, colombia, colstar, acars, va , fsx, ivao, virtual" />
    <meta name="description" content="Aerol&iacute;nea virtual Colombiana, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?"/>
    <link href="./images/favicon.ico" type="image/x-icon" rel="icon" />
    <style>
      #map { height : 100%; width : 100%; top : 0; left : 0; position : absolute; z-index : 99;}
    </style>
	<link href="css/map_colstar.css" rel="stylesheet">
	<!-- Include jQuery lib for AJAX requests -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	
	<?php  include('./get_va_data.php'); ?>

   
  </head>
  <body>
    <?php include('./online_info_colstar.php'); ?>
    <div style=" position: absolute; z-index: 100; margin: 10px;">
              <a href="./"><img src="./images/logo.png" width="20%" alt="ColStar Alliance" /> </a>
    </div> 
    <div id="map"></div>
	<div id="over_map"></div>
    <script>
      var map;
      function initMap() {
		   
		var flights = <?php echo json_encode($jsonarray[0]); ?>;
		var locations = <?php echo json_encode($jsonarray[1]); ?>;
		var numpoints=(locations.length);
		console.log(locations);
		var var_location = new google.maps.LatLng(<?php echo $datos[0][0]["latitude"]; ?>,<?php echo $datos[0][0]["longitude"]; ?>);
		var var_mapoptions = {
			center: var_location,
            minZoom: 3,
			zoom: 3,
			refreshTime: 10000,
autorefresh: true,
disableDefaultUI: true,
			styles: [
    {
        "featureType": "administrative",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "landscape.natural.landcover",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "saturation": "-47"
            },
            {
                "lightness": "-57"
            }
        ]
    },
    {
        "featureType": "landscape.natural.terrain",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": "-63"
            },
            {
                "lightness": "-55"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#519c2f"
            },
            {
                "gamma": "1.27"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#e4bd2e"
            },
            {
                "weight": "3.14"
            },
            {
                "gamma": "1.58"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "weight": "0.38"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#f28a17"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "saturation": "-78"
            },
            {
                "lightness": "-32"
            },
            {
                "gamma": "1.11"
            },
            {
                "hue": "#ff0000"
            },
            {
                "weight": "9.68"
            },
            {
                "invert_lightness": true
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#7f0000"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#ff7676"
            },
            {
                "weight": "0.69"
            }
        ]
    },
    {
        "featureType": "transit.station.airport",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "hue": "#ff0000"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#4ba7b2"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": "-51"
            },
            {
                "lightness": "-59"
            }
        ]
    }
]};
		map = new google.maps.Map(document.getElementById('map'),	var_mapoptions);
		var mapas=[];
		var flightPlanCoordinates=[];
		var flightPath = new google.maps.Polyline({
		strokeColor: "#c3524f",
		strokeOpacity: 1,
		strokeWeight: 2,
		geodesic: true
		});
		var k=0;
		var z=0;
		var coordinate;
		while (k<numpoints) {
			while (z < locations[k].length)
			{
				coordinate =new google.maps.LatLng(locations[k][z]['latitude'],locations[k][z]['longitude']);
				flightPlanCoordinates.push(coordinate);
				z=z+1;
			}
			ruta = new google.maps.Polyline({
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
			});
			ruta.setPath(flightPlanCoordinates);
			mapas.push(ruta);
			z=0;
			k=k+1;
		};
		function createMarker(pos, t) {
		var coord=[];
		var pathcoord=[];
		var flight_id = t;
		currentPath = new google.maps.Polyline({
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
			});
		// Plane marker begin
		var image = new google.maps.MarkerImage(flights[t]['typesairplane']+flights[t]['heading'] +".png",null,new google.maps.Point(0,0),new google.maps.Point(15, 15),new google.maps.Size(40, 40));
		var icon_airport_dep = new google.maps.MarkerImage("./map_icons/airport_yellow_marker.png");
		var icon_airport_arr = new google.maps.MarkerImage("./map_icons/airport_blue_marker.png");
		var lineSymbol = {path: 'M 0,-1 0,1', strokeOpacity: 1, scale: 1 };
		var lat1 = flights[t]["dep_lat"];
		var lat2 = flights[t]["arr_lat"];
		var lng1 = flights[t]["dep_lon"];
		var lng2 = flights[t]["arr_lon"];
		var dep = new google.maps.LatLng(lat1, lng1)
		var arr = new google.maps.LatLng(lat2, lng2)
		
		var informaciones = flights[t]['callsign_vuelo'];
		  var informacionespro = '<div style="width:270px;">'+'<h3>Flight Information</h3>'+
	  '<span style="font-size: 10px; text-align:left; width: 100%" align="left">'+'<center>'+
	  flights[t]['operators'] + '</center>'+
	  '<hr>'+
      '<p> <strong>Flight:</strong> ' + flights[t]['callsign_vuelo'] +  '<br>'+
	  '<strong>Pilot:</strong> ' + flights[t]['name'] +  '<br>'+
      '<strong>Origin: </strong>' + flights[t]['dep_name'] + ' (' + flights[t]['departure'] + ') <br>'+
      '<strong>Destination: </strong>' + flights[t]['arr_name'] + ' (' + flights[t]['arrival'] + ') <br>'+
	  '<strong>Aircraft:</strong> ' + flights[t]['plane_type'] + '<br>'+
      '<strong>Status:</strong> ' + flights[t]['flight_status'] +
      '</p>'+
      '<hr>'+
      '<p> <strong>Altitude:</strong> ' + flights[t]['altitude'] + 'ft <br>'+
      '<strong>Ground Speed:</strong> ' + flights[t]['gs']+ 'kts <br>'+
      '<strong>Heading:</strong> ' + flights[t]['heading'] + ' <br>'+
      '<strong>Distance Remaining:</strong> ' + flights[t]['pending_nm'] + 'nm<br>'+
	  '<hr>'+
	  '<strong>Network IVAO:</strong> ' + flights[t]['networkss'] + '</center><br>' + 
	  '<strong>Remarks:</strong> ' + flights[t]['rmks'] + '</center><br>' +
	  '<strong>Route:</strong> ' + flights[t]['fpl'] + '</center><hr>'+
	  '<div class="progress"><div class="' + flights[t]['bar'] + '" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:'   + flights[t]['porcentaje'] +  '%"><center><font color="black">'  + flights[t]['perc_completed'] + '%</font></center></div></div>'+
	  
      '</p>'+  
    '</span>'+
    '</div>';
			
			
		var marker = new google.maps.Marker({
			position: pos,
			icon: image,
			name: t,
			<?php
  
$tablet_browser = 0;
$mobile_browser = 0;
$body_class = 'desktop';
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
    $body_class = "tablet";
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
}
if ($tablet_browser > 0) {
?>
contenido: informacionespro,
<?
}
else if ($mobile_browser > 0) {
?>
contenido: informacionespro,
<?
}
else {
	?>
contenido: informaciones,
<?
}  
?>

icao1:new google.maps.Marker({
							position: dep,
							 map: map,
							 icon: icon_airport_dep,
							 visible: false
						}),
						icao2:new google.maps.Marker({
							position: arr,
							 map: map,
							 icon: icon_airport_arr,
							 visible: false
						}),
                        line1:new google.maps.Polyline({
							path: [dep, pos],
							strokeColor: "#08088A",
							strokeOpacity: 1,
							strokeWeight: 2,
							geodesic: true,
							map: map,
							polylineID: t,
							visible: false
                        })	,
                        line2:new google.maps.Polyline({
							path: [pos, arr],
							strokeColor: "#FE2E2E",
							strokeOpacity: .3,
							geodesic: true,
							map: map,
							icons: [{
								icon: lineSymbol,
								offset: '0',
								repeat: '5px'
							}],
							polylineID: t,
							visible: false
                        })
			
		});
		// On mouse over
        google.maps.event.addListener(marker, 'mouseover', function () {
            //infowindow.open(map, marker);
            this.get('line1').setVisible(true);
            this.get('line2').setVisible(true);
			this.get('icao1').setVisible(true);
			this.get('icao2').setVisible(true);
			 //infowindow.open(map,marker);
		   infowindow.setContent(marker.contenido);
		    var s=0;
		   coord.length = 0;
		   pathcoord.length = 0;
		  while (s < locations[flight_id].length)
			{
				coord= new google.maps.LatLng(locations[flight_id][s]['latitude'],locations[flight_id][s]['longitude']);
				pathcoord.push(coord);
				s=s+1;
			}
			currentPath.setPath(pathcoord);
			currentPath.setMap(map);
			
			
		
			
			<?php
  
$tablet_browser = 0;
$mobile_browser = 0;
$body_class = 'desktop';
 
if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $tablet_browser++;
    $body_class = "tablet";
}
 
if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
    $mobile_browser++;
    $body_class = "mobile";
}
 
$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
$mobile_agents = array(
    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
    'newt','noki','palm','pana','pant','phil','play','port','prox',
    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
    'wapr','webc','winw','winw','xda ','xda-');
 
if (in_array($mobile_ua,$mobile_agents)) {
    $mobile_browser++;
}
 
if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
    $mobile_browser++;
    //Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
      $tablet_browser++;
    }
}
if ($tablet_browser > 0) {
?>
flight_detail='<table class="tg"  width="100%" height="100%">'+

'<tr>'+
    '<th class="tg-031e"    id="caja"  colspan="3"></th>'+
  '</tr>'+
  '<tr >'+
    '<td class="tg-031e" color="white" id="caja1" colspan="3" ></td>'+
  '</tr>'+
 '<tr   height="70px">'+
    '<th class="th-yw4l" color="white" colspan="3"><center><img src="'+
	  flights[t]['aviones'] + '" width="80%" ></center></th>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3"><center>'+
	  flights[t]['operators'] + '</center></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Flight No.<br><b>' + flights[t]['callsign_vuelo'] +  '</b></td>'+
    '<td class="tg-yw4l">Aircraft<br><b>' + flights[t]['plane_type'] + '</b></td>'+
    '<td class="tg-yw4l">Tail<br><b>' + flights[t]['aeronaveregistro'] + '</b></td>'+
  '</tr>'+
  '<tr height="15px">'+
    '<td class="tg-yw4l" colspan="2">' + flights[t]["departure"] + '<br><b>' + flights[t]["dep_name"] + ' , ' + flights[t]["dep_name_iso"] + '</b></td>'+
   '<td class="tg-yw4l">' + flights[t]["arrival"] + '<br><b>' + flights[t]["arr_name"] + ' , ' + flights[t]["arr_name_iso"] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td height="5" colspan="3"><div class="progress"><div class="' + flights[t]['bar'] + '" role="progressbar" aria-valuenow="'   + flights[t]['porcentaje'] +  '" aria-valuemin="0" aria-valuemax="100"  style="width:'   + flights[t]['porcentaje'] +  '%">'   + flights[t]['porcentaje'] +  '%</div></div></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="2"><small><font color="#B68E29">' + flights[t]['distanciar'] + ' miles</font></small></td>'+
    '<td class="tg-yw4l"><small><font color="#308414">' + flights[t]['distanciatotal'] + ' miles</font></small></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Altitude<br><b>' + flights[t]['altitude'] + 'ft</b></td>'+
    '<td class="tg-yw4l">Heading<br><b>' + flights[t]['heading'] + '°</b></td>'+
    '<td class="tg-yw4l">Speed<br><b>' + flights[t]['gs']+ ' kts</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">ETOD<br><b>' + flights[t]['etod']+ '</b></td>'+
    '<td class="tg-yw4l">ETA<br><b>' + flights[t]['eta']+ '</b></td>'+
    '<td class="tg-yw4l">STA<br><b>' + flights[t]['sta']+ '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Status<br><b>' + flights[t]['flight_status'] + '</b></td>'+
    '<td class="tg-yw4l" colspan="2">Last Update<br><b><?php date_default_timezone_set('UTC'); echo date("Y-m-d H:i:s"); ?></b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3">Pilot<br><b>' + flights[t]['nombrepiloto'] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja4" colspan="3"></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja3" colspan="3"></td>'+
  '</tr>'+
'</table>';
			
			
			
			
			
			
			
			
	
			//flights[t]['departure'] + '-' + flights[t]['arrival'] + '<br />' + flights[t]['callsign']+ ' '+flights[t]['name']+ ' '+flights[t]['surname'] + '<br />' + 'ALTITUDE: ' + flights[t]['altitude'] + '<br />' + 'GS: ' + flights[t]['gs']+ '<br />' + 'HEADING: ' + flights[t]['heading'] + '<br />' + flights[t]['flight_status'];
			$('#over_map').html("<div id='mySecondDiv' width='370px' height='100%'>"+flight_detail+"</div>");
<?
}
else if ($mobile_browser > 0) {
?>

<?
}
else {
	?>
flight_detail='<table class="tg"  width="100%" height="100%">'+

'<tr>'+
    '<th class="tg-031e"    id="caja"  colspan="3"></th>'+
  '</tr>'+
  '<tr >'+
    '<td class="tg-031e" color="white" id="caja1" colspan="3" ></td>'+
  '</tr>'+
 '<tr   height="70px">'+
    '<th class="th-yw4l" color="white" colspan="3"><center><img src="'+
	  flights[t]['aviones'] + '" width="80%" ></center></th>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3"><center>'+
	  flights[t]['operators'] + '</center></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Flight No.<br><b>' + flights[t]['callsign_vuelo'] +  '</b></td>'+
    '<td class="tg-yw4l">Aircraft<br><b>' + flights[t]['plane_type'] + '</b></td>'+
    '<td class="tg-yw4l">Tail<br><b>' + flights[t]['aeronaveregistro'] + '</b></td>'+
  '</tr>'+
  '<tr height="15px">'+
    '<td class="tg-yw4l" colspan="2">' + flights[t]["departure"] + '<br><b>' + flights[t]["dep_name"] + ' , ' + flights[t]["dep_name_iso"] + '</b></td>'+
   '<td class="tg-yw4l">' + flights[t]["arrival"] + '<br><b>' + flights[t]["arr_name"] + ' , ' + flights[t]["arr_name_iso"] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td height="5" colspan="3"><div class="progress"><div class="' + flights[t]['bar'] + '" role="progressbar" aria-valuenow="'   + flights[t]['porcentaje'] +  '" aria-valuemin="0" aria-valuemax="100"  style="width:'   + flights[t]['porcentaje'] +  '%">'   + flights[t]['porcentaje'] +  '%</div></div></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="2"><small><font color="#B68E29">' + flights[t]['distanciar'] + ' miles</font></small></td>'+
    '<td class="tg-yw4l"><small><font color="#308414">' + flights[t]['distanciatotal'] + ' miles</font></small></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Altitude<br><b>' + flights[t]['altitude'] + 'ft</b></td>'+
    '<td class="tg-yw4l">Heading<br><b>' + flights[t]['heading'] + '°</b></td>'+
    '<td class="tg-yw4l">Speed<br><b>' + flights[t]['gs']+ ' kts</b></td>'+
  '</tr>'+
  '<tr>'+
   '<td class="tg-yw4l">ETOD<br><b>' + flights[t]['etod']+ '</b></td>'+
    '<td class="tg-yw4l">ETA<br><b>' + flights[t]['eta']+ '</b></td>'+
    '<td class="tg-yw4l">STA<br><b>' + flights[t]['sta']+ '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l">Status<br><b>' + flights[t]['flight_status'] + '</b></td>'+
    '<td class="tg-yw4l" colspan="2">Last Update<br><b><?php date_default_timezone_set('UTC'); echo date("Y-m-d H:i:s"); ?></b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" colspan="3">Pilot<br><b>' + flights[t]['nombrepiloto'] + '</b></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja4" colspan="3"></td>'+
  '</tr>'+
  '<tr>'+
    '<td class="tg-yw4l" id="caja3" colspan="3"></td>'+
  '</tr>'+
'</table>';
			
			
			
			
			
			
			
			
	
			//flights[t]['departure'] + '-' + flights[t]['arrival'] + '<br />' + flights[t]['callsign']+ ' '+flights[t]['name']+ ' '+flights[t]['surname'] + '<br />' + 'ALTITUDE: ' + flights[t]['altitude'] + '<br />' + 'GS: ' + flights[t]['gs']+ '<br />' + 'HEADING: ' + flights[t]['heading'] + '<br />' + flights[t]['flight_status'];
			$('#over_map').html("<div id='mySecondDiv' width='370px' height='100%'>"+flight_detail+"</div>");
<?
}  
?>
        });
		// On mouse end
		// mouse out
        google.maps.event.addListener(marker, 'mouseout', function () {
            //infowindow.close();
            this.get('line1').setVisible(false);
            this.get('line2').setVisible(false);
			this.get('icao1').setVisible(false);
			this.get('icao2').setVisible(false);
			$('#over_map').html("");
			//currentPath.setMap(null);
        });
		// mouse out end
	
		return marker;
	}
		var numflight=0
		while (numflight < flights.length )
		{
			var avionicon =new google.maps.LatLng(flights[numflight]['latitude'],flights[numflight]['longitude']);
			var m1 = createMarker(avionicon, numflight);
			m1.setMap(map);
			numflight = numflight +1;
		}
		var s=0;
		while (s < mapas.length)
		{
			s=s+1;
		}
		var infowindow = new google.maps.InfoWindow({
		  });
		google.maps.event.addListener(infowindow, 'closeclick', function() {
		$('#over_map').html("");
		});
		
      }
	  
	
	            setInterval(function() {
                  window.location.reload();
                }, 30000); 
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAse6CjTQffTPy_k4oYaUj34d1A7py3rUQ&callback=initMap">
    </script>
	
  </body>
</html>