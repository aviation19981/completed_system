
			
			 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Examen</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Examen de Módulo</div>
                  <div class="row">
                    <div class="col-sm-12">   
<?php
$curso_id = $_GET['id'];
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

<h3>Agregar Examen</h3>
<hr>

<form method="POST" action="./?page=addexamodule">

<div align="center">
<center>
<table class="table table-hover" border="0" width="100%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#0000FF">
<p align="center"><font color="#FFFFFF">Docente: <?php echo $pilotname . ' ' . $pilotsurname . ' (' . $callsign . ') '; ?></font></td>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
<td width="50%">Titulo Examen: </td>
<td width="50"><input type="text" class="form-control" name="title" value="" size="20"></td>
<input type="hidden" class="form-control" name="course_id" value="<?php echo $curso_id; ?>" size="20">
</tr>


<tr>
<td width="50%">Descripción Examen Examen: </td>
<td width="50"><input type="textarea"class="form-control"  name="coment" value="" rows="8" cols="70"></td>

</tr>


<tr>
<td width="50%">Duración en Minutos</td>
<td width="50">
<select name="duration"  class="form-control" id="duration"  >
<?php for ($i = 1; $i <= 60; $i++) { ?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>

</select>
</td>


</tr>



<tr>
<td width="50%">Módulo Perteneciente</td>
<td width="50">
<select name="training_id"  class="form-control" id="training_id"  >
<?php $sql12 = "select * from trainings where course_id='$curso_id'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2 = 0;
		while ($row12 = $result12->fetch_assoc()) { ?>
  <option value="<?php echo $row12['training_id']; ?>"><?php echo $row12['title']; ?></option>
<?php } ?>

</select>
</td>


</tr>

<tr>
<td width="50%">Máximo de Preguntas: <b><?php echo $limite; ?></b></td>
<td width="50"><input type="number" class="form-control" name="limite"  size="20"></td>

</tr>


<tr>
<td width="100%" colspan="2">
<br>
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Añadir Examen" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>






<br>
<br>
<h2>Examenes Agregados</h2>
<hr>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Titulo</b></th>
												<th><b>Duración</b></th>
												<th><b># Preguntas</b></th>
												<th><b>Módulo Asociado</b></th>
												<th><b>PREGUNTAS</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$sql12 = "select * from config_examen where id<>1 and course_id='$curso_id'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2 = 0;
		while ($row12 = $result12->fetch_assoc()) {
			
		$training_ids= $row12["training_id"];
		/////////////////////////////////
		$sql12r = "select * from trainings where training_id='$training_ids'";  
		
		if (!$result12r = $db->query($sql12r)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		while ($row12r = $result12r->fetch_assoc()) {
			$title = $row12r['title'];
		}
		///////////////////////
			$i2++;
		
			
			 echo '<tr>';
										 
										 echo '<td>' . $row12["titulo"] . '</td>';
										 echo '<td>' . $row12['duracion'] . ' min</td>';
										 echo '<td>+' . $row12['limite'] . '</td>';
										 echo '<td>' . $title . '</td>';
										 echo '<td><a href="./?page=preguntasexamenes&id=' . $row12["id"]. '">** Visualizar **</a></td>';
										 echo '<td><a href="./?page=deletetest&id=' . $row12["id"]. '">** Eliminar **</a></td>';
										echo '</tr>';
										
		}
		
		
		
		
?>
</tbody>
</table>



<?


if ($i2==0) 
{
					echo '<div class="alert alert-danger"> No se han creado examenes para este módulo</div>';
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