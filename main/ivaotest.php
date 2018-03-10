<?php
include ('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}


	
	$icao_va = array();
	$sql_operator_global_first ="select * from operators order by operator asc";

	if (!$result_operator_global_first = $db->query($sql_operator_global_first)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_first = $result_operator_global_first->fetch_assoc()) {
		$icao_va[]= $row_operator_first["callsign"];
	}
	
if (ini_get("allow_url_fopen") == 1) {
	
	$vuelosactivos = 0;
$filecontentse = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
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
		if ($system[3] =="PILOT" && in_array($callsignivaos, $icao_va)) {
		$vuelosactivos++;
		}
	}

}

$serveranswer =  "El servidor se encuentra funcionando :: IVAO :: " . $vuelosactivos . " vuelo(s) de ColStar Alliance || The server is online :: IVAO " . $vuelosactivos . " flight(s) of ColStar Alliance ";
echo '<div class="alert bg--success">
                                <div class="alert__body">
                                    <span>' . $serveranswer  . ' </span>
                                </div>
                            </div>';  

} else {
$serveranswer =  "El servidor se encuentra cerrado | IVAO :: Contactar al Staff || The server is offline | IVAO :: Contact to the Staff";
echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . $serveranswer  . ' </span>
                                </div>
                            </div>';  
}	
	




	
?>