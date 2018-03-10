<?php
    
	include('./mapping_route.php');
	$route_string = $_GET['route_string'];
	$routeairport = $_GET['routeairport'];
	$allpoints = parseRoute($route_string,$routeairport);
		
 
?>