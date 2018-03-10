 <?php $course_id = $_POST['curso_id']; ?>
 	<style>

	.progress { position:relative; width:100%; border: 1px solid #ddd; padding: 1px; border-radius: 3px;    height: 30px;
    text-align: center; }
	.bar {width:0%; height:30px; border-radius: 3px; }
	.percent { position:absolute; display:inline-block; top:3px; left:48%; }
	</style>
	
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Módulo de Curso</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Añadir Módulo</div>
                  <div class="row">
                    <div class="col-sm-12">                      
   

	  
	  <form enctype="multipart/form-data" action="./?page=addcoursemodule" method="post"  accept-charset="utf-8">
	  <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>"/>
  <div class="form-group">
  <label>Nombre del Módulo:</label><div class="col-md-12">
  <input type="text" class="form-control" name="title" value="">
 </div>
</div>
 
 <div class="form-group">
  <label>Descripción del Módulo:</label><div class="col-md-12">
  <input type="text" class="form-control" name="content" value="">
  </div>
</div>
  
 <div class="form-group">
  <label>Contenido del Módulo:</label>

			<div class="col-md-12">
			 <textarea name="description" id="description" rows="80" cols="190"></textarea>
            <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
            </script>
			</div>
			<br>
</div>

<div class="form-group">
  <label>Subir archivos PDF:</label><div class="col-md-12">
  <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="multiple">
  </div>
  <br>
</div>

<div class="form-group">
<br>
<hr>
<br>
<label>Estado subida archivos:</label>
 <div class="progress">
        <div class="bar" id="bar_estado"></div >
        <div class="percent" align="middle">0%</div >
    </div>
    
    <div id="status"></div>
</div>

 <div class="form-group">
 <br>
 <hr>
 <br>
<input class="btn btn-primary" style="width:100%" type="submit" value="Añadir Módulo"/>
</div>

</form>


    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="./js/jquery.form.js"></script>
<script>
(function() 
{
    
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');
	   
	$('form').ajaxForm({
	    beforeSend: function() {
	        status.empty();
	        var percentVal = '0%';
	        bar.width(percentVal)
	        percent.html(percentVal);
	    },
	    uploadProgress: function(event, position, total, percentComplete) {
	        var percentVal = percentComplete + '%';
	        if(percentComplete<20) {
			bar.width(percentVal)
			percent.html(percentVal);
		    document.getElementById('bar_estado').style.backgroundColor='#B00606';
		} else if(percentComplete>=20 && percentComplete<=50) {
			bar.width(percentVal)
			percent.html(percentVal);
			document.getElementById('bar_estado').style.backgroundColor='#D17106';
		} else if(percentComplete>50 && percentComplete<=70) {
			bar.width(percentVal)
			percent.html(percentVal);
			
			document.getElementById('bar_estado').style.backgroundColor='#D4D112';
		} else if(percentComplete>70 && percentComplete<100) {
			bar.width(percentVal)
			percent.html(percentVal);
			
			document.getElementById('bar_estado').style.backgroundColor='#B4F5B4';
		} else if(percentComplete=100) {
			var percentVal = 'Proceso Completado, esperar un momento.';
			bar.width(percentVal)
			percent.html(percentVal);
			
			document.getElementById('bar_estado').style.backgroundColor='#444444';
		}
			//console.log(percentVal, position, total);
	    },
		
	    success: function() {
	        //var percentVal = 'Proceso Completado, esperar un momento.';
	        //bar.width(percentVal)
	        //percent.html(percentVal);
	    },
		complete: function(xhr) {
			status.html(xhr.responseText);
		}
	}); 
})();       
</script>



                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>


