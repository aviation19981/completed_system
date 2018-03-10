
<?php
	$administrador = $_POST['administrador'];
	$producto = $_POST['producto'];
	$imagen = $_POST['imagen'];
	$link = $_POST['link'];
	$type = $_POST['type'];
	$simulador = $_POST['simulador'];
	$price = $_POST['price'];
	$date = $_POST['date'];
	
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
			
			
				$sql1 = "insert into productos (administrador,producto,imagen,link,type,simulador,price,date)
                    values ('$administrador','$producto','$imagen','$link','$type','$simulador','$price','$date');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			

		
		$db->close();

	
							
?>

<script>
alert('Producto agregado, sactisfactoriamente.');
window.location = './?page=ventastienda';
</script>
			


