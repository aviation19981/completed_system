 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Correos de Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Correos de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Correo</h2>
<hr>
<a href="./?page=addemail" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Correos Actuales de Contacto</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from config_emails where config_emails_id<>0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Email</b></th>
												<th><b>Cargo</b></th>
												<th><b>Usuario</b></th>
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
	
	$staff = $row["staff"];
	
	$sql_pca = "select * from gvausers where gvauser_id='$staff'";
	if (!$result_pca = $db->query($sql_pca)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_pca = $result_pca->fetch_assoc()) {
		$name_staff = $row_pca['name'] . ' ' . $row_pca['surname'];
	}
	
	echo '<tr>';
		echo '<td>' . $row["staff_email"] . '</td>';
		echo '<td>' . $row["cargo"] . '</td>';
		echo '<td>' . $name_staff . '</td>';
		echo '<td><a href="./?page=eliminaremail&config_emails_id=' . $row["config_emails_id"] . '" class="btn btn-md btn-warning">Eliminar</a> </td>';
echo '</tr>';
						 
						 }?>


 </tbody>
                                    </table>

									
									
									<br>
<br>
<h2>Correo Sistema</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from config_emails where config_emails_id=0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Email</b></th>
												<th><b>Administrador</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php 
while ($row = $result->fetch_assoc()) {
	
	echo '<tr>';
		echo '<td>' . $row["staff_email"] . '</td>';
		echo '<td>' . $row["staff"] . '</td>';
echo '</tr>';
						 
						 }?>


 </tbody>
                                    </table>

<hr>
<a href="./?page=emailsystem" class="btn btn-primary btn-lg btn-block" width="100%">Actualizar Correo Sistema</a>		


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
