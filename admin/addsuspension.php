<?php
	$gvauser_id_pca = $_POST['gvauser_id'];
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_fin = $_POST['fecha_fin'];
	$comments = $_POST['comments'];
	
	
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
        $contadores=0;		
			
		$sql_user = "select * from historial_status where gvauser_id='$gvauser_id_pca' and estado=1 order by fecha_inicio desc limit 1";  
		
		if (!$result_user = $db->query($sql_user)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row_user = $result_user->fetch_assoc()) {
			$contadores++;
		}
		
		if($contadores==0) {
			
				$sql = "insert into historial_status (gvauser_id,fecha_inicio,fecha_fin,comments,estado,by_staff_id)
                    values ('$gvauser_id_pca','$fecha_inicio','$fecha_fin','$comments','1','$id');";
				if (!$result = $db->query($sql)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			
                $query2 = "UPDATE gvausers set activation='3' where gvauser_id='$gvauser_id_pca'";
			    if (!$result2 = $db->query($query2)) {
				   die('There was an error running the query [' . $db->error . ']');
			    }
								
?>

<script>
alert('Usuario sancionado satisfactoriamente.');
window.location = './?page=pilot_details&pilot_id=<?php echo $gvauser_id_pca; ?>';
</script>

		<?php } else { ?>

<script>
alert('El usuario posee una sanción activa, por ende no se permite añadir más suspensiones hasta terminar la sanción actual.');
window.location = './?page=suspensionespilots';
</script>
		
		
		<?php } ?>
			


