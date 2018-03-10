
<?php
include('./db_login.php');
	include('./icaodd.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	
	
	



?>

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo PROCESS_TRAVEL; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"> <?php echo INFO_PROCESS_TRAVEL;?></font></h3>

</section>




		<section class="contact">
			<div class="container">
	
<hr>
<br>



<style>


.tg  {border-collapse:collapse;border-spacing:0;
border-radius: 10px 10px 0px 0px;
-moz-border-radius: 10px 10px 0px 0px;
-webkit-border-radius: 10px 10px 0px 0px;
border: 0px solid #000000;
}



#caja {
background-color: #2d3b45;
height: 40px;
/*para Firefox*/
-moz-border-radius: 15px 15px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 15px 15px 0px 0px;
/* para Opera */
border-radius: 15px 15px 0px 0px;
padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 15px;
    padding-left: 20px;
}

#caja1 {
background-color: #f16836;

height: 5px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}

#caja2 {
background-color: #2d3b45;
padding: 10px;
height: 85px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}


#caja3 {
background-color: #f16836;
height: 40px;
/*para Firefox*/
-moz-border-radius: 0px 0px 15px 15px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 15px 15px;
/* para Opera */
border-radius: 0px 0px 15px 15px;
}


#caja4 {
background-color: #f69533;
height: 5px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}




#caja8 {
background-color: #d1d2d4;
height: 100px;
/*para Firefox*/
-moz-border-radius: 0px 0px 0px 0px;
/*para Safari y Chrome*/
-webkit-border-radius: 0px 0px 0px 0px;
/* para Opera */
border-radius: 0px 0px 0px 0px;
}
</style>		


  	
   
       				<div class="tg" >
                        <div class="panel-heading" id="caja">
                            <strong style="font-size: 26px;color: white;"><i class="fa fa-barcode fa-fw"></i> <?php echo TICKET_INFO; ?> <span class="pull-right"><i class="fa fa-plane fa-fw"></i>CST System</span></strong>
                        </div>
						<div  id="caja1">
</div>
                        <div class="panel-body" style="background-color:#F2F2F2;padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 15px;
    padding-left: 20px;">
			<center>
			
				<form class="form-horizontal" id="change-location-form" action="./index_user.php?page=trasladoinst"
				      role="form" method="post">
					  
					  <h1><em><?php echo BUY_TICKET; ?></em></h1>
					  <h2><b><?php echo PIREP_DEPARTURE; ?>:</b> <?php echo $location; ?></h2>
					  <h3><b><?php echo PIREP_ARRIVAL; ?>:</b> <div class="input-select"><select class="form-control" name="comboicao" id="comboicao" style=" width:100%" ><?php echo $comboicao; ?></select></div></h3>
                      <hr>
					  <button type="submit"  class="btn btn-block btn-success"><?php echo BUY_A_TICKET; ?>.</button>
					  <br>	
				</form>
			
	</center>
			 </div>
						

					<div  id="caja4">
</div>

<div  id="caja3">
</div>		
		
							
                    </div>
                
				
				
	
</div>

</section>