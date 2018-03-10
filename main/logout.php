<?php
	session_start();
	session_unset();

	
	        unset($_SESSION["access"]);
			unset($_SESSION["username"]);
			unset($_SESSION["name"]);
			unset($_SESSION["user"]);
			unset($_SESSION["password"]);
			unset($_SESSION["usertype"]);
			unset($_SESSION["location"]);
			unset($_SESSION["hub_id"]);
			unset($_SESSION["airport"]);
			unset($_SESSION["register_date"]);
			unset($_SESSION["gva_hours"]);
			unset($_SESSION["rank_id"]);
			unset($_SESSION["language"]);
			unset($_SESSION["ivaovid"]);
			unset($_SESSION["id"]);
			unset($_SESSION["operator_id"]);
			unset($_SESSION["access_administration_panel"]);
			unset($_SESSION["access_va_parameters"]);
			unset($_SESSION["access_hub_manager"]);
			unset($_SESSION["access_fleet_type_manager"]);
			unset($_SESSION["access_fleet_manager"]);
			unset($_SESSION["access_rank_manager"]);
			unset($_SESSION["access_pilot_manager"]);
			unset($_SESSION["access_route_manager"]);
			unset($_SESSION["access_route_assignator"]);
			unset($_SESSION["access_user_type_manager"]);
			unset($_SESSION["access_event_manager"]);
			unset($_SESSION["access_notam_manager"]);
			unset($_SESSION["access_email_manager"]);
			unset($_SESSION["access_language_manager"]);
			unset($_SESSION["access_financial_parameters"]);
			unset($_SESSION["access_tour_manager"]);
			unset($_SESSION["access_award_manager"]);
			unset($_SESSION["access_operator_manager"]);
			unset($_SESSION["access_flight_types"]);
			unset($_SESSION["access_docente"]);
			unset($_SESSION["access_pilot_status"]);
			unset($_SESSION["access_tienda"]);
			unset($_SESSION["access_airports_manager"]);
			unset($_SESSION["access_invitation"]);
	
	
	
	session_destroy();
	echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index.php">'
?>
