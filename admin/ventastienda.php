 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Tienda</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Productos de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">    
<?php
	
		
		
	if ($_SESSION["access_tienda"] == '1')
	{		
		
		
		
	
?>




<h2>Añadir Productos a la Tienda</h2>
<hr>
<br>





	
	<form method="POST" action="./?page=addproducto">

<div align="center">
<center>
<table border="0" width="50%" bgcolor="#F2F2F2">
<tr>
<td width="100%" colspan="2" bgcolor="#0000FF">
<p align="center"><font color="#FFFFFF">TIENDA VIRTUAL AERONAUTICA</font></td>
<td width="50%"><input type="hidden" class="form-control" name="administrador" value="<?php echo $pilotname . ' ' . $pilotsurname; ?>" size="20"></td>
</tr>
<tr>
<td width="50%">Nombre Producto: </td>
<td width="50%"><input type="text" name="producto" class="form-control"  value="" size="50"></td>
</tr>
<tr>
<td width="50%">Imagen Producto: </td>
<td width="50%"><input type="text" name="imagen" class="form-control"  value="" size="50"></td>
</tr>
<tr>
<td width="50%">Link Producto: </td>
<td width="50%"><input type="text" name="link" class="form-control" value="" size="50"></td>
</tr>
<tr>
</tr>
<tr>
<td width="50%">Tipo Producto: </td>
<td width="50%"> 
<select class="form-control" name="type" id="type">
  <option value="Escenario">Escenario</option>
  <option value="Aeronave">Aeronave</option>
  <option value="Addon Desempeño">Addon Desempeño</option> 
  <option value="Addon Realismo">Addon Realismo</option> 
</select>

</td>
</tr>
<tr>
<td width="50%">Tipo Simulador: </td>
<td width="50%"> 
<select class="form-control" name="simulador" id="simulador">
  <option value="FS9">FS9</option> 
  <option value="FSX">FSX</option>
  <option value="P3D">P3D</option>
  <option value="FSX/P3D">FSX/P3D</option> 
  <option value="XP9">X-Plane 9</option> 
  <option value="XP10">X-Plane 10</option>
  <option value="XP11">X-Plane 11</option>
  <option value="XP10/XP44">X-Plane 10/11</option>
  <option value="All XP">X-Plane Todos</option>
</select>

</td>
</tr>
<tr>
<td width="50%">Precio: </td>
<td width="50%">$<input type="text" class="form-control" name="price" value="" size="20"></td>
</tr>
<tr>
<td width="50%">Fecha: </td>
<td width="50%"><input type="text" class="form-control" name="date" value="<?php 
$time = time(); 
echo $fecha_actual=date("d F Y (H:i:s)", $time);?>" size="30"></td>
</tr>
<tr>
<td width="100%" colspan="2">
<p align="center"><input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="Agregar Producto" name="B1"></td>
</tr>
</table>
</center>
</div>
</form>




<br>
<br>
<br>
<br>
<h2>Productos Actuales</h2>
<hr>
<br>
<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b>Administrador</b></th>
												<th><b>Producto</b></th>
												<th><b>Imagen</b></th>
												<th><b>Link</b></th>
												<th><b>Tipo</b></th>
												<th><b>Simulador</b></th>
												<th><b>Fecha</b></th>
												<th><b>Precio</b></th>
												<th><b>Compras</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
$sql1 = "select * from productos";  
		
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i = 0;
		$notas = 0;
		while ($row1 = $result1->fetch_assoc()) {
			$i++;
			 echo '<tr>';
			 $claves = $row1['id'];
			 // COMPRAS DE ESE PRODUCTO
			 $sql2 = "select * from compras_tienda where producto_id=$claves";  
			 if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$aa = 0;
		while ($row2 = $result2->fetch_assoc()) {
			$aa++;
		}
		
		
			 
										 echo '<td>+' . $i . '</td>';
										 echo '<td>' . $row1['administrador'] . '</td>';
										  echo '<td>' . $row1['producto'] . '</td>';
										   echo '<td><img src="' . $row1['imagen'] . '" WIDTH=20%></td>';
										   echo '<td><a href="' . $row1["link"] . '">** Link **</a></td>';
										   echo '<td>' . $row1['type'] . '</td>';
										   echo '<td>' . $row1['simulador'] . '</td>';
										   echo '<td>$' . $row1['price'] . '</td>';
										   echo '<td>' . $row1['date'] . '</td>';
										    echo '<td>+' . $aa . '</td>';
										 echo '<td>';
										 echo '<a href="./?page=productoupdate&id=' . $row1["id"] . '">** Actualizar **</a><br>';
										 echo '<a href="./?page=productodelete&id=' . $row1["id"] . '">** Eliminar **</a>';
										 
										 echo '</td>';
										echo '</tr>';
										
									
										
		}
		
		
?>
</tbody>
</table>
<?php 

if ($i==0) {
	
echo '<center><div class="alert alert-danger" role="alert">No hay productos añadidos a la Tienda.</div></center>';
        }
		
	} else
				{
					echo '<div class="alert alert-danger"> You do not have access to Store Administration</div>';
				}
		
		?>



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
