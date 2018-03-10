<?php
session_start();
$id = $_SESSION['id'];
include("./languages/lang_" . $_SESSION['language'] . ".php");
?>
<html>
<head>
<title>ColStar Alliance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Alianza virtual Colombia, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?">
<link rel="shortcut icon" href="./img/favicon/cst.ico">
<meta property="og:type" content="article">
<meta property="og:description" content="Alianza virtual Colombia, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?">
<meta property="og:locale" content="es_CO">
<meta property="og:site_name" content="ColStar Alliance">
<meta property="og:image" content="<?php echo $protocolo . $_SERVER["HTTP_HOST"]; ?>/va/img/videos/2.jpg">
<meta property="og:url" content="<?php echo $protocolo . $_SERVER["HTTP_HOST"]; ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php

if (empty($id)) {
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=./index.php?page=nosession">';
	
	} else {
    include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database); 
	$db->set_charset("utf8"); 
	if ($db->connect_errno > 0) {
	   die('Unable to connect to database [' . $db->connect_error . ']');
    } 

$sql_uno = "select * from gvausers where gvauser_id='$id'";
if (!$result_uno = $db->query($sql_uno))  {
	die('There was an error running the query [' . $db->error . ']');
}
$contadores =0;
while ($row_uno = $result_uno->fetch_assoc()) {
	    $activationknow = $row_uno["activation"];
	
	    if($activationknow!=0 && $activationknow!=3 && $activationknow!=4) {
		$gvauser_idshow = $row_uno["gvauser_id"];
		$ivaovidpca = $row_uno["ivaovid"];
		$fecha_envio1 = $row_uno["register_date"];
		$fecha_envio2 = 0;
			///////////////////////// Consultamos ultimo vuelo //////////////////////////////////
		
		$sql_dos = "SELECT * FROM cstpireps WHERE vid='$ivaovidpca' order by id desc LIMIT 1";
		
		if (!$result_dos = $db->query($sql_dos))  {
	       die('There was an error running the query [' . $db->error . ']');
        }

        while ($row_dos = $result_dos->fetch_assoc()) {
			
			//////////////////////// Contamos cuando fue el ultimo vuelo /////////////////////
			$contadores++;
			$fecha_envio2 = $row_dos['fecha_envio'];
			
		}
		    if($contadores==0) {
				$fecha_envio = $fecha_envio1;
			} else {
				$fecha_envio = $fecha_envio2;
			}
		
			$hoy = date('Y-m-d');
			
             
                	$dias	= (strtotime($fecha_envio)-strtotime($hoy))/86400;
                	$dias_pro 	= abs($dias); 
					$diastotales = floor($dias_pro);		
                	
               
            //////////////////////////////// DIAS OBTENIDOS //////////////////////////////////
           
			$diasrequeridos=6;
			
			if($diastotales>$diasrequeridos) {
			
            ?>
			<script>
alert('<?php echo SINCE_CHARTS; ?> <?php echo $diastotales; ?> <?php echo str_replace("NUMFLIGHTS",$diasrequeridos,INFO_CHARTS); ?>');
window.close();
window.location.href='./index_user.php?page=intranet';
</script>

<?php			
			} else {
				
			if($_SERVER["HTTPS"] != "on")
{	
			?>
			
			<html>

<script language="JavaScript" type="text/javascript">
document.write(unescape('%3C%68%74%6D%6C%3E%0D%0A%20%20%20%20%3C%74%69%74%6C%65%3E%43%6F%6C%53%74%61%72%20%56%41%20%7C%20%49%6E%69%63%69%6F%3C%2F%74%69%74%6C%65%3E%0D%0A%20%20%20%20%3C%6D%65%74%61%20%6E%61%6D%65%3D%22%6B%65%79%77%6F%72%64%73%22%20%63%6F%6E%74%65%6E%74%3D%22%61%65%72%6F%6C%69%6E%65%61%2C%20%61%69%72%6C%69%6E%65%73%2C%20%63%6F%6C%6F%6D%62%69%61%2C%20%63%6F%6C%73%74%61%72%2C%20%61%63%61%72%73%2C%20%76%61%20%2C%20%66%73%78%2C%20%69%76%61%6F%2C%20%76%69%72%74%75%61%6C%22%20%2F%3E%0D%0A%3C%6D%65%74%61%20%6E%61%6D%65%3D%22%64%65%73%63%72%69%70%74%69%6F%6E%22%20%63%6F%6E%74%65%6E%74%3D%22%41%65%72%6F%6C%26%69%61%63%75%74%65%3B%6E%65%61%20%76%69%72%74%75%61%6C%20%43%6F%6C%6F%6D%62%69%61%6E%61%2C%20%66%75%6E%64%61%64%61%20%70%61%72%61%20%63%6F%6E%65%63%74%61%72%20%61%20%43%6F%6C%6F%6D%62%69%61%20%63%6F%6E%20%41%6D%65%72%69%63%61%20%79%20%65%6C%20%4D%75%6E%64%6F%21%20%51%75%65%20%65%73%70%65%72%61%73%20%70%61%72%61%20%73%65%72%20%70%61%72%74%65%20%64%65%20%6E%6F%73%6F%74%72%6F%73%3F%22%2F%3E%0D%0A%3C%6C%69%6E%6B%20%68%72%65%66%3D%22%2E%2F%69%6D%61%67%65%73%2F%66%61%76%69%63%6F%6E%2E%69%63%6F%22%20%74%79%70%65%3D%22%69%6D%61%67%65%2F%78%2D%69%63%6F%6E%22%20%72%65%6C%3D%22%69%63%6F%6E%22%20%2F%3E%0D%0A%3C%69%66%72%61%6D%65%20%73%72%63%3D%22%68%74%74%70%3A%2F%2F%6A%65%70%70%65%73%65%6E%2E%63%6F%6D%2F%69%63%68%61%72%74%73%2F%69%6E%64%65%78%2E%6A%73%70%3F%6C%6F%67%69%6E%2D%75%73%65%72%6E%61%6D%65%3D%6F%75%74%73%74%61%74%69%6F%6E%26%6C%6F%67%69%6E%2D%70%61%73%73%77%6F%72%64%3D%6F%75%74%73%74%61%74%69%6F%6E%31%32%33%22%20%62%6F%72%64%65%72%3D%22%30%22%20%77%69%64%74%68%3D%22%31%30%30%25%22%20%68%65%69%67%68%74%3D%22%31%30%30%25%22%3E%3C%2F%69%66%72%61%6D%65%3E%0D%0A%3C%2F%68%74%6D%6C%3E'));
</script>


</html>


<?php
} else {
	
	?>
	<script type="text/javascript">
window.location="<?php echo "http://" . $_SERVER["HTTP_HOST"].'/va/charts_navigraph.php';  ?>";
</script>
<?php
	
}
				
				
			}
			

		
		
		}
		
     }
}

?>
</body>
</html>
