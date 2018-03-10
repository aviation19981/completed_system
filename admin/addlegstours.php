							
<?php 
include('./db_login.php');
$tour = $_GET['tour'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$contadores=0;

	$sql5 = "select * from tour_legs where tour_id='$tour' order by leg_number asc";
	if (!$result5 = $db->query($sql5)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row5 = $result5->fetch_assoc()) {
	$contadores++;
}
	

?>
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Legs del Tour</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información del Tour</div>
				  <p class="m-b-lg text-muted">Nuestra cobertura de Tours es de <?php echo $contadores; ?>.</p>
				  
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Legs</h2>
<hr>
<a href="./?page=addlegstoursva&tour=<?php echo $tour; ?>" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Legs Actuales</h2>
<hr>	








<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th><b>ORIGEN</b></th>
												<th><b>DESTINO</b></th>
												<th><b>RUTA</b></th>
												<th><b>DISTANCIA</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php


	
	$sql = "select * FROM tour_legs where tour_id='$tour' order by leg_number asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	
	
	
							
	echo '<tr>';
	
		echo '<td>' . $row["departure"] . '</td>';
		echo '<td>' . $row["arrival"] . '</td>';
		echo '<td>' . $row["route"] . '</td>';
		echo '<td>' . $row["leg_length"] . '</td>';
		echo '<td><a href="./?page=eliminarlegtourva&tour=' . $row["tour_leg_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updatetourlegva&tour=' . $row["tour_leg_id"] . '" class="btn btn-md btn-warning">Editar</a>';
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
