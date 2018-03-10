 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Examen</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Pregunta</div>
                  <div class="row">
                    <div class="col-sm-12">   
<?php
	if ($_SESSION["access_docente"] == '1')
	{	
		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
	
?>



<h3>Crear Pregunta</h3>
<hr>

<form method="POST" action="./?page=addaskva">


 <div class="form-group">
  <label>Pregunta:</label>
  <textarea name="pregunta" id="pregunta" rows="10" cols="80"></textarea>
   <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'pregunta' );
            </script>
 </div>

<hr>

 <div class="form-group">
  <label>Respuesta A:</label>
  <textarea name="A" id="A" rows="10" cols="80"></textarea>
  <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'A' );
            </script>
 </div>

<hr>
<div class="form-group">
  <label>Respuesta B:</label>
   <textarea name="B" id="B" rows="10" cols="80"></textarea>
  <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'B' );
            </script>
 </div>

<hr>
<div class="form-group">
  <label>Respuesta C:</label>
<textarea name="C" id="C" rows="10" cols="80"></textarea>
 <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'C' );
            </script>
 </div>

<hr>
<div class="form-group">
  <label>Respuesta D:</label>
<textarea name="D" id="D" rows="10" cols="80"></textarea>
   <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'D' );
            </script>
 </div>

<hr>
<div class="form-group">
  <label>Respuesta Correcta:</label>
   <select class="form-control"  name="correcta">
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  <option value="D">D</option>
</select>
 </div>

<hr>

<div class="form-group">
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Agregar Pregunta" name="B1"></td>
</div>



</form>


	<?php } 	else
				{
					echo '<div class="alert alert-danger"> You do not have access to teacher module</div>';
				}
				?>



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