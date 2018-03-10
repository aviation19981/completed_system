<?php
	$vidusuario = strtoupper($_POST['vid_test']);

	
	$teachers = '';
	$sql_teach = 'select * from gvausers where  user_type_id=4';
	if (!$result_teach = $db->query($sql_teach)) {
	die('There was an error running the query [' . $db->error . ']');
    }
	
	while ($row_teach = $result_teach->fetch_assoc()) {
		if(empty($row_teach['facebook'])) {
			$facebook = '';
		} else {
			$facebook = ' [' . $row_teach['facebook'] . ']';
		}
		
		$teachers = $teachers . '<li>' . $row_teach['name'] . ' ' . $row_teach['surname'] . ' [' . $row_teach['email'] . ']' . $facebook . '</li><br>';
	}
	
	
	$sql = 'select * from presentacionexamen where  vid="' . $vidusuario . '"';
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
    }
$contarusuario=0;
	while ($row = $result->fetch_assoc()) 
			{
			$contarusuario++;	
				
		$pilotname = $row['nombres'] . ' ' . $row['apellidos'];
		$correo = $row['email'];
		$rango = $row['rango'];
		$fecha = $row['fecha'];
		$calificacion = $row['calificacion'];
		$calificacionentrevista = $row['calificacionentrevista'];
		$calificaciontotal = $row['calificaciontotal'];
		$estado = $row['estado'];
		$ip = $row['ip'];
		
			
			// ESTADO 0 Logeado
		// ESTADO 1 Perdido Teorico
		// ESTADO 2 Ganado Teorico
		// ESTADO 3 Perdido Practico
		// ESTADO 4 Ganado Practico INGRESO
		// ESTADO 5 Archivado Perdido
		// ESTADO 6 Archivado Ganado
		// ESTADO 7 Archivado No Presentado
		
	
		
		if($estado==0) {
			$respuesta = '<span>' . ANSWER_ONE_TEST . '</span>';
		} else if($estado==1) {
			$respuesta = '<span>' . ANSWER_TWO_TEST . '</span>';
		} else if($estado==2) {
			$respuesta = '<span>' . ANSWER_THREE_TEST . '</span>';
		} else if($estado==3) {
			$respuesta = '<span>' . ANSWER_FOUR_TEST . '</span>';
		} else if($estado==4) {
			$respuesta = '<span>' . ANSWER_FIVE_TEST . '</span>';
		} else if($estado==5) {
			$respuesta = '<span>' . ANSWER_SIX_TEST . '</span>';
		} else if($estado==6) {
			$respuesta = '<span>' . ANSWER_SIX_TEST . '</span>';
		} else if($estado==6) {
			$respuesta = '<span>' . ANSWER_SIX_TEST . '</span>';
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
    
	<h1><font color="white"><?php echo TEST_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_STATUS_EXAM; ?></font></h3>

</section>


 <section>
                <div class="container">
		<br>
		<br>
		<h2><?php echo DETAILS_EXAM; ?></h2>
		
		<hr>
		<br>
		
<ul class="accordion accordion-1">

						

	<li>
		<div class="accordion__title">
			<span class="h5"><?php echo $row['vid'] . ' (' . $pilotname . ')'; ?>   - <?php echo $Palabra; ?>: <?php echo $respuesta; ?></span>
		</div>
		<div class="accordion__content">
		
			
						<img src="http://www.aeroclubdelatlantico.com.co/wp-content/uploads/2015/04/hagase-piloto.png" width="17%" align="left">
						
						<br>
						<br>
						<h4><b><?php echo CNNOMBRE; ?></b> <?php echo $pilotname . ' ' . $pilotsurname?></h4>
						<br>
						<h4><b><?php echo CNRANGO; ?></b> <?php echo $rango; ?></h4>
						<br>
						<h4><b><?php echo CNTEST; ?></b> <?php echo $fecha; ?></h4>
						<br>
						<h4><b><?php echo CNEMAIL; ?></b> <?php echo $correo; ?></h4>
						<br>
						
						<h4><b><?php echo CNESTADO; ?></b></h4>
						<hr>
						<?php 
						if($estado==0) {
							?>
							<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><?php echo EXAMENREG; ?></span>
                                </div>
                            </div>
							<?php
						} else if($estado==1) {
							?>
							<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><?php echo EXAMENREGDOS; ?> <?php echo $calificacion; ?>%.</span>
                                </div>
                            </div>
							
							<?php
						} else if($estado==2) {
							?>
							
			
                                    <span class="alert bg--error"><?php echo EXAMENREGTRES; ?> <?php echo $calificacion; ?>%. </span>
                       <div style="height:200px; width:100%; overflow-y: scroll; overflow-x: false;">	
                                      <h5><?php echo EXAMENREGCUATRO; ?></h5>					   
							          <h6 align="left"><p><?php echo $teachers; ?></p><b><?php echo EXAMENCINCO; ?></b></h6>
						
					</div>				                               
							<?php
						} else if($estado==3) {
							?>
							<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><?php echo EXAMENSEIS; ?> <?php echo $calificaciontotal; ?>%.</span>
                                </div>
                            </div>
							
							<?php
						} else if($estado==4) {
							?>
							<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><?php echo EXAMENSIETE; ?> <?php echo $calificaciontotal; ?>%. <br><b><?php echo EXAMENOCHO; ?></b></span>
                                </div>
                            </div>
							
							
							<?php
						} else if($estado>=5) {
							?>
							No detalles | No details ==> <?php echo $respuesta; ?>
							<?php
						}
						?>
			
			

           
			
		</div>
	</li>

					
					
					
						
			<?php }

if ($contarusuario == 0) 
{
	$mensaje = INCORRECTEXAMEN;
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=searchexamen';";
echo "</script>";  
					
}


?>				
	</ul>				</div>	
						</section>
