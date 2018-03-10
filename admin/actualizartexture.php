
       <?php
	   
	    $nombre = $_POST["nombre"];
		$link = $_POST["link"];
		$aeronaves=  $_POST["aeronaves"];
		$estado= $_POST["estado"];
		$idsim= $_POST["idsim"];
		$idtext= $_POST["idtext"];
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql1 = "update textures set idsim='$idsim', nombre='$nombre',  
			link='$link',  estado='$estado',  icao='$aeronaves' where id='$idtext'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Texture actualizada satisfactoriamente.');
window.location = './?page=texturasim&sim_id=<?php echo $idsim; ?>';
 
</script>



