
<?php
include('./db_login.php');
	require('./check_login.php');
	$locations = $_POST['comboicao'];

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
	
	
	
	
	
	
	
	
	// DATOS UBICACIÓN
	
	$sql3 = "SELECT * FROM airports  where ident='$location'";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	
	while ($row3 = $result3->fetch_assoc()) {

		$latitude_deg_loc = $row3['latitude_deg'];

		$longitude_deg_loc = $row3['longitude_deg'];

		$iata_code = $row3['iata_code'];
	}
	
	
	
	
	// DETALLES AEROPUERTO IDA
	
	$sql = "select ident, name, latitude_deg, longitude_deg,iata_code from airports where ident='$locations'";
	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
		while ($row = $result->fetch_assoc()) {
	
	$latitude_deg_arr = $row['latitude_deg'];

$longitude_deg_arr = $row['longitude_deg'];

$iata_code2 = $row['iata_code'];

	}


    $km = 111.302;
    
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
	
	
	
	// DATOS PRECIO POR KMS
	
	$sqlticket = "SELECT ticket FROM va_parameters  where va_parameters_id='1'";

	if (!$resultticket = $db->query($sqlticket)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	
	while ($rowticket = $resultticket->fetch_assoc()) {

		$ticket = $rowticket['ticket'];

	}
	
	
$valortiquete = round($kms*$ticket);

$numero = $money; 
$caracteres = Array(","); 
$resultado = str_replace($caracteres,"",$numero); 




	

	
	
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
	<h3><font color="white"> <?php echo INFO_PROCESS_TRAVEL; ?> </font></h3>

</section>
		
		
		
		



		
			<form class="form-horizontal" action="./index_user.php?page=jumpva"
				       method="post">
		

		<style>


		
.box{
  position: absolute;
  top: 250px;
  left: calc(50% - 300px);
  left: -webkit-calc(50% - 300px);
}

.ticket{
  width: 600px;
  height: 250px;
  background: #858585;
  border-radius: 3px;
  box-shadow: 0 0 100px #858585;
  border-top: 1px solid #858585;
  border-bottom: 1px solid #858585;
}


.left{
  margin: 0;
  padding: 0;
  list-style: none;
  position: absolute;
  top: 0px;
  left: -5px;
}

.left li{
  width: 0px;
  height: 0px;
}

.left li:nth-child(-n+2){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #858585;
}

.left li:nth-child(3),
.left li:nth-child(6){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #EEEEEE;
}

.left li:nth-child(4){
  margin-top: 8px;
  margin-left: 2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #EEEEEE;
}

.left li:nth-child(5){
  margin-top: 8px;
  margin-left: -1px;
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent; 
  border-right: 6px solid #EEEEEE;
}

.left li:nth-child(7),
.left li:nth-child(9),
.left li:nth-child(11),
.left li:nth-child(12){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #C2C2C2;
}

.left li:nth-child(8){
  margin-top: 7px;
  margin-left: 2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #C2C2C2;
}

.left li:nth-child(10){
  margin-top: 7px;
  margin-left: 1px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #C2C2C2;
}

.left li:nth-child(13){
  margin-top: 7px;
  margin-left: 2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #858585;
}

.left li:nth-child(14){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-right: 5px solid #858585;
}

.right{
  margin: 0;
  padding: 0;
  list-style: none;
  position: absolute;
  top: 0px;
  right: -5px;
}

.right li:nth-child(-n+2){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #858585;
}

.right li:nth-child(3),
.right li:nth-child(4),
.right li:nth-child(6){
  margin-top: 8px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #EEEEEE;
}

.right li:nth-child(5){
  margin-top: 8px;
  margin-left: -2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #EEEEEE;
}

.right li:nth-child(8),
.right li:nth-child(9),
.right li:nth-child(11){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #C2C2C2;
}

.right li:nth-child(7){
  margin-top: 7px;
  margin-left: -3px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #C2C2C2;
}

.right li:nth-child(10){
  margin-top: 7px;
  margin-left: -2px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #C2C2C2;
}

.right li:nth-child(12){
  margin-top: 7px;
  border-top: 6px solid transparent;
  border-bottom: 6px solid transparent; 
  border-left: 6px solid #C2C2C2;
}

.right li:nth-child(13),
.right li:nth-child(14){
  margin-top: 7px;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent; 
  border-left: 5px solid #858585;
}


.ticket:after{
  content: '';
  position: absolute;
  right: 200px;
  top: 0px;
  width: 2px;
  height: 250px;
  box-shadow: inset 0 0 0 #858585,
    inset 0 -10px 0 #8D8D8D,
    inset 0 -20px 0 #858585,
    inset 0 -30px 0 #8D8D8D,
    inset 0 -40px 0 #858585,
    inset 0 -50px 0 #999999,
    inset 0 -60px 0 #858585,
    inset 0 -70px 0 #999999,
    inset 0 -80px 0 #E5E5E5,
    inset 0 -90px 0 #999999,
    inset 0 -100px 0 #E5E5E5,
    inset 0 -110px 0 #999999,
    inset 0 -120px 0 #E5E5E5,
    inset 0 -130px 0 #999999,
    inset 0 -140px 0 #E5E5E5,
    inset 0 -150px 0 #B0B0B0,
    inset 0 -160px 0 #EEEEEE,
    inset 0 -170px 0 #B0B0B0,
    inset 0 -180px 0 #EEEEEE,
    inset 0 -190px 0 #B0B0B0,
    inset 0 -200px 0 #EEEEEE,
    inset 0 -210px 0 #B0B0B0,
    inset 0 -220px 0 #858585,
    inset 0 -230px 0 #8D8D8D,
    inset 0 -240px 0 #858585,
    inset 0 -250px 0 #8D8D8D;
}

.ticket:before{
  content: '';
  position: absolute;
  z-index: 5;
  right: 199px;
  top: 0px;
  width: 1px;
  height: 250px;
  box-shadow: inset 0 0 0 #858585,
    inset 0 -10px 0 #F4D483,
    inset 0 -20px 0 #858585,
    inset 0 -30px 0 #F4D483,
    inset 0 -40px 0 #858585,
    inset 0 -50px 0 #FFFFFF,
    inset 0 -60px 0 #E5E5E5,
    inset 0 -70px 0 #FFFFFF,
    inset 0 -80px 0 #E5E5E5,
    inset 0 -90px 0 #FFFFFF,
    inset 0 -100px 0 #E5E5E5,
    inset 0 -110px 0 #FFFFFF,
    inset 0 -120px 0 #E5E5E5,
    inset 0 -130px 0 #FFFFFF,
    inset 0 -140px 0 #E5E5E5,
    inset 0 -150px 0 #FFFFFF,
    inset 0 -160px 0 #EEEEEE,
    inset 0 -170px 0 #FFFFFF,
    inset 0 -180px 0 #EEEEEE,
    inset 0 -190px 0 #FFFFFF,
    inset 0 -200px 0 #EEEEEE,
    inset 0 -210px 0 #FFFFFF,
    inset 0 -220px 0 #858585,
    inset 0 -230px 0 #F4D483,
    inset 0 -240px 0 #858585,
    inset 0 -250px 0 #F4D483;
}

.content{
  position: absolute;
  top: 40px;
  width: 100%;
  height: 170px;
  background: #eee;
}

.airline{
  position: absolute;
  top: 10px;
  left: 10px;
  font-family: Arial;
  font-size: 20px;
  font-weight: bold;
  color: #9F0606;
}

.boarding{
  position: absolute;
  top: 10px;
  right: 220px;
  font-family: Arial;
  font-weight: bold;
  color: rgba(255,255,255,0.6);
}

.jfk{
  position: absolute;
  top: 10px;
  left: 20px;
  font-family: Arial;
  font-size: 38px;
  color: #222;
}

.sfo{
  position: absolute;
  top: 10px;
  left: 180px;
  font-family: Arial;
  font-size: 38px;
  color: #222;
}

.plane{
  position: absolute;
  left: 105px;
  top: 0px;
}

.sub-content{
  background: #C2C2C2;
  width: 100%;
  height: 100px;
  position: absolute;
  top: 70px;
}

.watermark{
  position: absolute;
  left: 5px;
  top: 40px;
  font-family: Arial;
  font-size: 110px;
  font-weight: bold;
  color: #fff;
}

.name{
  position: absolute;
  top: 10px;
  left: 10px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.name span{
  color: #555;
  font-size: 17px;
}

.flight{
  position: absolute;
  top: 10px;
  left: 180px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.flight span{
  color: #555;
  font-size: 17px;
}

.gate{
  position: absolute;
  top: 10px;
  left: 280px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.gate span{
  color: #555;
  font-size: 17px;
}


.seat{
  position: absolute;
  top: 10px;
  left: 350px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.seat span{
  color: #555;
  font-size: 17px;
}

.boardingtime{
  position: absolute;
  top: 60px;
  left: 10px;
  font-family: Arial Narrow, Arial;
  font-weight: bold;
  font-size: 14px;
  color: #999;
}

.boardingtime span{
  color: #555;
  font-size: 17px;
}

.barcode{
  position: absolute;
  left: 8px;
  bottom: 6px;
  height: 30px;
  width: 90px;
  background: #222;
  
  box-shadow: inset 0 1px 0 #858585, inset -2px 0 0 #858585,
    inset -4px 0 0 #222,
    inset -5px 0 0 #858585,
    inset -6px 0 0 #222,
    inset -9px 0 0 #858585,
    inset -12px 0 0 #222,
    inset -13px 0 0 #858585,
    inset -14px 0 0 #222,
    inset -15px 0 0 #858585,
    inset -16px 0 0 #222,
    inset -17px 0 0 #858585,
    inset -19px 0 0 #222,
    inset -20px 0 0 #858585,
    inset -23px 0 0 #222,
    inset -25px 0 0 #858585,
    inset -26px 0 0 #222,
    inset -26px 0 0 #858585,
    inset -27px 0 0 #222,
    inset -30px 0 0 #858585,
    inset -31px 0 0 #222,
    inset -33px 0 0 #858585,
    inset -35px 0 0 #222,
    inset -37px 0 0 #858585,
    inset -40px 0 0 #222,
    inset -43px 0 0 #858585,
    inset -44px 0 0 #222,
    inset -45px 0 0 #858585,
    inset -46px 0 0 #222,
    inset -48px 0 0 #858585,
    inset -49px 0 0 #222,
    inset -50px 0 0 #858585,
    inset -52px 0 0 #222,
    inset -54px 0 0 #858585,
    inset -55px 0 0 #222,
    inset -57px 0 0 #858585,
    inset -59px 0 0 #222,
    inset -61px 0 0 #858585,
    inset -64px 0 0 #222,
    inset -66px 0 0 #858585,
    inset -67px 0 0 #222,
    inset -68px 0 0 #858585,
    inset -69px 0 0 #222,
    inset -71px 0 0 #858585,
    inset -72px 0 0 #222,
    inset -73px 0 0 #858585,
    inset -75px 0 0 #222,
    inset -73px 0 0 #858585,
    inset -80px 0 0 #222,
    inset -82px 0 0 #858585,
    inset -83px 0 0 #222,
    inset -84px 0 0 #858585,
    inset -86px 0 0 #222,
    inset -88px 0 0 #858585,
    inset -89px 0 0 #222,
    inset -88px 0 0 #858585;
}

.slip{
  left: 455px;
}

.nameslip{
  top: 60px;
  left: 410px;
}

.flightslip{
  left: 410px;
}

.seatslip{
  left: 540px;
}

.jfkslip{
  font-size: 30px;
  top: 20px;
  left: 410px;
}

.sfoslip{
  font-size: 30px;
  top: 20px;
  left: 530px;
}

.planeslip{
  top: 10px;
  left: 475px;
}

.airlineslip{
  left: 455px;
}

</style>
<div class="container">
<br>
<h1 align="center"><?php echo LAST_STEP; ?></h1>
<hr>
<br>
</div>

<div class="box">

  <ul class="left">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
  
  <ul class="right">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
  <div class="ticket">
    <span class="airline">ColStar</span>
    <span class="airline airlineslip">ColStar</span>
    <span class="boarding">Boarding pass</span>
    <div class="content">
      <span class="jfk"><?php echo $iata_code; ?></span>
      <span class="plane"> <svg clip-rule="evenodd" fill-rule="evenodd" height="60" width="60" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g stroke="#222"><line fill="none" stroke-linecap="round" stroke-width="30" x1="300" x2="55" y1="390" y2="390"/><path d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z" fill="#222" stroke-linejoin="round" stroke-width="10"/></g></svg></span>
      <span class="sfo"><?php echo $iata_code2; ?></span>
      
      <span class="jfk jfkslip"><?php echo $iata_code; ?></span>
      <span class="plane planeslip">
	 
	  <svg clip-rule="evenodd" fill-rule="evenodd" height="50" width="50" image-rendering="optimizeQuality" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g stroke="#222"><line fill="none" stroke-linecap="round" stroke-width="30" x1="300" x2="55" y1="390" y2="390"/><path d="M98 325c-9 10 10 16 25 6l311-156c24-17 35-25 42-50 2-15-46-11-78-7-15 1-34 10-42 16l-56 35 1-1-169-31c-14-3-24-5-37-1-10 5-18 10-27 18l122 72c4 3 5 7 1 9l-44 27-75-15c-10-2-18-4-28 0-8 4-14 9-20 15l74 63z" fill="#222" stroke-linejoin="round" stroke-width="10"/></g></svg></span>
      <span class="sfo sfoslip"><?php echo $iata_code2; ?></span>
      <div class="sub-content">
        <span class="watermark">ColStar</span>
        <span class="name">PASSENGER NAME<br><span><?php echo $pilotname; ?></span></span>
        <span class="flight">FLIGHT N&deg;<br><span>CST<? echo $numflight = rand(452, 5689); ?></span></span>
        <span class="gate">GATE<br><span><? echo rand(1, 35); ?><? echo $letraAleatoria1 = chr(rand(ord(A), ord(Z))); ?></span></span>
        <span class="seat">SEAT<br><span><? echo $seats = rand(1, 25); ?><? echo $letraAleatoria = chr(rand(ord(A), ord(C))); ?></span></span>
        <span class="boardingtime">BOARDING TIME<br><span><?php echo date("g:i a  F j, Y");  ?></span></span>
            
         <span class="flight flightslip">FLIGHT N&deg;<br><span>CST<? echo $numflight; ?></span></span>
          <span class="seat seatslip">SEAT<br><span><? echo $seats; ?><? echo $letraAleatoria; ?></span></span>
         <span class="name nameslip">PASSENGER NAME<br><span><?php echo $pilotname; ?></span></span>
      </div>
    </div>
    <div class="barcode"></div>
    <div class="barcode slip"></div>
  </div>
			
	</div>
	<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	
		<div class="container">
		
<?php 

if ($valortiquete <= $resultado) {


?>


<div class="form-group">
						<div class="col-sm-12">
						
						<input type="hidden" name="destino" id="destino" value="<?php echo $locations; ?>"/>
						<center>	<button type="submit"
							        class="btn btn-primary" style="width:100%;"><?php echo BUY_A_TICKET; ?>. $<?php echo $valortiquete; ?></button>
									</center>	
									</div>
					</div>
					
<?php } else
	
	{
		
	echo '<div class="alert bg--error">
                                <div class="alert__body">
                                    <span>' . ALERT_TICKET . $valortiquete . ' ' . ALERT_TICKET_TWO . round($resultado) . '</span>
                                </div>
                            </div>';
	
	
	}




?>
						
				
		
					
					
		</form>
	
</div>

	
		<?php
		$db->close();

?>
	<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		