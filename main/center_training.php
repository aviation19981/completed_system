

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TRAINING_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_TRAINING_CENTER; ?></font></h3>

</section>




<section class="content not_found">
		
<div class="tab__content">

                            <section class="text-center ">
                                <div class="container">
								
								<br>
<h1><?php echo REQUEST_TRAINING; ?></h1>
<hr>

                                    <div class="row">
                                        <div class="col-sm-8 col-md-12">
                                            <div class="row">
                                                <form class="text-left" method="post" action="./index_user.php?page=askfortraining">
                                                    <div class="col-sm-12">
                                                        <label><?php echo USER_INDEX_USER; ?>:</label>
                                                        <input type="text" name="Names" class="validate-required" value="<?php echo $pilotname . ' ' . $pilotsurname; ?>" readonly="readonly"/>
														<input type="hidden" name="Name" class="validate-required" value="<?php echo $id; ?>" readonly="readonly"/>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label><?php echo TEACHER_INDEX_USER; ?>:</label>
												<div class="input-select">
                                                    <select class="validate-required" name="docente" id="docente">
                                                        <?php

	$sql = "select name,surname,gvauser_id from gvausers where user_type_id=4";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		echo '<option value="' . $rowusuarios['gvauser_id']  . '">' . $rowusuarios['name']  . ' ' . $rowusuarios['surname']  . '</option>';

	}
		
		
		?>
                                                    </select>
                                                </div>
                                                    </div>
													 <div class="col-sm-6">
                                                        <label><?php echo PLANE_INDEX_USER; ?>:</label>
												<div class="input-select">
                                                    <select class="validate-required"  name="aeronave" id="aeronave">
                                                        <?php
        $planes_info = array();
		$sql = "select DISTINCT * from fleettypes_gvausers fgva, fleettypes ft, fleettypes_ranks frank where ft.fleettype_id=fgva.fleettype_id and fgva.gvauser_id='$id' and frank.fleettype_id=fgva.fleettype_id and   frank.operator_id='$operator_id_session' order by plane_icao asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

	    
		if(!in_array($rowusuarios['plane_description'],$planes_info)) {
		  $planes_info[]=$rowusuarios['plane_description'];
			echo '<option value="' . $rowusuarios['plane_description']  . '">' . $rowusuarios['plane_description']  . '</option>';
		}
	}
		
		
		?>
                                                    </select>
                                                </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label><?php echo COMMENTS_INDEX_USER; ?>:</label>
                                                        <textarea rows="6" name="comentarios" class="validate-required"></textarea>
                                                    </div>
                                                    <div class="col-sm-5 col-md-4">
                                                        <button type="submit" class="btn btn--primary type--uppercase"><?php echo SEND_TRAINING; ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!--end of row-->
                                        </div>
										</div>
										
										
										
										
										
										
										
										<hr>
													<br>
<h1>Estado Entrenamientos</h1>
<hr>

                                    <div class="row">
                                        <div class="col-sm-8 col-md-12">
                                            <div class="row">
                                              




