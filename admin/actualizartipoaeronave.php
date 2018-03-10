
       <?php
		$plane_icao = $_POST['plane_icao'];
		$fleettype_id = $_POST['fleettype_id'];
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
		
			$sql1 = "update fleettypes set plane_icao='$plane_icao', plane_description='$plane_description',  active='$active',  pax='$pax',  maximum_range='$maximum_range' 
,  cargo_capacity='$cargo_capacity',  aircraft_length='$aircraft_length',  mzfw='$mzfw',  mlw='$mlw',  mtow='$mtow',  service_ceiling='$service_ceiling',  cruising_speed='$cruising_speed'
,  unit_price='$unit_price',  crew_members='$crew_members', equip='$equip', TAS='$TAS', FF='$FF', DOW='$DOW', performance='$performance', ejecutive_class='$ejecutive_class', tourist_class='$tourist_class'  	where fleettype_id='$fleettype_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	   ?>
	   
	   
<script>   
	   
alert('Tipo de aeronave actualizado satisfactoriamente.');
window.location = './?page=tiposdeaeronave';
 
</script>



