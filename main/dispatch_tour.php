		<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo DISPATCH_TOUR_CST_TITLE; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white">  <?php echo DISPATCH_TOUR_CST_INFO; ?></font></h3>

</section>
		



			

			
			
			
			<section class="imagebg text-center" data-overlay="4">
                <div class="background-image-holder">
                    <img alt="image" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-7">
						<br>
                            <h1>
                                <?php echo DISPATCH_TOUR_CST_TITLE_SECOND; ?>
                            </h1>
							<hr>
							<br>
                        </div>
                    </div>
					
					
			<?php
	$dep = $_GET['departure'];
	$arr = $_GET['arrival'];
	$rut = $_GET['route'];
	
	include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	$sql = "select plane_icao from fleettypes";
	
	if (!$result = $db->query($sql)) {
		die('There was an error running the query  [' . $db->error . ']');
	}
?>






<form id="sbapiform">
		
					
					 <!--end of row-->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DISPATCH_TOUR_CST_DEP; ?></h5>
                                <p>
                                    <input name="orig" size="5" type="text" placeholder="Su aeropuerto de origen" maxlength="4" value="<?php echo $dep; ?>" >
                                </p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DISPATCH_TOUR_CST_ARR; ?></h5>
                                <p>
                                    <input name="dest" size="5" type="text" placeholder="Su aeropuerto de destino" maxlength="4" value="<?php echo $arr; ?>" >
                                </p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo PLANE_INDEX_USER; ?></h5>
                                <p>
								<div class="input-select">
                                    <select name="type">
		<?php while ($row = $result->fetch_assoc()) {
			
		$plane = $row["plane_icao"];
		
		$texto = strtolower($plane);
		echo '<option value="' . $texto . '">' . $plane . '</option>';
		
		}
			?>
		</select>
		</div>
                                </p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					 <!--end of row-->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo ROUTE_FP; ?></h5>
                                <p>
                                    <textarea name="route" placeholder="Ingrese su ruta de vuelo"><?php echo $rut; ?></textarea>
                                </p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DISPATCH_TOUR_CST_UND; ?></h5>
                                <p><div class="input-select">
                                    <select name="units"><option value="KGS">KGS</option><option value="LBS" selected>LBS</option></select>
                                </div></p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5>Cont Fuel</h5>
                                <p>
								<div class="input-select">
                                    <select name="contpct"><option value="auto" selected>AUTO</option><option value="0">0 PCT</option><option value="0.02">2 PCT</option><option value="0.03">3 PCT</option><option value="0.05">5 PCT</option><option value="0.1">10 PCT</option><option value="0.15">15 PCT</option><option value="0.2">20 PCT</option></select>
		</div>
                                </p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
					
					
					
					
					
					
					
					
					
					<!--end of row-->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DISPATCH_TOUR_CST_RESERVE_FUEL; ?></h5>
                                <p><div class="input-select">
                                    <select name="resvrule"><option value="auto">AUTO</option><option value="0">0 MIN</option><option value="15">15 MIN</option><option value="30">30 MIN</option><option value="45" selected>45 MIN</option><option value="60">60 MIN</option><option value="75">75 MIN</option><option value="90">90 MIN</option></select>
                                </div></p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DISPATCH_TOUR_CST_MAP; ?></h5>
                                <p><div class="input-select">
                                    <select name="maps"><option value="detail">Detailed</option><option value="simple">Simple</option><option value="none">None</option></select>
                                </div></p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-4">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DISPATCH_TOUR_CST_VA; ?></h5>
                                <p>
								<div class="input-select">
                                    <select name="airline" id="airline">
                                            <option selected="" value="Default"><?php echo AIRLINE_CHARTER; ?></option>
											<?php 
    $sql_operator_global ="select * from operators";

	if (!$result_operator_global = $db->query($sql_operator_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator = $result_operator_global->fetch_assoc()) { ?>
                                            <option value="<?php echo $row_operator['callsign']; ?>"><?php echo $row_operator['operator']; ?></option>
    <?php } ?>
                                        </select>
										</div>
                                </p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
					
					
					
					
					 <?php  $today = date("dMy");?>
<input type="hidden" name="date" value="<?php echo $today; ?>"> 



 <?php  $pcs = rand(1, 24); ?><?php  $pcss = rand(1, 59); ?>
<input type="hidden" name="deph" value="<?php echo $pcs; ?>">
<input type="hidden" name="depm" value="<?php echo $pcss; ?>">	


<?php

$sql3 = "SELECT * FROM airports  where ident='$dep'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

	}



