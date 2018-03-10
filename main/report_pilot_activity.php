<?php
    include('./db_login.php');
	require_once('./sent_email.php');	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); 
	$db->set_charset("utf8"); 
	if ($db->connect_errno > 0) {
	   die('Unable to connect to database [' . $db->connect_error . ']');
    } 

$sql_uno_old = "select * from gvausers order by callsign asc";
if (!$result_uno_old = $db->query($sql_uno_old))  {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row_uno_old = $result_uno_old->fetch_assoc()) {
	   $contadores =0;
	    $activationknow = $row_uno_old["activation"];
	
	    if($activationknow!=0 && $activationknow!=3 && $activationknow!=4) {
		$gvauser_idshow = $row_uno_old["gvauser_id"];
		$ivaovidpca = $row_uno_old["ivaovid"];
		$fecha_envio1 = $row_uno_old["register_date"];
		$fecha_envio2 = 0;
			///////////////////////// Consultamos ultimo vuelo //////////////////////////////////
		
		$sql_dos = "SELECT * FROM cstpireps WHERE vid='$ivaovidpca' order by id desc LIMIT 1";
		
		if (!$result_dos = $db->query($sql_dos))  {
	       die('There was an error running the query [' . $db->error . ']');
        }

        while ($row_dos = $result_dos->fetch_assoc()) {
			
			//////////////////////// Contamos cuando fue el ultimo vuelo /////////////////////
			$contadores++;
			$fecha_envio2 = $row_dos['fecha_envio'];
			
		}
		    if($contadores==0) {
				$fecha_envio = $fecha_envio1;
			} else {
				$fecha_envio = $fecha_envio2;
			}
		
			$hoy = date('Y-m-d');
			
             
                	$dias	= (strtotime($fecha_envio)-strtotime($hoy))/86400;
                	$dias_pro 	= abs($dias); 
					$diastotales = floor($dias_pro);		
                	
               
            //////////////////////////////// DIAS OBTENIDOS //////////////////////////////////
           
			
			if($diastotales>=15) {
			
            ///////////////////////////// INACTIVAR CUENTA /////////////////////////

			        $sql_tres  = "update gvausers set activation=2 where gvauser_id='$gvauser_idshow'";

		            if (!$result_tres = $db->query($sql_tres)) {
		             	die('There was an error running the query  [' . $db->error . ']');
		            }
			
            ///////////////////////////// FIN INACTIVACION /////////////////////////			
			} else {
				
				
				///////////////////////////// ACTIVAR CUENTA /////////////////////////

			        $sql_cuatro  = "update gvausers set activation=1 where gvauser_id='$gvauser_idshow'";

		            if (!$result_cuatro = $db->query($sql_cuatro)) {
		             	die('There was an error running the query  [' . $db->error . ']');
		            }
			
            ///////////////////////////// FIN ACTIVAR /////////////////////////
				
				
				
			}
			

		
		
		}
		
	}
	
	
	//////////////////////////////////////////////////// CONSULTAR DIAS PARA EXPULSAR ////////////////////////////////////////////////
	
	    $sql_parametros = "SELECT maximium_days_fired FROM va_parameters WHERE va_parameters_id='1'";
		
		if (!$result_parametros = $db->query($sql_parametros))  {
	       die('There was an error running the query [' . $db->error . ']');
        }

        while ($row_parametros = $result_parametros->fetch_assoc()) {
			$maximium_days_fired = $row_parametros['maximium_days_fired'];
		}
	
	
	///////////////////////////////////////////////////////// NUEVAS FUNCIONES ////////////////////////////////////////////////////////
	////////////////////////////////////////// ELIMINAR USUARIOS POR INACTIVIDAD //////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	
