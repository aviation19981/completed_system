
<?php
	
		
		$pilot = $_GET['pilotid'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 
		$sql_pro = "select * from gvausers where gvauser_id=$pilot";  
		
		if (!$result_pro = $db->query($sql_pro)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row_pro = $result_pro->fetch_assoc()) {
			
                  			
				$nombre_user = $row_pro['name'] . ' ' . $row_pro['surname'];
                $callsigns_user = $row_pro['callsign'];
                				
		}
		
		
		
		
	
?>


	 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Estudiante</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Estudiante <?php echo $nombre_user . ' (' . $callsigns_user . ') '; ?></div>
                  <div class="row">
                    <div class="col-sm-12">   

<h3><b>Docente: <?php echo $pilotname . ' ' . $pilotsurname . '  ' . $callsign; ?></b></h3>
<br>
<br>
<br>
<br>





























<h2>Añadir Notas</h2>
<hr>
<br>





	
	<form method="POST" action="?page=addnotas">

<div align="center">
<center>
<table class="table table-hover" border="0" width="100%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#33AFFF">
<p align="center"><font color="black">Estudiante: <?php echo $nombre_user . ' (' . $callsigns_user . ') '; ?></font></td>
<td width="50%"><input type="hidden" class="form-control"  name="estudiante" value="<?php echo $pilot; ?>" size="20"></td>
</tr>
<tr>
<td width="50%">Docente: </td>
<td width="50%"><input type="text" class="form-control"  name="docente" value="<?php echo $pilotname . ' ' . $pilotsurname; ?>" size="50" readonly="readonly" ></td>
</tr>
<tr>
</tr>
<tr>
<td width="50%">Tema: </td>
<td width="50%"> 
<select class="form-control" name="topic" id="topic">
<?php
$sql12 = "select * from temascalificacion";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			echo ' <option value="' . $row12['id'] . '">' . $row12['nombre'] . '</option>';
		}
		
		?>
</select>

</td>
</tr>
<tr>
<td width="50%">Nota: [0-5]</td>
<td width="50%"><input type="number" class="form-control" min="0" max="5" name="note" value="" size="20" required ></td>
</tr>
<tr>
<td width="50%">Comentarios: </td>
<td width="50%"><textarea id="comments" name="comments"  class="form-control"  rows="4" cols="50">
</textarea></td>
</tr>
<tr>
<td width="50%">Fecha: </td>
<td width="50%"><input type="text" class="form-control" name="date" value="<?php 
$time = time(); 
echo $fecha_actual=date("d F Y (H:i:s)", $time);?>" size="30"></td>
</tr>
<tr>
<td width="100%" colspan="2">
<p align="center"><input type="submit"  class="btn btn-primary btn-lg btn-block form-control" value="Agregar Nota" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>




<br>
<br>
<br>
<br>
<h2>Notas Actuales</h2>
<hr>
<br>
<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b>Tema</b></th>
												<th><b>Docente</b></th>
												<th><b>Fecha</b></th>
												<th><b>NOTA</b></th>
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
$sql1 = "select * from training where gvauser_id=$pilot";  
		$topis='';
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i = 0;
		$notas = 0;
		while ($row1 = $result1->fetch_assoc()) {
			$idents = $row1['tema'];
			$sql123 = "select * from temascalificacion where id='$idents'";  
		
		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row123 = $result123->fetch_assoc()) {
			$topis = $row123['nombre'];
		}
		
		
		if(empty($row1['comments'])) {
			$comments = '<div class="alert alert-danger" role="alert">No hay comentarios.</div>';
		} else {
			$comments = $row1['comments'];
		}
		
			$i++;
			 echo '<tr>';
										 echo '<td>+' . $i . '</td>';
										 echo '<td>' . $topis . '</td>';
										  echo '<td>' . $row1['docente'] . '</td>';
										   echo '<td>' . $row1['fecha'] . '</td>';
										   echo '<td>' . $row1['nota'] . '</td>';
										   echo '<td>' . $comments . '</td>';
										 echo '<td>';
										 echo '<a href="./?page=notaupdate&id=' . $row1["id"] . '">** Actualizar **</a><br>';
										 echo '<a href="./?page=notadelete&id=' . $row1["id"] . '&pilotid=' . $pilot . '">** Eliminar **</a>';
										 
										 echo '</td>';
										echo '</tr>';
										
										$notas = $notas + $row1['nota'];
										$calculo = ($notas/$i);
										$promedio = number_format($calculo, 1);
										
		}
		
		
?>
</tbody>
</table>
<?php 

if ($promedio < 3 && $i>0) {
	
	if ($i>=5) {
		echo '<center><div class="alert alert-danger" role="alert">El promedio de ' . $nombre . ' no cumple con los objetivos de la VA.</div></center>';
		
		echo '<center><div class="alert alert-success" role="alert">El piloto debe solicitar un refuerzo para mejorar el promedio.</div></center>';
		}
		
		echo '<center><div class="alert alert-warning" role="alert">El promedio Actual del Piloto es: ' . $promedio . '.</div></center>';
  }
		
			if ($promedio >= 3 && $i>=5) {
		echo '<center><div class="alert alert-success" role="alert">El piloto ha cumplido con el objetivo de la VA, puede continuar con el procedimiento del rango. Nota: ' . $promedio . '</div></center>';
        }
		
		if ($i>0 && $i <5) {
		echo '<center><div class="alert alert-warning" role="alert">El promedio Actual del Piloto es: ' . $promedio . '.</div></center>';
        }
		
		if ($i == 0) {
		echo '<center><div class="alert alert-danger" role="alert">El piloto no tiene ninguna nota registrada.</div></center>';
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