 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Curso</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Curso</div>
                  <div class="row">
                    <div class="col-sm-8">                      
   
           
      <div class="container">
	  
	  <form enctype="multipart/form-data" action="./?page=addcourse" method="post"  accept-charset="utf-8">
	  <div class="form-group">
  <label>Nombre del Curso:</label><div class="col-md-8">
  <input type="text" class="form-control" name="name" value="">
 </div>
</div>
 
 <div class="form-group">
  <label>Docentes del Curso:</label><div class="col-md-8">
  <input type="text" class="form-control" name="docentes" value="">
  </div>
</div>
  
  <div class="form-group">
  <label>Aeronaves del Curso:</label><div class="col-md-8">
  <input type="text" class="form-control" name="aeronaves" value="">
  </div>
</div>
  
  
  <div class="form-group">
  <label>Rango del Curso:</label><div class="col-md-8">
  <select class="form-control" name="rank_id[]" multiple>
  <?php
  $sql = "select DISTINCT * from ranks  where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") order by operator_id, maximum_hours asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_rank = $result->fetch_assoc()) {
		$operator_id_rank = $row_rank["operator_id"];
		$operatorname = "";
		$sql_op = "select * from operators where operator_id='$operator_id_rank'";
	    if (!$result_op = $db->query($sql_op)) {
		   die('There was an error running the query [' . $db->error . ']');
	    }
	    while ($row_op = $result_op->fetch_assoc()) {
			$operatorname = $row_op['operator'];
		}
		
		
		echo '<option value="' . $row_rank["rank_id"] . '">' . $row_rank["rank"] . ' [' . $operatorname . ']</option>';
	}
	
	?>
	</select>
  </div>
</div>
  
  
 
 <div class="form-group">
  <label>Descripción del Curso:</label>

			<div class="col-md-8">
			 <textarea name="description" id="description" rows="10" cols="80"></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
            </script>
			</div>
</div>
 <div class="form-group">
<input class="btn btn-primary" type="submit" value="Añadir Curso"/>
</div>
</form>




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


