
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
		
	

    <section class="contact_2">
     <div class="container">
       <br>
	   <br>
		<h1><?php echo CONSULT_PLACE; ?></h1>
		<hr>
		<p><?php echo DETAIL_CONSULT_PLACE; ?></p>
        <hr>
                            <form action="./?page=infostatusexamen" method="post">
                                <div class="col-sm-12">
                                    <h5><?php echo YOUR_VID_EXAM; ?>:</h5>
                                    <input type="number" name="vid_test" placeholder="123456" class="validate-required" />
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo CONSULT_EXAM; ?></button>
                                </div>
                            </form>
          
		</div>
    </section>


