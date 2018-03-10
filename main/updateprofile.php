<?php
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$ivao = $_POST['ivao'];
	$city = $_POST['city'];
	$hub = $_POST['hub'];
	$facebook = $_POST['facebook'];
	$operator = $_POST['operator'];
	$language = $_POST['language'];
	$pass = mysqli_real_escape_string($db , $_POST['password']);
	$password_confirm = mysqli_real_escape_string($db , $_POST['password_confirm']);
	$country = $_POST['country'];
	$accept_emails = $_POST['accept_emails'];
	
	
if ($_POST["password"]) {
	
	if($_POST['password']==$_POST['password_confirm']) {
		
		
		
	$encryptpassword = md5($pass);
	
	$nombrearch = $_FILES['image_file']['name'];
		if (empty($nombrearch)) {
			
		$query21 = "update gvausers set facebook='$facebook', language='$language' , hub_id='$hub', operator_id='$operator', name='$name', surname='$surname',email='$email',ivaovid='$ivao',city='$city',country='$country',password='$encryptpassword' , accept_emails='$accept_emails' where gvauser_id='$id'";	
			
			
		}
		else {
			
			
			
			
			// IMAGEN DEL USUARIO
			
			
			
			
			$sql2p = "SELECT * FROM gvausers where gvauser_id='$id'";

	if (!$result2p = $db->query($sql2p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2p = $result2p->fetch_assoc()) {
		$imagens = $row2p['pilot_image'];
	}
			
				unlink('./images/uploads/' . $imagens);

				
$texto =  time() . basename($_FILES['image_file']['name']);
$texto_cambiado = str_replace(" ", "_", $texto);
$target_path = "./images/uploads/";


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
			
			
			
			
			
			// FIN
			
			
			
	$query21 = "update gvausers set facebook='$facebook', language='$language' , pilot_image='$nombressse' , hub_id='$hub', operator_id='$operator', name='$name', surname='$surname',email='$email',ivaovid='$ivao',city='$city',country='$country',password='$encryptpassword' , accept_emails='$accept_emails' where gvauser_id='$id'";
	}
		}
	if (!$result21 = $db->query($query21)) {
	die('There was an error running the query [' . $db->error . ']');
	} else {
		?>
		
			
			<script>
alert('Su perfil ha sido actualizado satisfactoriamente.');
window.location = './index_user.php?page=my_profile';
</script>
			<?php
		}
		
		
		$_SESSION['language']=$language;
		$_SESSION['operator_id']=$operator;
		
	} else {
		
		    ?>
		
			
			<script>
alert('Las contraseñas no coinciden');
window.location = './index_user.php?page=my_profile';
</script>
			<?php
		
	}
	
	
	
	
	} else {
		?>
		
			
			<script>
alert('Debe ingresar su contraseña para actualizar datos.');
window.location = './index_user.php?page=my_profile';
</script>
			<?php
		}
	$db->close();
?>

