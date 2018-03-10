 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Pilotos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Pilotos de la Aerolínea</div>
                  <p class="m-b-lg text-muted">Nuestra tripulación es de <?php echo $num_pilots; ?> piloto(s).</p>
                  <div class="row">
                    <div class="col-sm-12">                      
                      									 
<?php 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
	$sql = "select * from gvausers where activation!=0 order by callsign asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	

	
	
}


?>

  





<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b><?php echo CALLSIGN; ?></b></th>
												<th><b><?php echo NOMBRE; ?></b></th>
												<th><b><?php echo RANGO; ?></b></th>
												<th><b><?php echo UBICACION; ?></b></th>
												<th><b><?php echo HORAS; ?></b></th>
												<th><b>ESTADO VA</b></th>
												<th><b><?php echo ESTADO; ?></b></th>
												<th><b><?php echo EDITAR; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php while ($row = $result->fetch_assoc()) { 

if (in_array($row['operator_id'], $airlines)) {
	
	?>
	
	
<?php

	
	$locationas = $row["location"];

$sql6 = "SELECT * FROM airports  where ident='$locationas'";

	if (!$result6 = $db->query($sql6)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6 = $result6->fetch_assoc()) {

		$location_airport_namesssls = $row6['name'];

		$location_airport_flagsssls = $row6['iso_country'];

	}
	
	$vidusuario = $row["ivaovid"];
	$horasvuelo= 0;
	
	$sql_pcas = "select * from cstpireps where vid=$vidusuario"; 
if (!$result_pcas = $db->query($sql_pcas)) {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row_pcas = $result_pcas->fetch_assoc()) {
	$horasvuelo=$horasvuelo+$row_pcas["connection_time"];
	}
	

										    echo '<tr>';
											
										echo '<td><a href="./index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '"><font color="red">' . $row["callsign"] . '</font></a></td>';
										echo '<td>' . $row["name"] . ' ' . $row["surname"] . '</td>';
										
										echo '<td>';
										
										if (strlen($row["rank_id"]) > 0) {
											
											$ranks_id = $row["rank_id"];
											
											$sql6s = "SELECT * FROM ranks  where rank_id='$ranks_id'";

	if (!$result6s = $db->query($sql6s)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6s = $result6s->fetch_assoc()) {

		$imgrank = $row6s['img'];
        $namerank = $row6s['rank'];

	}
	
	
							echo '<img src="./images/ranks/' . $imgrank . '" WIDTH=20%>' . ' ';
						}
						
										echo $namerank . '</td>';
										
										
										echo '<td>';
										
										echo $row["location"] . ' ';


echo '<img src="../../main/images/flags/24/' . $location_airport_flagsssls . '.png" alt="' . $location_airport_flagsssls . '">';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'. $location_airport_namesssls .'</font>';
												 
												 
										echo '</td>';
										
										
										$sumas= $horasvuelo + $row["transfered_hours"];
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';


										echo '<td>' . $total . '</td>';
										// 0 NUEVO
										// 1 ACTIVO
										// 2 INACTIVO
										
								if ($row["activation"] == 1)  { 
                                        $datos = '<span class="label label-success">ACTIVO</span>';
								} else if ($row["activation"] == 2)  { 
									$datos = '<span class="label label-warning">INACTIVO</span>';
								} else if ($row["activation"] == 0)  { 
									$datos = '<span class="label label-info">NUEVO</span>';
								} else if ($row["activation"] == 3)  { 
									$datos = '<span class="label label-danger">SUSPENDIDO</span>';
								} else if ($row["activation"] == 4)  { 
									$datos = '<span class="label label-info">VACACIONES</span>';
								}
						
						
										echo '<td>' . $datos . '</td>';
										
										
										
										if ($row["activation"] == 1)  { 
										
										$modulos = '<center><span class="label label-danger"><a href="./?page=eliminarpilot&pilot_id=' . $row["gvauser_id"] . '&pilot_vid=' . $row["ivaovid"] . '" >Eliminar</a></span></center>
										<br>
										<center><span class="label label-warning"><a href="./?page=inactivarpilot&pilot_id=' . $row["gvauser_id"] . '">Inactivar</a></span></center>'; 
										
										} else {
											
										$modulos = '<center><span class="label label-danger"><a href="./?page=eliminarpilot&pilot_id=' . $row["gvauser_id"] . '&pilot_vid=' . $row["ivaovid"] . '">Eliminar</a></span></center>
										<br>
										<center><span class="label label-info"><a href="./?page=activarpilot&pilot_id=' . $row["gvauser_id"] . '">Activar</a></span></center>'; 
										
										}
										
										echo '<td>' . $modulos . '</td>';
                                        echo '<td><span class="label label-info"><a href="./?page=editarpiloto&pilot_id=' . $row["gvauser_id"] . '">Editar</a></span></td>';
										
										  echo '</tr>';
										  
}									  
  }?>


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
