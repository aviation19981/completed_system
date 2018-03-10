 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tipos de Usuario</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Tipos de Usuario de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Tipo de Usuario</h2>
<hr>
<a href="./?page=addusuariotipo" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Tipos de Usuario Estáticos</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from user_types where user_type_id=8 or user_type_id=2 or user_type_id=4";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>TIPO DE USUARIO</b></th>
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
		echo $row["user_type"] . '</td>';
		echo '<td><a href="#" class="btn btn-md btn-success">Usuario Permanente</a><br><br>
						<a href="./?page=updatetipodeusuario&tipousuario=' . $row["user_type_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
echo '</tr>';
						 
						 }?>


 </tbody>
                                    </table>
									
									
									
									<br>
<br>
<h2>Tipos de Usuario Dinámicos</h2>
<hr>	
							
<?php 
	
	$sql2 = "select * from user_types where user_type_id<>8 and user_type_id<>2 and user_type_id<>4";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>TIPO DE USUARIO</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php 
while ($row2 = $result2->fetch_assoc()) {
	
	
	    echo '<tr><td>';
		echo $row2["user_type"] . '</td>';
		echo '<td><a href="./?page=eliminartipodeusuario&tipousuario=' . $row2["user_type_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updatetipodeusuario&tipousuario=' . $row2["user_type_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
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
