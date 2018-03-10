<?php
session_start();
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "https://" . $host;

	
    if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['language'] = "es";
	}
	
		
	
	
    include("./../main/languages/lang_" . $_SESSION['language'] . ".php");
	
	$aerolinea_id = $_GET['va']; ?>

<!doctype html>
<html lang="en">
  <head>
    <title>ColStar Alliance</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../../main/images/favicon.ico" type="image/x-icon" rel="icon" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>

        	<div class="clear"></div>  
		  
	
            <section class="switchable feature-large">
                <div class="container">
                    
					
					
					
		             									 
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
		$sql_airlines_allow = "SELECT * from operators where operator_id='$aerolinea_id'";
	if (!$result_airlines_allow = $db->query($sql_airlines_allow)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_airlines_allow = $result_airlines_allow->fetch_assoc()) {
			$operator_id_rank = $row_airlines_allow['operator_id'];
			
		$contar=0;	
				$sql = "select * from gvausers where operator_id='$operator_id_rank' order by callsign asc";
 if (!$result = $db->query($sql))  {
	die('There was an error running the query [' . $db->error . ']');
}


				
			   ?>
			   
			   
			
		
		
		
<h2><?php echo INFO_PILOTS_CST; ?> :: <?php echo $row_airlines_allow['operator'] ; ?></h2>
<h3>Información Obtenida de ColStar Alliance | Information by ColStar Alliance</h3>
<hr>




				

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>Callsign</b></th>
												<th><b><?php echo NAME; ?></b></th>
												<th><b><?php echo RANK; ?></b></th>
												<th><b><?php echo LOCATION; ?></b></th>
												<th><b><?php echo TIME_CST_HR; ?></b></th>
												<th><b>IVAO</b></th>
												<th><b><?php echo STATUS; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
										 
<?php while ($row = $result->fetch_assoc()) { 
	$contar++;
	$locationas = $row["location"];

$sql6 = "SELECT * FROM airports  where ident='$locationas' ";

	if (!$result6 = $db->query($sql6)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6 = $result6->fetch_assoc()) {

		$location_airport_namesssls = $row6['name'];

		$location_airport_flagsssls = $row6['iso_country'];

	}
	
	$vidusuario = $row["gvauser_id"];
	$horasvuelo= 0;
	
	$sql_pcas = "select * from cstpireps where gvauser_id=$vidusuario"; 
if (!$result_pcas = $db->query($sql_pcas)) {
	die('There was an error running the query [' . $db->error . ']');
}

while ($row_pcas = $result_pcas->fetch_assoc()) {
	$horasvuelo=$horasvuelo+$row_pcas["connection_time"];
	}
	

										    echo '<tr>';
											
										echo '<td><a href="../../main/index.php?page=pilot_details&pilot_id=' . $row["gvauser_id"] . '" target="_blank">' . $row["callsign"] . '</a></td>';
										//echo '<td><a href=' . $row["callsign"] . '</td>';
										echo '<td>' . $row["name"] . ' ' . $row["surname"] . '</td>';
										
										echo '<td>';
										$imgrank = '';
										 $namerank ='';
										if (strlen($row["rank_id"]) <> 0) {
											
											$ranks_ides = $row["rank_id"];
											
											$sql6s = "select rank,salary_hour,img from ranks where rank_id='$ranks_ides'";

	if (!$result6s = $db->query($sql6s)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


	

	while ($row6s = $result6s->fetch_assoc()) {

		$imgrank = $row6s['img'];
        $namerank = $row6s['rank'];

	}
	
	
							echo '<img src="../admin/images/ranks/' . $imgrank . '" WIDTH=20%>' . ' ';
						}
						
										echo $namerank . '</td>';
										
										
										echo '<td>';
										
										echo $row["location"] . ' ';


echo '<img src="../../main/images/flags/24/' . $location_airport_flagsssls . '.png" alt="' . $location_airport_flagsssls . '">';

                                                                        echo '<br>';
						                         echo '<font size="2">&nbsp;'. $location_airport_namesssls .'</font>';
												 
												 
										echo '</td>';
										
										
										$sumas= $horasvuelo + $row["transfered_hours"];
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';


										echo '<td>' . $total . '</td>';
										
										
								
                                        $datos = '<a href="https://www.ivao.aero/Login.aspx?r=Member.aspx?Id=' . $row["ivaovid"] . '" target="_blank"><img src="http://status.ivao.aero/' . $row["ivaovid"] . '.png" align="middle"/></a><br><center>VID: <b>' . $row["ivaovid"] . '</b></center>';
						
						
						
										echo '<td>' . $datos . '</td>';
										
										
										
										if ($row["activation"] == 1)  { 
										
										$modulos = '<div class="alert bg--success">
                                                     <div class="alert__body ">
                                                       <span>' . USER_ACTIVE . '</span>
                                                     </div>
                                                  </div>';
												  
										} else if ($row["activation"] == 2)  { 
											
											
										$modulos = '<div class="alert">
                                                     <div class="alert__body">
                                                       <span>' . USER_INACTIVE . '</span>
                                                     </div>
                                                  </div>';
												  
										
										} else if ($row["activation"] == 3)  { 
										$modulos = '<div class="alert bg--error">
                                                     <div class="alert__body ">
                                                       <span>' . USER_SUSPENDED . '</span>
                                                     </div>
                                                  </div>';
										
										} else if ($row["activation"] == 4)  { 
											
										$modulos = '<div class="alert bg--primary">
                                                     <div class="alert__body">
                                                       <span>' . ON_VACATION . '</span>
                                                     </div>
                                                  </div>';
										
										}
										
										echo '<td>' . $modulos . '</td>';
										
										  echo '</tr>';
										  
										  
 } 
 
 if ($contar==0){
echo '<tr><td colspan="7">';
 echo '<div class="alert bg--error">
                                                     <div class="alert__body">
                                                       <span>No hay pilotos | There are not pilots</span>
                                                     </div></div>';
 echo '</tr></td>';                                                

 } 
 ?>

 </tbody>
                                    </table>
									

		
		

			   
			
			
			<?php
            }
			
			
			
	
	
?>
			
					
					
					
	
									
									
					
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
			<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>