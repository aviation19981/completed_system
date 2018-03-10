
<?php
	
		
		$id = $_GET['id'];
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		$sql1 = "select * from productos where id=$id";

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1 = $result1->fetch_assoc()) {
			
			$administrador = $row1['administrador'];
			$producto = $row1['producto'];
			$imagen = $row1['imagen'];
			$link = $row1['link'];
			$type = $row1['type'];
			$simulador = $row1['simulador'];
			$price = $row1['price'];
			$date = $row1['date'];
			
		}
		
		
		
		
	
?>
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tienda</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Productos de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">    



<form method="POST" action="./?page=updateproducto">
<div align="center">
<center>
<table border="0" width="50%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#0000FF">
<p align="center"><font color="#FFFFFF">TIENDA VIRTUAL AERONAUTICA</font></td>
<td width="50%"><input type="hidden" class="form-control" name="administrador" value="<?php echo $administrador; ?>" size="20"></td>
</tr>
<tr>
<td width="50%">Nombre Producto: </td>
<td width="50%"><input type="text" class="form-control" name="producto" value="<?php echo $producto; ?>" size="50"></td>
</tr>
<tr>
<td width="50%">Imagen Producto: </td>
<td width="50%"><input type="text" class="form-control" name="imagen" value="<?php echo $imagen; ?>" size="50"></td>
</tr>
<tr>
<td width="50%">Link Producto: </td>
<td width="50%"><input type="text" class="form-control" name="link" value="<?php echo $link; ?>" size="50"></td>
</tr>
<tr>
</tr>
<tr>
<td width="50%">Tipo Producto: </td>
<td width="50%"><input type="text" class="form-control" name="type" value="<?php echo $type; ?>" size="50" readonly="readonly"></td>
</tr>
<tr>
<td width="50%">Tipo Simulador: </td>
<td width="50%"><input type="text" class="form-control" name="simulador" value="<?php echo $simulador; ?>" size="50" readonly="readonly"></td>
</tr>
<tr>
<td width="50%">Precio: </td>
<td width="50%">$<input type="text" class="form-control" name="price" value="<?php echo $price; ?>" size="20"></td>
<input type="hidden" name="ids" class="form-control" value="<?php echo $id; ?>" size="20">
</tr>
<tr>
<td width="50%">Fecha: </td>
<td width="50%"><input type="text" class="form-control" name="date" value="<?php 
$time = time(); 
echo $fecha_actual=date("d F Y (H:i:s)", $time);?>" size="30" readonly="readonly"></td>
</tr>
<tr>
<td width="100%" colspan="2">
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Actualizar Producto" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>



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