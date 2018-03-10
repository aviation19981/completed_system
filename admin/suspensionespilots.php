<?php
	if($_SESSION["access_pilot_manager"]==1 || $_SESSION["access_docente"]==1){
		
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		 
?>


 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Administración Suspensiones</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Pilotos Colstar Alliance :: Sanciones</div>
                  <div class="row">
                    <div class="col-sm-12">   



<h2>Buen día: <?php echo $pilotname . ' ' . $pilotsurname . '  ' . $callsign; ?></h2>
<br>

<h2>Formulario Tramite Sanción</h2>
<hr>
<br>





	
	<form method="POST" action="?page=addsuspension">

<div align="center">
<center>
<table class="table table-hover" border="0" width="100%" bgcolor="#F2F2F2">
<tr bgcolor="#33AFFF">
<td width="100%" colspan="2" >
<p align="center"><font color="BLACK"><?php echo $user_type_name; ?>: <?php echo $pilotname . ' ' . $pilotsurname . ' (' . $callsign . ') '; ?></font></td>
<td width="50%"><input type="hidden" name="docentes" value="<?php echo $id; ?>" size="20"></td>
</tr>
<tr>
<td width="50%">Piloto: </td>
<td width="50%"><select class="form-control" name="gvauser_id" id="gvauser_id">
<?php 
$sql2 = "select * from gvausers where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") order by callsign asc";  
		
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row2 = $result2->fetch_assoc()) {
			 echo '<option value="' . $row2['gvauser_id'] . '">[' . $row2['callsign'] . ' ] ' . $row2['name'] . ' ' . $row2['surname'] . '</option>';
		}

?>
</select></td>

</tr>
<tr>
</tr>


<tr>
<td width="50%">Fecha Inicio Suspensión: </td>
<td>
<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
<input  class="form-control"  type='date' name="fecha_inicio" id="fecha_inicio" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly="readonly"/>

</td>
</tr>
<tr>
<td width="50%">Fecha Fin Suspensión: </td>
<td>
<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
<input  class="form-control"  type='date' name="fecha_fin" id="fecha_fin" min="<?php echo date("Y-m-d"); ?>" class="form-control"/>

</td>
</tr>
<tr>
<td width="50%">Comentarios o Causas: </td>
<td width="50%">
<textarea class="form-control" name="comments" id="comments" rows="10" cols="80"></textarea>
</tr>
<tr>
<td width="100%" colspan="2">
<br>
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Suspender Usuario" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>


  
	<?php } else
				{
					echo '<div class="alert alert-danger"> You do not have access to suspension module to users</div>';
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
