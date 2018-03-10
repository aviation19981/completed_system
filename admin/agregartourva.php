
       <?php
	   
	   		include('./db_login.php');
			
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
		if ((empty($imagenuno)) || (empty($imagendos))) {
			 
		?>
			<script>   
	   
alert('Tour no agregado por que falta una de las imagenes o ambas.');
window.location = './?page=addtours';
 
</script>
			
			
			
			<?php
		
		} else if ((!empty($imagenuno)) && (!empty($imagendos))) {
		

	

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



		

		
		
	} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
		
		

				$sql1 = "insert into tours (tour_image,tour_award_image,tour_name,start_date,end_date,tour_description)                    
						values ('$tour_image','$tour_award_image','$tour_name','$start_date','$end_date','$tour_description');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		

		} 
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Tour agregado satisfactoriamente.');
window.location = './?page=toursva';
 
</script>



