 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Código HTML</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información relevante para las aerolíneas virtuales dentro de la alianza</div>
                  <p class="m-b-lg text-muted">Sólo necesitas pegar el código HTML en tu sitio web!<br><b>Detalles:</b><br><?php echo $airlines_allowed_staff; ?></p>
                  <div class="row">
                    <div class="col-sm-12">                      
                      									 
<?php 
include('db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); $db->set_charset("utf8"); if ($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_error . ']');
} 



$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "http://" . $host;

		
		$sql_airlines_allow_code = "SELECT * from operators";
	if (!$result_airlines_allow_code = $db->query($sql_airlines_allow_code)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_airlines_allow_code = $result_airlines_allow_code->fetch_assoc()) {
			
			if (in_array($row_airlines_allow_code['operator_id'], $airlines)) {
               $airlines_allowed_staff_code = $row_airlines_allow_code['operator'];
			   
			   ?>
			   <h1>Detalles para: <?php echo  $airlines_allowed_staff_code; ?></h1>
			   <hr>
			   
			   
			   
			   
			   

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Uso</b></th>
												<th><b>Código HTML</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 <tr>
										 <td>Mostrar los pilotos de la aerolínea <b><?php echo  $airlines_allowed_staff_code; ?></b></td>
										 <td>&lt;iframe src=&quot;<?php echo $web; ?>/code/pilots.php?va=<?php echo $row_airlines_allow_code['operator_id']; ?>&quot;; width=&quot;100%&quot; height=&quot;300px&quot;&gt;&lt;/iframe&gt;</td>
										 </tr>
										 <tr>
										 <td>Mostrar el mapa de rutas de la aerolínea <b><?php echo  $airlines_allowed_staff_code; ?></b></td>
										 <td>&lt;iframe src=&quot;<?php echo $web; ?>/code/mapglobal.php?va=<?php echo $row_airlines_allow_code['operator_id']; ?>&quot;; width=&quot;100%&quot; height=&quot;300px&quot;&gt;&lt;/iframe&gt;</td>
										 </tr>
										 <tr>
										 <td>Mostrar las finanzas de la aerolínea <b><?php echo  $airlines_allowed_staff_code; ?></b></td>
										 <td>&lt;iframe src=&quot;<?php echo $web; ?>/code/finances.php?va=<?php echo $row_airlines_allow_code['operator_id']; ?>&quot;; width=&quot;100%&quot; height=&quot;300px&quot;&gt;&lt;/iframe&gt;</td>
										 </tr>
										 <tr>
										 <td>Mostrar la flota de la aerolínea <b><?php echo  $airlines_allowed_staff_code; ?></b></td>
										 <td>&lt;iframe src=&quot;<?php echo $web; ?>/code/fleet.php?va=<?php echo $row_airlines_allow_code['operator_id']; ?>&quot;; width=&quot;100%&quot; height=&quot;300px&quot;&gt;&lt;/iframe&gt;</td>
										 </tr>
										 <tr>
										 <td>Mostrar las estadísticas de la aerolínea <b><?php echo  $airlines_allowed_staff_code; ?></b></td>
										 <td>&lt;iframe src=&quot;<?php echo $web; ?>/code/stats.php?va=<?php echo $row_airlines_allow_code['operator_id']; ?>&quot;; width=&quot;100%&quot; height=&quot;300px&quot;&gt;&lt;/iframe&gt;</td>
										 </tr>
										 </tbody>
                                    </table>
			   
			   
			   
			   <?php
            }
			
			
			
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
