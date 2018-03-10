 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Texturas</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las Texturas Simuladores de Soporte de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">     
					<?php 
include('./db_login.php');
$sim_id = $_GET['sim_id'];
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from textures where idsim='$sim_id' order by icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>


<h2>Añadir Texture</h2>
<hr>
<a href="./?page=addtexture&sim_id=<?php echo $sim_id; ?>" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Texturas Actuales</h2>
<hr>		
                      									 







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>NOMBRE</b></th>
												<th><b>IMAGEN</b></th>
												<th><b>LINK</b></th>
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
	$sims=$row["id"];
	
	if($row["estado"]==1) {
		$estados = "ACTIVO";
	} else {
		$estados = "NO ACTIVO";
	}
	
	
	
	
	echo '<tr><td>';
		echo $row["nombre"] . '</td>';
		echo '<td><img src="./images/aviones/' . $row["imagen"] . '" WIDTH=20%></td>';
  echo '<td><a href="' . $row["link"] . '" target="_blank">Link</a></td>';
  echo '<td><center><span class="label label-success">' . $estados . '</span>
  <br><span class="label label-warning"><a href="./?page=editexture&text=' . $sims . '">Editar</a></span>
  <br><br><span class="label label-danger"><a href="./?page=eliminartexture&text=' . $sims . '">Eliminar</a></span> </center></td>';
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
