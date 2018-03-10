
			
			 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Examen</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Examen de Admisión</div>
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
		
		 
		
	$sql = "select * from config_examen where id=1";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
		$descripcion = $row["descripcion"];
		$limite = $row["limite"];
		}		
		
		
		
	
?>



<h2>Buen día: <?php echo $pilotname . ' ' . $pilotsurname . '  ' . $callsign; ?></h2>
<br>

<h3>Configuración de Examen</h3>
<hr>

<form method="POST" action="./?page=updateexamenva">

<div align="center">
<center>
<table class="table table-hover" border="0" width="100%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#33AFFF">
<p align="center"><font color="#FFFFFF">Docente: <?php echo $pilotname . ' ' . $pilotsurname . ' (' . $callsign . ') '; ?></font></td>
<td width="50%"><input type="hidden" name="docentes" value="<?php echo $id; ?>" size="20"></td>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
</tr>
<tr>
<td width="50%">Titulo Examen: </td>
<td width="50"><input type="text" class="form-control" name="title" value="<?php echo $title; ?>" size="20"></td>

</tr>


<tr>
<td width="50%">Descripción Examen Examen: </td>
<td width="50"><input type="textarea"class="form-control"  name="coment" value="<?php echo $descripcion; ?>" rows="8" cols="70"></td>

</tr>


<tr>
<td width="50%">Duración en Minutos: </td>
<td width="50">
<select name="duration"  class="form-control" id="duration"  >
<?php for ($i = 1; $i <= 60; $i++) { 
if($i==$duracion) {
	?>
  <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
<?php
} else {
	?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } 
}
?>

</select>
</td>


</tr>

<tr>
<td width="50%">Máximo de Preguntas: </td>
<td width="50"><input type="number" class="form-control" name="limite" value="<?php echo $limite; ?>" size="20"></td>

</tr>


<tr>
<td width="100%" colspan="2">
<br>
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Actualizar Datos" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>






<br>
<br>
<h2>Preguntas de Examen</h2>
<hr>
<br>

<button class="btn btn-primary btn-lg btn-block form-control"  onclick="window.location.href='./?page=addaskexamen'">Añadir Preguntas</button>
<br>
<br>


<?php 
$sql12 = "select * from preguntasdeexamen where idexamen=1";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2=0;
		while ($row12 = $result12->fetch_assoc()) {
			$i2++;
										?>
										
										  <div class="col-lg-12 col-sm-12 ">
                <div class="panel-group accordion" id="accordion<?php echo $i2; ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion<?php echo $i2; ?>" href="#collapse<?php echo $i2; ?>">
                                    <i class="switch fa fa-plus"></i> Pregunta #<?php echo $i2; ?>   </a>
								  </h4>
                        </div>
                        <div id="collapse<?php echo $i2; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
							
							<div class="accordion-inner">
												
							<h1>PREGUNTA:</h1>
							<hr>
							<b><?php echo $row12["pregunta"]; ?></b>
							<hr>
							<h2>RESPUESTAS: <font color="red">Correcta: <b><?php echo $row12['respuesta_correcta']; ?></b></font></h2>
							<li><b>A).</b> <?php echo $row12['A']; ?></li>
                            <li><b>B).</b> <?php echo $row12['B']; ?></li>
							<li><b>C).</b> <?php echo $row12['C']; ?></li>
							<li><b>D).</b> <?php echo $row12['D']; ?></li>
			                <hr>
							<a  class="btn btn-md btn-warning" style="width:100%;" href="./?page=editaskexamen&id=<?php echo $row12["id"]; ?>">Editar</a>
							<br><br>
							<a  class="btn btn-md btn-danger" style="width:100%;" href="./?page=deleteaskexamen&id=<?php echo $row12["id"]; ?>">Eliminar</a>
											</div>
							
							
							
							
							
							</div>
                        </div>
                    </div>
                    
                </div>
            </div>
										
										<?php
										
		}
		
		
		
		
?>




<?


if ($i2==0) 
{
					echo '<div class="alert alert-danger"> No se han creado preguntas</div>';
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