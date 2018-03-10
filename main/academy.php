
<?php
	
		
	
		include('db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
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
    
	<h1><font color="white"><?php echo ACADEMY_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo TWO_ACADEMY_TITLE; ?> <?php echo $pilotname . ' ' . $pilotsurname . ' (' . $callsign . ') '; ?></font></h3>

</section>
		
		


		<section class="contact">
			<div class="container">

	
<h2><?php echo THREE_ACADEMY_TITLE; ?></h2>
<hr>
<br>

<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b><?php echo TOPIC_ACADEMY; ?></b></th>
												<th><b><?php echo TEACHER_ACADEMY; ?></b></th>
												<th><b><?php echo DATE_ACADEMY; ?></b></th>
												<th><b><?php echo SCORE_ACADEMY; ?></b></th>
												<th><b><?php echo COMMENTS_TRAINING; ?></b></th>
												
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$sql1 = "select * from training where gvauser_id=$id";  
		$topis='';
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i = 0;
		$notas = 0;
		while ($row1 = $result1->fetch_assoc()) {
			$idents = $row1['tema'];
			$idents2 = $row1['examen'];
			if($idents==0) {
			
$sql123e = "select * from config_examen where id='$idents2'";  
		
		if (!$result123e = $db->query($sql123e)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row123e = $result123e->fetch_assoc()) {
			$topis = $row123e['titulo'];
		}			
			
    
		
			} else {
			$sql123 = "select * from temascalificacion where id='$idents'";  
		
		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row123 = $result123->fetch_assoc()) {
			$topis = $row123['nombre'];
		}
		
		
			}
		
		if(empty($row1['comments'])) {
			$comments =  '<center><div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_COMMENTS_TRAINING . '</span>
                                </div>
                            </div></center>';
		} else {
			$comments = $row1['comments'];
		}
		
		
			$i++;
			 echo '<tr>';
										 echo '<td>+' . $i . '</td>';
										 echo '<td>' . $topis . '</td>';
										  echo '<td>' . $row1['docente'] . '</td>';
										   echo '<td>' . $row1['fecha'] . '</td>';
										   echo '<td>' . $row1['nota'] . '</td>';
										   echo '<td>' . $comments . '</td>';
										echo '</tr>';
										
										$notas = $notas + $row1['nota'];
										$calculo = ($notas/$i);
										$promedio = number_format($calculo, 1);
		}
		
		
?>
</tbody>
</table>
<?php 

if ($promedio < 3 && $i>0) {
	
	if ($i>=5) {
		
		echo '<center><div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . PROMEDIUM_SCORE . ' ' . $nombre . ' ' . TWO_PROMEDIUM_SCORE . '</span>
                                </div>
                            </div></center>';
							
		echo '<center><div class="alert bg--success">
                                <div class="alert__body">
                                    <span>' . THREE_PROMEDIUM_SCORE . '</span>
                                </div>
                            </div></center>';
							
		echo '<center><div class="alert bg--primary">
                                <div class="alert__body">
                                    <span>' . FOUR_PROMEDIUM_SCORE . ' ' . $promedio . '.</span>
                                </div>
                            </div></center>';
							
		} else {
			
		echo '<center><div class="alert bg--primary">
                                <div class="alert__body">
                                    <span>' . FIVE_PROMEDIUM_SCORE . ' ' . $promedio . '.</span>
                                </div>
                            </div></center>';
							
		}
		
		
  } else if ($promedio >= 3 && $i>=5) {
		echo '<center><div class="alert alert-success" role="alert">' . SIX_PROMEDIUM_SCORE . ' ' . $promedio . '</div></center>';
        }
		
		
		
		if ($i == 0) {
		echo '<center><div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . SEVEN_PROMEDIUM_SCORE . '</span>
                                </div>
                            </div></center>';
        }
		
		?>
		
		
		
		<br>
		<br>
		<br>
		
		
		<h1><?php echo TRAINING_REQUEST; ?></h1>
		<hr>
		<br>
		
		<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b><?php echo PILOT_TRAINING; ?></b></th>
												<th><b><?php echo TEACHER_ACADEMY; ?></b></th>
												<th><b><?php echo DATE_ACADEMY; ?></b></th>
												<th><b><?php echo HOUR_TRAINING; ?></b></th>
												<th><b><?php echo COMMENTS_TRAINING; ?></b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>
<?php 
$sql12 = "select * from citacion where piloto=$id";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2 = 0;
		while ($row12 = $result12->fetch_assoc()) {
			
			
			$i2++;
			 echo '<tr>';
										 echo '<td>+' . $i2 . '</td>';
										 $idss = $row12['piloto'];
										 $sql122 = "select * from gvausers where gvauser_id=$idss";  
		
		if (!$result122 = $db->query($sql122)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row122 = $result122->fetch_assoc()) {
			
			$pca = $row122['name'] . ' ' . $row122['surname'];
		}
		
		
		
		
										 echo '<td>' . $pca . '</td>';
										 
										  $idssa = $row12['docente'];
										  $sql1223 = "select * from gvausers where gvauser_id=$idssa";  
		
		if (!$result1223 = $db->query($sql1223)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1223 = $result1223->fetch_assoc()) {
			
			$pca3 = $row1223['name'] . ' ' . $row1223['surname'];
		}
		
		
		
										  echo '<td>' . $pca3 . '</td>';
										   echo '<td>' . $row12['fecha'] . '</td>';
										   echo '<td>' . $row12['hora'] . '</td>';
										    echo '<td>' . $row12['comentarios'] . '</td>';
										echo '</tr>';
										
		
		
		}
		
		
		
		
?>
</tbody>
</table>

<?php
if ($i2 == 0) {
			
			echo '<center><div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_TRAINING . '</span>
                                </div>
                            </div></center>';
			
			
			
		}
		?>




</div>
<br>
<br>
</section>