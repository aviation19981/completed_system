<?php
session_start();
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
	
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "https://" . $host;


$idiomaurl2 = str_replace ("&lang=es","",$url);
$idiomaurl = str_replace ("&lang=en","",$idiomaurl2);
	
	
include("captcha/simple-php-captcha.php");
	$_SESSION['captcha'] = simple_php_captcha();
	
    if (isset($_GET['lang'])) {
		$_SESSION['language'] = $_GET['lang'];
	} elseif (!isset($_SESSION['language'])) {
		$_SESSION['language'] = "es";
	}
	
		
	
 	if (isset($_SESSION['id'])) {
		$user_logged = 1;
	} else {
		$user_logged = 0;


	}
	
    include("./languages/lang_" . $_SESSION['language'] . ".php");
    include('./db_login.php');
	include('./info_online.php');
	include('./languagesdd.php');
	include('./classes/security.php');
	include('./va_parameters.php');
	include('./review_rank.php');
	include('./get_va_data.php');
    include('./hangar_review.php');
	include('./review_reserves.php');
    include('./review_test.php');
    include('./review_invite.php');
    include('./review_class.php');
	include('./report_pilot_activity.php');
    $secure = new SECURITY();
	$secure->parse_incoming();
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	$icao_va = array();
	$sql_operator_global_first ="select * from operators order by operator asc";

	if (!$result_operator_global_first = $db->query($sql_operator_global_first)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_first = $result_operator_global_first->fetch_assoc()) {
		$icao_va[]= $row_operator_first["callsign"];
	}
	
	
	/////////////////////////////////////// EMAIL STAFF

		   $sqlemail = 'select * from config_emails where config_emails_id=0';
			if (!$result2email = $db->query($sqlemail)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row2email = $result2email->fetch_assoc()) {
               $staff_email  = $row2email["staff_email"];
			}

/////////////////////////////////////// END EMAIL STAFF		




