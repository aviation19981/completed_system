<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo MONEY_STATISTISC; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_MONEY_STATISTISC; ?></font></h3>

</section>


		<section class="contact">
			<div class="container">
			<h1><?php echo ECONOMY_DETAILS; ?></h1>
			<hr>
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
		$sql2 = "select ROUND(IFNULL(sum(quantity),0),0) as co from bank where gvauser_id=$id  and date_format(date,'%y')=date_format(now(),'%y') and date_format(date,'%m')=$i";
		if (!$result2 = $db->query($sql2)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$meses = array('',MES_EN,MES_FE,MES_MA,MES_AB,MES_MAY,MES_JUN,MES_JUL,MES_AG,MES_SP,MES_OC,MES_NO,MES_DI);


		while ($row2 = $result2->fetch_assoc()) {
		
		
			$count_per_month = $count_per_month . "{ Mes: '" . $meses[$i] . "', Balance: ". $row2['co'] ." },";
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
					  data: [<?php echo $count_per_month;?>
					  ],
					  
					  
			
			
					  xkey: 'Mes',
					  ykeys: ['Balance'],
					  labels: ['Balance'],
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
		  <div class="tab__title text-center">
				<span class="h2"><i class="icon icon--sm block icon-Eye"></i>
				<?php echo TWO_ECONOMY_DETAILS; ?> <?php echo date('Y'); ?></span>
			</div>
		  <hr>
		<table id="table_list"  class="border--round"  style="width:100%">
																	
                                        <thead style="width:100%">
                                            <tr>
												<th><b><?php echo BANK_DATE; ?></b></th>
												<th><b><?php echo BANK_AMOUNT; ?></b></th>
												<th><b><?php echo BANK_REASON; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead style="width:100%">
										<tr>
										</tr>
										</thead>
										 <tbody style="width:100%">
				<?php
				
					// Execute SQL query
	$sql = " select * from bank where gvauser_id=$id order by date desc ";

	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
	
	
					$total_money = 0;
					while ($row = $result->fetch_assoc()) {
						echo '<tr><td>';
						echo $row["date"] . '</td><td>';
						echo number_format($row["quantity"] , 2) . '</td><td>';
						echo $row["jump"] . '</td></tr>';
						$total_money = $total_money + $row["quantity"];
					}
					$total_money = number_format($total_money , 2);
					
					
					echo '</tbody></table></br>';
					
					if($total_money>=0) {
						
						echo '<div class="alert bg--success">
                                <div class="alert__body">
                                    <span>' . BANK_TOTAL_MONEY . $total_money . ' ' . $currency . '</span>
                                </div>
                            </div>'; 
							
					} else {
						
						echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . BANK_TOTAL_MONEY . $total_money . ' ' . $currency . '</span>
                                </div>
                            </div>'; 
						
					}
					$db->close();
				?>

			
	<br>
	<br>

</section>
