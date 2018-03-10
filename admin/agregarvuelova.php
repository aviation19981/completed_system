
       <?php
	   
	   		include('./db_login.php');
			
	   $flight = $_POST["flight"];
		$departure=  $_POST["departure"];
		$arrival= $_POST["arrival"];
		$alternative= $_POST["alternative"];
		$etd= $_POST["etd"] ;
		$eta= $_POST["eta"];
		
		
		$pax_price= $_POST["pax_price"];
		$flproute= $_POST["flproute"];
		$comments= $_POST["comments"];
		$operator_ids= $_POST["operator_id"];
		
		$flighttype_ids= $_POST["flighttype_id"];
		$cargo_price= $_POST["cargo_price"];
	   $aeronaves= $_POST["aeronaves"];
	   $altitude= $_POST["altitude"];

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
	
			
	
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

                        

                        $dist = $kms;
			$speed = 440;
			$app = $speed / 60 ;



     $distnm = round($kms*$nms);

$flttime = ($distnm / $app)+ 20;
			$hours = ($flttime / 60);
$time = $hours;
		
		
		
		
		$sql1 = "insert into routes (flight,departure,arrival,alternative,etd,eta,pax_price,flproute,comments,operator_id,flighttype_id,duration,cargo_price,altitude,distance)                    
						values ('$flight','$departure','$arrival','$alternative','$etd','$eta','$pax_price','$flproute','$comments'
						,'$operator_ids','$flighttype_ids','$time','$cargo_price','$altitude','$distnm');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
  
$sql4 = "SELECT * FROM routes  where flight='$flight' and departure='$departure' and  arrival='$arrival' and alternative='$alternative' and  
			operator_id='$operator_ids' and  flighttype_id='$flighttype_ids' and altitude='$altitude' and distance='$distnm' and etd='$etd'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row4 = $result4->fetch_assoc()) {

		$route_id = $row4['route_id'];

	}

		
		for ($i=0;$i<count($aeronaves);$i++)    
        {     
	
		
		$sql1 = "insert into fleettypes_routes (route_id,fleettype_id,fleet_id)                    
						values ('$route_id','$aeronaves[$i]','0');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
        } 
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Vuelo agregado satisfactoriamente.');
window.location = './?page=rutasva';
 
</script>



