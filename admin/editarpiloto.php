 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Piloto</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Piloto</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$pilotID = $_GET['pilot_id']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM gvausers where gvauser_id=$pilotID";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$user_type = $row['user_type_id'];
		$pilotname = $row['name'];
		$pilotsurname = $row['surname'];
		$callsign = $row['callsign'];
		$ids = $row['gvauser_id'];
		$location = $row['location'];
		$usertype = $row['user_type_id'];
		$hub_id = $row['hub_id'];
		$hub = $row['hub_id'];
		$ivaovid = $row['ivaovid'];
		$operator_id_pca = $row['operator_id'];
		$register_date = $row['register_date'];
		$rank_id = $row['rank_id'];
		$email = $row['email'];
		$country = $row['country'];
		$city = $row['city'];
		$transfered_hours = $row['transfered_hours'];				
		$other_pilot_image = '../../va/images/uploads/'.$row['pilot_image'];
		$birth_dates = $row['birth_date'];
		$status = $row['activation'];
	}
?>





           
      <div class="container">
<form action="./?page=actualizarpilotova" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="PUT"/></div>	<fieldset>

	<div class="form-group"><label for="GvauserActivation">Activación</label><div class="col-md-8"><select name="activation" seperator="&lt;/div&gt;" class="form-control" id="GvauserActivation">
<?php if($status==0) {
	?>
	<option value="0"  selected="selected">Nuevo</option>
	<?php
} else {
	?>
	<option value="0"  >Nuevo</option>
	<?php
}
?>

<?php if($status==1) {
	?>
	<option value="1" selected="selected">Activo</option>
	<?php
} else {
	?>
	<option value="1">Activo</option>
	<?php
}
?>

<?php if($status==2) {
	?>
	<option value="2" selected="selected">Inactivo</option>
	<?php
} else {
	?>
	<option value="2">Inactivo</option>
	<?php
}
?>
	
<?php if($status==3) {
	?>
	<option value="3"  selected="selected">Suspendido</option>
	<?php
} else {
	?>
	<option value="3"  >Suspendido</option>
	<?php
}
?>	

<?php if($status==4) {
	?>
	<option value="4" selected="selected">Vacaciones</option>
	<?php
} else {
	?>
	<option value="4">Vacaciones</option>
	<?php
}
?>	


</select></div></div>

<input type="hidden" name="gvauser_id" seperator="&lt;/div&gt;" class="form-control" value="<?php echo $ids; ?>" id="GvauserGvauserId"/>

<div class="form-group">
<label for="GvauserName">Nombres</label>
<div class="col-md-8">
<input name="name" seperator="&lt;/div&gt;" class="form-control" maxlength="255" type="text" value="<?php echo $pilotname; ?>" id="GvauserName"/>
</div></div>

<div class="form-group">
<label for="GvauserSurname">Apellidos</label>
<div class="col-md-8">
<input name="surname" seperator="&lt;/div&gt;" class="form-control" maxlength="100" type="text" value="<?php echo $pilotsurname; ?>" id="GvauserSurname"/>
</div></div>

<div class="form-group">
<label for="GvauserCallsign">Callsign</label>
<div class="col-md-8">
<?php if($_SESSION["access_pilot_manager"]==1) { ?>
<input name="callsign" seperator="&lt;/div&gt;" class="form-control" maxlength="150" type="text" value="<?php echo $callsign; ?>" id="GvauserCallsign"/>
<?php } else { ?>
<input name="callsign" seperator="&lt;/div&gt;" class="form-control" maxlength="150" type="text" value="<?php echo $callsign; ?>" id="GvauserCallsign" readonly="readonly"/>
<?php } ?>
</div>
</div>

<div class="form-group">
<label for="GvauserEmail">Email</label>
<div class="col-md-8">
<input name="email" seperator="&lt;/div&gt;" class="form-control" maxlength="100" type="email" value="<?php echo $email; ?>" id="GvauserEmail"/></div></div>

<?php if($_SESSION["access_pilot_manager"]==1) { ?>
<div class="form-group">
<label for="GvauserUserTypeId">Tipo de Usuario</label>
<div class="col-md-8">
<select name="user_type_id" seperator="&lt;/div&gt;" class="form-control" id="GvauserUserTypeId">
<?php 	$sql = "SELECT * FROM user_types";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$user_types = $row['user_type_id'];
		
		if($user_types==$user_type){
			echo '<option value="' . $row['user_type_id'] . '" selected="selected">' . $row['user_type'] . '</option>';
		} else {
			echo '<option value="' . $row['user_type_id'] . '">' . $row['user_type'] . '</option>';
		}
		
		
	}
