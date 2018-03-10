
<?php
	include('./db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sqlpilot = "select * from gvausers";
	if (!$resultpilot = $db->query($sqlpilot)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowpilot = $resultpilot->fetch_assoc()) {
		$transfered_hourspilot =0;
	$rank_idpilot =0;
	$ivaovidpilot =0;
	$pilot_id =0;
    $gva_hoursepilot=0;
	$sumahoras=0;
	$horastotalesvuelo=0;
	$rank_idnew =0;
	$operator_id_rank =0;
		// OBTENIENDO HORAS Y RANGO
		$transfered_hourspilot = $rowpilot['transfered_hours'];
		$rank_idpilot = $rowpilot['rank_id'];
		$ivaovidpilot = $rowpilot['ivaovid'];
		$pilot_id = $rowpilot['gvauser_id'];
		$operator_id_rank = $rowpilot['operator_id'];
		// HORAS PIREPS CST
		
		$sqlhourspilot = "select * from cstpireps where vid='$ivaovidpilot'";

	if (!$resulthourspilot = $db->query($sqlhourspilot)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowhourspilot = $resulthourspilot->fetch_assoc()) {

	 
		$gva_hoursepilot = $gva_hoursepilot+$rowhourspilot["connection_time"];		

	}
	
	// SUMAR HORAS VUELOS
	$sumahoras = $transfered_hourspilot+$gva_hoursepilot;
	$horastotalesvuelo = round($sumahoras,2);
	
	// OBTENER RANGO QUE CORRESPONDE
	
	
	$sqlrank = "select * from ranks where operator_id='$operator_id_rank'";

	if (!$resultrank = $db->query($sqlrank)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank = $resultrank->fetch_assoc()) {
		if(($horastotalesvuelo>=$rowrank["minimum_hours"])  && ($horastotalesvuelo<=$rowrank["maximum_hours"])) {
			$rank_idnew = $rowrank["rank_id"];
		}
	}
	
	
	
	if($rank_idpilot<>$rank_idnew) {
	
	//////////////////////////////////////////////////// VALIDAR SI ESE RANGO VIEJO ESTÁ AL TOPE REQUIERE EXAMENES /////////////////////////////////////////
	
	
	
	$sqltest = "select * from courses inner join ranktypes_course where courses.course_id=ranktypes_course.course_id and ranktypes_course.rank_id='$rank_idpilot'";

	if (!$resultest = $db->query($sqltest)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowtest = $resultest->fetch_assoc()) {
	    $course_id = $rowtest['course_id'];
		$contartest=0;
		////////////////////////// SABER CUANTOS EXAMENES EXISTEN /////////////////
			$sqltest20 = "select * from config_examen where course_id='$course_id'";

	    if (!$resultest20 = $db->query($sqltest20)) {

		die('There was an error running the query [' . $db->error . ']');

	    }
		
		while ($rowtest20 = $resultest20->fetch_assoc()) {
			$contartest++;
		}
			
			///////////////////////// FIN /////////////////////////////////
		
		/////////////////////////// CONTAMOS LOS EXAMANES
		$sqltest2 = "select * from config_examen where course_id='$course_id'";

	    if (!$resultest2 = $db->query($sqltest2)) {

		die('There was an error running the query [' . $db->error . ']');

	    }
		
		while ($rowtest2 = $resultest2->fetch_assoc()) {
			
			
			
			$idexamen = $rowtest2['id'];
			$contarexamenes=0;
			//////////////// VALIDAMOS SI USUARIO PRESENTO Y GANÓ ESTE EXAMEN //////////////////
			
			$sqltest3 = "select * from training where examen='$idexamen' and gvauser_id=$pilot_id and nota>=3";

	    if (!$resultest3 = $db->query($sqltest3)) {

		die('There was an error running the query [' . $db->error . ']');

	    }
		
		while ($rowtest3 = $resultest3->fetch_assoc()) {
			$contarexamenes=$contarexamenes+1;
		}
			
			
			
			
			
			////////////////// FINALIZAR VALIDACION /////////////
			
			
		}
	
	    //////////////////////////////// FIN
	
	}
	
	
	
	///////////////////////////// SINO EXISTE EXAMENES //////////////
	
	if($contartest==0) {
		
		
		
		
		//////////////////////////////////////////////////// ACTUALIZAR RANGO ////////////////////////////////////////////////////
	
	
	$sql1 = "UPDATE gvausers set rank_id='$rank_idnew' where gvauser_id='$pilot_id'";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	// ELIMINAR AERONAVES
	
		$sqlfleets = "delete from fleettypes_gvausers where gvauser_id=$pilot_id";  

		if (!$resultfleets = $db->query($sqlfleets)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
	
	// OBTENER RANGO QUE CORRESPONDE PARA AERONAVES
	
	
	$sqlrank2= "select * from ranks where operator_id='$operator_id_rank'";

	if (!$resultrank2 = $db->query($sqlrank2)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank2 = $resultrank2->fetch_assoc()) {
		
		$minimum_hours = $rowrank2["minimum_hours"];
		
		if ($horastotalesvuelo >= $minimum_hours) {
			$rank_idnew2 = $rowrank2["rank_id"];

			
			
			// VER AERONAVES DE ESE RANGO
			
				$sqlrankfleet = "select * from fleettypes_ranks where rank_id='$rank_idnew2' and operator_id='$operator_id_rank'";

	if (!$resultrankfleet = $db->query($sqlrankfleet)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrankfleet = $resultrankfleet->fetch_assoc()) {
		
			$rowrankfleets = $rowrankfleet["fleettype_id"];
			
			
			
			// INGRESO ESAS AERONAVES 
			
			$sqlfleets2 = "insert into fleettypes_gvausers (gvauser_id,fleettype_id)
                    values ('$pilot_id','$rowrankfleets');";
				if (!$result2 = $db->query($sqlfleets2)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				// FIN		
				
				
		}

	
			
			
	
	}
		
		
	}
	
	
	
	
	
	//////////////////////////////////////////////////// FIN ACTUALIZAR RANGO ////////////////////////////////////////////////////
		
		
		
		
		
	} else { //////////////////////////////////// SI EXISTE EXAMENES
		
		
		
		if($contartest==$contarexamenes) {
		
		//////////////////////////////////////////////////// ACTUALIZAR RANGO ////////////////////////////////////////////////////
	
	
	$sql1 = "UPDATE gvausers set rank_id='$rank_idnew' where gvauser_id='$pilot_id'";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	// ELIMINAR AERONAVES
	
		$sqlfleets = "delete from fleettypes_gvausers where gvauser_id=$pilot_id";  

		if (!$resultfleets = $db->query($sqlfleets)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
	
	// OBTENER RANGO QUE CORRESPONDE PARA AERONAVES
	
	
	$sqlrank2= "select * from ranks where operator_id='$operator_id_rank'";

	if (!$resultrank2 = $db->query($sqlrank2)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank2 = $resultrank2->fetch_assoc()) {
		
		$minimum_hours = $rowrank2["minimum_hours"];
		
		if ($horastotalesvuelo >= $minimum_hours) {
			$rank_idnew2 = $rowrank2["rank_id"];

			
			
			// VER AERONAVES DE ESE RANGO
			
				$sqlrankfleet = "select * from fleettypes_ranks where rank_id='$rank_idnew2' and operator_id='$operator_id_rank'";

	if (!$resultrankfleet = $db->query($sqlrankfleet)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrankfleet = $resultrankfleet->fetch_assoc()) {
		
			$rowrankfleets = $rowrankfleet["fleettype_id"];
			
			
			
			// INGRESO ESAS AERONAVES 
			
			$sqlfleets2 = "insert into fleettypes_gvausers (gvauser_id,fleettype_id)
                    values ('$pilot_id','$rowrankfleets');";
				if (!$result2 = $db->query($sqlfleets2)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				// FIN		
				
				
		}

	
			
			
	
	}
		
		
	}
	
	
	
	
	
	//////////////////////////////////////////////////// FIN ACTUALIZAR RANGO ////////////////////////////////////////////////////
		
		
		
		
		
		
		
		
		
		}
		
		
		
		
		
		
	}
	
	
	
	
	///////////////////////////////////////////////// FIN VALIDACION EXAMENES ////////////////////////////////////////////

	
	
	
	
	
	
	
	} else {
		
		////////////////// SI EL RANGO ES EL MISMO
		
		// ELIMINAR AERONAVES
	
		$sqlfleets = "delete from fleettypes_gvausers where gvauser_id=$pilot_id";  

		if (!$resultfleets = $db->query($sqlfleets)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	
	
	// OBTENER RANGO QUE CORRESPONDE PARA AERONAVES
	
	
	$sqlrank2= "select * from ranks where operator_id='$operator_id_rank'";

	if (!$resultrank2 = $db->query($sqlrank2)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank2 = $resultrank2->fetch_assoc()) {
		
		$minimum_hours = $rowrank2["minimum_hours"];
		
		if ($horastotalesvuelo >= $minimum_hours) {
			$rank_idnew2 = $rowrank2["rank_id"];

			
			
			// VER AERONAVES DE ESE RANGO
			
				$sqlrankfleet = "select * from fleettypes_ranks where rank_id='$rank_idnew2' and operator_id='$operator_id_rank'";

	if (!$resultrankfleet = $db->query($sqlrankfleet)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrankfleet = $resultrankfleet->fetch_assoc()) {
		
			$rowrankfleets = $rowrankfleet["fleettype_id"];
			
			
			
			// INGRESO ESAS AERONAVES 
			
			$sqlfleets2 = "insert into fleettypes_gvausers (gvauser_id,fleettype_id)
                    values ('$pilot_id','$rowrankfleets');";
				if (!$result2 = $db->query($sqlfleets2)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				// FIN		
				
				
		}

	
			
			
	
	}
		
		
	}
	
	
	
		
		
		
		
		////////////////
		
	} 											
	
	
	
}							
?>

