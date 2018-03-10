<?php

	include('./opedd.php');	
		 
		
	$sql = "select * from config_examen where id=1";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
		$informacions = $row['descripcion'];
	$i2 = $row['limite'];
		}		
		
		
		
	$informacion = str_replace(".", ".<br><br>", $informacions);
		
		
		
	
		
		?>
	


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
	<h3><font color="white"><?php echo DETAIL_TEST_CENTER; ?></font></h3>

</section>

	

			
		<section class="contact">
			<div class="container">

			
			<?php
			  if ($admisiones == 1){
            ?>
			<h3><?php echo INFORMATION_CENTER; ?> <?php echo $title; ?></h3>
			<hr>
			<p> <?php echo ONE_INFO_CENTER; ?> <?php echo $i2; ?> <?php echo TWO_INFO_CENTER; ?> <?php echo $duracion; ?> <?php echo THREE_INFO_CENTER; ?></p>
			<br>
			<p><?php echo AGREE_INFO_CENTER; ?></p>
		
		<div class="col-md-12  col-sm-7">
                            <form method="POST" action="./?page=iniciarexamen">
                                <div class="col-sm-6">
                                    <label><?php echo YOUR_NAME_CENTER; ?>:</label>
                                    <input type="text" name="nombres" placeholder="<?php echo INFO_YOUR_NAME_CENTER; ?>" required />
                                </div>
								<div class="col-sm-6">
                                    <label><?php echo YOUR_LASTNAME_CENTER; ?>:</label>
                                    <input type="text" name="apellidos" placeholder="<?php echo INFO_YOUR_LASTNAME_CENTER; ?>" required />
                                </div>
                                <div class="col-sm-6">
                                    <label><?php echo EMAIL_CENTER; ?>:</label>
                                    <input type="email" name="correo" placeholder="<?php echo INFO_EMAIL_CENTER; ?>" required />
                                </div>
                                <div class="col-sm-12">
                                    <label>VID IVAO:</label>
                                    <input type="text" name="vid" placeholder="VID IVAO" required />
                                </div>
								<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="agree" id="agree" required >
										<option value="" disabled selected hidden><?php echo AGREE_ONE_CENTER; ?>
                                        <a href="#"><?php echo AGREE_TWO_CENTER; ?></a></option>
										    <option value="1">SI</option>
										    <option value="0">NO</option>
                                        </select>
                                    </div>
                                </div>
								<div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="operator_id" id="operator_id" required >
										    <option value="" disabled selected hidden><?php echo REGISTER_AIRLINE; ?></option>
											<?php echo $combooperador_id; ?>
                                        </select>
                                    </div>
                                </div>
								
                                <div class="col-sm-12">
                                    <div class="input-select">
                                        <select name="rangoivao" id="rangoivao" required >
										    <option value="" disabled selected hidden><?php echo RANK; ?> IVAO</option>
										    <option value="FS1">FS1</option>
										    <option value="FS2">FS2</option>
                                            <option value="FS3">FS3</option>
                                            <option value="PP">PP</option>
											<option value="SPP">SPP</option>
											<option value="CP">CP</option>
											<option value="ATP">ATP</option>
											<option value="SFI">SFI</option>
											<option value="CFI">CFI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo START_TEST; ?></button>
                                </div>
                            </form>
                        </div>
		
<?php 

	
		
	} else
		
	
	{
		echo '<h3>' . INFORMATION_CENTER . '</h3><hr>';
		echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . CLOSED_TEST . '</span>
                                </div>
                            </div>';
	}
	
	?>

</div>
<div class="clear"></div>
<br>
</section>
</section>