?>
</select></div></div>
<?php } else { ?>
<div class="form-group">
<label for="GvauserUserTypeId">Tipo de Usuario</label>
<div class="col-md-8">
<select name="user_type_id" seperator="&lt;/div&gt;" class="form-control" id="GvauserUserTypeId" readonly="readonly">
<?php 	$sql = "SELECT * FROM user_types";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$user_types = $row['user_type_id'];
		
		if($user_types==$user_type){
			echo '<option value="' . $row['user_type_id'] . '" selected="selected">' . $row['user_type'] . '</option>';
		} 
		
		
	}
?>
</select></div></div>
<?php } ?>

<div class="form-group">
<label for="GvauserIvaovid">IVAO VID</label>
<div class="col-md-8"><input name="ivaovid" seperator="&lt;/div&gt;" class="form-control" type="number" value="<?php echo $ivaovid; ?>" id="GvauserIvaovid"/>
</div></div>



<div class="form-group"><label for="GvauserHubId">Hub</label><div class="col-md-8"><select name="hub_id" seperator="&lt;/div&gt;" class="form-control" id="GvauserHubId">
<?php 	$sql = "SELECT * FROM hubs";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$hubs = $row['hub_id'];
		
		if($hubs==$hub_id){
			echo '<option value="' . $row['hub_id'] . '" selected="selected">' . $row['hub'] . '</option>';
		} else {
			echo '<option value="' . $row['hub_id'] . '">' . $row['hub'] . '</option>';
		}
		
		
	}
?>
</select></div></div>


<div class="form-group"><label for="GvauserLocation">Ubicación</label>
<div class="col-md-8">
<input name="location" seperator="&lt;/div&gt;" class="form-control" maxlength="4" type="text" value="<?php echo $location; ?>" id="GvauserLocation"/></div>
</div>

<div class="form-group"><label for="GvauserCity">Ciudad</label>
<div class="col-md-8">
<input name="city" seperator="&lt;/div&gt;" class="form-control" maxlength="30" type="text" value="<?php echo $city; ?>" id="GvauserCity"/></div></div>

<div class="form-group">
<label for="GvauserBirthDate">Cumpleaños</label>
<div class="col-md-8"><input name="birth_date" class="form-control"  type="text" value="<?php echo $birth_dates; ?>" id="GvauserBirthDate"/></div></div>

<div class="form-group">
<label for="GvauserTransferedHours">Horas Transferidas</label>
<div class="col-md-8">
<?php if($_SESSION["access_pilot_manager"]==1) { ?>
<input name="transfered_hours" step="any" seperator="&lt;/div&gt;" class="form-control" type="number" value="<?php echo $transfered_hours; ?>" id="GvauserTransferedHours"/>
<?php } else { ?>
<input name="transfered_hours" step="any" seperator="&lt;/div&gt;" class="form-control" type="number" value="<?php echo $transfered_hours; ?>" id="GvauserTransferedHours" readonly="readonly"/>
<?php } ?>
</div></div>


<div class="form-group">
<label for="GvauserUserTypeId">Miembro de la aerolínea</label>
<div class="col-md-8">
<select name="operator_id" seperator="&lt;/div&gt;" class="form-control" id="GvauserUserTypeId">
<?php 	$sql_op = "SELECT * FROM operators";
 if (!$result_op = $db->query($sql_op))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row_op = $result_op->fetch_assoc()) {
		
		if($row_op['operator_id']==$operator_id_pca){
			echo '<option value="' . $row_op['operator_id'] . '" selected="selected">' . $row_op['operator'] . '</option>';
		} else {
			echo '<option value="' . $row_op['operator_id'] . '">' . $row_op['operator'] . '</option>';
		}
		
		
	}
?>
</select></div></div>


<input type="hidden" name="callsign_prev" type="hidden" value="<?php echo $callsign; ?>" id="GvauserCallsignPrev"/>	</fieldset>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Piloto"/></div></div></form></div>

				
				
				
				
				
				





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
