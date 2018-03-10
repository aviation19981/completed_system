
       <?php
		$plane_icao = $_POST['plane_icao'];
		$plane_description = $_POST['plane_description'];
		$active = $_POST['active'];
		$pax = $_POST['pax'];
		$maximum_range = $_POST['maximum_range'];
		$cargo_capacity = $_POST['cargo_capacity'];
		$aircraft_length = $_POST['aircraft_length'];
		$mzfw = $_POST['mzfw'];
		$mlw = $_POST['mlw'];
		$mtow = $_POST['mtow'];
        $service_ceiling = $_POST['service_ceiling'];
		$cruising_speed = $_POST['cruising_speed'];
		$unit_price = $_POST['unit_price'];
		$crew_members = $_POST['crew_members'];
		$equip = $_POST['equip'];
		$TAS = $_POST['TAS'];
		$FF = $_POST['FF'];
		$DOW = $_POST['DOW'];
		$performance = $_POST['performance'];
	    $ejecutive_class = $_POST['ejecutive_class'];
		$tourist_class = $_POST['tourist_class'];
	   
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}

		
		
			$sql1 = "insert into fleettypes (plane_icao,plane_description,active,pax,maximum_range,cargo_capacity,aircraft_length,mzfw,mlw,mtow,service_ceiling,cruising_speed,unit_price,crew_members,equip,TAS,FF,DOW,performance,ejecutive_class,tourist_class)                    
						values ('$plane_icao','$plane_description','$active','$pax','$maximum_range','$cargo_capacity','$aircraft_length','$mzfw','$mlw','$mtow','$service_ceiling','$cruising_speed','$unit_price','$crew_members','$equip','$TAS','$FF','$DOW','$performance','$ejecutive_class','$tourist_class');";				
						if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Tipo de aeronave agregada satisfactoriamente.');
window.location = './?page=tiposdeaeronave';
 
</script>



