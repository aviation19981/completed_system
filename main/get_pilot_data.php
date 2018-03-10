

<?php

include('./db_login.php');
session_start();
$id = $_SESSION['id'];

	


	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sqluser = "SELECT * FROM gvausers where gvauser_id='$id'";

	if (!$resultuser = $db->query($sqluser)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $resultuser->fetch_assoc()) {

		$user_type = $rowusuarios['user_type_id'];

		$pilotname = $rowusuarios['name'];

		$pilotsurname = $rowusuarios['surname'];

		$callsign = $rowusuarios['callsign'];

		$id = $rowusuarios['gvauser_id'];

		$location = $rowusuarios['location'];

		$usertype = $rowusuarios['user_type_id'];

		$hub_id = $rowusuarios['hub_id'];
		
		$operator_id = $rowusuarios['operator_id'];

		$register_date = $rowusuarios['register_date'];

		$rank_id = $rowusuarios['rank_id'];

		$email = $rowusuarios['email'];

		$ivaovid = $rowusuarios['ivaovid'];
		
		$country = $rowusuarios['country'];

		$city = $rowusuarios['city'];

		$transfered_hours = $rowusuarios['transfered_hours'];
		
		$activation = $rowusuarios['activation'];

		//$pilot_image = './img/uploads/'.$rowusuarios['pilot_image'];

		
		
		$ruta_img = './images/uploads/'.$rowusuarios['pilot_image'];
    if(empty($rowusuarios['pilot_image'])) {
		
 $pilot_image = "./images/uploads/pilot_default.png";
	} else {
    if(file_exists($ruta_img)) // Debo saber si existe esta foto 
    { 
        $pilot_image = $ruta_img; 
    } 
    else 
    {  
        $pilot_image = "./images/uploads/pilot_default.png";
        // Si no existiera la imagen, ya tengo en mi servidor una foto llamada algo así como "photo_unavailable.jpg". 
    } 
	}
	
	}



	// Get Hub info details

	$sql = "SELECT * FROM airports a INNER  JOIN hubs h on a.ident = h.hub where hub_id='$hub_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {
		
		$hub_airports = $rowusuarios['hub'];

		$hub_airport_name = $rowusuarios['name'];

		$hub_airport_flag = $rowusuarios['iso_country'];

	}



	// Get Location info details

	$sql = "SELECT * FROM airports  where ident='$location'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$location_airport_name = $rowusuarios['name'];

		$location_airport_flag = $rowusuarios['iso_country'];

	}















	

	$sql = "select * from va_parameters ";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$no_count_rejected = $rowusuarios["no_count_rejected"];		

	}





	$gva_hourse=0;
	
	
	$sqlhours = "select * from cstpireps where gvauser_id='$id'";

	if (!$resulthours = $db->query($sqlhours)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarioshours = $resulthours->fetch_assoc()) {

	 
		$gva_hourse = $gva_hourse+$rowusuarioshours["connection_time"];		

	}
	
	
	
	
	
	
$sumas= $gva_hourse+$transfered_hours;
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$gva_hours= $horas.' h '.$minutos . ' m';

	

// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps from cstpireps where gvauser_id='$id'";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosee = $resultee->fetch_assoc()) {

		$num_pireps = $rowusuariosee["numpireps"];

	}
	

// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse from cstpireps where gvauser_id='$id' and charter=1";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosees = $resultees->fetch_assoc()) {

		$charterspireps = $rowusuariosees["numpirepse"];

	}	
	
	
	// Vuelos Tour
	
	$sqleesa = "select count(callsign) numtoursva from cstpireps where gvauser_id='$id' and charter=2";

	if (!$resulteesa = $db->query($sqleesa)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarioseesa = $resulteesa->fetch_assoc()) {

		$tourspireps = $rowusuarioseesa["numtoursva"];

	}	
	
	
	// Vuelos IVAO Tour
	
	$sqltourivao = "select count(callsign) ivaotourspireps from cstpireps where gvauser_id='$id' and charter=3";

	if (!$resultivao = $db->query($sqltourivao)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowivao = $resultivao->fetch_assoc()) {

		$ivaotourspireps = $rowivao["ivaotourspireps"];

	}	
	

	//  Get plane certifications

	$sql = "select DISTINCT plane_description, plane_icao from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' order by plane_icao asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	$planes = '';

	$planes_certificated = array();

	$i = 0;

	while ($rowusuarios = $result->fetch_assoc()) {

		$planes .= $rowusuarios["plane_description"] . '</br>';

		$planes_certificated[$i] = $rowusuarios["plane_description"];

		$i++;

	}

	// Get hub

	$hub = '';

	$sql = "select hub from hubs where hub_id='$hub_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$hub = $rowusuarios["hub"];

	}
	
	// Get operador

	$hub = '';

	$sql = "select * from operators where operator_id='$operator_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$operator_ids= $rowusuarios["operator_id"];
        $name_operators= $rowusuarios["operator"];
		$imgs = $rowusuarios["file"];
		$ceo = $rowusuarios["ceo"];
		$hub_principal = $rowusuarios["hub_principal"];
		$descripcion1 = $rowusuarios["parrafo_primero"];
		$imagen_va = $rowusuarios["imagen_aerolinea"];
        $facebook_url = $rowusuarios["facebook"];
		$whatsapp_url = $rowusuarios["whatsapp"];
	}
	
	
	$sql_ranks ="select * from ranks order by maximum_hours desc limit 1";

	if (!$result_ranks = $db->query($sql_ranks)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_ranks = $result_ranks->fetch_assoc()) {
	
	$maximum_hours_last = $row_ranks["maximum_hours"];
	$minimum_hours_last = $row_ranks["minimum_hours"];
	
	
	}

	// Get Rank

	$rank = '';

	$salary_hour = '';

	$sql = "select * from ranks where rank_id='$rank_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$rank = $rowusuarios["rank"];

		$salary_hour = $rowusuarios["salary_hour"];

		$rank_url_image = $rowusuarios["img"];
		
		if($maximum_hours_last==$rowusuarios["maximum_hours"] && $minimum_hours_last ==$rowusuarios["minimum_hours"]) {
			
			$maximum_hours = $rowusuarios["minimum_hours"];
			
		} else {
		
		$minimum_hours = $rowusuarios["minimum_hours"];
		
		$maximum_hours = $rowusuarios["maximum_hours"];
		}
		
		
		
	}

	// Get Country

	$sql = "select * from country_t where iso2='$country'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$country = $rowusuarios["short_name"];

		$country_flag = $rowusuarios["iso2"];

	}

	// Get VA  parameters

	$sql = "select * from va_parameters";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$currency = $rowusuarios["currency"];

	}

	

	$sql = "select format(sum(quantity),2) money from bank where gvauser_id='$id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$money = $rowusuarios["money"];

	}
	



?>

