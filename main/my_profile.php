<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo MY_PROFILE_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_MY_PROFILE_TITLE; ?></font></h3>

</section>


			
			 <section class="space--xs imageblock switchable feature-large  bg--dark">
                                
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-7">
										<br>
                                            <h2><?php echo HOLD_YOUR_ACCOUNT; ?></h2>
                                            <hr class="short">
											<?php 
	require_once('./hubdd.php');
	require_once('./opedd.php');
	require_once('./countriesdduser.php');
	require_once('./languagesdd.php');
	$sql = " select * from gvausers where gvauser_id='$id'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row = $result->fetch_assoc()) {
	
?>	
                                            <form enctype="multipart/form-data" action="./index_user.php?page=updateprofile" method="post" >
                                                <div class="row">
												    <div class="col-xs-12">
                                                        <input name="image_file" class="form-control" type="file" id="image_file" placeholder="<?php echo ONE_PROFILE; ?>">
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <input type="text" name="name" placeholder="<?php echo TWO_PROFILE; ?>" value="<?php echo $row["name"]; ?>" required />
                                                    </div>
													<div class="col-xs-12">
                                                        <input type="text" name="surname" placeholder="<?php echo THREE_PROFILE; ?>" value="<?php echo $row["surname"]; ?>" required />
                                                    </div>
													<div class="col-xs-12">
                                                        <input type="text" name="ivao" placeholder="<?php echo FOUR_PROFILE; ?>" value="<?php echo $row["ivaovid"]; ?>" required />
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <input type="email" name="email" placeholder="<?php echo FIVE_PROFILE; ?>" value="<?php echo $row["email"]; ?>" required />
                                                    </div>
													<div class="col-xs-12">
                                                        <input type="facebook" name="facebook" placeholder="<?php echo FACEBOOKTITLE; ?> => https://www.facebook.com/nickname" value="<?php echo $row["facebook"]; ?>"/>
                                                    </div>
													<div class="col-xs-12">
													 <div class="input-select">
                                                        <select name="language" id="language" selected="<?php echo $row["language"]; ?>" required >
									                         <?php echo $combolanguage; ?>
								                        </select>
													 </div>
                                                    </div>
													<div class="col-xs-12">
													 <div class="input-select">
                                                        <select name="country" id="country" selected="<?php echo $row["country"]; ?>" required >
									                         <?php echo $combocountry; ?>
								                        </select>
													 </div>
                                                    </div>
													<div class="col-xs-12">
													  <input type="text" name="city" placeholder="<?php echo SIX_PROFILE; ?>" value="<?php echo $row["city"]; ?>" required />
                                                    </div>
													<div class="col-xs-12">
													 <div class="input-select">
                                                        <select name="hub" id="hub" selected="<?php echo $row["hub_id"]; ?>" required >
									                         <?php echo $combohub_id; ?>
								                        </select>
													 </div>
                                                    </div>
													<div class="col-xs-12">
													 <div class="input-select">
                                                        <select name="operator" id="operator" selected="<?php echo $row["operator_id"]; ?>" required >
									                         <?php echo $combooperador_id; ?>
								                        </select>
													 </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <input type="password" name="password" placeholder="<?php echo SEVEN_PROFILE; ?>" required />
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <input type="password" name="password_confirm" placeholder="<?php echo EIGHT_PROFILE; ?>" required />
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <div class="input-checkbox">
                                                            <input type="checkbox" name="accept_emails" value="1" <?php if($row["accept_emails"]==1) { echo "checked='checked'"; } ?>/>
                                                            <label></label>
                                                        </div>
                                                        <span><?php echo AGREE_PROFILE; ?></span>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <button type="submit" class="btn btn--primary"><?php echo UPDATE_PROFILE; ?></button>
                                                    </div>
                                                    <hr />
                                                </div>
                                                <!--end row-->
                                            </form>
	<?php } ?>
                                        </div>
                                    </div>
                                    <!--end of row-->
                                </div>
                                <!--end of container-->
                            </section>
							
							

<section class="contact">
                <div class="container">
                 
		
<h1><?php echo OPTIONES_PROFILE; ?></h1>
<hr>
                         <div class="col-sm-12">
						 <center>
						 <h5>
						 <?php if($activation==0) { ?>
							<a class="btn btn--lg btn--primary-2" href="./index_user.php?page=user_out">
                                <span class="btn__text">
                                    <i class="icon-Remove"></i> <?php echo GO_AWAY_PROFILE; ?></span>
                            </a>
						 <?php } else if ($activation==1) { ?>
						    <a class="btn btn--lg btn--primary" href="./index_user.php?page=vacations&pilotid=<?php echo $id; ?>">
                                <span class="btn__text">
                                    <i class="icon-Plane"></i> <?php echo ON_VACATIONS_PROFILE; ?></span>
                            </a>
                            <a class="btn btn--lg btn--primary-1" href="./index_user.php?page=inactive&pilotid=<?php echo $id; ?>">
                                <span class="btn__text">
                                    <i class="icon-User"></i> <?php echo INACTIVATE_ACCOUNT_PROFILE; ?></span>
                            </a>
							<a class="btn btn--lg btn--primary-2" href="./index_user.php?page=user_out">
                                <span class="btn__text">
                                    <i class="icon-Remove"></i> <?php echo GO_AWAY_PROFILE; ?></span>
                            </a>
						 <?php } else if ($activation==2) { ?>
						    <a class="btn btn--lg btn--primary" href="./index_user.php?page=vacations&pilotid=<?php echo $id; ?>">
                                <span class="btn__text">
                                    <i class="icon-Plane"></i> <?php echo ON_VACATIONS_PROFILE; ?></span>
                            </a>
						     <a class="btn btn--lg btn--primary-2" href="./index_user.php?page=user_out">
                                <span class="btn__text">
                                    <i class="icon-Remove"></i> <?php echo GO_AWAY_PROFILE; ?></span>
                            </a>
						 <?php } else if ($activation==4) { ?>
						     <a class="btn btn--lg btn--primary-2" href="./index_user.php?page=user_out">
                                <span class="btn__text">
                                    <i class="icon-Remove"></i> <?php echo GO_AWAY_PROFILE; ?></span>
                            </a>
						 <?php } ?>
						</h5>
						</center>
                        </div>
				</div>

<br>
<br>

</section>