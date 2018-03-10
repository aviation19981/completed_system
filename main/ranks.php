
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_RANKS; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	

</section>
		
													
<div class="clear"></div>  
			
			
	 	<section class="content not_found">
			<div class="container">
			<br>
			<br>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <span class="h2">
                                <span class="color--primary"><?php echo TITLE_RANKS; ?></span> <?php echo INFO_RANKS_VA; ?>
                            </span>
                            <hr>
                            <p class="lead">
                                <?php echo DETAIL_RANKS; ?>
                            </p>							
								
                   									 
<?php 
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
		$sql_airlines_allow = "SELECT * from operators";
	if (!$result_airlines_allow = $db->query($sql_airlines_allow)) {
		die('There was an error running the query [' . $db->error . ']');
	}
		while ($row_airlines_allow = $result_airlines_allow->fetch_assoc()) {
			$operator_id_rank = $row_airlines_allow['operator_id'];
			
				
			   ?>
			   
			   
			   <ul class="accordion accordion-1">
	<li>
		<div class="accordion__title">
			<span class="h5"><?php echo TABLE_RANK; ?> :: <?php echo $row_airlines_allow['operator'] ; ?></span>
		</div>
		<div class="accordion__content">
	<div style="height:400px; width:100%; overflow-y: scroll; overflow-x: false;">		
		
		
		
		
								<h2><?php echo TABLE_RANK; ?> :: <?php echo $row_airlines_allow['operator'] ; ?></h2>
<hr>



<table class="border--round" width="100%">
				  
<thead>
  <tr>
    <th><?php echo TABLE_LEVEL; ?></th><th><?php echo TABLE_RANK; ?></th><th><?php echo TABLE_AIRPLANES; ?></th><th><?php echo TABLE_HOURS; ?></th>
  </tr>
</thead>
<tbody>

<?php 
				include('./db_login.php');
					$sql_ranks ="select * from ranks where operator_id='$operator_id_rank' order by minimum_hours ";

	if (!$result_ranks = $db->query($sql_ranks)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$aeronaves ="";
	$numbers=0;
	while ($row_ranks = $result_ranks->fetch_assoc()) {
	$numbers++;
	$ranks=$row_ranks["rank_id"];
	
	
$fleettype_id_allow = array();
	$sql29 = "select * from fleettypes_ranks where operator_id='$operator_id_rank' and rank_id='$ranks'";
	if (!$result29 = $db->query($sql29)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row29 = $result29->fetch_assoc()) {
		
			$fleettype_id_allow[] = $row29['fleettype_id'];
		
		
	}
	

	
	$sql2 = "select * from fleettypes";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	
	while ($row2 = $result2->fetch_assoc()) {
		if (in_array($row2['fleettype_id'], $fleettype_id_allow)) {
			$aeronaves = $aeronaves . $row2['plane_description'] . '<br>';
		}
		
	}
		
		?>
	
    <tr>
    <td style="width: 43px;"><img width="41" height="20" src="../../admin/images/ranks/<?php echo $row_ranks["img"]; ?>"></td>
   <td><?php echo $row_ranks["rank"] . ' (' . $row_ranks["abreviacion"] . ')'; ?></td><td><?php echo $aeronaves; ?></td><td><?php echo $row_ranks["minimum_hours"] . '-' . $row_ranks["maximum_hours"]; ?> Hrs</td>
  </tr>
					<? } 
					
					if($numbers==0) {
						
						echo '<tr><td colspan="7"><div class="alert bg--error">
                                                     <div class="alert__body ">
                                                       <span>No hay pilotos | There are not pilots</span>
                                                     </div>
                                                  </div></td></tr>';
						
						
						
					}
					
					
					
					?>
  
  

</tbody>
</table>



		
		
									</div><br/>
									
									
		</div>
	</li>
</ul>



			   
			
			
			<?php
            }
			
			
			
	
	
?>



				
								
							
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			