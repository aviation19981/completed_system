							
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$contadores=0;

	$sql5 = "select * from events";
	if (!$result5 = $db->query($sql5)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row5 = $result5->fetch_assoc()) {
	$contadores++;
}
	

?>
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Eventos de la Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Eventos</div>
				  <p class="m-b-lg text-muted">Nuestra cobertura de eventos es de <?php echo $contadores; ?>.</p>
				  
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Evento</h2>
<hr>
<a href="./?page=addevento" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Eventos Actuales</h2>
<hr>	








<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th><b>FECHA PUBLICACIÓN</b></th>
												<th><b>EVENTO NOMBRE</b></th>
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
$total_paginas = ceil($contadores / $TAMANO_PAGINA);



//Si hay registros
if ($contadores > 0) {
	
	$sql = " select * from events order by event_id asc LIMIT ".$inicio."," . $TAMANO_PAGINA;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	
	
	
							
	echo '<tr>';
	
		echo '<td>' . $row["publish_date"] . '</td>';
		echo '<td>' . $row["event_name"] . '</td>';
		echo '<td><a href="./?page=eliminareventova&evento=' . $row["event_id"] . '" class="btn btn-md btn-danger">Eliminar</a><br><br>
						<a href="./?page=updateeventova&evento=' . $row["event_id"] . '" class="btn btn-md btn-warning">Editar</a> </td>';
echo '</tr>';
						 
						 }?>


 </tbody>
                                    </table>

 <center>                              
<?php

	
	if ($total_paginas > 1) {
   if ($pagina != 1)
      echo '<a href="?page=eventosva&pagina='.($pagina-1).'"><img src="images/izq.gif" border="0"></a>';
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i) {
            //si muestro el índice de la página actual, no coloco enlace
         echo $pagina;
         }   else {
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '  <a href="?page=eventosva&pagina='.$i.'">'.$i.'</a>  ';
			}
      }
      if ($pagina != $total_paginas)
         echo '<a href="?page=eventosva&pagina='.($pagina+1).'"><img src="images/der.gif" border="0"></a>';
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
