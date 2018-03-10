<?php

include('./db_login.php');
session_start();
$id = $_SESSION['id'];
$rank_id = $_GET['rank_id'];
	if ($id == '') {
		header("Location: ./index.php?page=nosession");
		die();
	} else {


	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sqluser = "SELECT * FROM gvausers where gvauser_id='$id'";

	if (!$resultuser = $db->query($sqluser)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowusuarios = $resultuser->fetch_assoc()) {

		$user_type = $rowusuarios['user_type_id'];

		$pilotname = $rowusuarios['name'];

		$pilotsurname = $rowusuarios['surname'];

		$callsign = $rowusuarios['callsign'];

		$id = $rowusuarios['gvauser_id'];

		$location = $rowusuarios['location'];

		$usertype = $rowusuarios['user_type_id'];

		$hub_id = $rowusuarios['hub_id'];
		
		$operador_id = $rowusuarios['operator_id'];

		$register_date = $rowusuarios['register_date'];

		

		$email = $rowusuarios['email'];

		$ivaovid = $rowusuarios['ivaovid'];
		
		$country = $rowusuarios['country'];

		$city = $rowusuarios['city'];

		$transfered_hours = $rowusuarios['transfered_hours'];

		$pilot_image = './images/uploads/'.$rowusuarios['pilot_image'];

	}
		
		
		$nombreseaa = $pilotname;
	$cantidad = strlen($nombreseaa);

	 $IndiceEspacio = strpos($nombreseaa," "); 
	$numeros = $IndiceEspacio;
$CadenaRecortada = substr($nombreseaa,0,$numeros);

if($IndiceEspacio==0) {
	
$CadenaRecortada = $pilotname;	
}
$nombreseaa2 = $pilotsurname;
	$cantidad2 = strlen($nombreseaa);

	$IndiceEspacio2 = strpos($nombreseaa2," "); 
	$numeros2 = $IndiceEspacio2;
$CadenaRecortada2 = substr($nombreseaa2,0,$numeros2);

		if($IndiceEspacio2==0) {
	
$CadenaRecortada2 = $pilotsurname;
}
		
		
		
		// Get Rank

	$rank = '';

	$salary_hour = '';

	$sql = "select rank,salary_hour,img,minimum_hours from ranks where rank_id='$rank_id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query [' . $db->error . ']');

	}

	while ($rowusuarios = $result->fetch_assoc()) {

		$rank = $rowusuarios["rank"];

		$salary_hour = $rowusuarios["salary_hour"];
		$minimum_hours = $rowusuarios["minimum_hours"];

		$rank_url_image = $rowusuarios["img"];
	}
	
	
  $primerasletras = substr($rank,0,2);
  $restoletras = substr($rank,2);
  
  $host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$web = "http://" . $host;






$sql_full = "SELECT * FROM operators where operator_id=$operador_id";
 if (!$result_full = $db->query($sql_full))  {
	die('There was an error running the query [' . $db->error . ']');
	
	
}

while ($row_full = $result_full->fetch_assoc()) {
		$operator = $row_full['operator'];
		$callsign = $row_full['callsign'];
		$iata = $row_full['iata'];
		$hub_principal = $row_full['hub_principal'];
		$ceo = $row_full['ceo'];
		$vceo = $row_full['vceo'];
}

include("./languages/lang_" . $_SESSION['language'] . ".php");
?>





<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ColStar Alliance | <?php echo DEGREE_TITLE; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Alianza virtual Colombia, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?">
        <link rel="shortcut icon" href="./images/favicon.ico">
        <link href="diploma/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/socicon.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/flickity.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/iconsmind.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/theme.css" rel="stylesheet" type="text/css" media="all" />
        <link href="diploma/css/custom.css" rel="stylesheet" type="text/css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body class=" ">
        <a id="start"></a>
        <div class="main-container">
            <section class="imagebg height-100 text-left" data-gradient-bg="#5f2c82,#49a09d,#F3A183,#5f2c82">
                <div class="background-image-holder">
                    <img alt="background" src="./images/diplomas/<?php echo rand(1,7); ?>.png" />
                </div>
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-sm-9 col-md-7">
                            <h1>
                                <font color="#737575" size="450px"><?php echo $primerasletras; ?></font><font color="#282828" size="500"><?php echo $restoletras; ?></font>
                            </h1>
							
                        </div>
						<div class="col-md-12">
						<br>
                            <p class="lead">
    <?php echo ONE_INFO_DEGREE; ?> Col<b>Star</b> Alliance ::: <?php echo $operator; ?> <?php echo TWO_INFO_DEGREE; ?> <?php echo $CadenaRecortada . ' ' . $CadenaRecortada2; ?> <?php echo THREE_INFO_DEGREE; ?> <b><?php echo $callsign; ?></b> <?php echo FOUR_INFO_DEGREE; ?> «<?php echo $rank; ?>» <?php echo FIVE_INFO_DEGREE; ?> <?php echo $minimum_hours; ?> <?php echo SIX_INFO_DEGREE; ?>
                            </p>
							<br>
							
						    
							<p><img  src="../../admin/images/ranks/<?php echo $rank_url_image; ?>" width="10%" align="left"><em>"<?php echo SEVEN_INFO_DEGREE; ?>". J.P. Sergent</em></p>
							<hr>
							<h4><?php echo EIGHT_INFO_DEGREE; ?> - <a href="<?php echo $host; ?>"><?php echo $host; ?></a></h4>
							
                        </div>
						
						
						
                    </div>
					<div class="row space--sm" data-overlay='4' >
				
					
                                        <div class="col-sm-6">
                                            <h3><em><?php echo NINE_INFO_DEGREE; ?></em></h3>
                                        </div>
                                        <div class="col-sm-6">
                                            <h2><?php echo TEN_INFO_DEGREE; ?> <b>Col</b>Star</h2>
											<h4>
											<?php if(!empty($ceo)) { ?><li><?php echo TWELVE_INFO_DEGREE; ?> - <?php echo $ceo; ?></li><?php } ?>
											<?php if(!empty($vceo)) { ?><li><?php echo VPRESIDENT_STAFF; ?> - <?php echo $vceo; ?></li><?php } ?>
											</h4>
                                        </div>
                                    </div>
				
                </div>
                <!--end of container-->

                    <!--end of row-->
				
            </section>
			
        </div>
        <!--<div class="loader"></div>-->
        <a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
            <i class="stack-interface stack-up-open-big"></i>
        </a>
        <script src="diploma/js/jquery-3.1.1.min.js"></script>
        <script src="diploma/js/flickity.min.js"></script>
        <script src="diploma/js/easypiechart.min.js"></script>
        <script src="diploma/js/parallax.js"></script>
        <script src="diploma/js/typed.min.js"></script>
        <script src="diploma/js/datepicker.js"></script>
        <script src="diploma/js/isotope.min.js"></script>
        <script src="diploma/js/ytplayer.min.js"></script>
        <script src="diploma/js/lightbox.min.js"></script>
        <script src="diploma/js/granim.min.js"></script>
        <script src="diploma/js/jquery.steps.min.js"></script>
        <script src="diploma/js/countdown.min.js"></script>
        <script src="diploma/js/twitterfetcher.min.js"></script>
        <script src="diploma/js/spectragram.min.js"></script>
        <script src="diploma/js/smooth-scroll.min.js"></script>
        <script src="diploma/js/scripts.js"></script>
    </body>
</html>




















<?php } ?>