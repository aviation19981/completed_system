
<?php
	
		
		$id = $_GET['id'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
	
		
		$sql1 = "select * from presentacionexamen where id=$id";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1 = $result1->fetch_assoc()) {
			
			$vidusuario = $row1['vid'];
			$nomresapellidos = $row1['nombres'] . ' ' . $row1['apellidos'];
			
		}
		
		
	
		
		
	
?>


 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Examen Entrevista</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Calificación de Entrevista</div>
                  <div class="row">
                    <div class="col-sm-12">   






	<form method="POST" action="?page=notaexamenvaentrevista">

<div align="center">
<center>
<table border="0" width="100%" bgcolor="#F2F2F2">
<tr>
<td width="50%">Aspirante: </td>
<td width="50%"><input type="text" name="estudiantes" class="form-control"  value="<?php echo $nomresapellidos . ' (' . $vidusuario . ')'; ?>" size="20" readonly="readonly"></td>

</tr>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td width="50%">Nota Entrevista: </td>
<td width="50%">

<select name="entrevistanote"  class="form-control" id="entrevistanote"  >
<?php for ($i = 1; $i <= 10; $i++) { ?>
  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
</select>

</td>

</tr>


<input type="hidden" name="vidusuario" value="<?php echo $vidusuario; ?>" size="20"/>
<input type="hidden" name="idtest" value="<?php echo $id; ?>" size="20"/>

<tr>
<td></td>
<td></td>
</tr>

<tr>
<td width="100%" colspan="2">
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Agregar Nota Entrevista" name="B1"></td>
</tr>
</table>
</center>
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