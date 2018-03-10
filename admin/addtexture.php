 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Texture</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Agregar Texture</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                  

<?php $idsim = $_GET['sim_id']; ?>
           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=agregartexture" class="form-horizontal" role="form"  method="post" accept-charset="utf-8">



<div class="form-group">
<label for="name">Nombre</label>
<div class="col-md-8">
<input name="nombre"  class="form-control" maxlength="255" type="text"  id="nombre" required />
</div></div>

<div class="form-group">
<label for="abreviacion">Link</label>
<div class="col-md-8">
<input name="link"  class="form-control"  type="text"  id="link" required />
</div></div>

<div class="form-group">
<label for="image_file">Imagen</b></label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file" required >
</div></div>

<div class="form-group">
<label for="GvauserUserTypeId">Aeronave</label>
<div class="col-md-8">
<select name="aeronaves" class="form-control">
<?php 



	$sql = "SELECT * FROM fleettypes";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {

	echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_description'] . '</option>';

}	
	
	
?>
</select></div></div>
	
										
                                        </div>

<div class="form-group">
<label for="GvauserUserTypeId">Estado</label>
<div class="col-md-8">
<select name="estado" class="form-control">
<option value="0">No Activo</option>
<option value="1">Activo</option>
</select></div></div>
<input name="idsim"   type="hidden"  id="idsim" value="<?php echo $idsim; ?>"/>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Texture"/></div></div></form></div>

				
				
				
				
				
				





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
