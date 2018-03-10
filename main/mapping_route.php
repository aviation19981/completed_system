<?php
    //error_reporting(E_ALL);
    //ini_set('display_errors', '1');
    include('./db_login.php');
    $db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	
	$nat_pattern = '/^([0-9]+)([A-Za-z]+)/';
	

	global $db, $nat_pattern;
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
	
    $airways = getAirways($navpoints);	
	
		
	
	
	
        for($i = 0; $i < $total; $i++)
		{
			$name = cleanName($navpoints[$i]);
			/*	the current point is an airway, so go through 
				the airway list and add each corresponding point
				between the entry and exit to the list. */
			if(isset($airways[$name]))
			{
				$entry_name = cleanName($navpoints[$i-1]);
				$exit_name = cleanName($navpoints[$i+1]);
				
				$entry = getPointIndex($entry_name, $airways[$name]);
				$exit = getPointIndex($exit_name, $airways[$name]);
								
				if($entry == -1)
				{
					$entry = $exit;
				}
				else
				{
					/*	Add information abotu the entry point in first,
						if it's valid and exists */
					$allpoints[$entry_name] = $airways[$name][$entry];
				}
				
				if($exit == -1)
				{
					continue;
				}
				
				if($entry < $exit)
				{
					# Go forwards through the list adding each one
					for($l=$entry; $l<=$exit; $l++)
					{
						$allpoints[$airways[$name][$l]->name] = $airways[$name][$l];
					}
				}
				elseif($entry > $exit)
				{
					# Go backwards through the list
					for($l=$exit; $l>=$entry; $l--)
					{
						$point_name = cleanName($airways[$name][$l]->name);
						$allpoints[$point_name] = $airways[$name][$l];
					}
				}
				elseif($entry == $exit)
				{
					$point_name = cleanName($airways[$name][$l]->name);
					$allpoints[$point_name] = $airways[$name][$entry];
				}
				
				# Now add the exit point, and increment the main counter by one
				if($exit > -1)
				{
					$allpoints[$exit_name] = $airways[$name][$exit];
				}
				
				continue;
			}
			else
			{
				/* This nav point already exists in the list, don't add it
					again */
				if(isset($allpoints[$navpoints[$i]]))
				{
					continue;
				}
				
				/*	Means it is a track, so go into processing it 
					See if it's something like XXXX/YYYY
				 */
				if(substr_count($navpoints[$i], '/') > 0)
				{
					$name = $navpoints[$i];
					$point_name = explode('/', $name);
					
					preg_match($nat_pattern, $point_name[0], $matches);
					
					$coord = $matches[1];
					$lat = $matches[2].$coord[0].$coord[1].'.'.$coord[2].$coord[3];
					
					/*	Match the second set of coordinates */
					
					# Read the second set
					preg_match($nat_pattern, $point_name[1], $matches);
					if($matches == 0)
					{
						continue;
					}
					
					$coord = $matches[1];
					$lng = $matches[2].$coord[0].$coord[1].$coord[2].'.'.$coord[3];
					
					/*	Now convert into decimal coordinates */
					$coords = $lat.' '.$lng;
					$coords = get_coordinates($coords);
					
					if(empty($coords['lat']) || empty($coords['lng']))
					{
						unset($allpoints[$navpoints[$i]]);
						continue;
					}
					
					$tmp =  array();
					$tmp['id'] = 0;
					$tmp['Route_FixName'] = $name;
					$tmp['Route_FixName'] = $name;
					$tmp['Route_FixLat'] = $coords['Route_FixLat'];
					$tmp['Route_FixLon'] = $coords['Route_FixLon'];
					$tmp['Route_Name'] = '';
					
					$allpoints[$navpoints[$i]] = $tmp;					
					unset($point_name);
					unset($matches);
					unset($tmp);
				}
				else
				{
					$allpoints[$navpoints[$i]] = $navpoints[$i];
					$navpoint_list[] = $navpoints[$i];
				}
			}
		}
		
		
		
		
		
		$navpoint_list_details = getNavDetails($navpoint_list);
		
		foreach($navpoint_list_details as $point => $list)
		{
			$allpoints[$point] = $list;
		}
		
		unset($navpoint_list_details);
		
		/*	How will this work - loop through each point, and
			decide which one we'll use, determined by the
			one which is the shortest distance from the previous 
			
			Go in the order of the ones passed in.
		*/
		
		foreach($allpoints as $point_name => $point_details)
		{
			if(is_string($point_details))
			{
				unset($allpoints[$point_name]);
				continue;
			}
			
			if(!is_array($point_details))
			{
				continue;
			}
			
			$results_count = count($point_details);
			
			if($results_count == 1)
			{
				$allpoints[$point_name] = $point_details[0];
			}
			elseif($results_count > 1)
			{
				/* There is more than one, so find the one with the shortest
					distance from the previous point out of all the ones */
			
				$index = 0; $dist = 0;
				
				/* Set the inital settings */
				$lowest_index = 0;
				$lowest = $point_details[$lowest_index];
				$lowest_dist = distanceBetweenPoints($fromlat, $fromlng, $lowest['Route_FixLat'], $lowest['Route_FixLon']);
				
				foreach($point_details as $p)
				{
					$dist = distanceBetweenPoints($fromlat, $fromlng, $p['Route_FixLat'], $p['Route_FixLon']);
					
					if($dist < $lowest_dist)
					{
						$lowest_index = $index;
						$lowest_dist = $dist;
					}
					
					$index++;
				}
				
				 $allpoints[$point_name] = $point_details[$lowest_index];
			}
			
			 $fromlat = $allpoints[$point_name]['Route_FixLat'];
			 $fromlng = $allpoints[$point_name]['Route_FixLon'];
			 $allpoints[] = $fromlat;
			 $allpoints[] = $fromlng;
			
		
		}
		
		
		
	    
	
	
	

   function getAirways($list)
	{
		global $db;
		foreach($list as $key => $value)
		{
			$list[$key] = $value;
		}
		
		$in_clause = $list;  
		
		
		
	    $sql_airways = "SELECT * FROM RoutesAIRAC WHERE Route_Name IN (" . implode(',', array_map('intval', $in_clause)) . ")";
		
		if (!$result_airways = $db->query($sql_airways)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
		$list = array();
		while ($row_airways = $result_airways->fetch_assoc()) {
			 $list[] = $row_airways['Route_Name'];
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
	
	
	
	
	function get_coordinates($line)
	{
		/* Get the lat/long */
		preg_match('/^([A-Za-z])(\d*).(\d*.\d*).([A-Za-z])(\d*).(\d*.\d*)/', $line, $coords);
		
		$lat_dir = $coords[1];
		$lat_deg = $coords[2];
		$lat_min = $coords[3];
		
		$lng_dir = $coords[4];
		$lng_deg = $coords[5];
		$lng_min = $coords[6];
		
		$lat_deg = ($lat_deg*1.0) + ($lat_min/60.0);
		$lng_deg = ($lng_deg*1.0) + ($lng_min/60.0);
		
		if(strtolower($lat_dir) == 's')
			$lat_deg = '-'.$lat_deg;
		
		if(strtolower($lng_dir) == 'w')
			$lng_deg = $lng_deg*-1;
		
		/* Return container */
		$coords = array(
			'Route_FixLat' => $lat_deg,
			'Route_FixLon' => $lng_deg
		);
		
		return $coords;
	}
	
	
	function getPointIndex($point_name, $list)
	{
		$total = count($list);
		
		for($i=0; $i<$total; $i++)
		{
			if($list[$i]->Route_FixName == $point_name)
			{
				return $i;
			}
		}
		
		return -1;
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
	
	
	
	
	
	
	
	
	
	
	
		
	
	function getNavDetails($navpoints)
	{
		
		global $db,$nat_pattern;
		/*	Form an IN clause so we can easily grab all the points
			which we have cached locally in the navdata table
			
			Check if an array was passed, or a string of points */
		if(is_array($navpoints) && count($navpoints) > 0)
		{
			$in_clause = array();
			foreach($navpoints as $point)
			{
				// There's already data about it
				if(is_array($point) || is_object($point))
				{
					continue;
				}
				
				$in_clause[] = $point;
			}
			
			$in_clause = $in_clause;
		}
		else
		{
			# Add commas in between, since it's space separated
			$navpoints = str_replace(' ', ', ', $navpoints);
			$in_clause = $navpoints;
		}
		
		
		$sql_navdata = 'SELECT * FROM RoutesAIRAC
				WHERE Route_FixName IN  (' . implode(',', array_map('intval', $in_clause)) . ')
				GROUP BY Route_FixLat';
       
		if (!$result_navdata = $db->query($sql_navdata)) {
			die('There was an error running the query  [' . $db->error . ']');
		}
		while ($row_navdata = $result_navdata->fetch_assoc()) {
			 $results[] = array('Route_Name' => $row_navdata['Route_Name'], 'Route_FixName' => $row_navdata['Route_FixName'], 'Route_FixLat' => $row_navdata['Route_FixLat'], 'Route_FixLon' => $row_navdata['Route_FixLon']);
		}
		
		if(!$results)
		{
			return array();
		}
		
		$return_results = array();
		foreach($results as $key => $point)
		{	
			if(empty($point->Route_Name))
			{
				$point->Route_Name = $point->Route_Name;
			}
			
			$return_results[$point->Route_Name][] = $point;
		}
		
		return $return_results;
		
		/* Means nothing was returned locally */
		/*if(!$results)
		{
			return navDetailsFromServer($navpoints);
		}
		else
		{*/
			/*	Form an array of what to return from the server,
				see what we did and didn't return */
			$notfound = array();
			$point_array = array();
			foreach($results as $row)
			{
				/*	Find all instances of the navpoint in what was
					returned, and then remove it. In the end, only the
					ones which haven't been returned  are left in the 
					array */
				$keys = array_keys($navpoints, $row->Route_Name);
				foreach($keys as $k) 
				{
					unset($navpoints[$k]);
				}
				
				if($row->Route_FixLat == 0 || $row->Route_FixLon == 0)
				{
					continue;
				}
				
				$point_array[$row->Route_Name][] = $row;
			}
			
			
		return $point_array;
	}
	
	
	
	
	
	
	
	

	
?>
