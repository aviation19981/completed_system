
<?php
include ('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	//  Get count number of pilots
	$sql = "select count(*) num_pilots from gvausers where activation=1";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_pilots = $row["num_pilots"];
	

	}
	//  Get count number of planes
	$sql = "select count(*) num_planes from fleets ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_planes = $row["num_planes"];
	}
	//  Get count number of routes
	$sql = "select count(*) num_routes from routes ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_routes = $row["num_routes"];
	}
	
	
	//  Get count number of hubs
	$sql = "select count(*) num_hubs from hubs ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$num_hubs = $row["num_hubs"];
	}
	
	// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps from cstpireps";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowee = $resultee->fetch_assoc()) {

		$num_pireps = $rowee["numpireps"];

	}
	
	
	// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse from cstpireps where charter=1";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowees = $resultees->fetch_assoc()) {

		$charterspireps = $rowees["numpirepse"];

	}	
	
	
	// Vuelos CST Tour
	
	$sqleesa = "select count(callsign) numtoursva from cstpireps where charter=2";

	if (!$resulteesa = $db->query($sqleesa)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarioseesa = $resulteesa->fetch_assoc()) {

		$tourspirepsfull = $rowusuarioseesa["numtoursva"];

	}	
	
	// Vuelos IVAO Tour
	
	$sqltourivao = "select count(callsign) numtoursva from cstpireps where charter=3";

	if (!$resultivao = $db->query($sqltourivao)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowivao = $resultivao->fetch_assoc()) {

		$ivaopirepsfull = $rowivao["numtoursva"];

	}	
	
	$icao_va = array();
	$sql_operator_global_first ="select * from operators order by operator asc";

	if (!$result_operator_global_first = $db->query($sql_operator_global_first)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_first = $result_operator_global_first->fetch_assoc()) {
		$icao_va[]= $row_operator_first["callsign"];
	}
	

	
$vuelosactivos = 0;
$filecontentse = file_get_contents_curl('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$row_pca = explode("\n", $filecontentse);
foreach ($row_pca as $row_va) {

	$system = explode(":", $row_va);
	$callsign = $system[0];
	$vid = $system[1];
	$aeronave = substr($system[9], 2, 4);	
	$callsignivaos = substr($system[0],0,3);
	$sqlpilot = "select * from gvausers where ivaovid='$vid'";
	if (!$resultpilot = $db->query($sqlpilot)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowpilot = $resultpilot->fetch_assoc()) {
		if ($system[3] =="PILOT" && in_array($callsignivaos,$icao_va)) {
		$vuelosactivos++;
		}
	}

}



	
?>