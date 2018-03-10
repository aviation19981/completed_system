
<?php
	include('./db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	date_default_timezone_set('America/Bogota');
	
	
	    // ESTADO 0 Logeado
		// ESTADO 1 Perdido Teorico
		// ESTADO 2 Ganado Teorico
		// ESTADO 3 Perdido Practico
		// ESTADO 4 Ganado Practico INGRESO
		// ESTADO 5 Archivado Perdido
		// ESTADO 6 Archivado Ganado
		// ESTADO 7 Archivado No Presentado
		
	
	
	
	    $sqllog = "update presentacionexamen set estado='7' where estado=0 and HOUR(timediff(now(),fecha))>=720";

		if (!$result = $db->query($sqllog)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sqllog2 = "update presentacionexamen set estado='5' where estado=1 and HOUR(timediff(now(),fecha))>=720";

		if (!$result2 = $db->query($sqllog2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sqllog3 = "update presentacionexamen set estado='5' where estado=2 and HOUR(timediff(now(),fecha))>=720";

		if (!$result3 = $db->query($sqllog3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sqllog4 = "update presentacionexamen set estado='5' where estado=3 and HOUR(timediff(now(),fecha))>=720";

		if (!$result4 = $db->query($sqllog4)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sqllog5 = "update presentacionexamen set estado='6' where estado=4 and HOUR(timediff(now(),fecha))>=720";

		if (!$result5 = $db->query($sqllog5)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
	//$sqllog = "delete  from presentacionexamen where estado=0 and HOUR(timediff(now(),fecha))>=720";

	//if (!$resultlog = $db->query($sqllog)) {
          //die('There was an error running the query  [' . $db->error . ']');
	//}
	
	//$sqllost = "delete  from presentacionexamen where estado=1 and HOUR(timediff(now(),fecha))>=720";

	//if (!$resultlost = $db->query($sqllost)) {
		//die('There was an error running the query  [' . $db->error . ']');
	//}
	
	//$sqllost2 = "delete  from presentacionexamen where estado=3 and HOUR(timediff(now(),fecha))>=720";

	//if (!$resultlost2 = $db->query($sqllost2)) {
		//die('There was an error running the query  [' . $db->error . ']');
	//}
	
	//$sqllost3 = "delete  from presentacionexamen where estado=2 and HOUR(timediff(now(),fecha))>=1440";

	//if (!$resultlost3 = $db->query($sqllost3)) {
		//die('There was an error running the query  [' . $db->error . ']');
	//}
	
?>

