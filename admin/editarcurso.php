 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Cursos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Cursos de Entrenamiento</div>
                  <div class="row">
                    <div class="col-sm-12">   
<?php
$idents = $_GET['id'];

	if ($_SESSION["access_docente"] == '1')
	{	
		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 


$sql12 = "select DISTINCT * from courses where course_id='$idents'";
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
	
		
		
		
		
		
?>


 



<br>
<br>
<h2>Curso de Entrenamiento</h2>
<hr>
<br>
<form enctype="multipart/form-data" action="./?page=updatecourse" method="post"  accept-charset="utf-8">
<input type="hidden" class="form-control" name="course_id" value="<?php echo $row12["course_id"]; ?>">
  <label>Nombre del Curso:</label>
  <input type="text" class="form-control" name="name" value="<?php echo $row12["name"]; ?>">
  <hr>
  <label>Docentes del Curso:</label>
  <input type="text" class="form-control" name="docentes" value="<?php echo $row12["docentes"]; ?>">
  <hr>
  <label>Aeronaves del Curso:</label>
  <input type="text" class="form-control" name="aeronaves" value="<?php echo $row12["aeronaves"]; ?>">
  <hr>
  <label>Rango del Curso:</label>
   <select class="form-control" name="rank_id[]" multiple >
  <?php
  $rangoshabilitados=array();

	$sqlhabilitaciones = "SELECT * FROM ranktypes_course where course_id=$idents";
 if (!$resultha = $db->query($sqlhabilitaciones))  {
	die('There was an error running the query [' . $db->error . ']');
   }

while ($rowha = $resultha->fetch_assoc()) {

$rangoshabilitados[]=$rowha['rank_id'];

}


  $sql = "select DISTINCT * from ranks  where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") order by operator_id, maximum_hours asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		
		$operator_id_rank = $row["operator_id"];
		$operatorname = "";
		$sql_op = "select * from operators where operator_id='$operator_id_rank'";
	    if (!$result_op = $db->query($sql_op)) {
		   die('There was an error running the query [' . $db->error . ']');
	    }
	    while ($row_op = $result_op->fetch_assoc()) {
			$operatorname = $row_op['operator'];
		}
		
		
		
		if (in_array($row["rank_id"],$rangoshabilitados)) {
			
		echo '<option value="' . $row["rank_id"] . '" selected>' . $row["rank"]  . ' [' . $operatorname . ']</option>';
		} else {
			
		echo '<option value="' . $row["rank_id"] . '">' . $row["rank"]  . ' [' . $operatorname . ']</option>';
		}
	}
	
	?>
	</select>
  <hr>
  <label>Descripción del Curso:</label>
  
  <textarea name="description" id="description" rows="10" cols="80"><?php echo $row12["description"]; ?></textarea>
    <script>
                // Replace the <textarea id="event_text"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
            </script>         
  <input type="submit" class="btn btn-primary btn-lg btn-block form-control"   value="Actualizar Curso">
</form>
		<?php } 
	} else
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