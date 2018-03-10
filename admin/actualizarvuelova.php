
       <?php
	   
	   		include('./db_login.php');
			
	   $route_id=$_POST["route_id"];
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
		$duration= $_POST["duration"];
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
		
			 
			
			
			
			$sql1 = "update routes set flight='$flight', departure='$departure',  arrival='$arrival',  
			alternative='$alternative',  etd='$etd',  eta='$eta',  pax_price='$pax_price',  flproute='$flproute'
,  comments='$comments',  operator_id='$operator_ids',  flighttype_id='$flighttype_ids',  duration='$time',  cargo_price='$cargo_price', altitude='$altitude',  distance='$distnm'	where route_id='$route_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		 $sql12 = "delete from fleettypes_routes where route_id='$route_id'";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
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
	   
alert('Vuelo actualizado satisfactoriamente.');
window.location = './?page=updatevuelova&vuelo=<?php echo $route_id; ?>';
 
</script>



