 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">IVAO Estado</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de Pilotos IVAO de la Aerolínea</div>
				  
                  <div class="row">
                    <div class="col-sm-12">  


			<h2>Información Detalladas</h2>		
			<hr>
			<br>
			



<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
											    <th><b>#</b></th>
											    <th><b>CALLSIGN</b></th>
											    <th width="200px"><b>PILOTO</b></th>
												<th><b>VID</b></th>
												<th><b>ESTADO</b></th>
												<th><b>ÚLTIMO VUELO</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>			
<?php 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 



$sql_uno = "select * from gvausers where operator_id IN (" . implode(',', array_map('intval', $airlines)) . ") and activation<>0 order by callsign asc";
if (!$result_uno = $db->query($sql_uno))  {
	die('There was an error running the query [' . $db->error . ']');
}
$usuario=0;
while ($row_uno = $result_uno->fetch_assoc()) {
	$usuario++;
	$contadores =0;
	    $activationknow = $row_uno["activation"];
	  
	    if($activationknow!=0 && $activationknow!=3 && $activationknow!=4) {
		$gvauser_idshow = $row_uno["gvauser_id"];
		$ivaovidpca = $row_uno["ivaovid"];
		$fecha_envio1 = $row_uno["register_date"];
		$fecha_envio2 = 0;
		$dias_pro 	= 0;
			///////////////////////// Consultamos ultimo vuelo //////////////////////////////////
		
		$sql_dos = "SELECT * FROM cstpireps WHERE vid='$ivaovidpca' order by id desc LIMIT 1";
		
		if (!$result_dos = $db->query($sql_dos))  {
	       die('There was an error running the query [' . $db->error . ']');
        }

        while ($row_dos = $result_dos->fetch_assoc()) {
			
			//////////////////////// Contamos cuando fue el ultimo vuelo /////////////////////
			$contadores++;
			$fecha_envio2 = $row_dos['fecha_envio'];
			
		}
		
		
		    if($contadores==0) {
				$fecha_envio = $fecha_envio1; 
			} else {
				$fecha_envio = $fecha_envio2;
			}
		
			$hoy = date('Y-m-d');
			
             
                	$dias	= (strtotime($fecha_envio)-strtotime($hoy))/86400;
                	$dias_pro 	= abs($dias); 
					$diastotales = floor($dias_pro);		
                	
               
            //////////////////////////////// DIAS OBTENIDOS //////////////////////////////////
           
			
			if($diastotales>=15) {
			
            ///////////////////////////// INACTIVAR CUENTA /////////////////////////
echo '<tr>';
echo '<td>' . $usuario . '</td>';
echo '<td>' . $row_uno["callsign"] . '</td>';
echo '<td>' . $row_uno["name"] . ' ' . $row_uno["surname"] .  '</td>';
echo '<td>' . $row_uno["ivaovid"] . '</td>';
echo '<td><span class="label label-warning">Inacstivo</span></td>';
echo '<td><font color="red">' . $diastotales . '</font></td>';
echo '</tr>';
			
            ///////////////////////////// FIN INACTIVACION /////////////////////////			
			} else {
				
				
				///////////////////////////// ACTIVA CUENTA /////////////////////////

echo '<tr>';
echo '<td>' . $usuario . '</td>';
echo '<td>' . $row_uno["callsign"] . '</td>';
echo '<td>' . $row_uno["name"] . ' ' . $row_uno["surname"] .  '</td>';
echo '<td>' . $row_uno["ivaovid"] . '</td>';
echo '<td><span class="label label-success">Activo</span></td>';
echo '<td><font color="green">' . $diastotales . '</font></td>';
echo '</tr>';
			
            ///////////////////////////// FIN ACTIVA /////////////////////////
				
				
				
			}
			

		
		
		} else {
			
			$gvauser_idshow = $row_uno["gvauser_id"];
		$ivaovidpca = $row_uno["ivaovid"];
		$fecha_envio1 = $row_uno["register_date"];
		$fecha_envio2 = 0;
		$dias_pro 	= 0;
			///////////////////////// Consultamos ultimo vuelo //////////////////////////////////
		
		$sql_dos = "SELECT * FROM cstpireps WHERE vid='$ivaovidpca' order by id desc LIMIT 1";
		
		if (!$result_dos = $db->query($sql_dos))  {
	       die('There was an error running the query [' . $db->error . ']');
        }

        while ($row_dos = $result_dos->fetch_assoc()) {
			
			//////////////////////// Contamos cuando fue el ultimo vuelo /////////////////////
			$contadores++;
			$fecha_envio2 = $row_dos['fecha_envio'];
			
		}
		
		
		    if($contadores==0) {
				$fecha_envio = $fecha_envio1; 
			} else {
				$fecha_envio = $fecha_envio2;
			}
		
			$hoy = date('Y-m-d');
			
             
                	$dias	= (strtotime($fecha_envio)-strtotime($hoy))/86400;
                	$dias_pro 	= abs($dias); 
					$diastotales = floor($dias_pro);		
                	
               
            //////////////////////////////// DIAS OBTENIDOS //////////////////////////////////
           
		
if($activationknow==0) {
	$estados = '<td><span class="label label-info">Nuevo</span></td>';
} if ($activationknow==3) {
	$estados = '<td><span class="label label-danger">Suspendido</span></td>';
} if ($activationknow==4) {	
    $estados = '<td><span class="label label-default">Vacaciones</span></td>';
}	
		
echo '<tr>';
echo '<td>' . $usuario . '</td>';
echo '<td>' . $row_uno["callsign"] . '</td>';
echo '<td>' . $row_uno["name"] . ' ' . $row_uno["surname"] .  '</td>';
echo '<td>' . $row_uno["ivaovid"] . '</td>';
echo $estados;
echo '<td>' . $diastotales . '</td>';
echo '</tr>';		
			
			
			
		}
		
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
