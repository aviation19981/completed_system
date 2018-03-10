
       <?php
	   
		$plane = $_POST["plane"];
		$registro=  $_POST["registro"];
		$location= $_POST["location"];
		$hours= $_POST["hours"];
		$status= $_POST["status"] ;
		$booked= $_POST["booked"];
		$name=$_POST["name"];
		$hub= $_POST["hub"];
		$hangar= $_POST["hangar"];
		$operator_id= $_POST["operator_id"];
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
				$type='';
				$aircraftvalue=0;
		        $description ='';
		
		// FINANZAS
		
		$sql = "select * from fleettypes where fleettype_id='$plane'";
					if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
				while ($row = $result->fetch_assoc()) 
				{
				$aircraftvalue = (-1 * $row["unit_price"]);
				$type = $row["plane_icao"];
		
				}
		
	$description = $type . ' ' . $registro . ' ' . $name;
		
	


	

	
	$str = "ABCDEFGHJKLMPQRS";
	
    $registros = array();
	$contador =0;
	$contaraviones=0;
	
	$sqlreg = "select * from fleets";
	if (!$resultreg = $db->query($sqlreg)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($rowreg = $resultreg->fetch_assoc()) {
		$contaraviones++;
		$registros[] = $rowreg['selcal'];
	}
	
	for($i=0;$i<=1;$i++) {
	//////////////////////////// SELCAL PRIMERO
	$selcal1 = substr($str , rand(0 , 16) , 1);
	
	////////////////////// SELCAL SEGUNDO
	for($j=0;$j<=1;$j++) {
	$prueba_selcal2 = substr($str , rand(0 , 16) , 1);
	
	if($prueba_selcal2<>$selcal1) {
		$selcal2 = $prueba_selcal2;
	} else {
        $j=0;
	}	
	
	
	}
	/////////////////////////
	
    $guion = '-';
	
	////////////////////////// SELCAL TERCERO
	$selcal3 = substr($str , rand(0 , 16) , 1);
	
	
	////////////////////// SELCAL CUARTO
	
	for($k=0;$k<=1;$k++) {
		
	$prueba_selcal4 = substr($str , rand(0 , 16) , 1);
	
	if($prueba_selcal4<>$selcal3) {
		$selcal4 = $prueba_selcal4;
	} else {
        $k=0;
	}	
		
	}
	
	$selcal = $selcal1 . $selcal2 . $guion . $selcal3 . $selcal4;
	
	if(strlen($selcal)==5) {
		
	if (in_array($selcal, $registros)) {
		$i--;
	} else {
		$selcalfull = $selcal;	
	}
		
	} else {
		$i--;
	}
	
	}
	
	////////////////////////////////////// IMAGEN RANGO ////////////
				
$texto =  time() . basename($_FILES['image_url']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/planes/";


/* Función que elimina los acantos y letras ñ*/
function quitar_acentos($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿÑñ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyNn';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}




/*Haciendo una prueba de la función*/
$varesul = quitar_acentos($texto_cambiado);

$target_path = $target_path . $varesul;

	if(move_uploaded_file($_FILES['image_url']['tmp_name'], $target_path)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$image_url = $varesul;
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
///////////////////////////// FIN IMAGEN RANGO

	
		
		
					
	
			
			$sql12 = "insert into fleets (fleettype_id,registry,selcal,location,hours,status,booked,name,hub_id,hangar,image_url,operator_id)                    
						values ('$plane','$registro','$selcalfull','$location','$hours','$status','$booked','$name','$hub','$hangar','$image_url','$operator_id');";				
						if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
			// insert ganancias vuelo
		$sql23 = "insert into va_finances (amount,parameter_id,finance_date,gvauser_id,description,report_type,report_id) values ($aircraftvalue, '0',now(),'0' ,'$description','New Aircraft', '0')";

		if (!$result23 = $db->query($sql23)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		
		
		
		
		
		
		
		
	   ?>
	   
	   
<script>   
	   
alert('Aeronave comprada satisfactoriamente.');
window.location = './?page=admonaeronaves';
 
</script>



