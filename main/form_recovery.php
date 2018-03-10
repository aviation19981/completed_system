  

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo LOGIN_VA; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_LOGIN_VA; ?></font></h3>
    <br>
</section>

  <section class="height-100 imagebg text-center" data-overlay="7">
   <div class="background-image-holder">
                <img alt="background" src="<?php  picture(); ?>" />
            </div>
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-sm-7 col-md-5">
                            <br>
                    <form action="./?page=password_reset" method="post">
					   <div class="col-sm-12">
						<h3>CALLSIGN</h3>
							<div class="input-icon">
	                            <i class="material-icons color--black">airplanemode_active</i>
	                            <input type="text"  name="callsign" id="callsign" placeholder="CALLSIGN" required />
                            </div>
						</div>
						<div class="col-sm-12">
							<h3><?php echo REGISTER_BIRTHDAY; ?></h3>
							<div class="input-icon">
	                            <i class="material-icons color--black">perm_contact_calendar</i>
	                            <input type="date"  name="birthdate" id="birthdate" placeholder="<?php echo REGISTER_BIRTHDAY; ?>" required />
                            </div>
						</div>
						<div class="col-sm-12">
						<h3><?php echo EMAIL_RECOVER; ?></h3>
							<div class="input-icon">
	                            <i class="material-icons color--black">email</i>
	                            <input type="email"  name="email" placeholder="EMAIL@DOMINIO.COM" required />
                            </div>
						</div>
						
                                <button class="btn btn--primary type--uppercase" type="submit"><?php echo RECOVERY; ?></button>
                    </form>
                            <span class="type--fine-print block"><?php echo NO_ACCOUNT; ?>
                                <a href="./?page=admisiones"><?php echo MAKE_PROCESS; ?></a>
                            </span>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>