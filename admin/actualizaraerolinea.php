
       <?php
	   
	   		include('./db_login.php');
			
	    $operator = $_POST['operator'];
		$callsign = $_POST['callsign'];
		$hub_principal = $_POST['hub_principal'];
		$ceo = $_POST['ceo'];
		$vceo = $_POST['vceo'];
		$parrafo_primero = $_POST['parrafo_primero'];
		$operator_id = $_POST['operator_id'];
		$iata = $_POST['iata'];
		$facebook = $_POST['facebook'];
	    $whatsapp = $_POST['whatsapp']; 
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		/////////////////////////// Consulta BBDD
		
	$sql = "SELECT * FROM operators where operator_id='$operator_id'";

	if (!$result2p = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		$imagen_aerolinea = $row['imagen_aerolinea'];
		$icono = $row['file'];
	}
		
		
		
		
		/////////////////////////////// Funcion
		
		/* Función que elimina los acantos y letras ñ*/
function quitar_acentos($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿÑñ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyNn';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}


$icono_aerolinea = $_FILES['image_file']['name'];
$imagen_portada = $_FILES['image_file_two']['name'];
		
		
		
		
	if(!empty($imagen_portada)) {
		unlink('./images/portada/' . $imagen_aerolinea);
		
	}
		
		
	if(!empty($icono_aerolinea)) {
		unlink('./images/operators/' . $icono);
		
	}	
		
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(!empty($icono_aerolinea)) {		
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/operators/";

/*Haciendo una prueba de la función*/
$varesul = quitar_acentos($texto_cambiado);

$target_path = $target_path . $varesul;

	if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$nombrelogo = $varesul;
	} else{
echo "Ha ocurrido un error, trate de nuevo!";
}

}	
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	if(!empty($imagen_portada)) {
				
$texto2 =  time() . basename($_FILES['image_file_two']['name']);
$texto_cambiado2 = str_replace(" ", "_", $texto2);
$target_path2 = "./images/portada/";



/*Haciendo una prueba de la función*/
$varesul2 = quitar_acentos($texto_cambiado2);

$target_path2 = $target_path2 . $varesul2;

	if(move_uploaded_file($_FILES['image_file_two']['tmp_name'], $target_path2)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$imagenoperador = $varesul2;
	} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
	}
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
	
	
	if(!empty($icono_aerolinea) && empty($imagen_portada)) {	


	$sqlupdate = "update operators set operator='$operator', callsign='$callsign',  hub_principal='$hub_principal'
			,  ceo='$ceo',  parrafo_primero='$parrafo_primero', file='$nombrelogo', iata='$iata', vceo='$vceo', facebook='$facebook', whatsapp='$whatsapp'  where operator_id='$operator_id'";
			
		if (!$resultupdate = $db->query($sqlupdate)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	} else if(empty($icono_aerolinea) && !empty($imagen_portada)) {	


	
	$sqlupdate = "update operators set operator='$operator', callsign='$callsign',  hub_principal='$hub_principal'
			,  imagen_aerolinea='$imagenoperador',  ceo='$ceo',  parrafo_primero='$parrafo_primero', iata='$iata', vceo='$vceo', facebook='$facebook', whatsapp='$whatsapp' where operator_id='$operator_id'";
			
		if (!$resultupdate = $db->query($sqlupdate)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	} if(empty($icono_aerolinea) && empty($imagen_portada)) {	


	 $sqlupdate = "update operators set operator='$operator', callsign='$callsign',  hub_principal='$hub_principal'
			,  ceo='$ceo',  parrafo_primero='$parrafo_primero', iata='$iata', vceo='$vceo', facebook='$facebook', whatsapp='$whatsapp'  where operator_id='$operator_id'";
			
		if (!$resultupdate = $db->query($sqlupdate)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	} if(!empty($icono_aerolinea) && !empty($imagen_portada)) {	

 
 
          $sqlupdate = "update operators set operator='$operator', callsign='$callsign',  hub_principal='$hub_principal'
			,  imagen_aerolinea='$imagenoperador',  ceo='$ceo',  parrafo_primero='$parrafo_primero', file='$nombrelogo', iata='$iata', vceo='$vceo', facebook='$facebook', whatsapp='$whatsapp'  where operator_id='$operator_id'";
			
		if (!$resultupdate = $db->query($sqlupdate)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	}

        
		
		
		?>
		
		<script>   
	   
alert('Actualizada toda la información de la aerolínea, incluyendo imagenes.');
window.location = './?page=updateaerolinea&va=<?php echo $operator_id; ?>';
 
</script>



