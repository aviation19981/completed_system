 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Información Tour</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información del Tour</div>
                  <div class="row">
                    <div class="col-sm-8">                      
   <?php 
$tour = $_GET['tour']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM tours where tour_id=$tour";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$tour_id = $row['tour_id'];
		$tour_name = $row['tour_name'];
		$tour_description = $row['tour_description'];
		$tour_image = $row['tour_image'];
		$start_date = $row['start_date'];
		$end_date = $row['end_date'];
		$tour_award_image = $row['tour_award_image'];
	}
?>

           
      <div class="container">
<form enctype="multipart/form-data" action="./?page=actualizartourva" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>"/></div>	<fieldset>

	<div class="form-group">
	<label>Titulo del Tour</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="tour_name" value="<?php echo $tour_name; ?>"/>
</div>
</div>	
	
<div class="form-group">
	<label>Fecha Inicio</label>
	<div class="col-md-8">
<input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>"/>
</div>
</div>	

<div class="form-group">
	<label>Fecha Fin</label>
	<div class="col-md-8">
<input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>"/>
</div>
</div>	


<div class="form-group">
<label for="image_file">Imagen Tour</label>
<div class="col-md-8">
<input name="image_file" class="form-control" type="file" id="image_file">
</div></div>


<div class="form-group">
<label for="image_file">Imagen Premio</label>
<div class="col-md-8">
<input name="image_file2" class="form-control" type="file" id="image_file2">
</div></div>


			
<div class="form-group">
	<label>Descripción Evento</label>
	<div class="col-md-8">
	 <textarea name="tour_description" id="tour_description" rows="10" cols="80"><?php echo $tour_description; ?></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'tour_description' );
            </script>
</div>
</div>




<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Tour"/></div></div></form></div>

				
				


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
