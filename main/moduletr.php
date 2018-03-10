

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
			
<?php
        $idents = $_GET['id'];
	

    
 
 $sql12 = "select * from trainings where training_id='$idents'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
		$titulos =  $row12["title"];
		$description =  $row12["description"];
		$content =  $row12["content"];
										
		}
		
		$contador=0;
		$sql3 = "select * from trainings_pdf where id_modulo='$idents'";  
		
		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row3 = $result3->fetch_assoc()) {
		 $contador++;
										
		}
		
		
		?>




		<section class="content not_found">
			<div class="container">
    <div id="page-content" class="row-fluid">
	

<center><h1><b><?php echo $titulos; ?></b></h1></center>
	  <hr>
	  <h2><?php echo TITLE_DOCUMENT; ?>: <?php echo $titulos; ?> </h2>
	  <br>
	  <h3><b><?php echo INFO_DOCUMENT; ?>:</b> <?php echo $content; ?></h3>
	  <br>
	  <hr>
	  <br>
	  <?php echo $description; ?>
	  <br>
      <?php if($contador>0) { ?>
	  <center><h2>Archivos PDF adjuntos a <b><?php echo $titulos; ?></b></h2></center>
	  <hr>
	  <br>
	  <?php
        $contadorpdf = 0;
        $sql4 = "select * from trainings_pdf where id_modulo='$idents'";  
		
		if (!$result4 = $db->query($sql4)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row4 = $result4->fetch_assoc()) { 
		$contadorpdf++;?>
		<ul class="accordion accordion-1">
	<li>
		<div class="accordion__title">
			<span class="h5">Archivo PDF #<?php echo $contadorpdf; ?></span>
		</div>
		<div class="accordion__content">
	<div style="height:500px; width:100%; overflow-y: scroll; overflow-x: false;">	
	  <p><iframe align="middle" frameborder="0" height="600" scrolling="no" src="./../admin/pdf/<?php echo $row4['pdf']; ?>#toolbar=0" width="100%"></iframe></p>
	</div>
	</div>
	</li>
	</ul>
      <?php } 
	  } ?>
	
	



</div>
</div>

  </section>