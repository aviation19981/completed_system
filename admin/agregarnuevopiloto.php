 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Nuevo Piloto</div>
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
		$operator_id = $row['operator_id'];
		$register_date = $row['register_date'];
		$rank_id = $row['rank_id'];
		$email = $row['email'];
		$country = $row['country'];
		$city = $row['city'];
		$transfered_hours = $row['transfered_hours'];				
		$other_pilot_image = '../../main/images/uploads/'.$row['pilot_image'];
		$birth_dates = $row['birth_date'];
		$status = $row['activation'];
	}
	
	
	
	$sqlpiloto = "SELECT * FROM gvausers where activation<>0 and operator_id='$operator_id' order by callsign desc limit 1 ";
 if (!$resultpiloto = $db->query($sqlpiloto))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($rowpiloto = $resultpiloto->fetch_assoc()) {
		$mayor2 = $rowpiloto['callsign'];
	}
	
$sqlva ="select * from operators where operator_id='$operator_id'";

	if (!$result_va = $db->query($sqlva)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_va = $result_va->fetch_assoc()) {
		$callsign_va = $row_va["callsign"];
	}	
	
	

$numero = substr($mayor2,3)+1;
	
$callsignnuevo = $callsign_va . $numero;
?>





           
      <div class="container">
<form action="./?page=addpilotonuevo" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="PUT"/></div>	<fieldset>

	<div class="form-group">
	<label for="GvauserActivation">Activación</label><div class="col-md-8">
	<select name="activation" seperator="&lt;/div&gt;" class="form-control" id="GvauserActivation">
	<option value="1" selected="selected">Activo</option>
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
<input name="callsign" seperator="&lt;/div&gt;" class="form-control" maxlength="150" type="text" value="<?php echo $callsignnuevo; ?>" id="GvauserCallsign"/></div>
</div>

<div class="form-group">
<label for="GvauserEmail">Email</label>
<div class="col-md-8">
<input name="email" seperator="&lt;/div&gt;" class="form-control" maxlength="100" type="email" value="<?php echo $email; ?>" id="GvauserEmail"/></div></div>

<div class="form-group">
<label for="GvauserUserTypeId">Tipo de Usuario</label>
<div class="col-md-8">
<select name="user_type_id" seperator="&lt;/div&gt;" class="form-control" id="GvauserUserTypeId">
<?php 	$sql = "SELECT * FROM user_types where user_type_id=2";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
			echo '<option value="' . $row['user_type_id'] . '">' . $row['user_type'] . '</option>';
	}
?>
</select></div></div>

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
<input name="location" seperator="&lt;/div&gt;" class="form-control" maxlength="4" type="text" value="<?php echo $location; ?>" id="GvauserLocation" required /></div>
</div>

<div class="form-group"><label for="GvauserCity">Ciudad</label>
<div class="col-md-8">
<input name="city" seperator="&lt;/div&gt;" class="form-control" maxlength="30" type="text" value="<?php echo $city; ?>" id="GvauserCity"/></div></div>

<div class="form-group">
<label for="GvauserBirthDate">Cumpleaños</label>
<div class="col-md-8"><input name="birth_date" class="form-control"  type="text" value="<?php echo $birth_dates; ?>" id="GvauserBirthDate"/></div></div>


<input type="hidden" name="callsign_prev" type="hidden" value="<?php echo $callsign; ?>" id="GvauserCallsignPrev"/>
<input type="hidden" name="operator_id" type="hidden" value="<?php echo $operator_id; ?>" id="operator_id"/>
	</fieldset>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Nuevo Piloto"/></div></div></form></div>

				
				
				
				
				
				





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
