<?php

$codexamen = $_POST['codexamen'];
$limite = $_POST['numpreg'];
$totalexamenespresentados =0;   
include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql = "select * from config_examen where id='$codexamen'";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
		}	
		
		

	

        $sql12 = "select * from preguntasdeexamen where idexamen='$codexamen'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$contarpreguntas = 0;
		$contarbuenas = 0;
		while ($row12 = $result12->fetch_assoc()) {
			// CONTAR PREGUNTAS
			$contarpreguntas++;
			// ID Y RESPUESTA CORRECTA
			$identificacion = $row12["id"];
			$respuesta_correcta = $row12["respuesta_correcta"];
			
			// VALIDAR RESPUESTA
			if($_POST[$identificacion]==$respuesta_correcta) {
				$contarbuenas++;
			}
			
		}
		// 80 PORCIENTO EN TEORICO
		
		$calificacion = (($contarbuenas*100)/$limite);
		
    ////////////////////////////////////////////
		$porcentaje = ((5*$calificacion)/100);


		/////////////////////////////////////////// CONTAR EXAMENES 
		$sqlexamenes = "select * from training where gvauser_id='$id' and tema='0' and examen='$codexamen' and docente='SISTEMA'";
		
		if (!$resultexamenes = $db->query($sqlexamenes)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($rowexamenes = $resultexamenes->fetch_assoc()) {
              $totalexamenespresentados++;
		}	
		
		
		if($totalexamenespresentados==0) {
			
			/////////////////// AGREGAMOS EL EXAMEN POR PRIMERA VEZ
			
			 $sql1 = "insert into training (gvauser_id,tema,examen,docente,nota,fecha)
                    values ('$id','0','$codexamen','SISTEMA','$porcentaje',now());";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			
		} else {
			
			
			$sql1p = "delete from training where gvauser_id='$id' and tema='0' and examen='$codexamen' and docente='SISTEMA'";

		if (!$result1p = $db->query($sql1p)) {
			die('There was an error running the query [' . $db->error . ']');
		}
			
			
			
			
			/////////////////// AGREGAMOS EL EXAMEN POR PRIMERA VEZ
			
			 $sql12 = "insert into training (gvauser_id,tema,examen,docente,nota,fecha)
                    values ('$id','0','$codexamen','SISTEMA','$porcentaje',now());";
				if (!$result12 = $db->query($sql12)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			
			
			
			
		}
		
               
		




?>

<script>
alert('Examen registrado y calificado sactisfactoriamente.');
window.location = './index_user.php?page=academy';
</script>
			


