 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tipo de Usuario</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Tipo de Usuario</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$tipousuario = $_GET['tipousuario']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM user_types where user_type_id=$tipousuario";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$user_type = $row['user_type'];
		$user_type_id = $row['user_type_id'];
		$access_administration_panel = $row['access_administration_panel'];
		$access_va_parameters = $row['access_va_parameters'];
		$access_hub_manager = $row['access_hub_manager'];
		$access_fleet_type_manager = $row['access_fleet_type_manager'];
		$access_fleet_manager = $row['access_fleet_manager'];
		$access_rank_manager = $row['access_rank_manager'];
		$access_pilot_manager = $row['access_pilot_manager'];
		$access_route_manager = $row['access_route_manager'];
		$access_user_type_manager = $row['access_user_type_manager'];
        $access_event_manager = $row['access_event_manager'];
		$access_notam_manager = $row['access_notam_manager'];
		$access_email_manager = $row['access_email_manager'];
		$access_language_manager = $row['access_language_manager'];
		$access_financial_parameters = $row['access_financial_parameters'];
		$access_tour_manager = $row['access_tour_manager'];
		$access_award_manager = $row['access_award_manager'];
		$access_operator_manager = $row['access_operator_manager'];
		$access_flight_types = $row['access_flight_types'];
		$access_docente = $row['access_docente'];
		$access_tienda = $row['access_tienda'];
		$access_airports_manager = $row['access_airports_manager'];
		$access_invitation = $row['access_invitation'];
	}
	
	
	
	
	
	
	
	////////////////////Aerolineas permitadas usar por Staff
	
	$operator_id = array();
	
	$sql_op = "SELECT * FROM staff_airline_allow where user_type_id=$tipousuario";
 if (!$result_op = $db->query($sql_op))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row_op = $result_op->fetch_assoc()) {
		$operator_id[] = $row_op['operator_id'];
	}
?>





           
      <div class="container">
<form action="./?page=actualizartipodeusuario" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="user_type_id" value="<?php echo $user_type_id; ?>"/></div>	<fieldset>


	<div class="form-group">
	<label>Titulo Cargo</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="user_type" value="<?php echo $user_type; ?>"/>
</div></div>


	<div class="form-group">
	<label>Acceso Panel Administrativo</label>
	<div class="col-md-8">
	<select name="access_administration_panel"  class="form-control" >
