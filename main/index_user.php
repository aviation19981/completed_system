<?php
session_start();
$id = $_SESSION["id"];
date_default_timezone_set('UTC');
 
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
	
	if (empty($id)) {
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./?page=nosession">';
	
	} else {
	
	
	
	
	
		
	
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
	include('./validacion_login.php');
	include('./report_pilot_activity.php');
    $secure = new SECURITY();
	$secure->parse_incoming();
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	

$mess = date("m"); 
$dias = date("d"); 
$años = date("Y"); 
$añosaniversario = ($años - 2014);





				
	$cs = $location;
	



	
			
$filecontents = file_get_contents_curl('http://wx.ivao.aero/taf.php');
$rows = explode("\n", $filecontents);
foreach ($rows as $row) {

	$fields = explode(" ", $row);
	
if ($fields[0]==$cs) {
	
$taf = $row;
}
}




$filecontentsmetar = file_get_contents_curl('http://wx.ivao.aero/metar.php');
$rowsmetar = explode("\n", $filecontentsmetar);
foreach ($rowsmetar as $rowmetar) {

	$fieldsmetar = explode(" ", $rowmetar);
	
if ($fieldsmetar[0]==$cs) {
	
$metar = $rowmetar;
}
}

if(!empty($_SESSION['operator_id'])) {
$sql = "select * from operators where operator_id=" . $_SESSION['operator_id'];

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

        $name_operator_va= $rowusuarios["operator"];
		$img_va = $rowusuarios["file"];
		$icao_va_full = $rowusuarios["callsign"];

	}
	
	
	
}

