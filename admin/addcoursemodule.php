
<?php

//comprobamos que sea una petición ajax
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	
	$course_id = $_POST['course_id'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$description = $_POST['description'];
	
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				$sql1 = "insert into trainings (title,course_id,content,description)
                    values ('$title','$course_id','$content','$description');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}

			
			    $last_id = $db->insert_id;
				
							/* Función que elimina los acantos y letras ñ*/
function quitar_acentos($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿÑñ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyNn';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}
				
$contar=0;
$actuales =0;				
				//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		$actuales++;
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
			
			
			
			///////////////// Nuevo ///////////////////
			
			$texto =  time() . basename($_FILES['archivo']['name'][$key]);
            $directorio = "./pdf/";
			$texto_cambiado = str_replace(" ", "_", $texto);
			



/*Haciendo una prueba de la función*/
$linkpdf = quitar_acentos($texto_cambiado);

$directorio = $directorio . $linkpdf;



if(move_uploaded_file($_FILES['archivo']['tmp_name'][$key], $directorio)) { 
$contar++;
$linkpdf_url = $linkpdf;



						$sql_pr = "insert into trainings_pdf (id_modulo,pdf)                    
						values ('$last_id','$linkpdf_url');";					
						if (!$result_pr = $db->query($sql_pr)) {
			                 die('There was an error running the query [' . $db->error . ']');
		                }
		

		
		
	} else{
echo "Ha ocurrido un error, trate de nuevo!";
}



		}
	}


	if($contar==$actuales) {
							
?>

<script>
alert('Módulo agregado, sactisfactoriamente.');
window.location = './?page=moduloscursos&id=<?php echo $course_id; ?>';
</script>
			
	<?php } else {
		
	?>

<script>
alert('Módulo no agregado, sactisfactoriamente.');
window.location = './?page=moduloscursos&id=<?php echo $course_id; ?>';
</script>
			
	<?php	
		
	} 
	
	
	}else{
    throw new Exception("Error Processing Request", 1);   
}
	
	
	?>