<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b>Docente</b></th>
												<th><b>Aeronave</b></th>
												<th><b>Comentarios</b></th>
												<th><b>Estado</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody align="left">
										 
										 <?php
        $i=0;
		$sql = "select * from request_entto where id_student='$id' order by fecha_solicitud asc";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowenttos = $result->fetch_assoc()) {
		$i++;
		$id_docente = $rowenttos['id_teacher'];
		
	$sql_docente = "select * from gvausers where gvauser_id='$id_docente'";

	if (!$result_docente = $db->query($sql_docente)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowenttos_docente = $result_docente->fetch_assoc()) {
		$docenteinfo = $rowenttos_docente['name'] . ' ' . $rowenttos_docente['surname'] . ' [' . $rowenttos_docente['email'] . ']';
	}
	
	
	
	////////// Códigos Estado
	////// 0 Solicitado
	////// 1 Contactado
	////// 2 Fecha Fijada
	////// 3 Finalizado
	////// 4 Cancelado
	////// 5 Reprogramado
	
	
	if($rowenttos['estado']==0) {
	             $estado = '<div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>Solicitado</center></span>
								</div>
                            </div>';
	} else if($rowenttos['estado']==1) {
	             $estado = '<div class="alert bg--success">
                                <div class="alert__body">
								   <span><center>Contactado</center></span>
								</div>
                            </div>';
	} else if($rowenttos['estado']==2) {
	             $estado = '<div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>Programado<br>Fecha: ' . $rowenttos['fecha_entto'] . ' [' . $rowenttos['hora_entto'] . ']</center></span>
								</div>
                            </div>';
	} else if($rowenttos['estado']==3) {
	             $estado = '<div class="alert bg--success">
                                <div class="alert__body">
								   <span><center>Finalizado</center></span>
								</div>
                            </div>';
	} else if($rowenttos['estado']==4) {
	             $estado = '<div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>Cancelado</center></span>
								</div>
                            </div>';
	} else if($rowenttos['estado']==5) {
	             $estado = '<div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>Reprogramado<br>Fecha: ' . $rowenttos['fecha_entto'] . ' [' . $rowenttos['hora_entto'] . ']</center></span>
								</div>
                            </div>';
	}


							
		?>


										 <tr>
										   <td><?php echo $i; ?></td>
										   <td><?php echo $docenteinfo; ?></td>
										   <td><?php echo $rowenttos['plane']; ?></td>
										   <td><?php echo $rowenttos['comments']; ?></td>
										   <td><?php echo $estado; ?></td>
										 </tr>
										 
										 
	<?php } 
	
	if($i==0) {
		
		echo '<tr><td colspan="5"><div class="alert bg--error">
                                <div class="alert__body">
								   <span><center>No hay entrenamientos solicitados</center></span>
								</div>
                            </div></td></tr>';
		
		
	}
	
	
	
	?>



</tbody>
</table>										 
                                            </div>
                                            <!--end of row-->
                                        </div>
										</div>
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										
										</div>
										</section>
										</div>


</section>


	
<section class="cover cover-features imagebg" data-overlay="2">
                <div class="background-image-holder">
                    <img alt="background" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 col-md-12">
						<br>
                            <h2>
                                <?php echo GREETING_INDEX_USER; ?>
                            </h2>
							<hr>
                            <p class="lead">
                                <b><?php echo LEVEL_STUDENT; ?>:</b> <?php echo $rank; ?>
                            </p>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">


<?php 

    $ranks_id = array();

    $sqlrank = "select DISTINCT * from ranks where operator_id='$operator_id_session'";

	if (!$resultrank = $db->query($sqlrank)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank = $resultrank->fetch_assoc()) {
		
		$ranks_id[] = $rowrank['rank_id'];
		
	}
	
	
	
        $contadorcurso = 0;
        $horas = ($gva_hourse + $transfered_hours);

        $sql12 = "select DISTINCT * from courses INNER JOIN ranktypes_course where ranktypes_course.course_id=courses.course_id and ranktypes_course.rank_id  IN (" . implode(',', array_map('intval', $ranks_id)) . ")";  
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
			$rango=$row12['rank_id'];
			$course_id_txt = $row12["course_id"];
		$minimunhoursthisrank =0;	
			$sqlrank_2 = "select * from ranks where rank_id='$rango'";

	if (!$resultrank_2 = $db->query($sqlrank_2)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowrank_2 = $resultrank_2->fetch_assoc()) {
		$minimunhoursthisrank = $rowrank_2["minimum_hours"];
		
		
	}
			
		$contadorcurso++;
			?>
                        <div class="col-sm-6" style="padding: 5px;">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo $row12["name"]; ?> by <?php echo $row12["docentes"]; ?></h5>
                                <p>
                                    <?php echo  substr($row12["description"], 0, 160) . '...'; ?>
                                </p>
                                <?php
								if($horas>=$minimunhoursthisrank) {
			                        echo '<a href="./index_user.php?page=training&id=' . $course_id_txt . '">' . GO_TO_COURSE . '</a>';
		                        } else {
									echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><font color="black">' . ALERT_COURSE . '</font></span>
                                </div>
                            </div>';
								}
		                        ?>
								
								<?php
								if($horas>=$minimunhoursthisrank) {
			                       ?><span class="label "><?php echo COURSE_ENTTO; ?></span><?php
		                        } else {
									?><span class="label">NO LEVEL</span><?php
								}
		                        ?>
                                
                            </div>
                            <!--end feature-->
							</div>
							
			<?php
			
			
									
									
										
		}
		
	

        if ($contadorcurso==0) {
			  echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><font color="black">' . NO_COURSES . '</font></span>
                                </div>
                            </div>';
		}
				


				?>
 
                       
                        
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
	



 
 



