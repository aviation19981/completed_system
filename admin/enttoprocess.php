<?php 
$id_consulta = $_GET['id_consulta']; 
$id_entto = $_GET['id_entto']; 




         include('./db_login.php');
         $db = new mysqli($db_host , $db_username , $db_password , $db_database);
		 $db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
	$sql = "select * from request_entto where id_entto='$id_entto'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowenttos = $result->fetch_assoc()) {
		$id_teacher = $rowenttos['id_teacher'];
		$id_student = $rowenttos['id_student'];
		$plane = $rowenttos['plane'];
		$comments = $rowenttos['comments'];
		$estado = $rowenttos['estado'];
		$fecha_entto = $rowenttos['fecha_entto'];
		$hora_entto = $rowenttos['hora_entto'];
		$fecha_solicitud = $rowenttos['fecha_solicitud'];
		
		
		$sql_docente = "select * from gvausers where gvauser_id='$id_student'";

	if (!$result_docente = $db->query($sql_docente)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowenttos_docente = $result_docente->fetch_assoc()) {
		$estudianteinfo = $rowenttos_docente['name'] . ' ' . $rowenttos_docente['surname'] . ' [' . $rowenttos_docente['email'] . ']' . ' [' . $rowenttos_docente['callsign'] . ']';
	}
	
	
	}
		

if($id_consulta==1) {
	
	    $sql = "update request_entto set estado='1' where id_entto='$id_entto'";

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		?>
		
		
<script>   
	   
alert('Usuario contactado. Esperando para programar entto.');
window.location = './?page=my_enttos';
 
</script>


<?php
	
} else if($id_consulta==2) {
	
	?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Entrenamiento</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Asignación Fecha y Hora</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                  


           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=asignarentto" class="form-horizontal" method="post">



<div class="form-group">
<label for="name">Nombre Estudiante</label>
<div class="col-md-8">
<input name="name"  class="form-control" maxlength="255" type="text"  id="name" value="<?php echo $estudianteinfo; ?>" readonly="readonly"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Aeronave Entrenamiento</label>
<div class="col-md-8">
<input name="plane"  class="form-control" maxlength="255" type="text"  id="name" value="<?php echo $plane; ?>" readonly="readonly"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Comentarios del Estudiante</label>
<div class="col-md-8">
<input name="comments"  class="form-control" maxlength="255" type="text"  id="name" value="<?php echo $comments; ?>" readonly="readonly"/>
</div></div>

<div class="form-group">
<label for="minhoras">Fecha Entrenamiento</label>
<div class="col-md-8">
<input name="fecha_entto"  class="form-control" type="date"  id="fecha_entto" required />
</div></div>

<div class="form-group">
<label for="maxhoras">Hora Entrenamiento</label>
<div class="col-md-8">
<input name="hora_entto" class="form-control" type="time"  id="hora_entto" required />
</div></div>




	
										
                                        </div>


<input type="hidden" name="id_entto" id="id_entto" value="<?php echo $id_entto; ?>"/>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Programar Entrenamiento"/></div></div></form></div>

				
				
				
				
				
				





                    </div>
                  
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

<?php
	
	
} else if($id_consulta==4) {
	
	    $sql = "update request_entto set estado='4' where id_entto='$id_entto'";

		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		?>
		
		
<script>   
	   
alert('Entrenamiento Cancelado.');
window.location = './?page=my_enttos';
 
</script>


<?php
	
} else if($id_consulta==5) {
	
	?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Entrenamiento</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Asignación Fecha y Hora</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                  


           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=reprogramarentto" class="form-horizontal" method="post">



<div class="form-group">
<label for="name">Nombre Estudiante</label>
<div class="col-md-8">
<input name="name"  class="form-control" maxlength="255" type="text"  id="name" value="<?php echo $estudianteinfo; ?>" readonly="readonly"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Aeronave Entrenamiento</label>
<div class="col-md-8">
<input name="plane"  class="form-control" maxlength="255" type="text"  id="name" value="<?php echo $plane; ?>" readonly="readonly"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Comentarios del Estudiante</label>
<div class="col-md-8">
<input name="comments"  class="form-control" maxlength="255" type="text"  id="name" value="<?php echo $comments; ?>" readonly="readonly"/>
</div></div>

<div class="form-group">
<label for="minhoras">Fecha Entrenamiento</label>
<div class="col-md-8">
<input name="fecha_entto"  class="form-control" type="date"  id="fecha_entto" value="<?php echo $fecha_entto; ?>" required />
</div></div>

<div class="form-group">
<label for="maxhoras">Hora Entrenamiento</label>
<div class="col-md-8">
<input name="hora_entto" class="form-control" type="time"  id="hora_entto" value="<?php echo $hora_entto; ?>" required />
</div></div>




	
										
                                        </div>


<input type="hidden" name="id_entto" id="id_entto" value="<?php echo $id_entto; ?>"/>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Programar Entrenamiento"/></div></div></form></div>

				
				
				
				
				
				





                    </div>
                  
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

<?php
	
	
} else {


?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Rango</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Agregar Rango</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                  


           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=agregarrangova" class="form-horizontal" method="post">



<div class="form-group">
<label for="name">Nombre</label>
<div class="col-md-8">
<input name="name"  class="form-control" maxlength="255" type="text"  id="name" required />
</div></div>

<div class="form-group">
<label for="abreviacion">Abreviación</label>
<div class="col-md-8">
<input name="abreviacion"  class="form-control" maxlength="255" type="text"  id="abreviacion" required />
</div></div>

<div class="form-group">
<label for="salario">Hora Salario</label>
<div class="col-md-8">
<input name="salario" class="form-control" type="number"  id="salario" required />
</div></div>

<div class="form-group">
<label for="minhoras">Mínimo Horas</label>
<div class="col-md-8">
<input name="minhoras"  class="form-control" type="number"  id="minhoras" required />
</div></div>

<div class="form-group">
<label for="maxhoras">Máximo Horas</label>
<div class="col-md-8">
<input name="maxhoras" class="form-control" type="number"  id="maxhoras" required />
</div></div>

<div class="form-group">
<label for="image_file">Imagen Rango <b>OBLIGATIORIO</b></label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file" required />
</div></div>




	
										
                                        </div>

<div class="form-group">
<label for="GvauserUserTypeId">Aeronaves que se añaden al Rango</label>
<div class="col-md-8">
<select name="aeronaves[]" class="form-control" id="aeronaves" multiple required >
<?php 	$sql = "SELECT * FROM fleettypes";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
	
$idplanetype = $row['fleettype_id'];
$i = 0;
	
$sql2 = "SELECT * FROM fleets where fleettype_id='$idplanetype' and operator_id='$va_id '";
 if (!$result2 = $db->query($sql2))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row2 = $result2->fetch_assoc()) {
$i++;	
}
	//if($i>0) {
			echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_icao'] . '</option>';
		
	//}
	
}
?>
</select></div></div>

<input type="hidden" name="va_id" id="va_id" value="<?php echo $va_id; ?>"/>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Rango"/></div></div></form></div>

				
				
				
				
				
				





                    </div>
                  
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

<?php } ?>