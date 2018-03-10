 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Rutas de la Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las Vuelos de la Aerolínea</div>
				  <p class="m-b-lg text-muted">Nuestra cobertura de rutas es de <?php echo $cstpirepse; ?> vuelo(s).</p>
				  
                  <div class="row">
                    <div class="col-sm-12">  


	
<h2>Vuelos Actuales</h2>
<hr>	
							
<?php 
include('./db_login.php');
$ICAO = strtoupper($_POST['departure']);
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th width="50px"><b>AEROLÍNEA</b></th>
												<th><b>CALLSIGN</b></th>
												<th><b>ORIGEN</b></th>
												<th><b>DESTINO</b></th>
												<th><b>ETD</b></th>
												<th><b>ETA</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php

	$sql = " select * from routes where departure='$ICAO' and operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	
	
	
	
	
	
	
	
	
	
	
	
	  $sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row["operator_id"]) {
							
							
							$img = $row_operator["file"];
							
							}
							
							}
							
	echo '<tr>';
	
		echo '<td><img src="./images/operators/' . $img . '" width="100%"></td>';
		echo '<td>' . $row["flight"] . '</td>';
		echo '<td>' . $row["departure"] . '</td>';
		echo '<td>' . $row["arrival"] . '</td>';
		echo '<td>' . $row["etd"] . '</td>';
		echo '<td>' . $row["eta"] . '</td>';
		echo '<td><a href="./?page=eliminarvuelova&vuelo=' . $row["route_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updatevuelova&vuelo=' . $row["route_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
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
