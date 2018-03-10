<?php
include('./get_va_data.php');
include ('./db_login.php');
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
		$sql2 = "select IFNULL(count(id),0) as co from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%m')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
			$meses = array('',MES_EN,MES_FE,MES_MA,MES_AB,MES_MAY,MES_JUN,MES_JUL,MES_AG,MES_SP,MES_OC,MES_NO,MES_DI);
			
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_month = $count_per_month . "{ Mes: '" . $meses[$i] . "', Vuelos: ". $row2['co'] ." },";
		}
	}
	
	$diasmes= date("d",mktime(0,0,0,$current_month+1,0,$current_year));
	// Calculation for flights per day current month
	$count_per_day = '';
	for ($i = 1 ; $i <= $diasmes ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(count(id),0) as co from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%m')=date_format(now(),'%m') and date_format(fecha_envio,'%d')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
		
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_day = $count_per_day . "{ day: '".$i."', flights: ".$row2['co']." },";
		}
	}
	
	

	
	
	
// Calculate % by flight duration
	$duration_perc='';
	$duration_array = array();
	$duration_cnt = 0;
	$duration_graph ='';
	$sql = "select connectiontime , SUM(cn) as cnt from (
select '0-1' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))<=1
union
select '1-2' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>1 and ABS(abs(connection_time))<=2
union
select '2-3' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>2 and ABS(abs(connection_time))<=3
union
select '3-4' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>3 and ABS(abs(connection_time))<=4
union
select '4-5' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>4 and ABS(abs(connection_time))<=5
union
select '5-6' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>5 and ABS(abs(connection_time))<=6
union
select '6-7' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>6 and ABS(abs(connection_time))<=7
union
select '7-8' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>7 and ABS(abs(connection_time))<=8
union
select '8-9' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>8 and ABS(abs(connection_time))<=9
union
select '>9' as connectiontime , COUNT(*) as cn from cstpireps where LENGTH((connection_time))>0 and date_format(fecha_envio,'%y')=date_format(now(),'%y') and ABS(abs(connection_time))>9) as t group by connectiontime";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$duration_array[$row["connectiontime"]] = $row["cnt"];
		$duration_cnt +=  $row["cnt"];
	}
	if ($duration_cnt>0)
	{
		foreach($duration_array as $key => $value)
		{
			$val = number_format((100 * $value)/$duration_cnt,2);
			if ($val>0)
			{
				$duration_graph = $duration_graph. '{label: "'.$key.' h", value: '.$val.'},';
			}
		}
	}
	
	
	if($duration_cnt==0) {
	  $duration_graph = $duration_graph . '{label: "No flights", value: 0 },';
	}
	
	
 
  $perplanebypca=0;
 // Calculate aircraft used by the pilot
	$perc_aircarft_type_used='';
	$aircarft_type_used_array = array();
	$aircarft_type_used_cnt = 0;
	$sql = "select aircraft , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and LENGTH(aircraft)>0 group by aircraft";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$aircarft_type_used_array[$row["aircraft"]] = $row["cn"];
		$aircarft_type_used_cnt +=  $row["cn"];
	}
	foreach($aircarft_type_used_array as $key => $value)
	{   $perplanebypca++;
		$val = number_format((100 * $value)/$aircarft_type_used_cnt,2);
		$perc_aircarft_type_used = $perc_aircarft_type_used. '{label: "'.$key.'", value: '.$val.'},';
	}
	
	
	if($perplanebypca==0) {
	  $perc_aircarft_type_used = $perc_aircarft_type_used . '{label: "No flights", value: 0 },';
	}
	
	$perplane=0;
		//Calculation  per plane type
	$sql = "select count(*) as c, vp.aircraft as plane_icao from cstpireps vp where date_format(fecha_envio,'%y')=date_format(now(),'%y') and  LENGTH(aircraft)>0 group by vp.aircraft order by plane_icao asc";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$perplane++;
		$countpanepertype = $countpanepertype . '{label: "'.$row['plane_icao'] .'", value: '.$percplanetype.'},';
	}
	
	if($perplane==0) {
	  $countpanepertype = $countpanepertype . '{label: "No flights", value: 0 },';
	}
	
	
	$paises=0;
	// Country  stats
	$sql = "select SUM(c) as c, short_name from
