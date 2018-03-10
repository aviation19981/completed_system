<?php
$protocolo = 'http://';
if($_SERVER["HTTPS"] != "off")
{
    header("Location: http://" . $_SERVER["HTTP_HOST"].'/main/');
    exit();
} else {
?>
<!DOCTYPE HTML>
<html>
<head>
<title>ColStar Alliance</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Alianza virtual Colombia, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?">
<link rel="shortcut icon" href="./va/img/favicon/cst.ico">
<meta property="og:type" content="article">
<meta property="og:description" content="Alianza virtual Colombia, fundada para conectar a Colombia con America y el Mundo! Que esperas para ser parte de nosotros?">
<meta property="og:locale" content="es_CO">
<meta property="og:site_name" content="ColStar Alliance">
<meta property="og:image" content="<?php echo $protocolo . $_SERVER["HTTP_HOST"]; ?>/main/images/fondos/<?php echo rand(1,10); ?>.jpg">
<meta property="og:url" content="<?php echo $protocolo . $_SERVER["HTTP_HOST"]; ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="refresh" content="0;URL=./main/index.php">
</head>
<body>
</body>
</html>
<?php } ?>