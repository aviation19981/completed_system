
<?php
		
	$sql = "select * from config_examen where id=1";
		
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($row = $result->fetch_assoc()) {

        $title = $row["titulo"];
        $duracion = $row["duracion"];
			$limite = $row['limite'];
		}	
		
		
		$nombres = $_POST['nombres'];
		$apellidos = $_POST['apellidos'];
		$vid = $_POST['vid'];
		$correo = $_POST['correo'];
		$rangoivao = $_POST['rangoivao'];
		$agree = $_POST['agree'];
		$operator_id = $_POST['operator_id']; 
		$ip = $_SERVER['REMOTE_ADDR'];
		
		
		if(empty($nombres) || empty($apellidos) || empty($vid) || empty($correo) || empty($rangoivao) || empty($agree)) {
			
	
			
			?>
		<script>
alert('<?php echo ALERT_TEST; ?>');
window.location = './?page=prueba';
</script>	
			
			
			<?php
		} else {

		
		
		$resultadoexamen=0;
		
			$sqlexamen = "select * from presentacionexamen where vid='$vid' or ip='$ip' and estado<=5 and HOUR(timediff(now(),fecha))<=24";
		
		if (!$resultexamen = $db->query($sqlexamen)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		while ($rowresultado = $resultexamen->fetch_assoc()) {
			$resultadoexamen++;
		}
		
		if($resultadoexamen==0) {
		
		$sql1 = "insert into presentacionexamen (nombres,apellidos,vid,email,rango,fecha,ip,estado,operator_id)
                    values ('$nombres','$apellidos','$vid','$correo','$rangoivao',now(),'$ip',0,'$operator_id');";
				if (!$result1 = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			
		
		?>
		
	

<!-- PARALLAX SECTION
================================================== -->

<section class="section-testimonials parallax-section" id="home">

	<div
		class="parallax-1"
		style="background-image:url('<?php  picture(); ?>')"
		data-parallax-speed="0.4"></div>

	<div class="just_pattern_parallax"></div>
    
	<h1><font color="white"><?php echo TEST_CENTER; ?></font></h1>
	<br>
	<div class="sixteen columns"><div class="sub-text-line"></div></div>
	<br>
	<h3><font color="white"><?php echo DETAIL_TEST_CENTER; ?></font></h3>

</section>
	




		<section class="contact">
			<div class="container" >
			
			
    
		    
		<h1>Tiempo Restante <small><div id="divCounter"></div></small></h1>
<script type="text/javascript">

var hoursleft = 0;
var minutesleft = <?php echo $duracion; ?>;           // you can change these values to any value greater than 0
var secondsleft = 0;

var finishedtext = "Countdown finished!" // text that appears when the countdown reaches 0
var end = new Date();

end.setMinutes(end.getMinutes()+minutesleft);
end.setSeconds(end.getSeconds()+secondsleft);


if(localStorage.getItem("counter")){

    var value = localStorage.getItem("counter");

}else{
  var value = 0;
}


var counter = function (){


    var now = new Date();
var diff = end - now;
diff = new Date(diff);

var sec = diff.getSeconds();
var min = diff.getMinutes();

if (min < 10){
    min = "0" + min;
}
if (sec < 10){
    sec = "0" + sec;
}

if(now >= end){
    clearTimeout(timerID);
    //document.getElementById('divCounter').innerHTML = finishedtext;
	
}

else{
    var value = min + ":" + sec;
//document.getElementById('divCounter').innerHTML = min + ":" + sec;
localStorage.setItem("counter", JSON.stringify(value));
} 


if(min==0 && sec==0) {
  document.exmaneva.submit();
}    

 // timerID = setTimeout("cd()", 1000);
// value = JSON.parse(localStorage.getItem("counter"));
//$('#divCounter').append(value);
document.getElementById('divCounter').innerHTML = value; 
 }





 var interval = setInterval(function (){counter();}, 1000);
 </script>
 
			<hr>
			<p><?php echo INFORMATION_TEST; ?></p>
			<br>
			
			
			
			<div class="col-md-12 col-sm-7">
                            <form method="POST" name="exmaneva" action="./?page=examenresultados">
		<?php
							
        $sql12 = "select * from preguntasdeexamen where idexamen=1 ORDER BY RAND()  LIMIT $limite";
		
		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$i2 = 1;
		$contadoresmas=0;
		while ($row12 = $result12->fetch_assoc()) {
			
			$contadoresmas++;
				
			
			?>
			                           
			<hr>
			
			<div class="col-sm-12">
                    <p><?php echo $i2++; ?>). <?php echo $row12["pregunta"]; ?></p>
            </div>
			
			<div class="col-sm-12">
                                    <select name="<?php echo $row12["id"]; ?>">
                                            <option selected="" value=""><?php echo SELECT_OPTION; ?></option>
											<?php if(!empty($row12['A'])) { ?>
                                            <option value="A"><?php echo $row12['A']; ?></option>
											<?php } ?>
                                            <?php if(!empty($row12['B'])) { ?>
                                            <option value="B"><?php echo $row12['B']; ?></option>
											<?php } ?>
											<?php if(!empty($row12['C'])) { ?>
                                            <option value="C"><?php echo $row12['C']; ?></option>
											<?php } ?>
											<?php if(!empty($row12['D'])) { ?>
                                            <option value="D"><?php echo $row12['D']; ?></option>
											<?php } ?>
                                        </select>
                                </div>
			
			
			
			
			<?php
			
		
			echo '<br><br>';
		}
		
		
		
		
?>
<input type="hidden" name="vid" value="<?php echo $vid; ?>">
<input type="hidden" name="numpreg" value="<?php echo $contadoresmas; ?>">
                               
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn--primary"><?php echo SENT_TEST; ?></button>
                                </div>
                            </form>
                        </div>

	
			</div>
			
			<br>
			<br>
			</section>
			

			
		<?php } else {
			
			?>
		<script>
alert('<?php echo ALERT_TWO_TEST; ?>');
window.location = './index.php?page=prueba';
</script>	
			
			
			<?php
		}
		}
?>