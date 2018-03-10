
       <?php
	   
	   		include('./db_login.php');
			
	   $tour_id = $_POST['tour_id'];
	   $tour_name = $_POST['tour_name'];
	   $start_date = $_POST['start_date'];
	   $end_date = $_POST['end_date'];
	   $tour_description = $_POST['tour_description'];
	   

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	
		
		$imagenuno = $_FILES['image_file']['name'];
		$imagendos = $_FILES['image_file2']['name'];
		$contador=0;
		if ((empty($imagenuno)) && (empty($imagendos))) {
			 
			$contador=1;
			
			
		$sql1 = "update tours set tour_name='$tour_name', start_date='$start_date',  end_date='$end_date',  tour_description='$tour_description' where tour_id='$tour_id'";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		} else if ((!empty($imagenuno)) && (!empty($imagendos))) {
			$contador=2;

		$sql2p = "SELECT * FROM tours where tour_id='$tour_id'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$tour_award_image = $row2p['tour_award_image'];
		$tour_image = $row2p['tour_image'];
	}
			
				unlink('./images/tour/logo/' . $tour_image);
				unlink('./images/tour/premio/' . $tour_award_image);


			/////////////////////// IMAGEN LOGO ///////////////////////////////////////////////////	
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/tour/logo/";


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
$tour_image = $varesul;

} else{
echo "Ha ocurrido un error, trate de nuevo!";
}

////////////////////////////// FIN IMAGEN LOGO //////////////////////////////////





/////////////////////// IMAGEN PREMIO ///////////////////////////////////////////////////	
$texto2 =  time() . basename($_FILES['image_file2']['name']);
$texto_cambiado2 = str_replace(" ", "_", $texto2);
$target_path2 = "./images/tour/premio/";


/* Función que elimina los acantos y letras ñ*/
function quitar_acentose($cadena2){
    $originales2 = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿÑñ';
    $modificadas2 = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyNn';
    $cadena2 = utf8_decode($cadena2);
    $cadena2 = strtr($cadena2, utf8_decode($originales2), $modificadas2);
    return utf8_encode($cadena2);
}




/*Haciendo una prueba de la función*/
$varesul2 = quitar_acentose($texto_cambiado2);

$target_path2 = $target_path2 . $varesul2;

	if(move_uploaded_file($_FILES['image_file2']['tmp_name'], $target_path2)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$tour_award_image= $varesul2;


////////////////////////////// FIN IMAGEN PREMIO //////////////////////////////////



$sql3 = "update tours set tour_image='$tour_image', tour_award_image='$tour_award_image', tour_name='$tour_name', start_date='$start_date',  end_date='$end_date',  tour_description='$tour_description' where tour_id='$tour_id'";

		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		

		
		
	} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
		
		
		

		} 
if ($contador==0) {
			
			?>
			<script>   
	   
alert('Tour no actualizado porque no posee una de las imágenes.');
window.location = './?page=updatetourva&tour=<?php echo $tour_id; ?>';
 
</script>
			
			
			
			<?php
		}
		
		
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Tour actualizado satisfactoriamente.');
window.location = './?page=updatetourva&tour=<?php echo $tour_id; ?>';
 
</script>



