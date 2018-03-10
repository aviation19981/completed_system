
<?php
	require('./check_login.php');
	include('./get_pilot_data.php');
	
// INICIO
	
	
	
// Vuelos Totales
	
	$sqlee = "select count(callsign) numpireps from cstpireps where gvauser_id='$id' and date_format(fecha_envio,'%y')=date_format(now(),'%y')";

	if (!$resultee = $db->query($sqlee)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosee = $resultee->fetch_assoc()) {

		$num_pireps = $rowusuariosee["numpireps"];

	}
	

// Vuelos Charter
	
	$sqlees = "select count(callsign) numpirepse from cstpireps where gvauser_id='$id' and charter=1  and date_format(fecha_envio,'%y')=date_format(now(),'%y')";

	if (!$resultees = $db->query($sqlees)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuariosees = $resultees->fetch_assoc()) {

		$charterspireps = $rowusuariosees["numpirepse"];

	}	
	
	
	// Vuelos Tour
	
	$sqleesa = "select count(callsign) numtoursva from cstpireps where gvauser_id='$id' and charter=2  and date_format(fecha_envio,'%y')=date_format(now(),'%y')";

	if (!$resulteesa = $db->query($sqleesa)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarioseesa = $resulteesa->fetch_assoc()) {

		$tourspireps = $rowusuarioseesa["numtoursva"];

	}	
	
	
	// Vuelos IVAO Tour
	
	$sqltourivao = "select count(callsign) ivaotourspireps from cstpireps where gvauser_id='$id' and charter=3  and date_format(fecha_envio,'%y')=date_format(now(),'%y')";

	if (!$resultivao = $db->query($sqltourivao)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowivao = $resultivao->fetch_assoc()) {

		$ivaotourspireps = $rowivao["ivaotourspireps"];

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
		$sql2 = "select IFNULL(count(id),0) as co from cstpireps where vid=$ivaovid and date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%m')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$meses = array('',MES_EN,MES_FE,MES_MA,MES_AB,MES_MAY,MES_JUN,MES_JUL,MES_AG,MES_SP,MES_OC,MES_NO,MES_DI);
		while ($row2 = $result2->fetch_assoc()) {
			$count_per_month = $count_per_month . "{ day: '".$meses[$i]."', flights: ".$row2['co']." },";
		}
	}
	
	$diasmes= date("d",mktime(0,0,0,$current_month+1,0,$current_year));
	// Calculation for flights per day current month
	$count_per_day = '';
	for ($i = 1 ; $i <= $diasmes ; $i++) {
		$days = $days . ',' . $i;
		$sql2 = "select IFNULL(count(id),0) as co from cstpireps where vid=$ivaovid and date_format(fecha_envio,'%m')=date_format(now(),'%m') and date_format(fecha_envio,'%y')=date_format(now(),'%y') and date_format(fecha_envio,'%d')=$i";
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
select '0-1' as connectiontime , COUNT(*) as cn from cstpireps where date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))<=1
union
select '1-2' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>1 and ABS(abs(connection_time))<=2
union
select '2-3' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>2 and ABS(abs(connection_time))<=3
union
select '3-4' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>3 and ABS(abs(connection_time))<=4
union
select '4-5' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>4 and ABS(abs(connection_time))<=5
union
select '5-6' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>5 and ABS(abs(connection_time))<=6
union
select '6-7' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>6 and ABS(abs(connection_time))<=7
union
select '7-8' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>7 and ABS(abs(connection_time))<=8
union
select '8-9' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>8 and ABS(abs(connection_time))<=9
union
select '>9' as connectiontime , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH((connection_time))>0 and ABS(abs(connection_time))>9) as t group by connectiontime";
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
	$sql = "select aircraft , COUNT(*) as cn from cstpireps where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and vid=$ivaovid and LENGTH(aircraft)>0 group by aircraft";
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
	$sql = "select count(*) as c, vp.aircraft as plane_icao from cstpireps vp where vp.vid=$ivaovid and  date_format(fecha_envio,'%y')=date_format(now(),'%y')  and LENGTH(aircraft)>0 group by vp.aircraft order by plane_icao asc";
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
			where  date_format(fecha_envio,'%y')=date_format(now(),'%y') and  c.`iso2`=a.`iso_country`  and  vp.departure=a.ident and vp.vid=$ivaovid  group by short_name) as t group by short_name;";
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
	$totalregularflights = $num_pireps-$charterspireps-$tourspireps-$ivaotourspireps;
	$totalcharterflights = $charterspireps;
	$totaltourflights = $tourspireps;
	$totalivaotourflights = $ivaotourspireps;
	if ($totalflights == 0) {
		$percregularflights = 0;
		$perccharterflights = 0;
		$perctourflights = 0;
		$percivaotourflights = 0;
	} else {
		$percregularflights = round(($totalregularflights * 100) / $totalflights , 2);
		$perccharterflights = round(($totalcharterflights * 100) / $totalflights , 2);
		$perctourflights = round(($totaltourflights * 100) / $totalflights , 2);
		$percivaotourflights = round(($totalivaotourflights * 100) / $totalflights , 2);
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
	if ($percivaotourflights>0)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "IVAO Tour", value: '.$percivaotourflights.'},';
	}
	if (($totalflights)<1)
	{
		$perc_charter_reg = $perc_charter_reg . '{label: "No flights", value: 0 },';
	}
	// Calculation for type of report
	
	
	
	$total= ($num_pireps);
	if ($total == 0){
		$cstacars = 0;
	} else {
		$vuelosregulares=$num_pireps-$charterspireps-$tourspireps-$ivaotourspireps;
		$cstacars = ($vuelosregulares / $total) * 100 ;
		$charter = ($charterspireps / $total) * 100 ;
		$toures = ($tourspireps / $total) * 100 ;
		$ivaotoures = ($ivaotourspireps / $total) * 100 ;
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
		if ($ivaotoures>0)
		{
			$per_type_report = $per_type_report . '{label: "IVAO Tour", value: '.$ivaotoures.'},';
		}
	}
	else
	{
		$per_type_report = $per_type_report . '{label: "No flights", value: 0 },';
	}
	
	
	
	
	
	?>