$operator_id_session = $_SESSION['operator_id']; 

	function picture() {
   global $operator_id_session,$db;
   if(empty($operator_id_session)) {
	   echo "./images/fondos/" . rand(1,10) . ".jpg";
   } else {
   $i=0;
   
	
	$sql_pic = "SELECT * FROM gallery_operators where operator_id='$operator_id_session' ORDER BY RAND() LIMIT 1";
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
?>



<!doctype html>
<html lang="es">
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $name_operator_va; ?></title>
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

	
	<!-- New
	================================================== -->
	<link href="css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="./js/simbrief.apiv1.js"></script>
	</head>
	<style>
	

.logo_unique{
	position:absolute;
	width:125px;
	height:25px;
	z-index:10000;
	left:10px;
	top:38px;
	background:url('../admin/images/operators/<?php echo $img_va; ?>') no-repeat center center;
	background-size:125px 25px;
    -webkit-transition: all 300ms linear;
    -moz-transition: all 300ms linear;
    -o-transition: all 300ms linear;
    -ms-transition: all 300ms linear;
    transition: all 300ms linear; 
}



</style>
<body>	

	
	
	<!-- MENU
    ================================================== -->	

		<nav id="menu-wrap" class="menu-back cbp-af-header">
			<div class="container">
				<div class="sixteen columns">
					<div class="logo_unique"></div>
					<ul class="slimmenu">
						<li> 
							<a href="./index_user.php" data-ps2id-offset="100"><?php echo INDEX_USER_HOME; ?></a>
						</li>
						<li><a class="dropdown-toggle"><?php echo INDEX_USER_CENTER_PILOT; ?></a>
						   <ul role="menu" class="dropdown-menu">
                                                                <li> <a href="./index_user.php?page=intranet">Intranet</a> </li>
                                                                <li> <a href="./index_user.php?page=center_training"><?php echo INDEX_USER_TRAINING; ?></a> </li>
																<?php if ($_SESSION["access_administration_panel"] == 1) { ?>
																<li> <a href="../admin/"><?php echo INDEX_USER_ADMON; ?></a> </li>
																<?php } ?>
																<?php if ($_SESSION["access_invitation"]==1){ ?>
																<li> <a href="./index_user.php?page=invitarpiloto"><?php echo INDEX_USER_INVITATION; ?></a> </li>
																<?php } ?>
						   </ul>
                        </li>
						
						<li><a class="dropdown-toggle" aria-haspopup="true"><?php echo INDEX_USER_DETAILS; ?></a>
						   <ul role="menu" class="dropdown-menu">
                                                                        <li> <a href="./index_user.php?page=routes_search"><?php echo INDEX_USER_SEARCHER_ROUTES; ?></a> </li>
																	    <li> <a href="./index_user.php?page=airplanes"><?php echo INDEX_USER_PLANES; ?></a> </li>
																		<li> <a href="./index_user.php?page=hubs"><?php echo INDEX_USER_HUBS; ?></a> </li>
						   </ul>
                        </li>
						
						<li>
							<a href="./logout.php"><?php echo INDEX_USER_LOGOUT; ?> <?php echo $_SESSION["user"]; ?></a>
						</li>
						
													
						<li><a class="dropdown-toggle"><img alt="Image" class="flag" src="images/languagues/<?php echo strtoupper ($_SESSION['language']); ?>.png" width="25%"></a>
						   <ul role="menu" class="dropdown-menu">
                              <?php 
										                                        	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
																						if($_SESSION['language']=="es") {
																				   ?>
                                                                                    <li>
                                                                                        <a href="./index_user.php?lang=en"><img alt="Image" class="flag" src="images/languagues/EN.png" width="20%"> ENG</a>
                                                                                    </li>
																					<?php }  else if($_SESSION['language']=="en") { 
																					
																					?>
                                                                                    <li>
                                                                                        <a href="./index_user.php?lang=es"><img alt="Image" class="flag" src="images/languagues/ES.png" width="20%"> ESP</a>
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



<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo WELCOME_GALLERY; ?> <?php echo $pilotname . ' ' . $pilotsurname  . ' (' . $callsign . ')'; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo TAKE_OFF_GALLERY; ?></font></h3>
	<div class="cl-effect"><a href="./index_user.php?page=schedule" data-gal="m_PageScroll2id" data-ps2id-offset="65"><span data-hover="<?php echo INDEX_USER_GREAT_DAY; ?>"><?php echo INDEX_USER_GREAT_DAY; ?></span></a></div>

</section>
	

		<section class="cover height-100 text-center">
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
						<br>
                            <h1 class="color--primary"><?php echo INDEX_USER_BIRTHDAY; ?></h1>
                            <h1><?php echo MEMBERS_OF_INDEX_USER; ?>
                                <br class="hidden-xs hidden-sm" /> <?php echo INDEX_USER_ALLIANCE; ?></h1>
                            
							
							<?php 
			  
			  date_default_timezone_set('America/Bogota');
							
$mess = date("m"); 
$dias = date("d"); 
$anos = date("Y"); 

$countbirth = 0;

			 $sql2 = 'select * from gvausers';
			if (!$result2 = $db->query($sql2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row2 = $result2->fetch_assoc()) 
			{
                               
                               $comparacion  = $row2["birth_date"];
                               $nombre  = $row2["name"];
                               $apellido  = $row2["surname"];
                               $callsings  = $row2["callsign"];
                               $fechayear = substr($comparacion, 0, 4);
                               $fechamonth = substr($comparacion, 5, 2);
							   $fechaday = substr($comparacion, 8, 2);
							   $fechatotal = $fechayear. '-' . $fechamonth . '-' . $fechaday;
							   $fechaactual = $fechayear. '-' . $mess . '-' . $dias;
							   $edad = $anos -  $fechayear;
								
				if($fechatotal==$fechaactual) {
                       $countbirth++;
                       echo '<div class="alert bg--success">
                                <div class="alert__body">
                                    <span>' . BIRTHDAY_TO . ' ' . $nombre . ' ' . $apellido  . ' (' . $callsings . ') Family ColStar Alliance | ' . $edad . '  ' . YEARS_INDEX_USER . '!</span>
                                </div>
                            </div>';
				}
							
} 
                               
				
				

if ($countbirth==0)	{
	
	echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' .  NO_BIRTHDAY . '</span>
                                </div>
                            </div>';
	
}		
			 
			 
			 
			 ?>
                            <!--end of modal instance-->
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>


			
														
			<section class="cover cover-features imagebg " data-overlay="5">
                <div class="background-image-holder">
                    <img alt="background" src="<?php picture(); ?>" />
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 col-md-7">
						<br>
                            <h1>
                                <?php echo YOUR_INFO_INDEX_USER; ?>
                            </h1>
							<hr>
                            <p class="lead">
                                <?php echo DETAIL_YOUR_INFO_INDEX_USER; ?>
                            </p>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DETAILS_ABOUT_INDEX_USER; ?> Taf: <?php echo $location; ?></h5>
                                <p>
                                    <?php echo $taf; 
									
									if(empty($taf)) {
										
										echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>NO TAF</span>
                                </div>
                            </div>';
										
									}
									
									?>
                                </p>
                                <span class="label">TAF</span>
                            </div>
                            <!--end feature-->
                        </div>
                        <div class="col-sm-6">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo DETAILS_ABOUT_INDEX_USER; ?> Metar: <?php echo $location; ?></h5>
                                <p>
                                    <?php echo $metar; 
									
									if(empty($metar)) {
										
										echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>NO METAR</span>
                                </div>
                            </div>';
										
									}
									
									?>
                                </p>
                                <span class="label">METAR</span>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
                    <!--end of row-->
					
					
					
					
					
					<div class="row">
                        <div class="col-sm-9 col-md-7">
						<br>
                            <h1>
                                <?php echo EVENT_TITLE; ?>
                            </h1>
							<hr>
                            <p class="lead">
                                <?php echo EVENT_TITLE_INFO; ?>
                            </p>
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="feature feature--featured feature-1 boxed boxed--border bg--white">
                                <h5><?php echo EVENT_TITLE_SECOND; ?> :: COLSTAR</h5>
                                <?php 
								
								$contadores = 0;
								$sql2 = 'select * from events where publish_date<=now() and hide_date>=now()';
			if (!$result2 = $db->query($sql2)) {
				die('There was an error running the query [' . $db->error . ']');
			}
			while ($row2 = $result2->fetch_assoc()) 
			{
				$contadores++;
				echo '<li>' . $row2['event_name'] . '  <a href="./index_user.php?page=events&id=' . $row2['event_id'] . '">Más detalles!</a></li>';
			}
			
			if($contadores==0) {
										
										echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . EVENT_TITLE_SECOND_ALERT . '</span>
                                </div>
                            </div>';
										
									}
				
				
				?>
                                <span class="label"><?php echo EVENT_TITLE_SECOND; ?></span>
                            </div>
                            <!--end feature-->
                        </div>
                    </div>
                    <!--end of row-->
					
					
                </div>
                <!--end of container-->
            </section>
	

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
	<?php } ?>