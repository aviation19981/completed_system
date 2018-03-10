 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aeronave</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Aeronave</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$aeronave = $_GET['aeronave']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		
		
		$sql = "select gv.callsign as callsign , f.gvauser_id, f.operator_id, f.image_url, f.fleet_id, hu.hub_id,hub, ha.status as hangar,f.registry as registry,f.selcal, f.status,f.hours,f.name, f.booked , 
			ft.plane_icao, f.location  
			from fleets f left outer join (select registry,status,fleet_id from hangar where status=1) ha 
			on f.registry = ha.registry 
			inner join  fleettypes ft on f.fleettype_id=ft.fleettype_id 
			inner join hubs hu on hu.hub_id = f.hub_id 
			left outer join gvausers gv on f.gvauser_id = gv.gvauser_id  where f.fleet_id='$aeronave'";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		
		
	
		$plane = $row["plane_icao"];
		$registro=  $row["registry"];
		$location= $row["location"];
		$hours= $row["hours"];
		$status= $row["status"] ;
		$booked= $row["booked"];
		$name=$row["name"];
		$hub= $row["hub"];
		$hangar= $row["hangar"];
		$image_url= $row["image_url"];
		$operator_id= $row["operator_id"];
		$selcal = $row["selcal"];
		
}
?>





           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=actualizaraeronave" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="fleet_id" value="<?php echo $aeronave; ?>"/></div>	<fieldset>

<div class="form-group">
	<label>Tipo de Aeronave ICAO</label>
	<div class="col-md-8">
	<select name="plane"  class="form-control" required >
	<?php 
	
		$sql2 = "select * from fleettypes order by plane_icao asc";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row2 = $result2->fetch_assoc()) {
		
		if($plane==$row2["plane_icao"]) {
			echo '<option value="' . $row2["fleettype_id"] . '" selected="selected">' . $row2["plane_icao"] . '</option>';
		} else {
			echo '<option value="' . $row2["fleettype_id"] . '">' . $row2["plane_icao"] . '</option>';
		}
		
	}
	
	
	
	 ?>
</select>
</div>
</div>


<div class="form-group">
	<label>Nombre</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required />
</div>
</div>


<div class="form-group">
	<label>Matrícula</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="registro" value="<?php echo $registro; ?>" required />
</div>
</div>

<div class="form-group">
	<label>SELCAL</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="selcal" value="<?php echo $selcal; ?>" readonly="readonly" required />
</div>
</div>

<div class="form-group">
	<label>Ubicación</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="location" value="<?php echo $location; ?>" required />
</div>
</div>



<div class="form-group">
	<label>Horas</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="hours" value="<?php echo $hours; ?>" required />
</div>
</div>


<div class="form-group">
	<label>Estado</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="status" value="<?php echo $status; ?>" required />
</div>
</div>


<div class="form-group">
	<label>Reservado</label>
	<div class="col-md-8">
	<select name="booked"  class="form-control" required >
	<?php 
		if($booked==1) {
			echo '<option value="1" selected="selected">SI</option>';
			echo '<option value="0">NO</option>';
		} else {
			echo '<option value="1" >SI</option>';
			echo '<option value="0" selected="selected">NO</option>';
		}
	 ?>
</select>
</div>
</div>

<div class="form-group">
	<label>Hub</label>
	<div class="col-md-8">
	<select name="hub"  class="form-control" required >
	<?php 
	
		$sql23 = "select * from hubs";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		
		if($hub==$row23["hub"]) {
			echo '<option value="' . $row23["hub_id"] . '" selected="selected">' . $row23["hub"] . '</option>';
		} else {
			echo '<option value="' . $row23["hub_id"] . '">' . $row23["hub"] . '</option>';
		}
		
	}
	
	
	
	 ?>
</select>
</div>
</div>

<div class="form-group">
	<label>Hangar</label>
	<div class="col-md-8">
	<select name="hangar"  class="form-control" required>
	<?php 
		if($hangar==1) {
			echo '<option value="1" selected="selected">SI</option>';
			echo '<option value="0">NO</option>';
		} else {
			echo '<option value="1" >SI</option>';
			echo '<option value="0" selected="selected">NO</option>';
		}
	 ?>
</select>
</div>
</div>


<div class="form-group">
	<label>Operado por</label>
	<div class="col-md-8">
	<select name="operator_id"  class="form-control" required>
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
	<label>Imágen Aeronave</label>
	<div class="col-md-8">
    <input name="image_url" class="form-control" type="file" id="image_url">
</div>
</div>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Aeronave"/></div></div></form></div>

				
				


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
