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
    <link href="./../main/images/favicon.ico" type="image/x-icon" rel="icon" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- New
	================================================== -->
	
	
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script src="./../main/Charts/Chart.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="./../main/css/bootstrap-datetimepicker.min.css"/>
	<script src="./../main/js/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="./../main/js/moment-with-locales.js"></script>
	<script type="text/javascript" src="./../main/js/bootstrap-datetimepicker.min.js"></script>
	<script src="./../main/js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="./../main/css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/numeric-comma.js"></script>
	<script src="./../main/js/raphael.min.js" type="text/javascript"></script>
	<script src="./../main/js/morris.min.js" type="text/javascript"></script>



 </head>
  <body>
 <div class="container">
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Información de las finanzas de la aerolínea</div>
           
    
     	<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
       
    	<?php 
			include('./../main/languages/lang_es.php');
				include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
	
	
					// select current day
	$sql = " select day(now()) as 'current_day', month(now()) as 'current_month',year(now()) as 'current_year' ; ";
	$current_day;
	$current_month;
	$current_year;
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$current_day = $row['current_day'];
		$current_month = $row['current_month'];
		$current_year = $row['current_year'];
	}
	
	
			// Calculation for flights per month current year
	$count_per_month = '';
	for ($i = 1 ; $i <= 12 ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(ROUND(sum(amount),0),0) as co from va_finances where date_format(finance_date,'%y')=date_format(now(),'%y') and date_format(finance_date,'%m')=$i and operator_id='$aerolinea_id'";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$meses = array('',MES_EN,MES_FE,MES_MA,MES_AB,MES_MAY,MES_JUN,MES_JUL,MES_AG,MES_SP,MES_OC,MES_NO,MES_DI);


		while ($row2 = $result2->fetch_assoc()) {
		
		    if($i<12) {
				$count_per_month = $count_per_month . "{ mes: '" . $meses[$i] . "', balance: ". $row2['co'] ." },";
			} else  {
				$count_per_month = $count_per_month . "{ mes: '" . $meses[$i] . "', balance: ". $row2['co'] ." }";
			}
			
		}
	}
	
	
	
	
	?>
	

		<div class="tab__title text-center">
				<span class="h2"><i class="icon icon--sm block icon-Money"></i>
				<?php echo ONE_ECONOMY_DETAILS; ?> <?php echo date('Y'); ?></span>
			</div>
	    <hr>
		<div id="flights_per_month" style="width:100%"></div>
				
		
		<script>
					  var flights_per_month= Morris.Line({
					  element: 'flights_per_month',
					  data: [<?php echo $count_per_month;?>],
					  
					  
			
			
					  xkey: 'mes',
					  ykeys: ['balance'],
					  labels: ['balance'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_month.redraw();
				    });
				</script>
	
	      <br>
		  <br>
		  <br>
		  <br>
		  <br>
		  <br>
		  <div class="tab__title text-center">
				<span class="h2"><i class="icon icon--sm block icon-Eye"></i>
				<?php echo TWO_ECONOMY_DETAILS; ?> <?php echo date('Y'); ?></span>
			</div>
		  <hr>
		  <br>
		  <?php

	// Execute SQL query
	$total_amount=0;
	$sql = "select sum(amount) as total_amount from va_finances where operator_id='$aerolinea_id'";

	if (!$result9 = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	while ($row = $result9->fetch_assoc()) {
		$total_amount=$row['total_amount'];
	}

	$sql = "SELECT parameter_id,financial_parameter,sum(vaf.amount) as vaf_amount FROM  va_finances vaf inner join financial_parameters fp on vaf.parameter_id = fp.id where is_cost=1 and operator_id='$aerolinea_id' group by parameter_id,financial_parameter ";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT parameter_id,financial_parameter,sum(vaf.amount) as vaf_amount FROM  va_finances vaf inner join financial_parameters fp on vaf.parameter_id = fp.id where is_profit=1  and operator_id='$aerolinea_id' group by parameter_id,financial_parameter";
	if (!$result2= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT 'Cargo in regular routes' as des,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99998)  and vaf.operator_id='$aerolinea_id' group by parameter_id";
	if (!$result3= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT 'PAX in regular routes' as des,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99999) and vaf.operator_id='$aerolinea_id' group by parameter_id";
	if (!$result4= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT description,vaf.amount as vaf_amount FROM  va_finances vaf  where vaf.parameter_id =0 and report_type='New Aircraft' and vaf.operator_id='$aerolinea_id'";
	if (!$result5= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	$sql = "SELECT 'Pilots Flight Salary' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99995) and vaf.operator_id='$aerolinea_id' group by parameter_id";
	if (!$result6= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	$sql = "SELECT 'Aircraft Maintenance' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99997) and vaf.operator_id='$aerolinea_id' group by parameter_id";
	if (!$result7= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	$sql = "SELECT 'Aircraft Repair' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99996)  and vaf.operator_id='$aerolinea_id' group by parameter_id";
	if (!$result8= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	
	$sql = "SELECT * FROM  gvausers gva inner join user_types ustypes on gva.user_type_id=ustypes.user_type_id";
	if (!$result9= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	



				?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg border--round"  style="width:100%">
  <tr>
    <th class="tg-baqh" colspan="3"><h1>Col<b>Star</b> Alliance</h1><br></th>
  </tr>
  <tr>
    <td class="tg-baqh" colspan="3"><h2><?php echo FINANCE_DETAIL; ?></h2></td>
  </tr>
  <tr>
    <td class="tg-baqh" colspan="3"><h3><?php echo FINANCE_DETAIL_FORM; ?> <?php echo date("F j, Y, g:i a");  ?></h3></td>
  </tr>
  <tr>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_MEANING; ?></b></td>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_VALUE; ?></b></td>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_PERCENTAGE; ?></b></td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_ASSETS_WEAK; ?></td>
    <td class="tg-yw4l">
	<?php          
	                $ingresosoperacionesventabrutos =0;
	                while ($row = $result3->fetch_assoc()) {
						$ingresosoperacionesventabrutos = $ingresosoperacionesventabrutos+$row['vaf_amount'];
					} 
					while ($row = $result4->fetch_assoc()) {
						
						$ingresosoperacionesventabrutos = $ingresosoperacionesventabrutos+$row['vaf_amount'];
					}
					echo '$' . number_format(round($ingresosoperacionesventabrutos,2),0,',','.');
					
					?>
	</td>
    <td class="tg-yw4l">100%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_DEVOLUTION; ?></td>
    <td class="tg-yw4l">( $0 )</td>
    <td class="tg-yw4l">0%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_ASSETS_FULL; ?></td>
    <td class="tg-yw4l"><?php  echo '$' . number_format(round($ingresosoperacionesventabrutos,2),0,',','.'); ?></td>
    <td class="tg-yw4l">100%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_COST_OF_SALING; ?></td>
    <td class="tg-yw4l">(
	<?php          
	                $costoventa =0;
	                while ($row = $result->fetch_assoc()) {
						$costoventa = $costoventa+$row['vaf_amount'];
					} 
					echo '$' . number_format(round(-1*$costoventa,2),0,',','.');
					
					$porcentaje = (-1*$costoventa*100)/$ingresosoperacionesventabrutos;
					?>
					)</td>
    <td class="tg-yw4l"><?php echo round($porcentaje,3); ?>%</td>
  </tr>
  <?php $utilidadbruta = $ingresosoperacionesventabrutos+$costoventa; ?>
  <tr>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_RESULT_WEAK; ?></b></td>
    <td class="tg-yw4l">$<?php echo number_format(round($utilidadbruta,2),0,',','.'); ?> </td>
    <td class="tg-yw4l"><?php $porcentaje2 = ($utilidadbruta*100)/$ingresosoperacionesventabrutos; ?><?php echo round($porcentaje2,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_OUTPUT_ADMIN; ?></td>
	 <td class="tg-yw4l">( <?php 
	
	$goa = 0;
					while ($row = $result5->fetch_assoc()) {
						$goa = $goa + $row['vaf_amount'];
					}
					
					
					while ($row = $result7->fetch_assoc()) {
						$goa = $goa + $row['vaf_amount'];
					}	
	
	
	
					$porcentaje3 = (-1*$goa*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($goa*-1,2),0,',','.');
					?> )</td>
    <td class="tg-yw4l"><?php echo round($porcentaje3,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_OUTPUT_SALES; ?></td>
	<td class="tg-yw4l">( <?php 
	
	                $gov = 0;
					
					 
					while ($row = $result6->fetch_assoc()) {
						$gov = $gov + $row['vaf_amount'];
					}	
					 
					 
					while ($row = $result8->fetch_assoc()) {
						$gov = $gov + $row['vaf_amount'];
					}	
	
	
	
	
	
					$porcentaje4 = (-1*$gov*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($gov*-1,2),0,',','.');
					?> )</td>
    <td class="tg-yw4l"><?php echo round($porcentaje4,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_RESULT_OPERATIONAL; ?></b></td>
    <td class="tg-yw4l"><?php $utilidadoperativa = $utilidadbruta+$goa+$gov; $porcentaje5 = ($utilidadoperativa*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($utilidadoperativa,2),0,',','.'); ?></td>
    <td class="tg-yw4l"><?php echo round($porcentaje5,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_NO_OPERATIONAL_ASSET; ?></td>
    <td class="tg-yw4l"><?php 
	$ingresosnooperacionales = 0;
	while ($row = $result2->fetch_assoc()) {
		     $ingresosnooperacionales=$ingresosnooperacionales+$row['vaf_amount'];
					} 
					$porcentaje6 = ($ingresosnooperacionales*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($ingresosnooperacionales,2),0,',','.');
					?></td>
    <td class="tg-yw4l"><?php echo round($porcentaje6,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_OUTPUT_NO_OP; ?></td>
    <td class="tg-yw4l"><?php $gastosnooperacionales = 0; $porcentaje7 = ($gastosnooperacionales*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($gastosnooperacionales,2),0,',','.'); ?></td>
    <td class="tg-yw4l"><?php echo round($porcentaje7,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_RESULT_PREVIOUS_TAXES; ?></b></td>
    <td class="tg-yw4l"><?php $utilidadantesimpuestos = $utilidadoperativa+$ingresosnooperacionales-$gastosnooperacionales;
	$porcentaje8 = ($utilidadantesimpuestos*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($utilidadantesimpuestos,2),0,',','.');
					?>
	</td>
    <td class="tg-yw4l"><?php echo round($porcentaje8,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><?php echo FINANCE_DETAIL_TAXES_EXPECTATION; ?></td>
    <td class="tg-yw4l">( <?php $provisionimpuestos = $utilidadantesimpuestos*0.25; 
	$porcentaje9 = ($provisionimpuestos*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($provisionimpuestos,2),0,',','.'); ?> )</td>
    <td class="tg-yw4l"><?php echo round($porcentaje9,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l"><b><?php echo FINANCE_DETAIL_FULL_RESULT; ?></b></td>
    <td class="tg-yw4l"><?php $resultadoejercicio = $utilidadantesimpuestos- $provisionimpuestos;
	$porcentaje10 = ($resultadoejercicio*100)/$ingresosoperacionesventabrutos; echo '$' . number_format(round($resultadoejercicio,2),0,',','.'); ?>
	</td>
    <td class="tg-yw4l"><?php echo round($porcentaje10,3); ?>%</td>
  </tr>
  <tr>
    <td class="tg-yw4l" colspan="3"></td>
  </tr>
  <tr>
    <td class="tg-yw4l"><b>Andrés Zapata</b><br><em><?php echo FINANCE_DETAIL_PRESIDENT; ?> - Alianza</em></td>
    <td class="tg-yw4l" colspan="2"><b>Cristian Zapata</b><br><em><?php echo FINANCE_DETAIL_CONTABILITY; ?></em></td>
  </tr>
</table>


			
			
			
			
			
			
  </div>
                  
                  </div>
                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
		</div>
   


		
			<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>


