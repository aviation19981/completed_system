
			
			 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Examen</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Examen Práctico Calificación</div>
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



<h2>Buen día: <?php echo $pilotname . ' ' . $pilotsurname . '  ' . $callsign; ?></h2>
<br>


<h2>Aspirantes por Calificar</h2>
<hr>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Información Usuario</b></th>
												<th><b>Fecha</b></th>
												<th><b>Calificación Teórico</b></th>
												<th><b>Calificación Entrevista</b></th>
												<th><b>Total Calificación</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$sql12 = "select * from presentacionexamen where estado=2";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$cont=0;
		while ($row12 = $result12->fetch_assoc()) {
			$cont++;
			
			if($row12["operator_id"]==0) {
				
				$va = '<span class="label label-danger">Examen de temporadas anteriores, no menciona aerolínea</span>';
				
			} else {
				
		$operator_id_va = $row12["operator_id"];
		
		$sql_id_va = "select operator from operators where operator_id='$operator_id_va'";  
		
		if (!$result_id_va = $db->query($sql_id_va)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row_id_va = $result_id_va->fetch_assoc()) {
			$va = '<span class="label label-success">' .  $row_id_va["operator"] . '<span class="label label-danger">';
		}
				
				
				
				
				
			}
		
			
			 echo '<tr>';
										 echo '<td>' . $row12["nombres"] . ' ' . $row12["apellidos"] . ' [<a href="https://www.ivao.aero/Member.aspx?ID=' . $row12["vid"] . '" target="_blank">' . $row12["vid"] . '</a>] [' . $row12['rango'] . ']<br>' . $row12['email'] . '<br>' . $va . '</td>';

										   echo '<td>' . $row12['fecha'] . ' (' . $row12['ip'] . ')</td>';
											 echo '<td>' . $row12['calificacion'] . '</td>';
											 echo '<td>' . $row12['calificacionentrevista'] . '</td>';
											 echo '<td>' . $row12['calificaciontotal'] . '</td>';
											echo '<td>';
											 echo '<a href="./?page=entrevistanotaadd&id=' . $row12["id"]. '">** Agregar Nota Entrevista **</a><br>';
										 echo '<a href="./?page=deleteexamenprese&id=' . $row12["id"]. '">** Eliminar **</a>';
											echo '</td>';
										echo '</tr>';
										
		}
		
		
		
		
?>
</tbody>
</table>



<?

if ($cont==0) {
	echo '<div class="alert alert-danger"> No hay examenes en proceso.</div>';
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