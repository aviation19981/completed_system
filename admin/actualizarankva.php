
       <?php
	   
	   		include('./db_login.php');
			
	   $name = $_POST['name'];
	   $abreviacion = $_POST['abreviacion'];
	   $salario = $_POST['salario'];
	   $minhoras = $_POST['minhoras'];
	   $maxhoras = $_POST['maxhoras'];
	   $aeronaves = $_POST['aeronaves'];
	   $identificacion = $_POST['identificacion'];
	   $operator_id = $_POST['operator_id'];

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	
		
		$nombrearch = $_FILES['image_file']['name'];
		if (empty($nombrearch)) {
			 
			
			
			
			$sql1 = "update ranks set rank='$name', abreviacion='$abreviacion',  salary_hour='$salario',  minimum_hours='$minhoras',  maximum_hours='$maxhoras'  where rank_id='$identificacion'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
	
		
		 $sql12R = "update fleettypes_ranks set rank_id=''  where rank_id='$identificacion' and operator_id='$operator_id'";

		if (!$result2R = $db->query($sql12R)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		for ($iR=0;$iR<count($aeronaves);$iR++)    
        {     
	
	$contarplane=0;
	$sqlplane = "SELECT * FROM fleettypes_ranks where fleettype_id='$aeronaves[$iR]' and operator_id='$operator_id'";

	if (!$resultplane = $db->query($sqlplane)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowplane = $resultplane->fetch_assoc()) {
		$contarplane++;
	}
	
	
	if($contarplane==0) {
		
	         	$sql53 = "insert into fleettypes_ranks (rank_id,fleettype_id,operator_id)                    
						values ('$identificacion','$aeronaves[$iR]','$operator_id');";				
						if (!$result53 = $db->query($sql53)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	} else {
	         $sql123R = "update fleettypes_ranks set rank_id='$identificacion'  where fleettype_id='$aeronaves[$iR]' and operator_id='$operator_id'";

		if (!$result23R = $db->query($sql123R)) {
			die('There was an error running the query [' . $db->error . ']');
		}
        } 
		
		}	
	
		
		
		
		
		
		
		} else {
			

		$sql2p = "SELECT * FROM ranks where rank_id='$identificacion'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$imagens = $row2p['img'];
	}
			
				unlink('./images/ranks/' . $imagens);
				
				////////////////////////////////////// IMAGEN RANGO ////////////
				
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/ranks/";


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

	if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$nombressse = $varesul;
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
///////////////////////////// FIN IMAGEN RANGO






        $sql1R = "update ranks set rank='$name', img='$nombressse',  abreviacion='$abreviacion',  salary_hour='$salario',  minimum_hours='$minhoras',  maximum_hours='$maxhoras' where rank_id='$identificacion'";

		if (!$resultR = $db->query($sql1R)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		 $sql12R = "update fleettypes_ranks set rank_id=''  where rank_id='$identificacion' and operator_id='$operator_id'";

		if (!$result2R = $db->query($sql12R)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		for ($iR=0;$iR<count($aeronaves);$iR++)    
        {     
	
	         $sql123R = "update fleettypes_ranks set rank_id='$identificacion'  where fleettype_id='$aeronaves[$iR]' and operator_id='$operator_id'";

		if (!$result23R = $db->query($sql123R)) {
			die('There was an error running the query [' . $db->error . ']');
		}
        } 
		
		
	
		
		
		

		} 
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Rango actualizado satisfactoriamente.');
window.location = './?page=rangospilotos';
 
</script>



