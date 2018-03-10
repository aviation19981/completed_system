

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo ENTTO_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo ENJOY_ENTTO; ?></font></h3>

</section>


<?php
        $idents = $_GET['id'];
		
	
		

        $sql12 = "select * from courses where course_id='$idents'";  
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row12 = $result12->fetch_assoc()) {
			$nombre = $row12["name"]; 
			$teachers = $row12["docentes"]; 
			$descrip = $row12["description"];
		}
		
		
		
		?>



		<section class="content not_found">
			<div class="container">
    <div id="page-content" class="row-fluid">
	

<hr>
<br>
<h2><font color="black"><?php echo DOCUMENT_INFORMATION; ?></font></h2>
<br>
<p><?php echo TEACHERS_DOCUMENTS; ?> <b><?php echo $teachers; ?></b>.</p>
<br>
<h2><?php echo DESCRIPTION_DOCUMENT; ?>:</h2>
<br>
<p><?php echo $descrip; ?></b>

<hr>



                <section id="region-main" class="span9 desktop-first-column ">
            <div role="main">
			<span id="maincontent"></span>
			<form action="." method="get">
			<div>
			<input type="hidden" id="completion_dynamic_change" name="completion_dynamic_change" value="0" />
			</div>
			</form>
			
			<div class="course-content">
			
	

	<?php
	$contadores=0;
	 $sql123 = "select * from trainings where course_id='$idents'";  
		
		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row123 = $result123->fetch_assoc()) {
			$contadores++;
		?>
<div>
<div class="mod-indent-outer">
<div class="mod-indent">
</div>
<div>
<div class="activityinstance">
<a class="" onclick="" href="./index_user.php?page=moduletr&id=<?php echo $row123["training_id"] ; ?>">
<i class="icon color--primary icon-Book"></i>
<span class="instancename"><?php echo $row123["title"] ; ?></span></a></div>
<span class="actions">
</span>
<div class="contentafterlink">
<div class="no-overflow">
<div class="no-overflow">
<p>
<span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13.3333px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><?php echo $row123["content"] ; ?></span><br></p></div></div></div></div></div></div>



<br>
<?php  
		


$identexamen = $row123["training_id"];


$sql1237 = "select * from config_examen where training_id='$identexamen'";  
		
		if (!$result1237 = $db->query($sql1237)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row1237 = $result1237->fetch_assoc()) {
		?>	
		<div>
<div class="mod-indent-outer">
<div class="mod-indent"></div>
<div>
<div class="activityinstance">
<a class="" href="./index_user.php?page=examenesva&id=<?php echo $row1237['id']; ?>" >
<i class="icon color--primary icon-Check icon--sm"></i>
<span class="instancename"><?php echo TEST_DOCUMENT; ?> :: <span class="accesshide " > <?php echo $row1237['titulo']; ?></span></span></a></div>
<span class="actions"></span>
<div class="contentafterlink">
<div class="no-overflow">
<div class="no-overflow">
<p><span style="color: rgb(0, 0, 0); font-family: Verdana, sans-serif; font-size: 13.3333px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: justify; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none;"><?php echo $row1237['descripcion']; ?></span><br></p></div></div></div></div></div></div>	
<br>
		<?php
		}







		}

		
		
		
		
		?>
		<?


if ($contadores==0) 
{
					 echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span><font color="black">' . NO_DOCUMENT . '</font></span>
                                </div>
                            </div>';
				}
				


				?>




</div>


</ul></div></div>        </section>
</div>
</div>

  </section>