<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_STATS_INFO; ?> :: <?php echo date('Y'); ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_MY_STATS; ?></font></h3>

</section>



			
			
			<section class="contact">
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
						<center>
                            <span class="h1">
                                <span class="color--primary"><?php echo TWO_INFO_MY_STATS; ?></span> <?php echo THREE_INFO_MY_STATS; ?>  :: <?php echo date('Y'); ?>
                            </span>
                        </center>
							
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
			
			<section class="cover cover-features imagebg" data-overlay="2">
                <div class="background-image-holder">
                    <img alt="background" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-10">
						<br>
                            <h1>
                                <?php echo PER_MONTH; ?>
                            </h1>
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
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
			
			<section class="contact">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <span class="h2">
                                <span class="color--primary"><?php echo NUMBER; ?></span> <?php echo PER_YEAR; ?>
                            </span>

							
								
				<div id="flights_per_month" ></div>
				<script>
					  var flights_per_month= Morris.Line({
					  element: 'flights_per_month',
					  data: [<?php echo $count_per_month;?>
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
				            flights_per_month.redraw();
				    });
				</script>
								
							
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
			
			
			
			<section class="cover cover-features imagebg" data-overlay="2">
                <div class="background-image-holder">
                    <img alt="background" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4 col-md-10">
						<br>
                            <h1>
                                <?php echo DETAIL_CST; ?>
                            </h1>
							<hr>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="feature feature-2 boxed boxed--border bg--white">
                                
								
								
								
								
								
<div class="row">
	
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;<?php echo PERCENT_TYPE_REPORT; ?></h3>
			</div>
			<div class="panel-body">
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
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;<?php echo PERCENT_TYPE_FLIGHT; ?></h3>
			</div>
			<div class="panel-body">
			
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
			</div>
		</div>
	</div>
</div>
<!-- Row 3-->
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;<?php echo PERCENT_COUNTRY; ?></h3>
				<br>
				<br>
			</div>
			<div class="panel-body">
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
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;<?php echo PERCENT_PLANE; ?></h3>
				<br>
				<br>
			</div>
			<div class="panel-body">
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
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">&nbsp;<?php echo PERCENT_TIME; ?></h3>
			</div>
			<div class="panel-body">
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
			</div>
		</div>
		</div>
		</div>
								
								
								
								
								
								
								
			</div>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
			
			
			
	