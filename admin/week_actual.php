
<?php
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	date_default_timezone_set('America/Bogota');
	$numeroSemana =  date("W"); 
	$numeroYear = date("Y"); 
	
	?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Informes de Horas <b>(Semana <?php echo $numeroSemana; ?> :: Año <?php echo $numeroYear; ?>)</b></div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Pilotos de la Aerolínea(s) Permitidas a Ver:</div>
				  <?php echo $airlines_allowed_staff; ?>
				  <hr>
                  <div class="row">
                    <div class="col-sm-12">                      
                      									 
<?php 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
	$sql = "select * from gvausers where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") and activation<>0 order by callsign asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
}


?>

  





<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo CALLSIGN; ?></b></th>
												<th><b><?php echo NOMBRE; ?></b></th>
												<th><b><?php echo HORAS; ?></b></th>
												<th><b><?php echo ESTADO; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php while ($row = $result->fetch_assoc()) { 


    $gvauser_id_pilot = $row['gvauser_id'];
	$operator_id_session_user = $row['operator_id'];
	$pilotname = $row['name'] . ' ' . $row['surname'];
	$callsign_pilot = $row['callsign'];
	$vidivao = $row['ivaovid'];
	
	
	
	
	$horas = 0;
	$sql_vuelos_myself = "SELECT * from cstpireps where operator_id='$operator_id_session_user' and YEAR(fecha_envio)='$numeroYear' and WEEK(fecha_envio, 1)='$numeroSemana' and gvauser_id='$gvauser_id_pilot'";
    
	if (!$result_vuelos_myself = $db->query($sql_vuelos_myself)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_vuelos_myself = $result_vuelos_myself->fetch_assoc()) {
		$horas = $horas+$row_vuelos_myself['connection_time'];
	}
	
	///////////////////////// Parameters
	
	
	$sql_parat = "SELECT * from va_parameters where va_parameters_id=1";
    
	if (!$result_parat = $db->query($sql_parat)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_parat = $result_parat->fetch_assoc()) {
		$hours_min_per_week = $row_parat['hours_min_per_week'];
		
	}
	
	
$sumas= $horas;
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$gva_hours= $horas.' h '.$minutos . ' m';

	

										echo '<tr>';
										echo '<td>' . $callsign_pilot . '</td>';
										echo '<td>' . $pilotname . ' ('  . $vidivao . ')</td>';
										echo '<td>' . $gva_hours . '</td>';
										
										
								if ($horas>=$hours_min_per_week)  { 
                                        $datos = '<span class="label label-success">Cumplió con el mínimo de 2 hrs esta semana</span>';
                                } else {
									$datos = '<span class="label label-danger">No Cumplió con el mínimo de 2 hrs esta semana</span>';
								} 
						
						
										echo '<td>' . $datos . '</td>';
										
										  echo '</tr>';
										  
}									  
  ?>


 </tbody>
                                    </table>





                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
