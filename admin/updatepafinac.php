 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Finanzas</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Parámetro Financiero</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$parametro = $_GET['parametro']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM financial_parameters where id=$parametro";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$finantial_active = $row['finantial_active'];
		$financial_parameter = $row['financial_parameter'];
		$amount = $row['amount'];
		$is_cost = $row['is_cost'];
		$is_fix_cost = $row['is_fix_cost'];
		$is_profit = $row['is_profit'];
		$linked_to_time = $row['linked_to_time'];
		$linked_to_pax = $row['linked_to_pax'];
		$linked_to_distance = $row['linked_to_distance'];
		$linked_to_flight = $row['linked_to_flight'];
		$parameter_active = $row['parameter_active'];
        $monthly = $row['monthly'];
		$percent_of_taxes_per_income = $row['percent_of_taxes_per_income'];
	}
?>





           
      <div class="container">
<form action="./?page=actualizarparfinanc" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="parametro" value="<?php echo $parametro; ?>"/></div>	<fieldset>


	<div class="form-group">
	<label>Nombre Parámetro</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="financial_parameter" value="<?php echo $financial_parameter; ?>"/>
</div></div>


<div class="form-group">
	<label>Cantidad de Costo/Ingreso</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>"/>
</div></div>


	<div class="form-group">
	<label>Estado Parámetro</label>
	<div class="col-md-8">
	<select name="parameter_active"  class="form-control" >
<?php if($parameter_active==0) {
	?>
	<option value="0" selected="selected">INACTIVO</option>
	<?php
} else {
	?>
	<option value="0">INACTIVO</option>
	<?php
}
?>

<?php if($parameter_active==1) {
	?>
	<option value="1" selected="selected">ACTIVO</option>
	<?php
} else {
	?>
	<option value="1">ACTIVO</option>
	<?php
}
?>
</select></div></div>








<div class="form-group">
	<label>Es un Costo Variable</label>
	<div class="col-md-8">
	<select name="is_cost"  class="form-control" >
<?php if($is_cost==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($is_cost==1) {
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
	<label>Es un Ingreso</label>
	<div class="col-md-8">
	<select name="is_profit"  class="form-control" >
<?php if($is_profit==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($is_profit==1) {
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
	<label>Es un costo fijo</label>
	<div class="col-md-8">
	<select name="is_fix_cost"  class="form-control" >
<?php if($is_fix_cost==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($is_fix_cost==1) {
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
	<label>Cálculos con Tiempo de Vuelo</label>
	<div class="col-md-8">
	<select name="linked_to_time"  class="form-control" >
<?php if($linked_to_time==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($linked_to_time==1) {
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
	<label>Cálculos con Pasajeros</label>
	<div class="col-md-8">
	<select name="linked_to_pax"  class="form-control" >
<?php if($linked_to_pax==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($linked_to_pax==1) {
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
	<label>Cálculos con Distancia</label>
	<div class="col-md-8">
	<select name="linked_to_distance"  class="form-control" >
<?php if($linked_to_distance==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($linked_to_distance==1) {
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
	<label>Cálculos con Vuelo Realizado</label>
	<div class="col-md-8">
	<select name="linked_to_flight"  class="form-control" >
<?php if($linked_to_flight==0) {
	?>
	<option value="0" selected="selected">NO</option>
	<?php
} else {
	?>
	<option value="0">NO</option>
	<?php
}
?>

<?php if($linked_to_flight==1) {
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


<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Parámetro Financiero"/></div></div></form></div>

				
				
				
				
				
				





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
