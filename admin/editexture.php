 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Texture</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Editar Texture</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                  

<?php $text = $_GET['text']; include('./db_login.php');	$db = new mysqli($db_host , $db_username , $db_password , $db_database);	$db->set_charset("utf8");	if ($db->connect_errno > 0) {		die('Unable to connect to database [' . $db->connect_error . ']');	}			$sql = "select * from textures where id='$text'";	if (!$result = $db->query($sql)) {		die('There was an error running the query [' . $db->error . ']');	}		while ($row = $result->fetch_assoc()) {		$idsim = $row['idsim'];		$nombre = $row['nombre'];		$link = $row['link'];		$estado = $row['estado'];		$icao = $row['icao'];	}?>
      <div class="container">
<form enctype="multipart/form-data" action="./?page=actualizartexture" class="form-horizontal" role="form"  method="post" accept-charset="utf-8">



<div class="form-group">
<label for="name">Nombre</label>
<div class="col-md-8">
<input name="nombre"  class="form-control" maxlength="255" type="text"  id="nombre" value="<?php echo $nombre; ?>"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Link</label>
<div class="col-md-8">
<input name="link"  class="form-control"  type="text"  id="link" value="<?php echo $link; ?>"/>
</div></div>


<div class="form-group">
<label for="GvauserUserTypeId">Aeronave</label>
<div class="col-md-8">
<select name="aeronaves" class="form-control">
<?php 



	$sql = "SELECT * FROM fleettypes order by plane_description asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
   if($icao==$row['fleettype_id']) {	   echo '<option value="' . $row['fleettype_id'] . '" selected>' . $row['plane_description'] . '</option>';   } else {	  echo '<option value="' . $row['fleettype_id'] . '">' . $row['plane_description'] . '</option>';    }
	

}	
	
	
?>
</select></div></div>
	
										
                                        </div>

<div class="form-group">
<label for="GvauserUserTypeId">Estado</label>
<div class="col-md-8">
<select name="estado" class="form-control"><?php if ($estado==0) {		echo '<option value="0" selected>No Activo</option><option value="1">Activo</option>';} else {		echo '<option value="0">No Activo</option><option value="1" selected>Activo</option>';} ?>

</select></div></div>
<input name="idsim"   type="hidden"  id="idsim" value="<?php echo $idsim; ?>"/><input name="idtext"   type="hidden"  id="idtext" value="<?php echo $text; ?>"/>

<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Editar Texture"/></div></div></form></div>

				
				
				
				
				
				





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
