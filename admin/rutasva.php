 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Rutas de la Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las Vuelos de la Aerolínea</div>
				  <p class="m-b-lg text-muted">Nuestra cobertura de rutas es de <?php echo $cstpirepse; ?> vuelo(s).</p>
				  
                  <div class="row">
                    <div class="col-sm-12">  


			<h2>Opciones Busqueda</h2>		
			<hr>
			<br>
					
					<div class="col-lg-12 col-sm-12 ">
                <div class="panel-group accordion" id="accordion1">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1">
                                    <i class="switch fa fa-plus"></i> Buscar Vuelo por Callsign </a>
								 </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
							<div class="accordion-inner">

								<h2>Buscar Vuelo</h2>
<hr>
<form action="./?page=buscarvuelo" method="post" >
  <input type="text" class="form-control" name="callsign" placeholder="Colocar Callsign"><br><br>
  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Buscar">
</form>	
			
											</div></div>
                        </div>
                    </div>
                    
                </div>
            </div>


			
			
			
			
			<div class="col-lg-12 col-sm-12 ">
                <div class="panel-group accordion" id="accordion2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                                    <i class="switch fa fa-plus"></i> Buscar Vuelos por Origen </a>
								 </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
							<div class="accordion-inner">

								<h2>Buscar Vuelos</h2>
<hr>
<form action="./?page=buscarvuelodep" method="post" >
  <input type="text" class="form-control" name="departure"  maxlength="4" placeholder="ICAO Aeropuerto"><br><br>
  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Buscar">
</form>	
			
											</div></div>
                        </div>
                    </div>
                    
                </div>
            </div>




			
			
			<div class="col-lg-12 col-sm-12 ">
                <div class="panel-group accordion" id="accordion3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#collapse3">
                                    <i class="switch fa fa-plus"></i> Buscar Vuelos por Destino </a>
								 </h4>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
							<div class="accordion-inner">

								<h2>Buscar Vuelos</h2>
<hr>
<form action="./?page=buscarvueloarr" method="post" >
  <input type="text" class="form-control" name="arrival" maxlength="4" placeholder="ICAO Aeropuerto"><br><br>
  <input type="submit" class="btn btn-primary btn-lg btn-block" value="Buscar">
</form>	
			
											</div></div>
                        </div>
                    </div>
                    
                </div>
            </div>






					
	<br>
	<hr>

<br>					
                      		
<h2>Añadir Vuelo</h2>
<hr>
<a href="./?page=addrutava" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Actualizar Distancia</h2>
<hr>
<a href="./?page=distanceupdate" class="btn btn-primary btn-lg btn-block" width="100%">Actualizar</a>			

<br>
<br>
<h2>Vuelos Actuales</h2>
<hr>	
							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	

?>







<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th width="50px"><b>AEROLÍNEA</b></th>
												<th><b>CALLSIGN</b></th>
												<th><b>ORIGEN</b></th>
												<th><b>DESTINO</b></th>
												<th><b>ETD</b></th>
												<th><b>ETA</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php

	//Limito la busqueda
        $pagina = false;
		
//Limito la busqueda
$TAMANO_PAGINA = 20;

//examino la página a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}


	


//calculo el total de páginas
$total_paginas = ceil($cstpirepse / $TAMANO_PAGINA);



//Si hay registros
if ($cstpirepse > 0) {
	
	$sql = " select * from routes where  operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") order by route_id asc LIMIT ".$inicio."," . $TAMANO_PAGINA;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	
	
	
	

	
	
	
	
	
	
	
	  $sql_operator = "SELECT * FROM operators ORDER BY operator_id ASC";
							if (!$result_operator = $db->query($sql_operator)) {
							die('There was an error running the query  [' . $db->error . ']');
							}
							
							while ($row_operator = $result_operator->fetch_assoc()) {
							
							if($row_operator["operator_id"] == $row["operator_id"]) {
							
							
							$img = $row_operator["file"];
							
							}
							
							}
							
	echo '<tr>';
	
		echo '<td><img src="./images/operators/' . $img . '" width="100%"></td>';
		echo '<td>' . $row["flight"] . '</td>';
		echo '<td>' . $row["departure"] . '</td>';
		echo '<td>' . $row["arrival"] . '</td>';
		echo '<td>' . $row["etd"] . '</td>';
		echo '<td>' . $row["eta"] . '</td>';
		echo '<td><a href="./?page=eliminarvuelova&vuelo=' . $row["route_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updatevuelova&vuelo=' . $row["route_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
echo '</tr>';
						 
						 
						 
} ?>


 </tbody>
                                    </table>

 <center>                              
<?php

	
	if ($total_paginas > 1) {
   if ($pagina != 1)
      echo '<a href="?page=rutasva&pagina='.($pagina-1).'"><img src="images/izq.gif" border="0"></a>';
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i) {
            //si muestro el índice de la página actual, no coloco enlace
         echo $pagina;
         }   else {
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '  <a href="?page=rutasva&pagina='.$i.'">'.$i.'</a>  ';
			}
      }
      if ($pagina != $total_paginas)
         echo '<a href="?page=rutasva&pagina='.($pagina+1).'"><img src="images/der.gif" border="0"></a>';
}

}
?>
</center>



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
