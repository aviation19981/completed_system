<?php
    include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	   error_reporting(E_ALL);
       ini_set('display_errors', '1');
	   
	   
	   $name = $_POST["name"];
	   $abreviacion = $_POST["abreviacion"];
	   $salario = $_POST["salario"];
	   $minhoras = $_POST["minhoras"];
	   $maxhoras = $_POST["maxhoras"];
	   $aeronaves = $_POST["aeronaves"];
	   $va_id = $_POST["va_id"];
	
	   $nombre_uno = "";
	   

	
		
	
/* Función que elimina los acantos y letras ñ*/
function quitar_acentos($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿÑñ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyNn';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}





		////////////////////////////////////// IMAGEN RANGO ////////////
				
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/ranks/";




/*Haciendo una prueba de la función*/
$varesul = quitar_acentos($texto_cambiado);

$target_path = $target_path . $varesul;

	if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$nombre_uno = $varesul;
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
///////////////////////////// FIN IMAGEN RANGO






						$sql_new = "insert into ranks (rank,img,abreviacion,salary_hour,minimum_hours,maximum_hours,operator_id)                    
						values ('$name','$nombre_uno','$abreviacion','$salario','$minhoras','$maxhoras','$va_id');";				
						if (!$result_new = $db->query($sql_new)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
		$identificacion = $db->insert_id;
	
	
		
		for ($iRs=0;$iRs<count($aeronaves);$iRs++)    
        {     
	
	         	$sql53 = "insert into fleettypes_ranks (rank_id,fleettype_id,operator_id)                    
						values ('$identificacion','$aeronaves[$iRs]','$va_id');";				
						if (!$result53 = $db->query($sql53)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
        } 
		
		
		
		
		
	   ?>
	   
	   

<script>   
	   
alert('Rango agregado satisfactoriamente.');
window.location = './?page=rangospilotos';
 
</script>

