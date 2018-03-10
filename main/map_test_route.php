<?php
    
	include('./db_login.php');
    $departure = $_GET['departure'];
	$arrival = $_GET['arrival'];
    $route_flight = "SKBO BOG SOA ABL VASIL FELIX RGN";
	
	/* Connect to Database */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
		
		$sql = "select *  from airports where ident='$departure'";

		if (!$result = $db->query($sql)) {
			die('There was an error running the query  [' . $db->error . ']');
		}

		while ($row = $result->fetch_assoc()) {
			$fromlat  = $row['latitude_deg'];
			$fromlng  = $row['longitude_deg'];
		}
		
		

		
		
		// Remove any SID/STAR text
        $route_string = str_replace('SID', '', $route_flight);
        $route_string = str_replace('STAR', '', $route_flight);
        $route_string = str_replace('DCT', '', $route_flight);
        $navpoints = array();
        $all_points = explode(' ', $route_string);
        foreach ($all_points as $key => $value) {
            if (empty($value) === true) {
                continue;
            }
            $navpoints[] = strtoupper(trim($value));
        }
		$allpoints = array();
        $total = count($navpoints);
		
		echo $departure;
		echo $arrival;
		echo $allpoints[0];
		

?>