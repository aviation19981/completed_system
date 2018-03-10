
<?php
	include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$numeroYear = date("Y"); 
	$numeroSemanaActual = date("W"); 
	?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Informes de Horas Por Semana <b>(Año <?php echo $numeroYear; ?>)</b></div>
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
	 $pilotos=0;
	$sql = "select * from gvausers where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") and activation<>0 order by callsign asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row = $result->fetch_assoc()) { 
 $pilotos++;
}
	
	
	///////////////////////// Parameters
	
	
	$sql_parat = "SELECT * from va_parameters where va_parameters_id=1";
    
	if (!$result_parat = $db->query($sql_parat)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_parat = $result_parat->fetch_assoc()) {
		$hours_min_per_week = $row_parat['hours_min_per_week'];
		
	}
	
	
	$horastotales = $pilotos*$hours_min_per_week;
/**
 * Función para saber el numero de semanas que tiene un año dado
 */
function NumeroSemanasTieneUnAno($year)
{
    $date = new DateTime;
 
    # Establecemos la fecha segun el estandar ISO 8601 (numero de semana)
    $date->setISODate($year, 53);
 
    # Si estamos en la semana 53 devolvemos 53, sino, es que estamos en la 52
    if($date->format("W")=="53")
        return 53;
    else
        return 52;
}
 
$numeroSemana = NumeroSemanasTieneUnAno($numeroYear);
	
	

?>

  





<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Semana</b></th>
												<th><b>Año</b></th>
												<th><b><?php echo HORAS; ?></b></th>
												<th><b><?php echo ESTADO; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
<?php

for($i=1;$i<=$numeroSemana;$i++)
{
	
	
	
	$horas = 0;
	$sql_vuelos_myself = "SELECT * from cstpireps where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") and YEAR(fecha_envio)='$numeroYear' and WEEK(fecha_envio, 1)='$i'";
    
	if (!$result_vuelos_myself = $db->query($sql_vuelos_myself)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_vuelos_myself = $result_vuelos_myself->fetch_assoc()) {
		$horas = $horas+$row_vuelos_myself['connection_time'];
	}
	
	$sumas= $horas;
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$gva_hours= $horas.' h '.$minutos . ' m';


if($i<=$numeroSemanaActual) {
	echo '<tr>';
	echo '<td>' . $i . '</td>';
	echo '<td>' . $numeroYear . '</td>';
	echo '<td>' . $gva_hours . '</td>';
	if ($horas>=$horastotales)  { 
                                        $datos = '<span class="label label-success">Cumplió con el mínimo de ' . $horastotales . ' hrs esta semana</span>';
                                } else {
									$datos = '<span class="label label-danger">No Cumplió con el mínimo de ' . $horastotales . ' hrs esta semana</span>';
								} 
						
						
										echo '<td>' . $datos . '</td>';
										
										  echo '</tr>';
	
}




	
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
