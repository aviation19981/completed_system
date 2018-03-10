 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Editar Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-8">                      
                      									 
<?php 
$va = $_GET['va']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM operators where operator_id=$va";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$operator = $row['operator'];
		$callsign = $row['callsign'];
		$iata = $row['iata'];
		$hub_principal = $row['hub_principal'];
		$ceo = $row['ceo'];
		$vceo = $row['vceo'];
		$parrafo_primero = $row['parrafo_primero'];
		$facebook = $row['facebook'];
		$whatsapp = $row['whatsapp'];
	}
?>





           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=actualizaraerolinea" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="operator_id" value="<?php echo $va; ?>"/></div>	<fieldset>


<div class="form-group">
<label for="name">Aerolínea</label>
<div class="col-md-8">
<input name="operator"  class="form-control" type="text" value="<?php echo $operator; ?>" id="operator"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Callsign ICAO</label>
<div class="col-md-8">
<input name="callsign"  class="form-control" maxlength="3" type="text" value="<?php echo $callsign; ?>" id="callsign"/>
</div></div>

<div class="form-group">
<label for="abreviacion">Callsign IATA</label>
<div class="col-md-8">
<input name="iata"  class="form-control" maxlength="2" type="text" value="<?php echo $iata; ?>" id="iata"/>
</div></div>

<div class="form-group">
<label for="salario">Hub</label>
<div class="col-md-8">
<input name="hub_principal" class="form-control" type="text" maxlength="4" value="<?php echo $hub_principal; ?>" id="hub_principal"/>
</div></div>


<div class="form-group">
<label for="maxhoras">CEO</label>
<div class="col-md-8">
<input name="ceo" class="form-control" type="text" value="<?php echo $ceo; ?>" id="ceo"/>
</div></div>

<div class="form-group">
<label for="maxhoras">VCEO</label>
<div class="col-md-8">
<input name="vceo" class="form-control" type="text" value="<?php echo $vceo; ?>" id="vceo"/>
</div></div>

<div class="form-group">
<label for="maxhoras">Link grupo de Facebook</label>
<div class="col-md-8">
<input name="facebook" class="form-control" type="text" value="<?php echo $facebook; ?>" id="facebook"/>
</div></div>

<div class="form-group">
<label for="maxhoras">Link grupo de Whatsapp</label>
<div class="col-md-8">
<input name="whatsapp" class="form-control" type="text" value="<?php echo $whatsapp; ?>" id="whatsapp"/>
</div></div>

<div class="form-group">
<label for="image_file">Logo Aerolínea</label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file"/>
</div></div>

<div class="form-group">
<label for="image_file2">Imagen Aerolínea</label>
<div class="col-md-8">
<input name="image_file_two" class="form-control" type="file" id="image_file_two"/>
</div></div>

<div class="form-group">
	<label>Descripción</label>
	<div class="col-md-8">
	<textarea name="parrafo_primero" id="parrafo_primero" rows="10" cols="80"><?php echo $parrafo_primero; ?></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'parrafo_primero' );
            </script>

</div>
</div>



	
										
                                        </div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Aerolínea"/></div></div></form></div>

				
				
				
				
				
				





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
