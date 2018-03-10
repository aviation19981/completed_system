
       <?php
	   
	   		include('./db_login.php');
			
	    $operator = $_POST['operator'];
		$callsign = $_POST['callsign'];
		$iata = $_POST['iata'];
		$hub_principal = $_POST['hub_principal'];
		$ceo = $_POST['ceo'];
		$vceo = $_POST['vceo'];
		$parrafo_primero = $_POST['parrafo_primero'];
		$facebook = $_POST['facebook'];
		$whatsapp = $_POST['whatsapp'];
	    $nombressse = '';
        $nombressse2 = '';
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/operators/";


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
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				
$texto2 =  time() . basename($_FILES['image_file2']['name']);
$texto_cambiado2 = str_replace(" ", "_", $texto2);
$target_path2 = "./images/portada/";


/* Función que elimina los acantos y letras ñ*/
function quitar_acentos2($cadena2){
    $originales2 = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿÑñ';
    $modificadas2 = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyNn';
    $cadena2 = utf8_decode($cadena2);
    $cadena2 = strtr($cadena2, utf8_decode($originales2), $modificadas2);
    return utf8_encode($cadena2);
}




/*Haciendo una prueba de la función*/
$varesul2 = quitar_acentos2($texto_cambiado2);

$target_path2 = $target_path2 . $varesul2;

	if(move_uploaded_file($_FILES['image_file2']['tmp_name'], $target_path2)) { 
//echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$nombressse2 = $varesul2;
		
	} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



						$sql1 = "insert into operators (operator,callsign,hub_principal,imagen_aerolinea,ceo,parrafo_primero,file,iata,vceo, facebook, whatsapp)                    
						values ('$operator','$callsign','$hub_principal','$nombressse2','$ceo','$parrafo_primero','$nombressse','$iata','$vceo', '$facebook', '$whatsapp');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		

		

		
		
		
			
		
	   ?>
	   
	   
<script>   
	   
alert('Aerolínea agregada satisfactoriamente.');
window.location = './?page=aerolineas';
 
</script>



