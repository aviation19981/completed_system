
<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TITLE_CONTACT; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_CONTACT; ?></font></h3>
	

</section>


<!-- CONTACT SECTION
    ================================================== -->
	
	<section class="contact" id="contact">
	
		<div class="container">
			<div class="sixteen columns">
				<h1><?php echo CONTACT_MENU; ?></h1>
			</div>
			<div class="sixteen columns">
				<div class="sub-text-line"></div>
			</div>
			<div class="sixteen columns">
				<div class="sub-text link-svgline"><?php echo REMEMBER_CONTACT; ?></div>
			</div>
			<div class="clear"></div>
			<div class="sixteen columns">
				<h4><?php echo WORKING_CONTACT; ?></h4>
			</div>		
			<div class="clear"></div>
			<form name="ajax-form" id="ajax-form" action="mail-it.php" method="post">
				<div class="eight columns">
					<label for="name"> 
						<span class="error" id="err-name"><?php echo EMAIL_ERROR_ONE; ?></span>
					</label>
					<input name="name" id="name" type="text"   placeholder="<?php echo YOUR_NAME; ?>: *"/>
				</div>
				<div class="eight columns">
					<label for="email"> 
						<span class="error" id="err-email"><?php echo EMAIL_ERROR_TWO; ?></span>
						<span class="error" id="err-emailvld"><?php echo EMAIL_ERROR_THREE; ?></span>
					</label>
					<input name="email" id="email" type="text"  placeholder="<?php echo YOUR_EMAIL; ?>: *"/>
				</div>
				<div class="sixteen columns">
					<select id="list"  name="staff_email" class="form-control" required>
  <option value="" disabled selected hidden><?php echo TO_WHOM_EMAIL; ?></option>
 <?php 
		
 $sql = "select * from config_emails where config_emails_id<>0";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
while ($row = $result->fetch_assoc()) {
	
		$staff = $row["staff"];
	
	$sql_pca = "select * from gvausers where gvauser_id='$staff'";
	if (!$result_pca = $db->query($sql_pca)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	while ($row_pca = $result_pca->fetch_assoc()) {
		$name_staff = $row_pca['name'] . ' ' . $row_pca['surname'];
	}
		
		echo '<option value="' . $row["staff_email"] . '">[' . $row["cargo"] . '] ' . $name_staff  . '</option>';
} 

?>
</select>
				</div>
				<div class="sixteen columns">
					<label for="message"></label>
					<textarea name="message" id="message" placeholder="<?php echo MESSAGE_EMAIL; ?>" required></textarea>
				</div>
				<div class="sixteen columns">
					<div id="button-con"><button class="send_message" id="send"><span data-hover="<?php echo SEND_EMAIL; ?>"><?php echo SEND_EMAIL; ?></span></button></div>
				</div>
				<div class="clear"></div>	
				<div class="error text-align-center" id="err-form"><?php echo EMAIL_ERROR_FOUR; ?></div>
				<div class="error text-align-center" id="err-timedout"><?php echo EMAIL_ERROR_FIVE; ?></div>
				<div class="error" id="err-state"></div>
			</form>	
			<div class="clear"></div>
			<div id="ajaxsuccess"><?php echo EMAIL_ERROR_SIX; ?></div>	
		</div>
		
		<div class="clear"></div>

	<br>
	</section>	
	
	