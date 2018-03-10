 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Cursos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Cursos de Entrenamiento</div>
                  <div class="row">
                    <div class="col-sm-12">   
<?php

		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 
	
?>






<br>
<br>
<h2>Curso de Entrenamiento</h2>
<hr>
<br>
<a href="./?page=addcursos" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>		
<br>
<br>
<br>
<hr>
<h2>Cursos Actuales</h2>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Nombre</b></th>
												<th><b>Docentes</b></th>
												<th><b>Aeronaves</b></th>
												<th><b>Rango | Aerolínea</b></th>
												<th><b>MODULOS</b></th>
												<th><b>EXAMENES</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$contadores=0;
$sql12 = "select * from courses";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			$contadores++;
			
			$course_id = $row12['course_id'];
	        $rangos = array();
			$sql = "select * from ranktypes_course where course_id='$course_id'";
	        if (!$result = $db->query($sql)) {
	         	die('There was an error running the query [' . $db->error . ']');
	        }
	        while ($row = $result->fetch_assoc()) {
	        	$rangos[] = $row["rank_id"];
	        }
				$imprimirinfo = "";
			if(!empty($rangos)) {
			
		
		
			$sql = "select * from ranks where rank_id  IN (" . implode(',', array_map('intval', $rangos)) . ")";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$rangos = $row["rank"];
		
		$operator_id_rank = $row["operator_id"];
		$operatorname = "";
		$sql_op = "select * from operators where operator_id='$operator_id_rank'";
	    if (!$result_op = $db->query($sql_op)) {
		   die('There was an error running the query [' . $db->error . ']');
	    }
	    while ($row_op = $result_op->fetch_assoc()) {
			$operatorname = $row_op['operator'];
		}
		
		$imprimirinfo = $imprimirinfo . '<li>' . $rangos . ' [' . $operatorname . ']</li>';
	}
			}
	
			 echo '<tr>';
									
										 echo '<td>' . $row12["name"] . '</td>';
										  echo '<td>' . $row12["docentes"] . '</td>';
										   echo '<td>' . $row12['aeronaves'] . '</td>';
										   echo '<td>' . $imprimirinfo . '</td>';
											echo '<td><a href="./?page=moduloscursos&id=' . $row12["course_id"]. '">** Administrar Módulos **</a></td>';
											echo '<td><a href="./?page=moduleexamens&id=' . $row12["course_id"]. '">** Administrar Examenes **</a></td>';
											echo '<td><a href="./?page=eliminarcurso&id=' . $row12["course_id"]. '">** Eliminar **</a><br><br>
											<a href="./?page=editarcurso&id=' . $row12["course_id"]. '">** Editar **</a></td>';
										echo '</tr>';
										
		}
		
		
		
		
?>
</tbody>
</table>



<?


if ($contadores==0) 
{
					echo '<div class="alert alert-danger"> No se han creado cursos.</div>';
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