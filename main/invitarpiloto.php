

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo INVITATION_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_INVITATION_CENTER; ?></font></h3>

</section>

	
		

<section class="content not_found">
			<div class="container">
			<br>
			<br>
<h3><?php echo FIRST_INFO_DETAIL; ?></h3>
<br>
<h4><?php echo SECOND_INFO_DETAIL; ?></h4>
<br>
<br>
		<form id="contact-form" action="./index_user.php?page=newinvited" method="post" class="form-validate form-horizontal">
		
			<h2><?php echo INVITATION_NAME; ?></h2>
			
			<input type="text" name="userName"  class="form-control"  id="jform_contact_name" placeholder="<?php echo NAME_TYPE; ?>" value="" class="required" size="30" required aria-required="true" />
			<br>
			<h2><?php echo INVITATION_SURNAME; ?></h2>
			
			<input type="text" name="usersurName"  class="form-control"  id="jform_contact_name" placeholder="<?php echo SURNAME_TYPE; ?>" value="" class="required" size="30" required aria-required="true" />
			<br>
<br>
<h2><?php echo INVITATION_EMAIL; ?></h2>
			
			<input type="email" name="userEmail" class="form-control" id="jform_contact_email" placeholder="cuenta@dominio.com" value="" size="30" required aria-required="true" />
							
	
	<br>
	<br>
			
																																	<div class="control-group">
															<div class="controls">
																	</div>
													</div>
															<div class="contact-form-submit">
				<input type="submit" class="btn btn-primary btn-lg btn-block form-control" value="<?php echo SEND_INVITATION; ?>" />			</div>
		
	</form>
	
	<br>
	<br>
	<br>
	




<table id="table_list"  class="table table-hover">
																	
                                        <thead>
                                            <tr>
												<th><b>#</b></th>
												<th><b><?php echo NAME_USER_INDEX; ?></b></th>
												<th><b><?php echo EMAIL_USER_INDEX; ?></b></th>
												<th><b><?php echo CODE_USER_INDEX; ?></b></th>
												<th><b><?php echo DATE_USER_INDEX; ?></b></th>
												<th><b><?php echo STATUS_INDEX_USER; ?></b></th>
                                            </tr>
											
                                        </thead>
										 <tbody>
<?php 
	include ('./db_login.php');
	
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
$sql1 = "select * from invitacion";  
		
		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i = 0;
		$notas = 0;
		$invitcont=0;
		while ($row1 = $result1->fetch_assoc()) {
			$i++;
			$invitcont++;
			 
		if ($row1['used'] == 0)
		{
			$usedd= '<div class="alert bg--success">
                                <div class="alert__body">
                                    <span>' . NEW_ONE_INDEX_USER . '</span>
                                </div>
                            </div>';
		} else {
			
			$usedd= '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . OLD_ONE_INDEX_USER . '</span>
                                </div>
                            </div>';
			
		}

echo '<tr>';


										 echo '<td>+' . $i . '</td>';
										 echo '<td>' . $row1['name'] . ' ' . $row1['surname'] . '</td>';
										  echo '<td>' . $row1['email'] . '</td>';
										  echo '<td>' . $row1['pass'] . '</td>';
										   echo '<td>' . $row1['fecha'] . '</td>';
										    echo '<td>' . $usedd  . '</td>';
										echo '</tr>';
										
										
		}
		
		
?>
</tbody>
</table>
<?php if($invitcont==0) {
	echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . NO_INVITATION . '</span>
                                </div>
                            </div>';
} ?>
	
	

</div>
</section>