$sql_uno = "select * from gvausers where activation=2 order by callsign asc";
if (!$result_uno = $db->query($sql_uno))  {
	die('There was an error running the query [' . $db->error . ']');
}
        $usuario=0;	
        $activationknow_pca=0;	
		$gvauser_idshow_pca =0;	
		$pilot_vid =0;	
		$pilot_id=0;	
		$fecha_envio_pca1 =0;	
		$imagens =0;	
		$name_pca =0;	
		$ivaovid_pca =0;	
		$email_pca =0;	
	
while ($row_uno = $result_uno->fetch_assoc()) {
        $usuario++;
	    $contadores_pca =0;
	    $activationknow_pca = $row_uno["activation"];
		$gvauser_idshow_pca = $row_uno["gvauser_id"];
		$pilot_vid = $row_uno['ivaovid'];
		$pilot_id = $row_uno['gvauser_id'];
		$fecha_envio_pca1 = $row_uno["register_date"];
		$imagens = $row_uno['pilot_image'];
		$name_pca = $row_uno['name'];
		$ivaovid_pca = $row_uno['ivaovid'];
		$email_pca = $row_uno['email'];
		$fecha_envio_pca2 = 0;
		$dias_pro 	= 0;
			///////////////////////// Consultamos ultimo vuelo //////////////////////////////////
		
		$sql_dos_pca = "SELECT * FROM cstpireps WHERE vid='$ivaovid_pca' order by id desc LIMIT 1";
		
		if (!$result_dos_pca = $db->query($sql_dos_pca))  {
	       die('There was an error running the query [' . $db->error . ']');
        }

        while ($row_dos_pca = $result_dos_pca->fetch_assoc()) {
			
			//////////////////////// Contamos cuando fue el ultimo vuelo /////////////////////
			$contadores_pca++;
			$fecha_envio_pca2 = $row_dos_pca['fecha_envio'];
			
		}
		
		if($contadores_pca==0) {
				$fecha_envio_pca = $fecha_envio_pca1; 
			} else {
				$fecha_envio_pca = $fecha_envio_pca2;
			}
		
			$hoy_pca = date('Y-m-d');
			
             
                	$dias_pca	= (strtotime($fecha_envio_pca)-strtotime($hoy_pca))/86400;
                	$dias_pro_pca 	= abs($dias_pca); 
					$diastotales_pca = floor($dias_pro_pca);	

        if($diastotales_pca>=$maximium_days_fired) {
			
			//////////////////////////////// Email ELIMINAR PILOTO /////////////////////////

            $mail = new system_mailer();
            $mail->fired_alliance($name_pca,$ivaovid_pca,$email_pca,$diastotales_pca,$maximium_days_fired);  
			
			
			//////////////////////////////// Eliminar datos del piloto /////////////////////
			
			unlink('./images/uploads/' . $imagens);
		
		$sql1 = "delete from gvausers where gvauser_id=$pilot_id";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		$sql12 = "delete from cstpireps where vid=$pilot_vid";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123 = "delete from award_pilots where gvauser_id=$pilot_id";  

		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234 = "delete from cancellations where gvauser_id=$pilot_id";  

		if (!$result1234 = $db->query($sql1234)) {
			die('There was an error running the query [' . $db->error . ']');
		}
	   
	   $sql12345 = "delete from bank where gvauser_id=$pilot_id";  

		if (!$result12345 = $db->query($sql12345)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123456 = "delete from compras_tienda where gvauser_id=$pilot_id";  

		if (!$result123456 = $db->query($sql123456)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234567 = "delete from fleettypes_gvausers where gvauser_id=$pilot_id";  

		if (!$result1234567 = $db->query($sql1234567)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql12345678 = "delete from jumps where gvauser_id=$pilot_id";  

		if (!$result12345678 = $db->query($sql12345678)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
	   $sql1234567890 = "delete from tour_pilots where gvauser_id=$pilot_id";  

		if (!$result1234567890 = $db->query($sql1234567890)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql12345678900 = "delete from va_finances where gvauser_id=$pilot_id";  

		if (!$result12345678900 = $db->query($sql12345678900)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
		}

}	
	
	

?>