(select count(*) as c, short_name
			from cstpireps vp, airports a , country_t c
			where date_format(fecha_envio,'%y')=date_format(now(),'%y') and c.`iso2`=a.`iso_country`  and  vp.departure=a.ident group by short_name) as t group by short_name;";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$totalcountry=0;
	$country='';
	$perccountry='';
	$countcountry='';
	while ($row = $result->fetch_assoc()) {
		$totalcountry += $row['c'];
	}
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
		$paises++;
		$country = $country . ',"' . $row['short_name'] . '"';
		$perccountry = round(($row['c'] * 100) / $totalcountry , 2);
		$countcountry = $countcountry . '{label: "'.$row['short_name'] .'", value: '.$perccountry.'},';
	}
	
	
	if($paises==0) {
		
		$countcountry = $countcountry . '{label: "No flights", value: 0 },';
		
	}
	
	
	
	
	
	
	// Calculation global % Charter VS Regular
	$totalflights = $num_pireps;
	$totalregularflights = $num_pireps-$charterspireps-$tourspirepsfull-$ivaopirepsfull;
	$totalcharterflights = $charterspireps;
	$totaltourflights = $tourspirepsfull;
	$totalivaoflights = $ivaopirepsfull;
	if ($totalflights == 0) {
		$percregularflights = 0;
		$perccharterflights = 0;
		$perctourflights = 0;
		$percivaototaltourflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
		$perccharterflights = round(($totalcharterflights * 100) / $totalflights , 2);
		$perctourflights = round(($totaltourflights * 100) / $totalflights , 2);
		$percivaototaltourflights = round(($totalivaoflights * 100) / $totalflights , 2);
	}
	$perc_charter_reg = '';
	$perccharterflights_pilot=0;
	if ($percregularflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Regular", value: '.$percregularflights.'},';
	}
	if ($perccharterflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "Charter", value: '.$perccharterflights.'},';
	}
	if ($perctourflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "ColStar Tour", value: '.$perctourflights.'},';
	}
	if ($percivaototaltourflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "IVAO Tour", value: '.$percivaototaltourflights.'},';
	}
	if (($percregularflights+$perccharterflights)==0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "No flights", value: 0 },';
	}
	// Calculation for type of report

	$total= ($num_pireps);
	if ($total == 0){
		$cstacars = 0;
	} else {
		$vuelosregulares=$num_pireps-$charterspireps-$tourspirepsfull-$ivaopirepsfull;
		$cstacars = ($vuelosregulares / $total) * 100 ;
		$charter = ($charterspireps / $total) * 100 ;
		$toures = ($tourspirepsfull / $total) * 100 ;
		$ivaostoures = ($ivaopirepsfull / $total) * 100 ;
	}
	$per_type_report='';
	if ($num_pireps>0)
	{
		
		if ($charter>0)
		{
			$per_type_report = $per_type_report . '{label: "Charter", value: '.$charter.'},';
		}
		if ($cstacars>0)
		{
			$per_type_report = $per_type_report . '{label: "CST IVAO", value: '.$cstacars.'},';
		}
		if ($toures>0)
		{
			$per_type_report = $per_type_report . '{label: "ColStar Tour", value: '.$toures.'},';
		}
		if ($ivaostoures>0)
		{
			$per_type_report = $per_type_report . '{label: "IVAO Tour", value: '.$ivaostoures.'},';
		}
	}
	else
	{
		$per_type_report = $per_type_report . '{label: "No flights", value: 0 },';
	}
	




	// Calculation global % Charter VS Regular

	$totalflights = $num_pireps;	
	$totalregularflights = $num_pireps-$charterspireps;
	$totalcharterflights = $charterspireps;
	if ($totalflights == 0) {
		$percregularflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
	}

	$perccharterflights = round(100 - $percregularflights , 2);



	
	// Contar aerolineas
	
	$i = 0;
	$sql_va = 'SELECT * from operators';
	if (!$result_va = $db->query($sql_va)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_va->fetch_assoc()) {
			$i++;
		}
		
		// Contar usuarios no agregados
		
	$is = 0;	
		$sql_pcas = 'SELECT * from gvausers where activation=0';
	if (!$result_pcas = $db->query($sql_pcas)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row = $result_pcas->fetch_assoc()) {
			$is++;
		}
		
		
		
		
		// Contar colstar acars y pax
		
	$isesas = 0;	
		$sql_cstpireps = 'SELECT * from cstpireps';
	if (!$result_cstpireps = $db->query($sql_cstpireps)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($rowsel = $result_cstpireps->fetch_assoc()) {
			$comb_cstpireps = $comb_cstpireps+$rowsel["cargo"];
			$pax_cstpireps = $pax_cstpireps+$rowsel["pax"];
			$dist_cstpireps = $dist_cstpireps+$rowsel["distance"];
			$connection_times = $connection_times+$rowsel["connection_time"];
		}
		
		
		
		
		
		
?>



<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_STATS_INFO; ?> :: <?php echo date('Y'); ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_STATS_INFO; ?></font></h3>
	

</section>




	<section class="about" id="about">
	
		
		<div class="team" id="team">
			<div class="container">
				<div class="sixteen columns">
					<h1><?php echo TITLE_STATS_INFO; ?></h1> <h2> <em><?php echo ALLIANCE_INFO; ?>  :: <?php echo date('Y'); ?></em></h2>
				</div>
				<div class="sixteen columns">
					<div class="sub-text-line"></div>
				</div>
				<div class="clear"></div>
				<div class="sixteen columns">	
		
								

				<table  class="table table-striped" width="100%">
				  <tbody>
				  <tr>
					<td valign="top" width="20%" ><strong><?php echo PILOTS_STATISTICS; ?>:</strong></td>
					<td valign="top" width="30%"><?php echo $num_pilots; ?></td>
					<td valign="top" width="20%" ><strong><?php echo PAX_STATISTICS; ?>:</strong></td>
					<td valign="top" width="30%" ><?php echo $pax_cstpireps; ?></td>
				  </tr>
				  <tr>
					<td><strong><?php echo HOUR_STATISTICS; ?>:</strong></td>
					<td><?php 

$sumass= $connection_times;
$segundoss = $sumass*3600;
$horass = floor($segundoss/3600);
$minutoss = floor(($segundoss-($horass*3600))/60);
$segundoss = $segundoss-($horass*3600)-($minutoss*60);
$totals= $horass.' h '.$minutoss.' m ';

echo $totals; ?></td>
					<td><strong><?php echo PENDIENT_PILOTS; ?>:</strong></td>
					<td><?php echo $is; ?></td>
				  </tr>
				  <tr>
					<td><strong><?php echo FLIGHTS_STATISTICS; ?>:</strong></td>
					<td><?php echo $num_pireps; ?></td>
					<td><strong><?php echo VA_STATS; ?>:</strong></td>
					<td><?php echo $i; ?></td>
				  </tr>
				  <tr>
					<td><strong><?php echo DISTANCE_STATS; ?>:</strong></td>
					 <td><?php echo round($dist_cstpireps); ?> NM</td>
					<td><strong><?php echo AIRLINE_STATS; ?>:</strong></td>
					<td>+<?php echo $num_planes; ?></td>   
				  </tr>
				  <tr>
					<td colspan="2"><strong><?php echo ROUTE_STATS; ?>:</strong></td>
					<td colspan="2" align="left"><?php echo $num_routes; ?></td>
					
				  </tr>
				</tbody>
				</table>
								
					<br>
					<br>
					<br>
		
                    <div class="row">
                        <div class="col-sm-4 col-md-10">
                            <h3>
                                <?php echo PER_MONTH; ?>
                            </h3>
							<hr>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="feature feature-2 boxed boxed--border bg--white">
                                
								<div id="flights_per_day" ></div>
				<script>
					  var flights_per_day= Morris.Bar({
					  element: 'flights_per_day',
					  data: [<?php echo $count_per_day;?>
					  ],
					  xkey: 'day',
					  ykeys: ['flights'],
					  labels: ['flights'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_day.redraw();
				    });
				</script>
			</div>
                            </div>
                            <!--end feature-->
                        </div>
                   
			
			<br>
			<br>
			<br>
		            <div class="row">
                        <div class="col-sm-4 col-md-10">
                            <h3>
                                <?php echo NUMBER; ?> <?php echo PER_YEAR; ?>
                            </h3>
							<hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                           

							
								

				<div id="flights_per_month" ></div>
				<script>
					  var flights_per_month= Morris.Line({
					  element: 'flights_per_month',
					  data: [<?php echo $count_per_month;?>
					  ],
					  xkey: 'Mes',
					  ykeys: ['Vuelos'],
					  labels: ['Vuelos'],
					  parseTime: false,
					  resize: true,
					  stacked: true,
					  yLabelFormat: function(y){return y != Math.round(y)?'':y;}
					});
					  $('ul.nav a').on('shown.bs.tab', function (e) {
				            flights_per_month.redraw();
				    });
				</script>
								
							
                        </div>
                    </div>
                    <!--end of row-->
         
			
				
                        </div>
                    </div>
			
			</section>
	
                
					
					
					<section class="section-pricing services">
	<div class="price-wrapper">
		<div class="container">
			<div class="sixteen columns">
				<h4><?php echo DETAIL_CST; ?></h4>
			</div>
			<div class="clear"></div>
							<div class="four columns">
					<div class="price-wrap">
						
						
				<div id="perc_countr2" style="height: 350px;"></div>
					<script>
						  var perc_countr2 = Morris.Donut({
						  element: 'perc_countr2',
						  data: [<?php echo $per_type_report ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_countr2.redraw();
				            });
					</script>
			    
						<h6><?php echo PERCENT_TYPE_REPORT; ?></h6>
						
					</div>
				</div>
							<div class="four columns">
					<div class="price-wrap">
						
							<div id="perc_charter_reg" style="height: 350px;"></div>
					<script>
						  var perc_ch_re = Morris.Donut({
						  element: 'perc_charter_reg',
						  data: [<?php echo $perc_charter_reg ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_ch_re.redraw();
				            });
					</script>
				
						<h6><?php echo PERCENT_TYPE_FLIGHT; ?></h6>
						</div>
				</div>
							<div class="four columns">
					<div class="price-wrap">
						<div id="perc_by_country" style="height: 350px;"></div>
					<script>
						  var perc_by_country =  Morris.Donut({
						  element: 'perc_by_country',
						  data: [<?php echo $countcountry ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_by_country.redraw();
				    });
					</script>
						<h6><?php echo PERCENT_COUNTRY; ?></h6></div>
				</div>
							<div class="four columns">
					<div class="price-wrap">
						<div id="perc_type_report" style="height: 350px;"></div>
					<script>
						  var perc_aircarft_type_used =  Morris.Donut({
						  element: 'perc_type_report',
    					  data: [<?php echo $perc_aircarft_type_used ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_aircarft_type_used.redraw();
				            });
					</script>
					<h6><?php echo PERCENT_PLANE; ?></h6>
					
					</div>
				</div>
					</div>
	</div>

	<div class="clear"></div>

</section>
		
				


				
				
				
				<section class="section-blog parallax-section" id="blog">
	<div class="clear"></div>
	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.1"
	></div>
	<div class="just_pattern_parallax"></div>

	<div class="blog">
		<div class="container z-index-pages">
			
			<div class="sixteen columns" data-scroll-reveal="enter left move 300px over 1s after 0.1s">
					<div class="post-wrap">
						<div id="perc_flight_duration" style="height: 350px;"></div>
					<script>
						  var perc_flight_time = Morris.Donut({
						  element: 'perc_flight_duration',
						  data: [<?php echo $duration_graph ; ?>],
						  formatter: function(y){return y+' %';}
						});
						  $('ul.nav a').on('shown.bs.tab', function (e) {
				            perc_flight_time.redraw();
				            });
					</script>
						<h6><?php echo PERCENT_TIME; ?></h6>
					</div>
				
			</div>

			<div class="clear"></div>
		</div>
	</div>

	<div class="clear"></div>

</section>












<section class="about" id="about">
	
		
		<div class="team" id="team">
			<div class="container">
				<div class="sixteen columns">
					<h1><?php echo LAST_FLIGHT_ONE; ?></h1> <h2> <em><?php echo LAST_FLIGHT_TWO; ?></em></h2>
				</div>
				<div class="sixteen columns">
					<div class="sub-text-line"></div>
				</div>
				<div class="clear"></div>
				<div class="sixteen columns">	
		
								

				<table  class="table table-striped" width="100%">
	   <thead>
	      <tr>
		    <th>Callsign</th>
			<th><?php echo PILOT; ?></th>
			<th><?php echo DEPARTURE; ?></th>
			<th><?php echo ARRIVAL; ?></th>
			<th><?php echo DATE_CST; ?></th>
			<th><?php echo TIME_CST; ?></th>
			<th><?php echo PIREP_TYPE; ?></th>
		  </tr>
	   </thead>	  

<?php
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
		$sqltt = "select * from cstpireps order by fecha_envio desc limit 10";
							if (!$resulttt = $db->query($sqltt)) {
								die('There was an error running the query [' . $db->error . ']');
							}
							
		while ($rowtt = $resulttt->fetch_assoc()) {
			
				
			if($rowtt["charter"]==0) {
		$tipo_vuelo ="Regular";
		} else if($rowtt["charter"]==1) {
		$tipo_vuelo ="Charter";
		} else if($rowtt["charter"]==2) {
		$tipo_vuelo ="Tour ColStar";
		} else if($rowtt["charter"]==3) {
		$tipo_vuelo ="Tour IVAO";
		}
										
										$vid_user =$rowtt["vid"];
										$sql = "SELECT * FROM gvausers where ivaovid=$vid_user";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		$pilotname = $row['name'] . ' ' . $row['surname'];
	}
										echo '<td>';
										echo '<a href="./?page=tracker&idflight=' . $rowtt["id"] . '">' . $rowtt["callsign"] . '</a></td><td>';
										echo $pilotname . '</td><td>';
										echo $rowtt["departure"] . '</td><td>';
										echo $rowtt["arrival"] . '</td><td>';



										echo $rowtt["fecha_envio"] . '</td><td>';

$sumas= $rowtt["connection_time"];
$segundos = $sumas*3600;
$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';
										echo $total . '</td>';
										
		echo '<td>' . $tipo_vuelo . '</td>';	
		echo '</tr>';
									}

?>

	   
    </table>
			
			
				
                        </div>
                    </div>
			    </div>
			</section>
	














	
	<div class="clear"></div>