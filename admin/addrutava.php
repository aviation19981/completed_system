 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Ruta</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Ruta</div>
                  <div class="row">
                    <div class="col-sm-8">                      
        

           
      <div class="container">
<form action="./?page=agregarvuelova" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<fieldset>


<div class="form-group">
	<label>Vuelo</label>
	<div class="col-md-8">
<input type="text" maxlength="7" class="form-control" name="flight" />
</div>
</div>


<div class="form-group">
	<label>Origen</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="departure" />
</div>
</div>

<div class="form-group">
	<label>Destino</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="arrival" />
</div>
</div>

<div class="form-group">
	<label>Alterno</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="alternative" />
</div>
</div>

<div class="form-group">
	<label>Altitud</label>
	<div class="col-md-8">
<input type="number" class="form-control"  name="altitude" />
</div>
</div>


<div class="form-group">
	<label>Hora Salida</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="5" name="etd" placeholder="--:--" />
</div>
</div>

<div class="form-group">
	<label>Hora Llegada</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="5" name="eta" placeholder="--:--" />
</div>
</div>



<div class="form-group">
	<label>Precio Pasajeros</label>
	<div class="col-md-8">
<input type="number" class="form-control"  name="pax_price"  />
</div>
</div>


<div class="form-group">
	<label>Precio Carga</label>
	<div class="col-md-8">
<input type="number" class="form-control"  name="cargo_price"  />
</div>
</div>


<div class="form-group">
	<label>Plan de Vuelo</label>
	<div class="col-md-8">
	<textarea class="form-control" name="flproute" rows="4" cols="50">
</textarea>
</div>
</div>

<div class="form-group">
	<label>Comentarios</label>
	<div class="col-md-8">
	<textarea class="form-control" name="comments" rows="4" cols="50">
</textarea>
</div>
</div>


<div class="form-group">
	<label>Operado por</label>
	<div class="col-md-8">
	<select name="operator_id"  class="form-control" >
	<?php 
	
		$sql23 = "select * from operators where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ")";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		
			echo '<option value="' . $row23["operator_id"] . '">' . $row23["operator"] . '</option>';
		
		
	}
	
	
	
	 ?>
</select>
</div>
</div>


<div class="form-group">
	<label>Tipo de Vuelo</label>
	<div class="col-md-8">
	<select name="flighttype_id"  class="form-control" >
	<?php 
	
		$sql234 = "select * from flighttypes";
	if (!$result234 = $db->query($sql234)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row234 = $result234->fetch_assoc()) {
		
			echo '<option value="' . $row234["flighttype_id"] . '">' . $row234["flighttype"] . '</option>';
		
		
	}
	
	
	
	 ?>
</select>
</div>
</div>




<div class="form-group">
<label for="GvauserUserTypeId">Aeronaves</label>
<div class="col-md-8">
<select name="aeronaves[]" class="form-control" id="GvauserUserTypeId" multiple>
<?php 



	$sql = "SELECT * FROM fleettypes";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {

	echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_icao'] . '</option>';

}	
	
	
?>
</select></div></div>


<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Vuelo"/></div></div></form></div>

				
				


                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      
