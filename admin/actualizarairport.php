
       <?php
	    $ident = $_POST['icao'];
        $iata_code = $_POST['iata'];
		$name = $_POST['name'];
		$type = $_POST['type'];
		$latitude_deg = $_POST['latitude_deg'];
		$longitude_deg = $_POST['longitude_deg'];
		$elevation_ft = $_POST['elevation_ft'];
		$municipality = $_POST['municipality'];
		$continent = $_POST['continent'];
        $iso_region = $_POST['iso_region'];
		$iso_country = $_POST['iso_country'];
	    $identificaciones  = $_POST['identificaciones'];
		
	    $contadores=0;
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		              
			$sql1 = "update airports set ident='$ident', iata_code='$iata_code',  
			name='$name',  type='$type',  latitude_deg='$latitude_deg',  longitude_deg='$longitude_deg',  elevation_ft='$elevation_ft' 
			,  municipality='$municipality',  continent='$continent',  iso_region='$iso_region',  iso_country='$iso_country' 	where id='$identificaciones'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
								  
								   ?>
	   
	   
<script>   
	   
alert('Aeropuerto actualizado satisfactoriamente.');
window.location = './?page=updateairport&icao=<?php echo $identificaciones; ?>';
 
</script>
