 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Objetivos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Objetivos de Entrenamiento</div>
                  <div class="row">
                    <div class="col-sm-12">   
<?php
	if ($_SESSION["access_docente"] == '1')
	{	
		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 

		
	
?>






<br>
<br>
<h2>Objetivo a Calificar</h2>
<hr>
<br>
<form action="./?page=addaim" method="post">
  <label>Nombre del Objetivo:</label>
  <input type="text" class="form-control" name="objetivo" value="">
  <br>
  <hr>
  <br>
  <input type="submit" class="btn btn-primary btn-lg btn-block form-control"   value="Agregar Objetivo">
</form>
<br>
<br>
<br>
<hr>
<h2>Objetivos Actuales</h2>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Nombre Objetivo</b></th>
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
$sql12 = "select * from temascalificacion";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
		$i2++;
			
			
			 echo '<tr>';
			echo '<td>' . $row12["nombre"] . '</td>';
										 echo '<td><a class="btn btn-md btn-danger" href="./?page=eliminaraim&id=' . $row12["id"]. '">Eliminar</a></td>';
										echo '</tr>';
										
		}
		
		
		
		
?>
</tbody>
</table>



<?


if ($i2==0) 
{
					echo '<div class="alert alert-danger"> No se han creado objetivos.</div>';
				}
				

}
				else
				{
					echo '<div class="alert alert-danger"> You do not have access to teacher module</div>';
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