
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_ADMISSIONS; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_ADMISSIONS; ?></font></h3>

</section>
		
			 <section class="about">
                <div class="container">
                       
                                <h1><?php echo INTRODUCTION_WIZARD; ?></h1>
								<hr>
                                    <div class="sixteen columns">
                                        <h4><?php echo GREETING_WIZARD; ?>
										<br><?php echo PART_WIZARD; ?> <em><?php echo FAMILY_WIZARD; ?></em></h4>
										<hr>
									
                                        <h4 style="text-align:left;"><?php echo PHASES_WIZARD; ?>
										<li><b>80%</b> <?php echo TEST_WIZARD; ?></li>
										<li><b>20%</b> <?php echo INTERVIEW_WIZARD; ?></li>
										</h4>
									</div>
                                    
                                <h1><?php echo REQUIREMENTS_WIZARD; ?></h1>
								<br>
								<br>
								<hr>
                                <section class="text-left">
                                    <div class="pos-vertical-center">
                                        <h4 style="text-align:left;">
										
<li><?php echo ONE_WIZARD; ?></li>
<li><?php echo TWO_WIZARD; ?></li>
<li><?php echo THREE_WIZARD; ?></li>
<li><?php echo FOUR_WIZARD; ?></li>
<li><?php echo FIVE_WIZARD; ?></li>
<li><?php echo SIX_WIZARD; ?></li>
<li><?php echo SEVEN_WIZARD; ?></li>
<li><?php echo EIGHT_WIZARD; ?></li>

										</h4>
                                    </div>
                                </section>
								<br>
								<h1><?php echo START_WIZARD; ?></h1>
								<br>
								<br>
								<hr>
                                <section class="text-center">
                                    <div class="pos-vertical-center">
									<br>
									<h4><?php echo INFO_START_WIZARD; ?></h4>
									<br>
									<hr>
									<p><?php echo DETAIL_START_WIZARD; ?></p>
									<br>
                                        <?php
					
if ($admisiones == 1) {
		echo '<center>';
		echo '<a class="btn btn--primary btn--icon" href="./?page=prueba">
                <span class="btn__text"><i class="icon flaticon-pilot"></i>' . AGREE_WIZARD . '</span>
              </a>';
		echo '<a class="btn btn--primary btn--icon" href="./">
                <span class="btn__text"><i class="icon flaticon-security"></i>' . DISAGREE_WIZARD . '</span>
              </a>';
		echo '</center>';
		
	} else {
		
		echo '<div class="alert bg-error">
                  <div class="alert__body">
                    <span>' . CLOSED_WIZARD . '</span>
                  </div>
              </div>';
		
	}
	?>
	                               <br>
								   <br>
	                               <h4><?php echo INVITATION_WIZARD; ?></h4>
								   <hr>
								   <p><?php echo INFO_INVITATION; ?></p>
								   <br>
								   <form action="./?page=invitacion" method="post">
								     <div class="input-icon col-sm-7">
                                      <input type="password" name="invitation_code" placeholder="<?php echo PASSWORD_WIZARD; ?>" />
                                     </div>
									 
									 <div class="col-sm-5">
                                        <button type="submit" class="btn btn--primary"><?php echo START_PROCESS; ?></button>
                                     </div>

                                    </form>
	
	
                                    </div>
                                </section>
                       
                        </div>
                   
                    <!--end of row-->
           
                <!--end of container-->
            </section>
			
			