function picture() {
   global $operator_id_session,$db;
 
   $i=0;
   
	
	$sql_pic = "SELECT * FROM gallery_operators ORDER BY RAND() LIMIT 1";
	if (!$result_pic = $db->query($sql_pic)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($row_pic = $result_pic->fetch_assoc()) {
	    $imagen_fondo = $row_pic['img_operator'];
		$i++;
    }
	
	if($i==0) {
		echo "./images/fondos/" . rand(1,10) . ".jpg";
	} else {
	   echo  "./../admin/images/portada/" . $imagen_fondo;
	}
	
	

	}



?>



<!doctype html>
<html lang="es">
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>ColStar Alliance</title>
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Alianza virtual certificada por IVAO World y la división Colombiana.">
	<meta name="author" content="Andres Zapata">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	
	
	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="css/base.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/skeleton.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/layout.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/settings.css" />
	<link rel="stylesheet" type="text/css" media="all" href="css/owl.carousel.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/retina.css"/>
	<link rel="stylesheet" type="text/css" href="css/colors/color-blue.css" title="blue">
    <link rel="stylesheet" href="css/font-awesome.css">
	


	<!--<link rel="alternate stylesheet" type="text/css" href="css/colors/color-orange.css" title="orange">
    <link rel="alternate stylesheet" type="text/css" href="css/colors/color-green.css" title="green">
    <link rel="alternate stylesheet" type="text/css" href="css/colors/color-red.css" title="red">
    <link rel="alternate stylesheet" type="text/css" href="css/colors/color-yellow.css" title="yellow">	-->
		
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="./images/favicon.ico">
	

	
	
	<!-- New
	================================================== -->
	
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/socicon.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/flickity.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/iconsmind.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/planeicon.css" rel="stylesheet" type="text/css" media="all" />
	
	
	<!-- New
	================================================== -->
	
	
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script src="Charts/Chart.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css"/>
	<script src="js/bootstrapValidator.min.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="js/moment-with-locales.js"></script>
	<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/jquery.confirm.min.js" type="text/javascript"></script>
	<!-- Custom styles for this template -->
	<link href="css/morris.css" rel="stylesheet">
	<!-- data tables plugins -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/numeric-comma.js"></script>
	<script src="js/raphael.min.js" type="text/javascript"></script>
	<script src="js/morris.min.js" type="text/javascript"></script>

	
	
	</head>

<body>	
	<!-- Primary Page Layout
	================================================== -->

	
	
	<!-- MENU
    ================================================== -->	

			<nav id="menu-wrap" class="menu-back cbp-af-header">
			<div class="container">
				<div class="sixteen columns">
					<div class="logo"></div>
					<ul class="slimmenu">
						<li> 
							<a href="./" data-ps2id-offset="100"><?php echo HOME_MENU; ?></a>
						</li>
						<li><a class="dropdown-toggle"><?php echo ABOUT_MENU; ?></a>
						   <ul role="menu" class="dropdown-menu">
                                                                <li class="dropdown-toggle" aria-haspopup="true"> <a href="./?page=staff"><?php echo STAFF_MENU; ?></a> </li>
                                                                <li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=rules"><?php echo RULE_MENU; ?></a> </li>
                                                                <li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=statistics"><?php echo STATS_MENU; ?></a> </li>
																<li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=routes"><?php echo ROUTE_MENU; ?></a> </li>
																<li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=hubs"><?php echo HUBS_MENU; ?></a> </li>
																<li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=airplanes_public"><?php echo PLANE_MENU; ?></a> </li>
																<li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=alliance_balance"><?php echo MONEY_MENU; ?></a> </li>
                                                                <li class="dropdown-toggle" aria-haspopup="true">  <a href="./?page=contact"><?php echo CONTACT_MENU; ?></a> </li>
						   </ul>
                        </li>
						
						<li><a class="dropdown-toggle" aria-haspopup="true"><?php echo ADMISSION_MENU; ?></a>
						   <ul role="menu" class="dropdown-menu">
                                                                        <li> <a href="./?page=admisiones"><?php echo TEST_MENU; ?></a> </li>
                                                                        <li> <a href="./?page=ranks"><?php echo RANKS_MENU; ?></a> </li>
                                                                        <li> <a href="./?page=searchexamen"><?php echo EXAM_MENU; ?></a> </li>
						   </ul>
                        </li>
						
						<li>
							<a href="./?page=pilots"><?php echo PILOT_MENU; ?></a>
						</li>
						<?php if ($vuelosactivos>0) { ?>
											<li> <a href="./alliance_map_live.php">Online</a> </li>
						<?php } ?>
						
						
						
						<?php if ($user_logged==0) { ?>
						<li>
							<a href="./?page=form_login"><?php echo LOGIN_MENU; ?></a>
						</li>
                                                       
													<?php } else { ?>
														
                        <li>
							<a href="./index_user.php"><?php echo SYSTEM_VA; ?></a>
						</li>
														
													<?php } 
													
													?>
													
													
						<li><a class="dropdown-toggle"><img alt="Image" class="flag" src="images/languagues/<?php echo strtoupper ($_SESSION['language']); ?>.png" width="25%"></a>
						   <ul role="menu" class="dropdown-menu">
                              <?php 
										                                        	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
																						if($_SESSION['language']=="es") {
																				   ?>
                                                                                    <li>
                                                                                        <a href="./?lang=en"><img alt="Image" class="flag" src="images/languagues/EN.png" width="20%"> ENG</a>
                                                                                    </li>
																					<?php }  else if($_SESSION['language']=="en") { 
																					
																					?>
                                                                                    <li>
                                                                                        <a href="./?lang=es"><img alt="Image" class="flag" src="images/languagues/ES.png" width="20%"> ESP</a>
                                                                                    </li>
																					<?php
																					
																					
																					   }
																					
																					} else {
																						
																						
																						if($_SESSION['language']=="es") {
																				   ?>
                                                                                    <li>
                                                                                        <a href="<?php echo $idiomaurl; ?>&lang=en"><img alt="Image" class="flag" src="images/languagues/EN.png" width="20%"> ENG</a>
                                                                                    </li>
																					<?php }  else if($_SESSION['language']=="en") { 
																					
																					?>
                                                                                    <li>
                                                                                        <a href="<?php echo $idiomaurl; ?>&lang=es"><img alt="Image" class="flag" src="images/languagues/ES.png" width="20%"> ESP</a>
                                                                                    </li>
																					<?php
																					
																					
																					   }
																						
																						
																					}
																					
																					
																					?>
						   </ul>
                        </li>
					</ul>
				</div>
			</div>
		</nav>	


	
		<?php 
					if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
                 ?>
	
	<!-- HOME SECTION
    ================================================== -->



			<section class="home" id="home">	
				
				<div class="tp-banner-container">
				
    
					<div class="tp-banner" >				
						<ul>
							<!-- THE FIRST SLIDE -->
							
							<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo PASSION_TITLE; ?>">
								<img src="<?php  picture(); ?>" alt=""  />
								<div class="just_pattern_parallax"></div>
								
								
								<!-- THE CAPTIONS IN THIS SLIDE -->
								<div class="caption small-text lft ltt tp-resizeme"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="600" 
									 data-start="300" 
									 data-easing="Elastic.easeOut" style="z-index: 200;">
									<div class="top-text"><?php echo PASSION_ONE; ?></div>	
								</div>	
								<div class="caption big-text lft ltt tp-resizeme"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="700" 
									 data-start="700" 
									 data-easing="easeOutExpo" style="z-index: 200;">
									<div class="big-text"><?php echo PASSION_TWO; ?> <span><?php echo PASSION_THREE; ?></span></div>	
								</div>	
								<div class="caption small-text lft ltt"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="700" 
									 data-start="1300" 
									 data-easing="Elastic.easeOut" style="z-index: 200;">
									<div class="cl-effect"><a href="./?page=admisiones" data-gal="m_PageScroll2id" data-ps2id-offset="65"><span data-hover="<?php echo JOIN_MENU; ?>"><?php echo JOIN_MENU; ?></span></a></div>
								</div>	
							</li>	
							
							<!-- THE SECOND SLIDE -->
							
							<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo LOVE_TITLE; ?>">
								<img src="<?php  picture(); ?>" alt="" />
								<div class="just_pattern_parallax"></div>
								
								
								<div class="caption small-text lft ltt tp-resizeme"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="600" 
									 data-start="300" 
									 data-easing="Elastic.easeOut" style="z-index: 200;">
									<div class="top-text"><?php echo LOVE_ONE; ?></div>	
								</div>
								<div class="caption big-text lft ltt tp-resizeme"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="700" 
									 data-start="700" 
									 data-easing="easeOutExpo" style="z-index: 200;">
									 <div class="big-text"><?php echo LOVE_TWO; ?> <span><?php echo LOVE_THREE; ?></span> <?php echo LOVE_FOUR; ?></div>
								</div>
								<div class="caption small-text lft ltt"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="700" 
									 data-start="1300" 
									 data-easing="Elastic.easeOut" style="z-index: 200;">
									<div class="cl-effect"><a href="./?page=admisiones" data-gal="m_PageScroll2id" data-ps2id-offset="65"><span data-hover="<?php echo DISCOVER_BUTTON; ?>"><?php echo DISCOVER_BUTTON; ?></span></a></div>
								</div>	
											
							</li>
							
							<!-- THE THIRD SLIDE -->
							
							<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-title="<?php echo MOTIVATION_TITLE; ?>">						
								<img src="<?php  picture(); ?>" alt="" />
								<div class="just_pattern_parallax"></div>
																		
								<!-- THE CAPTIONS IN THIS SLIDE -->
								<div class="caption small-text lft ltt tp-resizeme"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="600" 
									 data-start="300" 
									 data-easing="Elastic.easeOut" style="z-index: 200;">
									<div class="top-text"><?php echo MOTIVATION_ONE; ?></div>	
								</div>
								<div class="caption big-text lft ltt tp-resizeme"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="700" 
									 data-start="700" 
									 data-easing="easeOutExpo" style="z-index: 200;">
									 <div class="big-text"><?php echo MOTIVATION_TWO; ?> <span><?php echo MOTIVATION_THREE; ?></span></div>
								</div>
								<div class="caption small-text lft ltt"  
									 data-x="center" 
									 data-y="center" 
									 data-speed="700" 
									 data-start="1300" 
									 data-easing="Elastic.easeOut" style="z-index: 200;">
									<div class="cl-effect"><a href="./?page=admisiones" data-gal="m_PageScroll2id" data-ps2id-offset="65"><span data-hover="<?php echo JOIN_MENU; ?>"><?php echo JOIN_MENU; ?></span></a></div>
								</div>	
											
							</li>						
						</ul>
					</div>
				</div>								
				
			</section>	
	
	
	
	<!-- FEATURED SECTION
    ================================================== -->	
	
	
	<section class="featured" id="featured">
	
		<div class="container">
			<div class="sixteen columns">
			<h2><font color="white"><?php echo TITLE_CREDITS; ?></font></h2>
			<br>
				<center>
				<img src="./images/banner.png" width="50%" >
				</center>
			<hr>
				<h5><font color="white"><?php echo DETAIL_CREDITS; ?></font></h5>
			<hr>
			<?php include_once('./ivaotest.php'); ?>
			</div>	
		</div>
		<div class="clear"></div>
		
	</section>
		
	<div class="clear"></div>
	
	
	<!-- ABOUT US SECTION
    ================================================== -->	
	
	<div class="clear"></div>
	
	<div class="svg-wrap">
		<svg viewBox="0 0 400 20" xmlns="http://www.w3.org/2000/svg">
			<path id="svg_line" d="m 1.986,8.91 c 55.429038,4.081 111.58111,5.822 167.11781,2.867 22.70911,-1.208 45.39828,-0.601 68.126,-0.778 28.38173,-0.223 56.76079,-1.024 85.13721,-1.33 24.17379,-0.261 48.42731,0.571 72.58115,0.571"></path>
		</svg>
	</div>
	
	<div class="clear"></div>
	
	<section class="about" id="about">
	
		<div class="container">
			<div class="sixteen columns">
				<h1><?php echo ABOUT_US_SLIDER; ?></h1>
			</div>
			<div class="sixteen columns">
				<div class="sub-text-line"></div>
			</div>
			<div class="sixteen columns">
				<div class="sub-text link-svgline"><?php echo ABOUT_US_SLIDER_ONE; ?> <a href="#services" data-gal="m_PageScroll2id" data-ps2id-offset="65"><?php echo ABOUT_US_SLIDER_TWO; ?><svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a> <?php echo ABOUT_US_SLIDER_THREE; ?> <a href="#work" data-gal="m_PageScroll2id" data-ps2id-offset="65"><?php echo ABOUT_US_SLIDER_FOUR; ?><svg class="link-svgline"><use xlink:href="#svg_line"></use></svg></a><?php echo ABOUT_US_SLIDER_FIVE; ?></div>
			</div>
			<div class="clear"></div>
			<div class="four columns">
				<div class="about-box1" data-scroll-reveal="enter left move 300px over 1s after 0.5s">
					<div class="about-box-icon">&#xf0a1;</div>
					<h5><?php echo TITLE_FLIGHTS; ?></h5>
					<p><?php echo FLIGHTS_OFFER; ?></p>
				</div>
				<div class="about-box1" data-scroll-reveal="enter left move 300px over 1s after 0.7s">
					<div class="about-box-icon">&#xf19d;</div>
					<h5><?php echo TRAINING_OFFER; ?></h5>
					<p><?php echo DETAIL_TRAINING_OFFER; ?></p>
				</div>
				<div class="about-box1" data-scroll-reveal="enter left move 300px over 1s after 0.9s">
					<div class="about-box-icon">&#xf0d0;</div>
					<h5><?php echo ADMISSIONS_OFFER; ?></h5>
					<p><?php echo DETAIL_ADMISSIONS_OFFER; ?></p>
				</div>
			</div>
			<div class="eight columns remove-bottom" data-scroll-reveal="enter bottom move 400px over 1s after 0.1s">
				<img src="images/ipad.png" alt=""/>
			</div>
			<div class="four columns">
				<div class="about-box" data-scroll-reveal="enter right move 300px over 1s after 0.5s">
					<div class="about-box-icon">&#xf0c6;</div>
					<h5><?php echo DOWNLOAD_OFFER; ?></h5>
					<p><?php echo DETAIL_DOWNLOAD_OFFER; ?></p>
				</div>
				<div class="about-box" data-scroll-reveal="enter right move 300px over 1s after 0.7s">
					<div class="about-box-icon">&#xf080;</div>
					<h5><?php echo ACCOUNT_OFFER; ?></h5>
					<p><?php echo DETAIL_ACCOUNT_OFFER; ?></p>
				</div>
				<div class="about-box" data-scroll-reveal="enter right move 300px over 1s after 0.9s">
					<div class="about-box-icon">&#xf120;</div>
					<h5>PIREPS</h5>
					<p><?php echo PIREPS_OFFER; ?></p>
				</div>
			</div>
		</div>	
		
		
		
		<div class="facts">
			<div class="container">
				<div class="four columns">
					<div class="facts-wrap">
						<div class="facts-wrap-num"><span class="counter"><?php echo $num_pilots; ?></span></div>
						<h6><?php echo PILOTS_STATS; ?></h6> 
					</div>
				</div>
				<div class="four columns">
					<div class="facts-wrap">
						<div class="facts-wrap-num"><span class="counter"><?php echo $num_planes; ?></span></div>
						<h6><?php echo PLANES_STATS; ?></h6> 
					</div>
				</div>
				<div class="four columns">
					<div class="facts-wrap">
						<div class="facts-wrap-num"><span class="counter"><?php echo $num_routes; ?></span></div>
						<h6><?php echo ROUTES_STATS; ?></h6> 
					</div>
				</div>
				<div class="four columns">
					<div class="facts-wrap">
						<div class="facts-wrap-num"><span class="counter"><?php echo $num_hubs; ?></span></div>
						<h6><?php echo HUBS_STATS; ?></h6> 
					</div>
				</div>
			</div>
		</div>	
		
	</section>
	
	
	<div class="team" id="team">
			<div class="container">
				<div class="sixteen columns">
					<h1><?php echo ABOUT_VAS; ?></h1>
				</div>
				<div class="sixteen columns">
					<div class="sub-text-line"></div>
				</div>
				<div class="sixteen columns">
					<div class="sub-text link-svgline"><?php echo ANSWER_ONE; ?>,<?php echo ANSWER_TWO; ?>,<?php echo ANSWER_THREE; ?>.</div>
				</div>
				<div class="clear"></div>
				<div class="sixteen columns">	
				<?php

	$sql_operator_global ="select * from operators order by operator asc";

	if (!$result_operator_global = $db->query($sql_operator_global)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator = $result_operator_global->fetch_assoc()) {
		$operator_id= $row_operator["operator_id"];
        $name_operator= $row_operator["operator"];
		$img = $row_operator["file"];
		$ceo = $row_operator["ceo"];
		$imagen_va = $row_operator["imagen_aerolinea"];
		

	?>
					<article>
						<img src="../../admin/images/portada/<?php echo $imagen_va; ?>" alt=""/>
						<h6><img src="../admin/images/operators/<?php echo $img; ?>"></h6>
						<p><span><?php echo $ceo; ?> / CEO</span></p>
						<div class="social-team">
							<ul class="list-social">
								<li class="icon-soc">
									<a href="./?page=filiales&operator_id=<?php echo $operator_id; ?>">&#xf072;</a>
								</li>
							</ul>	
						</div>						
					</article>
			<?php } ?>					
				</div>
			</div>
		</div>	

	

	 <?php
		
	                                                                           }
																			   
																			   if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
																			   
	                                                                           } else {
		                                                                          $Existe = file_exists($_GET["page"] . ".php");
		                                                                             if ($Existe == true) {
		                                                                                	include($_GET["page"] . ".php");
	                                                                               	 } else {
			                                                                                include("404.php");
                                                                                     }
	                                                                            }
		
                                                                            ?>
		
	<!-- CONTACT SECTION
    ================================================== -->
	
	<section id="contact">

		<div class="con-detal-wrapper">
			<div class="container">
				<div class="one-third column" data-scroll-reveal="enter left move 200px over 1s after 0.2s">
					<h5><?php echo CERTIFIED_IVAO; ?></h5>
					<p>IVAO World & Colombia</p>
				</div>
				<div class="one-third column" data-scroll-reveal="enter top move 200px over 1s after 0.1s">
					<h5><?php echo SHARING_TITLE; ?></h5>
					<p><?php echo SAME_TITLE; ?></p>
				</div>
				<div class="one-third column" data-scroll-reveal="enter right move 200px over 1s after 0.2s">
					<h5>E-MAIL</h5>
					<p><?php echo $staff_email; ?></p>
				</div>
			</div>
		</div>
		
		<div class="clear"></div>
		
		<a href="./?page=admisiones" class="button-map close-map"><span><b><?php echo JOIN_US_FOOTER; ?></b> <?php echo DETAIL_JOIN_US_FOOTER; ?></span></a>
		
		<div class="clear"></div>	
		
	</section>	
	
	
	
	<!-- FOOTER
    ================================================== -->
	
	<div class="footer">
		<a href="#home" data-gal="m_PageScroll2id" data-ps2id-offset="100" ><div class="back-top">&#xf102;</div></a>	
		<div class="container">
			<div class="sixteen columns icons-footer">
				<a href="#">&#xf099;</a>
				<a href="#">&#xf0e1;</a>
				<a href="#">&#xf17d;</a>
				<a href="#">&#xf16b;</a>
			</div>
			<div class="sixteen columns">
				<p><?php echo date('Y'); ?> ALL RIGHT RESERVED. DESIGNED BY COLSTAR ALLIANCE</p>
			</div>
		</div>
	</div>
		
	<div class="clear"></div>














	

		
	<!-- JAVASCRIPT
    ================================================== -->
	<script src="js/jquery.steps.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>	
