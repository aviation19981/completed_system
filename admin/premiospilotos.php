
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Premios de la Aerolínea</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Premios</div>
				  
                  <div class="row">
                    <div class="col-sm-12">                      
                      		
<h2>Añadir Premio</h2>
<hr>
<a href="./?page=addpremiosva" class="btn btn-primary btn-lg btn-block" width="100%">Agregar</a>			

<br>
<br>
<h2>Premio Actuales</h2>
<hr>	








<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th><b>PREMIO</b></th>
												<th><b>IMAGEN</b></th>
												<th><b>DESCRIPCIÓN</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php


	
	$sql = "select * FROM awards";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
while ($row = $result->fetch_assoc()) {
	
	
	
							
	echo '<tr>';
	
		echo '<td>' . $row["award_name"] . '</td>';
		echo '<td><img src="./images/premios/' . $row["award_image"] . '" width="150px" height="80px"/></td>';
		echo '<td>' . $row["descripcion"] . '</td>';
		echo '<td><a href="./?page=eliminarpremiova&premio=' . $row["award_id"] . '" class="btn btn-md btn-danger">Eliminar</a></td>';
echo '</tr>';
						 
						 }?>


 </tbody>
                                    </table>




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
