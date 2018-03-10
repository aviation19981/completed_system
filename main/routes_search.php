
	
			<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo ROUTE_SEARCHER_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white">  <?php echo INFO_ROUTE_SEARCHER_TITLE; ?></font></h3>

</section>
		

		
					


		<section class="contact">
			<div class="container">
			
<ul class="accordion accordion-1">
	<li class="active">
		<div class="accordion__title">
			<span class="h5"><?php echo DEPARTURE_SEARCHER; ?></span>
		</div>
		<div class="accordion__content">
		<div class="container">
			<form action="./index_user.php?page=buscarvuelo" method="post" id="1">
  <input type="text" class="form-control" name="departure" maxlength="4" id="1" placeholder="<?php echo ICAO_DEPARTURE; ?>"><br><br>
  <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo SEARCH_BOTTON;?>">
</form>	
</div>
		</div>
	</li>
	<li>
		<div class="accordion__title">
			<span class="h5"><?php echo ARRIVAL_SEARCHER; ?></span>
		</div>
		<div class="accordion__content">
<div class="container">
		<form action="./index_user.php?page=buscarvuelo" method="post" id="2">
  <input type="text" class="form-control" name="arrival" maxlength="4" id="2" placeholder="<?php echo ICAO_ARRIVAL; ?>" ><br><br>
  <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo SEARCH_BOTTON;?>">
</form>	
</div>
		</div>
	</li>
	<li>
		<div class="accordion__title">
			<span class="h5"> <?php echo DEP_ARR_SEARCHER; ?></span>
		</div>
		<div class="accordion__content">
<div class="container">
		<form action="./index_user.php?page=buscarvuelo" method="post" id="3">
  <input type="text" class="form-control" name="departure1" maxlength="4" id="3" placeholder="<?php echo ICAO_DEPARTURE; ?>"><br><br>
  <input type="text" class="form-control" name="arrival1" maxlength="4" id="3" placeholder="<?php echo ICAO_ARRIVAL; ?>"><br><br>
  <input type="submit" class="btn btn-primary btn-lg btn-block" value="<?php echo SEARCH_BOTTON;?>">
</form>	
</div>
		</div>
	</li>
</ul>	
			



			

</section>
</section>











