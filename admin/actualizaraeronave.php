
       <?php
	   
	   $fleet_id = $_POST["fleet_id"];
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
		
		$image_url_link = $_FILES['image_url']['name'];
		
		if (empty($image_url_link)) {
		
		$sql1 = "update fleets set fleettype_id='$plane', registry='$registro',  
			location='$location',  hours='$hours',  status='$status',  booked='$booked',  name='$name' 
			,  hub_id='$hub',  hangar='$hangar',  operator_id='$operator_id' 	where fleet_id='$fleet_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		} else {
			
			
	$sql2p = "SELECT * FROM fleets where fleet_id='$fleet_id'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$image_url_delete = $row2p['image_url'];
	}
			if(empty($image_url_delete)) {
				
			} else {
				
				unlink('./images/planes/' . $image_url_delete);
				
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




$sql1 = "update fleets set fleettype_id='$plane', registry='$registro',  
			location='$location',  hours='$hours',  status='$status',  booked='$booked',  name='$name' 
			,  hub_id='$hub',  hangar='$hangar',  image_url='$image_url',  operator_id='$operator_id' 	where fleet_id='$fleet_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		

			
			
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Aeronave actualizada satisfactoriamente.');
window.location = './?page=updateaeronaveva&aeronave=<?php echo $fleet_id; ?>';
 
</script>



