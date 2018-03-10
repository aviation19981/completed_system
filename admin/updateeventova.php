 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Información Evento</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información del Evento</div>
                  <div class="row">
                    <div class="col-sm-8">                      
   <?php 
$evento = $_GET['evento']; 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 
		$sql = "SELECT * FROM events where event_id=$evento";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row = $result->fetch_assoc()) {
		$event_id = $row['event_id'];
		$create_date = $row['create_date'];
		$publish_date = $row['publish_date'];
		$hide_date = $row['hide_date'];
		$gvauser_id = $row['gvauser_id'];
		$event_name = $row['event_name'];
		$event_text = $row['event_text'];
	}
?>

           
      <div class="container">
<form action="./?page=updateventova" class="form-horizontal" role="form" id="GvauserEditForm" method="post" accept-charset="utf-8">
<div style="display:none;"><input type="hidden" name="event_id" value="<?php echo $event_id; ?>"/></div>	<fieldset>

	<div class="form-group">
	<label>Titulo Evento</label>
	<div class="col-md-8">
<input type="text" class="form-control" name="event_name" value="<?php echo $event_name; ?>"/>
</div>
</div>	
	
<div class="form-group">
	<label>Fecha Publicación</label>
	<div class="col-md-8">
<input type="date" class="form-control" name="publish_date" value="<?php echo $publish_date; ?>"/>
</div>
</div>	

<div class="form-group">
	<label>Fecha Ocultar</label>
	<div class="col-md-8">
<input type="date" class="form-control" name="hide_date" value="<?php echo $hide_date; ?>"/>
</div>
</div>	
			
<div class="form-group">
	<label>Descripción Evento</label>
	<div class="col-md-8">
	 <textarea name="event_text" id="event_text" rows="10" cols="80"><?php echo $event_text; ?></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'event_text' );
            </script>
</div>
</div>




<div class="form-group"><div class="col-lg-offset-2 col-lg-2"><input class="btn btn-primary" type="submit" value="Actualizar Evento"/></div></div></form></div>

				
				


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
