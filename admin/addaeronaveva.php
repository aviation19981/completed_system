 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aeronave</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Aeronave</div>
                  <div class="row">
                    <div class="col-sm-8">                      
   
           
      <div class="container">
<form enctype="multipart/form-data"  action="./?page=agregarnuevaaeronave" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
	<fieldset>

<div class="form-group">
	<label>Tipo de Aeronave ICAO</label>
	<div class="col-md-8">
	<select name="plane"  class="form-control" >
	<?php 
	
		$sql2 = "select * from fleettypes order by plane_icao asc";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row2 = $result2->fetch_assoc()) {
			echo '<option value="' . $row2["fleettype_id"] . '">' . $row2["plane_icao"] . '</option>';

		
	}
	
	
	
	 ?>
</select>
</div>
</div>


<div class="form-group">
	<label>Nombre</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="name" required />
</div>
</div>


<div class="form-group">
	<label>Matrícula</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="registro" required />
</div>
</div>

<div class="form-group">
	<label>Ubicación</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="location" required >
</div>
</div>



<div class="form-group">
	<label>Horas</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="hours" required  />
</div>
</div>


<div class="form-group">
	<label>Estado</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="status" required />
</div>
</div>


<div class="form-group">
	<label>Reservado</label>
	<div class="col-md-8">
	<select name="booked"  class="form-control" required >
	<option value="1">SI</option>
	<option value="0">NO</option>
</select>
</div>
</div>

<div class="form-group">
	<label>Hub</label>
	<div class="col-md-8">
	<select name="hub"  class="form-control"  required >
	<?php 
	
		$sql23 = "select * from hubs";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
			echo '<option value="' . $row23["hub_id"] . '">' . $row23["hub"] . '</option>';
	}
	
	
	
	 ?>
</select>
</div>
</div>

<div class="form-group">
	<label>Hangar</label>
	<div class="col-md-8">
	<select name="hangar"  class="form-control"  required >
	<option value="1" >SI</option>
	<option value="0" >NO</option>
</select>
</div>
</div>


<div class="form-group">
	<label>Operado por</label>
	<div class="col-md-8">
	<select name="operator_id"  class="form-control" required >
	<?php 
	
		$sql23 = "select * from operators";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		if (in_array($row23['operator_id'], $airlines)) {
			echo '<option value="' . $row23["operator_id"] . '">' . $row23["operator"] . '</option>';
		}
	}
	
	
	
	 ?>
</select>
</div>
</div>

<div class="form-group">
	<label>Imágen Aeronave</label>
	<div class="col-md-8">
	<input name="image_url" class="form-control" type="file" id="image_url" required >
</div>
</div>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Añadir Aeronave"/></div></div></form></div>

				
				


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
