
<?php
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "SELECT * FROM gvausers where gvauser_id='$pilotID'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$user_type = $row['user_type_id'];
		$pilotname = $row['name'];
		$pilotsurname = $row['surname'];
		$callsign = $row['callsign'];
		$id = $row['gvauser_id'];
		$location = $row['location'];
		$usertype = $row['user_type_id'];
		$hub_id = $row['hub_id'];
		$hub = $row['hub_id'];
		$ivaovid = $row['ivaovid'];
		$operador_id = $row['operator_id'];
		$register_date = $row['register_date'];
		$rank_id = $row['rank_id'];
		$email = $row['email'];
		$country = $row['country'];
		$city = $row['city'];
		$transfered_hours = $row['transfered_hours'];
		$activation = $row['activation'];
	
	$ruta_img = './images/uploads/'.$row['pilot_image'];
    if(empty($row['pilot_image'])) {
		
 $ruta_foto = "./images/uploads/pilot_default.png";
	} else {
    if(file_exists($ruta_img)) // Debo saber si existe esta foto 
    { 
        $ruta_foto = $ruta_img; 
    } 
    else 
    {  
        $ruta_foto = "./images/uploads/pilot_default.png";
        // Si no existiera la imagen, ya tengo en mi servidor una foto llamada algo así como "photo_unavailable.jpg". 
    } 
	}
	
	}
	
	

	

	// Get Hub info details

	$sql = "SELECT * FROM airports a INNER  JOIN hubs h on a.ident = h.hub where hub_id=$hub_id";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		
		$hub_airports = $row['hub'];

		$hub_airport_name = $row['name'];

		$hub_airport_flag = $row['iso_country'];

	}



	// Get Location info details

	$sql = "SELECT * FROM airports  where ident='$location'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {

		$location_airport_name = $row['name'];

		$location_airport_flag = $row['iso_country'];

	}
	
	

	
	
	
	

// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps from cstpireps where gvauser_id='$pilotID'";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosee = $resultee->fetch_assoc()) {

		$num_pireps = $rowusuariosee["numpireps"];

	}
	

// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse from cstpireps where gvauser_id='$pilotID' and charter=1";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosees = $resultees->fetch_assoc()) {

		$charterspireps = $rowusuariosees["numpirepse"];

	}	
	
	
	// Vuelos Tour
	
	$sqleesa = "select count(callsign) numtoursva from cstpireps where gvauser_id='$pilotID' and charter=2";

	if (!$resulteesa = $db->query($sqleesa)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarioseesa = $resulteesa->fetch_assoc()) {

		$tourspireps = $rowusuarioseesa["numtoursva"];

	}	
	
	
	// Vuelos IVAO Tour
	
	$sqltourivao = "select count(callsign) ivaotourspireps from cstpireps where gvauser_id='$pilotID' and charter=3";

	if (!$resultivao = $db->query($sqltourivao)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowivao = $resultivao->fetch_assoc()) {

		$ivaotourspireps = $rowivao["ivaotourspireps"];

	}	
	
	


	
	
	
	$horasvuelo= 0;
	
	$sql_pcas = "select * from cstpireps where gvauser_id='$pilotID'"; 
if (!$result_pcas = $db->query($sql_pcas)) {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row_pcas = $result_pcas->fetch_assoc()) {
	$horasvuelo=$horasvuelo+$row_pcas["connection_time"];
	}
	
	
	
														$sumas= $horasvuelo+$transfered_hours;
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$gva_hours= $horas.' h '.$minutos . ' m';
	
	$money =0;
	$sql = "select format(sum(quantity),2) money from bank where gvauser_id=$pilotID";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$money = $row["money"];
	}
	
	//  Get plane certifications
	$sql = "select DISTINCT plane_icao, plane_description from fleettypes_gvausers fgva, fleettypes ft where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id=$pilotID order by plane_icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$planes = '';
	$planes_certificated = array();
	$i = 0;
	while ($row = $result->fetch_assoc()) {
		$planes .= $row["plane_description"] . '</br>';
		$planes_certificated[$i] = $row["plane_description"];
		$i++;
	}
	// Get hub
	$sql = "select hub from hubs where hub_id=$hub_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$hub = $row["hub"];
	}
	
	// Get operador
	$sql = "select operator from operators where operator_id=$operador_id";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$operator = $row["operator"];
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
	while ($row = $result->fetch_assoc()) {
		$country = $row["short_name"];
		$country_flag = $row["iso2"];
	}
	// Get VA  parameters
	$sql = "select * from va_parameters";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$currency = $row["currency"];
	}
	

	

?>
