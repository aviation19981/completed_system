
<?php
	
		
		$id = $_GET['id'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$idss = $id;
		
		$sql1 = "select * from citacion where id=$id";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1 = $result1->fetch_assoc()) {
			
			$gvauser_id = $row1['piloto'];
			$docente = $row1['docente'];
			$fecha = $row1['fecha'];
			$hora = $row1['hora'];
			$comentarios = $row1['comentarios'];
			
		}
		
		
		$sql2 = "select * from gvausers where gvauser_id=$docente";

		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row2 = $result2->fetch_assoc()) {
			
			$docentesname = $row2['name'] . ' ' . $row2['surname'];
			
		}
		
		$sql3 = "select * from gvausers where gvauser_id=$gvauser_id";

		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row3 = $result3->fetch_assoc()) {
			
			$docentesname3 = $row3['name'] . ' ' . $row3['surname'];
			
		}
		
		
	
?>


	 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Citación</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Actualización de Cita</div>
                  <div class="row">
                    <div class="col-sm-12">   






	<form method="POST" action="?page=updatecite">

<div align="center">
<center>
<table border="0" width="50%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#0000FF">
<p align="center"><font color="#FFFFFF">Docente: <?php echo $docentesname; ?></font></td>
<td width="50%"><input type="hidden" name="docentes" class="form-control"  value="<?php echo $docente; ?>" size="20" readonly="readonly"></td>
</tr>
<tr>
<td width="50%">Estudiante: </td>
<td width="50%"><input type="text" name="estudiantes" class="form-control"  value="<?php echo $docentesname3; ?>" size="20" readonly="readonly"></td>

</tr>
<tr>
</tr>


<tr>
<td width="50%">Fecha: </td>
<td>

	<div class='input-group date' id='datetimepicker'>

                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>

                            </span>

															<input type='date' name="date" id="date"

															       value="<?php echo $fecha; ?>" class="form-control"/>



														</div>





</td>
</tr>
<tr>
<td width="50%">Hora: </td>
<td width="50%"><input type="text" class="form-control"  name="hour" value="<?php echo $hora; ?>"  size="20"></td>
</tr>
<tr>
<td width="50%">Comentarios: </td>
<td width="50%"><input type="textarea" class="form-control" name="coment" value="<?php echo $comentarios; ?>" rows="8" cols="70"></td>
</tr>
<input type="hidden" name="identi" value="<?php echo $idss; ?>" size="20">
<tr>


<td width="100%" colspan="2">
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Actualizar Cita" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>




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