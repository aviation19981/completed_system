
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
				<center>
                    <div class="row">
                        <div class="col-sm-7 col-md-5">
                            <br>
                            <form action="./login.php"  method="post">
                                <div class="row">
                                    <div class="col-sm-12">
									<!-- onclick="this.value='CST'" -->
                                        <input type="text"  name="user"  placeholder="<?php echo CALLSING_TYPE; ?>" required />
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="password" name="password" placeholder="<?php echo PASSWORD_TYPE; ?>" required />
                                    </div>
                                    <div class="col-sm-12">
                                        <button class="btn btn--primary type--uppercase" type="submit">Login</button>
                                    </div>
                                </div>
                                <!--end of row-->
                            </form>
                            <span class="type--fine-print block"><?php echo NO_ACCOUNT; ?>
                                <a href="./?page=admisiones"><?php echo MAKE_PROCESS; ?></a>
                            </span>
                            <span class="type--fine-print block"><?php echo FORGET_PASSWORD; ?>
                                <a href="./?page=form_recovery"><?php echo MAKE_RECOVERY; ?></a>
                            </span>
                        </div>
                    </div>
                    <!--end of row-->
					</center>
                </div>
                <!--end of container-->
            </section>