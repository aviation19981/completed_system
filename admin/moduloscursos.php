 <?php
$curso_id = $_GET['id'];
		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	
        $sql12especifico = "select * from courses where course_id='$curso_id'";  
		
		if (!$result12especifico = $db->query($sql12especifico)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12especifico = $result12especifico->fetch_assoc()) {
          $namecourse = $row12especifico["name"];
		}		
		 
	
?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Módulos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Módulos del Curso <?php echo  $namecourse; ?></div>
                  <div class="row">
                    <div class="col-sm-12">   






<br>
<br>
<h2>Agregar Módulo</h2>
<hr>
<br>
<form action="./?page=addcursomodulo" method="post">
    
    <input type="hidden" id="curso_id" name="curso_id" value="<?php echo $curso_id; ?>"/>
    <button class="btn btn-primary btn-lg btn-block" type="submit">Agregar</button>
</form>
<br>
<br>
<br>
<hr>
<h2>Módulos Actuales</h2>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Título</b></th>
												<th><b>Visualizar</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$i2=0;
$sql12 = "select * from trainings where course_id='$curso_id'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
		$i2++;
			
			
			 echo '<tr>';
									
										 echo '<td>' . $row12["title"] . '</td>';
											echo '<td><a href="./?page=vermodulos&id=' . $row12["training_id"]. '">** Ver **</a></td>';
											echo '<td><a href="./?page=editarmodule&id=' . $row12["training_id"]. '">** Editar **</a><br>
											<br><a href="./?page=eliminarmodule&id=' . $row12["training_id"]. '&moduloid=' . $curso_id . '">** Eliminar **</a></td>';
										echo '</tr>';
										
		}
		
		
		
		
?>
</tbody>
</table>



<?


if ($i2==0) 
{
					echo '<div class="alert alert-danger"> No se han creado módulos para este curso.</div>';
				}

				?>



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