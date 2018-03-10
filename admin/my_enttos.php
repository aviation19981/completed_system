
			
			 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Entrenamientos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Entrenamientos Solicitados</div>
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
<h4>Toda comunicación y pasos en el proceso de los entrenamientos deberá ser realizado con su correo inscrito en base de datos (<?php echo $email; ?>), esta zona es solo para confirmar al usuario las acciones ya realizadas con el fin de que el también las previsualice en la página web y en el correo.</h4>

<h3>Estado Entrenamientos</h3>
<hr>

                                    <div class="row">
                                        <div class="col-sm-8 col-md-12">
                                            <div class="row">
                                              




<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b>Estudiante</b></th>
												<th><b>Aeronave</b></th>
												<th><b>Comentarios</b></th>
												<th><b>Estado</b></th>
												<th><b>Opciones</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody align="left">
										 
										 <?php
        $i=0;
		$sql = "select * from request_entto where id_teacher='$id' and estado<>3 and estado<>4 order by fecha_solicitud asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowenttos = $result->fetch_assoc()) {
		$i++;
		$id_student = $rowenttos['id_student'];
		
	$sql_docente = "select * from gvausers where gvauser_id='$id_student'";

	if (!$result_docente = $db->query($sql_docente)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowenttos_docente = $result_docente->fetch_assoc()) {
		$estudianteinfo = $rowenttos_docente['name'] . ' ' . $rowenttos_docente['surname'] . ' [' . $rowenttos_docente['email'] . ']' . ' [' . $rowenttos_docente['callsign'] . ']';
	}
	
	
	
	////////// Códigos Estado
	////// 0 Solicitado
	////// 1 Contactado
	////// 2 Fecha Fijada
	////// 3 Finalizado
	////// 4 Cancelado
	////// 5 Reprogramado
	
	
	if($rowenttos['estado']==0) {
	             $estado = '<div class="alert alert-danger">Solicitado</div>';
	} else if($rowenttos['estado']==1) {
	             $estado = '<div class="alert alert-success">Contactado</div>';
	} else if($rowenttos['estado']==2) {
	             $estado = '<div class="alert alert-danger">Programado<br>Fecha: ' . $rowenttos['fecha_entto'] . ' [' . $rowenttos['hora_entto'] . ']</div>';
	} else if($rowenttos['estado']==3) {
	             $estado = '<div class="alert alert-success">Finalizado</div>';
	} else if($rowenttos['estado']==4) {
	             $estado = '<div class="alert alert-danger">Cancelado</div>';
	} else if($rowenttos['estado']==5) {
	             $estado = '<div class="alert alert-danger">Reprogramado<br>Fecha: ' . $rowenttos['fecha_entto'] . ' [' . $rowenttos['hora_entto'] . ']</div>';
	}
	
	
	
	
	if($rowenttos['estado']==0) {
	             $boton = '<a class="btn btn-primary btn-lg btn-block" href="./?page=enttoprocess&id_consulta=1&id_entto=' . $rowenttos['id_entto'] . '">Contactar Usuario<br>Esperando para programar entto...</a>';
	} else if($rowenttos['estado']==1) {
	             $boton = '<a class="btn btn-primary btn-lg btn-block" href="./?page=enttoprocess&id_consulta=2&id_entto=' . $rowenttos['id_entto'] . '">Programar Entrenamiento<br>Esperando para finalizar entto...</a>';
	} else if($rowenttos['estado']==2) {
	             $boton = '<a class="btn btn-danger btn-lg btn-block" href="./?page=enttoprocess&id_consulta=4&id_entto=' . $rowenttos['id_entto'] . '">Cancelar Entrenamiento!</a>
				           <br>
						   <a class="btn btn-success btn-lg btn-block" href="./?page=enttoprocess&id_consulta=5&id_entto=' . $rowenttos['id_entto'] . '">Reprogamar Entrenamiento!</a>';
	} else if($rowenttos['estado']==3) {
	             $estado = '<div class="alert alert-success">Finalizado</div>';
	} else if($rowenttos['estado']==4) {
	             $estado = '<div class="alert alert-danger">Cancelado</div>';
	} else if($rowenttos['estado']==5) {
	             $boton = '<a class="btn btn-danger btn-lg btn-block" href="./?page=enttoprocess&id_consulta=4&id_entto=' . $rowenttos['id_entto'] . '">Cancelar Entrenamiento!</a>
				           <br>
						   <a class="btn btn-success btn-lg btn-block" href="./?page=enttoprocess&id_consulta=5&id_entto=' . $rowenttos['id_entto'] . '">Reprogamar Entrenamiento!</a>';
	}


							
		?>


										 <tr>
										   <td><?php echo $i; ?></td>
										   <td><?php echo $estudianteinfo; ?></td>
										   <td><?php echo $rowenttos['plane']; ?></td>
										   <td><?php echo $rowenttos['comments']; ?></td>
										   <td><?php echo $estado; ?></td>
										   <td><?php echo $boton; ?></td>
										 </tr>
										 
										 
	<?php } 
	
	if($i==0) {
		
		echo '<tr><td colspan="5"><div class="alert alert-danger">No hay entrenamientos solicitados</div></td></tr>';
		
		
	}
	
	
	
	?>



</tbody>
</table>						


<?			
			
		
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