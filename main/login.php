<?php session_start();
	include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getBrowser($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No hemos podido detectar su navegador';
}



function getRealIP()
{

    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
        return $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
        return $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
        return $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
        return $_SERVER["REMOTE_ADDR"];
    }

}


$IPUser = getRealIP();
$navegador = getBrowser($user_agent);
	
	if (isset($_POST['user']) and isset($_POST['password'])) {
		$user = mysqli_real_escape_string($db , $_POST['user']);
		$encrypt_Pass = md5(mysqli_real_escape_string($db , $_POST["password"]));
		$query = "SELECT * FROM gvausers u inner join user_types ut on u.user_type_id = ut.user_type_id where callsign='$user' and password='$encrypt_Pass'";
		if (!$result = $db->query($query)) {
			die('There was an error running the query [' . $db->error . ']');
	}
	
	
	$exists = 0;
	$_SESSION["access"] = false;
	
		while ($row = $result->fetch_assoc()) {
			
			
			$exists = 1;
			$user_type = $row['user_type_id'];
			$pilotname = $row['name'];
			$pilotsurname = $row['surname'];
			$callsign = $row['callsign'];
			$id = $row['gvauser_id'];
			$location = $row['location'];
			$cto = $row['hub_id'];
			$register_date = $row['register_date'];
			$gva_hours = $row['gva_hours'];
			$rank_id = $row['rank_id'];
			$language = $row['language'];
			$ivaovid = $row["ivaovid"];
			$pca_activation = $row["activation"];
			$operator_id = $row["operator_id"];
			$access_administration_panel = $row["access_administration_panel"];
			$access_va_parameters = $row["access_va_parameters"];
			$access_hub_manager = $row["access_hub_manager"];
			$access_fleet_type_manager = $row["access_fleet_type_manager"];
			$access_fleet_manager = $row["access_fleet_manager"];
			$access_rank_manager = $row["access_rank_manager"];
			$access_pilot_manager = $row["access_pilot_manager"];
			$access_route_manager = $row["access_route_manager"];
			$access_route_assignator = $row["access_route_assignator"];
			$access_user_type_manager = $row["access_user_type_manager"];
			$access_event_manager = $row["access_event_manager"];
			$access_notam_manager = $row["access_notam_manager"];
			$access_email_manager = $row["access_email_manager"];
			$access_language_manager = $row["access_language_manager"];
			$access_financial_parameters = $row["access_financial_parameters"];
			$access_tour_manager = $row["access_tour_manager"];
			$access_award_manager  = $row["access_award_manager"];
			$access_operator_manager  = $row["access_operator_manager"];
			$access_flight_types  = $row["access_flight_types"];
			$access_docente  = $row["access_docente"];
			$access_pilot_status  = $row["access_pilot_status"];
			$access_tienda  = $row["access_tienda"];
			$access_airports_manager  = $row["access_airports_manager"];
			$access_invitation = $row["access_invitation"];
			
		}
		
		
	$contadores=0;
	$sql_suspension = "select * from historial_status where gvauser_id='$id' and estado='1'";
	if (!$result_suspension = $db->query($sql_suspension)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_suspension = $result_suspension->fetch_assoc()) {
		$contadores++;
		$comments = $row_suspension['comments']; 
		$fecha_fin = $row_suspension['fecha_fin'];
		$fecha_inicio = $row_suspension['fecha_inicio'];
	}
if($contadores>0) {
$datetime1 = new DateTime($fecha_inicio);
$datetime2 = new DateTime($fecha_fin);
$intervalos = $datetime1->diff($datetime2);
$interval = $intervalos->days;
}
	
		if ($exists != 0) {
			
			if($pca_activation==0) {
				//////////////// ES UN PILOTO NUEVO SIN APROBAR
				
$mensaje1 = "Piloto aun no ingresado al sistema de la aerolinea, estar a la espera de ello.";
echo "<script>";
echo "alert('$mensaje1');";  
echo "window.location = './?page=form_login';";
echo "</script>";  
		
				
				//////////////// FIN
			} else if ($pca_activation==1) {
				////////////////// ES UN PILOTO ACTIVO
				
			$sess_life_time = 21600; //in seconds
            $sess_path = "/";
            $sess_domain = ".colstarva.co";
            $sess_secure = true; // if you have secured session
            $sess_httponly = true; // httponly flag

            session_set_cookie_params($sess_life_time, $sess_path, $sess_domain, $sess_secure, $sess_httponly);
            $_SESSION["access"] = true;
			$_SESSION["username"] = $user;
			$_SESSION["name"] = $pilotname;
			$_SESSION["user"] = $callsign;
			$_SESSION["password"] = $Encrypt_Pass;
			$_SESSION["usertype"] = $user_type;
			$_SESSION["location"] = $location;
			$_SESSION["hub_id"] = $cto;
			$_SESSION["airport"] = $location;
			$_SESSION["register_date"] = $register_date;
			$_SESSION["gva_hours"] = $gva_hours;
			$_SESSION["rank_id"] = $rank_id;
			$_SESSION["language"] = $language;
			$_SESSION["ivaovid"] = $ivaovid;
			$_SESSION["id"] = $id;
			$_SESSION["operator_id"] = $operator_id;
			$_SESSION["access_administration_panel"] = $access_administration_panel;
			$_SESSION["access_va_parameters"] = $access_va_parameters;
			$_SESSION["access_hub_manager"] = $access_hub_manager;
			$_SESSION["access_fleet_type_manager"] = $access_fleet_type_manager ;
			$_SESSION["access_fleet_manager"] = $access_fleet_manager;
			$_SESSION["access_rank_manager"] = $access_rank_manager;
			$_SESSION["access_pilot_manager"] = $access_pilot_manager;
			$_SESSION["access_route_manager"] = $access_route_manager;
			$_SESSION["access_route_assignator"] = $access_route_assignator;
			$_SESSION["access_user_type_manager"] = $access_user_type_manager;
			$_SESSION["access_event_manager"] = $access_event_manager;
			$_SESSION["access_notam_manager"] = $access_notam_manager;
			$_SESSION["access_email_manager"] = $access_email_manager;
			$_SESSION["access_language_manager"] = $access_language_manager;
			$_SESSION["access_financial_parameters"] = $access_financial_parameters;
			$_SESSION["access_tour_manager"] = $access_tour_manager;
			$_SESSION["access_award_manager"] = $access_award_manager;
			$_SESSION["access_operator_manager"] = $access_operator_manager;
			$_SESSION["access_flight_types"] = $access_flight_types;
			$_SESSION["access_docente"] = $access_docente;
			$_SESSION["access_pilot_status"] = $access_pilot_status;
			$_SESSION["access_tienda"] = $access_tienda;
			$_SESSION["access_airports_manager"] = $access_airports_manager;
			$_SESSION["access_invitation"] = $access_invitation;
			
			
			
			$query2 = "UPDATE gvausers set last_visit_date=now() where gvauser_id='$id'";
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
			$query3 = "insert into historial_login (gvauser_id,fecha,ip,navegador)
                    values ('$id',now(),'$IPUser','$navegador');";
			if (!$result3 = $db->query($query3)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
			
	
	
			session_write_close (); 
			
		    echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./index_user.php'>";
				
				//////////////// FIN
			} else if ($pca_activation==2) {
				/////////////////////////// USUARIO INACTIVO
				
				
				$sess_life_time = 21600; //in seconds
            $sess_path = "/";
            $sess_domain = ".colstarva.com";
            $sess_secure = true; // if you have secured session
            $sess_httponly = true; // httponly flag

            session_set_cookie_params($sess_life_time, $sess_path, $sess_domain, $sess_secure, $sess_httponly);
            $_SESSION["access"] = true;
			$_SESSION["username"] = $user;
			$_SESSION["name"] = $pilotname;
			$_SESSION["user"] = $callsign;
			$_SESSION["password"] = $Encrypt_Pass;
			$_SESSION["usertype"] = $user_type;
			$_SESSION["location"] = $location;
			$_SESSION["hub_id"] = $cto;
			$_SESSION["airport"] = $location;
			$_SESSION["register_date"] = $register_date;
			$_SESSION["gva_hours"] = $gva_hours;
			$_SESSION["rank_id"] = $rank_id;
			$_SESSION["language"] = $language;
			$_SESSION["ivaovid"] = $ivaovid;
			$_SESSION["id"] = $id;
			$_SESSION["operator_id"] = $operator_id;
			$_SESSION["access_administration_panel"] = $access_administration_panel;
			$_SESSION["access_va_parameters"] = $access_va_parameters;
			$_SESSION["access_hub_manager"] = $access_hub_manager;
			$_SESSION["access_fleet_type_manager"] = $access_fleet_type_manager ;
			$_SESSION["access_fleet_manager"] = $access_fleet_manager;
			$_SESSION["access_rank_manager"] = $access_rank_manager;
			$_SESSION["access_pilot_manager"] = $access_pilot_manager;
			$_SESSION["access_route_manager"] = $access_route_manager;
			$_SESSION["access_route_assignator"] = $access_route_assignator;
			$_SESSION["access_user_type_manager"] = $access_user_type_manager;
			$_SESSION["access_event_manager"] = $access_event_manager;
			$_SESSION["access_notam_manager"] = $access_notam_manager;
			$_SESSION["access_email_manager"] = $access_email_manager;
			$_SESSION["access_language_manager"] = $access_language_manager;
			$_SESSION["access_financial_parameters"] = $access_financial_parameters;
			$_SESSION["access_tour_manager"] = $access_tour_manager;
			$_SESSION["access_award_manager"] = $access_award_manager;
			$_SESSION["access_operator_manager"] = $access_operator_manager;
			$_SESSION["access_flight_types"] = $access_flight_types;
			$_SESSION["access_docente"] = $access_docente;
			$_SESSION["access_pilot_status"] = $access_pilot_status;
			$_SESSION["access_tienda"] = $access_tienda;
			$_SESSION["access_airports_manager"] = $access_airports_manager;
			$_SESSION["access_invitation"] = $access_invitation;
			
			
			$query2 = "UPDATE gvausers set activation='1', last_visit_date=now() where gvauser_id='$id'";
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
			
			$query3 = "insert into historial_login (gvauser_id,fecha,ip,navegador)
                    values ('$id',now(),'$IPUser','$navegador');";
			if (!$result3 = $db->query($query3)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
	
	
			session_write_close (); 
			
		    echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./index_user.php'>";
				
				/////////////////////////// FIN
			} else if ($pca_activation==3) {
				
				//////////////// ES UN PILOTO SUSPENDIDO
				
$mensaje2 = "Usted se encuentra suspendido, por un miembro del Staff. Descripción: " . $comments . " Sanción por: " . $interval . " días, fecha finalización: " . $fecha_fin;
echo "<script>";
echo "alert('$mensaje2');";  
echo "window.location = './?page=form_login';";
echo "</script>";  
		
				
				//////////////// FIN
			} else if ($pca_activation==4) {
				/////////////////////////// USUARIO EN VACACIONES
				
				
				$sess_life_time = 21600; //in seconds
            $sess_path = "/";
            $sess_domain = ".colstarva.com";
            $sess_secure = true; // if you have secured session
            $sess_httponly = true; // httponly flag

            session_set_cookie_params($sess_life_time, $sess_path, $sess_domain, $sess_secure, $sess_httponly);
            $_SESSION["access"] = true;
			$_SESSION["username"] = $user;
			$_SESSION["name"] = $pilotname;
			$_SESSION["user"] = $callsign;
			$_SESSION["password"] = $Encrypt_Pass;
			$_SESSION["usertype"] = $user_type;
			$_SESSION["location"] = $location;
			$_SESSION["hub_id"] = $cto;
			$_SESSION["airport"] = $location;
			$_SESSION["register_date"] = $register_date;
			$_SESSION["gva_hours"] = $gva_hours;
			$_SESSION["rank_id"] = $rank_id;
			$_SESSION["language"] = $language;
			$_SESSION["ivaovid"] = $ivaovid;
			$_SESSION["id"] = $id;
			$_SESSION["operator_id"] = $operator_id;
			$_SESSION["access_administration_panel"] = $access_administration_panel;
			$_SESSION["access_va_parameters"] = $access_va_parameters;
			$_SESSION["access_hub_manager"] = $access_hub_manager;
			$_SESSION["access_fleet_type_manager"] = $access_fleet_type_manager ;
			$_SESSION["access_fleet_manager"] = $access_fleet_manager;
			$_SESSION["access_rank_manager"] = $access_rank_manager;
			$_SESSION["access_pilot_manager"] = $access_pilot_manager;
			$_SESSION["access_route_manager"] = $access_route_manager;
			$_SESSION["access_route_assignator"] = $access_route_assignator;
			$_SESSION["access_user_type_manager"] = $access_user_type_manager;
			$_SESSION["access_event_manager"] = $access_event_manager;
			$_SESSION["access_notam_manager"] = $access_notam_manager;
			$_SESSION["access_email_manager"] = $access_email_manager;
			$_SESSION["access_language_manager"] = $access_language_manager;
			$_SESSION["access_financial_parameters"] = $access_financial_parameters;
			$_SESSION["access_tour_manager"] = $access_tour_manager;
			$_SESSION["access_award_manager"] = $access_award_manager;
			$_SESSION["access_operator_manager"] = $access_operator_manager;
			$_SESSION["access_flight_types"] = $access_flight_types;
			$_SESSION["access_docente"] = $access_docente;
			$_SESSION["access_pilot_status"] = $access_pilot_status;
			$_SESSION["access_tienda"] = $access_tienda;
			$_SESSION["access_airports_manager"] = $access_airports_manager;
			$_SESSION["access_invitation"] = $access_invitation;
			
			
			$query2 = "UPDATE gvausers set last_visit_date=now() where gvauser_id='$id'";
			if (!$result2 = $db->query($query2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
			
			$query3 = "insert into historial_login (gvauser_id,fecha,ip,navegador)
                    values ('$id',now(),'$IPUser','$navegador');";
			if (!$result3 = $db->query($query3)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			
	
	
			session_write_close (); 
			
		    echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=./index_user.php'>";
				
				/////////////////////////// FIN
			}
			
			
			
		
		} else {
			
			$mensaje = "Callsign o clave erradas.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=form_login';";
echo "</script>";  
		
		}
	}
	

	
?>