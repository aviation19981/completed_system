 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Hubs</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Hubs de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Hub</h2>
<hr>
<a href="./?page=addhub" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Hubs Actuales</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from hubs order by hub asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>ICAO</b></th>
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
echo $row["hub"] . '</td>';
		echo '<td><a href="./?page=edithub&hubid=' . $row["hub_id"] . '" class="btn btn-md btn-warning">Editar</a><br><br>
		<a href="./?page=hubdelete&hubid=' . $row["hub_id"] . '" class="btn btn-md btn-danger">Eliminar</a>
		</td>';
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
