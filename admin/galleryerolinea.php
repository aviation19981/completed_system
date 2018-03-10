 <?php 
 $va = $_GET['va'];
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from operators where operator_id='$va'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row = $result->fetch_assoc()) {
		$operator_name = $row['operator'];
	}

?>
 
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Galería de la Aerolínea <?php echo $operator_name; ?></div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las fotos de <?php echo $operator_name; ?></div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Foto!</h2>
<hr>
<a href="./?page=addpictureva&va=<?php echo $va; ?>" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Fotos Actuales</h2>
<hr>	
							


<?php 

$sql = "select * from gallery_operators where operator_id='$va'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}


?>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>IMAGEN</b></th>
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
	
	
	echo '<tr>';
		echo '<td><img src="./images/portada/' . $row["img_operator"] . '" width="20%"></td>';
		echo '<td><a href="./?page=eliminarpic&va=' . $row["id"] . '" class="btn btn-md btn-danger">Eliminar</a></td>';
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
