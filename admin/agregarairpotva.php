
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
	   
	    $contadores=0;
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		                   $airport = "SELECT * FROM airports where ident='$ident'";
		                   if (!$result_airport = $db->query($airport)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($airports = $result_airport->fetch_assoc()) {
							$contadores++;
							}
							
							
							if($contadores==0) {
								
								$sql1 = "insert into airports (ident,iata_code,name,type,latitude_deg,longitude_deg,elevation_ft,municipality,continent,iso_region,iso_country)                    
						     values ('$ident','$iata_code','$name','$type','$latitude_deg','$longitude_deg','$elevation_ft','$municipality','$continent','$iso_region','$iso_country');";				
						       if (!$result1 = $db->query($sql1)) {
			                       die('There was an error running the query [' . $db->error . ']');
		                          }
								  
								  
								   ?>
	   
	   
<script>   
	   
alert('Aeropuerto agregado satisfactoriamente.');
window.location = './?page=aeropuertosva';
 
</script>

<?php
								
								
							} else {
								
									   ?>
	   
	   
<script>   
	   
alert('Ya existe el aeropuerto.');
window.location = './?page=aeropuertosva';
 
</script>

<?php
								
								
							}
		
			
		
		
		
	   ?>
	   
	   



