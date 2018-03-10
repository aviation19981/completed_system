
       <?php
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$contador=0;
	$sql = "select route_id,departure,arrival from routes where  operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	while ($row = $result->fetch_assoc()) {
		$contador++;
		$departure = $row["departure"];
		$arrival = $row["arrival"];
		$route_id = $row["route_id"];
		
		///////////////////////////////////////////////////
		
				
$sql3 = "SELECT * FROM airports  where ident='$departure'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

	}



$sql4 = "SELECT * FROM airports  where ident='$arrival'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row4 = $result4->fetch_assoc()) {

		$latitude_deg_arr = $row4['latitude_deg'];

		$longitude_deg_arr = $row4['longitude_deg'];

	}


    $km = 111.302;
$nms = 0.539957;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorad = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodeg = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlong = ($longitude_deg_loc - $longitude_deg_arr); 
    $dvalue = (sin($latitude_deg_loc * $degtorad) * sin(
$latitude_deg_arr * $degtorad)) + (cos($latitude_deg_loc * $degtorad) * cos(
$latitude_deg_arr * $degtorad) * cos($dlong * $degtorad)); 
    $dd = acos($dvalue) * $radtodeg; 
    $kms = round(($dd * $km), 2);

			
			
     $distnm = round($kms*$nms);
	 
	 ////////////////////////////
	 
	 
	 
	 $sql1 = "update routes set distance='$distnm'  where route_id=$route_id";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	}
	
	
	
			
		
		
	   ?>
	   
	   
<script>   
	   
alert('<?php echo $contador; ?> Rutas distancia actualizada satisfactoriamente.');
window.location = './?page=rutasva';
 
</script>



