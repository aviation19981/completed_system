<?php $va_id = $_GET['va']; ?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Rango</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Agregar Rango</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                  


           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=agregarrangova" class="form-horizontal" method="post">



<div class="form-group">
<label for="name">Nombre</label>
<div class="col-md-8">
<input name="name"  class="form-control" maxlength="255" type="text"  id="name" required />
</div></div>

<div class="form-group">
<label for="abreviacion">Abreviación</label>
<div class="col-md-8">
<input name="abreviacion"  class="form-control" maxlength="255" type="text"  id="abreviacion" required />
</div></div>

<div class="form-group">
<label for="salario">Hora Salario</label>
<div class="col-md-8">
<input name="salario" class="form-control" type="number"  id="salario" required />
</div></div>

<div class="form-group">
<label for="minhoras">Mínimo Horas</label>
<div class="col-md-8">
<input name="minhoras"  class="form-control" type="number"  id="minhoras" required />
</div></div>

<div class="form-group">
<label for="maxhoras">Máximo Horas</label>
<div class="col-md-8">
<input name="maxhoras" class="form-control" type="number"  id="maxhoras" required />
</div></div>

<div class="form-group">
<label for="image_file">Imagen Rango <b>OBLIGATIORIO</b></label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file" required />
</div></div>




	
										
                                        </div>

<div class="form-group">
<label for="GvauserUserTypeId">Aeronaves que se añaden al Rango</label>
<div class="col-md-8">
<select name="aeronaves[]" class="form-control" id="aeronaves" multiple required >
<?php 	$sql = "SELECT * FROM fleettypes";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
	
$idplanetype = $row['fleettype_id'];
$i = 0;
	
$sql2 = "SELECT * FROM fleets where fleettype_id='$idplanetype' and operator_id='$va_id '";
 if (!$result2 = $db->query($sql2))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row2 = $result2->fetch_assoc()) {
$i++;	
}
	//if($i>0) {
			echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_icao'] . '</option>';
		
	//}
	
}
?>
</select></div></div>

<input type="hidden" name="va_id" id="va_id" value="<?php echo $va_id; ?>"/>
<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Rango"/></div></div></form></div>

				
				
				
				
				
				





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
