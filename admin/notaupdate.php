
<?php
	
		
		$id = $_GET['id'];
		$pilotid = $_GET['pilotid'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		$sql1 = "select * from training where id=$id";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1 = $result1->fetch_assoc()) {
			
			$gvauser_id = $row1['gvauser_id'];
			$temas = $row1['tema'];
			$docente = $row1['docente'];
			$nota = $row1['nota'];
			$comments = $row1['comments'];
		}
		
		
		$sql2 = "select * from gvausers where gvauser_id=$gvauser_id";

		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row2 = $result2->fetch_assoc()) {
			
			$estudiante = $row2['name'] . ' ' . $row2['surname'];
			
		}
		
		
	


		
		?>
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Notas</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Actualización de Notas</div>
                  <div class="row">
                    <div class="col-sm-12">   
		



<form method="POST" action="?page=updatenotas">

<div align="center">
<center>
<table class="table table-hover" border="0" width="100%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#33AFFF">
<p align="center"><font color="black">Estudiante: <?php echo $estudiante; ?></font></td>
<input type="hidden" name="pilotos" class="form-control" value="<?php echo $gvauser_id; ?>" size="20">

</tr>
<tr>
<td width="50%">Docente: </td>
<td width="50%"><input type="text" class="form-control" name="docente" value="<?php echo $docente; ?>" size="50" readonly="readonly"></td>
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
			if($temas==$row12['id']) {
				echo ' <option value="' . $row12['id'] . '" selected>' . $row12['nombre'] . '</option>';
			} else {
			echo ' <option value="' . $row12['id'] . '">' . $row12['nombre'] . '</option>';	
			}
			
		}
		
		?>
</select>
</tr>
<tr>
<td width="50%">Nota: [0-5]</td>
<td width="50%"><input type="number" class="form-control" min="0" max="5" name="note"  value="<?php echo $nota; ?>" size="20" required ></td>
</tr>
<tr>
<td width="50%">Comentarios: </td>
<td width="50%"><textarea id="comments" name="comments"  class="form-control"  rows="4" cols="50"><?php echo $comments; ?>
</textarea></td>
</tr>
<tr>
<td width="50%">Fecha: </td>
<td width="50%"><input type="text" class="form-control" name="date" value="<?php 
$time = time(); 
echo $fecha_actual=date("d F Y (H:i:s)", $time);?>" size="30" readonly="readonly"></td>
</tr>
<tr>
<input type="hidden" name="ids" value="<?php echo $id; ?>" size="20">
<td width="100%" colspan="2">
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Actualizar Nota" name="B1"></td>
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