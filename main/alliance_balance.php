
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo MONEY_STATISTISC; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_MONEY_STATISTISC; ?></font></h3>
	

</section>





	<section class="contact" id="contact">
			<div class="container">
			<h1><b><?php echo ECONOMY_DETAILS; ?></b></h1>
			<br>
			<br>
			<?php 
			
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
		$sql2 = "select IFNULL(ROUND(sum(amount),0),0) as co from va_finances where date_format(finance_date,'%y')=date_format(now(),'%y') and date_format(finance_date,'%m')=$i";
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
	$sql = "select sum(amount) as total_amount from va_finances";

	if (!$result9 = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	while ($row = $result9->fetch_assoc()) {
		$total_amount=$row['total_amount'];
	}

	$sql = "SELECT parameter_id,financial_parameter,sum(vaf.amount) as vaf_amount FROM  va_finances vaf inner join financial_parameters fp on vaf.parameter_id = fp.id where is_cost=1 group by parameter_id,financial_parameter";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT parameter_id,financial_parameter,sum(vaf.amount) as vaf_amount FROM  va_finances vaf inner join financial_parameters fp on vaf.parameter_id = fp.id where is_profit=1 group by parameter_id,financial_parameter";
	if (!$result2= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT 'Cargo in regular routes' as des,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99998) group by parameter_id";
	if (!$result3= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT 'PAX in regular routes' as des,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99999) group by parameter_id";
	if (!$result4= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}

	$sql = "SELECT description,vaf.amount as vaf_amount FROM  va_finances vaf  where vaf.parameter_id =0 and report_type='New Aircraft'";
	if (!$result5= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	$sql = "SELECT 'Pilots Flight Salary' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99995) group by parameter_id";
	if (!$result6= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}	
	$sql = "SELECT 'Aircraft Maintenance' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99997) group by parameter_id";
	if (!$result7= $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	$sql = "SELECT 'Aircraft Repair' as description,sum(vaf.amount) as vaf_amount FROM  va_finances vaf  where vaf.parameter_id in (99996) group by parameter_id";
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
    <td class="tg-yw4l"><b>Andrés Zapata</b><br><em><?php echo FINANCE_DETAIL_PRESIDENT; ?></em></td>
    <td class="tg-yw4l" colspan="2"><b>Cristian Zapata</b><br><em><?php echo FINANCE_DETAIL_CONTABILITY; ?></em></td>
  </tr>
</table>

	
			
	

</section>
