

<?php
	// Execute SQL query
	$sql = 'select * from productos order by price desc';
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}


?>	

<?php
 $cuenta=0;
					
					while ($row = $result->fetch_assoc()) {
                                         
						$cuenta ++;
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
    
	<h1><font color="white"><?php echo STORE_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo INFO_STORE_TITLE; ?></font></h3>

</section>



			

	
	
	 <section class="cover cover-features imagebg" data-overlay="7">
                <div class="background-image-holder">
                    <img alt="background" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 col-md-7">
						<br>
                            <h1>
                                +<?php echo $cuenta; ?> <?php echo AVAILABLE_PRODUCTS; ?>
                            </h1>
                           
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                       
                      
		

<?php 

// Execute SQL query
	$sql1 = 'select * from productos order by price asc';
	if (!$result1 = $db->query($sql1)) {
		die('There was an error running the query  [' . $db->error . ']');
	}


while ($row1 = $result1->fetch_assoc()) {
                                         
			$caracteres = Array(","); 
$resultado = str_replace($caracteres,"",$money); 			
					
					?>
	
	
                         <div class="col-sm-4">
						     
                            <div class="feature feature--featured feature-1 boxed boxed--border" data-overlay="5">
							<div class="background-image-holder">
                                <img alt="background" src="<?php echo $row1["imagen"]; ?>" />
                            </div>
   <font color="white"><span class="h1"><span class="pricing__dollar">$</span><?php echo $row1["price"]; ?></span></font>
    <h6>
		<b><?php echo TYPE_PRODUCT; ?>:</b> <?php echo $row1["type"]; ?><br>
		<b><?php echo COMPATIBILITY_PRODUCT; ?>:</b> <?php echo $row1["simulador"]; ?>
	</h6>
	<hr>
                                <?php 
						$vares = $row1["id"];
						// Execute SQL query
	$sql2 = "select * from compras_tienda where gvauser_id='$id' and producto_id='$vares'";
	if (!$result2 = $db->query($sql2)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
$ii = 0;

while ($row2 = $result2->fetch_assoc()) {
	
		?>
		
		<a class="btn btn--primary-1" href="<?php echo $row1["link"]; ?>">
		<span class="btn__text">
			<?php echo DOWNLOAD_PRODUCT; ?>
		</span>
	</a>
	
	<?php
						$ii = 1;
						
						
}	


			
						
					 if ($row1["price"] <= $resultado && $ii==0) { ?>
				
						
	<a class="btn btn--primary-1" href="./index_user.php?page=comprar&producto_id=<?php echo $row1["id"]; ?>&gvauser_id=<?php echo $id; ?>&name=<?php echo $row1["producto"]; ?>&price=<?php echo $row1["price"]; ?>">
		<span class="btn__text">
			<?php echo BUY_DOWNLOAD_PRODUCT; ?>
		</span>
	</a>
						
						<?php } else if ($row1["price"] > $resultado && $ii==0) {
							
					    echo '<a class="btn btn--icon bg--pinterest" href="#">
	                          	<span class="btn__text">
			                           ' . NO_MONEY . '
		                         </span>
	                         </a>';
						} ?>
                                <span class="label"><?php echo $row1["producto"]; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                


	

			
	<?php } ?>
              
        
		    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>

	
		
			
			