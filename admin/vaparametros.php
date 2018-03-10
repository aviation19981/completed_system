 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Parámetros</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Parámetros de la VA</div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      									 
<?php 
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); 
	$db->set_charset("utf8"); 
	if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		
		
		$sql = "select * FROM va_parameters where va_parameters_id='1'";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		
		
		$hours_charter=  $row["hours_charter"];
		$allow_charter_flight=  $row["allow_charter_flight"];
		$plane_status_hangar=  $row["plane_status_hangar"];
		$flight_wear=  $row["flight_wear"];
		$hangar_maintenance_days=  $row["hangar_maintenance_days"];
		$hangar_maintenance_value=  $row["hangar_maintenance_value"];
		$charter_reduction=  $row["charter_reduction"];
		$currency=  $row["currency"];
		$hours_auto_cancellation=  $row["hours_auto_cancellation"];
		$admisiones=  $row["admisiones"];
		$number_pilots=  $row["number_pilots"];
	    $ticket=  $row["ticket"];
		$nm_for_damage=  $row["nm_for_damage"];
		$hours_min_per_week=  $row["hours_min_per_week"];
		$percentage_test_rank=  $row["percentage_test_rank"];
		$maximium_days_fired = $row["maximium_days_fired"];
}
?>





           
      <div class="container">
<form action="./?page=actualizarparametrosva" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="va_parameters_id" value="1"/></div>	<fieldset>

<div class="form-group">
	<label>Máximo Pilotos</label>
	<div class="col-md-12">
<input type="number" class="form-control" name="number_pilots" value="<?php echo $number_pilots; ?>" />
</div>
</div>

<div class="form-group">
	<label>Horas mínimas por semana por aerolínea</label>
	<div class="col-md-12">
<input type="number" class="form-control" name="hours_min_per_week" value="<?php echo $hours_min_per_week; ?>" />
</div>
</div>

<div class="form-group">
	<label>Horas requeridas para Vuelos Chárter</label>
	<div class="col-md-12">
<input type="number" class="form-control" name="hours_charter" value="<?php echo $hours_charter; ?>" />
</div>
</div>

<div class="form-group">
	<label>Horas requeridas mínimas en porcentaje [0-100] para exigir presentación examen</label>
	<div class="col-md-12">
<input type="number" class="form-control" max="100" min="0" name="percentage_test_rank" value="<?php echo $percentage_test_rank; ?>" />
</div>
</div>

<div class="form-group">
	<label>Reducción Salario Vuelo Chárter</label>
	<div class="col-md-12">
<input type="number" max="100" class="form-control" name="charter_reduction" value="<?php echo $charter_reduction; ?>" />
</div>
</div>

<div class="form-group">
	<label>Permiso Vuelo Chárter</label>
	<div class="col-md-12">
	<select name="allow_charter_flight"  class="form-control" >
	<?php 
	
	
		if($allow_charter_flight==1) {
			echo '<option value="1" selected="selected">SI</option>';
			echo '<option value="0">NO</option>';
		} else {
			echo '<option value="0" selected="selected">NO</option>';
			echo '<option value="1">SI</option>';
		}
		
	
	
	
	
	 ?>
</select>
</div>
</div>


<div class="form-group">
	<label>Estado Aeronave para Hangar</label>
	<div class="col-md-12">
<input type="number" max="100" class="form-control" name="plane_status_hangar" value="<?php echo $plane_status_hangar; ?>" />
</div>
</div>


<div class="form-group">
	<label>Porcentaje de Desgaste Aeronave por Vuelo</label>
	<div class="col-md-12">
<input type="number" max="100" step=0.01 class="form-control" name="flight_wear" value="<?php echo $flight_wear; ?>" />
</div>
</div>
<div class="form-group">
	<label>Desgaste Aeronave por Vuelo cada Millas</label>
	<div class="col-md-12">
<input type="number" class="form-control" step=0.01 name="nm_for_damage" value="<?php echo $nm_for_damage; ?>" />
</div>
</div>



<div class="form-group">
	<label>Días de Mantenimiento Aeronave</label>
	<div class="col-md-12">
<input type="number" class="form-control" name="hangar_maintenance_days" value="<?php echo $hangar_maintenance_days; ?>" />
</div>
</div>

<div class="form-group">
	<label>Valor de Mantenimiento Aeronave</label>
	<div class="col-md-12">
<input type="number" class="form-control" name="hangar_maintenance_value" value="<?php echo $hangar_maintenance_value; ?>" />
</div>
</div>


<div class="form-group">
	<label>Moneda Virtual</label>
	<div class="col-md-12">
<input type="text" class="form-control" name="currency" value="<?php echo $currency; ?>" />
</div>
</div>


<div class="form-group">
	<label>Horas Auto-cancelación Vuelo</label>
	<div class="col-md-12">
<input type="text" class="form-control" name="hours_auto_cancellation" value="<?php echo $hours_auto_cancellation; ?>" />
</div>
</div>


<div class="form-group">
	<label>Admisiones Aerolínea</label>
	<div class="col-md-12">
	<select name="admisiones"  class="form-control" >
	<?php 
	
	
		if($admisiones==1) {
			echo '<option value="1" selected="selected">SI</option>';
			echo '<option value="0">NO</option>';
		} else {
			echo '<option value="0" selected="selected">NO</option>';
			echo '<option value="1">SI</option>';
		}
		
	
	
	
	
	 ?>
</select>
</div>
</div>


<div class="form-group">
	<label>Valor Ticket por KM</label>
	<div class="col-md-12">
<input type="number" class="form-control" name="ticket" value="<?php echo $ticket; ?>" />
</div>
</div>

<div class="form-group">
	<label>Días máximos para eliminar piloto por inactividad</label>
	<div class="col-md-12">
<input type="number" class="form-control" min="1" name="maximium_days_fired" value="<?php echo $maximium_days_fired; ?>" />
</div>
</div>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Parámetros"/></div></div></form></div>

				
				


                    </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      
