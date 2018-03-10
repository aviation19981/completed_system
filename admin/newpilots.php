 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Pilotos</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de los Nuevos Pilotos de la Aerolínea</div>
                  <div class="row">
                    <div class="col-sm-12">                      
                      									 
<?php 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$sql = "select * from gvausers where activation=0 order by gvauser_id asc ";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
}


?>

  





<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <!-- <th><b>CALLSIGN PARA ASGINAR</b></th> -->
												<th><b>PILOTO</b></th>
												<th><b>OPCIONES</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>

<?php 
$contadoresva=0;

while ($row = $result->fetch_assoc()) { 
if (in_array($row['operator_id'], $airlines)) {
$contadoresva++;


	

										    echo '<tr>';
									    //echo '<td>' . $callsignasignar . '</td>';
										echo '<td>' . $row["name"] . ' ' . $row["surname"] . '</td>';
										
										
										$modulos = '<center><span class="label label-danger"><a href="./?page=eliminarpilot&pilot_id=' . $row["gvauser_id"] . '&pilot_vid=' . $row["ivaovid"] . '">Eliminar</a></span></center>
										<br>
										<center><span class="label label-info"><a href="./?page=agregarnuevopiloto&pilot_id=' . $row["gvauser_id"] . '">Aprobar</a></span></center>'; 
										
										
										
										echo '<td>' . $modulos . '</td>';
										  echo '</tr>';
}								  
										  
  }
  
  
  if($contadoresva==0) {
		
		echo '<tr><td colspan="5"><div class="alert alert-danger">No hay nuevos pilotos por aprobar</div></td></tr>';
		
		
	}
	?>


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
