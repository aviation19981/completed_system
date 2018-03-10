 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Rangos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Rangos de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">     

<h2>Rangos de Aerolínea(s)</h2>
<hr>		
                      									 
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
		$sql_airlines_allow = "SELECT * from operators";
	if (!$result_airlines_allow = $db->query($sql_airlines_allow)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_airlines_allow = $result_airlines_allow->fetch_assoc()) {
			$operator_id_rank = $row_airlines_allow['operator_id'];
			if (in_array($row_airlines_allow['operator_id'], $airlines)) {
				
			   ?>
			   
			   <div class="col-lg-12 col-sm-12 ">
                <div class="panel-group accordion" id="accordion<?php echo $row_airlines_allow['operator_id'] ; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion<?php echo $row_airlines_allow['operator_id'] ; ?>" href="#collapse<?php echo $row_airlines_allow['operator_id'] ; ?>">
                                    <i class="switch fa fa-plus"></i> <?php echo $row_airlines_allow['operator'] ; ?> </a>
								 </h4>
                        </div>
                        <div id="collapse<?php echo $row_airlines_allow['operator_id'] ; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
							<div class="accordion-inner">
<h2>Añadir Rangos</h2>
<hr>
<a href="./?page=addrangosva&va=<?php echo $row_airlines_allow['operator_id'] ; ?>" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
								<h2>Rango de <?php echo $row_airlines_allow['operator'] ; ?></h2>
<hr>



<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>RANGO</b></th>
												<th><b>IMAGEN</b></th>
												<th><b>MINIMO HORAS</b></th>
												<th><b>MAXIMO HOTAS</b></th>
												<th><b>SALARIO</b></th>
												<th><b>AERONAVES</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php 

$sql = "select * from ranks where operator_id='$operator_id_rank' order by maximum_hours asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
$contaraeronaves=0;
$otrocontador=0;
$aeronaves ="";
while ($row = $result->fetch_assoc()) {
	$ranks=$row["rank_id"];
	
	$fleettype_id_allow = array();
	$sql29 = "select * from fleettypes_ranks where operator_id='$operator_id_rank' and rank_id='$ranks'";
	if (!$result29 = $db->query($sql29)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row29 = $result29->fetch_assoc()) {
		
			$fleettype_id_allow[] = $row29['fleettype_id'];
		
		
	}
	

	
	$sql2 = "select * from fleettypes";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row2 = $result2->fetch_assoc()) {
		if (in_array($row2['fleettype_id'], $fleettype_id_allow)) {
			$aeronaves = $aeronaves . $row2['plane_icao'] . '<br>';
		}
		
	}
	
	
	
	echo '<tr><td>';
		echo $row["rank"] . '</td><td>';
						echo '<IMG src="./images/ranks/'.$row["img"].'" ALT="">'. '</td><td>';
						echo $row["minimum_hours"] . '</td><td>';
						echo $row["maximum_hours"] . '</td><td>';
						echo $row["salary_hour"] . '</td><td>';
						echo $aeronaves . '</td>';
						 echo '<td><span class="label label-danger"><a href="./?page=eliminarrango&rank_id=' . $row["rank_id"] . '">Eliminar</a></span><br><br>
						<span class="label label-warning"><a href="./?page=rangoeditar&rank_id=' . $row["rank_id"] . '">Editar</a></span></span> 						</td>';
echo '</tr>';
						 
						 }?>


 </tbody>
                                    </table>





			
											</div></div>
                        </div>
                    </div>
                    
                </div>
            </div>
			
			<?php
            }
			
			
			
		}
	
?>









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
