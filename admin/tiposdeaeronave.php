 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tipos de Aeronave</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Tipos de Aeronave de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Tipo de Aeronave</h2>
<hr>
<a href="./?page=addaeronavetipo" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Tipos de Aeronave Actuales</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from fleettypes order by plane_icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>ICAO</b></th>
												<th><b>DESCRIPCIÓN AERONAVE</b></th>
												<th><b>PAX</b></th>
												<th><b>MIEMBROS TRIPULACIÓN</b></th>
												<th><b>CAPACIDAD CARGA</b></th>
												<th><b>PRECIO UNITARIO</b></th>
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
	
	
	echo '<tr><td>';
echo $row["plane_icao"] . '</td><td>';
echo $row["plane_description"] . '</td><td>';
echo $row["pax"] . '</td><td>';
echo $row["crew_members"] . '</td><td>';
echo $row["cargo_capacity"] . '</td><td>';
echo $row["unit_price"] . '</td>';
		echo '<td><a href="./?page=eliminartipodeaeronave&aeronaveid=' . $row["fleettype_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updatetipoaeronave&aeronaveid=' . $row["fleettype_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
echo '</tr>';
						 
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
