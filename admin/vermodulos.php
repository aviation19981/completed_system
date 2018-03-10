 <?php $training_id = $_GET['id']; 
 
        $sql12 = "select * from trainings where training_id='$training_id'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			
		$titulos =  $row12["title"];
		$description =  $row12["description"];
		$content =  $row12["content"];
										
		}
		
		$contador=0;
		$sql3 = "select * from trainings_pdf where id_modulo='$training_id'";  
		
		if (!$result3 = $db->query($sql3)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row3 = $result3->fetch_assoc()) {
		 $contador++;
										
		}
		
	

$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "http://" . $host;

		?>
 <section id="content">
          <section class="vbox">
            <section class="scrollable wrapper">
              <div class="panel b-a">
                <div class="panel-heading b-b">Visualización</div>
                <div class="panel-body">
                  <div class="h3 m-b font-thin">Visualización de Módulo</div>
                  <div class="row">
                    <div class="col-sm-12">                      
   
           

	  
	  <center><h1><b><?php echo $titulos; ?></b></h1></center>
	  <hr>
	  <h3><b>Resúmen:</b> <?php echo $content; ?></h3>
	  <br>
	  <hr>
	  <br>
	  <?php echo $description; ?>
	  <?php if($contador>0) { ?>
	  <center><h2>Archivos PDF adjuntos a <b><?php echo $titulos; ?></b></h2></center>
	  <hr>
	  <br>
	  <?php
        $contadorpdf = 0;
        $sql4 = "select * from trainings_pdf where id_modulo='$training_id'";  
		
		if (!$result4 = $db->query($sql4)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		while ($row4 = $result4->fetch_assoc()) { 
		$contadorpdf++;?>
	  <h3><li>Archivo PDF #<?php echo $contadorpdf; ?></li></h3>
	  <p><iframe align="middle" frameborder="0" height="600" scrolling="no" src="./pdf/<?php echo $row4['pdf']; ?>#toolbar=0" width="100%"></iframe></p>
	  <br>
      <?php } 
	  } ?>
      



                </div>
              </div>
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
  

