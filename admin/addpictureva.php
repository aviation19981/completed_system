 <?php 
 $va = $_GET['va'];
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	$sql = "select * from operators where operator_id='$va'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row = $result->fetch_assoc()) {
		$operator_name = $row['operator'];
	}

?>

 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Foto para la aerolínea <?php echo $operator_name; ?></div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir fotografía</div>
                  <div class="row">
                    <div class="col-sm-8">                      



           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=agregarfoto" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<fieldset>

<div class="form-group">
<label for="image_file">Imagen</label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file">
</div></div>

<input name="operator_id"  value="<?php echo $va; ?>" type="hidden" id="operator_id">
	
                                        </div>



<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Agregar Foto a la aerolínea"/></div></div></form></div>

				
				
				
				
				
				





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
