
       <?php
	   
	   		include('./db_login.php');
			
	    $operator_id = $_POST['operator_id'];
	    $nombressse = '';
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/portada/";


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
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		

						$sql1 = "insert into gallery_operators (operator_id,img_operator)                    
						values ('$operator_id','$nombressse');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		

		

		
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Foto agregada satisfactoriamente.');
window.location = './?page=galleryerolinea&va=<?php echo $operator_id; ?>';
 
</script>



