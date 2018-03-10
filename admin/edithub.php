 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Hub</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Hub</div>
                  <div class="row">
                    <div class="col-sm-8">                      
         


					
<?php
$hub_id = $_GET['hubid'];
include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql_hub_global ="select * from hubs where hub_id=$hub_id";
	if (!$result_hub_global = $db->query($sql_hub_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_hubs = $result_hub_global->fetch_assoc()) {
		$hub = $row_hubs["hub"];
		$training= $row_hubs["training"];
		$web= $row_hubs["web"];
		$image_url= $row_hubs["image_url"];
		
		

	}
	
		
		?>
           
      <div class="container">
<form action="./?page=updatehub" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
	<fieldset>

<input type="hidden" name="hub_id" value="<?php echo $hub_id; ?>"/>
<div class="form-group">
	<label>ICAO</label>
	<div class="col-md-8">
<input type="text" class="form-control" maxlength="4" name="hub" value="<?php echo $hub; ?>"/>
</div>
</div>

<div class="form-group">
	<label>URL Web</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="web" value="<?php echo $web; ?>"/>
</div>
</div>

<div class="form-group">
	<label>URL Imagen</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="image_url" value="<?php echo $image_url; ?>"/>
</div>
</div>

<div class="form-group">
	<label>Función Principal del Aeropuerto</label>
	<div class="col-md-8">
<select name="training" id="training" class="form-control">
<?php if($training==0) {
	?>
	<option value="0" selected>Aeropuerto Regular</option>
  <option value="1">Aeropuerto de Entrenamientos</option>
	
	<?php
} else {
	?>
	<option value="0" >Aeropuerto Regular</option>
  <option value="1" selected>Aeropuerto de Entrenamientos</option>
	
	<?php
	
}
?>
  
</select>
</div>
</div>


	

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Hub"/></div></div></form></div>

				
				
				
				
				
				





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
