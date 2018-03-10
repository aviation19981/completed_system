
<?php
	
		
		

	
	
	        $administrador = $_POST['administrador'];
			$producto = $_POST['producto'];
			$imagen = $_POST['imagen'];
			$link = $_POST['link'];
			$type = $_POST['type'];
			$simulador = $_POST['simulador'];
			$price =  $_POST['price'];
			$date = $_POST['date'];
			
			$ids = $_POST['ids'];
			
			
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql1 = "UPDATE productos set producto='$producto', imagen='$imagen', link='$link', type='$type', simulador='$simulador', price='$price', date='$date' where id=$ids";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Producto actualizado, satisfactoriamente.');
window.location = './?page=ventastienda';
</script>
