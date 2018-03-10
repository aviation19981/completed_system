
<?php
require('./db_login.php');
	require('./check_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$newlocation = $_POST['destino'];
	
	$sql = "select location from gvausers where gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$fromlocation = $row["location"];
	}
	
	$sql3 = "SELECT * FROM airports  where ident='$fromlocation'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

	}


$sql4 = "SELECT * FROM airports  where ident='$newlocation'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	while ($row4 = $result4->fetch_assoc()) {

		$latitude_deg_arr = $row4['latitude_deg'];

		$longitude_deg_arr = $row4['longitude_deg'];

	}

   $km = 111.302;
    
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

	
	
	
	// DATOS PRECIO POR KMS
	
	$sqlticket = "SELECT ticket FROM va_parameters  where va_parameters_id='1'";

	if (!$resultticket = $db->query($sqlticket)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	
	while ($rowticket = $resultticket->fetch_assoc()) {

		$ticket = $rowticket['ticket'];

	}
	
	$valortiquete = round($kms*$ticket);

			$jump_type1 = -1 * $valortiquete;
			
			
			
	$sql = "update gvausers set location='$newlocation',route_id=0 where gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$sql = "INSERT INTO jumps (date,gvauser_id,callsign,from_airport,to_airport,paid,value) values (now(),$id,'$callsign','$fromlocation','$newlocation',1,'$jump_type1')";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$sql2 = "insert into bank (gvauser_id,date,quantity,jump) values ($id,now(),$jump_type1,'Compra de Tiquete $fromlocation - $newlocation')";
	if (!$result = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
	$sql = "delete from reserves where gvauser_id=$id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

	
	
	$db->close();


echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index_user.php?page=intranet">';

?>
