 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Docencia</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Docentes Colstar Alliance</div>
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

<h2>Estudiantes de la Alianza</h2>
<hr>
<br>
<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b>Nombre</b></th>
												<th><b>Callsign</b></th>
												<th><b>Ubicación</b></th>
												<th><b>Rango</b></th>
												<th><b>CALIFICACIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
	$sql = "select * from gvausers where  operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i = 0;
		while ($row = $result->fetch_assoc()) {
			$i++;
			 echo '<tr>';
										 echo '<td>+' . $i . '</td>';
										 echo '<td>' . $row['name'] . ' ' . $row['surname'] . '</td>';
										  echo '<td>' . $row['callsign'] . '</td>';
										   echo '<td>' . $row['location'] . '</td>';
										   
										  echo '<td>';
										
										if (strlen($row["rank_image"]) > 0) {
							echo '<img src="./images/ranks/' . $row["rank_image"] . '" WIDTH=20%>' . ' ';
						}
						
						$rank_ids = $row['rank_id'];
						
        $sqle = "select * from ranks where rank_id=$rank_ids";
		
		if (!$resulte = $db->query($sqle)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($rowe = $resulte->fetch_assoc()) {
			$rank = $rowe["rank"];
		}
						
						
						
									
									
										
										echo '<span class="label label-success">' . $rank . '</span></td>';
										
										 echo '<td>';
										 echo '<a class="btn btn-md btn-info" href="./?page=perfomance&pilotid=' .$row['gvauser_id'] . '">Ver Notas | Añadir Notas</a></td>';
										echo '</tr>';
		}

?>
</tbody>
</table>

<br>
<br>
<br>
<br>

<h2>Citación Entrenamiento</h2>
<hr>
<br>





	
	<form method="POST" action="?page=addcite">

<div align="center">
<center>
<table class="table table-hover" border="0" width="100%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#33AFFF">
<p align="center"><font color="#FFFFFF">Docente: <?php echo $pilotname . ' ' . $pilotsurname . ' (' . $callsign . ') '; ?></font></td>
<td width="50%"><input type="hidden" name="docentes" value="<?php echo $id; ?>" size="20"></td>
</tr>
<tr>
<td width="50%">Estudiante: </td>
<td width="50%"><select class="form-control" name="estudiantes" id="estudiantes">
<?php 
$sql2 = "select * from gvausers where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";  
		
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row2 = $result2->fetch_assoc()) {
			 echo '<option value="' . $row2['gvauser_id'] . '">' . $row2['name'] . ' ' . $row2['surname'] . '</option>';
		}

?>
</select></td>

</tr>
<tr>
</tr>


<tr>
<td width="50%">Fecha: </td>
<td>


                            <span class="input-group-addon"><span class="fa fa-calendar"></span>

                            </span>

															<input type='date' name="date" id="date" class="form-control"/>









</td>
</tr>
<tr>
<br>
<td width="50%">Hora: </td>
<td width="50%"><input type="text" class="form-control" name="hour" value="" placeholder="Example 8:00 AM" size="20"></td>
</tr>
<tr>
<td width="50%">Comentarios: </td>
<td width="50%"><input type="textarea"class="form-control"  name="coment" value="" rows="8" cols="70"></td>
</tr>
<tr>
<td width="100%" colspan="2">
<br>
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Agregar Cita" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>


<br>
<br>
<br>
<br>
<h2>Citas Agendadas</h2>
<hr>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b>Piloto</b></th>
												<th><b>Docente</b></th>
												<th><b>Fecha</b></th>
												<th><b>Hora</b></th>
												<th><b>Comentarios</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$sql12 = "select * from citacion";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2 = 0;
		while ($row12 = $result12->fetch_assoc()) {
			
			if ($row12['docente'] == $id) {
			$i2++;
			 echo '<tr>';
										 echo '<td>+' . $i2 . '</td>';
										 $idss = $row12['piloto'];
										 $sql122 = "select * from gvausers where gvauser_id=$idss";  
		
		if (!$result122 = $db->query($sql122)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row122 = $result122->fetch_assoc()) {
			
			$pca = $row122['name'] . ' ' . $row122['surname'];
		}
		
		
										 echo '<td>' . $pca . '</td>';
										  echo '<td>Yo</td>';
										   echo '<td>' . $row12['fecha'] . '</td>';
										   echo '<td>' . $row12['hora'] . '</td>';
										    echo '<td>' . $row12['comentarios'] . '</td>';
											echo '<td>';
												 echo '<a class="btn btn-md btn-warning" href="./?page=citaupdate&id=' . $row12["id"] . '">Actualizar</a><br>';
										 echo '<a class="btn btn-md btn-danger" href="./?page=citadelete&id=' . $row12["id"]. '">Eliminar</a>';
										 
											
											echo '</td>';
										echo '</tr>';
										
		}
		
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