<?php if($access_administration_panel==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_administration_panel==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>




<div class="form-group">
	<label>Acceso Pilotos Gestión</label>
	<div class="col-md-8">
	<select name="access_pilot_manager"  class="form-control" >
<?php if($access_pilot_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_pilot_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>



<div class="form-group">
	<label>Acceso Parámetros de la VA</label>
	<div class="col-md-8">
	<select name="access_va_parameters"  class="form-control" >
<?php if($access_va_parameters==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_va_parameters==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>



<div class="form-group">
	<label>Acceso Hubs</label>
	<div class="col-md-8">
	<select name="access_hub_manager"  class="form-control" >
<?php if($access_hub_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_hub_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>








<div class="form-group">
	<label>Acceso Administración Tipos de Flota</label>
	<div class="col-md-8">
	<select name="access_fleet_type_manager"  class="form-control" >
<?php if($access_fleet_type_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_fleet_type_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>











<div class="form-group">
	<label>Acceso Administración Flota</label>
	<div class="col-md-8">
	<select name="access_fleet_manager"  class="form-control" >
<?php if($access_fleet_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_fleet_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>













<div class="form-group">
	<label>Acceso Administración Rangos</label>
	<div class="col-md-8">
	<select name="access_rank_manager"  class="form-control" >
<?php if($access_rank_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_rank_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>



















<div class="form-group">
	<label>Acceso Administración Rutas</label>
	<div class="col-md-8">
	<select name="access_route_manager"  class="form-control" >
<?php if($access_route_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_route_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>

















<div class="form-group">
	<label>Acceso Administración Tipos de Usuario</label>
	<div class="col-md-8">
	<select name="access_user_type_manager"  class="form-control" >
<?php if($access_user_type_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_user_type_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>
















<div class="form-group">
	<label>Acceso Administración Eventos</label>
	<div class="col-md-8">
	<select name="access_event_manager"  class="form-control" >
<?php if($access_event_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_event_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>












<div class="form-group">
	<label>Acceso Administración Notams</label>
	<div class="col-md-8">
	<select name="access_notam_manager"  class="form-control" >
<?php if($access_notam_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_notam_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>














<div class="form-group">
	<label>Acceso Gestión Email</label>
	<div class="col-md-8">
	<select name="access_email_manager"  class="form-control" >
<?php if($access_email_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_email_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>












<div class="form-group">
	<label>Acceso Gestión Idiomas</label>
	<div class="col-md-8">
	<select name="access_language_manager"  class="form-control" >
<?php if($access_language_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_language_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>














<div class="form-group">
	<label>Acceso Gestión Parámetros Financieros</label>
	<div class="col-md-8">
	<select name="access_financial_parameters"  class="form-control" >
<?php if($access_financial_parameters==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_financial_parameters==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>












<div class="form-group">
	<label>Acceso Administración Tours</label>
	<div class="col-md-8">
	<select name="access_tour_manager"  class="form-control" >
<?php if($access_tour_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_tour_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>












<div class="form-group">
	<label>Acceso Administración Premios</label>
	<div class="col-md-8">
	<select name="access_award_manager"  class="form-control" >
<?php if($access_award_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_award_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>










<div class="form-group">
	<label>Acceso Administración Aerolíneas</label>
	<div class="col-md-8">
	<select name="access_operator_manager"  class="form-control" >
<?php if($access_operator_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_operator_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>












<div class="form-group">
	<label>Acceso Administración Tipos de Vuelo</label>
	<div class="col-md-8">
	<select name="access_flight_types"  class="form-control" >
<?php if($access_flight_types==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_flight_types==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>















<div class="form-group">
	<label>Acceso Zona Docentes</label>
	<div class="col-md-8">
	<select name="access_docente"  class="form-control" >
<?php if($access_docente==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_docente==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>















<div class="form-group">
	<label>Acceso Administración Tienda</label>
	<div class="col-md-8">
	<select name="access_tienda"  class="form-control" >
<?php if($access_tienda==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_tienda==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>















<div class="form-group">
	<label>Acceso Administración Aeropuertos</label>
	<div class="col-md-8">
	<select name="access_airports_manager"  class="form-control" >
<?php if($access_airports_manager==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_airports_manager==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>




<div class="form-group">
	<label>Acceso Administración de Invitaciones</label>
	<div class="col-md-8">
	<select name="access_invitation"  class="form-control" >
<?php if($access_invitation==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($access_invitation==1) {
	?>
	<option value="1" selected="selected">SI</option>
	<?php
} else {
	?>
	<option value="1">SI</option>
	<?php
}
?>
</select></div></div>



<div class="form-group">
<label for="GvauserUserTypeId">Aerolíneas, autorizado a usar</label>
<div class="col-md-8">
<select name="operator_id[]" class="form-control" id="GvauserUserTypeId" multiple>
<?php 	$sql23 = "select * from operators";
	if (!$result23 = $db->query($sql23)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row23 = $result23->fetch_assoc()) {
		
	if (in_array($row23["operator_id"], $operator_id)) {
       echo '<option value="' . $row23["operator_id"] . '" selected>' . $row23["operator"] . '</option>';
    } else {
		echo '<option value="' . $row23["operator_id"] . '">' . $row23["operator"] . '</option>';
	}
			
		
		
	}
?>
</select></div></div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Tipo de Usuario"/></div></div></form></div>

				
				
				
				
				
				





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