$sql4 = "SELECT * FROM airports  where ident='$arr'";

	if (!$result4 = $db->query($sql4)) {

		die('There was an error running the query  [' . $db->error . ']');

	}


while ($row4 = $result4->fetch_assoc()) {

		$latitude_deg_arr = $row4['latitude_deg'];

		$longitude_deg_arr = $row4['longitude_deg'];

	}


    $km = 111.302;
$nms = 0.539957;
    
    //1 Grado = 0.01745329 Radianes    
    $degtorad = 0.01745329;
    
    //1 Radian = 57.29577951 Grados
    $radtodeg = 57.29577951; 
    //La formula que calcula la distancia en grados en una esfera, llamada formula de Harvestine. Para mas informacion hay que mirar en Wikipedia
    //http://es.wikipedia.org/wiki/F%C3%B3rmula_del_Haversine
    $dlong = ($longitude_deg_loc - $longitude_deg_arr); 
    $dvalue = (sin($latitude_deg_loc * $degtorad) * sin(
$latitude_deg_arr * $degtorad)) + (cos($latitude_deg_loc * $degtorad) * cos(
$latitude_deg_arr * $degtorad) * cos($dlong * $degtorad)); 
    $dd = acos($dvalue) * $radtodeg; 
    $kms = round(($dd * $km), 2);



 $dist = $kms;
	$speed = 440;
			$app = $speed / 60 ;
			
			  $distnm = round($kms*$nms);
			
			$flttime = round($distnm / $app,0)+ 20;
			$hours = intval($flttime / 60);
                        $minutes = (($flttime / 60) - $hours) * 60;



if ($hours>9) {

$horasvuelo = $hours;
} else {
$horasvuelo = $hours;
}


if ($minutes>9) {

$minvuelo = $minutes;

} else {

$minvuelo = $minutes;
}




?>


<input type="hidden" name="steh" value="<?php echo $horasvuelo; ?>">
<input type="hidden" name="stem" value="<?php echo $minvuelo; ?>">


<input type="hidden" name="reg" value="N<?php echo rand(152, 985); ?>CS">	

<input type="hidden" name="selcal" value="HK-CS">	

<input type="hidden" name="planformat" value="lido">
					
					

	
	 <!--end of row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
							<h5><?php echo FLIGHT_NUMBER_CHARTER; ?></h5>
                                <p>
								
								<div class="input-icon">
	<i class="material-icons">plane</i>
	<input type="text" name="input" placeholder="Ingrese su numero de vuelo" value="<?php echo $var = rand(150, 850); ?>"/>
</div>
		
								
								
								</p>
                                <span class="label"><?php echo DISPATCH_TOUR_CST_INFORMATION; ?></span>
                   
                            </div>
                            <!--end feature-->
                        </div>
                  
                        <div class="col-sm-6">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
<a class="btn btn--primary btn--icon" onclick="simbriefsubmit('./index_user.php?page=colstardispatch');" style="width:100%" >
	<span class="btn__text"><i class="icon-Plane"></i><?php echo DISPATCH_TOUR_CST_DP; ?></span>
</a>

                            </div>
                            <!--end feature-->
                        </div>
                    </div>
			</form>		
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
			
			
			
		