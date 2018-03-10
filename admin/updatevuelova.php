 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Ruta</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Ruta</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$vuelo = $_GET['vuelo']; 
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); 
	$db->set_charset("utf8"); 
	if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		
		
		$sql = "select * FROM routes where route_id='$vuelo'";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		
		
	
		$flight = $row["flight"];
		$departure=  $row["departure"];
		$arrival= $row["arrival"];
		$alternative= $row["alternative"];
		$etd= $row["etd"] ;
		$eta= $row["eta"];
		
		
		$pax_price= $row["pax_price"];
		$flproute= $row["flproute"];
		$comments= $row["comments"];
		$operator_id= $row["operator_id"];
		
		$flighttype_id= $row["flighttype_id"];
		$duration= $row["duration"];
		$cargo_price= $row["cargo_price"];
	    $altitude= $row["altitude"];
}
?>





           
      <div class="container">
<form action="./?page=actualizarvuelova" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="route_id" value="<?php echo $vuelo; ?>"/></div>	<fieldset>


<div class="form-group">
	<label>Vuelo</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="flight" value="<?php echo $flight; ?>" readonly="readonly"/>
</div>
</div>


<div class="form-group">
	<label>Origen</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="departure" value="<?php echo $departure; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Destino</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="arrival" value="<?php echo $arrival; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Alterno</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="alternative" value="<?php echo $alternative; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Altitud</label>
	<div class="col-md-8">
<input type="number" class="form-control"  name="altitude" value="<?php echo $altitude; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Hora Salida</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="5" name="etd" placeholder="--:--" value="<?php echo $etd; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Hora Llegada</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="5" name="eta" placeholder="--:--" value="<?php echo $eta; ?>"/>
</div>
</div>



<div class="form-group">
	<label>Precio Pasajeros</label>
	<div class="col-md-8">
<input type="number" class="form-control"  name="pax_price"  value="<?php echo $pax_price; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Precio Carga</label>
	<div class="col-md-8">
<input type="number" class="form-control"  name="cargo_price"  value="<?php echo $cargo_price; ?>"/>
</div>
</div>


<div class="form-group">
	<label>Plan de Vuelo</label>
	<div class="col-md-8">
	<textarea class="form-control" name="flproute" rows="4" cols="50">
<?php echo $flproute; ?>
</textarea>
</div>
</div>

<div class="form-group">
	<label>Comentarios</label>
	<div class="col-md-8">
	<textarea class="form-control" name="comments" rows="4" cols="50">
<?php echo $comments; ?>
</textarea>
</div>
</div>


<div class="form-group">
	<label>Operado por</label>
	<div class="col-md-8">
	<select name="operator_id"  class="form-control" >
	<?php 
	
		$sql23 = "select * from operators";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		
		if($operator_id==$row23["operator_id"]) {
			echo '<option value="' . $row23["operator_id"] . '" selected="selected">' . $row23["operator"] . '</option>';
		} else {
			echo '<option value="' . $row23["operator_id"] . '">' . $row23["operator"] . '</option>';
		}
		
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
		
		if($flighttype_id==$row234["flighttype_id"]) {
			echo '<option value="' . $row234["flighttype_id"] . '" selected="selected">' . $row234["flighttype"] . '</option>';
		} else {
			echo '<option value="' . $row234["flighttype_id"] . '">' . $row234["flighttype"] . '</option>';
		}
		
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

$aeronaveshabilitadas=array();

	$sqlhabilitaciones = "SELECT * FROM fleettypes_routes where route_id=$vuelo";
 if (!$resultha = $db->query($sqlhabilitaciones))  {
	die('There was an error running the query [' . $db->error . ']');
   }

while ($rowha = $resultha->fetch_assoc()) {

$aeronaveshabilitadas[]=$rowha['fleettype_id'];

}
	

	$sql = "SELECT * FROM fleettypes";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {

	$aeronaves = $row['fleettype_id'];
	
if (in_array($aeronaves, $aeronaveshabilitadas)) {
    echo '<option value="' . $row['fleettype_id'] . '" selected="selected">' . $row['plane_icao'] . '</option>';
} else {
	echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_icao'] . '</option>';
}

}	
	
	
?>
</select></div></div>


<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Vuelo"/></div></div></form></div>

				
				


                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      
