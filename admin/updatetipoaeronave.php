 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tipo de Aeronave</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Tipo de Aeronave</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$aeronaveid = $_GET['aeronaveid']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM fleettypes where fleettype_id=$aeronaveid";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$plane_icao = $row['plane_icao'];
		$fleettype_id = $row['fleettype_id'];
		$plane_description = $row['plane_description'];
		$active = $row['active'];
		$pax = $row['pax'];
		$maximum_range = $row['maximum_range'];
		$cargo_capacity = $row['cargo_capacity'];
		$aircraft_length = $row['aircraft_length'];
		$mzfw = $row['mzfw'];
		$mlw = $row['mlw'];
		$mtow = $row['mtow'];
        $service_ceiling = $row['service_ceiling'];
		$cruising_speed = $row['cruising_speed'];
		$unit_price = $row['unit_price'];
		$crew_members = $row['crew_members'];
		$equip = $row['equip'];
		$TAS = $row['TAS'];
        $FF	 = $row['FF'];
		$DOW = $row['DOW'];
		$performance = $row['performance'];
		$ejecutive_class = $row['ejecutive_class'];
		$tourist_class = $row['tourist_class'];
	}
?>





           
      <div class="container">
<form action="./?page=actualizartipoaeronave" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="fleettype_id" value="<?php echo $fleettype_id; ?>"/></div>	<fieldset>


<div class="form-group">
	<label>ICAO</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="plane_icao" value="<?php echo $plane_icao; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Estado</label>
	<div class="col-md-8">
	<select name="active"  class="form-control" >
	<?php if($active==0) {
	echo '<option value="0" selected="selected">INACTIVO</option>
	<option value="1">ACTIVO</option>';
	} else {
	echo '<option value="0" >INACTIVO</option>
	<option value="1" selected="selected">ACTIVO</option>';	
	} ?>
</select>
</div>
</div>

<div class="form-group">
	<label>Descripción Aeronave</label>
	<div class="col-md-8">
	<textarea class="form-control" name="plane_description" rows="4" cols="50">
<?php echo $plane_description; ?>
</textarea>
</div>
</div>


<div class="form-group">
	<label>Pasajeros</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="pax" value="<?php echo $pax; ?>" />
</div>
</div>

<div class="form-group">
	<label>Distribución Clase Ejecutiva</label>
	<div class="col-md-8">
<input type="number" class="form-control" name="ejecutive_class" value="<?php echo $ejecutive_class; ?>" />
</div>
</div>

<div class="form-group">
	<label>Distribución Clase Turista</label>
	<div class="col-md-8">
<input type="number" class="form-control" name="tourist_class" value="<?php echo $tourist_class; ?>" />
</div>
</div>


<div class="form-group">
	<label>Alcance Aeronave <b>NM</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="maximum_range" value="<?php echo $maximum_range; ?>" />
</div>
</div>


<div class="form-group">
	<label>Capacidad Carga <b>KG</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="cargo_capacity" value="<?php echo $cargo_capacity; ?>" />
</div>
</div>

<div class="form-group">
	<label>Longitud Aeronave <b>Metros</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="aircraft_length" value="<?php echo $aircraft_length; ?>" />
</div>
</div>

<div class="form-group">
	<label>Maximum zero fuel weight <b>KG</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="mzfw" value="<?php echo $mzfw; ?>" />
</div>
</div>

<div class="form-group">
	<label>Maximum landing weight <b>KG</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="mlw" value="<?php echo $mlw; ?>" />
</div>
</div>

<div class="form-group">
	<label>Maximum takeoff weight <b>KG</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="mtow" value="<?php echo $mtow; ?>" />
</div>
</div>

<div class="form-group">
	<label>Altura de Servicio <b>Ft</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="service_ceiling" value="<?php echo $service_ceiling; ?>" />
</div>
</div>

<div class="form-group">
	<label>Velocidad Crucero <b>Knots</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="cruising_speed" value="<?php echo $cruising_speed; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Precio Por Unidad</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="unit_price" value="<?php echo $unit_price; ?>" />
</div>
</div>

<div class="form-group">
	<label>Miembros de Tripulación</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="crew_members" value="<?php echo $crew_members; ?>" />
</div>
</div>


<div class="form-group">
	<label>Equipamiento Aeronave</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="equip" value="<?php echo $equip; ?>" />
</div>
</div>

<div class="form-group">
	<label>Cadena de navegación basada en el rendimiento</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="performance" value="<?php echo $performance; ?>" />
</div>
</div>


<div class="form-group">
	<label>TAS (True airspeed) <b>Knots</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="TAS" value="<?php echo $TAS; ?>" />
</div>
</div>

<div class="form-group">
	<label>Consumo combustible <b>Kg/Min</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="FF" value="<?php echo $FF; ?>" />
</div>
</div>




<div class="form-group">
	<label>Dry Operating Weight <b>Kg</b></label>
	<div class="col-md-8">
<input type="text" class="form-control" name="DOW" value="<?php echo $DOW; ?>" />
</div>
</div>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Tipo de Aeronave"/></div></div></form></div>

				
				
				
				
				
				





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
