 <?php $training_id = $_GET['id']; 
 
 $sql12 = "select * from trainings where training_id='$training_id'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
	        $title = $row12['title'];
			$content = $row12['content'];
			$description = $row12['description'];			
            $course_id = $row12['course_id'];				
		}
		?>
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Módulo de Curso</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Editar Módulo</div>
                  <div class="row">
                    <div class="col-sm-12">                      
   
           

	  
	  <form enctype="multipart/form-data" action="./?page=editmodules" method="post"  accept-charset="utf-12">
	  <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>"/>
	  <input type="hidden" name="training_id" id="training_id" value="<?php echo $training_id; ?>"/>
  <div class="form-group">
  <label>Nombre del Módulo:</label><div class="col-md-12">
  <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
 </div>
</div>
 
 <div class="form-group">
  <label>Descripción del Módulo:</label><div class="col-md-12">
  <input type="text" class="form-control" name="content" value="<?php echo $content; ?>">
  </div>
</div>
  
 <div class="form-group">
  <label>Contenido del Módulo:</label>

			<div class="col-md-12">
			 <textarea name="description" id="description" rows="80" cols="190"><?php echo $description; ?></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
            </script>
			</div>
</div>
 <div class="form-group"><div class="col-md-12">
 <br>
 <hr>
 <br>
<input class="btn btn-primary" style="width:100%" type="submit" value="Actualizar Módulo"/>
</div></div>

</form>
<br>
<hr>
<br>
 <div class="form-group"><div class="col-md-12">
<?php
        $contadorespdf = 0;
        $sql4 = "select * from trainings_pdf where id_modulo='$training_id'";  
		
		if (!$result4 = $db->query($sql4)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row4 = $result4->fetch_assoc()) { 
		$contadorespdf++;
		?>
	  <h3><li>PDF #<?php echo $contadorespdf; ?></li></h3>
	  <a href="./pdf/<?php echo $row4['pdf']; ?>#toolbar=0" class="btn btn-primary">Visualizar PDF</a>
	  <a href="./?page=deletepdf&id=<?php echo $row4['id']; ?>" class="btn btn-danger">Eliminar PDF</a>
	  <br>
      <?php } 
	   ?>

</div></div>


                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>


