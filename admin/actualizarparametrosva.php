
       <?php
	   
	   		include('./db_login.php');
			
	    $hours_charter=  $_POST["hours_charter"];
		$allow_charter_flight=  $_POST["allow_charter_flight"];
		$plane_status_hangar=  $_POST["plane_status_hangar"];
		$flight_wear=  $_POST["flight_wear"];
		$hangar_maintenance_days=  $_POST["hangar_maintenance_days"];
		$hangar_maintenance_value=  $_POST["hangar_maintenance_value"];
		$charter_reduction=  $_POST["charter_reduction"];
		$currency=  $_POST["currency"];
		$hours_auto_cancellation=  $_POST["hours_auto_cancellation"];
		$admisiones=  $_POST["admisiones"];
	    $va_parameters_id = $_POST["va_parameters_id"];
        $number_pilots = $_POST["number_pilots"];
		$nm_for_damage = $_POST["nm_for_damage"];
		$hours_min_per_week = $_POST["hours_min_per_week"];
		$percentage_test_rank = $_POST["percentage_test_rank"];
		$maximium_days_fired = $_POST["maximium_days_fired"];
		
		 $ticket = $_POST["ticket"];
		 $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	
			
			
			
			$sql1 = "update va_parameters set maximium_days_fired='$maximium_days_fired', percentage_test_rank='$percentage_test_rank', hours_min_per_week='$hours_min_per_week', nm_for_damage='$nm_for_damage', number_pilots='$number_pilots', hours_charter='$hours_charter', allow_charter_flight='$allow_charter_flight',  plane_status_hangar='$plane_status_hangar'
			,  flight_wear='$flight_wear',  hangar_maintenance_days='$hangar_maintenance_days',  hangar_maintenance_value='$hangar_maintenance_value',  charter_reduction='$charter_reduction'
			,  currency='$currency',  hours_auto_cancellation='$hours_auto_cancellation',  admisiones='$admisiones', ticket='$ticket'  where va_parameters_id='$va_parameters_id'";

		if (!$result = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	
			
		
	   ?>
	   
	   
<script>   
	   
alert('Parámetros actualizada satisfactoriamente.');
window.location = './?page=vaparametros';
 
</script>



