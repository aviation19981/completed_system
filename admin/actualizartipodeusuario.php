 <?php
	   $user_type = $_POST['user_type'];
		$user_type_id = $_POST['user_type_id'];
		$access_administration_panel = $_POST['access_administration_panel'];
		$access_va_parameters = $_POST['access_va_parameters'];
		$access_hub_manager = $_POST['access_hub_manager'];
		$access_fleet_type_manager = $_POST['access_fleet_type_manager'];
		$access_fleet_manager = $_POST['access_fleet_manager'];
		$access_rank_manager = $_POST['access_rank_manager'];
		$access_pilot_manager = $_POST['access_pilot_manager'];
		$access_route_manager = $_POST['access_route_manager'];
		$access_user_type_manager = $_POST['access_user_type_manager'];
        $access_event_manager = $_POST['access_event_manager'];
		$access_notam_manager = $_POST['access_notam_manager'];
		$access_email_manager = $_POST['access_email_manager'];
		$access_language_manager = $_POST['access_language_manager'];
		$access_financial_parameters = $_POST['access_financial_parameters'];
		$access_tour_manager = $_POST['access_tour_manager'];
		$access_award_manager = $_POST['access_award_manager'];
		$access_operator_manager = $_POST['access_operator_manager'];
		$access_flight_types = $_POST['access_flight_types'];
		$access_docente = $_POST['access_docente'];
		$access_tienda = $_POST['access_tienda'];
		$access_airports_manager = $_POST['access_airports_manager'];
		$access_invitation = $_POST['access_invitation'];
	    $operator_id = $_POST['operator_id'];
	    
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql1 = "update user_types set user_type='$user_type', access_administration_panel='$access_administration_panel',  access_va_parameters='$access_va_parameters',  access_hub_manager='$access_hub_manager',  access_fleet_type_manager='$access_fleet_type_manager',  access_fleet_manager='$access_fleet_manager', access_rank_manager='$access_rank_manager', access_pilot_manager='$access_pilot_manager', access_route_manager='$access_route_manager', access_user_type_manager='$access_user_type_manager', access_event_manager='$access_event_manager', access_notam_manager='$access_notam_manager', access_email_manager='$access_email_manager', access_language_manager='$access_language_manager', access_financial_parameters='$access_financial_parameters', access_tour_manager='$access_tour_manager'  
             , access_award_manager='$access_award_manager', access_operator_manager='$access_operator_manager', access_flight_types='$access_flight_types', access_docente='$access_docente', access_tienda='$access_tienda', access_airports_manager='$access_airports_manager', access_invitation='$access_invitation'    where user_type_id=$user_type_id";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql2 = "delete from staff_airline_allow where user_type_id=$user_type_id";  

		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		for ($i=0;$i<count($operator_id);$i++)    
        {     
	
	
	        $sql3 = "insert into staff_airline_allow (user_type_id,operator_id)    values ('$user_type_id','$operator_id[$i]');";				
						       if (!$result3 = $db->query($sql3)) {
			                       die('There was an error running the query [' . $db->error . ']');
		                          }
	
	     
        } 
		
	   ?>
	   
	   
<script>   
	   
alert('Tipo de usuario actualizado satisfactoriamente.');
window.location = './?page=tiposdeusuario';
 
</script>