<script type="text/javascript" src="js/modernizr.custom.js"></script> 
<script type="text/javascript" src="js/royal_preloader.min.js"></script>
<script type="text/javascript">
(function($) { "use strict";
            Royal_Preloader.config({
                mode:           'text', // 'number', "text" or "logo"
                text:           '<?php echo $name_operator_va; ?>',
                timeout:        0,
                showInfo:       true,
                opacity:        1,
                background:     ['#FFFFFF']
            });
})(jQuery);
</script>
<script type="text/javascript" src="js/jquery.malihu.PageScroll2id.js"></script>
<script type="text/javascript">
(function($) { "use strict";
			$(window).load(function(){
				
				/* Page Scroll to id fn call */
				$("ul.slimmenu li a,a[href='#top'],a[data-gal='m_PageScroll2id']").mPageScroll2id({
					highlightSelector:"ul.slimmenu li a",
					offset: 65,
					scrollSpeed:1000,
					scrollEasing: "easeInOutCubic"
				});
				
				/* demo functions */
				$("a[rel='next']").click(function(e){
					e.preventDefault();
					var to=$(this).parent().parent("section").next().attr("id");
					$.mPageScroll2id("scrollTo",to);
				});
				
			});	
})(jQuery);

</script>
<script type="text/javascript" src="js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript">
(function($) { "use strict";
				var revapi;

				jQuery(document).ready(function() {

					   revapi = jQuery('.tp-banner').revolution(
						{
							delay:8000,
							startwidth:1300,
							startheight:660,
							hideThumbs:0,
							hideTimerBar:"on",
							onHoverStop:"on",
							navigationType: "none",
							navigationArrows:"solo",
							navigationStyle:"preview4",
							fullWidth:"on"
						});

				});	//ready
})(jQuery);

