 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Rango</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Editar Rango</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$rank_id = $_GET['rank_id']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM ranks where rank_id=$rank_id";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$rank_id = $row['rank_id'];
		$rank = $row['rank'];
		$abreviacion = $row['abreviacion'];
		$salary_hour = $row['salary_hour'];
		$minimum_hours = $row['minimum_hours'];
		$maximum_hours = $row['maximum_hours'];
		$img = $row['img'];
		$operator_id = $row['operator_id'];
	}
	
	
	
	$fleettype_id_allow = array();
	$sql29 = "select * from fleettypes_ranks where operator_id='$operator_id' and rank_id='$rank_id'";
	if (!$result29 = $db->query($sql29)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row29 = $result29->fetch_assoc()) {
		
			$fleettype_id_allow[] = $row29['fleettype_id'];
		
		
	}
?>





           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=actualizarankva" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="identificacion" value="<?php echo $rank_id; ?>"/></div>	<fieldset>


<div class="form-group">
<label for="name">Nombre</label>
<div class="col-md-8">
<input name="name"  class="form-control" maxlength="255" type="text" value="<?php echo $rank; ?>" id="name"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Abreviación</label>
<div class="col-md-8">
<input name="abreviacion"  class="form-control" maxlength="255" type="text" value="<?php echo $abreviacion; ?>" id="abreviacion"/>
</div></div>

<div class="form-group">
<label for="salario">Hora Salario</label>
<div class="col-md-8">
<input name="salario" class="form-control" type="number" value="<?php echo $salary_hour; ?>" id="salario"/>
</div></div>

<div class="form-group">
<label for="minhoras">Mínimo Horas</label>
<div class="col-md-8">
<input name="minhoras"  class="form-control" type="number" value="<?php echo $minimum_hours; ?>" id="minhoras"/>
</div></div>

<div class="form-group">
<label for="maxhoras">Máximo Horas</label>
<div class="col-md-8">
<input name="maxhoras" class="form-control" type="number" value="<?php echo $maximum_hours; ?>" id="maxhoras"/>
</div></div>

<div class="form-group">
<label for="image_file">Imagen Rango <b>OBLIGATIORIO</b></label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file">
</div></div>



	
										
                                        </div>

<div class="form-group">
<label for="GvauserUserTypeId">Aeronaves que se añaden al Rango</label>
<div class="col-md-8">
<select name="aeronaves[]" class="form-control" id="GvauserUserTypeId" multiple>
<?php 	




$sql = "SELECT * FROM fleettypes";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		
		
		if (in_array($row['fleettype_id'], $fleettype_id_allow)) {
			echo '<option value="' . $row['fleettype_id'] . '" selected="selected">' . $row['plane_icao'] . '</option>';
		} else {
			echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_icao'] . '</option>';
		}
		
		
	}
?>
</select></div></div>

<input type="hidden" name="operator_id" id="operator_id" value="<?php echo $operator_id; ?>"/>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Rango"/></div></div></form></div>

				
				
				
				
				
				





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
