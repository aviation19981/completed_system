 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aeronaves</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las Aeronaves de la Aerolínea</div>
				  <p class="m-b-lg text-muted">Nuestra flota es de <?php echo $num_planes; ?> aeronave(s).</p>
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Aeronave</h2>
<hr>
<a href="./?page=addaeronaveva" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			
<hr>
<a href="./?page=repararaeronaves" class="btn btn-warning btn-lg btn-block" width="100%">Reparar Todas las Aeronaves</a>		
<hr>
<a href="./?page=moveraeronaves" class="btn btn-danger btn-lg btn-block" width="100%">Mover al Hub Aeronaves</a>	

<hr>
<a href="./?page=selcal_update" class="btn btn-info btn-lg btn-block" width="100%">Actualizar SELCAL Aeronaves</a>	
<br>
<br>
<h2>Aeronaves Actuales</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$sql = "select * FROM fleets order by name asc";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th><b>ICAO</b></th>
												<th><b>MATRÍCULA</b></th>
												<th><b>UBICACIÓN</b></th>
												<th><b>HORAS</b></th>
												<th><b>ESTADO</b></th>
												<th><b>RESERVADO</b></th>
												<th><b>NOMBRE</b></th>
												<th><b>HUB</b></th>
												<th><b>HANGAR</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php 
while ($row = $result->fetch_assoc()) {
	
	if (in_array($row['operator_id'], $airlines)) {
		
	$fleettype_id =$row["fleettype_id"];
	
	$sql1 = "select * from fleettypes where fleettype_id=$fleettype_id";
	if (!$result1 = $db->query($sql1)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row1 = $result1->fetch_assoc()) {
		$plane_icao = $row1["plane_icao"];
	}
	
	$hub_id= $row["hub_id"];
	
	$sql12 = "select * from hubs where hub_id=$hub_id";
	if (!$result12 = $db->query($sql12)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row12 = $result12->fetch_assoc()) {
		$hub = $row12["hub"];
	}
	
	$sumas= $row["hours"];
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';

                        if ($row["hangar"] == 1) {
							$mantenimiento = '<span class="btn btn-md btn-danger">SI</pan>';
						} else {
							$mantenimiento = '<span class="btn btn-md btn-success">NO</pan>';
						}
							if ($row["booked"] == 1) {
								$reservas = '<span class="btn btn-md btn-danger">SI</pan>';
							} else {
								$reservas = '<span class="btn btn-md btn-success">NO</pan>';
							}
						

	echo '<tr>';
		echo '<td>' . $plane_icao . '</td>';
		echo '<td>' . $row["registry"] . '</td>';
		echo '<td>' . $row["location"] . '</td>';
		echo '<td>' . $total . '</td>';
		echo '<td>' . $row["status"] . '%</td>';
		echo '<td>' . $reservas. '</td>';
		echo '<td>' . $row["name"] . '</td>';
		echo '<td>' . $hub . '</td>';
		echo '<td>' . $mantenimiento . '</td>';
		echo '<td><a href="./?page=eliminaraeronaveva&aeronave=' . $row["fleet_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updateaeronaveva&aeronave=' . $row["fleet_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
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