</script>
<script src="js/scripts.js"></script>
<script type="text/javascript" src="js/jquery.easing.js"></script>
<script type="text/javascript" src="js/scrollReveal.js"></script>
<script type="text/javascript">
(function($) { "use strict";
      window.scrollReveal = new scrollReveal();
})(jQuery);
</script>
<script type="text/javascript" src="js/scroll.js"></script>
<script type="text/javascript" src="js/navigation.js"></script>	
<script type="text/javascript" src="js/classie.js"></script>
<script type="text/javascript" src="js/cbpAnimatedHeader.min.js"></script>
<script type="text/javascript" src="js/jquery.film_roll.js"></script>
<script type="text/javascript" src="js/jquery.counterup.min.js"></script>
<script type="text/javascript" src="js/waypoints.min.js"></script>
<script type="text/javascript" src="js/html5shiv.js"></script>
<script type="text/javascript" src="js/flip-carousel.js"></script>
<script type="text/javascript" src="js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="js/jquery.flexslider.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/isotope.js "></script>
<script type="text/javascript" src="js/jquery.fitvids.js"></script>
<script type="text/javascript" src="js/jquery.fs.tipper.min.js"></script>
<script type="text/javascript" src="js/contact.js"></script>
<script type="text/javascript" src="js/styleswitcher.js"></script>
<script type="text/javascript" src="js/template.js"></script>  	  
<!-- End Document
================================================== -->
</body>
</html>
