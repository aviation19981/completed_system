<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
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
	

	
    include("./languages/lang_" . $_SESSION['language'] . ".php");
    include('./../db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	



?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>ColStar Alliance MGO</title>
  <meta name="viewport" content="width=device-width">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Alianza virtual certificada por IVAO World y la división Colombiana.">
  <meta name="author" content="Andres Zapata">
  <!-- Favicons ================================================== -->
  <link rel="shortcut icon" href="./../images/favicon.ico">
	
  <script src="https://s.codepen.io/assets/libs/modernizr.js" type="text/javascript"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/720_grid.css" type="text/css" media="screen and (min-width: 880px)">
<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/986_grid.css" type="text/css" media="screen and (min-width: 1146px)">
<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/1236_grid.css" media="screen and (min-width: 1396px)" >
<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/animate.css">
<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/liquid-slider.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i);

* {
  box-sizing:border-box;
}

body {
  background-image: url(./img/<?php echo rand(1,2); ?>.jpg); 
  font-size:24px;
  font-family: 'Rockwell', 'Kreon', serif;
  font-weight:300;
  line-height:1.5;
}

.wrapper {
  border-left: 150px solid #555;
  border-right: 10px solid #8A1616;
  overflow:auto;
}

h1 {
  font-size: 2.8em;
  text-align:center;
  color:#d46e58;
  font-family: 'Lato', sans-serif;
  font-weight:600;
  text-transform:uppercase;
}

h2 {
  font-size: 1.4em;
  text-align:center;
  color:#8A1616;
   font-weight:400;
}

h3 {
  font-size: 1.3em;
  font-family:  'Lato', sans-serif;
  margin: 20px 10px;
   font-weight:600;
} 

h4 {
  font-size: 1.3em;
  font-family:  'Lato', sans-serif;
  margin: 10px 0px;
  border-bottom:1px solid #000;
   font-weight:600;
} 

p {
  margin: 15px 10px;
  padding:15px;
}

.cover {
  position:relative; 
}

.title {
  position:absolute;
  top: 50%;
  width:100%;
  padding:10px;
}
 
.down {
  position:fixed;
  display:block;
  bottom:0px;
  left:50%;
  margin-left:50px;
  padding:0px 10px;
  background:#555;
  border-radius: 10px 10px 0 0;
  cursor:pointer;
}

.pagination{
  text-align:center;
  clear:both;
  display:none;
}

.full {
  margin-top:150px;
}

.right {
  text-align:right;
}
.previous, .next {
  cursor:pointer;
  display:inline-block;
  padding: 5px 20px;
}


.sidebar {
  position:fixed;
  width:250px;
  left:-250px;
  background:#CECECE;
  font-size:18px;
}

.sidebar-content {
  overflow:auto;
  padding:15px;
}

nav a{
  text-decoration:none;
  font-style:italic;
  color:#000;
  display:block;
}

nav a:hover {
  text-decoration:underline;
}
.search {
 width:100%;
 border:none;
 padding:10px;
 font-size:18px;
 border-radius:5px;
 
}

.toggle {
  position:fixed;
  left:0px;
  top:20px;
  width:50px;
  padding:10px;
  display:block;
  background:#000;
  color:white;
  border-radius: 0 10px 10px 0;
  text-align:center;
  cursor:pointer;
  z-index:9990;
}

.toggle-active {
  display:none;
  position:fixed;
  left:0;
  top:20px;
  width:50px;
  padding:10px;
  color:white;
  border-radius: 0 10px 10px 0;
  text-align:center;
  cursor:pointer;
  z-index:9999;
  background:#4F76A6;
}

@media only screen and (max-width : 880px){
  .wrapper {
  border-left: 10px solid #555;
  }
  
  .pagination {
    display:block;
  }
  
  .full {
    display:none !important;
  }
  .down {
    display:none !important;
  }
}

    </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <div class="wrapper">
  <div class="toggle fa fa-angle-right fa-2x"></div>
  <div class="toggle-active fa fa-angle-left fa-2x"></div>
  <div class="sidebar">  
    
    <div class="sidebar-content">
      <h4><img src="./../images/logo.png"   width="80%"/></h4>
      <p><b><?php echo MGO; ?></b></p> 
	  <h4>Menu</h4>
      <nav role='navigation'>
        <ul>
          <li><a href="./../?page=rules">MGO</a></li>
        </ul>
      </nav>  
	  <h4><?php echo MGO_ALLIANCE;  ?></h4>
	  <?php $sql_operator_global_first ="select * from operators order by operator asc";

	if (!$result_operator_global_first = $db->query($sql_operator_global_first)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_first = $result_operator_global_first->fetch_assoc()) {
		echo '<li>' . $row_operator_first["operator"] . '</li>'; 
	}
	
	?>
	  <hr>
	  <p><?php echo MGO_DATE_REVIEW; ?> 30/11/2017</p>
    </div>
  </div>
  <div class="grid">
    
    <div class="row">
      <div class="slot-0-1-2-3-4-5">
        <section class="cover">
          <div class="title">
            <h1><img src="./../images/logo.png"   width="50%"/></h1>
            <h2><?php echo MGO_TITLE; ?></h2>
          </div>
           <i class="down fa fa-angle-down fa-3x"></i>
        </section>
      </div>
    </div>
    <div class="row">
      <div class="slot-0">&nbsp;<i class="previous full fa fa-long-arrow-left"></i></div>
      <div class="slot-1-2-3-4">
        <div class="pagination">
          <i class="previous fa fa-long-arrow-left"></i>
          <i class="next fa fa-long-arrow-right"></i>
        </div>
        <?php echo MGO_INTRODUCTION; ?>
        <?php echo MGO_ALLIANCE_INFO; ?>
        <?php echo MGO_PLANES; ?>
			<?php $sql_operator_fleet ="select * from fleettypes order by maximum_range asc";

	if (!$result_operator_fleet = $db->query($sql_operator_fleet)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row_operator_fleet = $result_operator_fleet->fetch_assoc()) {
		echo '<li>' . $row_operator_fleet["plane_description"] . '</li>'; 
	}
	
	?>
		<?php echo MGO_PLANES_TWO; ?>
		<?php echo MGO_ADMISSIONS; ?>
		<?php echo MGO_ADMISSIONS_PROCESS; ?>
		<?php echo MGO_ALLIANCE_HOMOLOGACION; ?>
		<?php echo INVITATION_CODE; ?>
		<?php echo MGO_ALLIANCE_REGULATION; ?>
		<?php echo MGO_ALLIANCE_OPERATIONS; ?>
		<?php echo MGO_ALLIANCE_BAD_ACTS; ?>
		<?php echo MGO_ALLIANCE_END; ?>
      </div>
      <div class="slot-5 right">&nbsp;<i class="next full fa fa-long-arrow-right"></i></div>
    </div>
  
  </div>
  
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/jquery.easing.1.3.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/jquery.liquid-slider.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/jquery.liquid-slider.min.js'></script>
<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/110131/jquery.touchSwipe.min.js'></script>

    <script  src="js/index.js"></script>

</body>
</html>
